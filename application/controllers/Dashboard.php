<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Dashboard extends CI_Controller
{
    protected $_data = [];
    function __construct()
    {
        parent::__construct();
        $this->_data["title"] = "DASHBOARD";
        $this->load->model("Data_model");
        $this->load->library("Ciqrcode");
        $this->load->library("form_validation");
        $this->load->library("pagination");
        date_default_timezone_set("Asia/Makassar");
        $this->setJadwalAbsensi();
    }

    private function setJadwalAbsensi()
    {
        $getSesi = $this->db->get_where("jadwal", ["tgl_berlaku" => date("Y-m-d")]);
        if (!$getSesi->num_rows()) {
            $this->db->query("DELETE FROM jadwal");
            $data = [
                'jam_masuk' => strtotime(date("07:00")),
                'jam_pulang' => strtotime(date("14:00")),
                'tgl_berlaku' => date("Y-m-d")
            ];
    
            $this->Data_model->insertJadwal($data);
        }
    }

    public function index()
    {
        // $SISWA = $this->Data_model->getDataSiswa("ok");
        // foreach ($SISWA as $value) {
        //     if ($value['id_card'] == "11743") {
        //         var_dump($value);
        //         return;
        //     }

        //     // $this->Data_model->updateDataSiswa($data);
        // }
        // die;


        if ($this->session->userdata("login")) {
            $this->_data["title"] = "DASHBOARD | DATA SISWA";
            $uri_segment = $this->uri->segment(3);
            if ($this->input->post("keyword")) {
                $uri_segment = 0;
                $this->_data["keyword"] = $this->input->post("keyword");
                $this->session->set_userdata("keyword", $this->_data["keyword"]);
            }else {
                $this->_data["keyword"] = $this->session->userdata("keyword");
            }
            
            if ($this->input->post("jurusan") && $this->input->post("kelas")) {
                $this->session->set_userdata("pil_kelas", $this->input->post("kelas"));
                $this->session->set_userdata("pil_jurusan", $this->input->post("jurusan"));
            }else {
                if (!($this->session->userdata("pil_jurusan") && $this->session->userdata("pil_kelas"))) {
                    $this->session->set_userdata("pil_kelas", "X");
                    $this->session->set_userdata("pil_jurusan", "DPIB1");
                }
            }
    
            $this->_data['pil_jurusan'] = $this->session->userdata("pil_jurusan");
            $this->_data['pil_kelas'] = $this->session->userdata("pil_kelas");
            $this->_data["limit"] = 5;
            $this->_data["start"] = $uri_segment;
            
            $this->_data["data_siswa"] = $this->Data_model->getDataSiswa($this->_data); 
            
            // config
            if ($this->_data["keyword"]) {
                $this->db->like("nama_siswa", $this->_data["keyword"]);
            }
            $this->db->where(["kelas" => $this->session->userdata("pil_kelas"), "jurusan" => $this->session->userdata("pil_jurusan")]);
            $this->db->from("siswa");
            
            $config["total_rows"] = $this->db->count_all_results();
            $config["per_page"] = $this->_data["limit"];
            
            $this->pagination->initialize($config);
    
            $this->load->view("templates/header", $this->_data);
            $this->load->view("Dashboard/data_siswa");
            $this->load->view("templates/footer");

        }else {
            redirect("Auth/login");
        }

    }

    public function generate_QRcode()
    {
        $this->_data["title"] = "DASHBOARD | GENERATE QRCODE";
        $this->_data["data"] = $this->Data_model->getDataQRcode();

        if ($this->input->post("generate")) {
            if (file_exists(FCPATH."assets/QRCODE/".$this->input->post("kelas")."/".$this->input->post("jurusan"))) {
                if ($this->_data["data"]) {
                    $zip = new ZipArchive(); // load library ZipArchive
                    $zip_name = "QRCODE ".$this->input->post("kelas")."_".$this->input->post("jurusan").".zip";

                    $zip->open($zip_name, ZIPARCHIVE::CREATE);  // Open & create extensi zip

                    foreach ($this->_data["data"] as $siswa) {
                        if ($this->input->post("jurusan") == $siswa["jurusan"] && $this->input->post("kelas") == $siswa["kelas"]) {
                            $config['imagedir']     = './assets/QRCODE/'.$this->input->post("kelas")."/".$this->input->post("jurusan")."/"; //direktori penyimpanan qr code
                            $config['black']        = array(0, 0, 0); // array, default is array(255,255,255)
                            $config['white']        = array(225,255,255); // array, default is array(0,0,0)
                            $this->ciqrcode->initialize($config);
                    
                            $nameQR = $siswa["kelas"]."_".$siswa["jurusan"]."_".$siswa["nama_siswa"].".png";
                            $params['data'] = $siswa["id_card"]; //data yang akan di jadikan QR CODE
                            $params['level'] = 'H'; //H=High
                            $params['size'] = 5;
                            $params['savename'] = FCPATH.$config['imagedir'].$nameQR; //simpan image QR CODE ke folder assets/images/
                            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

                            $zip->addFile($config["imagedir"].$nameQR, $nameQR); // menambah file ke dalam zip
                        }
                    }

                    $zip->close();  // menuutup file zip

                    if (file_exists($zip_name)) {
                        header("Content-type: application/zip");
                        header('Content-Disposition: attachment; filename="'.$zip_name.'"');
                        readfile($zip_name);
                        unlink($zip_name);
                    }
                }else {
                    echo "
                        <script>
                            alert('Data Kosong');
                            document.location.href ='".base_url("/dashboard/generate_QRcode")."';
                        </script> 
                    ";
                }        
            }else {
                mkdir(FCPATH."assets/QRCODE/".$this->input->post("kelas")."/".$this->input->post("jurusan"));
                $this->generate_QRcode();
            }
                       
        }else {
            $this->load->view("templates/header", $this->_data);
            $this->load->view("Dashboard/Generate_QRcode");
            $this->load->view("templates/footer");
        }
        
    
    }

    public function editData()
    {
        if (@$_FILES["fileImport"]) {
            $config['upload_path'] = './uploadData/';
            $config['allowed_types'] = 'xlsx|xls';
            $config['file_name'] = $_FILES["fileImport"]["name"];
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('fileImport')) {
                $file = $this->upload->data();
                $reader = ReaderEntityFactory::createXLSXReader();

                $reader->open('uploadData/' . $file['file_name']);
                foreach ($reader->getSheetIterator() as $sheet) {
                    $numRow = 1;
                    foreach ($sheet->getRowIterator() as $row) {
                        if ($numRow > 1) {
                            $data = array(
                                'id_card'  => $row->getCellAtIndex(1),
                                'NIPD'        => $row->getCellAtIndex(1),
                                'nama_siswa'  => $row->getCellAtIndex(2),
                                'kelas'       => $row->getCellAtIndex(4),
                                'jurusan'     => $row->getCellAtIndex(5),
                                'jenisKelamin' => $row->getCellAtIndex(3),
                                'thn_masuk' => $row->getCellAtIndex(6)
                            );
                            if ($this->input->post("btn_edit") == "upload") {
                                $this->Data_model->tambahDataSiswa($data);
                            }elseif($this->input->post("btn_edit") == "update"){
                                
                                $this->Data_model->updateDataSiswa($data);
                            }
                        }
                        $numRow++;
                    }
                    $reader->close();
                    unlink('uploadData/' . $file['file_name']);
                    $this->session->set_userdata('pesan_edit', 'Import File Berhasil');
                    redirect('Dashboard/editData?'.$this->input->post("btn_edit"));
                }
            } else {
                echo "Error :" . $this->upload->display_errors();
            };
        }else {
            $this->_data["title"] = "DASHBOARD | EDIT DATA";
            $this->load->view("templates/header", $this->_data);
            $this->load->view("Dashboard/edit_data");
            $this->load->view("templates/footer");
        }
    }

    public function atur_sesi_absen()
    {
        if ($this->input->post("submit")) {
            $jam_masuk = strtotime($this->input->post("jam_masuk"));
            $jam_pulang = strtotime($this->input->post("jam_pulang"));
            $result = $this->Data_model->insertJadwal([
                "jam_masuk" => $jam_masuk,
                "jam_pulang" => $jam_pulang,
                "tgl_berlaku" => $this->input->post("tgl")
            ]);

            // var_dump($result);

            if ($result) {
                $this->session->set_userdata("setJAMPUL", true);
                redirect("dashboard/atur_sesi_absen");
            }
                
        }else {
            $this->_data["title"] = "DASHBOARD | ATUR SESI ABSEN";
            $this->load->view("templates/header", $this->_data);
            $this->load->view("Dashboard/atur_sesi_absen");
            $this->load->view("templates/footer");
        }
    }

    public function deleteDataKelas()
    {
        $kelas = $this->input->post("kelas");
        $this->db->where("kelas", $kelas);
        if ($kelas != "XIII") {
            $this->db->where("jurusan !=", "KGSP");
            $this->db->where("jurusan !=", "DITF");
        }
        
        if ($this->db->delete("siswa")) {
            $this->session->set_userdata('pesan_edit', 'Delete Kelas Berhasil');
            redirect('Dashboard/editData?'.$this->input->post("btn_delete"));
        }
    }

    
    public function setKelas()
    {
        $this->_data["title"] = "DASHBOARD | SET KELAS";
        $this->_data["data_kelas"] = $this->db->get("tb_kelas")->result_array();
        $this->load->view("templates/header", $this->_data);
        $this->load->view("Dashboard/set_kelas", $this->_data);
        $this->load->view("templates/footer");
    }


} 
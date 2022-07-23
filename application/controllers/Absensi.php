<?php

class Absensi extends CI_Controller
{
    protected $_data = [];
    function __construct(){
        parent::__construct();
        $this->load->model("Data_model");
        date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
        // $jam = (int) date("H");
        // if ($jam >= 18) {
        //     echo "
        //         <script>
        //             alert('Mohon maaf absensi sudah ditutup');
        //             document.location.href ='".base_url()."';
        //         </script> 
        //     ";
        // }else {
            $this->Data_model->buat_table_mingguan(date("Y-m-d"));            
            $this->load->view("Dashboard/absensi_siswa");
        // }
    }

    public function absensi_admin()
    {
        $this->_data["admin"] = true;
        $this->Data_model->buat_table_mingguan(date("Y-m-d"));            
        $this->load->view("Dashboard/absensi_siswa", $this->_data);
    }
    
    public function rekap_absensi_harian()
    {
        $this->_data["title"] = "DASHBOARAD | REKAP ABSENSI";
        $this->load->view("templates/header", $this->_data);
        $this->load->view("Dashboard/rekap_absensi_harian");
        $this->load->view("templates/footer");
    }

    public function rekap_absensi_mingguan()
    {
        $this->_data["title"] = "DASHBOARAD | REKAP ABSENSI";
        $this->load->view("templates/header", $this->_data);
        $this->load->view("Dashboard/rekap_absensi_mingguan");
        $this->load->view("templates/footer");
    }

    public function download_absensi_mingguan()
    {
        $date = new DateTime($this->input->post("calender"));
        $data["kelas"] = $this->input->post("kelas");
        $data["jurusan"] = $this->input->post("jurusan");
        $this->_data["name_file"] = $this->input->post("kelas")."-".$this->input->post("jurusan");

        for ($i=1; $i <= 6; $i++) { 
          $data["name_table"] = $date->format("Y_m_d");
          $result = $this->Data_model->getDataAbsen($data);
          if ($result["status"]) {
              $result["data"]["dataAbsen"]["tanggal"] = $date->format("d/m/y");
              $this->_data["data_siswa"] = $result["data"]["dataSiswa"];
              $this->_data["data_absensi$i"] = $result["data"]["dataAbsen"];
          }else {
              echo "
                <script>
                    alert('maaf salah satu tanggal yang anda pilih belum memiliki data, pastikan anda sudah melakukan program absensi selama seminggu full');
                    document.location.href = '".base_url('absensi/rekap_absensi_mingguan')."';
                </script>
              ";
              break;
          }

          $date->modify("+1 days");
        }

        if ($this->input->post("export") == "excel") {
            $this->load->view("download/excel_mingguan", $this->_data);       
        }elseif ($this->input->post("export") == "print") {
            $this->load->view("download/print_mingguan", $this->_data);       
        }else{ 
            echo "
                <script>
                    alert('Pilih Type Export Terlebih dahulu');
                    document.location.href = '".base_url('absensi/rekap_absensi_mingguan')."';
                </script>
            ";
        }

    }
    
    public function download_absensi_harian()
    {     
        $tanggal = explode("-", $this->input->post("tanggal"));
        if (count($tanggal) > 1) {
            $tgl = $tanggal[2];
            $bln = $tanggal[1];
            $thn = $tanggal[0];
            
            $data["name_table"] = $thn."_".$bln."_".$tgl;
            $data["kelas"] =  $this->input->post("kelas");
            $data["jurusan"] = $this->input->post("jurusan");
            
            $name_file = $this->input->post("kelas")."-".$this->input->post("jurusan");
            
            $result = $this->Data_model->getDataAbsen($data);

            if ($result["status"]) {
                $this->_data["data_siswa"] = $result["data"]["dataSiswa"];
                $this->_data["data_absensi"] = $result["data"]["dataAbsen"];
                $this->_data["name_file"] = $name_file;

                if (strtotime(date("Y-m-d")) > strtotime($this->input->post("tanggal"))) {
                    $this->_data["jamPulang"] = true;
                }else {
                    $jam = strtotime(date("H:i"));
                    $dataJadwal = $this->Data_model->db->get_where("jadwal", ["tgl_berlaku" => date("Y-m-d")]);
                    if ($dataJadwal->num_rows()) {
                        if ($jam >= intval($dataJadwal->result_array()[0]["jam_pulang"])) {$this->_data["jamPulang"] = true;}
                    }else {
                        if ($jam >= strtotime("14:00")) { $this->_data["jamPulang"] = true;}
                    }
                }
                $this->_data["tanggal"] = date("l", mktime(0,0,0,$bln,$tgl,$thn)).", ".$tgl."-".$bln."-".$thn;
    
                if ($this->input->post("export") == "excel") {
                    $this->load->view("download/excel", $this->_data);       
                }elseif ($this->input->post("export") == "print") {
                    $this->load->view("download/print", $this->_data);       
                }else{ 
                    echo "
                        <script>
                            alert('Pilih Type Export Terlebih dahulu');
                            document.location.href = '".base_url('absensi/rekap_absensi_harian')."';
                        </script>
                    ";
                }
            }else {
                echo "
                    <script>
                        alert('Tidak ada data absensi pada tanggal ini');
                        document.location.href = '".base_url('absensi/rekap_absensi_harian')."';
                    </script>
                ";
            }
        }else {
            echo "
                <script>
                    alert('Tanggal Belum di set');
                    document.location.href = '".base_url('absensi/rekap_absensi_harian')."';
                </script>
            ";
        }
        
    }

    public function Presensi($id_card = null)
    {   
        if ($id_card) {
            $data = $this->Data_model->getDataSiswaById($id_card);
            if ($data["status"]) {
                $data["data"]["time"] = date("H:i:s");

                $getSesi = $this->db->get_where("jadwal", ["tgl_berlaku" => date("Y-m-d")])->result_array()[0];
          
                if (strtotime(date("H:i")) <= $getSesi["jam_masuk"]) { $data["data"]["ket"] = "Hadir";}
                else { $data["data"]["ket"] = "Terlambat Masuk";}

                $result = $this->Data_model->Presensi($data["data"]);
                if ($result["status"]) {
                    return $this->load->view("Absensi/data_absen", $data);
                }else {
                    $result["data"]["sudah_absen_masuk"] = TRUE;
                    return $this->load->view("Absensi/data_absen", $result);
                }
            }else {
                echo json_encode(["msg" => "NIPD ini tidak ditemukan"]); die;
            }
        }
    }


}
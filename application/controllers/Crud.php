<?php

class Crud extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Data_model");
    }

//======================= CRUD SISWA =======================//
    public function tambah_data()
    {
        $data = [
            "id_card" => $this->input->post("NIPD"),
            "NIPD" => $this->input->post("NIPD"),
            "nama_siswa" => $this->input->post("nama_siswa"),
            "kelas" => $this->input->post("kelas"),
            "jenisKelamin" => $this->input->post("jenisKelamin"),
            "jurusan" => $this->input->post("jurusan"),
            "thn_masuk" => $this->input->post("thn_masuk")
        ];

        if (isset($_FILES['fileFoto'])) {
            $config["upload_path"] = "assets/images/foto_siswa/".$this->input->post("thn_masuk")."/".$this->input->post("jurusan")."/";
            $config["file_name"] = $_FILES["fileFoto"]["name"];
            $config["allowed_types"] ="jpg|jpeg|png";
    
            $this->load->library("upload", $config);
    
            if ($this->upload->do_upload("fileFoto")) {
                $file = $this->upload->data();

                $data['foto'] = $config["upload_path"].$file["file_name"];
    
            }else {
                echo  $this->upload->display_errors();
            }
        }
        
        if ($this->Data_model->tambahDataSiswa($data)) {
            $this->session->set_userdata("success", "Data berhasil ditambahkan");
            redirect("Dashboard");
        }

    }

    public function update_data()
    {
        $data = [
            "id_card" => $this->input->post("id_card"),
            "NIPD" => $this->input->post("id_card"),
            "nama_siswa" => $this->input->post("nama_siswa"),
            "kelas" => $this->input->post("kelas"),
            "jenisKelamin" => $this->input->post("jenisKelamin"),
            "jurusan" => $this->input->post("jurusan"),
            "thn_masuk" => $this->input->post("thn_masuk")
        ];

        // var_dump($_FILES); die;

        if ($_FILES["fileFotoUpdate"]["error"] == 0) {
            $config["upload_path"] = "assets/images/foto_siswa/".$this->input->post("thn_masuk")."/".$this->input->post("jurusan")."/";
            $config["file_name"] = $_FILES["fileFotoUpdate"]["name"];
            $config["allowed_types"] ="jpg|jpeg|png";
    
            $this->load->library("upload", $config);
    
            if ($this->upload->do_upload("fileFotoUpdate")) {
                $file = $this->upload->data();
                $data["foto"] = $config["upload_path"].$file["file_name"];
                if ($this->Data_model->updateDataSiswa($data)) {
                    $this->session->set_userdata("success", "Update Data Berhasil");
                    redirect("Dashboard");
                }
            }else {
                echo  $this->upload->display_errors();
            }
        }else {
            if ($this->Data_model->updateDataSiswa($data)) {
                $this->session->set_userdata("success", "Update Data Berhasil");
                redirect("Dashboard");
            }
        }

    }

    public function deleteData($id_card)
    {
        if ($this->Data_model->deleteDataSiswa($id_card)) {
            $this->session->set_userdata("success", "Data Berhasil Dihapus");
            redirect("Dashboard");
        }
    }

//======================= CRUD SISWA =======================//
    public function tambah_kelas()
    {
        $kelas = $this->input->post("kelas");
        $jurusan = $this->input->post("jurusan");
        $jurusan = str_replace("\"", "", $jurusan);

        if($this->db->insert("tb_kelas", ["kelas" => $kelas, "jurusan" => $jurusan])) {
            $this->session->set_userdata("pesan_edit", "Kelas Berhasil Ditambahkan");
            redirect("Dashboard/setKelas");
        }
    }

    public function update_kelas()
    {
        $kelas = $this->input->post("kelas");
        $jurusan = $this->input->post("jurusan");
        $jurusan = str_replace("\"", "", $jurusan);

        $this->db->where("kelas", $kelas);
        if($this->db->update("tb_kelas", ["kelas" => $kelas, "jurusan" => $jurusan])) {
            $this->session->set_userdata("pesan_edit", "Kelas Berhasil Diupdate");
            redirect("Dashboard/setKelas");
        }

    }

    public function getJurusan()
    {
        $kelas = $this->input->post("kelas");
        $dataKelas = $this->db->get_where("tb_kelas", ["kelas" => $kelas])->row_array();
        $dataKelas = explode(",", $dataKelas["jurusan"]);
        $jurusan = "";
        for ($i = 0; $i < count($dataKelas); $i++) {
            $jurusan .= '<option value="'.trim($dataKelas[$i], " ").'">'.trim($dataKelas[$i], " ").'</option>';
        }

        echo json_encode(["data" => $jurusan]);
        die;
    }
}

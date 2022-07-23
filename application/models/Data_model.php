<?php

class Data_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_absensi = $this->load->database("db_absensi_siswa", TRUE);
    }

    public function getDataSiswaById($id_card)
    {
        $result  = $this->db->get_where("siswa", ["id_card" => $id_card])->result_array();

        if ($result) {
            return [
                "status" => true,
                "data" => $result[0]
            ];
        }else {
            return [
                "status" => false,
                "msg" => "ID Card Tidak ditemukan"
            ];
        }
    }

    public function getDataQRcode()
    {
        return $this->db->get("siswa")->result_array();
    }

    /* CRUD */
    public function getDataSiswa($data)
    {
        if ($data["pil_jurusan"] && $data["pil_kelas"]) {
            if ($data["keyword"]) {
                $this->db->like("nama_siswa", $data["keyword"]);
                $getWhere = ["kelas" => $data["pil_kelas"], "jurusan" => $data["pil_jurusan"]];
                $this->db->where($getWhere);
            }else {
                $getWhere = ["kelas" => $data["pil_kelas"], "jurusan" => $data["pil_jurusan"]];
                $this->db->where($getWhere);
            }
        }

        $this->db->order_by("nama_siswa", "asc");
        return $this->db->get("siswa", $data["limit"], $data["start"])->result_array();
    }

    public function tambahDataSiswa($data)
    {
        return $this->db->insert("siswa", $data);
    }

    public function insertJadwal($data)
    {
        $dataJadwal = $this->db->get_where("jadwal", ["tgl_berlaku" => $data["tgl_berlaku"]]);
        if ($dataJadwal->num_rows()) {
            $this->db->where("tgl_berlaku", $data["tgl_berlaku"]);
            return $this->db->update("jadwal", $data);
        }else {
            return $this->db->insert("jadwal", $data);
        }
    }

    public function updateDataSiswa($data)
    {
        $this->db->where("id_card", $data["id_card"]);
        return $this->db->update("siswa", $data);
    }

    public function deleteDataSiswa($id_card)
    {
        return $this->db->delete('siswa', ["id_card" => $id_card]);
    }    

    /* END CRUD */
    
    public function countAllData()
    {
        return $this->db->get("siswa")->num_rows();
    }

    public function getDataAbsen($data)
    {
        if ($this->cek_table_exists($data["name_table"])) {
            $this->db_absensi->where(["kelas" => $data["kelas"], "jurusan" => $data["jurusan"]]);
            $this->db->where(["kelas" => $data["kelas"], "jurusan" => $data["jurusan"]]);

            $this->db->order_by("nama_siswa", "asc");
            $result["dataSiswa"] = $this->db->get("siswa")->result_array();
            $result["dataAbsen"] = $this->db_absensi->get($data["name_table"])->result_array();
            return ["status" => true, "data" => $result]; 
        }else {
            return ["status" => false];
        }
    }

    public function Presensi($params)
    {
        $name_table = date("Y_m_d");
        $cek_table = $this->db_absensi->get($name_table);

        $data["NIPD"] = $params["NIPD"];
        $data["kelas"] = $params["kelas"];
        $data["jurusan"] = $params["jurusan"];
   
        if ($cek_table->num_rows()) {

            $data_siswa = $this->db_absensi->get_where($name_table, ["NIPD" => $params["NIPD"]])->result_array();

            if ($data_siswa) {
                $dataSiswa = $this->db->get_where("siswa", ["NIPD" => $data_siswa[0]["NIPD"]])->result_array();
                $dataSiswa[0]["jam_masuk"] = $data_siswa[0]["jam_masuk"];

                if (!$data_siswa[0]["jam_pulang"]) {
                    $jam = strtotime(date("H:i"));
                    $dataJadwal = $this->db->get_where("jadwal", ["tgl_berlaku" => date("Y-m-d")]);
                    if ($dataJadwal->num_rows()) {

                        if ($jam >= intval($dataJadwal->result_array()[0]["jam_pulang"])) {
                            $data_siswa[0]["jam_pulang"] = date("H:i:s");
                            $dataSiswa[0]["jam_pulang"] = $data_siswa[0]["jam_pulang"];
                            $this->db_absensi->where("NIPD", $data_siswa[0]["NIPD"]);
                            $this->db_absensi->update($name_table, $data_siswa[0]);
                            $dataSiswa[0]["baru_absen_pulang"] = true;
                            return ["status" => false, "data" => $dataSiswa[0]];
                        }else {
                            return ["status" => false, "data" => $dataSiswa[0]];
                        }

                    }else {

                        if ($jam >= strtotime("14:00")) {
                            $data_siswa[0]["jam_pulang"] = date("H:i:s");
                            $dataSiswa[0]["jam_pulang"] = $data_siswa[0]["jam_pulang"];
                            $this->db_absensi->where("NIPD", $data_siswa[0]["NIPD"]);
                            $this->db_absensi->update($name_table, $data_siswa[0]);
                            $dataSiswa[0]["baru_absen_pulang"] = true;
                            return ["status" => false, "data" => $dataSiswa[0]];
                        }else {
                            return ["status" => false, "data" => $dataSiswa[0]];
                        }

                    }

                }else {
                    $dataSiswa[0]["jam_pulang"] = $data_siswa[0]["jam_pulang"];
                    $dataSiswa[0]["sudah_absen_pulang"] = true;
                    return ["status" => false, "data" => $dataSiswa[0]];
                }

            }else {
                $data["jam_masuk"] = $params["time"];
                $data["keterangan"] = $params["ket"];
                $this->db_absensi->insert($name_table, $data);
                return ["status" => true];
            }

        }else {
            $data["jam_masuk"] = $params["time"];
            $data["keterangan"] = $params["ket"];
            $this->db_absensi->insert($name_table, $data);          
            return ["status" => true];
        }
    }
    
    public function buat_table_mingguan($D)
    {
        $date = new DateTime($D);
        $isMonday = true;
        while ($isMonday) {
            if (strtolower($date->format("l")) == "monday") {
                $isMonday = false;
                for ($i=1; $i <= 6; $i++) { 
                    $name_table = strtolower($date->format("Y_m_d"));
                    $create_table = "CREATE TABLE IF NOT EXISTS $name_table (".
                                        "NIPD varchar(100) PRIMARY KEY,".
                                        "kelas varchar(100),".
                                        "jurusan varchar(100),".
                                        "jam_masuk varchar(100),".
                                        "jam_pulang varchar(100),".
                                        "keterangan varchar(100)".
                                    ")";
                    $this->db_absensi->query($create_table);
                    $date->modify("+1 days");
                }
            }else {
                $date->modify("-1 days");
            }
        }
    }

    // public function buat_table_jadwal($name_table)
    // {
    //     $create_table = "CREATE TABLE IF NOT EXISTS jadwal_$name_table (".
    //                                     "jam_pulang varchar(100)".
    //                                 ")";
    //     $this->dbjadwal->query($create_table);
    // }
    
    // public function create_table_absensi($query)
    // {
    //     return $this->db_absensi->query($query);
    // }

    public function cek_table_exists($name_table)
    {
        return $this->db_absensi->query("SHOW TABLES LIKE '%".$name_table."%'")->num_rows();
    }
}
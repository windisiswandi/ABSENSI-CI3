<?php

class Data_akun extends CI_Model {
    public $_errorLogin = [];

    public function cekUser() {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $result = $this->db->get_where("akun", ["username" => $username])->result_array();

    
        if ($result) {
            if ($result[0]["password"] == $password) {
                return true;
            }else {
                $this->_errorLogin["password"] = true;
                return false;
            }
        }else {
            $this->_errorLogin["username"] = true;
            return false;
        }
        
    }

    public function register($token)
    {
        $data = [
            "username" => $this->input->post("username"),
            "password" => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
            "email" => $this->input->post("email"),
            "level" => 1,
            "status" => null
        ];

        $user_token = [
            "email" => $this->input->post("email"),
            "token" => $token,
            "date_created" => time()
        ];

        $this->db->insert("akun", $data);
        $this->db->insert("user_token", $user_token);
        $this->session->set_userdata("success", "Ditambahkan");
    }
}
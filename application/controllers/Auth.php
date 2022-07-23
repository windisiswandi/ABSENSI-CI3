<?php

class Auth extends CI_Controller {
    protected $_data = [];

    function __construct()
    {
        parent::__construct();
        $this->load->model("Data_akun", "akun");
        $this->load->model("Data_model");
        $this->load->library("form_validation");
    }

    public function login()
    {
        $this->_data["title"] = "Login";

        if ($this->input->post("login")) {
            if ($this->akun->cekUser()) {
                $this->session->set_userdata('login', $this->input->post("password"));
                redirect("Dashboard");
            }else {
                $this->_data["error"] = $this->akun->_errorLogin;
                $this->load->view("AuthTemplate/header", $this->_data);
                $this->load->view("Auth/login", $this->_data);
                $this->load->view("AuthTemplate/footer");
            }
        }else {
            if ($this->session->userdata('login')) {
                redirect("Dashboard");
            } else {
                $this->load->view("AuthTemplate/header", $this->_data);
                $this->load->view("Auth/login", $this->_data);
                $this->load->view("AuthTemplate/footer");
            }
        }
    }

    // public function register()
    // {
    //     $this->_data["title"] = "Register";
    //     $this->form_validation->set_rules("username", "Username", "required");
    //     $this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[akun.email]", ["is_unique" => "This Email has already registered"]);
    //     $this->form_validation->set_rules("password", "Username", "required|min_length[5]");
    //     $this->form_validation->set_message("required", "Field ini tidak boleh kosong");
    //     $this->form_validation->set_message("valid_email", "Email not valid");
    //     $this->form_validation->set_message("min_length", "Password length must be 5 characters");

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view("AuthTemplate/header", $this->_data);
    //         $this->load->view("Auth/register");
    //         $this->load->view("AuthTemplate/footer");
    //     }else{
    //         $token = base64_encode(random_bytes(32));
    //         $this->_sendEmail($token, "verify");
    //         $this->akun->register($token);
    //     }
    // }

    // private function _sendEmail($token, $type)
    // {
    //     $email = $this->input->post("email");
    //     if ($type === "verify") {
    //         $config = [
    //             'protocol'  => 'smtp',
    //             'mailpath'  => '/usr/sbin/sendmail',
    //             'smtp_host' => 'ssl://smtp.googlemail.com',
    //             'smtp_user' => 'twinner400@gmail.com',  
    //             'smtp_pass' => 'adijayaplus62',  
    //             'smtp_port' => 465,
    //             'mailtype'  => 'html',
    //             'charset'   => 'utf-8',
    //             'newline' => "\r\n"
    //         ];
            
    //         $this->email->initialize($config);
            
    //         $this->email->from("twinner400@gmail.com", "admin");
    //         $this->email->to($email);
    //         $this->email->subject("Account Veryfication");
    //         $this->email->message("Click link to actived your account : <br><a href='". base_url()."Auth/verify?email=".$email."&token=".$token."'>". $token ."</a>");
            
             
    //         if ($this->email->send()) {
    //             return true;
    //         }else {
    //             echo $this->email->print_debugger();
    //             die;
    //         }
    //     }
    // }

    public function tes()
    {
        $this->load->view("templates/header");
        $this->load->view("Dashboard/tes");
        $this->load->view("templates/footer");
    }
}
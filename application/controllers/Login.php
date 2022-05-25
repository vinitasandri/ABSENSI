<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUsers');
    }

    public function index()
    {
        if($this->session->userdata('login_admin') == true || $this->session->userdata('login_pegawai') == true){
            redirect(base_url('dashboard'));
        }
        $this->load->view('login/login_page');
    }

    public function process()
    {   
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');

        //ambil data dari dari database berdasarkan email
        $getDataUser = $this->ModelUsers->getDataUsersByEmail($email);

        if ($getDataUser > 0) {
            // ambil password dari database berdasarkan email
            $userPass = $getDataUser['password'];

            //cek password yang di input dengan password didatabase
            if (password_verify($pass, $userPass)) {
                //cek role user
                $role = $getDataUser['role'];
                if ($role == 1) {
                    //login admin
                    $this->session->set_userdata('login_admin', true);
                    $this->session->set_userdata('username_session', $getDataUser['username']);
                    $this->session->set_userdata('email_session', $getDataUser['email']);
                    $this->session->set_userdata('full_name_session', $getDataUser['nama_lengkap']);
                    redirect(base_url('dashboard'));
                } else if ($role == 0) {
                    //login pegawai
                    $this->session->set_userdata('login_pegawai', true);
                    $this->session->set_userdata('username_session', $getDataUser['username']);
                    $this->session->set_userdata('email_session', $getDataUser['email']);
                    $this->session->set_userdata('full_name_session', $getDataUser['nama_lengkap']);
                    redirect(base_url('dashboard'));
                }
            } else {
                $this->session->set_flashdata('icon', 'warning');
                $this->session->set_flashdata('text', 'Password anda tidak cocok !');
                $this->session->set_flashdata('title', 'Login Gagal !');
                redirect(base_url('login'));
            }
        } else {
            $this->session->set_flashdata('icon', 'warning');
            $this->session->set_flashdata('text', 'Email tidak ditemukan !');
            $this->session->set_flashdata('title', 'Login Gagal !');
            redirect(base_url('login'));
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}

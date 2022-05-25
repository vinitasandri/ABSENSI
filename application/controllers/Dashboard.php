<?php

    class Dashboard extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            if($this->session->userdata('login_admin') == true || $this->session->userdata('login_pegawai') == true){
                
            }else{
                redirect(base_url('login'));
            }
            $this->load->model('ModelUsers');
            $this->load->model('ModelShift');
            $this->load->model('ModelJabatan');
            $this->load->model('ModelAbsensi');
        }

        public function index(){
            $date = date('Y-m-d');
            $data= array(
                "breadcumb"     => "Data Shift",
                "title"         => "Dashboard - PT. Vinita",
                "shift_index"   => "active",
                "data_absensi"  => $this->ModelAbsensi->getDataAbsensi($date),
                "data_pegawai"  => $this->ModelUsers->getDataKaryawanVerified(1),
                "data_sudahpresensi"    => $this->ModelAbsensi->getDataAbsensiByStatus('Hadir',$date),
                "data_belumpresensi"    => $this->ModelAbsensi->getDataAbsensiByStatus('Tidak',$date),
                "data_izinpresensi"     => $this->ModelAbsensi->getDataAbsensiByStatus('Izin',$date),
                "data_terlambat"        => $this->ModelAbsensi->getDataAbsensiByTime($date)
            );

            $this->load->view('layout/header',$data);
            $this->load->view('layout/sidebar');
            $this->load->view('layout/navbar');
            $this->load->view('dashboard/index');
            $this->load->view('layout/footer');
        }

        public function logout(){
            session_destroy();
            redirect(base_url());
        }

       
    }
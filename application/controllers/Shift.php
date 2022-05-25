<?php


    class Shift extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('ModelShift');
        }

        public function add_data(){
            $keterangan = $this->input->post('keterangan');
            $check_in = $this->input->post('check_in');
            $check_out = $this->input->post('check_out');

            if($keterangan != null && $check_in != null && $check_out){
                $data = array(
                    'keterangan'    => $keterangan,
                    'check_in'      => $check_in,
                    'check_out'     => $check_out
                );
                $this->ModelShift->addData($data);
                $this->session->set_flashdata('icon', 'success');
                $this->session->set_flashdata('text', 'Tambah Data Shift berhasil !');
                $this->session->set_flashdata('title', 'Sukses !!');
                redirect(base_url('dashboard/list_shift/'));
            }else{
                $this->session->set_flashdata('icon', 'warning');
                $this->session->set_flashdata('text', 'Data Harus Lengkap !!');
                $this->session->set_flashdata('title', 'Tambah Gagal !');
                redirect(base_url('dashboard/list_shift/'));
            }
        }

        public function update_data(){
            $id_shift = $this->input->post('id_shift');
            $keterangan = $this->input->post('keterangan');
            $check_in = $this->input->post('check_in');
            $check_out = $this->input->post('check_out');

            if($keterangan != null && $check_in != null && $check_out){
                $data = array(
                    'keterangan'    => $keterangan,
                    'check_in'      => $check_in,
                    'check_out'     => $check_out
                );
                $this->ModelShift->updateData($data,$id_shift);
                $this->session->set_flashdata('icon', 'success');
                $this->session->set_flashdata('text', 'Tambah Data Shift berhasil !');
                $this->session->set_flashdata('title', 'Sukses !!');
                redirect(base_url('dashboard/list_shift/'));
            }else{
                $this->session->set_flashdata('icon', 'warning');
                $this->session->set_flashdata('text', 'Data Harus Lengkap !!');
                $this->session->set_flashdata('title', 'Tambah Gagal !');
                redirect(base_url('dashboard/list_shift/'));
            }
        }

        public function delete_data(){
            $id = $this->uri->segment(3);
            $this->ModelShift->deleteData($id);
            $this->session->set_flashdata('icon', 'success');
            $this->session->set_flashdata('text', 'Update Data Shift berhasil !');
            $this->session->set_flashdata('title', 'Sukses !!');
            redirect(base_url('dashboard/list_shift/'));
        }
    }
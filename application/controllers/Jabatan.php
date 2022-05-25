<?php

    class Jabatan extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('ModelJabatan');
        }

        public function add_jabatan(){
            $nama = $this->input->post("nama");
            $gaji = $this->input->post("gaji");

            if($nama != null && $gaji != null){
                $data = array(
                    "id_jabatan"        => "",
                    "nama_jabatan"      => $nama,
                    "gaji"              => $gaji
                );
                $this->ModelJabatan->addData($data);
                $this->session->set_flashdata('icon', 'success');
                $this->session->set_flashdata('text', 'Tambah Data Jabatan berhasil !');
                $this->session->set_flashdata('title', 'Sukses !!');
                redirect(base_url('home/list_jabatan/'));
            }else{
                $this->session->set_flashdata('icon', 'warning');
                $this->session->set_flashdata('text', 'Data Harus Lengkap !!');
                $this->session->set_flashdata('title', 'Tambah Gagal !');
                redirect(base_url('home/list_jabatan/'));
            }
        }

        public function update_jabatan(){
            $id_jabatan = $this->input->post("id_jabatan");
            $nama = $this->input->post("nama");
            $gaji = $this->input->post("gaji");

            if($nama != null && $gaji != null){
                $data = array(
                    "nama_jabatan"      => $nama,
                    "gaji"              => $gaji
                );
                $this->ModelJabatan->updateData($data,$id_jabatan);
                $this->session->set_flashdata('icon', 'success');
                $this->session->set_flashdata('text', 'Update Data Jabatan berhasil !');
                $this->session->set_flashdata('title', 'Sukses !!');
                redirect(base_url('home/list_jabatan/'));
            }else{
                $this->session->set_flashdata('icon', 'warning');
                $this->session->set_flashdata('text', 'Data Harus Lengkap !!');
                $this->session->set_flashdata('title', 'Update Gagal !');
                redirect(base_url('home/list_jabatan/'));
            }
        }

        public function delete_jabatan(){
            $id = $this->uri->segment(3);
            $this->ModelJabatan->deleteData($id);
            $this->session->set_flashdata('icon', 'success');
            $this->session->set_flashdata('text', 'Delete Data Jabatan berhasil !');
            $this->session->set_flashdata('title', 'Sukses !!');
            redirect(base_url('home/list_jabatan/'));
        }
    }
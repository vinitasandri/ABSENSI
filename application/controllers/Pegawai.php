<?php

class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUsers');
        $this->load->model('ModelProfile');
    }

    public function addPegawai()
    {
        $nama = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $email = $this->input->post('email');
        $no_hp = $this->input->post('no_hp');
        $jabatan = $this->input->post('jabatan');

        if ($nama != null && $nik != null && $email != null && $no_hp != null && $jabatan != null) {
            $cekData = $this->ModelUsers->cekDataPegawai(0);
            if ($cekData == null) {
                $id_pegawai = "2020030020";
            } else {
                $getDataPegawai = $cekData['no_pegawai'];
                $number = substr($getDataPegawai, 4, 2);
                $newNumber = $number + 1;
                if (strlen($newNumber) == 1) {
                    $newId = "0" . $newNumber;
                } else {
                    $newId = $newNumber;
                }
                $id_pegawai = "2020" . $newId . '0020';
            }


            $addData = array(
                'no_pegawai'    => $id_pegawai,
                'nama_lengkap'  => $nama,
                'email'         => $email,
                'no_telp'       => $no_hp,
                'nik'           => $nik
            );
            $this->ModelUsers->insertUsers($addData);
            $getNewData = $this->db->get_where('tb_users', array('no_pegawai' => $id_pegawai))->row_array();
            $id_users = $getNewData['id_users'];

            $addDetail = array(
                'users_id'      => $id_users,
                'id_jabatan'    => $jabatan,
                'check_in'      => "08:00",
                'check_out'     => "16:00"
            );


            $this->ModelUsers->inserDetail($addDetail);
            $this->session->set_flashdata('icon', 'success');
            $this->session->set_flashdata('text', 'Data Pegawai Berhasil Ditambahkan');
            $this->session->set_flashdata('title', 'Tambah Sukses !');
            redirect(base_url('home/list_pegawai/'));
        } else {
            $this->session->set_flashdata('icon', 'warning');
            $this->session->set_flashdata('text', 'Data Harus Lengkap');
            $this->session->set_flashdata('title', 'Tambah Gagal !');
            redirect(base_url('home/list_pegawai/'));
        }
    }

    public function updatePegawai()
    {
        $nama = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $email = $this->input->post('email');
        $no_hp = $this->input->post('no_hp');
        $jabatan = $this->input->post('jabatan');
        $no_pegawai = $this->input->post('no_pegawai');
        if ($nama != null && $nik != null && $email != null && $no_hp != null && $jabatan != null) {
            $data = array(
                'nama_lengkap'  => $nama,
                'email'         => $email,
                'no_telp'       => $no_hp,
                'nik'           => $nik
            );

            $dataDetail = array(
                'id_jabatan'    => $jabatan
            );
            $getNewData = $this->db->get_where('tb_users', array('no_pegawai' => $no_pegawai))->row_array();
            $id_users = $getNewData['id_users'];
            $this->ModelProfile->updateDetailProfile($dataDetail, $id_users);
            $this->ModelUsers->updateUsers($data, $id_users);
            $this->session->set_flashdata('icon', 'success');
            $this->session->set_flashdata('text', 'Data Pegawai Berhasil Diperbarui');
            $this->session->set_flashdata('title', 'Update Sukses !');
            redirect(base_url('home/list_pegawai/'));
        } else {
            $this->session->set_flashdata('icon', 'warning');
            $this->session->set_flashdata('text', 'Data Harus Lengkap');
            $this->session->set_flashdata('title', 'Tambah Gagal !');
            redirect(base_url('home/list_pegawai/'));
        }
    }

    public function verifikasi_data()
    {
        $id_user = $this->input->post('id_users');
        $getDataPegawai = $this->db->get_where('tb_users',array('id_users'=> $id_user))->row_array();
        $no_pegawai = $getDataPegawai['no_pegawai'];
        $email = $getDataPegawai['email'];
        $full_name = $getDataPegawai['nama_lengkap'];

        $this->sendEmail($no_pegawai,$email,$full_name);

        $updateVerified = array(
            'is_verified'    => 2
        );
        $this->ModelUsers->updateUsers($updateVerified, $id_user);
        $this->session->set_flashdata('icon', 'success');
        $this->session->set_flashdata('text', 'Data Karyawan berhasil di verifikasi');
        $this->session->set_flashdata('title', 'Verifikasi Sukses !');
        redirect(base_url('home/verifikasi_pegawai/'));
    }

    public function deletePegawai()
    {
        $id_user = $this->uri->segment(3);
        $halaman = $this->uri->segment(4);
        if ($halaman == 'list') {
            $this->ModelUsers->deleteUsers($id_user);
            $this->session->set_flashdata('icon', 'success');
            $this->session->set_flashdata('text', 'Data Karyawan berhasil di hapus');
            $this->session->set_flashdata('title', 'Hapus Berhasil !');
            redirect(base_url('home/list_pegawai/'));
        } else {
            $this->ModelUsers->deleteUsers($id_user);
            $this->session->set_flashdata('icon', 'success');
            $this->session->set_flashdata('text', 'Data Karyawan berhasil di hapus');
            $this->session->set_flashdata('title', 'Hapus Berhasil !');
            redirect(base_url('home/verifikasi_pegawai/'));
        }
    }

    public function verifDevice()
    {
        $id = $this->uri->segment(3);

        $data = array(
            'status'    => 2
        );

        $getDataChange = $this->ModelUsers->getDataChangeDeviceByIdDevice($id);
        $newDevice = $getDataChange['new_deviceid'];
        $id_user = $getDataChange['id_users'];

        $updateDevice = array(
            'device_id'   => $newDevice
        );

        $this->ModelUsers->updateStatus($data, $id);
        $this->ModelUsers->updateUsers($updateDevice, $id_user);
        $this->session->set_flashdata('icon', 'success');
        $this->session->set_flashdata('text', 'Perangkat berhasil diverifikasi');
        $this->session->set_flashdata('title', 'Verifikasi Berhasil !');
        redirect(base_url('home/verifikasi_perangkat'));
    }

    public function sendEmail($no_pegawai,$email,$full_name)
    {
      
        $config['useragent'] = 'CodeIgniter';
        $config['protocol'] = 'smtp';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'primamandiri1991@gmail.com';
        $config['smtp_pass'] = 'prima2020';
        $config['smtp_port'] = 465;
        $config['smtp_timeout'] = 5;
        $config['wordwrap'] = TRUE;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = FALSE;
        $config['priority'] = 3;
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['bcc_batch_mode'] = FALSE;
        $config['bcc_batch_size'] = 200;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('restuprimandiri@gmail.com', 'Admin RPM');
        $this->email->to($email);

        $this->email->subject('Konfirmasi Akun');
        $data = array(
            'no_pegawai'    => $no_pegawai,
            'nama_lengkap'  => $full_name
        );
        $body = $this->load->view('dashboard/email/email',$data,TRUE);
        $this->email->message($body);

        $this->email->send();
    }
}

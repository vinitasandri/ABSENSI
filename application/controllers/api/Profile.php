<?php

use chriskacerguis\RestServer\RestController;
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

class Profile extends RestController{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelProfile');
        $this->load->model('ModelUsers');
    }

    public function updateImageProfile_post(){
        $image = $_FILES['image']['name'];
        $id_pegawai = $this->input->post('id_users');
        $data_users = $this->db->get_where('tb_users',array('no_pegawai' => $id_pegawai))->row_array();
        $id_users = $data_users['id_users'];
        
        
        $config['upload_path']          = './assets/image_profile/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';

        $this->upload->initialize($config);

        if($this->upload->do_upload('image')){
            $data = array(
                'foto'         => $image,
            );
            $this->ModelProfile->updateDetailProfile($data,$id_users);
            $this->response([
                'message'   => "Foto Profil berhasil diperbarui",
                'status'    => true
            ],200);
        }else{
            
            $this->response([
                'message'   => "Foto Profil gagal diperbarui",
                'status'    => false
            ],200);
        }
    }
}
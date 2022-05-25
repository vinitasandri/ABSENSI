<?php

    class ModelProfile extends CI_Model{

        public function updateDetailProfile($data,$id_users){
            return $this->db->update('tb_detail_users',$data,array('users_id' => $id_users));
        }
    }
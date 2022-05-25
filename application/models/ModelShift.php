<?php

    class ModelShift extends CI_Model{
        public function getDataShift(){
            return $this->db->get('tb_shift')->result_array();
        }

        public function addData($data){
            return $this->db->insert("tb_shift",$data);
        }

        public function updateData($data,$id_shift){
            return $this->db->update('tb_shift',$data,array('id_shift' => $id_shift));
        }

        public function deleteData($id){
            return $this->db->delete("tb_shift",array("id_shift" => $id));
        }
    }
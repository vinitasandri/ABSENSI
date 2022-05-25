<?php 

    class ModelJabatan extends CI_Model{

        public function readDataJabatan(){
            return $this->db->get('tb_jabatan')->result_array();
        }

        public function addData($data){
            return $this->db->insert("tb_jabatan",$data);
        }

        public function updateData($data,$id_jabatan){
            return $this->db->update('tb_jabatan',$data,array("id_jabatan" => $id_jabatan));
        }

        public function deleteData($id){
            return $this->db->delete('tb_jabatan',array("id_jabatan" => $id));
        }
    }
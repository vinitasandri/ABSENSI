<?php

    class ModelQr extends CI_Model{

        public function insertData($data){
            return $this->db->insert('tb_qrcode',$data);
        }

        public function getDataQrByDate($id_pegawai,$date){
            return $this->db->get_where('tb_qrcode',array('id_pegawai' => $id_pegawai,'date' => $date))->row_array();
        }
    }
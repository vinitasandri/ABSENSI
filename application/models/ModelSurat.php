<?php

    class ModelSurat extends CI_Model{
        public function addSuratIzin($data){
            return $this->db->insert('tb_surat_tidak_hadir',$data);
        }

        public function getDataIzinByIdUsers($id_users,$date){
            return $this->db->get_where('tb_surat_tidak_hadir',array('id_users' => $id_users,'tanggal'=>$date))->row_array();
        }

        public function getAllDataSuratIzinByIdUsers($id_users,$date){
            $sql = "SELECT * FROM tb_surat_tidak_hadir 
                        JOIN tb_users  ON tb_surat_tidak_hadir.id_users = tb_users.id_users 
                        JOIN tb_absensi ON tb_surat_tidak_hadir.id_absensi = tb_absensi.id_absensi WHERE 
                        tb_surat_tidak_hadir.id_users = ? AND
                        MONTH(tb_surat_tidak_hadir.tanggal) = ?";

            return $this->db->query($sql,array($id_users,$date))->result_array();
        }

        public function getDataSuratByStatus($status){
            $sql = "SELECT * FROM tb_surat_tidak_hadir 
                        JOIN tb_users ON tb_surat_tidak_hadir.id_users = tb_users.id_users
                        JOIN tb_absensi ON tb_surat_tidak_hadir.id_absensi = tb_absensi.id_absensi 
                        JOIN tb_detail_users ON tb_users.id_users = tb_detail_users.users_id 
                        JOIN tb_jabatan ON tb_detail_users.id_jabatan = tb_jabatan.id_jabatan WHERE
                        tb_surat_tidak_hadir.status_surat = ?";
            return $this->db->query($sql,$status)->result_array();
        }

        public function updateData($changeSuratIzin,$id_absensi){
            return $this->db->update('tb_surat_tidak_hadir',$changeSuratIzin,array('id_absensi'=>$id_absensi));
        }

        // CUTI

        public function getDataCutiByIdUsers($id_users){
            return $this->db->get_where('tb_cuti',array('id_users' => $id_users))->row_array();
        }

        public function insertSuratCuti($data){
            return $this->db->insert('tb_cuti',$data);
        }

        public function getTotalCutiByIdUsers($id_users){
            $sql = "SELECT SUM(jumlah_hari)as total FROM tb_cuti
                        WHERE id_users = ? AND
                        status = ?";
            return $this->db->query($sql,array($id_users,2))->row_array();
        }

        public function getDataSisaCutiByIdUsers($id_users,$year){
            $sql = "SELECT sum(jumlah_hari)as total FROM tb_cuti WHERE
                        id_users = ? AND
                        YEAR(dari_tanggal) = ? AND
                        YEAR(sampai_tanggal) = ? AND
                        status = ? ";
            return $this->db->query($sql,array($id_users,$year,$year,2))->row_array();
        }

        public function getAllDataCutiByIdUsers($id_users,$year){
            $sql = "SELECT * FROM tb_cuti 
                        JOIN tb_users ON tb_cuti.id_users = tb_users.id_users 
                        WHERE tb_cuti.id_users = ? AND
                              YEAR(dari_tanggal) = ? AND
                              YEAR(sampai_tanggal) = ? ORDER BY status desc";
            return $this->db->query($sql,array($id_users,$year,$year))->result_array();

        }

        public function getAllDataCutiByStatus(){
            $sql = "SELECT * FROM tb_cuti 
                        JOIN tb_users ON tb_cuti.id_users = tb_users.id_users 
                        JOIN tb_detail_users ON tb_users.id_users = tb_detail_users.users_id 
                        JOIN tb_jabatan ON tb_detail_users.id_jabatan = tb_jabatan.id_jabatan 
                        WHERE status = ?";
            return $this->db->query($sql,0)->result_array();
        }

        public function updateDataCuti($updateStatus,$idCuti){
            return $this->db->update('tb_cuti',$updateStatus,array('id_cuti' => $idCuti));
        }

        public function getDataCutiByIdCuti($idCuti){
            return $this->db->get_where('tb_cuti',array('id_cuti' => $idCuti))->row_array();
        }

        public function deleteCuti($id_cuti){
            return $this->db->delete('tb_cuti',array('id_cuti'=> $id_cuti));
        }

        //REVISI EVA
        public function getAllDataSuratIzinByIdUsersNew($id_users,$starDate,$end_date){
            $sql = "SELECT * FROM tb_surat_tidak_hadir 
                        JOIN tb_users  ON tb_surat_tidak_hadir.id_users = tb_users.id_users 
                        JOIN tb_absensi ON tb_surat_tidak_hadir.id_absensi = tb_absensi.id_absensi WHERE 
                        tb_surat_tidak_hadir.id_users = ? AND
                        (date BETWEEN ? AND ?) ";

            return $this->db->query($sql,array($id_users,$starDate,$end_date))->result_array();
        }
        //REVISI EVA

        //REVISI EKA
        public function getHariNasional($firstDate,$secondDate){
            $sql = "SELECT date FROM tb_absensi WHERE 
                        (date BETWEEN ? AND ? ) AND
                        status = ? GROUP BY date";
            return $this->db->query($sql,array($firstDate,$secondDate,'Libur Nasional'))->result_array();
        }

        public function cekJadwal($start_date,$end_date){
            $sql = "SELECT * FROM tb_absensi WHERE 
                        (date BETWEEN ? AND ?)";
            return $this->db->query($sql,array($start_date,$end_date))->result_array();
        }
        //REVISI EKA
    }
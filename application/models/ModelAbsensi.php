<?php

    class ModelAbsensi extends CI_Model{
        public function getDataAbsensi($date){
            return $this->db->get_where('tb_absensi',array('date' => $date))->result_array();
        }

        public function getDataAbsensiByDateAndStatus($date,$status){
            return $this->db->get_where('tb_absensi',array('date' => $date,'status' => $status))->result_array();
        }

        public function insertAbsensiAll($data){
            return $this->db->insert_batch('tb_absensi',$data);
        }

        public function insertAbsensi($data){
            return $this->db->insert('tb_absensi',$data);
        }

        public function getDataAbsensiByStatus($status,$date){
            return $this->db->get_where('tb_absensi',array('status' => $status,'date' => $date))->result_array();
        }

        public function getDataAbsensiByTime($date){
            $sql = "SELECT * FROM tb_absensi WHERE check_in > '08:00:00' AND date = ?";
            return $this->db->query($sql,$date)->result_array();
        }

        public function updateAbsensi($data,$id_users,$date){
            return $this->db->update('tb_absensi',$data,array('id_users' => $id_users,'date' => $date));
        }

        public function getDataAbsensiByIdUsers($id_users,$date){
            return $this->db->get_where('tb_absensi',array('id_users' => $id_users,'date' => $date))->row_array();
        }

        public function getDataAbsensiByIdUsersAll($id_users,$date){
            return $this->db->get_where('tb_absensi',array('id_users' => $id_users,'date' => $date))->result_array();
        }

        //getDataCuti
        public function getDataAbsensiByIdUserAndStatus($id_users,$starDate,$end_date,$status){
            $sql = "SELECT * FROM tb_absensi 
                        WHERE
                        (date BETWEEN ? AND ?) AND
                        status = ? AND
                        id_users = ?";
            return $this->db->query($sql,array($starDate,$end_date,$status,$id_users))->result_array();
        }

        public function getDataAbsensiByDate($date){
            return $this->db->get_where('tb_absensi',array('date' => $date))->row_array();
        }

        public function getDataAbsensiByBulan($month){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE 
                        tb_absensi.id_users =  tb_users.id_users AND
                        MONTH(tb_absensi.date) = ? ORDER BY date DESC";
            return $this->db->query($sql,$month)->result_array();
        }
        public function getDataAbsensiByRangeBulan($starDate,$endDate){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE 
                        tb_absensi.id_users =  tb_users.id_users AND
                        (date BETWEEN ? AND ?)  ORDER BY date DESC";
            return $this->db->query($sql,array($starDate,$endDate))->result_array();
        }

        public function getDataAbsensiByBulanAndId($month,$id_users){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE 
                        tb_absensi.id_users =  tb_users.id_users AND
                        tb_absensi.id_users = ? AND
                        MONTH(tb_absensi.date) = ? ORDER BY date DESC";
            return $this->db->query($sql,array($id_users,$month))->result_array();
        }

        public function getDataLaporanKehadiran($id_users,$month){
            $sql = "SELECT * FROM tb_absensi WHERE 
                        id_users = ? AND
                        MONTH(date) = ? ORDER BY date";
            return $this->db->query($sql,array($id_users,$month))->result_array();
        }

        public function getDataHadir($id_users,$month,$status){
            $sql = "SELECT COUNT(id_users)as jumlah FROM tb_absensi WHERE 
                        id_users = ? AND
                        MONTH(date) = ? AND
                        status = ?";
            return $this->db->query($sql,array($id_users,$month,$status))->row_array();
        }

        public function getCountAbsensi($id_users,$month){
            $sql = "SELECT COUNT(id_users)as jumlah FROM tb_absensi WHERE 
                        id_users = ? AND
                        MONTH(date) = ? ";
            return $this->db->query($sql,array($id_users,$month))->row_array();
        }


        public function getDataAbsensiGroup($month){
            $sql = "SELECT * 
                         FROM tb_absensi,tb_users WHERE
                        tb_absensi.id_users = tb_users.id_users  AND
                        MONTH(tb_absensi.date) = ?  GROUP BY tb_absensi.id_users";
            return $this->db->query($sql,$month)->result_array();
        }
        public function getDataKehadiranByStatus($month,$status,$id_users){
            $sql = "SELECT COUNT(status) as jumlah FROM tb_absensi WHERE
                        MONTH(date) = ? AND
                        status = ? AND
                        tb_absensi.id_users = $id_users GROUP BY id_users";
            return $this->db->query($sql,array($month,$status))->row_array();
        }

        public function getDataAbsensiByIdUsersGroup($month,$id_users){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE
                        tb_absensi.id_users = tb_users.id_users  AND
                        MONTH(tb_absensi.date) = ? AND
                        tb_absensi.id_users = $id_users GROUP BY tb_absensi.id_users";
            return $this->db->query($sql,$month)->row_array();
        }

        public function getDataKehadiranTelat($month,$id_users){
            $sql = "SELECT SUM(is_late) as jumlah FROM tb_absensi WHERE
                        MONTH(date) = ? AND
                        id_users = $id_users";
            return $this->db->query($sql,$month)->row_array();
        }

        public function updateUangMakan($updateUangMakan,$id_absensi){
            return $this->db->update('tb_uangmakan',$updateUangMakan,array('id_absensi' => $id_absensi));
        }

        public function addUangMakan($data){
            return $this->db->insert('tb_uangmakan',$data);
        }
        public function addUangMakanBatch($data){
            return $this->db->insert_batch('tb_uangmakan',$data);
        }

        public function getDataAbsensiLast(){
            $sql = "SELECT * FROM tb_absensi ORDER BY id_absensi DESC";
            return $this->db->query($sql)->row_array();
        }

        //Jadwal kerja
        public function getJadwalKerja(){
            $sql = "SELECT * FROM tb_absensi GROUP BY work_day order by work_day DESC";
            return $this->db->query($sql)->result_array();
        }

        public function getJadwalKerjaGroup($work_day,$month,$year){
            $sql = "SELECT * FROM tb_absensi
                        WHERE work_day = ? AND 
                        MONTH(date) = ? AND 
                        YEAR(date) = ?
                         GROUP BY work_day";
            return $this->db->query($sql,array($work_day,$month,$year))->row_array();
        }

        public function getJumlahHari($status){
            $sql = "SELECT *  FROM tb_absensi WHERE work_day = ? GROUP BY date";
            return $this->db->query($sql,$status)->result_array();
        }
        public function getJumlahHariByMonth($status,$month,$year){
            $sql = "SELECT *  FROM tb_absensi 
                        WHERE 
                            work_day = ?  AND
                            MONTH(date) = ? AND 
                            YEAR(date) = ?GROUP BY date";
            return $this->db->query($sql,array($status,$month,$year))->result_array();
        }

        public function getDataAbsensiByMonthAsc($month){
            $sql = "SELECT * FROM tb_absensi WHERE 
                        MONTH(date) = ? ORDER BY date asc";
            return $this->db->query($sql,$month)->row_array();
        }

        

        public function getDataLaporanKehadiranByBetweenDate($id_users,$starDate,$endDate){
            $sql = "SELECT * FROM tb_absensi 
                        WHERE (date BETWEEN ? AND ?) AND
                        id_users = ? ORDER BY date asc;
                    ";
            return $this->db->query($sql,array($starDate,$endDate,$id_users))->result_array();
        }

        public function getDataHadirByBetween($id_users,$startDate,$endDate,$status){
            $sql = "SELECT * FROM tb_absensi 
                        WHERE (date BETWEEN ? AND ?) AND
                        id_users = ? AND
                        status = ?";
            return $this->db->query($sql,array($startDate,$endDate,$id_users,$status))->result_array();
        }

        public function getDataAbsensiByRangeDate($starDate,$endDate){
            $sql = "SELECT * FROM tb_absensi WHERE
                    (date BETWEEN ? AND ?)";
            return $this->db->query($sql,array($starDate,$endDate))->result_array();
        }

        public function getJadwalKerjaGroupByDate($status,$month,$year){
            $sql = "SELECT * FROM tb_absensi 
                        WHERE work_day = ? AND
                        MONTH(date) = ? AND
                        YEAR(date) = ? GROUP BY date";
            return $this->db->query($sql,array($status,$month,$year))->result_array();
        }

        public function getDataJadwalKerjaByDate($date){
            $sql = "SELECT * FROM tb_absensi WHERE date = ? GROUP BY date";
            return $this->db->query($sql,$date)->row_array();
        }

        public function getDataHadirAll($date,$status){
            $sql = "SELECT COUNT(id_absensi)as jumlah FROM tb_absensi WHERE 
                    date = ? AND
                    status = ? GROUP BY date";
            return $this->db->query($sql,array($date,$status))->row_array();
        }

        // REVISI EVA
        public function getDataAbsensiByRangeBulanNew($starDate,$endDate){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE 
                        tb_absensi.id_users =  tb_users.id_users AND
                        (date BETWEEN ? AND ?)  ORDER BY date DESC";
            return $this->db->query($sql,array($starDate,$endDate))->result_array();
        }

        public function getJadwalKerjaGroupNew($work_day,$starDate,$end_date){
            $sql = "SELECT * FROM tb_absensi
                        WHERE work_day = ? AND 
                        (date BETWEEN ? AND ?)
                         GROUP BY work_day
                         ORDER BY status = 'tidak'";
            return $this->db->query($sql,array($work_day,$starDate,$end_date))->row_array();
        }
        public function getJadwalKerjaGroupNewNasional($work_day,$starDate,$end_date,$status){
            $sql = "SELECT * FROM tb_absensi
                        WHERE work_day = ? AND 
                        (date BETWEEN ? AND ?) AND
                        status = ?
                         GROUP BY work_day
                         ORDER BY status = 'tidak'";
            return $this->db->query($sql,array($work_day,$starDate,$end_date,$status))->row_array();
        }

        public function getJumlahHariByMonthNew($status,$starDate,$end_date){
            $sql = "SELECT *  FROM tb_absensi 
                        WHERE 
                            work_day = ?  AND
                            (date BETWEEN ? AND ?) GROUP BY date";
            return $this->db->query($sql,array($status,$starDate,$end_date))->result_array();
        }

        public function getJumlahHariByMonthNewLibur($status,$starDate,$end_date,$statusHari){
            $sql = "SELECT *  FROM tb_absensi 
                        WHERE 
                            work_day = ?  AND 
                            status = ? AND
                            (date BETWEEN ? AND ?) GROUP BY date";
            return $this->db->query($sql,array($status,$statusHari,$starDate,$end_date))->result_array();
        }

        public function getJadwalKerjaGroupByDateNew($status,$starDate,$endDate){
            $sql = "SELECT * FROM tb_absensi 
                        WHERE work_day = ? AND 
                             (date BETWEEN ? AND ?) GROUP BY date";
            return $this->db->query($sql,array($status,$starDate,$endDate))->result_array();
        }

        public function getJadwalKerjaGroupByDateNewLibur($status,$starDate,$endDate,$statusHari){
            $sql = "SELECT * FROM tb_absensi 
                        WHERE work_day = ? AND 
                              status = ? AND
                             (date BETWEEN ? AND ?) GROUP BY date";
            return $this->db->query($sql,array($status,$statusHari,$starDate,$endDate))->result_array();
        }


        public function getDataAbsensiByIdUsersGroupNew($starDate,$endDate,$id_users){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE
                        tb_absensi.id_users = tb_users.id_users  AND
                        (date BETWEEN ? AND ?) AND
                        tb_absensi.id_users = $id_users GROUP BY tb_absensi.id_users";
            return $this->db->query($sql,array($starDate,$endDate))->row_array();
        }

        public function getDataKehadiranByStatusNew($starDate,$endDate,$status,$id_users){
            $sql = "SELECT COUNT(status) as jumlah FROM tb_absensi WHERE
                        (date BETWEEN ? AND ?) AND
                        status = ? AND
                        tb_absensi.id_users = $id_users GROUP BY id_users";
            return $this->db->query($sql,array($starDate,$endDate,$status))->row_array();
        }

        public function getDataKehadiranTelatNew($starDate,$end_date,$id_users){
            $sql = "SELECT SUM(is_late) as jumlah FROM tb_absensi WHERE
                        (date BETWEEN ? AND ?) AND
                        id_users = $id_users";
            return $this->db->query($sql,array($starDate,$end_date))->row_array();
        }

        public function getDataAbsensiByBulanAndIdNew($starDate,$endDate,$id_users){
            $sql = "SELECT * FROM tb_absensi,tb_users WHERE 
                        tb_absensi.id_users =  tb_users.id_users AND
                        tb_absensi.id_users = ? AND
                        (date BETWEEN ? AND ?) ORDER BY date DESC";
            return $this->db->query($sql,array($id_users,$starDate,$endDate))->result_array();
        }
       
        
        //REVISI EVA

    }
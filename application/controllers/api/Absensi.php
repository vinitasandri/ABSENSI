<?php

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

class Absensi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUsers');
        $this->load->model('ModelGaji');
        $this->load->model('ModelAbsensi');
    }

    public function addAbsensi_post()
    {
        // ini proses absensi
        $date = date('Y-m-d'); // ini ambil tanggal hari ini
        $no_pegawai = $this->input->post('no_pegawai'); // ambil dari no pegawai

        // $time   = '16:00:00'; // ambil dari waktu yang disetting manual
        // $time   = $this->input->post('time'); // ambil dari waktu yang ada di handphone
        $time = date("H:i:s"); //ambil waktu dari laptop

        $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai); //mengambil id users dari no pegawai
        $id_users = $getDataPegawai['id_users']; // id users yang diambil dari getDataPegawai diatas 
        $data_checkin = $getDataPegawai['check_in']; // mengambil data check in dari database, nilai default nya 08:00:00

        if ($time > $data_checkin) { // membandingkan waktu absen dengan data checkin yang ada didatabase
            //ini proses dimana jika waktu absen melebihi jam 08:00:00
            $is_late = 1;
            $start_checkin = strtotime($data_checkin) + (3600 * 7); // mengubah waktu menjadi string
            $time_absen = strtotime($time); // sama seperti diatas

            $late = (date('H:i:s', $time_absen - $start_checkin)); //mengurangi waktu absen untuk mengambil waktu telat
        } else {
            //ini proses jika tidak telat
            $is_late = 0;
            $late = 0;
        }

        $cekDataAbsensiUsers = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users, $date); //mengambil data absensi hari ini, tujuan nya untuk mengecek si pegawai absen masuk atau absen pulang
        $cekDataAbsensi = $this->ModelAbsensi->getDataAbsensiByDate($date);
        if ($cekDataAbsensi != null) {

            if ($cekDataAbsensiUsers != null) {
                if ($cekDataAbsensi['status'] != "Libur") {
                    if ($cekDataAbsensiUsers['status'] == "Tidak" || $cekDataAbsensiUsers['status'] == "Hadir") {
                        if ($cekDataAbsensiUsers['check_in'] == "00:00:00") {
                            // ini proses dimana pegawai melakukan absen masuk
                            $data = array(
                                'check_in'  => $time,
                                'is_late'   => $is_late,
                                'status'    => "Hadir",
                                'late'      => $late
                            );
                        } else {
                            //ini proses dimana pegawai melakukan absen keluar
                            if ($cekDataAbsensiUsers['check_out'] == "00:00:00") {
                                $checkin_absensi = $cekDataAbsensiUsers['check_in'];
                                $start_checkout = strtotime($checkin_absensi);
                                $end_checkout = strtotime($time);

                                // jam kerja asli
                                $result = ($end_checkout - (3600 * 7)) - $start_checkout;
                                $work_time = date('H:i:s', $result);
                                $jam_kerja = substr($work_time, 0, 2);

                                //jam kerja maksimal untuk uang makan
                                if ($time > "16:00:00") {
                                    $jamPulang = strtotime("16:00:00");
                                } else {
                                    $jamPulang = strtotime($time);
                                }

                                $result2 = ($jamPulang - (3600 * 7)) - $start_checkout;
                                $workTime = date('H:i:s', $result2);
                                $jamKerja = substr($workTime, 0, 2);

                                $data = array(
                                    'check_out'  => $time,
                                    'work_time'  => $work_time
                                );

                                if ($checkin_absensi > "12:00:00") {
                                    $uang_makan = 0;
                                } else {
                                    $uang_makan = $jamKerja * 2500;
                                }
                                $updateUangMakan = array(
                                    'nominal'       => $uang_makan
                                );
                                $this->ModelAbsensi->updateUangMakan($updateUangMakan, $cekDataAbsensiUsers['id_absensi']);
                            } else {
                                $this->response([
                                    'message'   => "Maaf, Anda sudah melakukan absensi !!",
                                    'status'    => true
                                ], 200);
                            }
                        }
                        $this->ModelAbsensi->updateAbsensi($data, $id_users, $date);
                        $this->response([
                            'message'   => "Absensi berhasil dilakukan",
                            'status'    => true
                        ], 200);
                    } else {
                        $this->response([
                            'message'   => "Anda Tidak bisa melakukan absensi, Karena status anda izin atau cuti !",
                            'status'    => true
                        ], 200);
                    }
                } else {
                    $this->response([
                        'message'   => "Anda Tidak bisa melakukan absensi, Karena hari libur",
                        'status'    => true
                    ], 200);
                }
            } else {
                $data = array(
                    'check_in'  => $time,
                    'is_late'   => $is_late,
                    'status'    => "Hadir",
                    'late'      => $late,
                    'id_users'  => $id_users,
                    'date'      => $date
                );
                $this->ModelAbsensi->insertAbsensi($data);
                $getDataAbsenLast = $this->ModelAbsensi->getDataAbsensiLast();
                $id_absensi = $getDataAbsenLast['id_absensi'];
                $uangMakan = array(
                    'nominal'   => 0,
                    'tanggal'   => $date,
                    'id_users'  => $id_users,
                    'id_absensi' => $id_absensi
                );
                $this->ModelGaji->insertGajiMakan($uangMakan);
                $this->response([
                    'message'   => "Absensi berhasil dilakukan",
                    'status'    => true
                ], 200);
            }
        } else {
            $this->response([
                'message'   => "Absensi belum di mulai oleh admin,silahkan tunggu",
                'status'    => true
            ], 200);
        }
    }

    public function getDataAbsensiByIdUsers_post()
    {
        $no_pegawai = $this->input->post('id_users');
        $date = date('Y-m-d');
        $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
        $id_users = $getDataPegawai['id_users'];
        $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users, $date);
        $this->response([
            'message'       => "sukses",
            'status'        => true,
            'data_absensi'  => $getDataAbsensi
        ], 200);
    }

    public function getLaporanKehadiran_post()
    {
        $month = date('m');
        $year = date('Y');
        $no_pegawai = $this->input->post('id_users');
        $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
        $id_users = $getDataPegawai['id_users'];
        $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByMonthAsc($month);
        // $startDate = $getDataAbsensi['date'];
        if($month == 1){
            $monthFrom = 12;
        }else{
            $monthFrom = $month - 1;
        }
        $startDate = date('Y').'-'.$monthFrom.'-'.'26';
        $endDate = date('Y-m-d');


        // $getDataLaporanKehadiran = $this->ModelAbsensi->getDataLaporanKehadiran($id_users,$month);
        // $getDataHadir = $this->ModelAbsensi->getDataHadir($id_users,$month,'Hadir');
        // $getDataTidakHadir = $this->ModelAbsensi->getDataHadir($id_users,$month,'Tidak');
        // $getDataIzin = $this->ModelAbsensi->getDataHadir($id_users,$month,'Izin');

        $getDataLaporanKehadiran = $this->ModelAbsensi->getDataLaporanKehadiranByBetweenDate($id_users, $startDate, $endDate);
        $getDataHadir = $this->ModelAbsensi->getDataHadirByBetween($id_users, $startDate, $endDate, 'Hadir');
        $getDataTidakHadir = $this->ModelAbsensi->getDataHadirByBetween($id_users, $startDate, $endDate, 'Tidak');
        $getDataIzin = $this->ModelAbsensi->getDataHadirByBetween($id_users, $startDate, $endDate, 'Izin');
        $getJumlahKerja = $this->ModelAbsensi->getJumlahHariByMonth(1, $month, $year);
        $getJumlahLibur = $this->ModelAbsensi->getJumlahHariByMonth(0, $month, $year);

        $this->response([
            'message'       => "data berhasil didapatkan",
            'status'        => true,
            'data_laporan'  => $getDataLaporanKehadiran,
            'hadir'         => count($getDataHadir),
            'tidak_hadir'   => count($getDataTidakHadir),
            'izin'          => count($getDataIzin),
            'jumlah_kerja'  => count($getJumlahKerja),
            'jumlah_libur'  => count($getJumlahLibur)
        ], 200);
    }

    public function getPercentAbsensi_post()
    {
        $no_pegawai = $this->input->post('no_pegawai');
        $month = date('m');
        $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
        $id_users = $getDataPegawai['id_users'];

        $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByMonthAsc($month);
        $startDate = $getDataAbsensi['date'];
        $endDate = date('Y-m-d');

        // mengambil data-data dari model
        $getDataHadir = $this->ModelAbsensi->getDataHadir($id_users, $month, 'Hadir');
        // $getCountDataKehadiran = $this->ModelAbsensi->getCountAbsensi($id_users,$month);
        $getCountDataKehadiran = $this->ModelAbsensi->getDataLaporanKehadiranByBetweenDate($id_users, $startDate, $endDate);
        //menghitung percent dari data-data hadir dan data keseluruhan
        // var_dump($getCountDataKehadiran);die;
        $percent = ($getDataHadir['jumlah'] / count($getCountDataKehadiran)) * 100;

        $dataPercent = explode(".", $percent);
        $this->response([
            'status'    => true,
            'percent'   => $dataPercent[0]
        ], 200);
    }

    public function getTotalUangMakan_post()
    {
        $no_pegawai = $this->input->post('no_pegawai');
        $month = date('m');
        $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
        if($month == 1){
            $monthFrom = 12;
        }else{
            $monthFrom = $month - 1;
        }
        $startDate = date('Y').'-'.$monthFrom.'-'.'26';
        $endDate = date('Y-m-d');
        $id_users = $getDataPegawai['id_users'];
        $getTotalGaji = $this->ModelGaji->getDataTotalNew($id_users, $startDate,$endDate);
        if ($getTotalGaji != null) {
            $this->response([
                'status'    => true,
                'total'     => $getTotalGaji['total']
            ], 200);
        } else {
            $this->response([
                'status'    => false,
                'total'     => "0"
            ], 200);
        }
    }


    public function getGajiUangMakan_post()
    {
        $no_pegawai = $this->input->post('no_pegawai');
        $month = date('m');
        if($month == 1){
            $monthFrom = 12;
        }else{
            $monthFrom = $month - 1;
        }
        $getDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
        $id_users = $getDataPegawai['id_users'];

        $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByMonthAsc($month);
        // $startDate = $getDataAbsensi['date'];
        $startDate = date('Y').'-'.$monthFrom.'-'.'26';
        $endDate = date('Y-m-d');
        $getData = $this->ModelGaji->getAllData($id_users, $startDate, $endDate);
        $this->response([
            'status'    => true,
            'data_gaji' => $getData
        ], 200);
    }
}

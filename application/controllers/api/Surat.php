<?php

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

class Surat extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAbsensi');
        $this->load->model('ModelSurat');
        $this->load->model('ModelUsers');
    }

    public function getDataSuratIzin_post()
    {
        $id_pegawai = $this->input->post('id_users');
        $data_users = $this->db->get_where('tb_users', array('no_pegawai' => $id_pegawai))->row_array();
        $id_users = $data_users['id_users'];
        $date = date('m');

        $getDataIzin = $this->ModelSurat->getAllDataSuratIzinByIdUsers($id_users, $date);

        $this->response([
            'data_suratizin' => $getDataIzin,
            'status'         => true
        ], 200);
    }

    public function addSuratIzin_post()
    {
        $id_pegawai = $this->input->post('id_users');
        $data_users = $this->db->get_where('tb_users', array('no_pegawai' => $id_pegawai))->row_array();
        $id_users = $data_users['id_users'];
        $bukti =  $_FILES['image']['name'];
        $date = date('Y-m-d');
        $alasan = $this->input->post('alasan');

        if ($id_users != null && $alasan != null) {
            $config['upload_path']          = './assets/image_surat/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users, $date);
            if ($getDataAbsensi != null) {
                $getDataIzin = $this->ModelSurat->getDataIzinByIdUsers($id_users, $date);
                if ($getDataAbsensi['status'] == "Tidak") {
                    if ($getDataIzin == null) {
                        if ($this->upload->do_upload('image')) {
                            $id_absensi = $getDataAbsensi['id_absensi'];
                            $data = array(
                                'tanggal'   => $date,
                                'alasan'    => $alasan,
                                'bukti'     => $bukti,
                                'id_users'  => $id_users,
                                'id_absensi'    => $id_absensi
                            );

                            $this->ModelSurat->addSuratIzin($data);
                            $this->response([
                                'message'   => "Permohonan izin sudah tersimpan, Silahkan tunggu konfirmasi selanjutnya",
                                'status'    =>  true
                            ], 200);
                        }
                    } else {
                        $this->response([
                            'message'   => "Mohon maaf, anda hanya bisa mengajukan permohonan sekali dalam sehari !",
                            'status'    =>  true
                        ], 200);
                    }
                } else {
                    $this->response([
                        'message'   => "Mohon maaf, anda tidak bisa mengajukan izin karena status anda sudah hadir atau sedang cuti",
                        'status'    =>  true
                    ], 200);
                }
            } else {
                $this->response([
                    'message'   => "Mohon maaf, Absensi belum dimulai ... Silahkan ajukan permohonan nanti ",
                    'status'    =>  false
                ], 200);
            }
        } else {
            $this->response([
                'message'   => 'Data Tidak Boleh kosong !!',
                'status'    => false
            ], 200);
        }
    }

    public function addSuratIzinLainnya_post()
    {
        $id_pegawai = $this->input->post('id_users');
        $data_users = $this->db->get_where('tb_users', array('no_pegawai' => $id_pegawai))->row_array();
        $id_users = $data_users['id_users'];
        $date = date('Y-m-d');
        $alasan = $this->input->post('alasan');

        if ($id_users != null && $alasan != null) {

            $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users, $date);
            if ($getDataAbsensi != null) {
                $getDataIzin = $this->ModelSurat->getDataIzinByIdUsers($id_users, $date);
                if ($getDataAbsensi['status'] == "Tidak") {
                    if ($getDataIzin == null) {
                        $id_absensi = $getDataAbsensi['id_absensi'];
                        $data = array(
                            'tanggal'   => $date,
                            'alasan'    => $alasan,
                            'id_users'  => $id_users,
                            'id_absensi'    => $id_absensi
                        );

                        $this->ModelSurat->addSuratIzin($data);
                        $this->response([
                            'message'   => "Permohonan izin sudah tersimpan, Silahkan tunggu konfirmasi selanjutnya",
                            'status'    =>  true
                        ], 200);
                    } else {
                        $this->response([
                            'message'   => "Mohon maaf, anda hanya bisa mengajukan permohonan sekali dalam sehari !",
                            'status'    =>  true
                        ], 200);
                    }
                } else {
                    $this->response([
                        'message'   => "Mohon maaf, anda tidak bisa mengajukan izin karena status anda sudah hadir atau sedang cuti",
                        'status'    =>  true
                    ], 200);
                }
            } else {
                $this->response([
                    'message'   => "Mohon maaf, Absensi belum dimulai ... Silahkan ajukan permohonan nanti ",
                    'status'    =>  false
                ], 200);
            }
        } else {
            $this->response([
                'message'   => 'Data Tidak Boleh kosong !!',
                'status'    => false
            ], 200);
        }
    }

    public function addSuratCuti_post()
    {
        $dataNow = date("Y-m-d");
        $keterangan = $this->input->post('keterangan');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $no_pegawai = $this->input->post('id_users');
        $expected_days     =  array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $days     =  array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $getHari = $this->isWeekend($start_date, $end_date, $expected_days);
        $arrayNasional = [];
        $checkData = $this->isWeekend($dataNow, $start_date, $days);
        $jumlah_hari = count($getHari);
        // var_dump($getHari);die;
        $arrayDate = explode('-', $end_date);
        $tahunCuti = $arrayDate[0];
        $batasTahun = date('Y');
        $month = date('m');
        $monthAfter = $month + 1;
        $firstDate = date('Y').'-'.$month.'-'.'26';
        $secondDate = date('Y').'-'.$monthAfter.'-'.'25';
        $getDataLibur = $this->ModelSurat->getHariNasional($firstDate,$secondDate);
        foreach($getDataLibur as $gdl){
            array_push($arrayNasional,$gdl['date']);
        }
        $resultHari = array_diff($getHari,$arrayNasional);



        $getDataUser = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
        $id_users = $getDataUser['id_users'];
        $getDataCuti = $this->ModelSurat->getDataCutiByIdUsers($id_users);

        if ($keterangan != null && $start_date != null && $end_date != null && $no_pegawai != null) {
            if ($checkData != null) {

                $checkJadwal = $this->ModelSurat->cekJadwal($start_date,$end_date);
                if($checkJadwal != null){
                    if (count($checkData) >= 7) {
                        if (count($getHari) > 1) {
                            if ($getDataCuti != null) {
                                if ($tahunCuti <= $batasTahun) {
                                    $getTotalCuti = $this->ModelSurat->getTotalCutiByIdUsers($id_users);
                                    $totalCuti = $getTotalCuti['total'];
                                    if ($totalCuti + $jumlah_hari > 12) {
                                        $this->response([
                                            'message'   => "Mohon maaf, Anda Melebihi batas cuti yang diberikan !",
                                            'status'    => false
                                        ], 200);
                                    } else {
                                        $data = array(
                                            'keterangan'    => $keterangan,
                                            'dari_tanggal'  => $start_date,
                                            'sampai_tanggal' => $end_date,
                                            'jumlah_hari'   => count($resultHari),
                                            'id_users'      => $id_users
                                        );
                                        $this->ModelSurat->insertSuratCuti($data);
                                        $this->response([
                                            'message'   => "Terima Kasih, Pengajuan anda akan kami proses",
                                            'status'    => true
                                        ], 200);
                                    }
                                } else {
                                    $this->response([
                                        'message'   => "Mohon maaf, Anda hanya bisa mengajukan sampai akhir tahun " . $batasTahun,
                                        'status'    => false
                                    ], 200);
                                }
                            } else {
                                if ($tahunCuti <= $batasTahun) {
                                    if ($jumlah_hari < 12) {
                                        $data = array(
                                            'keterangan'    => $keterangan,
                                            'dari_tanggal'  => $start_date,
                                            'sampai_tanggal' => $end_date,
                                            'jumlah_hari'   => count($resultHari),
                                            'id_users'      => $id_users
                                        );
                                        $this->ModelSurat->insertSuratCuti($data);
                                        $this->response([
                                            'message'   => "Terima Kasih, Pengajuan anda akan kami proses",
                                            'status'    => true
                                        ], 200);
                                    } else {
                                        $this->response([
                                            'message'   => "Mohon maaf, Anda Melebihi batas cuti yang diberikan !",
                                            'status'    => false
                                        ], 200);
                                    }
                                } else {
                                    $this->response([
                                        'message'   => "Mohon maaf, Anda hanya bisa mengajukan sampai akhir tahun " . $batasTahun,
                                        'status'    => false
                                    ], 200);
                                }
                            }
                        } else {
                            $this->response([
                                'message'   => "Mohon maaf, Silahkan Masukan tanggal mulai dan akhir yang benar",
                                'status'    => false
                            ], 200);
                        }
                    } else {
                        $this->response([
                            'message'   => "Mohon maaf, Silahkan Ajukan cuti seminggu setelah hari ini ",
                            'status'    => false
                        ], 200);
                    }
                }else{
                    $this->response([
                        'message'   => "Mohon maaf, Jadwal untuk tanggal yang anda input belum tersedia",
                        'status'    => false
                    ], 200);
                }

            } else {
                $this->response([
                    'message'   => "Mohon maaf, Silahkan Masukan tanggal mulai dan akhir yang benar",
                    'status'    => false
                ], 200);
            }
        } else {
            $this->response([
                'message'   => "Mohon maaf, Silahkan lengkapi data terlebih dahulu",
                'status'    => false
            ], 200);
        }
    }

    public function getDataCuti_post()
    {
        $no_pegawai = $this->input->post('id_users');
        $year = date('Y');
        $getData = $this->ModelUsers->getDataUsersByIdPegawai($no_pegawai);
        if ($getData != null) {
            $id_users = $getData['id_users'];
            $getDataCuti = $this->ModelSurat->getAllDataCutiByIdUsers($id_users, $year);
            $getDataSisaCuti = $this->ModelSurat->getDataSisaCutiByIdUsers($id_users, $year);
            $jumlahCuti = $getDataSisaCuti['total'];
            if ($jumlahCuti == null) {
                $jumlahCuti = 0;
            } else {
                $jumlahCuti = $jumlahCuti;
            }
            $sisaCuti = 12 - $getDataSisaCuti['total'];
            $this->response([
                'data_cuti' => $getDataCuti,
                'sisa_cuti' => $sisaCuti,
                'jumlah_cuti'   => $jumlahCuti,
                'status'    => true
            ], 200);
        }
    }

    public function cancelCuti_post()
    {
        $id_cuti = $this->input->post('id_cuti');

        $this->ModelSurat->deleteCuti($id_cuti);
        $this->response([
            'message'   => "Data Pengajuan Cuti anda telah dibatalkan ",
            'status'    => true
        ], 200);
    }

    public function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {
        $array = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach ($period as $date) {
            $array[] = $date->format($format);
        }

        return $array;
    }

    public function isWeekend($start_date, $end_date, $expected_days)
    {
        $start_timestamp = strtotime($start_date);
        $end_timestamp   = strtotime($end_date);
        $dates = array();
        while ($start_timestamp <= $end_timestamp) {
            if (in_array(date('l', $start_timestamp), $expected_days)) {
                $dates[] = date('Y-m-d', $start_timestamp);
            }
            $start_timestamp = strtotime('+1 day', $start_timestamp);
        }
        return $dates;
    }

    public function test_post()
    {
        $start_date        =  $this->input->post('start_date');
        $end_date          =  $this->input->post('end_date');
        $expected_days     =  array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
        $weekend_dates     =  $this->isWeekend($start_date, $end_date, $expected_days);
        var_dump($weekend_dates);
        die;
    }
}

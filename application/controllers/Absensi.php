<?php

class Absensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUsers');
        $this->load->model('ModelAbsensi');
        $this->load->model('ModelSurat');
    }

    public function testTime()
    {
        date_default_timezone_set('Asia/Jakarta');
        $timezone = time() + (60 * 60 * 7);
        echo date("H:i:s");
    }


    public function startAbsensi()
    {
        $date = date('Y-m-d');
        $data_pegawai = $this->ModelUsers->getDataKaryawanVerifiedAbsensi(2);
        $pegawaiAbsen = [];
        $pegawaiAll = [];

        foreach ($data_pegawai as $row) {
            array_push($pegawaiAll, $row['id_users']);
        }
        foreach ($data_pegawai as $value) {
            $id_users = $value['id_users'];
            $cekDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsersAll($id_users, $date);

            if ($cekDataAbsensi != null) {
                array_push($pegawaiAbsen, $cekDataAbsensi[0]['id_users']);
            }
        }
        $result = array_diff($pegawaiAll, $pegawaiAbsen);

        for ($i = 0; $i < count($result); $i++) {
            $data = array([
                'id_users'  => $result[$i],
                'date'      => $date,
                'status'    => 'Tidak'
            ]);
            $this->ModelAbsensi->insertAbsensiAll($data);
        }

        $getDataAbsensi = $this->db->get_where('tb_absensi', array('date' => $date))->result_array();

        foreach ($getDataAbsensi as $gda) {
            $addUangMakan = array([
                'nominal'       => 0,
                'tanggal'       => $date,
                'id_users'      => $gda['id_users'],
                'id_absensi'    => $gda['id_absensi']
            ]);
            $this->ModelAbsensi->addUangMakanBatch($addUangMakan);
        }
        $this->session->set_flashdata('toastr', "toastr");
        $this->session->set_flashdata('text_toastr', 'Absensi hari ini berhasil dimulai');
        $this->session->set_flashdata('type_toastr', 'success');
        redirect(base_url('dashboard/'));
    }

    public function startAbsensiByDate()
    {
        $starDate = $this->input->post('dari_tanggal');
        $endDate = $this->input->post('sampai_tanggal');
        $checkKerja = $this->input->post('check_kerja');
        $checkLibur = $this->input->post('check_libur');
        if ($checkKerja != null) {
            $kerja = 1;
        } else {
            $kerja = 0;
        }

        if ($checkLibur != null) {
            $libur = 1;
        } else {
            $libur = 0;
        }

        if ($starDate != null && $endDate != null) {
            if ($checkKerja != null || $checkLibur != null) {
                $date = date('Y-m-d');
                $data_pegawai = $this->ModelUsers->getDataKaryawanVerifiedAbsensi(2);
                $pegawaiAbsen = [];
                $pegawaiAbsenHadir = [];
                $pegawaiAll = [];
                $pegawaiLibur = [];
                $pegawaiTidakHadir = [];

                foreach ($data_pegawai as $row) {
                    array_push($pegawaiAll, $row['id_users']);
                }


                //cek data absensi yang sudah di input sebelumnya
                foreach ($data_pegawai as $dp) {
                    $id_users = $dp['id_users'];
                    $cekDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUserAndStatus($id_users, $starDate, $endDate, 'tidak');
                    if ($cekDataAbsensi != null) {
                        array_push($pegawaiAbsenHadir, $cekDataAbsensi[0]['id_users']);
                    }
                }


                $workDay     =  array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                $holiday     =  array('Sunday');

                if ($checkKerja != null) {
                    $dateOfWork = $this->isWeekend($starDate, $endDate, $workDay);
                } else {
                    $dateOfWork = [];
                }

                if ($checkLibur != null) {
                    $dateOfHoliday = $this->isWeekend($starDate, $endDate, $holiday);
                } else {
                    $dateOfHoliday = [];
                }


                //cek data hari libur
                foreach ($data_pegawai as $value) {
                    $id_users = $value['id_users'];
                    $cekDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUserAndStatus($id_users, $starDate, $endDate, 'libur');

                    if ($cekDataAbsensi != null) {
                        array_push($pegawaiLibur, $cekDataAbsensi[0]['id_users']);
                    }
                }


                $result = array_diff($pegawaiAll, $pegawaiAbsen);
                $resultLibur = array_diff($pegawaiAll, $pegawaiLibur);
                $resultTidak = array_diff($pegawaiAll, $pegawaiAbsenHadir);
                if ($kerja == 1 && $libur == 1) {
                    if ($resultTidak != null) {

                        //insert hari kerja
                        for ($j = 0; $j < count($dateOfWork); $j++) {
                            for ($i = 0; $i < count($resultTidak); $i++) {
                                $data = array([
                                    'id_users'  => $resultTidak[$i],
                                    'date'      => $dateOfWork[$j],
                                    'status'    => 'Tidak',
                                    'work_day'  => 1
                                ]);
                                $this->ModelAbsensi->insertAbsensiAll($data);
                            }
                        }
                        $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByRangeDate($starDate, $endDate);

                        foreach ($getDataAbsensi as $gda) {
                            $addUangMakan = array([
                                'nominal'       => 0,
                                'tanggal'       => $gda['date'],
                                'id_users'      => $gda['id_users'],
                                'id_absensi'    => $gda['id_absensi']
                            ]);
                            $this->ModelAbsensi->addUangMakanBatch($addUangMakan);
                        }
                        for ($k = 0; $k < count($dateOfHoliday); $k++) {
                            for ($i = 0; $i < count($resultLibur); $i++) {
                                $data = array([
                                    'id_users'  => $resultLibur[$i],
                                    'date'      => $dateOfHoliday[$k],
                                    'status'    => 'Libur',
                                    'work_day'  => 0
                                ]);
                                $this->ModelAbsensi->insertAbsensiAll($data);
                            }
                        }
                        $this->session->set_flashdata('icon', 'success');
                        $this->session->set_flashdata('text', 'Jadwal Kerja berhasil ditambahkan');
                        $this->session->set_flashdata('title', 'Tambah Jadwal Sukses');
                        redirect(base_url('home/jadwal_kerja'));
                    } else {
                        $this->session->set_flashdata('icon', 'error');
                        $this->session->set_flashdata('text', 'Mohon maaf, diantara tanggal yang diinput sudah tersimpan dijadwal, silahkan periksa kembali tanggal mulai dan tanggal akhir');
                        $this->session->set_flashdata('title', 'Tambah Jadwal Gagal');
                        redirect(base_url('home/jadwal_kerja'));
                    }
                } else if ($kerja == 1) {
                    if ($resultTidak != null) {

                        //insert hari kerja
                        for ($j = 0; $j < count($dateOfWork); $j++) {
                            for ($i = 0; $i < count($resultTidak); $i++) {
                                $data = array([
                                    'id_users'  => $resultTidak[$i],
                                    'date'      => $dateOfWork[$j],
                                    'status'    => 'Tidak',
                                    'work_day'  => 1
                                ]);
                                $this->ModelAbsensi->insertAbsensiAll($data);
                            }
                        }
                        $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByRangeDate($starDate, $endDate);

                        foreach ($getDataAbsensi as $gda) {
                            $addUangMakan = array([
                                'nominal'       => 0,
                                'tanggal'       => $gda['date'],
                                'id_users'      => $gda['id_users'],
                                'id_absensi'    => $gda['id_absensi']
                            ]);
                            $this->ModelAbsensi->addUangMakanBatch($addUangMakan);
                        }

                        $this->session->set_flashdata('icon', 'success');
                        $this->session->set_flashdata('text', 'Jadwal Kerja berhasil ditambahkan');
                        $this->session->set_flashdata('title', 'Tambah Jadwal Sukses');
                        redirect(base_url('home/jadwal_kerja'));
                    } else {
                        $this->session->set_flashdata('icon', 'error');
                        $this->session->set_flashdata('text', 'Mohon maaf, diantara tanggal yang diinput sudah tersimpan dijadwal, silahkan periksa kembali tanggal mulai dan tanggal akhir');
                        $this->session->set_flashdata('title', 'Tambah Jadwal Gagal');
                        redirect(base_url('home/jadwal_kerja'));
                    }
                } else if ($libur == 1) {
                    if ($resultLibur != null) {
                        for ($k = 0; $k < count($dateOfHoliday); $k++) {
                            for ($i = 0; $i < count($resultLibur); $i++) {
                                $data = array([
                                    'id_users'  => $resultLibur[$i],
                                    'date'      => $dateOfHoliday[$k],
                                    'status'    => 'Libur',
                                    'work_day'  => 0
                                ]);
                                $this->ModelAbsensi->insertAbsensiAll($data);
                            }
                        }
                        $this->session->set_flashdata('icon', 'success');
                        $this->session->set_flashdata('text', 'Jadwal Kerja berhasil ditambahkan');
                        $this->session->set_flashdata('title', 'Tambah Jadwal Sukses');
                        redirect(base_url('home/jadwal_kerja'));
                    } else {
                        $this->session->set_flashdata('icon', 'error');
                        $this->session->set_flashdata('text', 'Mohon maaf, diantara tanggal yang diinput sudah tersimpan dijadwal, silahkan periksa kembali tanggal mulai dan tanggal akhir');
                        $this->session->set_flashdata('title', 'Tambah Jadwal Gagal');
                        redirect(base_url('home/jadwal_kerja'));
                    }
                }
            } else {
                $this->session->set_flashdata('icon', 'error');
                $this->session->set_flashdata('text', 'Mohon maaf, Silahkan pilih terlebih dahulu untuk perhitungan hari kerja atau hari libur');
                $this->session->set_flashdata('title', 'Tambah Jadwal Gagal');
                redirect(base_url('home/jadwal_kerja'));
            }
        } else {
            $this->session->set_flashdata('icon', 'error');
            $this->session->set_flashdata('text', 'Mohon Maaf, Data tidak boleh kosong !');
            $this->session->set_flashdata('title', 'Tambah Jadwal Gagal');
            redirect(base_url('home/jadwal_kerja'));
        }
    }

    public function startJadwalKerja()
    {
        $checkLibur = $this->input->post('check_libur');
        $starDate = $this->input->post('dari_tanggal');
        $endDate = $this->input->post('sampai_tanggal');
        // var_dump($_POST);die;
        if ($starDate != null && $endDate != null) {
            $data_pegawai = $this->ModelUsers->getDataKaryawanVerifiedAbsensi(2);
            $pegawaiAbsenHadir = [];
            $pegawaiAll = [];
            $pegawaiLibur = [];
            foreach ($data_pegawai as $row) {
                array_push($pegawaiAll, $row['id_users']);
            }
            //cek data absensi yang sudah di input sebelumnya
            foreach ($data_pegawai as $dp) {
                $id_users = $dp['id_users'];
                $cekDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUserAndStatus($id_users, $starDate, $endDate, 'tidak');
                if ($cekDataAbsensi != null) {
                    array_push($pegawaiAbsenHadir, $cekDataAbsensi[0]['id_users']);
                }
            }


            //cek data hari libur
            foreach ($data_pegawai as $value) {
                $id_users = $value['id_users'];
                $cekDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUserAndStatus($id_users, $starDate, $endDate, 'libur');

                if ($cekDataAbsensi != null) {
                    array_push($pegawaiLibur, $cekDataAbsensi[0]['id_users']);
                }
            }
            $resultLibur = array_diff($pegawaiAll, $pegawaiLibur);
            $resultTidak = array_diff($pegawaiAll, $pegawaiAbsenHadir);

            if ($resultTidak != null) {
                $workDay     =  array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                $holiday     =  array('Sunday');
                $checkKerja = $this->isWeekend($starDate, $endDate, $workDay);
                $checkHariLibur = $this->isWeekend($starDate, $endDate, $holiday);
                if ($checkLibur == null) {

                    $dateOfWork = $this->isWeekend($starDate, $endDate, $workDay);
                    $dateOfHoliday = $this->isWeekend($starDate, $endDate, $holiday);
                } else {
                    $arrayNasional = [];
                    $arrayKeterangan = [];
                    $tglLibur = $this->input->post('datefilter');
                    $keteranganLibur = $this->input->post('keterangan_libur');
                    for ($jumlahLibur = 0; $jumlahLibur < count($tglLibur); $jumlahLibur++) {
                        $explodeTanggal = explode('-', $tglLibur[$jumlahLibur]);
                        $starDateLibur = $explodeTanggal[0];
                        $endDateLibur = $explodeTanggal[1];
                        $strDateStart = str_replace('/', '-', $starDateLibur);
                        $strDateEnd = str_replace('/', '-', $endDateLibur);
                        $newStartDate = date('Y-m-d', strtotime($strDateStart));
                        $newEndDate = date('Y-m-d', strtotime($strDateEnd));
                        $allDay     =  array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
                        $dateOfNasional = $this->isWeekend($newStartDate, $newEndDate, $allDay);
                        for ($x = 0; $x < count($dateOfNasional); $x++) {
                            array_push($arrayNasional, $dateOfNasional[$x]);
                            array_push($arrayKeterangan, $keteranganLibur[$jumlahLibur]);
                        }
                    }
                    $dateOfWork = array_values(array_diff($checkKerja, $arrayNasional));
                    $dateOfHoliday = array_values(array_diff($checkHariLibur, $arrayNasional));
                }
                //insert libur nasional
                $u = 0;
                for ($z = 0; $z < count($arrayNasional); $z++) {
                    $index = $u++;
                    for ($g = 0; $g < count($resultTidak); $g++) {
                        $data = array([
                            'id_users'  => $resultTidak[$g],
                            'date'      => $arrayNasional[$z],
                            'status'    => 'Libur Nasional',
                            'work_day'  => 0,
                            'keterangan' => $arrayKeterangan[$index]
                        ]);
                        $this->ModelAbsensi->insertAbsensiAll($data);
                    }
                }
                //insert hari kerja
                for ($j = 0; $j < count($dateOfWork); $j++) {
                    for ($i = 0; $i < count($resultTidak); $i++) {
                        $data = array([
                            'id_users'  => $resultTidak[$i],
                            'date'      => $dateOfWork[$j],
                            'status'    => 'Tidak',
                            'work_day'  => 1
                        ]);
                        $this->ModelAbsensi->insertAbsensiAll($data);
                    }
                }
                $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByRangeDate($starDate, $endDate);

                foreach ($getDataAbsensi as $gda) {
                    $addUangMakan = array([
                        'nominal'       => 0,
                        'tanggal'       => $gda['date'],
                        'id_users'      => $gda['id_users'],
                        'id_absensi'    => $gda['id_absensi']
                    ]);
                    $this->ModelAbsensi->addUangMakanBatch($addUangMakan);
                }
                for ($k = 0; $k < count($dateOfHoliday); $k++) {
                    for ($i = 0; $i < count($resultLibur); $i++) {
                        $data = array([
                            'id_users'  => $resultLibur[$i],
                            'date'      => $dateOfHoliday[$k],
                            'status'    => 'Libur',
                            'work_day'  => 0
                        ]);
                        $this->ModelAbsensi->insertAbsensiAll($data);
                    }
                }
                $this->session->set_flashdata('icon', 'success');
                $this->session->set_flashdata('text', 'Jadwal Kerja berhasil ditambahkan');
                $this->session->set_flashdata('title', 'Tambah Jadwal Sukses');
                redirect(base_url('home/jadwal_kerja'));
            } else {
                $this->session->set_flashdata('icon', 'error');
                $this->session->set_flashdata('text', 'Mohon maaf, diantara tanggal yang diinput sudah tersimpan dijadwal, silahkan periksa kembali tanggal mulai dan tanggal akhir');
                $this->session->set_flashdata('title', 'Tambah Jadwal Gagal');
                redirect(base_url('home/jadwal_kerja'));
            }



            // if ($resultTidak != null) {
            // } else {
            // }
        } else {
            $this->session->set_flashdata('icon', 'error');
            $this->session->set_flashdata('text', 'Mohon Maaf, Data tidak boleh kosong !');
            $this->session->set_flashdata('title', 'Tambah Jadwal Gagal');
            redirect(base_url('home/jadwal_kerja'));
        }
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

    public function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y')
    {
        // var_dump($start);die;
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }


    public function changeStatusIzin()
    {
        $id_absensi = $this->uri->segment(3);
        $date = $this->uri->segment(4);
        $id_users = $this->uri->segment(5);
        if ($id_absensi != null) {
            $changeAbsensi = array(
                'status'    => "Izin",
            );

            $changeSuratIzin = array(
                'status_surat'  => 1
            );


            $this->ModelAbsensi->updateAbsensi($changeAbsensi, $id_users, $date);
            $this->ModelSurat->updateData($changeSuratIzin, $id_absensi);
            $this->session->set_flashdata('icon', 'success');
            $this->session->set_flashdata('text', 'Surat Izin berhasil dikonfirmasi');
            $this->session->set_flashdata('title', 'Konfirmasi Sukses !');
            redirect(base_url('home/surat_izin'));
        } else {
            redirect(base_url('home/surat_izin'));
        }
    }
}

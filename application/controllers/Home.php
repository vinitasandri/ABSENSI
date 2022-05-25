<?php

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelShift');
        $this->load->model('ModelJabatan');
        $this->load->model('ModelUsers');
        $this->load->model('ModelAbsensi');
        $this->load->model('ModelSurat');
        $this->load->model('ModelGaji');
    }

    public function list_shift()
    {
        $data = array(
            "breadcumb"     => "Data Shift",
            "title"         => "Data Shift - PT. Vinita",
            "data_shift"    => $this->ModelShift->getDataShift(),
            "shift_active"  => "active",
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/navbar');
        $this->load->view('data/shift/list_shift', $data);
        $this->load->view('layout/footer');
    }

    public function list_jabatan()
    {
        $data = array(
            "breadcumb"     => "Data Jabatan",
            "title"         => "Data Jabatan - PT. Vinita",
            "data_jabatan"  => $this->ModelJabatan->readDataJabatan(),
            "jabatan_active"    => "active"
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/jabatan/list_jabatan');
        $this->load->view('layout/footer');
    }

    public function verifikasi_pegawai()
    {
        $data = array(
            "breadcumb"     => "Verifikasi Pegawai",
            "title"         => "Data Verfifikasi Pegawai - PT. Vinita",
            "data_karyawan"  => $this->ModelUsers->getDataKaryawanNotVerified(1),
            "verifikasi_active"    => "active",
            "list_jabatan"   => $this->ModelJabatan->readDataJabatan()
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/pegawai/verifikasi_pegawai');
        $this->load->view('layout/footer');
    }

    public function jadwal_kerja()
    {
        if (isset($_POST['pilih_bulan'])) {
            $date = $this->input->post('pilih_bulan');
            $arrayDate = explode("-", $date);
            $year = $arrayDate[0];
            $month = $arrayDate[1];
            $monthFrom = $month;
            $monthTo = $monthFrom + 1;
            $date = $this->_getMonth($monthFrom) . ' ' . $year;
            $startDate = date('Y').'-'.$monthFrom.'-'.'26';
            $endDate = date('Y').'-'.$monthTo.'-'.'25';
            $change = true;
        } else {
            $change = false;
            $year = date('Y');
            $month = date('m');
            if($month == 1){
                $monthFrom = 12;
            }else{
                $monthFrom = $month - 1;
            }
            $startDate = date('Y').'-'.$monthFrom.'-'.'26';
            $date = $this->_getMonth($monthFrom) . ' ' . $year;
            $endDate = date('Y').'-'.$month.'-'.'25';
        }
        
        
      
        // $endDate = date('Y-m-d');
       
        
        $data_jadwal = $this->ModelAbsensi->getJadwalKerja();
        $array = [];
        $arrayLiburNasional = [];
        foreach ($data_jadwal as $dj) {
            $work_day = $dj['work_day'];
            $getDataJadwal = $this->ModelAbsensi->getJadwalKerjaGroupNew($work_day, $startDate, $endDate);
            // var_dump($getDataJadwal);
            $getJumlahKerja = $this->ModelAbsensi->getJumlahHariByMonthNew(1, $startDate, $endDate);
            $getJumlahLibur = $this->ModelAbsensi->getJumlahHariByMonthNewLibur(0, $startDate, $endDate,'Libur');

            if ($getDataJadwal != null) {

                if ($getJumlahKerja != null) {

                    $getDataJadwal += array("jumlah_kerja" => count($getJumlahKerja));
                } else {
                    $getDataJadwal += array("jumlah_kerja" => 0);
                }

                if ($getJumlahLibur != null) {

                    $getDataJadwal += array("jumlah_libur" => count($getJumlahLibur));
                } else {
                    $getDataJadwal += array("jumlah_libur" => 0);
                }

                array_push($array, $getDataJadwal);
            }
        }
        foreach($data_jadwal as $dj){
            $work_day = $dj['work_day'];
            $getDataJadwal = $this->ModelAbsensi->getJadwalKerjaGroupNewNasional($work_day, $startDate, $endDate,'Libur Nasional');
            $getJumlahHari = $this->ModelAbsensi->getJumlahHariByMonthNewLibur(0,$startDate,$endDate,'Libur Nasional');
            if($getDataJadwal != null){
                if($getJumlahHari != null){
                    $getDataJadwal += array('jumlah_nasional'=> count($getJumlahHari));
                }else{
                    $getDataJadwal += array('jumlah_nasional'=> 0);
                }
                array_push($arrayLiburNasional,$getDataJadwal);
            }
        }

        $dataLibur = $this->ModelAbsensi->getJadwalKerjaGroupByDateNewLibur(0, $startDate, $endDate,'Libur');
        $dataLiburNasional = $this->ModelAbsensi->getJadwalKerjaGroupByDateNewLibur(0, $startDate, $endDate,'Libur Nasional');
        $dataKerja = $this->ModelAbsensi->getJadwalKerjaGroupByDateNew(1, $startDate, $endDate);
        $arrayKerja = [];
        foreach ($dataKerja as $dk) {
            $getDataJadwalKerja = $this->ModelAbsensi->getDataJadwalKerjaByDate($dk['date']);
            $getHadir = $this->ModelAbsensi->getDataHadirAll($dk['date'], 'Hadir');
            $getIzin = $this->ModelAbsensi->getDataHadirAll($dk['date'], 'Izin');
            $getTidak = $this->ModelAbsensi->getDataHadirAll($dk['date'], 'Tidak');
            if ($getHadir != null) {
                $jumlahHadir = $getHadir['jumlah'];
            } else {
                $jumlahHadir = 0;
            }
            if ($getTidak != null) {
                $jumlahTidak = $getTidak['jumlah'];
            } else {
                $jumlahTidak = 0;
            }
            if ($getIzin != null) {
                $jumlahIzin = $getIzin['jumlah'];
            } else {
                $jumlahIzin = 0;
            }
            $getDataJadwalKerja += array("jumlah_hadir" => $jumlahHadir);
            $getDataJadwalKerja += array("jumlah_izin" => $jumlahIzin);
            $getDataJadwalKerja += array("jumlah_tidak" => $jumlahTidak);
            array_push($arrayKerja, $getDataJadwalKerja);
        }


        $data = array(
            "breadcumb"     => "Data Jadwal Kerja",
            "title"         => "Jadwal Kerja - PT. Vinita",
            "jadwal"        => "active",
            'data_jadwal'   => $array,
            'data_libur'    => $dataLibur,
            'data_libur_nasional'    => $dataLiburNasional,
            'data_kerja'    => $arrayKerja,
            'data_nasional' => $arrayLiburNasional,
            'date'          => $date,
            'change'        => $change
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/jadwal_kerja/jadwal_kerja');
        $this->load->view('layout/footer');
    }

    public function _getMonth($month)
    {
        if ($month == "1") {
            $nameMonth = "Januari";
        } else if ($month == "2") {
            $nameMonth = "Februari";
        } else if ($month == "3") {
            $nameMonth = "Maret";
        } else if ($month == "4") {
            $nameMonth = "April";
        } else if ($month == "5") {
            $nameMonth = "Mei";
        } else if ($month == "6") {
            $nameMonth = "Juni";
        } else if ($month == "7") {
            $nameMonth = "Juli";
        } else if ($month == "8") {
            $nameMonth = "Agustus";
        } else if ($month == "9") {
            $nameMonth = "September";
        } else if ($month == "10") {
            $nameMonth = "Oktober";
        } else if ($month == "11") {
            $nameMonth = "November";
        } else if ($month == "12") {
            $nameMonth = "Desember";
        }
        return $nameMonth;
    }

    public function list_pegawai()
    {
        $data = array(
            "breadcumb"     => "Data Pegawai",
            "title"         => "Data  Pegawai - PT. Vinita",
            "data_karyawan"  => $this->ModelUsers->getDataKaryawanVerified(0),
            "pegawai_active"    => "active",
            'data_jabatan'  => $this->ModelJabatan->readDataJabatan()
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/pegawai/list_pegawai');
        $this->load->view('layout/footer');
    }

    public function laporan_kehadiran()
    {
        $month = date('m');
        if($month == 1){
            $monthFrom = 12;
        }else{
            $monthFrom = $month - 1;
        }

        // $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByMonthAscNew($monthFrom,$monthFrom);
        $nameMonth = $this->_getMonth($monthFrom);
        // $startDate = $getDataAbsensi['date'];
        $startDate = date('Y').'-'.$monthFrom.'-'.'26';
        $endDate = date('Y-m-d');
        // $endDate = date('Y').'-'.$month.'-'.'25';

        $data = array(
            "breadcumb"            => "Laporan Kehadiran",
            "title"                => "Laporan Kehadiran - PT. Vinita",
            "laporan_kehadiran"    => "active",
            "data_kehadiran"       => $this->ModelAbsensi->getDataAbsensiByRangeBulan($startDate, $endDate),
            "month"                => $nameMonth
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/laporan/kehadiran');
        $this->load->view('layout/footer');
    }

    public function riwayat_kehadiran()
    {
        $month = date('m');
        $array = [];
        if($month == 1){
            $monthFrom = 12;
        }else{
            $monthFrom = $month - 1;
        }
        $nameMonth = $this->_getMonth($monthFrom);
        $kehadiran = $this->ModelAbsensi->getDataAbsensiGroup($month);
        $startDate = date('Y').'-'.$monthFrom.'-'.'26';
        $endDate = date('Y-m-d');
        foreach ($kehadiran as $k) {
            $id_users = $k['id_users'];
            // $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsersGroup($month, $id_users);
            $getDataAbsensi = $this->ModelAbsensi->getDataAbsensiByIdUsersGroupNew($startDate,$endDate, $id_users);
            $hadir = $this->ModelAbsensi->getDataKehadiranByStatusNew($startDate,$endDate, 'Hadir', $id_users);
            $tidakhadir = $this->ModelAbsensi->getDataKehadiranByStatusNew($startDate,$endDate, 'Tidak', $id_users);
            $izin = $this->ModelAbsensi->getDataKehadiranByStatusNew($startDate,$endDate, 'Izin', $id_users);
            $cuti = $this->ModelAbsensi->getDataKehadiranByStatusNew($startDate,$endDate, 'Cuti', $id_users);
            $telat = $this->ModelAbsensi->getDataKehadiranTelatNew($startDate,$endDate, $id_users);
            $uangMakan = $this->ModelGaji->getDataTotal($id_users, $startDate,$endDate);
            if ($hadir != null) {
                $getDataAbsensi += array('hadir' => $hadir['jumlah']);
            } else {
                $getDataAbsensi += array('hadir'   => 0);
            }

            if ($tidakhadir != null) {
                $getDataAbsensi += array('tidak_hadir' => $tidakhadir['jumlah']);
            } else {
                $getDataAbsensi += array('tidak_hadir'  => 0);
            }

            if ($izin != null) {
                $getDataAbsensi += array('izin' => $izin['jumlah']);
            } else {
                $getDataAbsensi += array('izin' => 0);
            }

            if ($cuti != null) {
                $getDataAbsensi += array('cuti' => $cuti['jumlah']);
            } else {
                $getDataAbsensi += array('cuti' => 0);
            }

            $getDataAbsensi += array("telat" => $telat['jumlah']);
            $getDataAbsensi += array("uang_makan" => $uangMakan['total']);

            array_push($array, $getDataAbsensi);
        }

        $data = array(
            "breadcumb"            => "Riwayat Kehadiran",
            "title"                => "Riwayat Kehadiran - PT. Vinita",
            "riwayat_kehadiran"    => "active",
            "data_kehadiran"       => $array,
            "month"                => $nameMonth
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/laporan/riwayat_kehadiran');
        $this->load->view('layout/footer');
    }

    public function detail_kehadiran()
    {
        $id_pegawai = $this->uri->segment(3);
        $month = date('m');
        if($month == 1){
            $monthFrom = 12;
        }else{
            $monthFrom = $month - 1;
        }
        $startDate = date('Y').'-'.$monthFrom.'-'.'26';
        $endDate = date('Y-m-d');
        $nameMonth = $this->_getMonth($monthFrom);
        $getDataUser = $this->ModelUsers->getDataUsersByIdPegawai($id_pegawai);
        $id_users = $getDataUser['id_users'];
        $year = date('Y');
        $data = array(
            "breadcumb"            => "Riwayat Kehadiran",
            "title"                => "Riwayat Kehadiran - PT. Vinita",
            "riwayat_kehadiran"    => "active",
            "data_pegawai"         => $this->ModelUsers->getDataUsersByIdPegawai($id_pegawai),
            'data_kehadiran'       => $this->ModelAbsensi->getDataAbsensiByBulanAndIdNew($startDate,$endDate, $id_users),
            'data_suratizin'       => $this->ModelSurat->getAllDataSuratIzinByIdUsersNew($id_users, $startDate,$endDate),
            'data_suratcuti'       => $this->ModelSurat->getAllDataCutiByIdUsers($id_users, $year)
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/laporan/detail_kehadiran');
        $this->load->view('layout/footer');
    }

    public function surat_izin()
    {
        $data = array(
            "breadcumb"            => "Data Surat Izin",
            "title"                => "Data Surat Izin - PT. Vinita",
            "surat_izin"           => "active",
            "data_suratizin"       => $this->ModelSurat->getDataSuratByStatus(0)
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/surat/surat_izin');
        $this->load->view('layout/footer');
    }

    public function surat_cuti()
    {
        $data = array(
            "breadcumb"            => "Data Surat Cuti",
            "title"                => "Data Surat Cuti - PT. Vinita",
            "surat_cuti"           => "active",
            "data_suratcuti"       => $this->ModelSurat->getAllDataCutiByStatus()
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/surat/surat_cuti');
        $this->load->view('layout/footer');
    }
    public function verifikasi_perangkat()
    {
        $data = array(
            "breadcumb"            => "Data Verifikasi Perangkat",
            "title"                => "Data Verifikasi - PT. Vinita",
            "perangkat"           => "active",
            "data_verifikasi"       => $this->ModelUsers->getDataChangeDevice(0)
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('data/perangkat/verifikasi_perangkat');
        $this->load->view('layout/footer');
    }
}

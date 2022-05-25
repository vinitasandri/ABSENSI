<?php

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';


class Qr extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUsers');
        $this->load->model('ModelQr');
        $this->load->model('ModelAbsensi');
    }

    public function getInfoStart_post()
    {
        $id_pegawai = $this->input->post('no_pegawai');
        $date = date('Y-m-d');
        if ($id_pegawai != null) {
            $cekDataPegawai = $this->ModelUsers->getDataUsersByIdPegawai($id_pegawai);
            $id_users = $cekDataPegawai['id_users'];

            $cekDataAbsensi = $this->ModelAbsensi->getDataAbsensiByDate($date);
            if ($cekDataAbsensi != null) {
                $cekDataAbsensiUsers = $this->ModelAbsensi->getDataAbsensiByIdUsers($id_users, $date);
                if($cekDataAbsensiUsers != null){
                    $check_in = $cekDataAbsensiUsers['check_in'];
    
                    if ($check_in > "00:00:00") {
                        $is_start = 1;
                    } else {
                        $is_start = 0;
                    }
                }else{
                    $is_start = 0;
                }
                
            } else {
                $is_start = 0;
            }

            $this->response([
                'message'   => "sukses",
                'status'    => true,
                'info'      => $is_start
            ],200);
        } else {
            $this->response([
                'message'   => "Maaf data tidak boleh kosong",
                'status'    => false
            ], 200);
        }
    }
}

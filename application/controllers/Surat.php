<?php


class Surat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelSurat');
        $this->load->model('ModelAbsensi');
    }

    public function cancelCuti()
    {
        $idCuti = $this->uri->segment(3);

        $updateStatus = array(
            'status'    => 1,
        );

        $this->ModelSurat->updateDataCuti($updateStatus, $idCuti);
        $this->session->set_flashdata('icon', 'success');
        $this->session->set_flashdata('text', 'Surat Cuti berhasil ditolak');
        $this->session->set_flashdata('title', 'Tolak Sukses');
        redirect(base_url('home/surat_cuti/'));
    }

    public function acceptCuti()
    {
        $idCuti = $this->uri->segment(3);

        if ($idCuti != null) {
            $getDataCuti = $this->ModelSurat->getDataCutiByIdCuti($idCuti);
            $startDate = $getDataCuti['dari_tanggal'];
            $endDate = $getDataCuti['sampai_tanggal'];
            $expected_days     =  array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
            $id_users = $getDataCuti['id_users'];

            $getDataAbsensi = $this->ModelAbsensi->getDataLaporanKehadiranByBetweenDate($id_users,$startDate,$endDate);
            foreach($getDataAbsensi as $value){
                $data = array([
                    'id_absensi'    => $value['id_absensi'],
                    'status'        => "Cuti"
                ]);

                $this->db->update_batch('tb_absensi',$data,'id_absensi');
            }

            $getDate = $this->isWeekend($startDate, $endDate, $expected_days);
            
            // for ($i = 0; $i < count($getDate); $i++) {
            //     $data = array([
            //         'id_users'  => $id_users,
            //         'date'      => $getDate[$i],
            //         'status'    => "Cuti"
            //     ]);
            //     $this->ModelAbsensi->insertAbsensiAll($data);
            // }
            $updateStatus = array(
                'status'    => 2,
            );
            $this->ModelSurat->updateDataCuti($updateStatus, $idCuti);
            $this->session->set_flashdata('icon', 'success');
            $this->session->set_flashdata('text', 'Surat Cuti berhasil disetujui');
            $this->session->set_flashdata('title', 'Verifikasi Sukses');
            redirect(base_url('home/surat_cuti/'));
        } else {
            redirect(base_url('home/surat_cuti/'));
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
}

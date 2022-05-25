<?php

class ModelUsers extends CI_Model
{

    public function getDataUsersByEmail($email)
    {
        return $this->db->get_where('tb_users', array('email' => $email))->row_array();
    }

    public function insertUsers($data)
    {
        return $this->db->insert('tb_users', $data);
    }

    public function inserDetail($data){
        return $this->db->insert('tb_detail_users',$data);
    }

    public function cekDataPegawai($status){
        $sql = "SELECT * FROM tb_users WHERE role = ? ORDER BY id_users DESC";
        return $this->db->query($sql,$status)->row_array();
    }


    public function updateUsers($data, $id_user)
    {
        return $this->db->update('tb_users', $data, array('id_users' => $id_user));
    }

    public function updateDetailUsers($data, $id_user)
    {
        return $this->db->update('tb_detail_users', $data, array('users_id' => $id_user));
    }

    public function deleteUsers($id_user)
    {
        return $this->db->delete('tb_users', array('id_users' => $id_user));
    }

    public function getDataKaryawanNotVerified($status)
    {
        return $this->db->get_where('tb_users', array("is_verified" => $status,'role' => 0))->result_array();
    }


    public function verifKaryawan($data)
    {
        return $this->db->insert('tb_detail_users', $data);
    }

    public function readDataProfile($id_users)
    {
        $sql = "SELECT * from tb_users,tb_detail_users,tb_jabatan WHERE
                        tb_users.id_users = tb_detail_users.users_id AND
                        tb_detail_users.id_jabatan = tb_jabatan.id_jabatan AND
                        tb_users.id_users = ?";
        return $this->db->query($sql, $id_users)->row_array();
    }

    public function getDataKaryawanVerified($status)
    {
        $sql = "SELECT * from tb_users,tb_detail_users,tb_jabatan WHERE
                        tb_detail_users.users_id = tb_users.id_users AND
                        tb_detail_users.id_jabatan = tb_jabatan.id_jabatan AND
                        tb_users.role = 0 
                        ";
        return $this->db->query($sql,$status)->result_array();
    }

    public function getDataKaryawanVerifiedAbsensi($status){
        $sql = "SELECT * from tb_users,tb_detail_users,tb_jabatan WHERE
                        tb_detail_users.users_id = tb_users.id_users AND
                        tb_detail_users.id_jabatan = tb_jabatan.id_jabatan AND
                        tb_users.role = 0 AND
                        tb_users.is_verified = ?
                        ";
        return $this->db->query($sql,$status)->result_array();
    }

  

    public function getDataUsersByIdPegawai($id_pegawai)
    {
        $sql = "SELECT * FROM tb_users,tb_detail_users,tb_jabatan WHERE 
                        tb_users.id_users = tb_detail_users.users_id AND
                        tb_detail_users.id_jabatan = tb_jabatan.id_jabatan AND
                        no_pegawai = ?";
        return $this->db->query($sql, $id_pegawai)->row_array();
    }

    //CHANGE DEVICE

    public function insertChangeDevice($data)
    {
        return $this->db->insert('tb_changedevice', $data);
    }

    public function getDataChangeDeviceByIdUsers($idUsers, $status)
    {
        return $this->db->get_where('tb_changedevice', array('id_users' => $idUsers, 'status' => 0))->result_array();
    }

    public function getDataChangeDevice($status)
    {
        $sql = "SELECT * FROM tb_changedevice 
                        JOIN tb_users ON tb_changedevice.id_users = tb_users.id_users
                        JOIN tb_detail_users ON tb_users.id_users = tb_detail_users.users_id 
                        JOIN tb_jabatan ON tb_detail_users.id_jabatan = tb_jabatan.id_jabatan WHERE
                        tb_changedevice.status = ?";
        return $this->db->query($sql, $status)->result_array();
    }

    public function getDataChangeDeviceByIdDevice($id)
    {
        return $this->db->get_where('tb_changedevice', array('id_changedevice' => $id))->row_array();
    }

    public function updateStatus($data, $id)
    {
        return $this->db->update('tb_changedevice', $data, array('id_changedevice' => $id));
    }
}

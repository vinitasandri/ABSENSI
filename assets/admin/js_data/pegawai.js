function verifData(id,base_url,nama){
    document.getElementById('id_users').value = id;
    document.getElementById('title_modal').innerHTML = "Verifikasi Data Pegawai"
}

function deleteData(id){
    document.getElementById('btn_delete').href = "http://localhost/absensi/pegawai/delete_pegawai/" + id;
}

function verifDevice(base_url,id){
    document.getElementById("confirm_link").href = base_url + 'pegawai/verifDevice/'+id;
}

function deletePegawai(base_url,id,halaman){
    document.getElementById('delete_btn').href = base_url+'pegawai/deletePegawai/'+id+'/'+halaman;
}

function addData(base_url){
    document.getElementById("nama_pegawai").value = "";
    document.getElementById("nik").value = "";
    document.getElementById("email_form").value = "";
    document.getElementById("no_hp").value = "";
    document.getElementById("jabatan_form").value = "";
    document.getElementById("form").action = base_url + 'pegawai/addPegawai';
    document.getElementById("btn_form").innerHTML = "Tambah Data";
}

function updateData(nama_pegawai,nik,email,no_telepon,jabatan,no_pegawai,base_url){
    document.getElementById("nama_pegawai").value = nama_pegawai;
    document.getElementById("nik").value = nik;
    document.getElementById("email_form").value = email;
    document.getElementById("no_hp").value = no_telepon;
    document.getElementById("jabatan_form").value = jabatan;
    document.getElementById("no_pegawai_form").value = no_pegawai;
    document.getElementById("form").action = base_url + 'pegawai/updatePegawai';
    document.getElementById("btn_form").innerHTML = "Perbarui Data";
}
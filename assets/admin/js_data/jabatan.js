function addDataJabatan(base_url){
    document.getElementById("title_modal").innerHTML = "Form Tambah Jabatan";
    document.getElementById("nama_jabatan").value = "";
    document.getElementById("gaji").value = "";
    document.getElementById("form").action = base_url+"jabatan/add_jabatan";
}


function updateDataJabatan(nama,gaji,base_url,id){
    document.getElementById("title_modal").innerHTML = "Form Update Jabatan";
    document.getElementById("nama_jabatan").value = nama;
    document.getElementById("gaji").value = gaji;
    document.getElementById("id_jabatan").value = id;
    document.getElementById("form").action = base_url+"jabatan/update_jabatan";
}

function deleteDataJabatan(id,base_url){
    document.getElementById("btnDelete").href = base_url+'jabatan/delete_jabatan/'+id;
}
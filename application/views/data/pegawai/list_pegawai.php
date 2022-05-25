  <!-- partial -->
  <div class="main-panel">
      <div class="content-wrapper">
          <div class="page-header">
              <h3 class="page-title"> <?= $breadcumb ?> </h3>
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Tables</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?= $breadcumb ?></li>
                  </ol>
              </nav>
          </div>
          <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title"><?= $breadcumb ?></h4>
                          <button onClick="addData('<?= base_url() ?>')" data-target="#modalAdd" data-toggle="modal" style="float: right;position:relative;bottom:45px;" class="btn btn-outline-info">Tambah Data</button>

                          <div class="table-responsive">
                              <table class="table table-bordered dataTable js-exportable mt-3">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Lengkap</th>
                                          <th>No Pegawai</th>
                                          <th>NIK</th>
                                          <!-- <th>No Telepon</th> --> 
                                          <th>Status</th> 
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 0;
                                        foreach ($data_karyawan as $row) {
                                            $i++; ?>
                                          <tr>
                                              <td><?= $i; ?></td>
                                              <td><?= $row['nama_lengkap'] ?></td>
                                              <td><span class="badge badge-outline-primary"><?= $row['no_pegawai'] ?></span></td>
                                              <td><?= $row['nik'] ?></td>
                                              <td>
                                                <?php if($row['is_verified'] == 0){ ?>
                                                    <span class="badge badge-outline-danger">Belum Terdaftar</span>
                                                <?php }else if($row['is_verified'] == 1){ ?>
                                                    <span class="badge badge-outline-warning">Belum Diverifikasi</span>
                                                <?php }else if($row['is_verified'] == 2){ ?>
                                                    <span class="badge badge-outline-success">Sudah Diverifikasi</span>
                                                <?php } ?>
                                              </td>
                                              <!-- <td><?= sprintf(
                                                            "%s-%s-%s",
                                                            substr($row['no_telp'], 0, 4),
                                                            substr($row['no_telp'], 4, 4),
                                                            substr($row['no_telp'], 8)
                                                        ); ?></td> -->
                                              <td>
                                                  <center>
                                                      <span data-toggle="modal" data-target="#modal_detail">
                                                          <button onClick="detail_pegawai('<?= $row['nama_lengkap'] ?>','<?= $row['no_pegawai'] ?>','<?= $row['email'] ?>','<?= $row['nama_jabatan'] ?>','<?= $row['no_telp'] ?>','<?= $row['device_id'] ?>','<?= $row['foto'] ?>','<?= base_url() ?>')" id="btn_verif" type="button" class="btn btn-inverse-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail Data Pegawai">
                                                              <i class="mdi mdi-account-card-details"></i>
                                                          </button>
                                                      </span>
                                                      <span data-toggle="modal" data-target="#modalAdd">
                                                          <button onClick="updateData('<?= $row['nama_lengkap'] ?>','<?= $row['nik'] ?>','<?= $row['email'] ?>','<?= $row['no_telp'] ?>','<?= $row['id_jabatan'] ?>','<?= $row['no_pegawai'] ?>','<?= base_url() ?>')" id="btn_verif" type="button" class="btn btn-inverse-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Ubah Data Pegawai">
                                                              <i class="mdi mdi-pencil-box-outline"></i>
                                                          </button>
                                                      </span>
                                                      <span data-toggle="modal" data-target="#modalDelete">
                                                          <button onClick="deletePegawai('<?= base_url() ?>','<?= $row['id_users'] ?>','list')" type="button" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Delete Data">
                                                              <i class="mdi mdi-account-remove"></i>
                                                          </button>
                                                      </span>
                                                  </center>
                                              </td>
                                          </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- content-wrapper ends -->
      <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Detail Pegawai</h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      <div class="row ml-4">
                          <div class="col-lg-4">

                              <img id="foto" style="width: 200px; height:200px;border-radius:100px;" src="h" alt="">
                          </div>
                          <div class="col-lg-8">
                              <div class="row">
                                  <div class="col-sm-4">
                                      <p>Nama Pegawai</p>
                                      <p>No Pegawai</p>
                                      <p>Email</p>
                                      <p>Jabatan</p>
                                      <p>No Telepon</p>
                                      <p>Device ID</p>
                                  </div>
                                  <div class="col-sm-8">
                                      <p id="nama">: </p>
                                      <p id="no_pegawai">: </p>
                                      <p id="email">: </p>
                                      <p id="jabatan">: </p>
                                      <p id="no_telp">: </p>
                                      <p id="device_id" class="text-uppercase">: </p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary btn-fw" data-dismiss="modal">Keluar</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Hapus Pegawai</h4>
                  </div>
                  <div class="modal-body">
                      <h5>Anda yakin ingin menghapus data pegawai tersebut? </h5>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline-danger btn-fw" data-dismiss="modal">Keluar</button>
                      <a id="delete_btn" class="btn btn-primary btn-fw">Hapus Data</a>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Tambah Pegawai</h4>
                  </div>
                  <div class="modal-body">
                      <div class="container-custom">
                          <form id="form" method="post" action="">
                              <div class="form-group row">
                                  <label for="nama_jabatan" class="col-sm-2 col-form-label">Nama Pegawai</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="nama_pegawai" name="nama">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="nama_jabatan" class="col-sm-2 col-form-label">NIK</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="nik" name="nik">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="nama_jabatan" class="col-sm-2 col-form-label">Email</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="email_form" name="email">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="gaji" class="col-sm-2 col-form-label">No Telepon</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="no_hp" name="no_hp">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="gaji" class="col-sm-2 col-form-label">Jabatan</label>
                                  <div class="col-sm-10">
                                      <select style="color: white;" name="jabatan" id="jabatan_form" class="form-control">
                                          <option value="">-- Pilih Jabatan --</option>
                                          <?php foreach ($data_jabatan as $row) { ?>
                                              <option value="<?= $row['id_jabatan'] ?>"><?= $row['nama_jabatan'] ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                              <input type="hidden" id="no_pegawai_form" name="no_pegawai">

                      </div>
                      </div> <div class="modal-footer">
                          <button type="button" class="btn btn-outline-danger btn-fw" data-dismiss="modal">Keluar</button>
                          <button id="btn_form" class="btn btn-primary btn-fw">Tambah Data</button>
                          </form>
                  </div>
              </div>
          </div>
      </div>
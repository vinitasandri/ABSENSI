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
                          </p>
                          <div class="table-responsive">
                              <table class="table table-bordered dataTable js-exportable mt-3">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>NIK</th>
                                          <th>Nama Lengkap</th>
                                          <th>No Telepon</th>
                                          <th>Device ID</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 0;
                                        foreach ($data_karyawan as $row) {
                                            $i++; ?>
                                          <tr>
                                              <td><?= $i; ?></td>
                                              <td><?= $row['nik'] ?></td>
                                              <td><?= $row['nama_lengkap'] ?></td>
                                              <td><?= sprintf(
                                                        "%s-%s-%s",
                                                        substr($row['no_telp'], 0, 4),
                                                        substr($row['no_telp'], 4, 4),
                                                        substr($row['no_telp'], 8)
                                                    ); ?></td>
                                              <td><span class="badge badge-outline-success"><?= strtoupper($row['device_id']); ?></span></td>
                                              <td>
                                                  <center>
                                                      <span data-toggle="modal" onClick="verifData('<?= $row['id_users']; ?>','<?= base_url() ?>','<?= $row['nama_lengkap'] ?>')" data-target="#modal_verif">
                                                          <button id="btn_verif" type="button" class="btn btn-inverse-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Verifikasi Data">
                                                              <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                                          </button>
                                                      </span>
                                                      <span data-toggle="modal" data-target="#modalDelete">
                                                          <button onClick="deletePegawai('<?= base_url() ?>','<?= $row['id_users'] ?>','verifikasi')" type="button" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Delete Data">
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
      <div class="modal fade" id="modal_verif" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal"></h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      <form id="form_action" action="<?= base_url('pegawai/verifikasi_data/') ?>" method="post">
                           <h5>Anda yakin ingin mengkonfirmasi data pegawai tersebut?</h5>                             
                          <input type="hidden" name="id_users" id="id_users">

                  </div>
                  <hr>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary btn-fw">Simpan Data</button>
                      <button type="button" class="btn btn-outline-secondary btn-fw" data-dismiss="modal">CLOSE</button>
                      </form>
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
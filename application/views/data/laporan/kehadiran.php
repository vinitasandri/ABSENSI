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
                          <h4 class="card-title"><?= $breadcumb ?> Bulan <?= $month  ?></h4>
                          <div class="alert alert-danger">Silahkan Lakukan Rekap Data Sebelum Tanggal 26 Setiap Bulannya</div>
                          <div class="table-responsive">
                              <table class="table table-bordered table-striped  dataTable js-exportable mt-3">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Tanggal</th>
                                          <!-- <th>Libur</th> -->
                                          <th>Nama</th>
                                          <th>Waktu Masuk</th>
                                          <th>Waktu Keluar</th>
                                          <th>Terlambat</th>
                                          <th>Lama Kerja</th>
                                          <th>Hadir</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1;
                                        foreach ($data_kehadiran as $row) { ?>
                                          <tr>
                                              <th><?= $i++ ?></th>
                                              <td><span class="badge badge-outline-primary"><?= date('d-m-Y', strtotime($row['date'])) ?></span></td>
                                              <!-- <td><span class="badge badge-success">Tidak</span></td>  -->
                                              <td><?= $row['nama_lengkap'] ?></td>
                                              <td><?= $row['check_in']; ?></td>
                                              <td><?= $row['check_out'] ?></td>
                                              <td><?= $row['late'] ?></td>
                                              <td><?= $row['work_time'] ?></td>
                                              <?php if ($row['status'] == 'Hadir') { ?>
                                                  <td><span class="badge badge-outline-success"><?= $row['status'] ?></span></td>
                                              <?php } else if ($row['status'] == 'Tidak') { ?>
                                                  <td><span class="badge badge-outline-danger"><?= $row['status'] ?></span></td>
                                              <?php } else if ($row['status'] == 'Cuti') { ?>
                                                  <td><span class="badge badge-outline-info"><?= $row['status'] ?></span></td>
                                              <?php } else { ?>
                                                <td><span class="badge badge-outline-warning"><?= $row['status'] ?></span></td>
                                              <?php } ?>
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
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal"></h4>
                  </div>
                  <hr>
                  <div class="modal-body">

                  </div>
                  <hr>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary btn-fw">SAVE CHANGES</button>
                      <button type="button" class="btn btn-outline-secondary btn-fw" data-dismiss="modal">CLOSE</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
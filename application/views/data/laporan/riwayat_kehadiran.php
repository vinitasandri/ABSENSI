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
                          <h4 class="card-title"><?= $breadcumb ?> Bulan <?= $month ?></h4>
                          <div class="alert alert-danger">Silahkan Lakukan Rekap Data Sebelum Tanggal 26 Setiap Bulannya</div>
                          <div class="table-responsive">
                              <table class="table table-bordered   dataTable js-exportable mt-3">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Pegawai</th>
                                          <th>Hadir</th>
                                          <th>Tidak Hadir</th>
                                          <th>Telat</th>
                                          <th>Izin</th>
                                          <th>Cuti</th>
                                          <th>Uang Makan</th>
                                          <th>Detail</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1;
                                        foreach ($data_kehadiran as $row) { ?>
                                          <tr>
                                              <th><?= $i++ ?></th>
                                              <td><?= $row['nama_lengkap'] ?></td>
                                              <td><?= $row['hadir'] ?></td>
                                              <td><?= $row['tidak_hadir'] ?></td>
                                              <td><?= $row['telat'] ?></td>
                                              <td><?= $row['izin'] ?></td>
                                              <td><?= $row['cuti'] ?></td>
                                              <td>Rp <?= number_format($row['uang_makan'],0,".",".") ?></td>
                                              <td>
                                                  <center>
                                                      <a href="<?= base_url() ?>home/detail_kehadiran/<?= $row['no_pegawai']; ?>"><button href="" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail Data">
                                                              <i class="mdi mdi-information"></i>

                                                          </button>
                                                      </a>
                                                      
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
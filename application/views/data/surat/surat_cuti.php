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
                          <h4 class="card-title"><?= $breadcumb ?> </h4>
                          <div class="table-responsive">
                              <table class="table table-bordered table-striped  dataTable js-exportable mt-3">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama</th>
                                          <th>Tanggal Mulai</th>
                                          <th>Tanggal Selesai</th>
                                          <th>keterangan</th>
                                          <th>Total Cuti</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1;
                                        foreach ($data_suratcuti as $row) { ?>
                                          <tr>
                                              <th><?= $i++ ?></th>
                                              <td><?= $row['nama_lengkap'] ?></td>
                                              <td><span class="badge badge-primary"><?= date('d-m-Y', strtotime($row['dari_tanggal'])) ?></span></td>
                                              <td><span class="badge badge-primary"><?= date('d-m-Y', strtotime($row['sampai_tanggal'])) ?></span></td>
                                              <td><?= $row['keterangan']; ?></td>
                                              <td><?= $row['jumlah_hari']; ?> hari</td>
                                              
                                              <td>
                                                  <center>
                                                      <span data-toggle="modal" data-target="#modal_detail">
                                                          <button onClick="detail_pegawai('<?= $row['nama_lengkap'] ?>','<?= $row['no_pegawai'] ?>','<?= $row['email'] ?>','<?= $row['nama_jabatan'] ?>','<?= $row['no_telp'] ?>','<?= $row['device_id'] ?>','<?= $row['foto'] ?>','<?= base_url() ?>')" type="button" class="btn btn-inverse-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail Data Pegawai">
                                                              <i class="mdi mdi-account-card-details"></i>
                                                          </button>
                                                      </span>
                                                      <span data-toggle="modal" data-target="#modal_confirm">
                                                          <button onClick="acceptCuti('<?= base_url() ?>','<?= $row['id_cuti']; ?>')" type="button" class="btn btn-inverse-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Konfirmasi Surat Cuti">
                                                              <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                                          </button>
                                                      </span>
                                                      <span data-toggle="modal" data-target="#modal_cancel">
                                                          <button onClick="tolakCuti('<?= base_url() ?>','<?= $row['id_cuti']; ?>')" type="button" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Tolak Surat Cuti">
                                                              <i class="mdi mdi-calendar-remove"></i>
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
      <div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Konfirmasi Surat Izin</h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      Anda yakin ingin mengkonfirmasi surat cuti tersebut?
                  </div>
                  <hr>
                  <div class="modal-footer">
                      <a href="" id="link_accept" class="btn btn-primary btn-fw">Konfirmasi</a>
                      <button type="button" class="btn btn-outline-secondary btn-fw" data-dismiss="modal">Keluar</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modal_cancel" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Tolak Surat Cuti</h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      Anda yakin ingin menolak surat cuti tersebut?
                  </div>
                  <hr>
                  <div class="modal-footer">
                      <a href="" id="link_cancel" class="btn btn-primary btn-fw">Tolak</a>
                      <button type="button" class="btn btn-outline-secondary btn-fw" data-dismiss="modal">Keluar</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
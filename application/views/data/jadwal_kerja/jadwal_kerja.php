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
                          <h4 class="card-title"><?= $breadcumb ?> Bulan <?= $date  ?></h4>
                          <button data-target="#modalAdd" data-toggle="modal" style="float: right;position:relative;bottom:45px;" class="btn btn-outline-info">Tambah Jadwal</button>
                          <button data-target="#modalBulan" data-toggle="modal" style="float: right;position:relative;bottom:45px; margin-right:10px;" class="btn btn-outline-primary">Pilih Bulan</button>
                          <?php if ($change == true) { ?>
                              <a href="<?= base_url() ?>home/jadwal_kerja" style="float: right;position:relative;bottom:45px; margin-right:10px;" class="btn btn-outline-warning">Kembali</a>
                          <?php } ?>

                          <div class="alert alert-warning">Silahkan Input Jadwal Kerja Pada Tanggal 26 Setiap Bulannya </div>
                          <div class="table-responsive">
                              <table class="table table-bordered dataTable js-exportable mt-3">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Status Kerja</th>
                                          <th>Jumlah Hari</th>
                                          <th>Lihat Detail</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $totalHari = 0;
                                        $i = 1;
                                        foreach ($data_jadwal as $row) { ?>
                                          <tr>
                                              <td><?= $i++ ?></td>
                                              <td>
                                                  <?php if ($row['work_day'] == 0) { ?>
                                                      <span class="badge badge-outline-danger">Hari Libur</span>
                                                  <?php } else { ?>
                                                      <span class="badge badge-outline-success">Hari Kerja</span>
                                                  <?php } ?>
                                              </td>
                                              <td>
                                                  <?php if ($row['work_day'] == 1) { ?>
                                                      <span class="badge badge-outline-primary"><?= $row['jumlah_kerja']; ?> hari</span>
                                                  <?php } else { ?>
                                                      <span class="badge badge-outline-primary"><?= $row['jumlah_libur']; ?> hari</span>
                                                  <?php } ?>
                                              </td>
                                              <td>
                                                  <center>
                                                      <?php if ($row['work_day'] == 1) { ?>
                                                          <span data-toggle="modal" data-target="#modalKerja">
                                                              <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail Jadwal">
                                                                  <i class="mdi mdi-information"></i>
                                                              </button>
                                                          </span>
                                                      <?php } else { ?>
                                                          <span data-toggle="modal" data-target="#modalLibur">
                                                              <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail Jadwal">
                                                                  <i class="mdi mdi-information"></i>
                                                              </button>
                                                          </span>
                                                      <?php } ?>
                                                  </center>
                                              </td>
                                          </tr>
                                          <?php $totalHari = $row['jumlah_kerja'] + $row['jumlah_libur']; ?>
                                      <?php } ?>
                                      <?php foreach ($data_nasional as $row) { ?>
                                          <tr>
                                              <td>3</td>
                                              <td><span class="badge badge-outline-warning">Hari Libur Nasional</span></td>
                                              <td><span class="badge badge-outline-primary"><?= $row['jumlah_nasional'] ?> Hari</span></td>
                                              <td>
                                                  <center>
                                                      <span data-toggle="modal" data-target="#modalLiburNasional">
                                                          <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail Jadwal">
                                                              <i class="mdi mdi-information"></i>
                                                          </button>
                                                      </span>
                                                  </center>
                                              </td>
                                          </tr>
                                          <?php $totalHari += $row['jumlah_nasional'] ?>
                                      <?php } ?>


                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <th colspan="2">Total Jumlah Hari</th>
                                          <th colspan="2"><span class="badge badge-outline-primary"><?= $totalHari ?> Hari</span></th>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- content-wrapper ends -->
      <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Form Tambah Jadwal Kerja Bulanan</h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      <div class="container-custom">
                          <form id="form" method="post" action="<?= base_url() ?>absensi/startJadwalKerja">
                              <div class="form-group row">
                                  <label for="nama_jabatan" class="col-sm-2 col-form-label">Dari Tanggal</label>
                                  <div class="col-sm-10">
                                      <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="gaji" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                                  <div class="col-sm-10">
                                      <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="" class="col-sm-2 col-form-label"></label>
                                  <div class="col-md-4">
                                      <div class="form-check form-check-success">
                                          <label class="form-check-label">
                                              <input onClick="addLibur()" type="checkbox" id="check_libur" name="check_libur" class="form-check-input"> Input Libur Nasional ?<i class="input-helper"></i></label>
                                      </div>
                                  </div>
                                  <!-- <div class="col-md-3">
                                      <div class="form-check form-check-success">
                                          <label class="form-check-label">
                                              <input type="checkbox" name="check_kerja" class="form-check-input"> Hitung hari kerja<i class="input-helper"></i></label>
                                      </div>
                                  </div> -->
                                  <!-- <div class="col-md-3">
                                      <div class="form-check form-check-danger">
                                          <label class="form-check-label">
                                              <input type="checkbox" name="check_libur" class="form-check-input"> Hitung hari libur <i class="input-helper"></i></label>
                                      </div>
                                  </div> -->
                              </div>
                              <div id="group" hidden="true">

                              </div>
                              <div class="form-group row" id="group_add" hidden="true">
                                  <label for="gaji" class="col-sm-2 col-form-label"></label>
                                  <div class="col-sm-10">
                                      <!-- <input type="date" class="form-control" multiple id="sampai_tanggal" name="sampai_tanggal"> -->
                                      <a id="add_libur" onClick="addToLibur()" style="cursor: pointer;"> + klik untuk tambah libur nasional</a>
                                  </div>
                              </div>
                      </div>
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
      <div class="modal fade" id="modalBulan" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Form Pilih Bulan</h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      <div class="container-custom">
                          <form id="form" method="post" action="<?= base_url() ?>home/jadwal_kerja">
                              <div class="form-group row">
                                  <label for="nama_jabatan" class="col-sm-2 col-form-label">Pilih Bulan</label>
                                  <div class="col-sm-10">
                                      <input type="month" class="form-control" name="pilih_bulan">
                                  </div>
                              </div>

                      </div>
                  </div>
                  <hr>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary btn-fw">Lihat Data</button>
                      <button type="button" class="btn btn-outline-secondary btn-fw" data-dismiss="modal">CLOSE</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalKerja" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Detail Jadwal Kerja</h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Tanggal</th>
                                  <th>Hadir</th>
                                  <th>Tidak Hadir</th>
                                  <th>Izin</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php $i = 1;
                                foreach ($data_kerja as $row) { ?>
                                  <tr>
                                      <td><?= $i++ ?></td>
                                      <td><span class="badge badge-outline-success"><?= date_format(date_create($row['date']), "l, d F Y") ?></td>
                                      <td><?= $row['jumlah_hadir'] ?></td>
                                      <td><?= $row['jumlah_tidak'] ?></td>
                                      <td><?= $row['jumlah_izin'] ?></td>
                                  </tr>
                              <?php } ?>
                          </tbody>
                      </table>
                  </div>
                  <hr>
                  <div class="modal-footer">
                      <!-- <button type="submit" class="btn btn-primary btn-fw">Simpan Data</button> -->
                      <button type="button" class="btn btn-outline-secondary btn-fw" data-dismiss="modal">CLOSE</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalLibur" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Detail Jadwal Libur</h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      <table class="table table-bordered">
                          <thead>

                              <tr>
                                  <th>No</th>
                                  <th>Tanggal</th>
                              </tr>

                          </thead>
                          <tbody>
                              <?php $i = 1;
                                foreach ($data_libur as $row) { ?>
                                  <tr>
                                      <td><?= $i++ ?></td>
                                      <td><span class="badge badge-outline-danger"><?= date_format(date_create($row['date']), "l, d F Y") ?></span></td>
                                  </tr>
                              <?php } ?>
                          </tbody>
                      </table>
                  </div>
                  <hr>
                  <div class="modal-footer">
                      <!-- <button type="submit" class="btn btn-primary btn-fw">Simpan Data</button> -->
                      <button type="button" class="btn btn-outline-secondary btn-fw" data-dismiss="modal">CLOSE</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalLiburNasional" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Detail Jadwal Libur Nasional</h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      <table class="table table-bordered">
                          <thead>

                              <tr>
                                  <th>No</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                              </tr>

                          </thead>
                          <tbody>
                              <?php $i = 1;
                                foreach ($data_libur_nasional as $row) { ?>
                                  <tr>
                                      <td><?= $i++ ?></td>
                                      <td><span class="badge badge-outline-warning"><?= date_format(date_create($row['date']), "l, d F Y") ?></span></td>
                                      <td><span class="badge badge-outline-primary"><?= $row['keterangan'] ?></span></td>
                                  </tr>
                              <?php } ?>
                          </tbody>
                      </table>
                  </div>
                  <hr>
                  <div class="modal-footer">
                      <!-- <button type="submit" class="btn btn-primary btn-fw">Simpan Data</button> -->
                      <button type="button" class="btn btn-outline-secondary btn-fw" data-dismiss="modal">CLOSE</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>


      <script>
          function addLibur() {
              calendar();
              $("#group div").remove();
              var checkLibur = document.getElementById("check_libur").checked;
              if (checkLibur == true) {
                  document.getElementById("group").hidden = false;
                  document.getElementById("group_add").hidden = false;
                  createElement();

              } else {
                  document.getElementById("group").hidden = true;
                  document.getElementById("group_add").hidden = true;
              }
          }

          function addToLibur() {

              createElement();
          }

          function createElement() {
              calendar();
              var formGroup = document.createElement('div');
              formGroup.setAttribute('class', 'form-group row');
              var colFirst = document.createElement("label");
              colFirst.setAttribute('class', 'col-sm-2 col-form-label');
              colFirst.innerHTML = 'Libur Nasional';
              var colSecond = document.createElement('div');
              colSecond.setAttribute('class', 'col-sm-5');
              colThird = document.createElement('div');
              colThird.setAttribute('class', 'col-sm-5');
              var input = document.createElement('input');
              input.setAttribute('type', 'text');
              input.setAttribute('class', 'form-control date');
              input.setAttribute('name', 'datefilter[]');
              input.setAttribute('placeholder', 'Input Tanggal libur Nasional');
              input.setAttribute('autocomplete', 'off');
              var inputKeterangan = document.createElement('input');
              inputKeterangan.setAttribute('type', 'text');
              inputKeterangan.setAttribute('class', 'form-control date');
              inputKeterangan.setAttribute('name', 'keterangan_libur[]');
              inputKeterangan.setAttribute('placeholder', 'Keterangan Libur');
              inputKeterangan.setAttribute('autocomplete', 'off');
              inputKeterangan.setAttribute('style', 'color:#fff');

              colSecond.appendChild(input);
              colThird.appendChild(inputKeterangan);
              formGroup.appendChild(colFirst);
              formGroup.appendChild(colSecond);
              formGroup.appendChild(colThird);
              $("#group").append(formGroup);
          }

          function calendar() {
              $(document).ready(function() {
                  $('input[name="datefilter[]"]').daterangepicker({
                      autoUpdateInput: false,
                      locale: {
                          cancelLabel: 'Clear'
                      }
                  });

                  $('input[name="datefilter[]"]').on('apply.daterangepicker', function(ev, picker) {
                      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                  });

                  $('input[name="datefilter[]"]').on('cancel.daterangepicker', function(ev, picker) {
                      $(this).val('');
                  });
              })
          }
      </script>
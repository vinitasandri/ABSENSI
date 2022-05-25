<!-- partial -->
<div class="main-panel">
  <?php if ($this->session->flashdata('text_toastr')) { ?>
    <p style="display:none;" id="text_toastr"><?= $this->session->flashdata('text_toastr'); ?></p>
    <p style="display:none;" id="type_toastr"><?= $this->session->flashdata('type_toastr'); ?></p>
  <?php } ?>
  <div class="content-wrapper">
    <?php if ($data_absensi == null) { ?>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card corona-gradient-card">
            <div class="card-body py-0 px-0 px-sm-3">
              <div class="row align-items-center">
                <div class="col-4 col-sm-3 col-xl-2">
                  <img src="<?= base_url() ?>assets/admin/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                </div>
                <div class="col-5 col-sm-7 col-xl-8 p-0">
                  <h4 class="mb-1 mb-sm-0">Mulai Absensi</h4>
                  <p class="mb-0 font-weight-normal d-none d-sm-block">Klik Tombol agar pegawai dapat melakukan absensi !</p>
                </div>
                <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                  <span>
                    <a data-toggle="modal" data-target="#modalAbsen"  class="btn btn-outline-light btn-rounded get-started-btn">Mulai Absensi</a>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Total Pegawai</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0"><?= count($data_pegawai); ?></h2>
                </div>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-account-card-details text-primary ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Sudah Presensi</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0"><?= count($data_sudahpresensi); ?></h2>
                </div>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-account-check text-success ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Belum Presensi</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0"><?= count($data_belumpresensi); ?></h2>
                </div>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-account-remove text-danger ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Terlambat</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0"><?= count($data_terlambat); ?></h2>
                </div>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-alarm-off text-danger ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Izin Tidak Masuk</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0"><?= count($data_izinpresensi); ?></h2>
                </div>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-alert-circle text-info ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Data Capture</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0"><?= count($data_sudahpresensi); ?></h2>
                </div>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi mdi-camera-front-variant text-primary ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalAbsen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-size">
      <div class="modal-content bg-primary">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mulai Absensi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Anda yakin ingin memulai absensi ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="<?= base_url() ?>absensi/startabsensi/" class="btn btn-primary">Mulai Absensi</a>
        </div>
      </div>
    </div>
  </div>  
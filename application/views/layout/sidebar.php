<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html"><img src="<?= base_url() ?>assets/admin/images/Logoo.png" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="<?= base_url() ?>assets/admin/images/Logo_mini.png" alt="logo" /></a>
      </div>
      <ul class="nav">
        <li class="nav-item profile">
          <div class="profile-desc">
            <div class="profile-pic">
              <div class="count-indicator">
                <img class="img-xs rounded-circle " src="<?= base_url() ?>assets/image_profile/user.png" alt="">
                <span class="count bg-success"></span>
              </div>
              <div class="profile-name">
                <h5 class="mb-0 font-weight-normal"><?= $this->session->userdata('full_name_session'); ?></h5>
                <span>Admin</span>
              </div>
            </div>
            <!-- <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a> -->
            <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-settings text-primary"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-onepassword  text-info"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-calendar-today text-success"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                </div>
              </a>
            </div>
          </div>
        </li>
        <li class="nav-item nav-category">
          <span class="nav-link"></span>
        </li>
        <?php if (isset($shift_index)) { ?>
          <li class="nav-item menu-items <?= $shift_index ?>">
          <?php } else { ?>
          <li class="nav-item menu-items">
          <?php } ?>

          <a class="nav-link" href="<?= base_url() ?>dashboard/">
            <span class="menu-icon">
              <i class="mdi mdi-home"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
          </li>
          <?php if (isset($verifikasi_active) || isset($pegawai_active)) { ?>
            <li class="nav-item menu-items active">
            <?php } else { ?>
            <li class="nav-item menu-items">
            <?php } ?>
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-clipboard-account"></i>
              </span>
              <span class="menu-title">Pegawai</span>
              <i class="menu-arrow"></i>
            </a>
            <?php if (isset($verifikasi_active) || isset($pegawai_active)) { ?>
              <div class="collapse show" id="ui-basic">
              <?php } else { ?>
                <div class="collapse" id="ui-basic">
                <?php } ?>
                <ul class="nav flex-column sub-menu">
                  <?php if (isset($pegawai_active)) { ?>
                    <li class="nav-item"> <a class="nav-link active" href="<?= base_url('home/list_pegawai/') ?>">Data Pegawai</a></li>
                  <?php } else { ?>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('home/list_pegawai/') ?>">Data Pegawai</a></li>
                  <?php } ?>
                  <?php if (isset($verifikasi_active)) { ?>
                    <li class="nav-item"> <a class="nav-link active" href="<?= base_url('home/verifikasi_pegawai/') ?>">Verifikasi Pegawai</a></li>
                  <?php } else { ?>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('home/verifikasi_pegawai/') ?>">Verifikasi Pegawai</a></li>
                  <?php } ?>
                </ul>
                </div>
            </li>
            <?php if (isset($jadwal)) { ?>
              <li class="nav-item menu-items active">
              <?php } else { ?>
              <li class="nav-item menu-items">
              <?php } ?>
              <a class="nav-link" href="<?= base_url() ?>home/jadwal_kerja/">
                <span class="menu-icon">
                  <i class="mdi mdi-playlist-remove"></i>
                </span>
                <span class="menu-title">Jadwal Kerja</span>
              </a>
              </li>
            <?php if (isset($surat_izin)) { ?>
              <li class="nav-item menu-items active">
              <?php } else { ?>
              <li class="nav-item menu-items">
              <?php } ?>
              <a class="nav-link" href="<?= base_url() ?>home/surat_izin/">
                <span class="menu-icon">
                  <i class="mdi mdi-playlist-remove"></i>
                </span>
                <span class="menu-title">Data Surat Izin</span>
              </a>
              </li>
              <?php if (isset($surat_cuti)) { ?>
                <li class="nav-item menu-items active">
                <?php } else { ?>
                <li class="nav-item menu-items ">
                <?php } ?>
                <a class="nav-link" href="<?= base_url() ?>home/surat_cuti/">
                  <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                  </span>
                  <span class="menu-title">Data Cuti Pegawai</span>
                </a>
                </li>
                <?php if (isset($perangkat)) { ?>
                <li class="nav-item menu-items active">
                <?php } else { ?>
                <li class="nav-item menu-items ">
                <?php } ?>
                <a class="nav-link" href="<?= base_url() ?>home/verifikasi_perangkat/">
                  <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                  </span>
                  <span class="menu-title">Verifikasi Perangkat</span>
                </a>
                </li>
                <?php if (isset($laporan_kehadiran) || isset($riwayat_kehadiran)) { ?>
                  <li class="nav-item menu-items active">
                  <?php } else { ?>
                  <li class="nav-item menu-items">
                  <?php } ?>
                  <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="ui-basic">
                    <span class="menu-icon">
                      <i class="mdi mdi-file-document-box"></i>
                    </span>
                    <span class="menu-title">Laporan</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <?php if (isset($laporan_kehadiran) || isset($riwayat_kehadiran)) { ?>
                    <div class="collapse show" id="laporan">
                    <?php } else { ?>
                      <div class="collapse " id="laporan">
                      <?php } ?>
                      <ul class="nav flex-column sub-menu">
                        <?php if (isset($laporan_kehadiran)) { ?>
                          <li class="nav-item"> <a class="nav-link active" href="<?= base_url() ?>home/laporan_kehadiran/">Laporan Kehadiran</a></li>
                        <?php } else { ?>
                          <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>home/laporan_kehadiran/">Laporan Kehadiran</a></li>
                        <?php } ?>
                        <?php if (isset($riwayat_kehadiran)) { ?>
                          <li class="nav-item"> <a class="nav-link active" href="<?= base_url() ?>home/riwayat_kehadiran/">Riwayat Kehadiran</a></li>
                        <?php } else { ?>
                          <li class="nav-item"> <a class="nav-link " href="<?= base_url() ?>home/riwayat_kehadiran/">Riwayat Kehadiran</a></li>
                        <?php } ?>
                      </ul>
                      </div>
                  </li>
                  <li class="nav-item nav-category">
                    <span class="nav-link">Lain-lain</span>
                  </li>
                  <?php if (isset($jabatan_active)) { ?>
                    <li class="nav-item menu-items <?= $jabatan_active; ?>">
                    <?php } else { ?>
                    <li class="nav-item menu-items">
                    <?php } ?>
                    <a class="nav-link" href="<?= base_url() . "home/list_jabatan" ?>">
                      <span class="menu-icon">
                        <i class="mdi mdi-wallet-travel"></i>
                      </span>
                      <span class="menu-title">Data Jabatan</span>
                    </a>
                    </li>
      </ul>
    </nav>
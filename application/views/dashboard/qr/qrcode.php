<!DOCTYPE html>
<html lang="en">

<head>
    <title>ABSENSI - PT Restu Prima Mandiri</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(<?= base_url('assets/login/') ?>images/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        ABSENSI QR SCANNER
                    </span>
                </div>
                <?php if ($this->session->flashdata('text')) { ?>
                    <p style="display: none;" id="icon"><?= $this->session->flashdata('icon'); ?></p>
                    <p style="display: none;" id="title"><?= $this->session->flashdata('title'); ?></p>
                    <p style="display: none;" id="text"><?= $this->session->flashdata('text'); ?></p>
                <?php } ?>

                <div class="alert alert-warning" style="margin:26px 88px 26px 80px;" role="alert">
                    <?php if (!isset($qr_code)) { ?>
                        Silahkan Masukan No Pegawai untuk melakukan absensi
                    <?php } else { ?>
                        Silahkan Scan QR Code dibawah ini !
                    <?php } ?>
                </div>

                <form class="login100-form validate-form" method="post" action="<?= base_url('qr/proses_qr') ?>">
                    <?php if (!isset($qr_code)) { ?>
                        <div style="margin-left: -15px;" class="wrap-input100 validate-input m-b-26" data-validate="Email is required">

                            <span style="font-weight:bold;" class="label-input100 "></span>
                            <input  class="input100" type="text" autocomplete="off" name="id_pegawai" placeholder="Masukan No Pegawai ...">
                            <span class="focus-input100"></span>
                        </div>
                    <?php } else { ?>
                        <center>
                            <img style="width: 350px; height:350px; margin-left:-40px;" class="justify-content-md-center" src="<?= base_url() ?>assets/image_qr/<?= $qr_code['qr_code']; ?>" alt="">
                        </center>
                    <?php } ?>

                    <div class="container-login100-form-btn">
                        <?php if (!isset($qr_code)) { ?>
                            <button class="login100-form-btn mr-5" style="margin-left:-10px">
                                QR CODE
                            </button>
                            <a href="<?= base_url() ?>" class="btn-second-qr">
                                Kembali
                            </a>
                        <?php } else { ?>
                            <center>
                            <a style="margin-left: 55px;" href="<?= base_url('qr/') ?>" class="login100-form-btn">
                                Kembali
                            </a>
                            </center>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url('assets/login/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url('assets/login/') ?>vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>js/main.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var text = document.getElementById("text");
        if (text != null) {
            var icon = document.getElementById("icon").innerHTML;
            var title = document.getElementById("title").innerHTML;
            swal({
                title: title,
                text: text.innerHTML,
                icon: icon,
            });
        }
    </script>

</body>

</html>
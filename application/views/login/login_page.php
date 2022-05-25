<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - PT Restu Prima Mandiri </title>
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
    <link rel="shortcut icon" href="<?= base_url() ?>assets/icon.jpeg" />
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(<?= base_url('assets/login/') ?>images/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        Sign In
                    </span>
                </div>
                <?php if ($this->session->flashdata('text')) { ?>
                    <p style="display: none;" id="icon"><?= $this->session->flashdata('icon'); ?></p>
                    <p style="display: none;" id="title"><?= $this->session->flashdata('title'); ?></p>
                    <p style="display: none;" id="text"><?= $this->session->flashdata('text'); ?></p>
                <?php } ?>
                <form style="padding-top: 44px;" class="login100-form validate-form" method="post" action="<?= base_url('login/process/') ?>">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Enter email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="pass" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <!-- <div class="contact100-form-checkbox">
                            <a href="<?= base_url() ?>qr/" class="txt1">
                                Klik untuk absensi
                            </a>
                        </div> -->

                        <!-- <div>
                            <a href="#" class="txt1">
                                Forgot Password?
                            </a>
                        </div> -->
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn mr-5">
                            Login
                        </button>
                        <a href="<?= base_url() ?>qr/" class="btn-second-qr">
                            Absensi
                        </a>
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
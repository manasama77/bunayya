<!DOCTYPE html>
<html lang="en">

<?php

include "configuration/config_connect.php";
$sql = mysqli_fetch_assoc(mysqli_query($conn, "SELECT avatar,nama FROM data where no='0'"));
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$msg = $_GET['msg'];
?>



<head>
    <meta charset="utf-8" />
    <title>Login | <?php echo $sql['nama']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <link href="assets/css/unsplash.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body class="authentication-bg authentication-bg-pattern d-flex align-items-center pb-0 vh-100 unsplash-bg-random">


    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="index.html">
                                            <img src="./assets/images/Login admin.jpg" alt="Icon Login Admin" style="width: 100px;">
                                        </a>
                                    </div>

                                    <?php if ($msg != '') { ?>
                                        <?php if ($msg == 'captcha') { ?>
                                            <h5 class="text-uppercase mb-1 mt-4 text-center" style="color:red">Captcha Salah</h5>
                                        <?php } else { ?>
                                            <h5 class="text-uppercase mb-1 mt-4 text-center" style="color:red">Password, Username atau Email salah!</h5>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <h5 class="text-uppercase mb-1 mt-4 text-center">Login Petugas</h5>
                                        <p class="mb-0 text-center">Login dengan username atau email anda </p>
                                    <?php } ?>

                                </div>

                                <div class="account-content mt-4">
                                    <form class="form-horizontal" action="otentikasi.php" method="post">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="emailaddress">Username/Email</label>
                                                <input class="form-control" type="text" id="txtuser" name="txtuser" required="" placeholder="myusername">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <a href="page-recoverpw.html" class="text-muted float-right"><small></small></a>
                                                <label for="password">Password</label>
                                                <input class="form-control" type="password" required="" id="txtpass" name="txtpass" placeholder="Enter your password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <a href="page-recoverpw.html" class="text-muted float-right"><small></small></a>
                                                <label for="password">Captcha</label>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" name="captcha" id="captcha" minlength="4" maxlength="4" required />
                                                    </div>
                                                    <div class="col-6">
                                                        <img src="assets/captcha.php" alt="PHP Captcha">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-md btn-block btn-primary waves-effect waves-light">Masuk</button>
                                            </div>
                                            <br><br> <br>
                                            <div class="col-12">
                                                <a href="login" class="btn btn-md btn-block btn-danger waves-effect waves-light">Kembali</a>
                                            </div>
                                        </div>

                                    </form>



                                    <div class="row mt-4 pt-2">
                                        <div class="col-sm-12 text-center">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
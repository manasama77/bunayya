<!DOCTYPE html>
<html lang="en">

<?php

include "configuration/config_connect.php";
$sql = mysqli_fetch_assoc(mysqli_query($conn, "SELECT avatar FROM data where no='0'"));
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$msg = $_GET['msg'];
?>

<head>
    <meta charset="utf-8" />
    <title>Login | Smart Payment by Trijaya Solution</title>
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



<body class="authentication-bg authentication-bg-pattern d-flex pb-0 vh-100 unsplash-bg-random">


    <div class="account-pages w-100 mt-6 mb-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-xs-12">


                    <h1 class="display-4 text-uppercase mb-1 mt-4 text-center"><i class="fa fa-graduation-cap"></i> Selamat Datang</h1>

                </div>
                <div class="col-md-12"> &nbsp;
                </div>

                <div class="col-md-6">
                    <a href="login_admin">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-4">
                                    <i class="fa fa-desktop fa-7x"></i>
                                </div>
                                <div class="col-8 ">
                                    <h2>Login Admin</h2>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="student">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-4">
                                    <i class="fa fa-users fa-7x"></i>
                                </div>
                                <div class="col-8 ">
                                    <h2>Login Siswa</h2>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
            </div>
            <h4 class="text-uppercase mb-1 mt-4 text-center">Aplikasi Manajemen Siswa
            </h4>

            <h5 class="text mb-1 mt-4 text-center">Developer by Trijaya Solution</h5>


        </div>



    </div>




    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
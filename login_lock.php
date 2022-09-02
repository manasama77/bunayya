<!DOCTYPE html>
<html lang="en">
<?php

session_start();

unset($_SESSION['jabatan']);

include "configuration/config_connect.php";
$sql=mysqli_fetch_assoc(mysqli_query($conn,"SELECT avatar FROM data where no='0'"));

?>

<head>
    <meta charset="utf-8" />
    <title>Kunci layar | SPP PINTAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

</head>

<body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">

    <div class="home-btn d-none d-sm-block">
        <a href="login"><i class="fas fa-home h2 text-white"></i></a>
    </div>

    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        
                                    </div>
                                </div>

                                <div class="account-content mt-4">
                                        <div class="text-center mb-3">
                                            <div class="mb-3">
                                                <img src="<?php echo $_SESSION['avatar'];?>" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                                            </div>

                                            <p class="text-muted mb-0 font-13">Masukan Password untuk Login </p>
                                        </div>

                                         <form class="form-horizontal" action="otentikasi.php" method="post">

                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="password">Password</label>
                                                    <input class="form-control" type="hidden" id="txtuser" name="txtuser"  value="<?php echo $_SESSION['username'];?>">
                                                    <input class="form-control" type="password" required="" id="txtpass" name="txtpass" placeholder="Masukan Password Anda">
                                                </div>
                                            </div>

                                            <div class="form-group row text-center mt-2">
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Masuk</button>
                                                </div>
                                            </div>

                                        </form>

                                        <div class="clearfix"></div>

                                        <div class="row mt-3">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted mb-0">Bukan Kamu? Kembali ke Halaman<a href="login" class="text-dark ml-1"><b>LOGIN</b></a></p>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->
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
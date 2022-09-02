<!DOCTYPE html>
<html lang="en">


<?php
include "configuration/config_connect.php";

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$res=$_GET['res'];
?>

<head>
    <meta charset="utf-8" />
    <title>RESET | SPP PINTAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
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
        <a href="index.html"><i class="fas fa-home h2 text-white"></i></a>
    </div>

    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                                <div class="account-box">
                                        <div class="text-center account-logo-box">
                                            <div>
                                                <a href="index.html">
                                                  
                                                </a>
                                            </div>
                                        </div>

<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if($res!='true'){?>

                                        <div class="account-content mt-4">
                                            <div class="text-center">
                                                <p class="text-muted mb-0 mb-3">Masukan 6 Digit PIN keamanan anda </p>
                                            </div>
                                            <form class="form-horizontal" action="" method="post">
    
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="emailaddress">PIN (6 Angka)</label>
                                                        <input class="form-control" type="password" name="pin" required="" placeholder="123456" autocomplete="off">
                                                    </div>
                                                </div>
    
                                                <div class="form-group row text-center mt-2">
                                                    <div class="col-12">
                                                        <button type="submit" name="reset" class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Reset Akun Admin</button>
                                                    </div>
                                                </div>
    
                                            </form>
    
                                            <div class="clearfix"></div>
    
                                            <div class="row mt-4">
                                                <div class="col-sm-12 text-center">
                                                    <p class="text-muted mb-0">Kembali <a href="login" class="text-dark ml-1"><b>Log in</b></a></p>
                                                </div>
                                            </div>
    
                                        </div>


<?php } else {?>


                                         <div class="account-content mt-4">
                                            <div class="text-center">
                                                <p class="text-muted mb-0 mb-3">PIN yang dimasukan BENAR, silahkan login dengan <br>
                                                    <b>User: admin dan Password: admin</b> </p>
                                            </div>
                                           
                                                <div class="form-group row text-center mt-2">
                                                    <div class="col-12">
                                                        <button class="btn btn-md btn-block btn-danger waves-effect waves-light"  
                                                        onclick="window.location.href='login'">HALAMAN LOGIN</button>
                                                    </div>
                                                </div>
    
                                          
    
                                            <div class="clearfix"></div>
    
                                           
    
                                        </div>

<?php } ?>

    
                                    </div>
                                    <!-- end card-box-->
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




<?php 
if(isset($_POST['reset'])){
if($_SERVER["REQUEST_METHOD"]=="POST"){

 $pin = mysqli_real_escape_string($conn, $_POST["pin"]);
    $pina=sha1(MD5($pin));

       $sql="select * from pin where pin='$pina'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){

          $_SESSION['pin']= $pina;
           
$password="90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad";
$user = "admin";

 $sql="select * from user where userna_me='$user'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
          $updt = "UPDATE user SET pa_ssword='$password',email='admin@admin.com', jabatan='$user' where userna_me='$user' ";
          $query =mysqli_query($conn, $updt);
          if ($query){
            echo "<script type='text/javascript'>window.location = 'reset?res=true';</script>";
          }
        } else {

           $sql2 = "insert into user values( '$user','admin@admin.com','$password','admin','alamat','111','2020-02-02','2020-02-02','admin','upload/image/placeholder.png','')";
            $query =mysqli_query($conn,$sql2);
             if ($query){
           echo "<script type='text/javascript'>window.location = 'reset?res=true';</script>";
          }
        }









        } else {
           echo "<script type='text/javascript'>  alert('PIN salah! Masukan PIN yang benar'); </script>";
           echo "<script type='text/javascript'>window.location = 'reset';</script>";
        }

}

}

?>
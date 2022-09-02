<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Password | <?php echo $app;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Aplikasi Kelola Sales dan Keuangan" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
<?php
connect();
head();timing();
session();
?>

<?php

if (!login_check()) {
?>
<meta http-equiv="refresh" content="0; url=logout" />
<?php
exit(0);
}
?>

<?php
body();
theader();
etc();


//Setting Halaman

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$halaman = "password"; // halaman
$dataapa = "Ganti Password"; // data
$tabeldatabase = "kosong"; // tabel database
$chmod = 5; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 $no=$_SESSION['id'];
 $nis=$_SESSION['nis'];
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->




<!-- END Letak Kode PHP atas -->





  <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->


            <div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- halaman dan breadcrumbs -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index">DashBoard</a></li>
                                           
                                            <li class="breadcrumb-item active"><?php echo $dataapa;?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $dataapa;?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end halaman dan breadcrumbs --> 


<!-- ISI HALAMAN -->





 <?php

       if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['update'])){


        $pesanError = array();
      if (trim($_POST['password'])=="") {
        $pesanError[] = "<b>Password</b> tidak boleh kosong !";    
      }

    
      if (trim($_POST['ulangi'])=="") {
        $pesanError[] = "<b>Konfirmasi Password</b> tidak boleh kosong !";    
      }

        if (trim($_POST['password'])!=$_POST['ulangi']) {
        $pesanError[] = "<b>Konfirmasi Password</b> tidak cocok !";    
      }


                      $nis = mysqli_real_escape_string($conn, $_POST["nis"]);
                     
                      $no= mysqli_real_escape_string($conn, $_POST["id"]);
                      $password= mysqli_real_escape_string($conn, $_POST["password"]);

                      $pass=sha1(md5($password));
                      $ulangi= mysqli_real_escape_string($conn,$_POST["ulangi"]);
                                         


if (count($pesanError)>=1 ){
        echo "<div class='alert alert-danger alert-dismissable'>";
        echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
          $noPesan=0;
          foreach ($pesanError as $indeks=>$pesan_tampil) { 
          $noPesan++;
            echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";  
          } 
        echo "</div>"; 
      }
      else {

$sqln="UPDATE student SET password='$pass' WHERE nis='$nis' AND student_id='$no'";


if(mysqli_query($conn,$sqln)){
echo "<script type='text/javascript'>window.location = '$forwardpage?update=true';</script>";
} else {
echo "<script type='text/javascript'>window.location = '$forwardpage?update=false';</script>";
}

    }

  } }

             ?>




<?php 
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$msg = $_GET['update'];


if ($msg == "false" ) {
?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal!</strong> Terjadi kesalahan,Hubungi admin </div>
<?php } else if($msg== "true"){?>
<div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Berhasil!</strong> Password telah diganti </div>

  <?php } ?>

                        	 <div class="row">
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Ganti Password</h4>
                                    <p class="sub-header">
                                        Password minimal 6 Digit dan berupa Angka atau huruf tanpa spasi
                                    </p>

                                    <div class="table-responsive">
                                        
                                        <form method="post">
                                                        <div class="form-group col-md-12">
                                                            <label for="inputCity" class="col-form-label">Password Baru</label>
                                                            <input type="password" class="form-control" name="password" id="password" autocomplete="off" required autocomplete="off">
                                                                
                                                        </div>
                                                        
                                                       
                                                        <div class="form-group col-md-12">
                                                            <label for="inputZip" class="col-form-label">Konfirmasi Password</label>
                                                             <input type="password" class="form-control" name="ulangi" id="password2" autocomplete="off" required autocomplete="off">
                                                        </div>
                                                        <input type="hidden" name="id" value="<?php echo $no;?>">
                                                        <input type="hidden" name="nis" value="<?php echo $nis;?>" >



                                                         <div class="form-group col-md-12">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="checkbox1" type="checkbox" onclick="myFunction()">
                                                    <label for="checkbox1">
                                                        Tampilkan
                                                    </label>
                                                </div>
                                            </div>


                                                 
                                                  <div class="col-6">
                                                    <button type="submit" class="btn btn-success btn-block" name="update">UPDATE</button>
                                                  </div>
                                               </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                     


   <!-- END ISI HALAMAN -->


                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->
<!--FOOTER-->
                
<?php footer();?>

<!-- END FOOTER-->

            </div>



              <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->






<!-- Sidebar Kanan -->

<!-- End Sidebar Kanan -->





<!-- Letak Kode PHP Bawah -->




<!-- END Letak Kode PHP bawah -->



 <script src="../assets/jQuery/jquery-3.1.1.min.js"></script>

 <script>
function myFunction() {
  var x = document.getElementById("password");
   var y = document.getElementById("password2");
  if (x.type === "password") {
    x.type = "text";
     y.type = "text";
  } else {
    x.type = "password";
     y.type = "password";
  }
}
</script>




<!-- Library & Pluggins-->
  <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>

        <script src="../assets/libs/switchery/switchery.min.js"></script>
        <script src="../assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="../assets/libs/select2/select2.min.js"></script>
        <script src="../assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
        <script src="../assets/libs/autocomplete/jquery.autocomplete.min.js"></script>
        <script src="../assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="../assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="../assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

         <script src="../assets/libs/moment/moment.min.js"></script>
        <script src="../assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="../assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="../assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
      

      <!-- Daterange dan Select2-->

       <script src="../assets/datepicker/bootstrap-datepicker.js"></script>
         <script src="../assets/daterangepicker/daterangepicker.js"></script>
            <script src="../assets/libs/select2/select2.min.js"></script>

              <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <script src="../assets/js/pages/sweet-alerts.init.js"></script>


         <!-- Init js-->
        <script src="../assets/js/pages/form-pickers.init.js"></script>

        <!-- Init js-->
        <script src="../assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>

<!-- END Lib & Plugins-->






</body>
</html>
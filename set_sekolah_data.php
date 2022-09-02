<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Profil Sekolah |<?php echo $app;?></title>
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
include "configuration/config_chmod.php";

$halaman = "set_sekolah_data"; // halaman
$dataapa = "sekolah"; // data
$tabeldatabase = "data"; // tabel database
$chmod = $chmenu8; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->


<?php
          $sql1="select * from data";
                           $hasil2 = mysqli_query($conn,$sql1);
                           while ($fill = mysqli_fetch_assoc($hasil2)){

          $nama = $fill['nama'];
          $email = $fill['email'];
          $web = $fill['web'];
          $npwp = $fill['npwp'];
          $alamat = $fill['alamat'];
          $notelp = $fill['notelp'];
          $tagline = $fill['tagline'];
          $signature = $fill['signature'];
          $avatar = $fill['avatar'];

          if($avatar !=''){

            $logo=$avatar;
        } else {
            $logo="upload/image/placeholder200x60.png";
        }

                  }

?>


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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaturan</a></li>
                                            <li class="breadcrumb-item active"><?php echo $dataapa;?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $dataapa;?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end halaman dan breadcrumbs --> 


<!-- ISI HALAMAN -->


                        	 <div class="row">
 <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>

                            <div class="col-md-3 col-xs-12">
                               <div class="card card-body">
                                    <h5 class="card-title">Data Sekolah</h5>
                                    <p class="card-text">Data sekolah yang benar sangat penting dalam kelangsungan KBM</p>
                                    <a href="set_sekolah" class="btn btn-blue waves-effect waves-light">Edit Data Sekolah</a>
                                </div>


   <!--                             <div class="card card-body">
                                    <h5 class="card-title">Data Rekening</h5>
                                    <p class="card-text">Menggunakan rekening mempermudah pembayaran SPP oleh siswa</p>
                                    <a href="set_rekening" class="btn btn-danger waves-effect waves-light">Edit Data Rekening</a>
                                </div>
-->


                            </div>

<?php } ?>

                             <div class="col-md-9 col-xs-12">
                                <div class="card-box">
                                    <h4 class="header-title" style="text-align:center"><?php echo $nama;?></h4>
                                    <p class="sub-header" style="text-align:center">
                                        <?php echo $tagline;?>
                                    </p>

                                    <div class="table-responsive">
                                        
                                        <div class="row col-12">


                                        <div class="col--md-6">
                                               <img src="<?php echo $logo;?>" alt="image"
                                                            class="img-fluid img-thumbnail" width="300"/>
                                                            <br> <br> <br>
                                                             <p><b><?php echo $signature;?></b></p>
                                        </div>

                                          <div class="col-md-6">

                                               <address class="line-h-24">
                                               <?php echo $notelp;?><br>
                                                <?php echo $npwp;?><br>
                                                <?php echo $email;?><br>
                                                <?php echo $web;?><br>
                                            </address>

                                            <p><?php echo $alamat;?></p>
                                          </div>



                                      </div>

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
<?php

right();

?>

<!-- End Sidebar Kanan -->





<!-- Letak Kode PHP Bawah -->




<!-- END Letak Kode PHP bawah -->




<!-- Library & Pluggins-->
  <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <script src="assets/libs/switchery/switchery.min.js"></script>
        <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="assets/libs/select2/select2.min.js"></script>
        <script src="assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
        <script src="assets/libs/autocomplete/jquery.autocomplete.min.js"></script>
        <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

         <script src="assets/libs/moment/moment.min.js"></script>
        <script src="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
      

      <!-- Daterange dan Select2-->

       <script src="assets/datepicker/bootstrap-datepicker.js"></script>
         <script src="assets/daterangepicker/daterangepicker.js"></script>
            <script src="assets/libs/select2/select2.min.js"></script>

              <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <script src="assets/js/pages/sweet-alerts.init.js"></script>


         <!-- Init js-->
        <script src="assets/js/pages/form-pickers.init.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

<!-- END Lib & Plugins-->






</body>
</html>
<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Rekening |<?php echo $app;?></title>
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

$halaman = "set_rekening"; // halaman
$dataapa = "Rekening"; // data
$tabeldatabase = "rekening"; // tabel database
$chmod = $chmenu8; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
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
                                            <li class="breadcrumb-item"><a href="set_perusahaan_data">Pengaturan</a></li>
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
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$msg = $_GET['insert'];

if ($msg == "false") {
?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal!</strong> Terjadi kesalahan </div>

<?php } else if ($msg == "exist"){ ?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal!</strong> Rekening tersebut sudah ada </div>

<?php } else if ($msg == "true"){ ?>

 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert"
 aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
 <strong>Berhasil!</strong> Rekening telah ditambahkan
 </div>
<?php } ?>

                        	 <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title">DATA REKENING</h4>
                                    <p class="sub-header">
                                        Minimal ada 1 rekening, disarankan maksimal 3
                                    </p>

                                    <div class="table-responsive">

                                            <form class="form-inline" method="post">
                                                    <div class="form-group mr-2">
                                                        <label for="exampleInputName2" class="mr-2">Bank</label>
                                                        <input type="text" class="form-control" id="exampleInputName2" placeholder="BCA" name="bank" required>
                                                    </div>
                                                    <div class="form-group mr-2">
                                                        <label for="exampleInputEmail2" class="mr-2">No.Rekening</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="0123456789" name="norek" required>
                                                    </div>

                                                     <div class="form-group mr-2">
                                                        <label for="exampleInputEmail2" class="mr-2">Nama</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="SMA FYMA" name="nama" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-blue waves-effect waves-light btn-md" name="rek">
                                                        Tambahkan
                                                    </button>
                                                </form>
                                                <br>

                                        <table class="table table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width:10%">No</th>
                                                <th>Bank</th>
                                                <th>No.Rekening</th>
                                                <th>Atas Nama Rekening</th>
                                                <th style="width:15%">Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
<?php $no=0;
$rek=mysqli_query($conn, "SELECT * FROM rekening ORDER BY no desc");
while($fill=mysqli_fetch_assoc($rek)){;?>

                                            <tr>
                                                                                               
                                                <td><?php echo ++$no;?></td>
                                                <td><?php echo mysqli_real_escape_string($conn,$fill['bank']);?></td>
                                                <td><?php echo mysqli_real_escape_string($conn,$fill['norek']);?></td>
                                                <td><?php echo mysqli_real_escape_string($conn,$fill['nama']);?></td>
                                                 <td>
                                                       <button class="demo-delete-row btn btn-danger btn-sm btn-icon" 
                                                onclick="window.location.href='component/delete/delete_biasa?no=<?php echo $fill['no'].'&'; ?>forward=<?php echo "rekening".'&';?>forwardpage=<?php echo $halaman.'&'; ?>chmod=<?php echo $chmod; ?>'"

                                                ><i class="fa fa-times"></i></button>
                                                 </td>
                                            </tr>
                                           <?php } ?>




                                            </tbody>
                                        </table>
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



<?php
if(isset($_POST['rek'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

          $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
          $bank = mysqli_real_escape_string($conn, $_POST["bank"]);
          $norek = mysqli_real_escape_string($conn, $_POST["norek"]);

          $sql="INSERT INTO rekening VALUES('','$bank','$nama','$norek')";

          if(mysqli_query($conn,$sql)){
             echo "<script type='text/javascript'>window.location = 'set_rekening?insert=true';</script>";
          } else {
              echo "<script type='text/javascript'>window.location = 'set_rekening?insert=false';</script>";
          }

      } } ?>


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
<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Edit POS |<?php echo $app;?></title>
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

$halaman = "pos_bayar"; // halaman
$dataapa = "POS Pembayaran"; // data
$tabeldatabase = "pos_bayar"; // tabel database
$chmod = $chmenu2; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->

<?php 
if(isset($_GET['q'])){
  $no=$_GET['q'];
  $query="SELECT * FROM pos_bayar WHERE id='$no'";
  $a=mysqli_fetch_assoc(mysqli_query($conn,$query));
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


<form method="post">
   

  <div class="row">
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">EDIT POS PEMBAYARAN</h4>
                                   



                                    <div class="table-responsive">
                                       

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">POS Pembayaran</label>
                                                                <input type="text" class="form-control" id="field-3" name="nama" value="<?php echo $a['nama'];?>" required>

                                                                 <input type="hidden" class="form-control" name="no" value="<?php echo $no;?>" required>
                                                              
                                                            </div>
                                                        </div>
                                                   

                                                   
                                                   
                                                   
                                                        <div class="col-md-12">
                                                            <div class="form-group no-margin">
                                                                <label for="field-7" class="control-label">Deskripsi</label>
                                                                <textarea class="form-control" id="field-7" name="ket"><?php echo $a['keterangan'];?></textarea>
                                                            </div>
                                                        </div>
                                                   
                                        
                                    </div>
                                </div>

                            </div>


                             <div class="col-lg-3">
                                <div class="card-box">
                                    <h4 class="header-title">AKSI</h4>
                                    <br>

                                    <div class="table-responsive">
                                       
                                       <button type="submit" name="update" class="btn btn-success waves-effect waves-light btn-block">SIMPAN</button>
                                         <a href="pos_bayar" class="btn btn-danger waves-effect waves-light btn-block">BATAL</a>
                                                                                                          
                                        
                                    </div>
                                </div>

                            </div>

</div>
                                </form>
                     

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
if(isset($_POST['update'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

          $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
           $ket = mysqli_real_escape_string($conn, $_POST["ket"]);
             $id = mysqli_real_escape_string($conn, $_POST["no"]);
        
           $sqla="select * from pos_bayar where id='$id'";
        $result=mysqli_query($conn,$sqla);


           if(mysqli_num_rows($result)>0){

            $sql="UPDATE pos_bayar SET nama='$nama', keterangan='$ket' WHERE id='$id'";

            if(mysqli_query($conn,$sql)){
                 echo "<script type='text/javascript'>window.location = '$forwardpage?insert=update';</script>";
            } else {
                 echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
            }

           } else{
             echo "<script type='text/javascript'>window.location = '$forwardpage?insert=nonexist';</script>";
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
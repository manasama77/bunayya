<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Nama Bulan |<?php echo $app;?></title>
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

$halaman = "set_bulan"; // halaman
$dataapa = "Nama Bulan"; // data
$tabeldatabase = "months"; // tabel database
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

 <script>
 window.setTimeout(function() {
    $("#myAlert").fadeTo(200, 0).slideUp(400, function(){
        $(this).remove();
    });
}, 2000);
</script>


<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$msg = $_GET['update'];

if ($msg == "false") {
?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal Query!</strong> Terjadi kesalahan </div>

<?php } else if ($msg == "true"){ ?>
 <div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Berhasil!</strong> Nama Bulan telah diupdate </div>


<?php } else if ($msg == "blank"){ ?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>GAGAL!</strong> Nama Bulan wajib diisi</div>

<?php } ?>




                        	 <div class="row">
                            <div class="col-6">
                                <div class="card-box">
                                    <h4 class="header-title">Pengaturan Bulan</h4>
                                    <p class="sub-header">
                                       Sesuaikan Nama dan Urutan Bulan berdasar kebutuhan anda
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width:10%">No</th>
                                                <th>Nama Bulan</th>
                                                 <th>Form Edit</th>
                                                                                               
                                                <th style="width:20%">Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
<?php $no=0;
$rek=mysqli_query($conn, "SELECT * FROM months ORDER BY month_id");
while($fill=mysqli_fetch_assoc($rek)){;?>

                                            <tr>
                                                                 <form method="post">                              
                                                <td><?php echo ++$no;?></td>
                                                <td><?php echo mysqli_real_escape_string($conn,$fill['month_name']);?></td>

                                               <td><input type="text" class="form-control" name="nama" value="<?php echo $fill['month_name'];?>">
                                                <input type="hidden" class="form-control" name="id" value="<?php echo $fill['month_id'];?>"></td>
                                               
                                                 <td>

                                                    <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>

                                                     
                                                        <button type="submit"  name="bulan" class="demo-delete-row btn btn-info btn-sm btn-icon" ><i class="fa fa-save"></i> Simpan</button>

                                             

                                                 </td>
                                             </form>

                                               <?php } ?>

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
if(isset($_POST['bulan'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

          $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
          $id = mysqli_real_escape_string($conn, $_POST["id"]);

          if($nama!=''){
            $sql="UPDATE months SET month_name='$nama', status='inactive' WHERE month_id='$id'";

            if(mysqli_query($conn,$sql)){
                 echo "<script type='text/javascript'>window.location = '$forwardpage?update=true';</script>";
            } else {
                 echo "<script type='text/javascript'>window.location = '$forwardpage?update=false';</script>";
            }
          } else {
            echo "<script type='text/javascript'>window.location = '$forwardpage?update=blank';</script>";
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
<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
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

$halaman = "set_aplikasi"; // halaman
$dataapa = "Pengaturan Aplikasi"; // data
$tabeldatabase = "backset"; // tabel database
$chmod = $chmenu6; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->

     <?php
 $sql="select * from backset";
                  $hasil2 = mysqli_query($conn,$sql);
                  while ($fill = mysqli_fetch_assoc($hasil2)){

  $url = $fill['url'];
  $session = $fill['sessiontime'];
  $footer = $fill['footer'];
  
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
                           <div class="col-md-6">
                                    <div class="card-box">
                                        <h4 class="header-title mb-3">Pengaturan</h4>
                                     <form method="post" action="">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Url Aplikasi </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $url;?>" name="url">
                                            </div>
                                            Contoh: <code class="highlighter-rouge">http://localhost/spppintar</code> atau <code class="highlighter-rouge">http://spppintar.com</code>
                                            <div class="form-group">
                                                
                                            </div>

                                             <div class="form-group">
                                                <label for="exampleInputPassword1">Durasi Login (dalam menit)</label>
                                                <input type="text" class="form-control" value="<?php echo $session;?>" name="time">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Footer</label>
                                                <input type="text" class="form-control" value="<?php echo $footer;?>" name="footer">
                                            </div>
                                           
 <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                            <button type="submit" class="btn btn-purple waves-effect waves-light" name="simpan">SIMPAN</button>
          <?php } ?>
                                        </form>
                                    </div>
                                </div>


                                 <div class="col-md-6">
                                    <div class="card-box">
                                        <h4 class="header-title mb-3">Back Up/Pencadangan Database</h4>
                                     <form method="post" action="">
                                            
                                            <p><b>Lakukan Pencadangan Database secara berkala untuk mengamankan data anda</b></p>
                                            <p><b>Hasil Backup berupa file .sql yang bisa diimport ke komputer atau server lain</b></p>

                                                                                      
 <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                            <a href="set_backup_act" class="btn btn-success waves-effect waves-light" >Download Backup Database</a>
          <?php } ?>
                                        </form>
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


        if(isset($_POST['simpan'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

          $url = mysqli_real_escape_string($conn, $_POST["url"]);
           $time = mysqli_real_escape_string($conn, $_POST["time"]);
            $foo = mysqli_real_escape_string($conn, $_POST["footer"]);

            $sql="UPDATE backset SET url='$url', footer='$foo', sessiontime='$time'";

            if(mysqli_query($conn,$sql)){
                 
                 echo '<script>
    setTimeout(function() {
        swal({
    title: "Berhasil!",
    text: "Pengaturan telah disimpan, klik ok untuk refresh!",
    type: "success"
}).then(function() {
    window.location = "set_aplikasi";
});
    }, 1000);
</script>';


       } else {

         echo '<script>
    setTimeout(function() {
       Swal.fire({
     type: "error",
     title: "Oops...",
     text: "Terjadi Kesalahan!",
     footer: "Periksa Kembali Input Anda"
   })
    }, 1000);
</script>';

       }

} }
?>
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

         
 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>


         <!-- Init js-->
        <script src="assets/js/pages/form-pickers.init.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

<!-- END Lib & Plugins-->






</body>
</html>
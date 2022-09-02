<!DOCTYPE html>
<html>
 <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Keamanan dan Reset |<?php echo $app;?></title>
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

$halaman = "set_keamanan"; // halaman
$dataapa = "PIN pengaman & Reset Aplikasi"; // data
$tabeldatabase = "pin"; // tabel database
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
         $sql="select * from pin ";
                  $hasil2 = mysqli_query($conn,$sql);
                 $fill = mysqli_fetch_assoc($hasil2);
         
          $ubah = $fill["ubah"];



$reset=$_GET['reset'];

if($reset=='true'){

 echo '<script>
    setTimeout(function() {
        swal({
    title: "Berhasil!",
    text: "Data Aplikasi telah di Reset, klik Ok untuk refresh!",
    type: "success"
}).then(function() {
    window.location = "set_keamanan";
});
    }, 1000);
</script>';

} else if($reset=='false') {


 echo '<script>
    setTimeout(function() {
        swal({
    title: "Oops, Terjadi kesalahan!",
    text: "Perika apakah data telah terhapus seluruhnya!",
     type: "info"
   }).then(function() {
    window.location = "set_keamanan";
});
    }, 1000);
</script>';


} else if($reset=='pin'){
echo '<script>
    setTimeout(function() {
        swal({
    title: "Berhasil!",
    text: "PIN telah diganti, klik Ok untuk refresh!",
    type: "success"
}).then(function() {
    window.location = "set_keamanan";
});
    }, 1000);
</script>';

}



?>

                   <!-- /.box-body -->

                        <!-- ./col -->

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
                            <div class="col-6">
                                <div class="card-box">
                                    <h4 class="header-title">PIN KEAMANAN</h4>
                                    <p class="sub-header">
                                        Gunakan PIN untuk reset user admin ketika anda lupa Password.
                                    </p>

                                    <div class="alert alert-warning text-danger alert-dismissible fade show" role="alert">
                                                
                                                </button>
                                                <strong>Peringatan!</strong> Mengganti PIN akan membuat anda tidak bisa login sama sekali jika sampai LUPA. Catat PIN Anda untuk jaga jaga.
                                            </div>

                                                <p>PIN standar adalah 123456, sudah dilakukan <?php echo $ubah;?> kali perubahan pin</p>
                                    <div class="table-responsive">

                                        <form method="post">
                                         <div class="form-group">
                                                <label for="exampleInputPassword1">Masukan PIN Lama Anda</label>
                                                <input type="text" class="form-control" name="pinlama">

                                            </div>
                                        
                                         <div class="form-group">
                                                <label for="exampleInputPassword1">Masukan PIN Baru (6 Digit)</label>
                                                <input type="text" class="form-control" name="pin">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Konfirmasi PIN (6 digit)</label>
                                                <input type="text" class="form-control" name="newpin">
                                                <input type="hidden" class="form-control" name="ubah" value="<?php echo $ubah;?>">
                                            </div>

                                             <div class="col-md-6 col-xs-12">
                                             <?php  if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                                                    <button type="submit" class="btn btn-blue btn-block" name="setpin">GANTI PIN</button>
                                                  <?php } ?>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>






                               <div class="col-6">
                                <div class="card-box">
                                    <h4 class="header-title">RESET APLIKASI</h4>
                                    <p class="sub-header">
                                        Tombol Reset akan menghapus semua data dan mengembalikan aplikasi seperti saat pertama diinstal
                                    </p>

                                         <div class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                                                
                                                </button>
                                                <strong>Peringatan!</strong> Dengan Klik Tombol dibawah ini akan menghapus secara permanen semua data yang anda masukan sejak awal pemakaian Aplikasi!!!
                                            </div>

                                    <div class="table-responsive">

                                        <?php  if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                                        <button type="button" class="btn btn-icon waves-effect waves-light btn-danger btn-block" data-toggle="modal" data-target="#reset"> <i class="fas fa-times"></i> <b>RESET</b></button>
                                      <?php } ?>


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



 <div id="reset" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    
                                                    <h4 class="modal-title">Anda Yakin???</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <p class="sub-header">
                                     <b>   Tindakan ini akan mengakibatkan data anda terhapus permanen dan aplikasi akan seperti diawal instalasi </b>
                                                      </p>

                                                         <div class="modal-footer">
                                                            <div class="col-9">
                                                                
                                                    <a href="set_keamanan_reset?reset=1" class="btn btn-danger waves-effect waves-light">Ya, Saya Paham</a>
                                                </div>
                                            
                                                <div class="col-3">

                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                                    </div>

                                                </div>

                                                  </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->



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

      if(isset($_POST['setpin'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

    

          $oldpin = mysqli_real_escape_string($conn, $_POST["pinlama"]);
          
          $pin = mysqli_real_escape_string($conn, $_POST["pin"]);
            $newpin = mysqli_real_escape_string($conn, $_POST["newpin"]);
         
           $ubah = mysqli_real_escape_string($conn, $_POST["ubah"]);

           $ch = $ubah + 1;
          
if ( (strlen($pin)!=6) && (!is_numeric($pin)) ){
echo "<script type='text/javascript'>  alert('PIN harus 6 Digit Angka!'); </script>";

} else if($pin != $newpin) {
 
echo "<script type='text/javascript'>  alert('PIN yang dimasukan tidak sesuai dengan konfirmasi PIN!'); </script>";
} else {
            $oldpina= sha1(MD5($oldpin));
             $pina=sha1(MD5($pin));

             $sql="select * from pin where pin='$oldpina'";
        $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0){
              $sql ="UPDATE pin SET pin='$pina', ubah='$ch' WHERE pin='$oldpina' ";
              $up =mysqli_query($conn, $sql);
              
                  echo "<script type='text/javascript'>window.location = 'set_keamanan?reset=pin';</script>";
          } else {
                  echo "<script type='text/javascript'>  alert('GAGAL, PIN yang anda masukan Salah!'); </script>";

          }

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
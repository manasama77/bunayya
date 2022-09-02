<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Hak Akses |<?php echo $app;?></title>
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

$halaman = "user_chmod"; // halaman
$dataapa = "Hak Akses"; // data
$tabeldatabase = "chmenu"; // tabel database
$chmod = $chmenu7; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->

  <?php

$id=$_GET['id'];

 $sql="select * from chmenu where userjabatan LIKE '$id'";
                  $hasil2 = mysqli_query($conn,$sql);
                 $fill = mysqli_fetch_assoc($hasil2);

  $userjabatan = $fill['userjabatan'];
  $menu1 = $fill['menu1'];
  $menu2 = $fill['menu2'];
  $menu3 = $fill['menu3'];
  $menu4 = $fill['menu4'];
  $menu5 = $fill['menu5'];
  $menu6 = $fill['menu6'];
  $menu7 = $fill['menu7'];
  $menu8 = $fill['menu8'];
  $menu9 = $fill['menu9'];
  $menu10 = $fill['menu10'];
  $menu11 = $fill['menu11'];
          

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
                                            <li class="breadcrumb-item"><a href="user">Manajemen User</a></li>
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

<?php } else if ($msg == "update"){ ?>
 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Berhasil!</strong> Hak akses telah diperbarui </div>

<?php } else if ($msg == "true"){ ?>

 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert"
 aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
 <strong>Berhasil!</strong> Jabatan telah diberikan hak akses
 </div>
<?php } ?>




                        	 <div class="row">
                            <div class="col-md-6">
                                <div class="card-box">
                                    <h4 class="header-title">Atur Hak Akses</h4>
                                    <p class="sub-header">
                                       Atur Menu apa saja yang bisa diakses oleh suatu jabatan
                                    </p>

                                    <div class="table-responsive">
                                        <form method="post">


<?php 
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

?>
                                        
                                         <div class="form-group">
                                                <label for="exampleInputEmail1">Jabatan</label>
                                                <input type="text" class="form-control" name="userjabatan" value="<?php echo $id;?>" readonly>
                                                  
                                            </div>


                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Pembayaran SPP</label>
                                                <input type="text" class="form-control" name="menu1" value="<?php echo $menu1;?>" maxlength="1">
                                            </div>

                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Atur Pembayaran</label>
                                                <input type="text" class="form-control" name="menu2" value="<?php echo $menu2;?>" maxlength="1" >                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Jurnal Umum</label>
                                                <input type="text" class="form-control" name="menu3" value="<?php echo $menu3;?>" maxlength="1">
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Manajemen Sekolah</label>
                                                <input type="text" class="form-control" name="menu4" value="<?php echo $menu4;?>" maxlength="1">
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Pengumuman</label>
                                                <input type="text" class="form-control" name="menu5" value="<?php echo $menu5;?>" maxlength="1">
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Laporan</label>
                                                <input type="text" class="form-control" name="menu6" value="<?php echo $menu6;?>" maxlength="1">
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Manajemen User</label>
                                                <input type="text" class="form-control" name="menu7" value="<?php echo $menu7;?>" maxlength="1">
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Pengaturan</label>
                                                <input type="text" class="form-control" name="menu8" value="<?php echo $menu8;?>" maxlength="1">
                                            </div>
                           


                                             <button type="submit" name="simpan" class="btn btn-purple waves-effect waves-light">SIMPAN</button>

                                         </form>
                                                 </div>
                                </div>
                            </div>



                             <div class="col-md-6">
                                <div class="card-box">
                                    <h4 class="header-title">Keterangan</h4>
                                    <p class="sub-header">
                                        Ikuti pedoman pada tabel berikut dalam memberikan Hak Akses
                                    </p>

                                    <div class="table-responsive">



                                             <table class="table m-0 table-colored-bordered table-bordered-blue">
                                            <thead>
                                            <tr>
                                                <th style="width:10%">Angka</th>
                                                <th>Keterangan</th>
                                               
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Angka 1 untuk <b>"tidak bisa akses sama sekali"</b></td>
                                               
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Angka 2 untuk <b>"hanya bisa melihat"</b></td>
                                                
                                            </tr>
                                            <tr>
                                               <th scope="row">3</th>
                                                <td>Angka 3 untuk <b>"hanya bisa melihat dan Tambah data"</b></td>
                                             
                                            </tr>

                                            <tr>
                                               <th scope="row">4</th>
                                                <td>Angka 4 untuk <b>"Bisa melihat dan Tambah data dan Edit"</b></td>
                                             
                                            </tr>

                                             <tr>
                                               <th scope="row">5</th>
                                                <td>Angka 5 untuk <b>"Bisa Semua" termasuk Hapus Data</b></td>
                                             
                                            </tr>
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
       if($_SERVER["REQUEST_METHOD"] == "POST"){
  $userjabatan = $_POST['userjabatan'];
  $menu1 = $_POST['menu1'];
  $menu2 = $_POST['menu2'];
  $menu3 = $_POST['menu3'];
  $menu4 = $_POST['menu4'];
  $menu5 = $_POST['menu5'];
  $menu6 = $_POST['menu6'];
  $menu7 = $_POST['menu7'];
  $menu8 = $_POST['menu8'];
  $menu9 = 1;
  $menu10 = 1;
  $menu11 = 1;
   $no = $_POST['no'];


        if(isset($_POST['simpan'])){
           $sql="select * from chmenu where userjabatan = '$userjabatan'";
                  $result=mysqli_query($conn,$sql);

              if(mysqli_num_rows($result)>0){

           $sql1 = "update chmenu set menu1='$menu1', menu2='$menu2', menu3='$menu3', menu4='$menu4', menu5='$menu5', menu6='$menu6', menu7='$menu7', menu8='$menu8',menu9='$menu9',menu10='$menu10',menu11='$menu11' where userjabatan = '$userjabatan'";
             $result = mysqli_query($conn, $sql1);?>
             <?php echo "<script type='text/javascript'>window.location = '$forwardpage?id=$id&insert=update';</script>"; ?><?php

             
        }else{
                $sql1 = "insert into chmenu values('$userjabatan','$menu1','$menu2','$menu3','$menu4','$menu5','$menu6','$menu7','$menu8','$menu9','$menu10','$menu11')";
              $result = mysqli_query($conn, $sql1);?>
              <?php echo "<script type='text/javascript'>window.location = '$forwardpage?id=$id&insert=true';</script>"; ?><?php
        }
          }
       }
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
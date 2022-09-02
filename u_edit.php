<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Edit |<?php echo $app;?></title>
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
$ref=$_GET['ref'];
$halaman = "u_edit"; // halaman
$dataapa = "Edit"; // data
$tabeldatabase = "uang_masuk_keluar"; // tabel database
$chmod = $chmenu3; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman
$no=$_GET['q'];

//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->

<?php
$a=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM uang_masuk_keluar WHERE no='$no'"));
$jenis=$a['tipe'];


if($jenis=='out'){
    $data="Pengeluaran";
} else {
    $data="Pemasukan";
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
                                    <h4 class="page-title"><?php echo ''.$dataapa.' '.$data.'';?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end halaman dan breadcrumbs --> 


<!-- ISI HALAMAN -->

<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$msg=$_GET['edit'];
if($msg=="false"){?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span> </button>
<strong>Gagal!</strong>Terjadi Kesalahan, hubungi Admin</div>
<?php } ?>

<form method="post">
                             <div class="row">
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Form Edit</h4>
                                   
                                    <div class="table-responsive">

                                       
                                             <div class="form-group">
                                                <label for="exampleInputPassword1">Nama</label>
                                                <input type="text" class="form-control" value="<?php echo $a['nama'];?>" name="nama">
                                                <input type="hidden" class="form-control" value="<?php echo $no;?>" name="no">
                                            </div>

                                                 <div class="form-group">
                                                <label for="exampleInputPassword1">Tanggal</label>
                                                <input type="text" class="form-control" id="datepicker" value="<?php echo $a['tgl_update'];?>" name="tgl">                                           </div>

                                             <div class="form-group">
                                                <label for="exampleInputPassword1">Jumlah</label>
                                                <input type="text" class="form-control" value="<?php echo $a['jumlah'];?>" name="jumlah" >
                                            </div>

                                             <div class="form-group">
                                                <label for="exampleInputPassword1">Kategori</label>
                                               <select class="form-control" data-toggle="select2" style="width: 100%;" name="kate" id="kate">
                                                               
                                          <?php
                                    $sql=mysqli_query($conn,"select * from uang_kategori where jenis='$jenis'");
                                    while ($row=mysqli_fetch_assoc($sql)){
                                      if ($a['kategori_id']==$row['kategoori_id'])
                                      echo "<option value='".$row['kategori_id']."' selected='selected'>".$row['nama']."</option>";
                                      else
                                      echo "<option value='".$row['kategori_id']."'>".$row['nama']."</option>";
                                    }
                                  ?>
                               
                                                </select>
                                            </div>

                                              <div class="form-group">
                                                <label for="exampleInputPassword1">Keterangan</label>
                                                <input type="text" class="form-control" value="<?php echo $a['keterangan'];?>" name="ket" >
                                            </div>

                                       
                                    </div>
                                </div>
                            </div>

                           

                             <div class="col-lg-3">
                                <div class="card-box">
                                    <h4 class="header-title">Tindakan</h4>
                                   
                                    <div class="table-responsive">

                                       
                                             
                                             <button type="submit" name="simpan" class="btn btn-block btn-success waves-effect width-md waves-light">SIMPAN</button>

                                               <a href="pay_add?t=<?php echo $t;?>&s=<?php echo $sqlb['nis'];?>" class="btn btn-block btn-danger waves-effect width-md waves-light">KEMBALI</a>
                                       
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

if(isset($_POST['simpan'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

    $no = mysqli_real_escape_string($conn, $_POST["no"]);
    $nama= mysqli_real_escape_string($conn, $_POST["nama"]);
     $tgl= mysqli_real_escape_string($conn, $_POST["tgl"]);
     $jml= mysqli_real_escape_string($conn, $_POST["jumlah"]);
      $kate= mysqli_real_escape_string($conn, $_POST["kate"]);
       $ket= mysqli_real_escape_string($conn, $_POST["ket"]);

       $sql="UPDATE uang_masuk_keluar SET nama='$nama',jumlah='$jml',keterangan='$ket',tgl_update='$tgl', kategori_id='$kate' WHERE no='$no'";


       if(mysqli_query($conn,$sql)){
            echo "<script type='text/javascript'>window.location = '$ref?insert=update';</script>";
       } else {
         echo "<script type='text/javascript'>window.location = '$forwardpage?edit=false';</script>";
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
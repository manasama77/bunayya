<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Konfirmasi Hapus |<?php echo $app;?></title>
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


include "configuration/config_chmod.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$halaman = "deletion"; // halaman
$dataapa = $_GET['d']; // data
$tabeldatabase = $_GET['f']; // tabel database
$next=$_GET['r'];
$chmod = 5; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $next); // halaman
$no=$_GET['key'];

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
                                            
                                            <li class="breadcrumb-item active">Hapus</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Konfirmasi</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end halaman dan breadcrumbs --> 


<!-- ISI HALAMAN -->


                        	 <div class="row">
                            <div class="col-6">
                                 <div class="card">

<?php if($forward=='student'){?>

                                    <div class="card-header bg-danger text-white">
                                        <div class="card-widgets">
                                            <a href="<?php echo $next;?>" ><i class="mdi mdi-undo"></i></a>
                                           
                                        </div>
                                        <h5 class="card-title mb-0 text-white">Anda yakin menghapus data <?php echo $dataapa;?> ini?</h5>
                                    </div>
                                    <div id="cardCollpase4" class="collapse show">
                                        <form method="post">
                                        <div class="card-body">
                                            <b>Menghapus data ini akan berakibat:</b><br><br>
                                           <ol class="mb-0">
                                                <li>
                                                    Data <?php echo $dataapa;?> ini terhapus
                                                </li>
                                                <li>
                                                   Data pembayaran <?php echo $dataapa;?> ini terhapus
                                                </li>
                                               
                                               <input type="hidden" name="forward" value="<?php echo $forward;?>">
                                               <input type="hidden" name="next" value="<?php echo $next;?>">
                                                <input type="hidden" name="no" value="<?php echo $no;?>">
                                                 <input type="hidden" name="data" value="<?php echo $dataapa;?>">
                                               
                                            </ol>

                                            <br>
                                             <button type="submit" name="siswa" class="btn btn-danger waves-effect width-md waves-light">HAPUS</button>
                                             </form>
                                        </div>
                                    </div>


<?php } else if($forward=='periode'){?>


 <div class="card-header bg-danger text-white">
                                        <div class="card-widgets">
                                            <a href="<?php echo $next;?>" ><i class="mdi mdi-undo"></i></a>
                                           
                                        </div>
                                        <h5 class="card-title mb-0 text-white">Anda yakin menghapus data <?php echo $dataapa;?> ini?</h5>
                                    </div>
                                    <div id="cardCollpase4" class="collapse show">
                                        <form method="post">
                                        <div class="card-body">
                                            <b>Menghapus data ini akan berakibat:</b><br><br>
                                           <ol class="mb-0">
                                                <li>
                                                    Data <?php echo $dataapa;?> ini terhapus
                                                </li>
                                                <li>
                                                   Data pembayaran bulanan, non bulanan dan Jurnal Umum Penerimaan yang terkait dengan <?php echo $dataapa;?> ini akan ikut terhapus
                                                </li>
                                                <li>
                                                    Semua Data Pembayaran siswa, termasuk Jenis Pembayarannya yang terkait <?php echo $dataapa;?> ini terhapus
                                                </li>
                                               
                                               <input type="hidden" name="forward" value="<?php echo $forward;?>">
                                               <input type="hidden" name="next" value="<?php echo $next;?>">
                                                <input type="hidden" name="no" value="<?php echo $no;?>">
                                                 <input type="hidden" name="data" value="<?php echo $dataapa;?>">
                                               
                                            </ol>

                                            <br>
                                             <button type="submit" name="periode" class="btn btn-danger waves-effect width-md waves-light">HAPUS</button>
                                             </form>
                                        </div>
                                    </div>


<?php } else if($forward=='jenis_bayar'){
        $t=$_GET['t'];

        if($t=='bulanan'){

    ?>

                                    <div class="card-header bg-danger text-white">

                                         <div class="card-widgets">
                                            <a href="<?php echo $next;?>" ><i class="mdi mdi-undo"></i></a>
                                           
                                        </div>
                                        <h5 class="card-title mb-0 text-white">Anda yakin menghapus data <?php echo $dataapa;?> ini?</h5>
                                    </div>
                                    <div id="cardCollpase4" class="collapse show">
                                        <form method="post">
                                        <div class="card-body">
                                            <b>Menghapus data ini akan berakibat:</b><br><br>
                                           <ol class="mb-0">
                                                <li>
                                                    Data <?php echo $dataapa;?> ini terhapus
                                                </li>
                                                <li>
                                                   Data pembayaran bulanan dan Jurnal Umum Penerimaan yang terkait dengan <?php echo $dataapa;?> ini akan ikut terhapus
                                                </li>
                                                <li>
                                                    Semua Data Pembayaran siswa yang terkait <?php echo $dataapa;?> ini terhapus
                                                </li>
                                               
                                               <input type="hidden" name="forward" value="<?php echo $forward;?>">
                                               <input type="hidden" name="next" value="<?php echo $next;?>">
                                                <input type="hidden" name="no" value="<?php echo $no;?>">
                                                 <input type="hidden" name="data" value="<?php echo $dataapa;?>">
                                               
                                            </ol>

                                            <br>
                                             <button type="submit" name="bulanan" class="btn btn-danger waves-effect width-md waves-light">HAPUS</button>
                                             </form>
                                        </div>
                                    </div>
        <?php } else { ?>

 <div class="card-header bg-danger text-white">

                                         <div class="card-widgets">
                                            <a href="<?php echo $next;?>" ><i class="mdi mdi-undo"></i></a>
                                           
                                        </div>
                                        <h5 class="card-title mb-0 text-white">Anda yakin menghapus data <?php echo $dataapa;?> ini?</h5>
                                    </div>
                                    <div id="cardCollpase4" class="collapse show">
                                        <form method="post">
                                        <div class="card-body">
                                            <b>Menghapus data ini akan berakibat:</b><br><br>
                                           <ol class="mb-0">
                                                <li>
                                                    Data <?php echo $dataapa;?> ini terhapus
                                                </li>
                                                <li>
                                                   Data pembayaran bebas, cicilan siswa dan Jurnal Umum Penerimaan yang terkait dengan <?php echo $dataapa;?> ini akan ikut terhapus
                                                </li>
                                                <li>
                                                    Semua Data Pembayaran siswa yang terkait <?php echo $dataapa;?> ini terhapus
                                                </li>
                                               
                                               <input type="hidden" name="forward" value="<?php echo $forward;?>">
                                               <input type="hidden" name="next" value="<?php echo $next;?>">
                                                <input type="hidden" name="no" value="<?php echo $no;?>">
                                                 <input type="hidden" name="data" value="<?php echo $dataapa;?>">
                                               
                                            </ol>

                                            <br>
                                             <button type="submit" name="bebas" class="btn btn-danger waves-effect width-md waves-light">HAPUS</button>
                                             </form>
                                        </div>
                                    </div>

        <?php } ?>


<?php } ?>




                                </div> <!-- end card-->
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


 $forward=$_POST['forward'];
    $next=$_POST['next'];
    $no=$_POST['no'];
     $data=$_POST['data'];


if(isset($_POST['siswa'])){   //hapus data siswa

   
$sql1=mysqli_query($conn,"DELETE FROM bulanan WHERE student_id='$no'");
$sql2=mysqli_query($conn,"DELETE FROM bebasan WHERE student_id='$no'");
$sql3=mysqli_query($conn,"DELETE FROM bebasan_pay WHERE student_id='$no'");
$sql4=mysqli_query($conn,"DELETE FROM uang_masuk_keluar WHERE student_id='$no'");

$sql="DELETE FROM $forward WHERE student_id='$no'";

if(mysqli_query($conn,$sql)){
echo "<script type='text/javascript'>window.location = '$next';</script>";
} else {
echo "<script type='text/javascript'>window.location = '$halaman?key=$no&f=$forward&r=$next&d=$data&delete=false';</script>";
}

                            //end hapus data siswa

} else if(isset($_POST['periode'])){      //hapus tahun ajaran periode



$sql1=mysqli_query($conn,"DELETE FROM bulanan WHERE period_id='$no'");
$sql2=mysqli_query($conn,"DELETE FROM bebasan WHERE period_id='$no'");
$sql3=mysqli_query($conn,"DELETE FROM bebasan_pay WHERE period_id='$no'");
$sql4=mysqli_query($conn,"DELETE FROM uang_masuk_keluar WHERE period_id='$no'");
$sql5=mysqli_query($conn,"DELETE FROM jenis_bayar WHERE period_id='$no'");


$sql="DELETE FROM $forward WHERE no='$no'";

if(mysqli_query($conn,$sql)){
echo "<script type='text/javascript'>window.location = '$next?delete=yes';</script>";
} else {
echo "<script type='text/javascript'>window.location = '$halaman?key=$no&f=$forward&r=$next&d=$data&delete=false';</script>";
}


                        //end hapus tahun ajaran
} else if(isset($_POST['bulanan'] )){   //hapus jenis pembayaran bulanan

$sql1=mysqli_query($conn,"DELETE uang_masuk_keluar,bulanan FROM uang_masuk_keluar INNER JOIN bulanan ON uang_masuk_keluar.bulanan_id=bulanan.no WHERE bulanan.jenis_id='$no'");

$sql2=mysqli_query($conn,"DELETE FROM bulanan WHERE jenis_id='$no'");

$sql="DELETE FROM $forward WHERE jenis_id='$no'";


if(mysqli_query($conn,$sql)){
echo "<script type='text/javascript'>window.location = '$next?delete=yes';</script>";
} else {
echo "<script type='text/javascript'>window.location = '$halaman?key=$no&f=$forward&r=$next&d=$data&delete=false';</script>";
}

} else if(isset($_POST['bebas'] )){                                         //hapus jenis pembayaran bebas


$sql1=mysqli_query($conn,"DELETE uang_masuk_keluar FROM uang_masuk_keluar INNER JOIN bebasan ON uang_masuk_keluar.bebas_id=bebasan.no WHERE bebasan.jenis_id='$no'");

$sql2=mysqli_query($conn,"DELETE bebasan_pay,bebasan FROM bebasan_pay INNER JOIN bebasan ON bebasan_pay.bebasan_id=bebasan.no WHERE bebasan.jenis_id='$no'");

$sql3=mysqli_query($conn,"DELETE FROM bebasan WHERE jenis_id='$no'");

$sql="DELETE FROM $forward WHERE jenis_id='$no'";


if(mysqli_query($conn,$sql)){
echo "<script type='text/javascript'>window.location = '$next?delete=yes';</script>";
} else {
echo "<script type='text/javascript'>window.location = '$halaman?key=$no&f=$forward&r=$next&d=$data&delete=false';</script>";
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
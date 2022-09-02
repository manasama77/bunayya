<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Detail | <?php echo $app;?></title>
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

$halaman = "summary_detail"; // halaman
$dataapa = "Detail Pembayaran"; // data
$tabeldatabase = "kosong"; // tabel database
$chmod = 5; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman

$no=$_GET['no'];
$j=$_GET['j'];
$a=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM jenis_bayar WHERE jenis_id='$j'"));
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
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title"><?php echo ''.$a['nama'].' - '.$a['tahunajar'].''?></h4>
                                    <p class="sub-header">
                                        Riwayat Pembayaran Iuran <?php echo ''.$a['nama'].' - '.$a['tahunajar'].''?>
                                    </p>

                                    <div class="table-responsive">
                                          <table class="table table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Diterima</th>
                                            <th>Jumlah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
           <?php $nom=0;
                 $sqli=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) as jml FROM bebasan_pay WHERE bebasan_id='$no'"));
                $sqlq=mysqli_query($conn,"SELECT * FROM bebasan_pay WHERE bebasan_id='$no'");
                while($row=mysqli_fetch_assoc($sqlq)){                                 
                      echo            '    <tr>
                                            <th scope="row">'.++$nom.'</th>
                                            <td>'.date('d-m-y',strtotime($row['tanggal'])).'</td>
                                            <td>'.$row['kasir'].'</td>
                                            <td>'.$row['jumlah'].'</td>
                                        </tr>';
                  }?>                      
                   <?php          if($sqli['jml']>0){            
                        echo      '           <tr>
                                            <th scope="row">#</th>
                                            <td colspan="2"><b>Total</b></td>
                                            <td><b>'.number_format($sqli['jml']).'</b></td>
                                        </tr>';
                        } else {

                            echo '<tr><td colspan="4" style="text-align:center"> Belum Ada Pembayaran Tercatat</td></tr>';

                        }
                    ?>
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


<!-- End Sidebar Kanan -->





<!-- Letak Kode PHP Bawah -->




<!-- END Letak Kode PHP bawah -->




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
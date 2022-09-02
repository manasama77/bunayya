<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Laporan Keuangan | <?php echo $app;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
<?php
connect();
head();timing();
session();
pagination();
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

$halaman = "report_finance"; // halaman
$dataapa = "Laporan Keuangan"; // data
$tabeldatabase = "kosong"; // tabel database
$chmod = $chmenu6; // Hak akses Menu
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
                                            
                                            <li class="breadcrumb-item active"><?php echo $dataapa;?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $dataapa;?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end halaman dan breadcrumbs --> 


<!-- ISI HALAMAN -->


    
                            <div class="col-12 d-print-none">
                                <div class="card-box">
                                                                      
                                   

                                        <div class="row">
                                            <div class="col-lg-3">
                                               <h5>Filter Laporan</h5>
                                            </div>
                                            
                                             <div class="col-lg-9">
                                                
                                                <form class="form-inline" method="get">
                                                    <div class="form-group mr-2">
                                                        <label for="exampleInputName2" class="mr-2">Pilih Rentang Tanggal</label>
                                                       <input type="text" name="rentang" id="reportrange" class="form-control"/>
                                                    </div>

                                                   
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-md">
                                                        Tampilkan
                                                    </button>
                                                </form>
                                            </div>

                                        </div>

                                    
                                </div>
                            </div>
                       
        
<?php

if(isset($_GET['rentang'])){

$dat=$_GET['rentang'];

list($start, $end) = explode(' - ', $dat);



?>

                        

<?php 

$sql=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM data"));
?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="clearfix">
                                        <div class="float-left mb-2">
                                           
                                        </div>
                                        <div class="float-right">
                                            <h3 class="m-0 d-print-none">LAPORAN KEUANGAN</h3>
                                        </div>
                                    </div>


                                    <div class="row">
                                         <div class="col-md-7 border-right">
                                            <div class="mt-3">
                                                <?Php
                                      echo       '<p><b>'.$sql['nama'].'</b></p>';
                                       echo      '<p style="width:70%">'.$sql['alamat'].'<br>P: '.$sql['notelp'].'<br>E: '.$sql['email'].' </p>';
                                                ?>
                                            </div>

                                        </div><!-- end col -->
                                        <div class="col-md-5">
                                            <div class="mt-3 text-md-right">
                                                <p><strong>LAPORAN KEUANGAN</strong></p>
                                             
                                               <p>Periode: <strong><?php echo ''.date('d/m/y',strtotime($start)).' - '.date('d/m/y',strtotime($end)).'';?></strong></p>
                                            </div>
                                        </div><!-- end col -->
                                    </div>
                                    <!-- end row -->

                                   

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table mt-4 table-centered">
                                            <thead>
                                            <tr >

                                                <th style="width:10%">#</th>
                                                <th>Kategori</th>
                                                <th style="width:15%">Pemasukan</th>
                                                <th style="width:15%">Pengeluaran</th>
                                                <th style="width:15%">Total</th>

                                            </tr>
                                        </thead>

                                        
                                        <tbody>


<?php $sql1=mysqli_query($conn,"SELECT *, SUM(jumlah) as jml FROM uang_masuk_keluar WHERE tipe!='out' AND tgl_update BETWEEN '" . $start . "' AND  '" . $end ."' GROUP BY kategori_id");
$nom=1;
    while($row=mysqli_fetch_array($sql1) ){


        ?>

                                            


                                             <tr>
                                                <td style="width:10%">
                                                    <?php if($nom==1){
                                                echo  '<b>PENERIMAAN</b>';
                                            } ?>
                                                </td>
                                                <td><?php $kat=$row['kategori_id'];
                                                $d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama FROM uang_kategori WHERE kategori_id='$kat'"));
                                                echo $d['nama'];?>

                                                </td>
                                                
                                                <td><?php echo number_format($row['jml']);?></td>
                                                <td style="width:15%"></td>
                                                <td></td>

                                            </tr>


<?php
$nom++;
 } ?>

 <?php 
$sql2=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) as totalin FROM uang_masuk_keluar WHERE tipe!='out' AND tgl_update BETWEEN '" . $start . "' AND  '" . $end ."' "));

 ?>

                                             <tr class="table-secondary">
                                                <td style="width:10%"></td>
                                                <td><b>TOTAL</b></td>
                                                
                                                <td><?php echo number_format($sql2['totalin']);?></td>
                                                <td style="width:15%"></td>
                                                <td><b><?php echo number_format($sql2['totalin']);?></b></td>

                                            </tr>


<?php $sql3=mysqli_query($conn,"SELECT *, SUM(jumlah) as jml FROM uang_masuk_keluar WHERE tipe='out' AND tgl_update BETWEEN '" . $start . "' AND  '" . $end ."' GROUP BY kategori_id");
$nom=1;
    while($row=mysqli_fetch_array($sql3) ){


        ?>

                                             <tr>
                                                <td style="width:10%">
                                                    <?php if($nom==1){
                                                echo  '<b>PENGELUARAN</b>';
                                            } ?>
                                                </td>
                                                <td><?php $kat=$row['kategori_id'];
                                                $d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama FROM uang_kategori WHERE kategori_id='$kat'"));
                                                echo $d['nama'];?>

                                                </td>
                                                <td style="width:15%"></td>
                                                <td><?php echo number_format($row['jml']);?></td>
                                                
                                                <td></td>

                                            </tr>

<?php
$nom++;
 } ?>


<?php 
$sql4=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) as totalout FROM uang_masuk_keluar WHERE tipe='out' AND tgl_update BETWEEN '" . $start . "' AND  '" . $end ."' "));

 ?>
                                                
                                            <tr class="table-secondary">
                                                <td style="width:10%"></td>
                                                <td><b>TOTAL</b></td>
                                                 <td style="width:15%"></td>
                                                <td><?php echo number_format($sql4['totalout']);?></td>
                                               
                                                <td><b><?php echo number_format($sql4['totalout']);?></b></td>

                                            </tr>

                                                 <tr>
                                                <td style="width:10%"><b>TOTAL</b></td>
                                                <td></td>
                                                
                                                <td><b><?php echo number_format($sql2['totalin']);?></b></td>
                                               <td><b><?php echo number_format($sql4['totalout']);?></b></td>
                                                <td><b><?php echo number_format($sql2['totalin']-$sql4['totalout']);?></b></td>

                                            </tr>


                                        </tbody>
                                        </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="clearfix pt-4">
                                                <h6 class="text-muted">Keterangan:</h6>

                                                <small>
                                                   Laporan Keuangan Sekolah Periode <b><?php echo ''.date('d/m/y',strtotime($start)).' sampai '.date('d/m/y',strtotime($end)).'';?></b>
                                                </small>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-md-right">
                                                 <p><strong>dicetak: </strong> <?php echo date('d-m-Y');?></p>
                                                 <p><strong>oleh: </strong> <?php echo $_SESSION['nama'];?></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <div class="hidden-print mt-4">
                                        <div class="text-right d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-blue waves-effect waves-light"><i class="fa fa-print mr-1"></i> Print</a>
                                           
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- end row -->
                     
<?php } ?>

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
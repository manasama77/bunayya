<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Laporan Transaksi | <?php echo $app;?></title>
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

$halaman = "report_trx"; // halaman
$dataapa = "Laporan Transaksi"; // data
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


    
                            <div class="col-12">
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

                                                    <div class="form-group mr-2">
                                                        <label for="exampleInputEmail2" class="mr-2">Tipe Transaksi</label>
                                                       <select class="form-control" name="tipe">
                                                        <option value="all">Semua</option>
                                                        <option value="income">Pemasukan</option>
                                                        <option value="expense">Pengeluaran</option>
                                                       </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-info waves-effect waves-light btn-md">
                                                        Cari
                                                    </button>
                                                </form>
                                            </div>

                                        </div>

                                    
                                </div>
                            </div>
                       
        
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$dat=$_GET['rentang'];

list($start, $end) = explode(' - ', $dat);

$tipe=$_GET['tipe'];

if(isset($tipe)&&($tipe=='all')){

   
?>

                        	 <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"> <a onclick="window.location.href='configuration/config_phpexcel?forward=report_trx&start=<?php echo $start; ?>&end=<?php echo $end; ?>&tipe=all'"   class="btn btn-xs btn-primary waves-effect waves-light btn-md"><i class="fas fa-download"> Excel</i> </a></h4>


                                    <p class="sub-header">Laporan Transaksi 
                                        <b><?php echo ''.date('d/m/y',strtotime($start)).' sampai '.date('d/m/y',strtotime($end)).'';?></b>
                                    </p>


                                    <div class="table-responsive">


                                        <?php
              error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                
              $sql="SELECT * FROM uang_masuk_keluar WHERE tgl_input BETWEEN '" . $start . "' AND  '" . $end ."'";

               $sql2=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) as exp FROM uang_masuk_keluar WHERE tipe='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end ."'"));
               $sql3=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) as inc FROM uang_masuk_keluar WHERE tipe!='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end ."'"));

               $result = mysqli_query($conn, $sql);
               $rpp    = 50;
               $reload = "$halaman"."?rentang=".$dat."&tipe=".$tipe."&pagination=true";
               $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

               if ($page <= 0)
               $page = 1;
               $tcount  = mysqli_num_rows($result);
               $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
               $count   = 0;
               $i       = ($page - 1) * $rpp;
               $no_urut = ($page - 1) * $rpp;
               ?>
                                     
                                           <table class="table table-borderless table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width:10px">No.</th>
                                                 <th>Tanggal</th>
                                                 <th>Nama</th>
                                                  <th>Pemasukan(Rp)</th>
                                                  <th>Pengeluaran(Rp)</th>
                                                   <th>Oleh</th>
                                                    
                                                
                                            </tr>
                                            </thead>
                                            <tbody>

                 <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $row = mysqli_fetch_array($result);
               ?>  

                                            <tr>
                                               
                                                <td><?php echo ++$nom;?></td>
                                                 <td><?php echo date('d/m/y',strtotime($row['tgl_update']));?></td>
                                                <td><?php echo $row['nama'];?></td>
                                               <td><?php if($row['tipe']=='out'){echo '0';}
                                             else {
                                             echo  ''.number_format($row['jumlah']).'';
                                             }?>

                                               </td>
                                                <td>
                                                  <?php if($row['tipe']=='out'){
                                                     echo  ''.number_format($row['jumlah']).'';
                                                  } else { echo '0';} ?>
                                                </td>
                                                 <td><?php echo $row['kasir'];?></td>
                                                
                                            </tr>
                         <?php
               $i++;
               $count++;
               } ?>                       <tr>
                                            <td colspan="3" style="text-align: center"><b>TOTAL</b></td>
                                            
                                            <td><b><?php echo number_format($sql3['inc']);?></b></td>
                                            <td><b><?php echo number_format($sql2['exp']);?></b></td>
                                            <td></td>
                                          </tr>
                                            
                                            </tbody>
                                        </table>
                                         <div align="right"><?php if($tcount>=$rpp){ echo paginate_one($reload, $page, $tpages);}else{} ?></div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                     

<?php } else if(isset($tipe)&&($tipe=='income')){ ?>


   <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"> <a onclick="window.location.href='configuration/config_phpexcel?forward=report_trx&start=<?php echo $start; ?>&end=<?php echo $end; ?>&tipe=inc'"   class="btn btn-xs btn-primary waves-effect waves-light btn-md"><i class="fas fa-download"> Excel</i> </a></h4>

                                    <p class="sub-header">Laporan Transaksi Pemasukan
                                        <b><?php echo ''.date('d/m/y',strtotime($start)).' sampai '.date('d/m/y',strtotime($end)).'';?></b>
                                    </p>


                                    <div class="table-responsive">


                                        <?php
              error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                
              $sql="SELECT * FROM uang_masuk_keluar WHERE tipe!='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end ."'";

               $sql2=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) as exp FROM uang_masuk_keluar WHERE tipe='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end ."'"));
               $sql3=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) as inc FROM uang_masuk_keluar WHERE tipe!='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end ."'"));

               $result = mysqli_query($conn, $sql);
               $rpp    = 50;
               $reload = "$halaman"."?rentang=".$dat."&tipe=".$tipe."&pagination=true";
               $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

               if ($page <= 0)
               $page = 1;
               $tcount  = mysqli_num_rows($result);
               $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
               $count   = 0;
               $i       = ($page - 1) * $rpp;
               $no_urut = ($page - 1) * $rpp;
               ?>
                                     
                                           <table class="table table-borderless table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width:10px">No.</th>
                                                 <th>Tanggal</th>
                                                 <th>Nama</th>
                                                  <th>Pemasukan(Rp)</th>
                                                 
                                                   <th>Oleh</th>
                                                    
                                                
                                            </tr>
                                            </thead>
                                            <tbody>

                 <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $row = mysqli_fetch_array($result);
               ?>  

                                            <tr>
                                               
                                                <td><?php echo ++$nom;?></td>
                                                 <td><?php echo date('d/m/y',strtotime($row['tgl_update']));?></td>
                                                <td><?php echo $row['nama'];?></td>
                                               <td><?php if($row['tipe']=='out'){echo '0';}
                                             else {
                                             echo  ''.number_format($row['jumlah']).'';
                                             }?>

                                               </td>
                                                
                                                 <td><?php echo $row['kasir'];?></td>
                                                
                                            </tr>
                         <?php
               $i++;
               $count++;
               } ?>                       <tr>
                                            <td colspan="3" style="text-align: center"><b>TOTAL</b></td>
                                            
                                            <td><b><?php echo number_format($sql3['inc']);?></b></td>
                                           
                                            <td></td>
                                          </tr>
                                            
                                            </tbody>
                                        </table>
                                         <div align="right"><?php if($tcount>=$rpp){ echo paginate_one($reload, $page, $tpages);}else{} ?></div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>


<?php } else if(isset($tipe)&&($tipe=='expense')){ ?>

 <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                   <h4 class="header-title"> <a onclick="window.location.href='configuration/config_phpexcel?forward=report_trx&start=<?php echo $start; ?>&end=<?php echo $end; ?>&tipe=exp'"   class="btn btn-xs btn-primary waves-effect waves-light btn-md"><i class="fas fa-download"> Excel</i> </a></h4>

                                    <p class="sub-header">Laporan Transaksi Pengeluaran
                                        <b><?php echo ''.date('d/m/y',strtotime($start)).' sampai '.date('d/m/y',strtotime($end)).'';?></b>
                                    </p>


                                    <div class="table-responsive">


                                        <?php
              error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                
              $sql="SELECT * FROM uang_masuk_keluar WHERE tipe='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end ."'";

               $sql2=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) as exp FROM uang_masuk_keluar WHERE tipe='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end ."'"));
               $sql3=mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(jumlah) as inc FROM uang_masuk_keluar WHERE tipe!='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end ."'"));

               $result = mysqli_query($conn, $sql);
               $rpp    = 50;
               $reload = "$halaman"."?rentang=".$dat."&tipe=".$tipe."&pagination=true";
               $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

               if ($page <= 0)
               $page = 1;
               $tcount  = mysqli_num_rows($result);
               $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
               $count   = 0;
               $i       = ($page - 1) * $rpp;
               $no_urut = ($page - 1) * $rpp;
               ?>
                                     
                                           <table class="table table-borderless table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width:10px">No.</th>
                                                 <th>Tanggal</th>
                                                 <th>Nama</th>
                                                  
                                                  <th>Pengeluaran(Rp)</th>
                                                   <th>Oleh</th>
                                                    
                                                
                                            </tr>
                                            </thead>
                                            <tbody>

                 <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $row = mysqli_fetch_array($result);
               ?>  

                                            <tr>
                                               
                                                <td><?php echo ++$nom;?></td>
                                                 <td><?php echo date('d/m/y',strtotime($row['tgl_update']));?></td>
                                                <td><?php echo $row['nama'];?></td>
                                              
                                                <td>
                                                  <?php if($row['tipe']=='out'){
                                                     echo  ''.number_format($row['jumlah']).'';
                                                  } else { echo '0';} ?>
                                                </td>
                                                 <td><?php echo $row['kasir'];?></td>
                                                
                                            </tr>
                         <?php
               $i++;
               $count++;
               } ?>                       <tr>
                                            <td colspan="3" style="text-align: center"><b>TOTAL</b></td>
                                            
                                          
                                            <td><b><?php echo number_format($sql2['exp']);?></b></td>
                                            <td></td>
                                          </tr>
                                            
                                            </tbody>
                                        </table>
                                         <div align="right"><?php if($tcount>=$rpp){ echo paginate_one($reload, $page, $tpages);}else{} ?></div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>


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
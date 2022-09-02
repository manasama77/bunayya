<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Jenis Pembayaran |<?php echo $app;?></title>
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

$halaman = "pos_jenis"; // halaman
$dataapa = "Jenis Pembayaran"; // data
$tabeldatabase = "jenis_bayar"; // tabel database
$chmod = $chmenu2; // Hak akses Menu
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
$msg = $_GET['insert'];

if ($msg == "false") {
?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal Query!</strong> Terjadi kesalahan </div>

<?php } else if ($msg == "exist"){ ?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>GAGAL!</strong> Jenis Pembayaran tersebut sudah ada </div>


<?php } else if ($msg == "nonexist"){ ?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>GAGAL!</strong> jenis Pembayaran yang diedit tidak diketemukan </div>


<?php } else if ($msg == "update"){ ?>
 <div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Berhasil!</strong> Jenis Pembayaran sudah diupdate </div>


<?php } else if ($msg == "true"){ ?>

 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert"
 aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
 <strong>Berhasil!</strong> Jenis pembayaran telah ditambahkan
 </div>
<?php } ?>


    <div class="row">
                            <div class="col-2">                           
                                
                                <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                     <a href="pos_jenis_add" class="btn btn-success waves-effect waves-light" >Tambah</a>

                                            <?php } ?>
                                                                       
                                  
                                    </div>

                                    <div class="col-2">                           
                                
                                    
                                            
                                                                       
                                  
                                    </div>

                                  
                                    </div>
                                    <br>

  <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title">Data Jenis Pembayaran</h4>
                                    <p class="sub-header">
                                        Tentukan Jenis pembayaran dan besarnya yang dibayarkan oleh siswa
                                    </p>




                                     <form class="form-inline" method="get" action="">
                                                    <div class="form-group mr-2">
                                                        
                                                        <input type="text" class="form-control" placeholder="Cari" name="q" required>
                                                    </div>
                                                   
                                                    <button type="submit" class="btn btn-info waves-effect waves-light btn-md">
                                                        Cari
                                                    </button>
                                                </form>
                                                <br>
<?php
              error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
              $q=$_GET['q'];
              if ($q!='' || $q !=null){
               $sql    = "select * from jenis_bayar where nama like '%$q%' order by jenis_id desc";
             } else {
                $sql    = "select * from jenis_bayar order by jenis_id desc";
             }
               $result = mysqli_query($conn, $sql);
               $rpp    = 15;
               $reload = "$halaman"."?pagination=true";
               $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

               if ($page <= 0)
               $page = 1;
               $tcount  = mysqli_num_rows($result);
               $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
               $count   = 0;
               $i       = ($page - 1) * $rpp;
               $no_urut = ($page - 1) * $rpp;
               ?>
                                    <div class="table-responsive">
                                        <table class="table m-0 table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:10px">#</th>
                                                 <th>POS </th>
                                                <th>Nama Pembayaran</th>
                                                 <th>Tipe Bayar</th>
                                                  <th>Tahun</th>
                                                   <th>Tarif Pembayaran</th>
                                               
                                                <th style="width:10%">Opsi</th>
                                            </tr>
                                            </thead>

        <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $fill = mysqli_fetch_array($result);
               ?>                                      
                                            <tr>                                            

                                              <td><?php echo ++$no_urut;?></td>
                                               <td><?php  $s = $fill['pos_bayar_id'];
                                                  $b=mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama FROM pos_bayar WHERE id='$s'"));
                                                  echo $b['nama'];
                                                ?>
                                                 

                                               </td>
                                               <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?> <b>T.A <?php  echo mysqli_real_escape_string($conn, $fill['tahunajar']); ?></b></td>
                                               <td><?php  echo mysqli_real_escape_string($conn, $fill['jenis_pembayaran']); ?></td>
                                               <td><?php  echo mysqli_real_escape_string($conn, $fill['tahunajar']); ?></td>

                                            <td>

                                              <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>

                                              <a href="pos_setting?q=<?php echo $fill['jenis_id'];?>" class="btn btn-success waves-effect waves-light" >Atur Tarif Pembayaran</a></td>
                                              
                                              <?php } ?>


                                            <td >
                                                 <?php  if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                                                     <a href="pos_jenis_add?q=<?php echo $fill['jenis_id'];?>" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-edit"></i> </a>

                                                   <?php } 
                                                   if ($chmod >= 5 || $_SESSION['jabatan'] == 'admin') {
                                                    ?>

                                                      <a href="deletion?key=<?php echo $fill['jenis_id'].'&'; ?>f=<?php echo "jenis_bayar".'&';?>r=<?php echo $halaman.'&'; ?>d=Jenis Pembayaran&t=<?php echo $fill['jenis_pembayaran'];?>" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="fa fa-times"></i> </a>

                                                         <?php } ?>

                                               
                                            </td>
                                            </tr>
              <?php
               $i++;
               $count++;
               } ?>
              
                                            </tbody>
                                        </table>
                                         <div align="right"><?php if($tcount>=$rpp){ echo paginate_one($reload, $page, $tpages);}else{} ?></div>
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
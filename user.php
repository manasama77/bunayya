<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Pengguna | <?php echo $app;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
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

$halaman = "user"; // halaman
$dataapa = "User"; // data
$tabeldatabase = "user"; // tabel database
$chmod = $chmenu7; // Hak akses Menu
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

                    

<script>
 window.setTimeout(function() {
    $("#myAlert").fadeTo(200, 0).slideUp(400, function(){
        $(this).remove();
    });
}, 2000);
</script>
<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$msg=$_GET['insert'];
if($msg=="true"){?>
 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span> </button>
<strong>Berhasil!</strong> Data <?php echo $dataapa;?> telah disimpan</div>
<?php } else if($msg=="false"){?>
<div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span> </button>
<strong>GAGAL QUERY!</strong> Terjadi kesalahan Sistem, hubungi Admin</div>
<?php } else if ($msg=="exist"){ ?>
<div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span> </button>
<strong>GAGAL!</strong> Akun tersebut sudah ada</div>

<?php } ?>


    <div class="row">
                            <div class="col-2">                           
                                
                                     <a href="user_add" class="btn btn-info waves-effect waves-light" >Tambah User</a>

                                            
                                                                       
                                  
                                    </div>

                                    <div class="col-2">                           
                                
                                    
                                            
                                                                       
                                  
                                    </div>

                                  
                                    </div>
                                    <br>

  <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title">Data User</h4>
                                    



<?php 

$msg = $_GET['kategori'];

if ($msg == "false") {
?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal!</strong> Terjadi kesalahan,Hubungi admin </div>

<?php } else if ($msg == "exist"){ ?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal!</strong> Data sudah ada </div>

<?php } else if ($msg == "true"){ ?>

 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert"
 aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
 <strong>Berhasil!</strong> Data telah Disimpan
 </div>
<?php } ?>



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
               $sql    = "select * from user where userna_me like '%$q%' or nama like '%$q%' or jabatan like '%$q%' order by no desc";
             } else {
                $sql    = "select * from user order by no desc";
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
                                        <table class="table m-0 table-colored-bordered table-bordered-blue">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                 <th>Username</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                               
                                                 
                                                <th style="width:15%">Opsi</th>
                                            </tr>
                                            </thead>

        <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $fill = mysqli_fetch_array($result);
               ?>                                      
                                            <tr>                                            

                                              <td><?php echo ++$no_urut;?></td>
                                               <td><?php  echo mysqli_real_escape_string($conn, $fill['userna_me']); ?></td>
                                            <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
                                              <td><?php  echo mysqli_real_escape_string($conn, $fill['jabatan']); ?></td>
                                         

                                            <td >
                                                 
                                                  <?php  if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>

                                                        <a href="user_edit?key=<?php echo $fill['no'];?>" class="btn btn-icon waves-effect waves-light btn-info"><i class="fas fa-edit"></i></a>
                                                      
                                                             <button class="demo-delete-row btn btn-danger btn-sm btn-icon" 
                                                onclick="window.location.href='component/delete/delete_biasa?no=<?php echo $fill['no'].'&'; ?>forward=<?php echo "user".'&';?>forwardpage=<?php echo $halaman.'&'; ?>chmod=<?php echo $chmod; ?>'"

                                                ><i class="fa fa-times"></i></button>

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
<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Siswa | <?php echo $app;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
<?php
connect();
head();timing();
session();pagination();
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

$halaman = "user_siswa"; // halaman
$dataapa = "Siswa"; // data
$tabeldatabase = "student"; // tabel database
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

   

  <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title">Data Siswa</h4>
                                    



<?php 
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$msg = $_GET['switch'];
$reset=$_GET['reset'];

if ($msg == "false" || $reset == "false") {
?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal!</strong> Terjadi kesalahan,Hubungi admin </div>

<?php } else if ($msg == "true"){ ?>

 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert"
 aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
 <strong>Berhasil!</strong> Status telah diubah
 </div>
<?php } else if($reset == "true"){ ?>
<div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert"
 aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
 <strong>Berhasil!</strong> Password telah direset, siswa bisa login dengan password 123456
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
               $sql    = "select * from student where nama like '%$q%' or nis like '%$q%' or nisn like '%$q%' order by student_id desc";
             } else {
                $sql    = "select * from student order by student_id desc";
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
                                                 <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                               
                                                 
                                                <th style="width:15%">Opsi</th>
                                            </tr>
                                            </thead>

        <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $fill = mysqli_fetch_array($result);
               ?>                                      
                                            <tr>                                            

                                              <td><?php echo ++$no_urut;?></td>
                                               <td><?php  echo mysqli_real_escape_string($conn, $fill['nis']); ?></td>
                                            <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
                                              <td><?php $k=$fill['kelas_id'];
                                                  $a=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM class WHERE no='$k'"));
                                                  echo $a['kelas']; ?></td>
                                         

                                            <td >

                                               <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                                 
                                                        <a href="user_siswa?id=<?php echo $fill['student_id'];?>&reset=1" class="btn btn-icon waves-effect waves-light btn-danger"><i class=" fas fa-lock-open"></i></a>

                                                        <?php if($fill['status']=='active'){?>
                                                      
                                                          <a href="user_siswa?no=<?php echo $fill['student_id'];?>&status=inactive" class="btn btn-icon waves-effect waves-light btn-secondary"><i class="fas fa-power-off"></i></a>

                                                        <?php } else {?>

                                                          <a href="user_siswa?no=<?php echo $fill['student_id'];?>&status=active" class="btn btn-icon waves-effect waves-light btn-success"><i class="fas fa-power-off"></i></a>

                                                        <?php } ?>

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
<?php


if((isset($_GET['id']))&&(isset($_GET['reset']))){

  $r="123456";
  $r1=sha1(MD5($r));
  $id=$_GET['id'];


  $sql="UPDATE student SET password='$r1' WHERE student_id='$id'";

  if(mysqli_query($conn,$sql)){

echo "<script type='text/javascript'>window.location = '$forwardpage?reset=true';</script>";
  } else {
echo "<script type='text/javascript'>window.location = '$forwardpage?reset=false';</script>";
  }

}




if((isset($_GET['no']))&&(isset($_GET['status']))){


  $no=$_GET['no'];

  $status=$_GET['status'];

  $sql1="UPDATE student SET status='$status' WHERE student_id='$no'";

  if(mysqli_query($conn,$sql1)){
echo "<script type='text/javascript'>window.location = '$forwardpage?switch=true';</script>";
  } else {
echo "<script type='text/javascript'>window.location = '$forwardpage?switch=false';</script>";
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
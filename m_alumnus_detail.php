<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Detail Alumni |<?php echo $app;?></title>
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

$halaman = "m_alumnus_detail"; // halaman
$dataapa = "Informasi Siswa"; // data
$tabeldatabase = "student_alumni"; // tabel database
$chmod = $chmenu4; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->

<?php 
if(isset($_GET['id'])){
  $no=$_GET['id'];
  $query="SELECT * FROM student_alumni WHERE student_id='$no'";
  $a=mysqli_fetch_assoc(mysqli_query($conn,$query));

} 



if($a['avatar']!=''){
$subject =$a['avatar'];
$search = 'student/';
$trimmed = str_replace($search, '', $subject) ;

} else {
  $trimmed="image/placeholder.png";
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
                                            <li class="breadcrumb-item"><a href="m_student">Siswa</a></li>
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
                            <div class="col-sm-12">
                                <div class="profile-bg-picture" style="background-image:url('assets/images/bg-profile.jpg')">
                                    <span class="picture-bg-overlay"></span><!-- overlay -->
                                </div>
                                <!-- meta -->
                                <div class="profile-user-box">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span class="float-left mr-3"><img src="student/<?php echo $trimmed;?>" alt="" class="avatar-xl rounded-circle"></span>
                                            <div class="media-body">
                                                <h4 class="mt-1 mb-1 font-18 ellipsis"><?php echo $a['nama'];?></h4>
                                                <p class="font-13">Alumni Siswa Kelas</p>
                                                <p class="text-muted mb-0"><small><?php echo $a['nis'];?></small></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-right">
                                                <a href="m_student_add?id=<?php echo $no;?>" class="btn btn-success waves-effect waves-light">
                                                    <i class="mdi mdi-account-settings-variant mr-1"></i> Edit Profile
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ meta -->
                            </div>
                        </div>
                        <!-- end row -->
        
                        <div class="row">
                            <div class="col-xl-4">
                                <!-- Personal-Information -->
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-4">Catatan Mengenai Alumni</h4>
                                    <div class="panel-body">
                                        <p class="text-muted font-13">
                                           <?php echo $a['catatan'];?>
                                        </p>
        
                                        <hr/>
        
                                        <div class="text-left">
                                            <p class="text-muted font-13"><strong>NISN :</strong> <span class="ml-3"><?php echo $a['nisn'];?></span></p>
        
                                            <p class="text-muted font-13"><strong>No.HP :</strong><span class="ml-3"><?php echo $a['nohp'];?></span></p>
        
                                            <p class="text-muted font-13"><strong>Lahir :</strong> <span class="ml-3"><?php echo $a['birth_place'];?>, <?php echo date('d-m-Y',strtotime($a['birth_date']));?></span></p>
        
                                            <p class="text-muted font-13"><strong>Gender :</strong> <span class="ml-3"><?php echo $a['gender'];?></span></p>

                                            <p class="text-muted font-13"><strong>Ibu :</strong> <span class="ml-3"><?php echo $a['ibu'];?></span></p>

                                            <p class="text-muted font-13"><strong>Ayah :</strong> <span class="ml-3"><?php echo $a['ayahwali'];?></span></p>
                                            <p class="text-muted font-13"><strong>Hp Ortu :</strong> <span class="ml-3"><?php echo $a['waortu'];?></span></p>
        
                                           
        
                                        </div>
        
                                        
                                    </div>
                                </div>
                                <!-- Personal-Information -->
        
                                <div class="card-box ribbon-box">
                                    <div class="ribbon ribbon-primary">Alumni Sekelas</div>
                                    <div class="clearfix"></div>
                                    <div class="inbox-widget">

                                        <?php $id_kelas= $a['kelas_id'];
                                    $query=mysqli_query($conn,"SELECT * FROM student_alumni WHERE kelas_id='$id_kelas' AND student_id!='$no' LIMIT 5");    
                                    while($fill=mysqli_fetch_assoc($query)){

                                       

if($fill['avatar']!=''){
$subject =$fill['avatar'];
$search = 'student/';
$trimmed = str_replace($search, '', $subject) ;

} else {
  $trimmed="image/placeholder.png";
}

                                    ?>

                                        <div class="inbox-item">
                                            <div class="inbox-item-img"><img src="student/<?php echo $trimmed;?>" class="rounded-circle" alt=""></div>
                                            <p class="inbox-item-author"><?php echo $fill['nama'];?></p>
                                            <p class="inbox-item-text"><?php echo $fill['nis'];?></p>
                                            <p class="inbox-item-date mt-2">
                                                <a href="m_student_detail?id=<?php echo $fill['student_id'];?>" class="btn btn-icon btn-xs waves-effect waves-light btn-success"> Lihat </a>
                                            </p>
                                        </div>
                                        
                                       <?php } ?> 

                                    </div>
                                </div>
        
                            </div>
        
        
                            <div class="col-xl-8">
        
                                
        
        
                                <div class="card-box">
                                    <h4 class="header-title mt-0 mb-4">Informasi</h4>
                                    <div class="">
                                        <div class="">
                                            <h5 class="text-custom mb-1">Alamat</h5>
                                          
        
                                            <p class="text-muted font-13 mb-0"><?php echo $a['alamat'];?>
                                            </p>
                                        </div>
        
                                        <hr>
        
                                        <div class="">
                                            <h5 class="text-custom mb-1">Hobi</h5>
                                           
                                            <p class="text-muted font-13 mb-0"><?php echo $a['hobi'];?>
                                            </p>
                                        </div>
        
                                    </div>
                                </div>
        
                            </div>
                            <!-- end col -->
        
                        </div>
                        <!-- end row -->

                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->


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
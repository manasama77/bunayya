<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Profil | <?php echo $app;?></title>
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

$halaman = "profil"; // halaman
$dataapa = "Data Diri"; // data
$tabeldatabase = "kosong"; // tabel database
$chmod = 5; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman



 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->

<?php
$no=$_SESSION['id'];

$sql=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM student WHERE student_id='$no'"));

$a=mysqli_fetch_assoc(mysqli_query($conn,"SELECT kelas FROM class WHERE no=".$sql['kelas_id']." " ));




$subject =$sql['avatar'];
$search = 'student/';
$trimmed = str_replace($search, '', $subject) ;
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
                                <div class="col-lg-3">
                                    <div class="card-box">
                                           <img src="<?php echo $trimmed;?>" width="250">
                                    </div>

                                    <button class="btn btn-primary btn-block waves-effect mt-2 waves-light"  onclick="window.location.href='profil_edit'">EDIT PROFIL</button>
                                </div>


                            <div class="col-lg-9">
                                <div class="card-box">
                                    <h4 class="header-title"><?php echo ''.$sql['nama'].' / '.$sql['nis'].'';?></h4>
                                    

                                    
                                      

                                     
                                        <table class="table table-borderless mb-0">
                                            
                                           
                                            <tr>
                                                <td style="width:10%">Nama</td>
                                                <td style="width:10px">:</td>
                                                <td><?php echo $sql['nama'];?></td>
                                            </tr>

                                            <tr>
                                                <td style="width:10%">NIS</td>
                                                <td style="width:10px">:</td>
                                                <td><?php echo $sql['nis'];?></td>
                                            </tr>

                                            <tr>
                                                <td style="width:10%">NISN</td>
                                                <td style="width:10px">:</td>
                                                <td><?php echo $sql['nisn'];?></td>
                                            </tr>

                                            <tr>
                                                <td style="width:10%">Kelas</td>
                                                <td style="width:10px">:</td>
                                                <td><?php echo $a['kelas'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:10%">Ibu</td>
                                                <td style="width:10px">:</td>
                                                <td><?php echo $sql['ibu'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:10%">Ayah</td>
                                                <td style="width:10px">:</td>
                                                <td><?php echo $sql['ayahwali'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:10%">Hobi</td>
                                                <td style="width:10px">:</td>
                                                <td><?php echo $sql['hobi'];?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:10%">Alamat</td>
                                                <td style="width:10px">:</td>
                                                <td><?php echo $sql['alamat'];?></td>
                                            </tr>

                                           
                                           
                                           
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
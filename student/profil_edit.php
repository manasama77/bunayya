<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Edit Profil | <?php echo $app;?></title>
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

$halaman = "profil_edit"; // halaman
$dataapa = "EDIT Profil"; // data
$tabeldatabase = "student"; // tabel database
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
 $nis=$_SESSION['nis'];
  $query="SELECT * FROM student WHERE student_id='$no'";
  $a=mysqli_fetch_assoc(mysqli_query($conn,$query));



$subject =$a['avatar'];
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
                            <div class="col-lg-8">
                                <div class="card-box">
                                    <h4 class="header-title"><?php echo $_SESSION['jabatan']?></h4>
                                    
                                    <div class="table-responsive">
                                        <form method="post" enctype="multipart/form-data">

                                             <div class="form-group">
                                            <label for="pass1">Nama<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $a['nama'];?>" placeholder="Nama Kota" required>
                                            </div>

                                             <div class="form-group">
                                            <label for="pass1">Tempat Lahir<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="tempat" name="tempat" value="<?php echo $a['birth_place'];?>" placeholder="Nama Kota" required>
                                            </div>

                                            <div class="form-group">
                                            <label for="pass1">Tanggal Lahir<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="datepicker" name="tgllahir" value="<?php echo $a['birth_date'];?>" required autocomplete="off">
                                            </div>

                                             <div class="form-group">
                                            <label for="pass1">Hobbi<span class="text-danger"></span></label>
                                            <input type="text" class="form-control" id="hobi" name="hobi"  placeholder="Membaca, menulis ..." value="<?php echo $a['hobi'];?>" >
                                            </div>

                                             <div class="form-group">
                                            <label for="pass1">No.Hand Phone / Whatsapp<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="hp" name="nohp"  placeholder="628...." required autocomplete="off" value="<?php echo $a['nohp'];?>">
                                            </div>

                                            <div class="form-group">
                                            <label for="pass1">Nama Ibu Kandung<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ibu" name="ibu"  placeholder="Ibu Kandung" autocomplete="off" value="<?php echo $a['ibu'];?>">
                                            </div>

                                             <div class="form-group">
                                            <label for="pass1">Nama Ayah<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ayah" name="ayah"  placeholder="Ayah Kandung atau Wali" autocomplete="off" value="<?php echo $a['ayahwali'];?>">
                                            </div>

                                             <div class="form-group">
                                            <label for="pass1">No.HandPhone/Whatsap Orang Tua/Wali<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="waortu" name="waortu"  placeholder="+628.." autocomplete="off" value="<?php echo $a['waortu'];?>">
                                            </div>

                                            <button type="submit" name="update" class="btn btn-block btn-info waves-effect width-md waves-light">UPDATE</button>
                                            <a href="profil" class="btn btn-block btn-danger waves-effect width-md waves-light">BATAL</a>

                                        </form>
                                    </div>
                                </div>
                            </div>


                                <div class="col-lg-4">
                                <div class="card-box">

                                     <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                                  
                                                   
                                               
                                                 
                                                       <img src="<?php echo $trimmed;?>" alt="image"
                                                            class="img-fluid rounded" width="250"/>

                                                            <br>
                                                             <br>
                                                              
                                                       
                                                        <div class="form-group col-md-12">
                                                            <label for="inputZip" class="col-form-label">Avatar</label>
                                                            <input type="file" class="form-control" name="avatar" >
                                                        </div>
                                                         <input type="text" name="id" value="<?php echo $no;?>">
                                                        <input type="text" name="nis" value="<?php echo $nis;?>" >

                                                        <button type="submit" name="save" class="btn btn-block btn-success waves-effect width-md waves-light">UPDATE</button>

                                        </form>


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

 <?php

       if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['save'])){



  $nis= mysqli_real_escape_string($conn, $_POST["nis"]);
   $no= mysqli_real_escape_string($conn, $_POST["id"]);


 $namaavatar = $_FILES['avatar']['name'];
                      $ukuranavatar = $_FILES['avatar']['size'];
                      $tipeavatar = $_FILES['avatar']['type'];
                      $tmp = $_FILES['avatar']['tmp_name'];
                      $avatar = "image/".$namaavatar;


  if( ($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000) ){
        move_uploaded_file($tmp, $avatar);

$sql="UPDATE student SET avatar='$avatar' WHERE nis='$nis'";


if(mysqli_query($conn,$sql)){
echo "<script type='text/javascript'>window.location = '$forwardpage?key=$no&update=true';</script>";
} else {
echo "<script type='text/javascript'>window.location = '$forwardpage?key=$no&update=false';</script>";
}


} else {
     echo "<script type='text/javascript'>  alert('GAGAL, Periksa kembali ukuran file!'); </script>";
}




        } } ?>



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
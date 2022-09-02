<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Edit Profil |<?php echo $app;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Aplikasi Kelola Sekolahan" name="description" />
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

$halaman = "user_edit"; // halaman
$dataapa = "Edit Profil"; // data
$tabeldatabase = "user"; // tabel database
$chmod = $chmenu7; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman
$now=date();

//End Setting Halaman
 
?>

<?php

menu();

?>









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


<!-- Letak Kode PHP atas -->

<?php

if(isset($_GET['key'])){
$no=$_GET['key'];
} else {
  $no=$_SESSION['nouser'];
}

$a=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM user WHERE no='$no'"));


if($a['avatar']!=''){
$avatar=$a['avatar'];
} else {
$avatar="upload/image/placeholder.png";
}


?>





 <?php

       if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['simpan'])){


        $pesanError = array();
      if (trim($_POST['alamat'])=="") {
        $pesanError[] = "<b>Alamat</b> tidak boleh kosong !";    
      }

    
      if (trim($_POST['nama'])=="") {
        $pesanError[] = "<b>Nama</b> tidak boleh kosong !";    
      }

       if (trim($_POST['email'])=="") {
        $pesanError[] = "<b>EMAIL</b> tidak boleh kosong !";    
      }

        if (trim($_POST['nohp'])=="") {
        $pesanError[] = "<b>Nomor Telepon</b> tidak boleh kosong !";    
      }


                      $username = mysqli_real_escape_string($conn, $_POST["username"]);
                     
                      $nama= mysqli_real_escape_string($conn, $_POST["nama"]);
                       $email= mysqli_real_escape_string($conn, $_POST["email"]);
                      $nohp= mysqli_real_escape_string($conn, $_POST["nohp"]);
                      $alamat= mysqli_real_escape_string($conn,$_POST["alamat"]);
                      $tgllahir= mysqli_real_escape_string($conn, $_POST["tgllahir"]);
                    $no= mysqli_real_escape_string($conn, $_POST["no"]);


if (count($pesanError)>=1 ){
        echo "<div class='alert alert-danger alert-dismissable'>";
        echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
          $noPesan=0;
          foreach ($pesanError as $indeks=>$pesan_tampil) { 
          $noPesan++;
            echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";  
          } 
        echo "</div>"; 
      }
      else {

$sql="UPDATE user SET nama='$nama', email='$email', nohp='$nohp', alamat='$alamat',tgllahir='$tgllahir' WHERE userna_me='$username' AND no='$no'";

if(mysqli_query($conn,$sql)){
echo "<script type='text/javascript'>window.location = '$forwardpage?key=$no&update=true';</script>";
} else {
echo "<script type='text/javascript'>window.location = '$forwardpage?key=$no&update=false';</script>";
}


    }

  } }

             ?>





 <?php

       if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['update'])){


        $pesanError = array();
      if (trim($_POST['password'])=="") {
        $pesanError[] = "<b>Password</b> tidak boleh kosong !";    
      }

    
      if (trim($_POST['ulangi'])=="") {
        $pesanError[] = "<b>Konfirmasi Password</b> tidak boleh kosong !";    
      }

        if (trim($_POST['password'])!=$_POST['ulangi']) {
        $pesanError[] = "<b>Konfirmasi Password</b> tidak cocok !";    
      }


                      $username = mysqli_real_escape_string($conn, $_POST["username"]);
                     
                      $no= mysqli_real_escape_string($conn, $_POST["no"]);
                      $password= mysqli_real_escape_string($conn, $_POST["password"]);

                      $pass=sha1(md5($password));
                      $ulangi= mysqli_real_escape_string($conn,$_POST["ulangi"]);
                                         


if (count($pesanError)>=1 ){
        echo "<div class='alert alert-danger alert-dismissable'>";
        echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
          $noPesan=0;
          foreach ($pesanError as $indeks=>$pesan_tampil) { 
          $noPesan++;
            echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";  
          } 
        echo "</div>"; 
      }
      else {

$sql="UPDATE user SET pa_ssword='$pass' WHERE userna_me='$username' AND no='$no'";


if(mysqli_query($conn,$sql)){
echo "<script type='text/javascript'>window.location = '$forwardpage?key=$no&update=true';</script>";
} else {
echo "<script type='text/javascript'>window.location = '$forwardpage?key=$no&update=false';</script>";
}

    }

  } }

             ?>





<!-- END Letak Kode PHP atas -->
<!-- Form row -->




<?php 
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$msg = $_GET['update'];


if ($msg == "false" ) {
?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal!</strong> Terjadi kesalahan,Hubungi admin </div>
<?php } else if($msg== "true"){?>
<div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Berhasil!</strong> Data user telah diperbaharui </div>

  <?php } ?>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card-box ">
                                                <h4 class="header-title">Edit Data Diri</h4>
                                                <p class="sub-header">
                                                    
                                                </p>
            
                                               <form class="form-horizontal" method="post">
                                                  
                                                   
                                               
                                                 
                                                        <div class="form-group col-md-12">
                                                            <label for="inputCity" class="col-form-label">Username</label>
                                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $a['userna_me'];?>" autocomplete="off" required value="" readonly>
                                                                <div id="uname_response" ></div>
                                                        </div>

                                                         <div class="form-group col-md-12">
                                                            <label for="inputCity" class="col-form-label">Email</label>
                                                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $a['email'];?>" autocomplete="off" required value="" >
                                                                <div id="email_response" ></div>
                                                        </div>
                                                        
                                                       
                                                        <div class="form-group col-md-12">
                                                            <label for="inputZip" class="col-form-label">Nama</label>
                                                            <input type="text" class="form-control" name="nama" value="<?php echo $a['nama'];?>" required>
                                                             <input type="hidden" class="form-control" name="no" value="<?php echo $no;?>" required>
                                                        </div>

                                                         <div class="form-group col-md-12">
                                                            <label for="inputZip" class="col-form-label">Nomor Telepon</label>
                                                             <input type="text" class="form-control" name="nohp" value="<?php echo $a['nohp'];?>" required>
                                                        </div>
                                                   


                                               
                                                  
                                                     
                                                       
                                                        <div class="form-group col-md-12">
                                                            <label for="inputZip" class="col-form-label">Tanggal Lahir</label>
                                                            <input type="text" class="datepicker form-control" name="tgllahir"  id="datepicker" value="<?php echo $a['tgllahir'];?>">
                                                        </div>

                                                                                                             
                                                           <div class="form-group col-md-12">
                                                            <label for="inputCity" class="col-form-label">Alamat</label>
                                                          
                                                            <textarea class="form-control" name="alamat"><?php echo $a['alamat'];?></textarea>
                                                        </div>


                                                      
                                                      <div class="row">
                                                   <div class="col-6">
                                                    <button type="button" class="btn btn-purple waves-effect waves-light btn-block" onclick="window.location.href='user'" >Kembali</button>
                                                   </div>
                                                  <div class="col-6">
                                                    <button type="submit" class="btn btn-info btn-block" name="simpan">SIMPAN</button>
                                                  </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="card-box ">
                                                <h4 class="header-title">Edit Foto dan Jabatan</h4>
                                                <p class="sub-header">
                                                    
                                                </p>
            
                                               <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                                  
                                                   
                                               
                                                 
                                                       <img src="<?php echo $avatar;?>" alt="image"
                                                            class="img-fluid rounded" width="250"/>

                                                            <br>
                                                             <br>
                                                              
                                                       
                                                        <div class="form-group col-md-12">
                                                            <label for="inputZip" class="col-form-label">Avatar</label>
                                                            <input type="file" class="form-control" name="avatar" >
                                                        </div>

                                                         <div class="form-group col-md-12">
                                                            <label for="inputZip" class="col-form-label">Jabatan</label>
                                                            <select name="jabatan" class="form-control" data-toggle="select2">
                                                          <?php
        $sql=mysqli_query($conn,"select * from jabatan order by no");
        while ($row=mysqli_fetch_assoc($sql)){
          if ($a['jabatan']==$row['nama'])
          echo "<option value='".$row['nama']."' selected='selected'>".$row['nama']."</option>";
          else
          echo "<option value='".$row['nama']."'>".$row['nama']."</option>";
        }
      ?>
                                                           </select>
                                                        </div>
                                                   


                                               <br>
                                                  <input type="hidden" name="username" id="username" value="<?php echo $a['userna_me'];?>" autocomplete="off">
                                                   <input type="hidden" class="form-control" name="no" value="<?php echo $no;?>" required>
                                                     

                                                      
                                                      <div class="row">
                                                   
                                                  <div class="col-6">
                                                    <button type="submit" class="btn btn-success btn-block" name="save">UPDATE</button>
                                                  </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>




                                        <div class="col-md-4">
                                            <div class="card-box ">
                                                <h4 class="header-title">Ganti Password</h4>
                                                <p class="sub-header">
                                                    
                                                </p>
            
                                               <form class="form-horizontal" method="post" >
                                                  
                                                   
                                              
                                                 
                                                        <div class="form-group col-md-12">
                                                            <label for="inputCity" class="col-form-label">Password Baru</label>
                                                            <input type="password" class="form-control" name="password" id="password" autocomplete="off" required autocomplete="off">
                                                                
                                                        </div>
                                                        
                                                       
                                                        <div class="form-group col-md-12">
                                                            <label for="inputZip" class="col-form-label">Konfirmasi Password</label>
                                                             <input type="password" class="form-control" name="ulangi" id="password2" autocomplete="off" required autocomplete="off">
                                                        </div>



                                                         <div class="form-group col-md-12">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="checkbox1" type="checkbox" onclick="myFunction()">
                                                    <label for="checkbox1">
                                                        Tampilkan
                                                    </label>
                                                </div>
                                            </div>

                                                <input type="hidden" name="username" id="username" value="<?php echo $a['userna_me'];?>" autocomplete="off">
                                                 <input type="hidden" class="form-control" name="no" value="<?php echo $no;?>" required>
                                                         

                                                      
                                                      <div class="row">
                                                 
                                                  <div class="col-6">
                                                    <button type="submit" class="btn btn-success btn-block" name="update">UPDATE</button>
                                                  </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
















                                    </div>
                                    <!-- end row -->
                     




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
        if(isset($_POST['save'])){


 $jabatan= mysqli_real_escape_string($conn, $_POST["jabatan"]);
  $username= mysqli_real_escape_string($conn, $_POST["username"]);
   $no= mysqli_real_escape_string($conn, $_POST["no"]);


 $namaavatar = $_FILES['avatar']['name'];
                      $ukuranavatar = $_FILES['avatar']['size'];
                      $tipeavatar = $_FILES['avatar']['type'];
                      $tmp = $_FILES['avatar']['tmp_name'];
                      $avatar = "upload/image/".$namaavatar;


  if( ($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000) ){
        move_uploaded_file($tmp, $avatar);

$sql="UPDATE user SET jabatan='$jabatan', avatar='$avatar' WHERE userna_me='$username' AND no='$no'";

      } else {
$sql="UPDATE user SET jabatan='$jabatan' WHERE userna_me='$username' AND no='$no'";

      }

if(mysqli_query($conn,$sql)){
echo "<script type='text/javascript'>window.location = '$forwardpage?key=$no&update=true';</script>";
} else {
echo "<script type='text/javascript'>window.location = '$forwardpage?key=$no&update=false';</script>";
}



        } } ?>


<!-- END Letak Kode PHP bawah -->



 <script src="assets/jQuery/jquery-3.1.1.min.js"></script>

 <script>
function myFunction() {
  var x = document.getElementById("password");
   var y = document.getElementById("password2");
  if (x.type === "password") {
    x.type = "text";
     y.type = "text";
  } else {
    x.type = "password";
     y.type = "password";
  }
}
</script>



   
<script>
            $(document).ready(function(){

                $("#email").keyup(function(){

                    var email = $(this).val().trim();
            
                    if(email != ''){
            
                       
            
                        $.ajax({
                            url: 'user_edit_cek.php',
                            type: 'post',
                            data: {email: email},
                            success: function(response){
                
                                $('#email_response').html(response);
                
                             }
                        });
                    }else{
                        $("#email").html("");
                    }
            
                });

            });
        </script>      

       
<script>
            $(document).ready(function(){

                $("#username").keyup(function(){

                    var username = $(this).val().trim();
            
                    if(username != ''){
            
                       
            
                        $.ajax({
                            url: 'user_cek.php',
                            type: 'post',
                            data: {username: username},
                            success: function(response){
                
                                $('#uname_response').html(response);
                
                             }
                        });
                    }else{
                        $("#uname_response").html("");
                    }
            
                });

            });
        </script>      

<!-- Library & Pluggins-->
  <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <script src="assets/libs/switchery/switchery.min.js"></script>
        <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="assets/libs/select2/select2.min.js"></script>
    
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
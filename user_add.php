<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Pengguna |<?php echo $app;?></title>
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

$halaman = "user_add"; // halaman
$dataapa = "Tambah User"; // data
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
                                            <li class="breadcrumb-item"><a href="user">Manajemen User</a></li>
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

       if($_SERVER["REQUEST_METHOD"] == "POST"){


        $pesanError = array();
      if (trim($_POST['username'])=="") {
        $pesanError[] = "<b>User Name</b> tidak boleh kosong !";    
      }

        if (trim($_POST['email'])=="") {
        $pesanError[] = "<b>Email</b> Wajib diisi !";    
      }

      if (trim($_POST['password'])=="") {
        $pesanError[] = "<b>Password</b> tidak boleh kosong !";    
      }

      if (strlen($_POST['password'])<6) {
        $pesanError[] = "<b>Password</b> minimal 6 karakter !";    
      } 

      if (strlen($_POST['password'])>8) {
        $pesanError[] = "<b>Password</b> maksimal 8 karakter !";    
      } 

      if (trim($_POST['nama'])=="") {
        $pesanError[] = "<b>Nama</b> tidak boleh kosong !";    
      }


                      $username = mysqli_real_escape_string($conn, $_POST["username"]);
                      $email = mysqli_real_escape_string($conn, $_POST["email"]);
                      $password = md5($_POST["password"]);
                      $password = sha1($password);
                      $password = mysqli_real_escape_string($conn, $password);
                      $password2 = md5($_POST["password2"]);
                      $password2 = sha1($password2);
                      $password2 = mysqli_real_escape_string($conn, $password2);
                      $nama= mysqli_real_escape_string($conn, $_POST["nama"]);
                      $jabatan= mysqli_real_escape_string($conn, $_POST["jabatan"]);
                      $nohp= mysqli_real_escape_string($conn, $_POST["nohp"]);
                      $alamat= mysqli_real_escape_string($conn,$_POST["alamat"]);
                      $tgllahir= mysqli_real_escape_string($conn, $_POST["tgllahir"]);
                      $tglaktif= date('Y-m-d');
                      $namaavatar = $_FILES['avatar']['name'];
                      $ukuranavatar = $_FILES['avatar']['size'];
                      $tipeavatar = $_FILES['avatar']['type'];
                      $tmp = $_FILES['avatar']['tmp_name'];
                      $avatar = "upload/image/".$namaavatar;
                    
                     


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



                 $sql="select * from $tabeldatabase where userna_me ='$username'";
            $result=mysqli_query($conn,$sql);

                  if(mysqli_num_rows($result)>0){
              if((($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000 && $username != null)) && ($chmod >= 3 || $_SESSION['jabatan'] == 'admin')){
                      move_uploaded_file($tmp, $avatar);
                      $sql1 = "update $tabeldatabase set pa_ssword='$password',  email='$email', nama='$nama', nohp='$nohp', alamat='$alamat', tgllahir='$tgllahir', tglaktif='$tglaktif', jabatan='$jabatan',avatar='$avatar' where userna_me='$username'";
                      $updatean = mysqli_query($conn, $sql1);
                      echo "<script type='text/javascript'>  alert('Berhasil, Data berhasil diupdate!');</script>";
                      echo "<script type='text/javascript'>window.location = 'user';</script>";

              }else if($chmod >= 3 || $_SESSION['jabatan'] == 'admin'){
                    $avatar = "upload/image/placeholder.png";
                    $sql1 = "update $tabeldatabase set pa_ssword='$password',  email='$email', nama='$nama', nohp='$nohp', alamat='$alamat', tgllahir='$tgllahir', tglaktif='$tglaktif', jabatan='$jabatan',avatar='$avatar' where userna_me='$username'";
                    $updatean = mysqli_query($conn, $sql1);
                    echo "<script type='text/javascript'>  alert('Berhasil, Data berhasil diupdate!');</script>";
                    echo "<script type='text/javascript'>window.location = 'user';</script>";

            }else{
                ?>
                  <body onload="setTimeout(function() { document.frm1.submit() }, 10)">
      <form action="<?php echo $baseurl; ?>/<?php echo $forwardpage;?>" name="frm1" method="post">
      <input type="hidden" name="hapusberhasil" value="3" />
      </form>
                <?php
              }
            }
          else if((($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000 && $username != null && $password != null && $nama != null)) && ( $chmod >= 2 || $_SESSION['jabatan'] == 'admin')){
               move_uploaded_file($tmp, $avatar);
               if($password == $password2){
               $sql2 = "insert into $tabeldatabase values( '$username','$email','$password','$nama','$alamat','$nohp','$tgllahir','$tglaktif','$jabatan','$avatar','')";
               $insertan = mysqli_query($conn, $sql2);
               echo "<script type='text/javascript'>  alert('Berhasil, Data berhasil ditambahkan!');</script>";
               echo "<script type='text/javascript'>window.location = 'user';</script>";
             }else{
               echo "<script type='text/javascript'>  alert('Gagal, Pastikan kata sandi sama!');</script>";
             }
             }else {
               if($password == $password2){
                 $avatar = "upload/image/placeholder.png";
               $sql2 = "insert into $tabeldatabase values( '$username','$email','$password','$nama','$alamat','$nohp','$tgllahir','$tglaktif','$jabatan','$avatar','')";
               $insertan = mysqli_query($conn, $sql2);
               echo "<script type='text/javascript'>  alert('Berhasil, Data berhasil ditambahkan!');</script>";
               echo "<script type='text/javascript'>window.location = 'user';</script>";
             }else{
                  echo "<script type='text/javascript'>  alert('Gagal, Pastikan kata sandi sama!');</script>";
             }
           }

    }

  }

             ?>

<!-- END Letak Kode PHP atas -->
<!-- Form row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-box ">
                                                <h4 class="header-title">Tambah User</h4>
                                                <p class="sub-header">
                                                    <code class="highlighter-rouge">User</code> dibuat untuk petugas sekolah sesuai dengan fungsi dan jabatan masing masing
                                                </p>
            
                                               <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                                  
                                                   
                                               
                                                   <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label for="inputCity" class="col-form-label">Username</label>
                                                            <input type="text" class="form-control" name="username" id="username" required value="" autocomplete="off">
                                                                <div id="uname_response" ></div>
                                                        </div>

                                                         <div class="form-group col-md-3">
                                                            <label for="inputZip" class="col-form-label">Email</label>
                                                            <input type="email" class="form-control" name="email" id="email" required autocomplete="off">
                                                            <div id="email_response" ></div>
                                                        </div>

                                                        
                                                       
                                                        <div class="form-group col-md-6">
                                                            <label for="inputZip" class="col-form-label">Nama</label>
                                                            <input type="text" class="form-control" name="nama" required>
                                                        </div>
                                                    </div>


                                                   <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label for="inputCity" class="col-form-label">Password (6-8 karakter)</label>
                                                            <input type="password" class="form-control" name="password" required>
                                                        </div>

                                                         <div class="form-group col-md-3">
                                                            <label for="inputCity" class="col-form-label">Konfirmasi Password</label>
                                                            <input type="password" class="form-control" name="password2" required>
                                                        </div>
                                                       
                                                        <div class="form-group col-md-3">
                                                            <label for="inputZip" class="col-form-label">Jabatan</label>
                                                           <select name="jabatan" class="form-control" data-toggle="select2">
                                                          <?php
        $sql=mysqli_query($conn,"select * from jabatan order by no");
        while ($row=mysqli_fetch_assoc($sql)){
          if ($jabatan==$row['nama'])
          echo "<option value='".$row['nama']."' selected='selected'>".$row['nama']."</option>";
          else
          echo "<option value='".$row['nama']."'>".$row['nama']."</option>";
        }
      ?>
                                                           </select>
                                                        </div>

                                                         <div class="form-group col-md-3">
                                                            <label for="inputCity" class="col-form-label">Nomor Telpon</label>
                                                            <input type="text" class="form-control" name="nohp" required>
                                                        </div>
                                                    </div>


                                                   <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputCity" class="col-form-label">Alamat</label>
                                                            <input type="text" class="form-control" name="alamat" required>
                                                        </div>
                                                       
                                                        <div class="form-group col-md-3">
                                                            <label for="inputZip" class="col-form-label">Tanggal Lahir</label>
                                                            <input type="text" class="datepicker form-control" name="tgllahir"  id="datepicker" value="<?php echo date('Y-m-d');?>">
                                                        </div>

                                                        <div class="form-group col-md-3">
                                                            <label for="inputZip" class="col-form-label">Avatar</label>
                                                           <input type="file" class="form-control" name="avatar"  id="file">
                                                        </div>

                                                        </div>


 <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                                      
                                                      <div class="row">
                                                   <div class="col-3">
                                                    <button type="button" class="btn btn-purple waves-effect waves-light btn-block" onclick="window.location.href='user'" >Kembali</button>
                                                   </div>
                                                  <div class="col-9">
                                                    <button type="submit" class="btn btn-info btn-block" name="simpan">SIMPAN</button>
                                                  </div>
                                                </div>

  <?php } ?>
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




<!-- END Letak Kode PHP bawah -->



 <script src="assets/jQuery/jquery-3.1.1.min.js"></script>
       
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



   
<script>
            $(document).ready(function(){

                $("#email").keyup(function(){

                    var email = $(this).val().trim();
            
                    if(email != ''){
            
                       
            
                        $.ajax({
                            url: 'user_cek_email.php',
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
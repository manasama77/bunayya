<!DOCTYPE html>
<html>

  <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?php

include "configuration/config_include.php";
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

$halaman = "set_sekolah"; // halaman
$dataapa = "Sekolah"; // data
$tabeldatabase = "data"; // tabel database
$chmod = $chmenu8; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->

<?php
          $sql1="select * from data";
                           $hasil2 = mysqli_query($conn,$sql1);
                           while ($fill = mysqli_fetch_assoc($hasil2)){

          $nama = $fill['nama'];
          $email = $fill['email'];
          $web = $fill['web'];
          $npwp = $fill['npwp'];
          $alamat = $fill['alamat'];
          $notelp = $fill['notelp'];
          $tagline = $fill['tagline'];
          $signature = $fill['signature'];
          $avatar = $fill['avatar'];

          if($avatar !=''){

            $logo=$avatar;
        } else {
            $logo="upload/image/placeholder200x60.png";
        }

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
                                            li class="breadcrumb-item"><a href="index">DashBoard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaturan</a></li>
                                            <li class="breadcrumb-item active"><?php echo $dataapa;?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Data <?php echo $dataapa;?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end halaman dan breadcrumbs --> 


<!-- ISI HALAMAN -->


                        	  <!-- Form row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-box ">
                                                <h4 class="header-title">Form Data Sekolah</h4>
                                                <p class="sub-header">
                                                    <code class="highlighter-rouge">Data Sekolah</code> yang lengkap adalah kunci dari kelancaran semua proses KBM dan Administrasi yang berjalan
                                                </p>
            
                                               <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="inputEmail4" class="col-form-label">Nama Sekolah</label>
                                                            <input type="text" class="form-control" value="<?php echo $nama;?>" name="nama" required>
                                                        </div>


                                                      
                                                    </div>
                                                   
                                                    

                                                    <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                        <label for="inputAddress2" class="col-form-label">Email</label>
                                                        <input type="email" class="form-control" placeholder="email" value="<?php echo $email;?>" name="email" required>
                                                    </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="inputPassword4" class="col-form-label">Nomor Telepon</label>
                                                            <input type="text" class="form-control" name="notelp" placeholder="Wajib" value="<?php echo $notelp;?>" required>
                                                        </div>

                                                         <div class="form-group col-md-3">
                                                            <label for="inputPassword4" class="col-form-label">Website</label>
                                                            <input type="text" class="form-control" id="inputPassword4" value="<?php echo $web;?>" placeholder="opsional" name="web">
                                                        </div>
                                                          <div class="form-group col-md-3">
                                                            <label for="inputPassword4" class="col-form-label">NPWP</label>
                                                            <input type="text" class="form-control" id="inputPassword4" value="<?php echo $npwp;?>" placeholder="opsional" name="npwp">
                                                        </div>
                                                    </div>
                                                    
                                                   <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputCity" class="col-form-label">Tagline</label>
                                                            <input type="text" class="form-control" value="<?php echo $tagline;?>" name="tagline">
                                                        </div>
                                                       
                                                        <div class="form-group col-md-6">
                                                            <label for="inputZip" class="col-form-label">Signature</label>
                                                            <input type="text" class="form-control" value="<?php echo $signature;?>" name="signature">
                                                        </div>
                                                    </div>


                                                         <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="inputAddress" class="col-form-label">Alamat</label>
                                                         <textarea id="textarea" class="form-control" maxlength="255" rows="3" placeholder="Alamat Sekolah" name="alamat"><?php echo $alamat;?></textarea>
                                                    </div>


                                                    


                                                <div class="form-group col-md-3">
                                                            <label for="inputZip" class="col-form-label">Logo</label>
                                                            <input type="file" class="form-control" name="avatar">
                                                        </div>

                                                         <div class="col-sm-3">
                                                    <img src="<?php echo $logo;?>" alt="image"
                                                            class="img-fluid img-thumbnail" width="200"/>
                                                    <p class="mt-3 mb-0">
                                                       
                                                    </p>
                                                </div>

                                                </div>
                                                      <div class="row">
                                                   <div class="col-3">
                                                    <button type="button" class="btn btn-purple waves-effect waves-light btn-block" onclick="window.location.href='set_sekolah_data'" >Kembali</button>
                                                   </div>
                                                  <div class="col-9">
                                                    <button type="submit" class="btn btn-info btn-block" name="setting">SIMPAN</button>
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

if(isset($_POST['setting'])){
     if($_SERVER["REQUEST_METHOD"] == "POST"){
$nama = $alamat = $notelp = $tagline = $signature= $avatar="";
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$notelp = $_POST['notelp'];
$tagline = $_POST['tagline'];
$signature = $_POST['signature'];

$email = $_POST['email'];
$web = $_POST['web'];
$npwp = $_POST['npwp'];

$namaavatar = $_FILES['avatar']['name'];
$ukuranavatar = $_FILES['avatar']['size'];
$tipeavatar = $_FILES['avatar']['type'];
$tmp = $_FILES['avatar']['tmp_name'];
$avatar = "upload/image/".$namaavatar;
$sql="select * from data";
       $result=mysqli_query($conn,$sql);
   if(mysqli_num_rows($result)>0){

     if(mysqli_num_rows($result)>0){
 if((($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000)) && ($chmod >= 3 || $_SESSION['jabatan'] == 'admin')){
         move_uploaded_file($tmp, $avatar);
         $sql1 = "update data set nama='$nama', alamat='$alamat', notelp='$notelp', tagline='$tagline', signature='$signature', email='$email', web='$web', npwp='$npwp', avatar='$avatar'";
         $updatean = mysqli_query($conn, $sql1);
       echo '<script>
    setTimeout(function() {
        swal({
    title: "Berhasil!",
    text: "Data dan Logo Sekolah telah disimpan, klik ok untuk refresh!",
    type: "success"
}).then(function() {
    window.location = "set_sekolah";
});
    }, 1000);
</script>';

 }else if($chmod >= 3 || $_SESSION['jabatan'] == 'admin'){
       $avatar = "upload/image/placeholder200x60.png";
        $sql1 = "update data set nama='$nama', alamat='$alamat', notelp='$notelp', tagline='$tagline', signature='$signature', email='$email', web='$web', npwp='$npwp', avatar='$avatar'";
       $updatean = mysqli_query($conn, $sql1);
          echo '<script>
    setTimeout(function() {
        swal({
    title: "Berhasil!",
    text: "Data Sekolah telah disimpan, klik ok untuk refresh!",
    type: "success"
}).then(function() {
    window.location = "set_sekolah";
});
    }, 1000);
</script>';
}else{
 echo "<script type='text/javascript'>  alert('Gagal!');</script>";

 }
}
else if((($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000)) && ( $chmod >= 2 || $_SESSION['jabatan'] == 'admin')){
  move_uploaded_file($tmp, $avatar);
  $sql2 = "insert into data (nama, alamat, notelp, tagline, signature, email, web, npwp, avatar) values('$nama','$alamat','$notelp','$tagline','$signature','$email','$web','$npwp','$avatar')";
  $insertan = mysqli_query($conn, $sql2);
  echo "<script type='text/javascript'>  alert('Berhasil, Data berhasil ditambahkan!');</script>";
  echo "<script type='text/javascript'>window.location = 'set_general';</script>";
}else {
  $avatar = "upload/image/placeholder200x60.png";
   $sql2 = "insert into data (nama, alamat, notelp, tagline, signature, email, web, npwp, avatar) values('$nama','$alamat','$notelp','$tagline','$signature','$email','$web','$npwp','$avatar')";
  $insertan = mysqli_query($conn, $sql2);
  echo "<script type='text/javascript'>  alert('Berhasil, Data berhasil ditambahkan!');</script>";
  echo "<script type='text/javascript'>window.location = 'set_general';</script>";
}
}
}
}

        ?>


<!-- END Letak Kode PHP bawah -->




<!-- Library & Pluggins-->
  <!-- Vendor js -->
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

         
 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>


         <!-- Init js-->
        <script src="assets/js/pages/form-pickers.init.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
<!-- END Lib & Plugins-->






</body>
</html>
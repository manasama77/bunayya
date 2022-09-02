<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Tahun Ajaran |<?php echo $app;?></title>
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

$halaman = "m_period"; // halaman
$dataapa = "Tahun Ajaran"; // data
$tabeldatabase = "periode"; // tabel database
$chmod = $chmenu4; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman

if(isset($_GET['no'])){
  $id=$_GET['no'];
  $query="SELECT * FROM periode WHERE no='$id'";
  $a=mysqli_fetch_assoc(mysqli_query($conn,$query));
} else {
  $id="X";
}

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
                                            <li class="breadcrumb-item"><a href="m_period">Manajemen</a></li>
                                            <li class="breadcrumb-item active"><?php echo $dataapa;?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $dataapa;?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end halaman dan breadcrumbs --> 


<!-- ISI HALAMAN -->

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
 <div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Berhasil!</strong> tahun ajaran telah diupdate </div>

<?php } else if ($msg == "true"){ ?>

 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert"
 aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
 <strong>Berhasil!</strong> Tahun Ajaran telah ditambahkan
 </div>
<?php } ?>

                           <div class="row">

 <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>

                             <div class="col-3">
                                <div class="card-box">
                                   <h4 class="header-title">Input Tahun Ajaran</h4>
                                   
                                   <p></p>
                                   <form method="post">
                                  <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Tahun Awal</label>
                                                                <input type="text" class="form-control" id="awal" name="awal" placeholder="20xx" required maxlength="4" autocomplete="off" onkeyup="sum2();">
                                                              
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <script>
                                   function sum2() {
                                         var txtFirstNumberValue =  document.getElementById('awal').value
                                         var txtSecondNumberValue = 1;
                                         var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue);
                                         if (!isNaN(result)) {
                                            document.getElementById('akhir').value = result;
                                         }
                                       if (!$(awal).val()){
                                         document.getElementById('akhir').value = "0";
                                       }
                                       if (!$(awal).val()){
                                         document.getElementById('akhir').value = "0";
                                       }
                                   }
                                   </script>


                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Tahun Akhir</label>
                                                                <input type="text" class="form-control" id="akhir" name="akhir" required readonly>
                                                              
                                                            </div>
                                                        </div>
                                                    </div>

                                                      
                                           <div class="radio radio-success form-check-inline">
                                                    <input type="radio" id="1" value="active" name="status" checked >
                                                    <label for="inlineRadio1"> Aktif </label>
                                                </div>
                                                <div class="radio radio-success form-check-inline">
                                                    <input type="radio" id="2" value="inactive" name="status" >
                                                    <label for="inlineRadio2"> Nonaktif </label>
                                                </div>

                                                <br>
                                                <br>

                                                <div class="row">
                                                   <?php if($no !='' || $no != null){?>
                                                                     <button type="submit" name="update" class="btn btn-block btn-info waves-effect width-md waves-light">UPDATE</button>

                                                                <?php } else {?>
                                                            <button type="submit" name="simpan" class="btn btn-block btn-success waves-effect width-md waves-light">SIMPAN</button>
                                                        <?php } ?>
                                              </div>

                                            </form>
                                </div>
                              </div>

<?php } ?>




                            <div class="col-9">
                                <div class="card-box">
                                    <h4 class="header-title">DATA Tahun Ajaran</h4>
                                    <p class="sub-header">
                                        Wajib ada 1 tahun ajaran yang aktif agar aplikasi bisa dipakai
                                    </p>

                                    <div class="table-responsive">
                                              
                                           

                                        <table class="table table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width:10%">No</th>
                                                <th>Tahun Ajaran</th>
                                                 <th>Status</th>
                                                                                               
                                                <th style="width:20%">Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
<?php $no=0;
$rek=mysqli_query($conn, "SELECT * FROM periode ORDER BY no desc");
while($fill=mysqli_fetch_assoc($rek)){;?>

                                            <tr>
                                                                                               
                                                <td><?php echo ++$no;?></td>
                                                <td><?php echo mysqli_real_escape_string($conn,$fill['period_name']);?></td>
                                                <td><?php echo mysqli_real_escape_string($conn,$fill['status']);?></td>
                                               
                                                 <td>

                                                    <?php  if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>

                                                     
                                                        <button class="demo-delete-row btn btn-info btn-sm btn-icon" 
                                                onclick="window.location.href='m_class?no=<?php echo $fill['no'];?>'" ><i class="fa fa-edit"></i></button>

                                                <?php if($fill['status']=='inactive'){ ?>

                                                       <button class="demo-delete-row btn btn-danger btn-sm btn-icon" 
                                                onclick="window.location.href='deletion?key=<?php echo $fill['no'].'&'; ?>f=<?php echo "periode".'&';?>r=<?php echo $halaman.'&'; ?>d=Tahun Ajaran'"

                                                ><i class="fa fa-times"></i></button>

                                                 <button class="demo-delete-row btn btn-success btn-sm btn-icon" 
                                                onclick="window.location.href='component/setting/status_tahunajar?no=<?php echo $fill['no'].'&'; ?>forward=<?php echo "periode".'&';?>forwardpage=<?php echo $halaman.'&'; ?>&status=<?php echo "active".'&';?>chmod=<?php echo $chmod; ?>'"><i class="fas fa-check"></i></button>

                                              <?php } ?>

                                                 </td>

                                               <?php } ?>

                                            </tr>
                                           <?php } ?>




                                            </tbody>
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
<?php

right();

?>

<!-- End Sidebar Kanan -->





<!-- Letak Kode PHP Bawah -->



<?php
if(isset($_POST['simpan'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

          $awal = mysqli_real_escape_string($conn, $_POST["awal"]);
           $akhir = mysqli_real_escape_string($conn, $_POST["akhir"]);
            $status = mysqli_real_escape_string($conn, $_POST["status"]);

            $nama = $awal . '/' . $akhir;
        
           $sql="select * from periode where period_name='$nama'";
        $result=mysqli_query($conn,$sql);


           if(mysqli_num_rows($result)>0){
                        
                //sudah ada

              } else {

                if($status=='active'){

          $sqli=mysqli_query($conn, "UPDATE periode SET status='inactive'");      

          $sql="INSERT INTO periode VALUES('','$awal','$akhir','$nama','active')";

          if(mysqli_query($conn,$sql)){
             echo "<script type='text/javascript'>window.location = '$forwardpage?insert=true';</script>";
          } else {
              echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
          }

        } else {

           $sql="INSERT INTO periode VALUES('','$awal','$akhir','$nama','inactive')";

          if(mysqli_query($conn,$sql)){
             echo "<script type='text/javascript'>window.location = '$forwardpage?insert=true';</script>";
          } else {
              echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
          }

        }

        }

      } } ?>


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
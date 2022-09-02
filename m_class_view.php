<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Siswa dalam Kelas |<?php echo $app;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Aplikasi Kelola Sales dan Keuangan" name="description" />
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
$c=$_GET['ref_id'];


$halaman = "m_class_view"; // halaman
$next="m_class_view?ref_id=$c";
$dataapa = "Siswa"; // data
$tabeldatabase = "student"; // tabel database
$chmod = $chmenu4; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman

//End Setting Halaman
 

 $a=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM class WHERE no='$c'"));
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
                                            <li class="breadcrumb-item"><a href="m_class">Kelas</a></li>
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
 <div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Berhasil!</strong> Kelas telah diupdate </div>

<?php } else if ($msg == "true"){ ?>

 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert"
 aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
 <strong>Berhasil!</strong> Kelas telah ditambahkan
 </div>
<?php } ?>

                        	 <div class="row">
                            <div class="col-12">
                              <?php if(isset($_GET['delete'])){?>

                                 <div class="card-header bg-danger text-white">
                                        <div class="card-widgets">
                                            <a href="m_class" ><i class="mdi mdi-undo"></i></a>
                                           
                                        </div>
                                        <h5 class="card-title mb-0 text-white">Kelas tidak bisa dihapus karena masih ada siswa berikut didalamnya, hapus semua siswa dalam kelas agar bisa menghapus data kelas</h5>
                                    </div>

                              <?php }  ?>
                                <div class="card-box">
                                    <h4 class="header-title">DATA Siswa pada kelas <?php echo $a['kelas'];?></h4>
                                   

                                    <div class="table-responsive">

                                                <br>


 <?php
              error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
            
                $sql    = "SELECT * FROM student WHERE kelas_id='$c' ORDER BY student_id";
             
               $result = mysqli_query($conn, $sql);
               $rpp    = 5;
               $reload = "$halaman"."?ref_id=$c&pagination=true";
               $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

               if ($page <= 0)
               $page = 1;
               $tcount  = mysqli_num_rows($result);
               $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
               $count   = 0;
               $i       = ($page - 1) * $rpp;
               $no_urut = ($page - 1) * $rpp;
               ?>
                                        <table class="table table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width:10%">No</th>
                                                <th>Kelas</th>
                                                 <th>NIS</th>
                                                <th>Nama Siswa</th>
                                                 <th>Jenis Kelamin</th>
                                                <th style="width:15%">Opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
  <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $fill = mysqli_fetch_array($result);
               ?>  

                                            <tr>
                                                                                               
                                                <td><?php echo ++$no;?></td>
                                                <td><?php $b=$fill['kelas_id'];
                                                    $b1=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM class WHERE no='$b'"));
                                                    echo $b1['kelas'];
                                                ?>
                                                  
                                                </td>
                                                <td><?php echo mysqli_real_escape_string($conn,$fill['nis']);?></td>
                                                 <td><?php echo mysqli_real_escape_string($conn,$fill['nama']);?></td>
                                                <td><?php echo mysqli_real_escape_string($conn,$fill['gender']);?></td>
                                                  <td>

                                                   
                                                     <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                                     <a href="m_student_add?id=<?php echo $fill['student_id'];?>" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-wrench"></i> </a>

                                                         <a href="m_student_detail?id=<?php echo $fill['student_id'];?>" class="btn btn-icon waves-effect waves-light btn-info" > <i class="fas fa-eye"></i> </a>

                                                    <?php } ?>

                                                     


                                                            <?php  if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                                                        <button type="button" class="btn btn-small btn-icon waves-effect waves-light btn-danger" onclick="window.location.href='deletion?key=<?php echo $fill['student_id'].'&'; ?>f=<?php echo "student".'&';?>r=<?php echo $next.'&'; ?>d=Siswa'"> <i class="fas fa-times"></i> </button>
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
if(isset($_POST['class'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

          $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
           $id = mysqli_real_escape_string($conn, $_POST["id"]);
        
           $sql="select * from class where no='$id'";
        $result=mysqli_query($conn,$sql);


           if(mysqli_num_rows($result)>0){
                        
                  $sql="UPDATE class SET kelas='$nama' WHERE no='$id'";

                  if(mysqli_query($conn,$sql)){
                      echo "<script type='text/javascript'>window.location = '$forwardpage?period=exist';</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
                    }

              } else {

          $sql="INSERT INTO class VALUES('','$nama','active')";

          if(mysqli_query($conn,$sql)){
             echo "<script type='text/javascript'>window.location = '$forwardpage?insert=true';</script>";
          } else {
              echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
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
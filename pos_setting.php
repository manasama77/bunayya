<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Setting Pembayaran |<?php echo $app;?></title>
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
pagination();
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

$halaman = "pos_setting"; // halaman
$dataapa = "Tarif Pembayaran"; // data
$tabeldatabase = "kosong"; // tabel database
$chmod = $chmenu2; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman

$jenis_id=$_GET['q'];
$a=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM jenis_bayar WHERE jenis_id='$jenis_id'"));
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
                                            <li class="breadcrumb-item"><a href="pos_bayar">POS Pembayaran</a></li>
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
<strong>GAGAL!</strong> data tersebut sudah ada</div>

<?php } ?>




                        	 <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title">Tarif <?php echo $a['nama']." - T.A ".$a['tahunajar'];?></h4>
                                    <p class="sub-header">
                                        Tentukan Besar Pembayaran berdasarkan kelas atau siswa
                                    </p>

                                    <div class="table-responsive">
                                          <div class="col-lg-12">
                                               
                                                <form class="form-inline" method="get">
                                                    <div class="form-group mr-2">
                                                        <label for="exampleInputName2" class="mr-2">Tahun Ajaran</label>
                                                        <input type="text" class="form-control" value="<?php echo $a['tahunajar'];?>" readonly>
                                                    </div>
                                                    <div class="form-group mr-2">
                                                        <label for="exampleInputEmail2" class="mr-2">Kelas</label>
                                                       <select class="form-control" id="kelas" name="kelas" >
                                                           <option value="all">--- Semua Kelas ---</option>
                                                           <?php
        $sql=mysqli_query($conn,"select * from class where status='active'");
        while ($row=mysqli_fetch_assoc($sql)){
          if ($_GET['kelas']==$row['no'])
          echo "<option value='".$row['no']."' selected='selected'>".$row['kelas']."</option>";
          else
          echo "<option value='".$row['no']."'>".$row['kelas']."</option>";
        }
      ?>
                                                       </select>
                                                    </div>
             <input type="hidden" name="q" value="<?php echo $jenis_id;?>">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-md">
                                                        Tampilkan
                                                    </button>
                                                </form>
                                            </div>

                                            <hr/>


                                    <?php if($a['jenis_pembayaran']=='bulanan'){?>       
                                          <a href="pos_setting_class?q=<?php echo $jenis_id;?>" class="btn btn-dark waves-effect waves-light">Berdasar Kelas</a>
                                     
                                     
                                           <a href="pos_setting_student?q=<?php echo $jenis_id;?>" class="btn btn-info waves-effect waves-light ">Berdasar Siswa</a>
                                      
                                     
                                         <a href="pos_jenis" class="btn btn-danger waves-effect waves-light ">Kembali</a>
                                    
                                          <?php } else {?>

                                            <a href="pos_setting_byclass?q=<?php echo $jenis_id;?>" class="btn btn-dark waves-effect waves-light">Berdasar Kelas</a>
                                     
                                     
                                           <a href="pos_setting_bystudent?q=<?php echo $jenis_id;?>" class="btn btn-info waves-effect waves-light ">Berdasar Siswa</a>
                                      
                                     
                                         <a href="pos_jenis" class="btn btn-secondary waves-effect waves-light ">Kembali</a>

                               <?php           } ?>
                                    


                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title">Daftar Tarif Siswa untuk </h4>
                                   
                                    

                                 
                                      <?php
              error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
              $kls=$_GET['kelas'];
              if (($kls!='' || $kls !=null)&&($kls!='all')){
               $sql    = "select * from student where kelas_id ='$kls' order by student_id desc";
             } else if($kls=='all') {
                $sql    = "select * from student order by student_id desc";
             }
               $result = mysqli_query($conn, $sql);
               $rpp    = 15;
               $reload = "$halaman?kelas=$kls&q=$jenis_id"."&pagination=true";
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
                                        <table class="table m-0 table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:10px">#</th>
                                                 <th>NIS </th>
                                                <th>Nama</th>
                                                 <th>Kelas</th>
                                                  <?php if($a['jenis_pembayaran']=='bebas'){?>  
                                                    <th>Tarif</th>
                                                  <?php } ?>
                                                 
                                               
                                                <th style="width:10%">Opsi</th>
                                            </tr>
                                            </thead>

        <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $fill = mysqli_fetch_array($result);
               ?>                                      
                                            <tr>                                            

                                              <td><?php echo ++$no_urut;?></td>
                                              
                                               <td><?php  echo mysqli_real_escape_string($conn, $fill['nis']); ?> </td>
                                               <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
                                              <td><?php $klsa=$fill['kelas_id'];
                                                $q=mysqli_fetch_assoc(mysqli_query($conn,"SELECT kelas FROM class WHERE no=$klsa"));
                                                echo $q['kelas'];
                                                ?>
                                                    
                                                </td>

                                               <?php if($a['jenis_pembayaran']=='bebas'){

                                                $t=$a['period_id'];
                                                $s=$fill['student_id'];

                                                $e=mysqli_fetch_assoc(mysqli_query($conn,"SELECT bill FROM bebasan WHERE student_id='$s' AND jenis_id='$jenis_id' AND period_id='$t'"));
                                                echo '<td>'.$e['bill'].'';
                                                 } ?>                      


                                            <td >
                                                 <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>

                                                     <?php if($a['jenis_pembayaran']=='bulanan'){?>  

                                                     <a href="pos_setting_student?q=<?php echo $jenis_id;?>&kelas=<?php echo $fill['kelas_id'];?>&siswa=<?php echo $fill['student_id'];?>" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-edit"></i> </a>

                                                       <?php } else { ?>
                                                        <a href="pos_setting_bystudent?q=<?php echo $jenis_id;?>&kelas=<?php echo $fill['kelas_id'];?>&siswa=<?php echo $fill['student_id'];?>" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-edit"></i> </a>

                                                     <?php } } ?>

                                               
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
<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Kelulusan |<?php echo $app;?></title>
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

$halaman = "m_graduation"; // halaman
$dataapa = "Kelulusan"; // data
$tabeldatabase = "student"; // tabel database
$chmod = $chmenu4; // Hak akses Menu
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaturan</a></li>
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
$msg=$_GET['insert'];
if($msg=="true"){?>
 <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span> </button>
<strong>Berhasil!</strong>  Siswa/i telah diluluskan</div>
<?php } else if ($msg="batal"){?>
<div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span> </button>
<strong>Berhasil!</strong>  Siswa/i telah dibatalkan kelulusannya</div>

<?php } else if ($msg="graduate"){?>
<div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span> </button>
<strong>Berhasil!</strong>  Siswa/i telah dimasukan kedalam daftar Alumni</div>

<?php } ?>

<div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span> </button>
                                      <strong>Perhatian!</strong> Halaman ini digunakan untuk merubah status siswa menjadi lulus. Pastikan siswa yang di proses adalah siswa kelas akhir.</div>


                        	 <div class="row">
                            <div class="col-md-5 col-xs-12">
                                <div class="card-box">
                                    <h4 class="header-title">Daftar Siswa</h4>
                                    <div class="form-group">
    
                                       <form method="get">
                                        <div class="input-group">
                                           <span class="input-group-append">
                                                <button type="button" id="check-minutes" class="btn waves-effect waves-light btn-primary">Pilih Kelas</button>
                                            </span>
                                           
                                             <select class="form-control" id="single-input" name="pr" onchange="this.form.submit()">
                                              <option>Pilih</option>
      <?php
        $sql=mysqli_query($conn,"select * from class where status='active'");
        while ($row=mysqli_fetch_assoc($sql)){
          if ($_GET['pr']==$row['no'])
          echo "<option value='".$row['no']."' selected='selected'>".$row['kelas']."</option>";
          else
          echo "<option value='".$row['no']."'>".$row['kelas']."</option>";
        }
      ?>
                    </select>
                                           
                                        </div>

                                      </form>

                                        </div>

                                    <div class="table-responsive">
                                        
      <?php
              error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $kelas=$_GET['pr'];
                $sql    = "select * from student WHERE kelas_id='$kelas' AND status LIKE '%active%' order by student_id";
           
               $result = mysqli_query($conn, $sql);
               $rpp    = 15;
               $reload = "$halaman"."?pagination=true&pr=$kelas";
               $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

               if ($page <= 0)
               $page = 1;
               $tcount  = mysqli_num_rows($result);
               $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
               $count   = 0;
               $i       = ($page - 1) * $rpp;
               $no_urut = ($page - 1) * $rpp;
               ?>

                                         <table class="table table-bordered mb-0">
                                        <thead>
                                        <tr>
                                          <th style="width: 10px"><input type="checkbox" onchange="checkAll(this)" name="chk[]" ></th>
                                            <th style="width: 10px">No</th>
                                             <th style="width:10%">NIS</th>
                                            <th>Nama</th>
                                            
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
          <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $fill = mysqli_fetch_array($result);
               ?>    


               <form method="post">                                  
                                        <tr>
                                            <td><input type="checkbox" name="chkbox[]" value="<?php echo $fill['student_id'];?>" />
                                             <input type="hidden" name="kelas" value="<?php echo $kelas;?>">
                                           </td>

                                            <td><?php echo ++$no_urut;?></td>
                                             <td><?php  echo mysqli_real_escape_string($conn, $fill['nis']); ?></td>
                                            <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
                                           

                                        </tr>

                                        
                 <?php
               $i++;
               $count++;
               } ?>
                                        </tbody>
                                    </table>

  <div align="right"><?php if($tcount>=$rpp){ echo paginate_one($reload, $page, $tpages);}else{} ?></div>
                                    </div>


                                    <br>
                                   



                                </div>






                            </div>


                                <div class="col-md-2 col-xs-12">
                                <div class="card-box">
                                   
                                    
                                        
                                      
                                     <div class="row">
                                                                   
 <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>

                                     <button type="submit" name="lulus" class="btn btn-block btn-info waves-effect waves-light">Proses Lulus <i class="fas fa-arrow-right"></i></button>


                               <?php } ?>      


                                                                        
                                     
                                      </div>
                                 


                                   
                                    
                                                                   

                           
                                </div>
                                 </form>

                                <form method="post">

                                 <div class="card-box">
                                   
                                    
                                        
                                      
                                     <div class="row">
                                                                               
                                    
                                         <?php  if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>                                  

                                      <button type="submit" name="batal" class="btn btn-block btn-danger waves-effect waves-light"><i class="fas fa-arrow-left"></i> Batal Lulus  </button>


                                    <?php } ?>

                                      </div>
                                 


                                   
                                    
                                                                   

                           
                                </div>






                            </div>




                            <div class="col-md-5 col-xs-12">
                                <div class="card-box">
                                    <h4 class="header-title">Daftar Kelulusan Berdasar Kelas</h4>
                                    
                                    <div class="table-responsive">
                                        
      <?php
              error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $kelas=$_GET['pr'];
                $sql    = "select * from student WHERE kelas_id='$kelas' AND status LIKE '%lulus%' order by student_id";
           
               $result = mysqli_query($conn, $sql);
               $rpp    = 15;
               $reload = "$halaman"."?pagination=true&pr=$kelas";
               $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

               if ($page <= 0)
               $page = 1;
               $tcount  = mysqli_num_rows($result);
               $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
               $count   = 0;
               $i       = ($page - 1) * $rpp;
               $no_urut = ($page - 1) * $rpp;
               ?>

                                         <table class="table table-bordered mb-0">
                                        <thead>
                                        <tr>
                                          <th style="width: 10px"><input type="checkbox" onchange="checkIn(this)" name="chk2[]" ></th>
                                            <th style="width: 10px">No</th>
                                             <th style="width:10%">NIS</th>
                                            <th>Nama</th>
                                            
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
          <?php        while(($count<$rpp) && ($i<$tcount)) {
               mysqli_data_seek($result,$i);
               $fill = mysqli_fetch_array($result);
               ?>                                      

            
                                        <tr>
                                            <td><input type="checkbox" name="chkbox2[]" value="<?php echo $fill['student_id'];?>" />
                                                <input type="hidden" name="kelas" value="<?php echo $kelas;?>">
                                            </td>

                                            <td><?php echo ++$no_urut;?></td>
                                             <td><?php  echo mysqli_real_escape_string($conn, $fill['nis']); ?></td>
                                            <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
                                           

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


                                    <br>
                                    <form method="post" action="">
                                     <div class="row">
                                        <input type="hidden" name="kelas" value="<?php echo $kelas;?>">
                                       
                                     <button type="submit" name="convert" class="btn btn-block btn-success waves-effect waves-light">Proses Kelulusan</button>
                                      </div>
                                  </form>

                           
                                </div>






                            </div>




                                                        <







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

if(isset($_POST['lulus'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

    $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);

     foreach($_POST["chkbox"] as $value) 
                        {
                          $sql=mysqli_query($conn,"UPDATE student SET status='lulus' WHERE kelas_id=$kelas AND student_id='".$value."'");
                        }

 echo "<script type='text/javascript'>window.location = '$forwardpage?pr=$kelas&insert=true';</script>";


   } }




if(isset($_POST['batal'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

    $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);

     foreach($_POST["chkbox2"] as $value) 
                        {
                          $sql=mysqli_query($conn,"UPDATE student SET status='active' WHERE kelas_id=$kelas AND student_id='".$value."'");
                        }

 echo "<script type='text/javascript'>window.location = '$forwardpage?pr=$kelas&insert=batal';</script>";


   } }




if(isset($_POST['convert'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

    $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);

    $sq=mysqli_query($conn,"INSERT INTO student_alumni SELECT * FROM student WHERE kelas_id = '$kelas' AND status='lulus'");

    $sq1=mysqli_query($conn,"DELETE FROM student WHERE kelas_id = '$kelas' AND status='lulus'");

 echo "<script type='text/javascript'>window.location = '$forwardpage?pr=$kelas&insert=graduate';</script>";


   } }


    ?>


<!-- END Letak Kode PHP bawah -->




<script type="text/javascript">
  function checkAll(ele) {
       var checkboxes = document.getElementsByName("chk[]");
       if (ele.checked) {
            var daftarku = document.getElementsByName("chkbox[]");
    var jml=daftarku.length;
    var b=0;
    for (b=0;b<jml;b++)
    {
        daftarku[b].checked=true;
        
    }
       } else {
            var daftarku = document.getElementsByName("chkbox[]");
    var jml=daftarku.length;
    var b=0;
    for (b=0;b<jml;b++)
    {
        daftarku[b].checked=false;
        
    }
       }
   }
 </script>





<script type="text/javascript">
  function checkIn(ele) {
        var checkboxes = document.getElementsByName("chk2[]");
       if (ele.checked) {
             var daftarku = document.getElementsByName("chkbox2[]");
    var jml=daftarku.length;
    var b=0;
    for (b=0;b<jml;b++)
    {
        daftarku[b].checked=true;
        
    }
       } else {
            var daftarku = document.getElementsByName("chkbox2[]");
    var jml=daftarku.length;
    var b=0;
    for (b=0;b<jml;b++)
    {
        daftarku[b].checked=false;
        
    }
       }
   }
 </script>

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
<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Pembayaran Berdasar Kelas |<?php echo $app;?></title>
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

$halaman = "pos_setting_class"; // halaman
$dataapa = "Per Kelas"; // data
$tabeldatabase = "bulanan"; // tabel database
$chmod = $chmenu2; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman



$jenis_id=$_GET['q'];
$a=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM jenis_bayar WHERE jenis_id='$jenis_id'"));

$b=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM months"));

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
                                            <li class="breadcrumb-item"><a href="pos_setting?q=<?php echo $jenis_id;?>">Atur Pembayaran</a></li>
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

                            <div class="col-md-6">
                                    <div class="card-box">
                                        <h4 class="header-title mb-3">Pilih Kelas</h4>
    
                                        <form class="form-horizontal" >

                                             <div class="form-group row">
                                                <label for="inputPassword3" class="col-3 col-form-label">Jenis Pembayaran</label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="inputPassword3" value="<?php echo $a['nama']." - T.A ".$a['tahunajar'];?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label">Tahun Ajaran</label>
                                                <div class="col-9">
                                                    <input type="email" class="form-control" id="inputEmail3" value="<?php echo $a['tahunajar'];?>" readonly>
                                                </div>
                                            </div>
                                           
                                            <div class="form-group row">
                                                <label for="inputPassword4" class="col-3 col-form-label">Tipe Pembayaran</label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="inputPassword4" value="<?php echo $a['jenis_pembayaran'];?>" readonly>
                                                </div>
                                            </div>

                                             <div class="form-group row">
                                                <label for="inputPassword4" class="col-3 col-form-label">Kelas</label>
                                                <div class="col-9">
                                                      <select class="form-control" data-toggle="select2" name="kelas" id="class">
                                                        <option>--PILIH KELAS--</option>
    <?php
        $sql=mysqli_query($conn,"select * from class where status='active'");
        while ($row=mysqli_fetch_assoc($sql)){
          if ($a['kelas_id']==$row['no'])
          echo "<option value='".$row['no']."' data-no='".$row['no']."' selected='selected'>".$row['kelas']."</option>";
          else
          echo "<option value='".$row['no']."' data-no='".$row['no']."'>".$row['kelas']."</option>";
        }
      ?>
                    </select>
                                                </div>
                                            </div>
                                           
                                           
                                        </form>
                                    </div>



                                      <div class="card-box">
                                        <h4 class="header-title mb-3">Tarif Tiap Bulan Sama</h4>
    
                                       
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-3 col-form-label"><b>Tarif Bulanan (Rp)</b></label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="bulanan" placeholder="50000" onkeyup="sync();">
                                                </div>
                                            </div>
                                          
                                       
                                    </div>



                                                    <script>
                                                      function sync() {
                                                     var txtFirstNumberValue =  document.getElementById('bulanan').value
                                                     var result = parseFloat(txtFirstNumberValue);

                                                     if (!isNaN(result)) {
                                                        document.getElementById('bulan1').value = result;
                                                        document.getElementById('bulan2').value = result;
                                                        document.getElementById('bulan3').value = result;
                                                        document.getElementById('bulan4').value = result;
                                                        document.getElementById('bulan5').value = result;
                                                        document.getElementById('bulan6').value = result;
                                                        document.getElementById('bulan7').value = result;
                                                        document.getElementById('bulan8').value = result;
                                                        document.getElementById('bulan9').value = result;
                                                        document.getElementById('bulan10').value = result;
                                                        document.getElementById('bulan11').value = result;
                                                        document.getElementById('bulan12').value = result;
                                                     }
                                                  
                                               }
                                               </script>




                                </div>
 <div class="col-md-6">
                                    <div class="card-box">
                                        <h4 class="header-title mb-3">Tarif Tiap Bulan Berbeda</h4>
    
                                        <form class="form-horizontal" method="post" action="pos_act">

                                            <input type="hidden" name="kelas" id="kelas">
                                            <input type="hidden" name="jenis" value="<?php echo $jenis_id;?>">
                                            <input type="hidden" name="period" value="<?php echo $a['period_id'];?>">


                                            <?php 
                                            $sqla=mysqli_query($conn,"SELECT * FROM months ORDER BY month_id");
                                            while ($fill=mysqli_fetch_assoc($sqla)){
                                       echo   '<div class="form-group row">';
                                       echo     '    <label for="inputEmail3" class="col-3 col-form-label">'.$fill['month_name'].'</label>';
                                         echo    ' <div class="col-9">';
                                        echo  '<input type="text" class="form-control" id="bulan'.$fill['month_id'].'" name="bulan'.$fill['month_id'].'" placeholder="50000">';
                                        echo  '  </div>';
                                        echo   '</div>';
                                                                                    } ?>
                                            
                                            


                                          
                                            <div class="form-group mb-0 row">
                                                <div class="offset-3 col-9">
                                                    <button type="submit" name="setting" class="btn btn-success waves-effect waves-light">Simpan</button>
                                                     <a href="pos_setting?q=<?php echo $jenis_id;?>" class="btn btn-secondary waves-effect waves-light">Batal</a>
                                                </div>
                                            </div>
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
<?php

right();

?>

<!-- End Sidebar Kanan -->





<!-- Letak Kode PHP Bawah -->

<?php
if(isset($_POST['setting'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){

     $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);
          $period = mysqli_real_escape_string($conn, $_POST["period"]);
           $jenis = mysqli_real_escape_string($conn, $_POST["jenis"]);

           $user=$_SESSION['nama'];
           $now=date('Y-m-d');

        $query=mysqli_query($conn,"SELECT * FROM student WHERE kelas_id='$kelas'");
        while($row=mysqli_fetch_assoc($query)){
            $murid=$row['student_id'];

$i = 0;
while($i <= 11){
    $i++;
    $bulan=mysqli_real_escape_string($conn, $_POST["bulan$i"]);

    $cek=mysqli_query($conn,"SELECT * FROM bulanan WHERE period_id='$period' AND student_id='$murid' AND jenis_id='$jenis' AND month_id='$i'");

    if(mysqli_num_rows($cek)>0){

    $sql=mysqli_query($conn,"UPDATE bulanan SET bulanan_bill='$bulan', bulanan_status='belum',bulanan_bayar='0',kasir='$user',tgl_input='$now' WHERE period_id='$period' AND student_id='$murid' AND jenis_id='$jenis' AND month_id='$i' ");

    } else {

    $sql=mysqli_query($conn,"INSERT INTO bulanan VALUES('','$period','$murid','$jenis','$i','$bulan','belum','0','$user','$now')");

}
   
}

echo "<script type='text/javascript'>window.location = 'pos_setting?q=$jenis&insert=true';</script>";


}
   }  } ?>



<!-- END Letak Kode PHP bawah -->

 <script src="assets/jQuery/jquery-2.2.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>


<script type="text/javascript">
$(document).ready(function () {

    $("#class").change(function () {
  var cntrol = $(this);
  
  var kelas =cntrol.find(':selected').data('no');

  
  $("#kelas").val(kelas);
 
 });

});
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
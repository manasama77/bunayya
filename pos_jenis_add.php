<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Jenis Pembayaran |<?php echo $app;?></title>
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

$halaman = "pos_jenis_add"; // halaman
$dataapa = "Jenis Pembayaran"; // data
$tabeldatabase = "jenis_bayar"; // tabel database
$chmod = $chmenu2; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman
$hapus=$_GET['del'];

//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->

<?php 
if(isset($_GET['q'])){
  $no=$_GET['q'];
  $query="SELECT * FROM jenis_bayar WHERE jenis_id='$no'";
  $a=mysqli_fetch_assoc(mysqli_query($conn,$query));
} else {
  $no='X';
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
$msg = $_GET['insert'];

if ($msg == "false") {
?>
 <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>  </button>
<strong>Gagal Query!</strong> Terjadi kesalahan </div>
<?php } ?>




<?php
if(isset($_POST['simpan'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){


     $pesanError = array();
     
      if (trim($_POST['period'])=="") {
        $pesanError[] = "<b>Tahun Ajaran</b> harus dipilih !";    
      }
       if (trim($_POST['pos'])=="") {
        $pesanError[] = "<b>Pos Pembayaran</b> harus dipilih !";    
      }



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


          $nama = mysqli_real_escape_string($conn, $_POST["namapos"]);
          $pos = mysqli_real_escape_string($conn, $_POST["pos"]);
           $ta = mysqli_real_escape_string($conn, $_POST["period"]);
             $tahun = mysqli_real_escape_string($conn, $_POST["tahunajar"]);
             $tipe = mysqli_real_escape_string($conn, $_POST["tipe"]);
             $now=date('Y-m-d');
        
           $sqla="select * from jenis_bayar where jenis_id='$no'";
        $result=mysqli_query($conn,$sqla);


           if(mysqli_num_rows($result)>0){

            $sql="UPDATE jenis_bayar SET period_id='$ta',pos_bayar_id='$pos',nama='$nama', jenis_pembayaran='$tipe', tahunajar='$tahun', update_time='$now' WHERE jenis_id='$no'";

            if(mysqli_query($conn,$sql)){
                 echo "<script type='text/javascript'>window.location = 'pos_jenis?insert=update';</script>";
            } else {
                 echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
            }

           } else{
             

             $sql1="INSERT INTO jenis_bayar VALUES('','$ta','$pos','$tipe','$nama','$tahun','$now','$now')";

            if(mysqli_query($conn,$sql1)){
                 echo "<script type='text/javascript'>window.location = 'pos_jenis?insert=true';</script>";
            } else {
                 echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
            }


           }



}
       } } ?>



<?php if($hapus !='true'){ ?>

<form method="post">
   

  <div class="row">
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">JENIS PEMBAYARAN</h4>
                                   



                                    <div class="table-responsive">
                                       
<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Pilih POS Pembayaran*</label>
                                                                
                                                                  <select class="form-control" data-toggle="select2" name="pos" id="pos">
                                                                    <option value="">Pilih</option>
    <?php
        $sql=mysqli_query($conn,"select * from pos_bayar order by id desc");
        while ($row=mysqli_fetch_assoc($sql)){
          if ($a['pos_bayar_id']==$row['id'])
          echo "<option value='".$row['id']."' data-nama='".$row['nama']."' selected='selected'>".$row['nama']."</option>";
          else
          echo "<option value='".$row['id']."' data-nama='".$row['nama']."' >".$row['nama']."</option>";
        }
      ?>
                    </select>
                                                              
                                                            </div>

<input type="hidden" name="namapos" id="namapos" value="<?php echo $a['nama'];?>">

                                                        </div>
                                                   

                                                   
                                                   
                                                   
                                                        <div class="col-md-12">
                                                            <div class="form-group no-margin">
                                                                <label for="field-7" class="control-label">Tahun Ajaran*</label>
                                                                 <select class="form-control" data-toggle="select2" name="period" id="ta">
                                                                  <option value="">Pilih</option>
    <?php
        $sql=mysqli_query($conn,"select * from periode order by no desc");
        while ($row=mysqli_fetch_assoc($sql)){
          if ($a['period_id']==$row['no'])
          echo "<option value='".$row['no']."' data-tahun='".$row['period_name']."' selected='selected'>".$row['period_name']."</option>";
          else
          echo "<option value='".$row['no']."' data-tahun='".$row['period_name']."' >".$row['period_name']."</option>";
        }
      ?>
                    </select>
                                                            </div>
        <input type="hidden" name="tahunajar" id="tahunajar" value="<?php echo $a['tahunajar'];?>">                                                    
                                                        </div>



                                                         <div class="col-md-12">
                                                            <div class="form-group no-margin">
                                                                <label for="field-7" class="control-label">Tipe Bayar*</label>
                                                                 <select class="form-control" name="tipe">
                                                                  <option value="bulanan">BULANAN</option>
                                                                  <option value="bebas">BEBAS</option>
                                                                </select>
                                                            </div>
          <input type="hidden" name="jenis_id" id="jenis_id" value="<?php echo $no;?>">
                                                        </div>

                                                          <div class="col-md-12">
                                                            
                                                                <label for="field-7" class="control-label">* Wajib diisi</label>
                                                                 
                                                          
                                                        </div>
                                                   
                                        
                                    </div>
                                </div>

                            </div>


                             <div class="col-lg-3">
                                <div class="card-box">
                                    <h4 class="header-title">AKSI</h4>
                                    <br>

                                    <div class="table-responsive">
                                       
                                       <button type="submit" name="simpan" class="btn btn-success waves-effect waves-light btn-block">SIMPAN</button>
                                         <a href="pos_jenis" class="btn btn-warning waves-effect waves-light btn-block">BATAL</a>
                                      
                                                                                                          
                                        
                                    </div>
                                </div>

                            </div>

</div>
                                </form>
                     


<?php } else if($hapus=='true') { ?>

                          <div class="row">
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Hapus Data ini?</h4>

                                    <p >Penghapusan akan mengakibatkan:</p>
                                            <ol class="mb-0">
                                                <li>
                                                    Aaaaa
                                                </li>
                                                 <li>
                                                    Aaaaa
                                                </li>Bbbbb
                                               
                                               
                                            </ol>
                                            <br>
                                             <button type="submit" name="tambah" class="btn btn-danger waves-effect waves-light">HAPUS</button>
                                            <a href="pos_jenis" class="btn btn-secondary waves-effect" >Batal</a>
                                                   


                                </div>
                              </div>
                            </div>

<?php } ?>
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



 <script src="assets/jQuery/jquery-2.2.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>




<script type="text/javascript">
$(document).ready(function () {

    $("#pos").change(function () {
  var cntrol = $(this);
  
  var nama =cntrol.find(':selected').data('nama');

  
  $("#namapos").val(nama);
 
 });

});
</script>


<script type="text/javascript">
$(document).ready(function () {

    $("#ta").change(function () {
  var cntrol = $(this);
  
  var tahun =cntrol.find(':selected').data('tahun');

  
  $("#tahunajar").val(tahun);
 
 });

});
</script>


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
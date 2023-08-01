<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
  <meta charset="utf-8" />
  <title>Loading |<?php echo $app; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Aplikasi Kelola Sales dan Keuangan" name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico">
  <link href="assets/libs/spinkit/spinkit.css" rel="stylesheet" type="text/css">
  <?php
  connect();
  head();
  timing();
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

  $halaman = "kosong"; // halaman
  $dataapa = "Sedang Proses"; // data
  $tabeldatabase = "kosong"; // tabel database
  $chmod = $chmenu2; // Hak akses Menu
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
                  <li class="breadcrumb-item active"><?php echo $dataapa; ?></li>
                </ol>
              </div>
              <h4 class="page-title"><?php echo $dataapa; ?></h4>
            </div>
          </div>
        </div>
        <!-- end halaman dan breadcrumbs -->


        <!-- ISI HALAMAN -->


        <div class="row">
          <div class="col-12">


            <div class="table-responsive">

              <table width="100%" align="center" cellspacing="0">
                <tr>
                  <td height="500px" align="center" align="middle">

                    <div class="sk-wave">
                      <div class="sk-rect sk-rect1"></div>
                      <div class="sk-rect sk-rect2"></div>
                      <div class="sk-rect sk-rect3"></div>
                      <div class="sk-rect sk-rect4"></div>
                      <div class="sk-rect sk-rect5"></div>

                    </div>

                    <div>
                      <b>Sedang Proses, Jangan tutup halaman ini</b>
                    </div>
                  </td>
                </tr>


              </table>


            </div>

          </div>
        </div>



        <!-- END ISI HALAMAN -->



      </div> <!-- end container-fluid -->

    </div> <!-- end content -->
    <!--FOOTER-->

    <?php footer(); ?>

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
  ini_set('max_execution_time', '300'); //300 seconds = 5 minutes

  if (isset($_POST['setting'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      echo "adam 2";
      exit;

      $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);
      $period = mysqli_real_escape_string($conn, $_POST["period"]);
      $jenis = mysqli_real_escape_string($conn, $_POST["jenis"]);

      $user = $_SESSION['nama'];
      $now = date('Y-m-d');

      $sqlnya = "SELECT * FROM student WHERE kelas_id='$kelas'";
      $query = mysqli_query($conn, $sqlnya);

      $query_biaya_admin = mysqli_query($conn, "SELECT biaya FROM biaya_admin WHERE id = 1");
      $row_biaya_admin   = mysqli_fetch_assoc($query_biaya_admin);
      while ($row = mysqli_fetch_assoc($query)) {
        $murid = $row['student_id'];

        $i = 0;
        while ($i <= 11) {
          $i++;
          $bulan = mysqli_real_escape_string($conn, $_POST["bulan$i"]);

          $sqlnya = "SELECT * FROM bulanan WHERE period_id='$period' AND student_id='$murid' AND jenis_id='$jenis' AND month_id='$i'";
          $cek = mysqli_query($conn, $sqlnya);

          if (mysqli_num_rows($cek) > 0) {
            $sqlnya = "UPDATE bulanan SET biaya_admin = '" . $row_biaya_admin['biaya'] . "', bulanan_bill='$bulan', bulanan_status='belum',bulanan_bayar='0',kasir='$user',tgl_input='$now' WHERE period_id='$period' AND student_id='$murid' AND jenis_id='$jenis' AND month_id='$i'";

            $sql = mysqli_query($conn, $sqlnya);
          } else {
            $sqlnya = "INSERT INTO bulanan VALUES('', '$period', '$murid', '$jenis', '$i', '$bulan', 'belum', '0', '" . $row_biaya_admin['biaya'] . "', '$user', '$now')";
            $sql = mysqli_query($conn, $sqlnya);
          }
        }

        echo "<script type='text/javascript'>window.location = 'pos_setting?q=$jenis&insert=true';</script>";
      }
    }
  } ?>



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
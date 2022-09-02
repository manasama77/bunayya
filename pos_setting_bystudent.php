<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
  <meta charset="utf-8" />
  <title>Pembayaran Berdasar Siswa |<?php echo $app; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Aplikasi Kelola Sales dan Keuangan" name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico">
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

  $halaman = "pos_setting_bystudent"; // halaman
  $dataapa = "Per Kelas"; // data
  $tabeldatabase = "bebasan"; // tabel database
  $chmod = $chmenu2; // Hak akses Menu
  $forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
  $forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman



  $jenis_id = $_GET['q'];
  $a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE jenis_id='$jenis_id'"));

  if (isset($_GET['siswa']) && $_GET['siswa'] != '') {
    $s = $_GET['siswa'];
    $b = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bebasan WHERE jenis_id='$jenis_id' AND student_id='$s'"));
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
                  <li class="breadcrumb-item"><a href="pos_setting?q=<?php echo $jenis_id; ?>">Atur Pembayaran</a></li>
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

          <div class="col-md-6">
            <div class="card-box">
              <h4 class="header-title mb-3">Pilih Kelas</h4>

              <form class="form-horizontal">

                <div class="form-group row">
                  <label for="inputPassword3" class="col-3 col-form-label">Jenis Pembayaran</label>
                  <div class="col-9">
                    <input type="text" class="form-control" id="inputPassword3" value="<?php echo $a['nama'] . " - T.A " . $a['tahunajar']; ?>" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-3 col-form-label">Tahun Ajaran</label>
                  <div class="col-9">
                    <input type="email" class="form-control" id="inputEmail3" value="<?php echo $a['tahunajar']; ?>" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword4" class="col-3 col-form-label">Tipe Pembayaran</label>
                  <div class="col-9">
                    <input type="text" class="form-control" id="inputPassword4" value="<?php echo $a['jenis_pembayaran']; ?>" readonly>
                  </div>
                </div>

                <form method="get">

                  <div class="form-group row">
                    <label for="inputPassword4" class="col-3 col-form-label">Kelas</label>
                    <div class="col-9">
                      <select class="form-control" data-toggle="select2" name="kelas" id="class" onchange="this.form.submit()">
                        <option>--PILIH KELAS--</option>
                        <?php
                        $sql = mysqli_query($conn, "select * from class where status='active'");
                        while ($row = mysqli_fetch_assoc($sql)) {
                          if ($_GET['kelas'] == $row['no'])
                            echo "<option value='" . $row['no'] . "' selected='selected'>" . $row['kelas'] . "</option>";
                          else
                            echo "<option value='" . $row['no'] . "' >" . $row['kelas'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <input type="hidden" name="q" value="<?php echo $jenis_id; ?>">


                </form>
                <form method="get">

                  <input type="hidden" name="q" value="<?php echo $jenis_id; ?>">
                  <input type="hidden" name="kelas" value="<?php echo $_GET['kelas']; ?>">


                  <div class="form-group row">
                    <label for="inputPassword4" class="col-3 col-form-label">Siswa</label>
                    <div class="col-9">
                      <select class="form-control" data-toggle="select2" name="siswa" id="siswa" onchange="this.form.submit()">
                        <option>--PILIH SISWA--</option>
                        <?php
                        $kls = $_GET['kelas'];
                        $sql = mysqli_query($conn, "select * from student where kelas_id='$kls'");
                        while ($row = mysqli_fetch_assoc($sql)) {
                          if ($_GET['siswa'] == $row['student_id'])
                            echo "<option value='" . $row['student_id'] . "' data-no='" . $row['student_id'] . "' selected='selected'>" . $row['nama'] . "</option>";
                          else
                            echo "<option value='" . $row['student_id'] . "' data-no='" . $row['student_id'] . "'>" . $row['nama'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>


                </form>
            </div>

            <form method="post">

              <div class="card-box">
                <h4 class="header-title mb-3">Tarif Bebas</h4>

                <?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-3 col-form-label"><b>Tarif Pembayaran (Rp)</b></label>
                  <div class="col-9">
                    <input type="text" class="form-control" name="bebasan" placeholder="150000" value="<?php echo $b['bill']; ?>">

                    <input type="hidden" value="<?php echo $jenis_id; ?>" name="jenis">
                    <input type="hidden" value="<?php echo $s; ?>" name="student">
                    <input type="hidden" value="<?php echo $a['period_id']; ?>" name="period">

                  </div>
                </div>

                <div class="form-group mb-0 row">
                  <div class="offset-3 col-9">
                    <button type="submit" name="setting" class="btn btn-success waves-effect waves-light">Simpan</button>
                    <a href="pos_setting?q=<?php echo $jenis_id; ?>" class="btn btn-secondary waves-effect waves-light">Batal</a>
                  </div>
                </div>


              </div>
            </form>







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
  if (isset($_POST['setting'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $murid = mysqli_real_escape_string($conn, $_POST["student"]);
      $period = mysqli_real_escape_string($conn, $_POST["period"]);
      $jenis = mysqli_real_escape_string($conn, $_POST["jenis"]);
      $bebas = mysqli_real_escape_string($conn, $_POST["bebasan"]);
      $usr = $_SESSION['nama'];
      $now = date('Y-m-d');

      $sql = mysqli_query($conn, "SELECT * FROM bebasan WHERE student_id='$murid' AND jenis_id='$jenis' AND period_id='$period'");
      $sql_biaya_admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biaya_admin WHERE id = 1"));

      if (mysqli_num_rows($sql) > 0) {

        $sql1 = "UPDATE bebasan SET biaya_admin = " . $sql_biaya_admin['biaya'] . ", bill='$bebas',status='belum',sudahbayar='0',kasir='$usr',tgl_input='$now' WHERE student_id='$murid' AND jenis_id='$jenis' AND period_id='$period'";

        if (mysqli_query($conn, $sql1)) {
          echo "<script type='text/javascript'>window.location = 'pos_setting?q=$jenis&insert=true';</script>";
        } else {
          echo "<script type='text/javascript'>window.location = 'pos_setting?q=$jenis&insert=false';</script>";
        }
      } else {

        $sql2 = "INSERT INTO bebasan VALUES('','$period','$murid','$jenis','$bebas', " . $sql_biaya_admin['biaya'] . ", 'belum','0','$usr','$now')";


        if (mysqli_query($conn, $sql2)) {
          echo "<script type='text/javascript'>window.location = 'pos_setting?q=$jenis&insert=true';</script>";
        } else {
          echo "<script type='text/javascript'>window.location = 'pos_setting?q=$jenis&insert=false';</script>";
        }
      }
    }
  } ?>



  <!-- END Letak Kode PHP bawah -->

  <script src="assets/jQuery/jquery-2.2.3.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>


  <script type="text/javascript">
    $(document).ready(function() {

      $("#siswa").change(function() {
        var cntrol = $(this);

        var stu = cntrol.find(':selected').data('no');


        $("#student").val(stu);

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
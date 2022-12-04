<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
  <meta charset="utf-8" />
  <title>Siswa |<?php echo $app; ?></title>
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

  $halaman = "m_student"; // halaman
  $dataapa = ($_GET['id']) ? "Edit Siswa" : "Tambah Siswa"; // data
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
  <?php
  if (isset($_GET['id'])) {
    $no = $_GET['id'];
    $query = "SELECT * FROM student WHERE student_id='$no'";
    $a = mysqli_fetch_assoc(mysqli_query($conn, $query));
  }

  $trimmed = "image/placeholder.png";

  if (isset($a['avatar'])) {
    if ($a['avatar'] != '') {
      $subject = $a['avatar'];
      $search = 'student/';
      $trimmed = str_replace($search, '', $subject);
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
                  <li class="breadcrumb-item"><a href="index">DashBoard</a></li>
                  <li class="breadcrumb-item"><a href="m_student">Siswa</a></li>
                  <li class="breadcrumb-item active"><?php echo $dataapa; ?></li>
                </ol>
              </div>
              <h4 class="page-title"><?php echo $dataapa; ?></h4>
            </div>
          </div>
        </div>
        <!-- end halaman dan breadcrumbs -->



        <script>
          window.setTimeout(function() {
            $("#myAlert").fadeTo(200, 0).slideUp(400, function() {
              $(this).remove();
            });
          }, 2000);
        </script>
        <?php
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $msg = $_GET['insert'];
        if ($msg == "exist") { ?>
          <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span> </button>
            <strong>Gagal!</strong> Data Siswa dengan NIS yang sama sudah ada! Gunakan NIS yang berbeda
          </div>
        <?php } else if ($msg == "error") { ?>
          <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span> </button>
            <strong>GAGAL UPDATE!</strong> id hilang, silahkan kembali ke halaman utama dan coba lagi
          </div>
        <?php } ?>





        <?php

        if (isset($_POST['simpan'])) {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $pesanError = array();
            if (trim($_POST['nis']) == "") {
              $pesanError[] = "<b>N.I.S</b> tidak boleh kosong !";
            }

            if (trim($_POST['nisn']) == "") {
              $pesanError[] = "<b>NISN</b> tidak boleh kosong !";
            }

            if (strlen($_POST['kelas']) == "") {
              $pesanError[] = "<b>KELAS</b> harus dipilih !";
            }

            if (strlen($_POST['ibu']) == "") {
              $pesanError[] = "<b>Data Ibu</b> harus diisi !";
            }

            if (trim($_POST['ayah']) == "") {
              $pesanError[] = "<b>Ayah/Wali</b> harus diisi !";
            }

            if (trim($_POST['waortu']) == "") {
              $pesanError[] = "<b>No.Handphone</b> Orang Tua/Wali harus diisi !";
            }



            $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
            $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
            $tempat = mysqli_real_escape_string($conn, $_POST["tempat"]);
            $nohp = mysqli_real_escape_string($conn, $_POST["nohp"]);
            $hobi = mysqli_real_escape_string($conn, $_POST["hobi"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $alamat = mysqli_real_escape_string($conn, $_POST["alamat"]);
            $tgllahir = mysqli_real_escape_string($conn, $_POST["tgllahir"]);


            $nis = mysqli_real_escape_string($conn, $_POST["nis"]);
            $nisn = mysqli_real_escape_string($conn, $_POST["nisn"]);
            $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);


            $ibu = mysqli_real_escape_string($conn, $_POST["ibu"]);
            $ayah = mysqli_real_escape_string($conn, $_POST["ayah"]);
            $wa = mysqli_real_escape_string($conn, $_POST["waortu"]);

            $status = mysqli_real_escape_string($conn, $_POST["status"]);
            $cat = mysqli_real_escape_string($conn, $_POST["catatan"]);

            $now = date('Y-m-d');
            $password = "123456";
            $pass = sha1(md5($password));


            $namaavatar = $_FILES['avatar']['name'];
            $ukuranavatar = $_FILES['avatar']['size'];
            $tipeavatar = $_FILES['avatar']['type'];
            $tmp = $_FILES['avatar']['tmp_name'];
            $avatar = "student/image/" . $namaavatar;



            if (count($pesanError) >= 1) {
              echo "<div class='alert alert-danger alert-dismissable'>";
              echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
              $noPesan = 0;
              foreach ($pesanError as $indeks => $pesan_tampil) {
                $noPesan++;
                echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
              }
              echo "</div>";
            } else {



              $sql = "select * from student where nis ='$nis'";
              $result = mysqli_num_rows(mysqli_query($conn, $sql));

              if ($result > 0) {

                echo "<script type='text/javascript'>window.location = 'm_student_add?insert=exist';</script>";
              } else {



                if ((($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000)) && ($chmod >= 2 || $_SESSION['jabatan'] == 'admin')) {
                  move_uploaded_file($tmp, $avatar);
                  $sql2 = "insert into student values('','$nis','$nisn','$pass','$nama','$gender','$tempat','$tgllahir','$avatar','$nohp','$hobi','$alamat','$ibu','$ayah','
  $wa','$kelas','1','$cat','$status','$now','$now', '$email')";

                  if (mysqli_query($conn, $sql2)) {
                    echo "<script type='text/javascript'>window.location = 'm_student?insert=true';</script>";
                  } else {
                    echo "<script type='text/javascript'>window.location = 'm_student?insert=false';</script>";
                  }
                } else {
                  $avatar = "upload/image/placeholder150x150.png";
                  $sql2 = "insert into student values('','$nis','$nisn','$pass','$nama','$gender','$tempat','$tgllahir','$avatar','$nohp','$hobi','$alamat','$ibu','$ayah','
  $wa','$kelas','1','$cat','$status','$now','$now', '$email')";

                  if (mysqli_query($conn, $sql2)) {
                    echo "<script type='text/javascript'>window.location = 'm_student?insert=true';</script>";
                  } else {
                    echo "<script type='text/javascript'>window.location = 'm_student?insert=false';</script>";
                  }
                }
              }
            }
          }
        }

        ?>






        <?php

        if (isset($_POST['update'])) {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $pesanError = array();
            if (trim($_POST['nis']) == "") {
              $pesanError[] = "<b>N.I.S</b> tidak boleh kosong !";
            }

            if (trim($_POST['nisn']) == "") {
              $pesanError[] = "<b>NISN</b> tidak boleh kosong !";
            }

            if (strlen($_POST['kelas']) == "") {
              $pesanError[] = "<b>KELAS</b> harus dipilih !";
            }

            if (strlen($_POST['ibu']) <= 2) {
              $pesanError[] = "<b>Data Ibu</b> harus diisi !";
            }

            if (trim($_POST['ayah']) == "") {
              $pesanError[] = "<b>Ayah/Wali</b> harus diisi !";
            }

            if (trim($_POST['waortu']) == "") {
              $pesanError[] = "<b>No.Handphone</b> Orang Tua/Wali harus diisi !";
            }



            $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
            $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
            $tempat = mysqli_real_escape_string($conn, $_POST["tempat"]);
            $nohp = mysqli_real_escape_string($conn, $_POST["nohp"]);
            $hobi = mysqli_real_escape_string($conn, $_POST["hobi"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $alamat = mysqli_real_escape_string($conn, $_POST["alamat"]);
            $tgllahir = mysqli_real_escape_string($conn, $_POST["tgllahir"]);


            $nis = mysqli_real_escape_string($conn, $_POST["nis"]);
            $nisn = mysqli_real_escape_string($conn, $_POST["nisn"]);
            $kelas = mysqli_real_escape_string($conn, $_POST["kelas"]);


            $ibu = mysqli_real_escape_string($conn, $_POST["ibu"]);
            $ayah = mysqli_real_escape_string($conn, $_POST["ayah"]);
            $wa = mysqli_real_escape_string($conn, $_POST["waortu"]);

            $status = mysqli_real_escape_string($conn, $_POST["status"]);
            $cat = mysqli_real_escape_string($conn, $_POST["catatan"]);

            $now = date('Y-m-d');
            $id = mysqli_real_escape_string($conn, $_POST["id"]);



            $namaavatar = $_FILES['avatar']['name'];
            $ukuranavatar = $_FILES['avatar']['size'];
            $tipeavatar = $_FILES['avatar']['type'];
            $tmp = $_FILES['avatar']['tmp_name'];
            $avatar = "student/image/" . $namaavatar;



            if (count($pesanError) >= 1) {
              echo "<div class='alert alert-danger alert-dismissable'>";
              echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
              $noPesan = 0;
              foreach ($pesanError as $indeks => $pesan_tampil) {
                $noPesan++;
                echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
              }
              echo "</div>";
            } else {




              if ($id == '' || $id == null) {

                echo "<script type='text/javascript'>window.location = 'm_student_add?insert=error';</script>";
              } else {



                if ((($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000)) && ($chmod >= 2 || $_SESSION['jabatan'] == 'admin')) {
                  move_uploaded_file($tmp, $avatar);

                  $sql2 = "UPDATE student SET nis='$nis',nisn='$nisn',nama='$nama',gender='$gender',birth_place='$tempat',birth_date='$tgllahir',avatar='$avatar',nohp='$nohp',hobi='$hobi',alamat='$alamat',ibu='$ibu',ayahwali='$ayah',waortu='$wa',kelas_id='$kelas',catatan='$cat',status='$status',last_update='$now', email = '$email' WHERE student_id='$id' ";

                  if (mysqli_query($conn, $sql2)) {
                    echo "<script type='text/javascript'>window.location = 'm_student?insert=update';</script>";
                  } else {
                    echo "<script type='text/javascript'>window.location = 'm_student_add?insert=false';</script>";
                  }
                } else {

                  $sql2 = "UPDATE student SET nis='$nis',nisn='$nisn',nama='$nama',gender='$gender',birth_place='$tempat',birth_date='$tgllahir',nohp='$nohp',hobi='$hobi',alamat='$alamat',ibu='$ibu',ayahwali='$ayah',waortu='$wa',kelas_id='$kelas',catatan='$cat',status='$status',last_update='$now', email = '$email' WHERE student_id='$id' ";

                  if (mysqli_query($conn, $sql2)) {
                    echo "<script type='text/javascript'>window.location = 'm_student?insert=update';</script>";
                  } else {
                    echo "<script type='text/javascript'>window.location = 'm_student_add?insert=false';</script>";
                  }
                }
              }
            }
          }
        }

        ?>


        <!-- ISI HALAMAN -->



        <form class="form-horizontal" method="post" enctype="multipart/form-data">


          <div class="row">
            <div class="col-lg-9 col-xs-12">
              <div class="card-box">
                <h4 class="header-title mb-4">Sunting Siswa</h4>

                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link active">
                      <span class="d-block d-sm-none"><i class="mdi mdi mdi-account "></i></span>
                      <span class="d-none d-sm-block">Data Pribadi</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link">
                      <span class="d-block d-sm-none"><i class="mdi mdi mdi-school"></i></span>
                      <span class="d-none d-sm-block">Data Sekolah</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#messages" data-toggle="tab" aria-expanded="false" class="nav-link">
                      <span class="d-block d-sm-none"><i class="mdi mdi-home-group"></i></span>
                      <span class="d-none d-sm-block">Data Keluarga</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                      <span class="d-block d-sm-none"><i class="mdi mdi-settings"></i></span>
                      <span class="d-none d-sm-block">Keterangan</span>
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane show active" id="home">

                    <div class="form-group">
                      <label for="pass1">Nama<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $a['nama']; ?>" placeholder="Nama Lengkap" required autocomplete="off">
                    </div>

                    <?php if (($no != '' || $no != null) && ($a['gender'] == 'Perempuan')) {

                      $cek = '';
                      $ceka = 'checked';
                    } else {
                      $cek = 'checked';
                      $ceka = '';
                    } ?>

                    <div class="radio radio-info form-check-inline">
                      <input type="radio" id="gender1" value="Laki Laki" name="gender" <?php echo $cek; ?>>
                      <label for="inlineRadio1"> Laki Laki </label>
                    </div>
                    <div class="radio radio-info form-check-inline">
                      <input type="radio" id="gender2" value="Perempuan" name="gender" <?php echo $ceka; ?>>
                      <label for="inlineRadio2"> Perempuan </label>
                    </div>


                    <div class="form-group">
                      <label for="pass1">Tempat Lahir<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="tempat" name="tempat" value="<?php echo $a['birth_place']; ?>" placeholder="Nama Kota" required>
                    </div>

                    <div class="form-group">
                      <label for="pass1">Tanggal Lahir<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="datepicker" name="tgllahir" value="<?php echo $a['birth_date']; ?>" required autocomplete="off">
                    </div>

                    <div class="form-group">
                      <label for="pass1">Hobbi<span class="text-danger"></span></label>
                      <input type="text" class="form-control" id="hobi" name="hobi" placeholder="Membaca, menulis ..." value="<?php echo $a['hobi']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="pass1">No.Hand Phone / Whatsapp<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="hp" name="nohp" placeholder="628...." required autocomplete="off" value="<?php echo $a['nohp']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="email">Email<span class="text-danger">*</span></label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autocomplete="off" value="<?php echo $a['email']; ?>">
                    </div>

                    <div class="form-group">
                      <label>Alamat Lengkap</label>
                      <div>
                        <textarea required class="form-control" name="alamat"><?php echo $a['alamat']; ?></textarea>
                      </div>
                    </div>




                  </div>
                  <div class="tab-pane " id="profile">
                    <div class="form-group">
                      <label for="pass1">Nomor Induk Siswa (N.I.S)<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="nis" name="nis" placeholder="Wajib diisi" autocomplete="off" value="<?php echo $a['nis']; ?>">
                    </div>


                    <div class="form-group">
                      <label for="pass1">NISN<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="nisn" name="nisn" placeholder="isikan 0 Jika belum ada" autocomplete="off" value="<?php echo $a['nisn']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="pass1">Pilih KELAS<span class="text-danger">*</span></label>
                      <select class="form-control" data-toggle="select2" name="kelas">
                        <?php
                        $sql = mysqli_query($conn, "select * from class where status='active'");
                        while ($row = mysqli_fetch_assoc($sql)) {
                          if ($a['kelas_id'] == $row['no'])
                            echo "<option value='" . $row['no'] . "' selected='selected'>" . $row['kelas'] . "</option>";
                          else
                            echo "<option value='" . $row['no'] . "'>" . $row['kelas'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>


                  </div>




                  <div class="tab-pane" id="messages">
                    <div class="form-group">
                      <label for="ibu">Nama Ibu<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="ibu" name="ibu" placeholder="Ibu Kandung" autocomplete="off" value="<?php echo $a['ibu']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="ayah">Nama Ayah<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="ayah" name="ayah" placeholder="Ayah Kandung atau Wali" autocomplete="off" value="<?php echo $a['ayahwali']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="waortu">No.HandPhone/Whatsap Orang Tua/Wali<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="waortu" name="waortu" placeholder="+628.." autocomplete="off" value="<?php echo $a['waortu']; ?>">
                    </div>

                  </div>




                  <div class="tab-pane" id="settings">



                    <div class="form-group">
                      <label>Catatan Mengenai Siswa</label>
                      <div>
                        <textarea class="form-control" name="catatan"> <?php echo $a['catatan']; ?></textarea>
                      </div>
                    </div>

                    <?php if (($no != '' || $no != null) && ($a['status'] == 'inactive')) {

                      $cek1 = '';
                      $cek2 = 'checked';
                    } else {
                      $cek1 = 'checked';
                      $cek2 = '';
                    } ?>

                    <p class="sub-header mt-4">Status Siswa</p>
                    <div class="radio radio-info form-check-inline">
                      <input type="radio" id="inlineRadio1" value="active" name="status" <?php echo $cek1; ?>>
                      <label for="inlineRadio1"> Aktif </label>
                    </div>
                    <div class="radio form-check-inline">
                      <input type="radio" id="inlineRadio2" value="inactive" name="status" <?php echo $cek2; ?>>
                      <label for="inlineRadio2"> Tidak Aktif </label>
                    </div>


                  </div>
                </div>



              </div>
            </div>






            <div class="col-lg-3 col-xs-12">
              <div class="card-box">
                <h4 class="header-title">Foto</h4>



                <div class="col-12">
                  <img id="blah" src="student/<?php echo $trimmed; ?>" alt="image" class="img-fluid rounded" width="200" />

                </div>

                <div class="form-group col-12">
                  <label for="inputZip" class="col-form-label">Upload Foto </label>
                  <input type="file" class="form-control" name="avatar" onchange="readURL(this);">
                </div>

                <br>
                <input type="hidden" value="<?php echo $no; ?>" name="id">
                <div class="col-12">

                  <?php if ($no != '' || $no != null) { ?>
                    <button type="submit" name="update" class="btn btn-block btn-info waves-effect width-md waves-light">UPDATE</button>

                  <?php } else { ?>
                    <button type="submit" name="simpan" class="btn btn-block btn-success waves-effect width-md waves-light">SIMPAN</button>
                  <?php } ?>

                  <a href="m_student" class="btn btn-block btn-danger waves-effect width-md waves-light">BATAL</a>

                </div>

              </div>



              <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span> </button>
                Setelah Data Siswa disimpan, maka siswa tersebut bisa login ke Aplikasi untuk pertama kalinya memakai NIS dan password standar 123456
              </div>



            </div>



        </form>











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




  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>



  <!-- END Lib & Plugins-->






  </body>

</html>
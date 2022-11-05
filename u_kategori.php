<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Kategori Keuangan | <?php echo $app; ?></title>
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

    $halaman = "u_kategori"; // halaman
    $dataapa = "Kategori POS Keuangan"; // data
    $tabeldatabase = "uang_kategori"; // tabel database
    $chmod = $chmenu3; // Hak akses Menu
    $forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
    $forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


    //End Setting Halaman

    ?>

    <?php

    menu();

    ?>




    <!-- Letak Kode PHP atas -->

    <?php

    if (isset($_GET['no'])) {
        $no = mysqli_real_escape_string($conn, $_GET["no"]);
        $a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM uang_kategori WHERE kategori_id='$no'"));
    }  ?>

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
                                    <li class="breadcrumb-item"><a href="pay_add">Pembayaran</a></li>
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
                        <strong>Gagal!</strong> Sudah ada Kategori dengan nama yang sama
                    </div>
                <?php } else if ($msg == "false") { ?>
                    <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>GAGAL!</strong> Terjadi kesalahan, Hubungi Admin jika perlu
                    </div>
                <?php } else if ($msg == "true") { ?>
                    <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>Berhasil!</strong> Data telah disimpan
                    </div>
                <?php } else if ($msg == "update") { ?>
                    <div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>Berhasil!</strong> Data telah diupdate
                    </div>
                <?php } ?>

                <!-- ISI HALAMAN -->
                <?php if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                    <form method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card-box">
                                    <h4 class="header-title">Tambah</h4>

                                    <div class="table-responsive">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama Kategori</label>
                                            <input type="text" class="form-control" name="nama" value="<?php echo $a['nama']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Jenis</label>
                                            <select class="form-control" name="jenis">
                                                <option value="out">Pengeluaran</option>
                                                <option value="in">Pemasukan</option>
                                            </select>

                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <input type="text" class="form-control" name="ket" value="<?php echo $a['keterangan']; ?>">
                                            <input type="hidden" class="form-control" name="no" value="<?php echo $no; ?>">
                                        </div>

                                        <button type="submit" name="simpan" class="btn btn-block btn-success waves-effect width-md waves-light">SIMPAN</button>


                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                        <div class="col-lg-8">
                            <div class="card-box">
                                <h4 class="header-title">Kategori POS Keuangan</h4>

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Masuk/Keluar</th>
                                                <th style="width:50%">Keterangan</th>
                                                <th style="width:15%">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nom = 0;
                                            $sqla = mysqli_query($conn, "SELECT * FROM uang_kategori order by kategori_id desc");
                                            while ($row = mysqli_fetch_assoc($sqla)) {

                                                echo '<tr>
                                                    <td>' . ++$nom . '</td>
                                                    <td>' . $row['nama'] . '</td>';
                                                if ($row['jenis'] == 'out') {;
                                                    echo   ' <td>Pengeluaran</td>';
                                                }
                                                if ($row['jenis'] == 'in') {
                                                    echo       '<td>Pemasukan</td>';
                                                }
                                                echo    ' <td>' . $row['keterangan'] . '</td>';
                                            ?>
                                                <td>

                                                    <?php if (($chmod >= 4 || $_SESSION['jabatan'] == 'admin')) { ?>

                                                        <?php
                                                        if (!in_array($row['kategori_id'], [1, 2, 9998, 9999])) {
                                                        ?>
                                                            <a class="demo-delete-row btn btn-success btn-sm btn-icon" href="u_kategori?no=<?php echo $row['kategori_id']; ?>"><i class="fa fa-edit"></i></a>

                                                            <button class="demo-delete-row btn btn-danger btn-sm btn-icon" onclick="window.location.href='component/delete/delete_kategori?no=<?php echo $row['kategori_id'] . '&'; ?>forward=<?php echo "uang_kategori" . '&'; ?>forwardpage=<?php echo $halaman . '&'; ?>chmod=<?php echo $chmod; ?>'"><i class="fa fa-times"></i></button>
                                                        <?php } ?>
                                                </td>

                                                <tr>

                                                <?php } ?>

                                            <?php           }
                                            ?>
                                            </td>

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>




                        </div>
                    </form>

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

    if (isset($_POST['simpan'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
            $j = mysqli_real_escape_string($conn, $_POST["jenis"]);
            $k = mysqli_real_escape_string($conn, $_POST["ket"]);
            $no = mysqli_real_escape_string($conn, $_POST["no"]);

            if ($no != '') {
                $sql1 = "UPDATE uang_kategori SET nama='$nama',jenis='$j',keterangan='$k' WHERE kategori_id='$no'";

                if (mysqli_query($conn, $sql1)) {
                    echo "<script type='text/javascript'>window.location = '$forwardpage?insert=update';</script>";
                } else {
                    echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
                }
            } else {

                $sql2 = mysqli_query($conn, "SELECT * FROM uang_kategori WHERE nama='$nama'");

                if (mysqli_num_rows($sql2) > 0) {
                    echo "<script type='text/javascript'>window.location = '$forwardpage?insert=exist';</script>";
                } else {
                    $sql3 = "INSERT INTO uang_kategori VALUES('','$nama','$j','$k')";

                    if (mysqli_query($conn, $sql3)) {
                        echo "<script type='text/javascript'>window.location = '$forwardpage?insert=true';</script>";
                    } else {
                        echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
                    }
                }
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
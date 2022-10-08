<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Penerimaan | <?php echo $app; ?></title>
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

    $halaman = "u_income"; // halaman
    $dataapa = "Penerimaan"; // data
    $tabeldatabase = "uang_masuk_keluar"; // tabel database
    $chmod = $chmenu3; // Hak akses Menu
    $forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
    $forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman
    $today = date('Y-m-d');

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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Jurnal Umum</a></li>
                                    <li class="breadcrumb-item active"><?php echo $dataapa; ?></li>
                                </ol>
                            </div>
                            <h4 class="page-title"><?php echo $dataapa; ?></h4>
                        </div>
                    </div>
                </div>
                <!-- end halaman dan breadcrumbs -->


                <!-- ISI HALAMAN -->
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



                <div class="row">
                    <div class="col-2">
                        <?php if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                            <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#pemasukan">Tambah Penerimaan</button>
                        <?php } ?>



                    </div>

                    <div class="col-2">



                    </div>




                </div>
                <br>


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-8 col-xs-8">
                                    <h4 class="header-title">Daftar Penerimaan</h4>
                                </div>


                                <div class="col-lg-4 col-xs-4">

                                    <div class="form-group row">

                                        <form method=get>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Cari" name="q">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark waves-effect waves-light" type="button"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                </div>

                            </div>

                            <!-- <div id="error_msg"><?php echo ($_SESSION['error_msg']) ?? "-" ?></div> -->

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                        <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                        <span class="d-none d-sm-block">Penerimaan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                        <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                                        <span class="d-none d-sm-block">Pembayaran Siswa</span>
                                    </a>
                                </li>

                            </ul>


                            <?php
                            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                            $q = $_GET['q'];
                            if ($q != '' || $q != null) {
                                $sql    = "select * from uang_masuk_keluar where tipe='in' AND nama like '%$q%' order by tgl_input desc";
                            } else {
                                $sql    = "select * from uang_masuk_keluar where tipe='in' order by tgl_input desc";
                            }
                            $result = mysqli_query($conn, $sql);
                            $rpp    = 15;
                            $reload = "$halaman" . "?pagination=true";
                            $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

                            if ($page <= 0)
                                $page = 1;
                            $tcount  = mysqli_num_rows($result);
                            $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
                            $count   = 0;
                            $i       = ($page - 1) * $rpp;
                            $no_urut = ($page - 1) * $rpp;
                            ?>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="home">
                                    <table class="table table-borderless table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:10px">No.</th>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Jumlah(Rp)</th>
                                                <th>Oleh</th>
                                                <th>Opsi</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php while (($count < $rpp) && ($i < $tcount)) {
                                                mysqli_data_seek($result, $i);
                                                $row = mysqli_fetch_array($result);
                                            ?>

                                                <tr>

                                                    <td><?php echo ++$nom; ?></td>
                                                    <td><?php echo date('d/m/y', strtotime($row['tgl_update'])); ?></td>
                                                    <td><?php echo $row['nama']; ?></td>

                                                    <td><?php echo number_format($row['jumlah']); ?></td>
                                                    <td><?php echo $row['kasir']; ?></td>

                                                    <td>
                                                        <?php if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                                                            <a href="u_edit?q=<?php echo $row['no']; ?>&ref=u_income" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-edit"></i> </a>

                                                        <?php } ?>

                                                        <?php if ($chmod >= 5 || $_SESSION['jabatan'] == 'admin') { ?>


                                                            <button class="demo-delete-row btn btn-danger btn-icon" onclick="window.location.href='component/delete/delete_biasa?no=<?php echo $row['no'] . '&'; ?>forward=<?php echo "uang_masuk_keluar" . '&'; ?>forwardpage=<?php echo $halaman . '&'; ?>chmod=<?php echo $chmod; ?>'"><i class="fa fa-times"></i></button>


                                                        <?php } ?>

                                                    </td>

                                                </tr>
                                            <?php
                                                $i++;
                                                $count++;
                                            } ?>

                                        </tbody>
                                    </table>
                                    <div align="right"><?php if ($tcount >= $rpp) {
                                                            echo paginate_one($reload, $page, $tpages);
                                                        } else {
                                                        } ?></div>
                                </div>


                                <?php
                                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

                                $sqla    = "select * from uang_masuk_keluar where tipe='pay' order by tgl_input desc";

                                $result = mysqli_query($conn, $sqla);
                                $rpp    = 50;
                                $reload = "$halaman" . "?pagination=true";
                                $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

                                if ($page <= 0)
                                    $page = 1;
                                $tcount  = mysqli_num_rows($result);
                                $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
                                $count   = 0;
                                $i       = ($page - 1) * $rpp;
                                $no_urut = ($page - 1) * $rpp;
                                ?>


                                <div class="tab-pane " id="profile">
                                    <table class="table table-borderless table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:10px">No.</th>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Jumlah(Rp)</th>
                                                <th>Oleh</th>


                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php while (($count < $rpp) && ($i < $tcount)) {
                                                mysqli_data_seek($result, $i);
                                                $row = mysqli_fetch_array($result);
                                            ?>

                                                <tr>

                                                    <td><?php echo ++$nom; ?></td>
                                                    <td><?php echo date('d/m/y', strtotime($row['tgl_update'])); ?></td>
                                                    <td><?php echo $row['nama']; ?></td>

                                                    <td><?php echo number_format($row['jumlah']); ?></td>
                                                    <td><?php echo $row['kasir']; ?></td>

                                                </tr>
                                            <?php
                                                $i++;
                                                $count++;
                                            } ?>

                                        </tbody>
                                    </table>
                                    <div align="right"><?php if ($tcount >= $rpp) {
                                                            echo paginate_one($reload, $page, $tpages);
                                                        } else {
                                                        } ?></div>
                                </div>

                            </div>



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




    <div id="pemasukan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Tambah Penerimaan</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Nama Penerimaan</label>
                                    <input type="text" class="form-control" id="field-3" name="nama" placeholder="Nama Pemasukan" required autocomplete="off">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Jumlah (Rp)</label>
                                    <input type="number" class="form-control" id="field-3" name="jumlah" required autocomplete="off" min="0">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Kategori</label>
                                    <select class="form-control" data-toggle="select2" style="width: 100%;" name="kate" id="kate" required>

                                        <?php
                                        $sql = mysqli_query($conn, "select * from uang_kategori where jenis='in'");
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                            if ($pelanggan == $row['akun'])
                                                echo "<option value='" . $row['kategori_id'] . "' selected='selected'>" . $row['nama'] . "</option>";
                                            else
                                                echo "<option value='" . $row['kategori_id'] . "'>" . $row['nama'] . "</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Tanggal</label>
                                    <input type="text" class="datepicker form-control" value="<?php echo $today; ?>" id="datepicker" name="tgl" autocomplete="off" required>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">Keterangan</label>
                                    <textarea class="form-control" id="field-7" name="ket"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="masuk" class="btn btn-info waves-effect waves-light">Simpan</button>

                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->

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

    if (isset($_POST['masuk'])) {
        echo '<pre>' . print_r($_POST['nama'], 1) . '</pre>';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
            $jml = mysqli_real_escape_string($conn, $_POST["jumlah"]);
            $kate = mysqli_real_escape_string($conn, $_POST["kate"]);
            $tgl = mysqli_real_escape_string($conn, $_POST["tgl"]);
            $ket = mysqli_real_escape_string($conn, $_POST["ket"]);


            $user = $_SESSION['nama'];
            $now = date('Y-m-d');

            $sql = "INSERT 
            INTO uang_masuk_keluar 
            (
                tipe,
                nama,
                keterangan,
                jumlah,
                kasir,
                kategori_id,
                student_id,
                period_id,
                bebas_id,
                bulanan_id,
                tgl_update,
                tgl_input,
                jenis_pembayaran
            )
            VALUES
            (
                'in',
                '$nama',
                '$ket',
                '$jml',
                '$user',
                '$kate',
                '',
                '',
                '',
                '',
                '$tgl',
                '$now',
                'cash'
            )";
            // $_SESSION['error_msg'] = $sql;

            if (mysqli_query($conn, $sql)) {
                echo "<script type='text/javascript'>window.location = '$forwardpage?insert=true';</script>";
            } else {
                echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
            }
        }
    }
    ?>





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


    <script>
        window.setTimeout(function() {
            $("#myAlert").fadeTo(200, 0).slideUp(400, function() {
                $(this).remove();
            });
        }, 2000);
    </script>



    </body>

</html>
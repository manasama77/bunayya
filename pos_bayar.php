<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Pelanggan |<?php echo $app; ?></title>
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

    $halaman = "pos_bayar"; // halaman
    $dataapa = "POS Pembayaran"; // data
    $tabeldatabase = "pos_bayar"; // tabel database
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


                <?php
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $msg = $_GET['insert'];

                if ($msg == "false") {
                ?>
                    <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>Gagal Query!</strong> Terjadi kesalahan
                    </div>

                <?php } else if ($msg == "exist") { ?>
                    <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>GAGAL!</strong> Pos tersebut sudah ada
                    </div>


                <?php } else if ($msg == "nonexist") { ?>
                    <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>GAGAL!</strong> Pos yang diedit tidak diketemukan
                    </div>


                <?php } else if ($msg == "update") { ?>
                    <div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>Berhasil!</strong> Pos tersebut sudah diupdate
                    </div>


                <?php } else if ($msg == "true") { ?>

                    <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Berhasil!</strong> Pos pembayaran telah ditambahkan
                    </div>
                <?php } ?>


                <div class="row">
                    <div class="col-2">
                        <?php if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                            <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#pos">Tambah</button>
                        <?php } ?>



                    </div>

                    <div class="col-2">





                    </div>


                </div>
                <br>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title">Data POS POS Pembayaran</h4>
                            <p class="sub-header">
                                POS Pembayaran adalah Macam macam Iuran, Sumbangan dan Biaya yang dibebankan kepada siswa untuk pelaksanaan pendidikan
                            </p>




                            <form class="form-inline" method="get" action="">
                                <div class="form-group mr-2">

                                    <input type="text" class="form-control" placeholder="Cari" name="q" required>
                                </div>

                                <button type="submit" class="btn btn-info waves-effect waves-light btn-md">
                                    Cari
                                </button>
                            </form>
                            <br>
                            <?php
                            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                            $q = $_GET['q'];
                            if ($q != '' || $q != null) {
                                $sql    = "select * from pos_bayar where nama like '%$q%' or keterangan like '%$q%' order by id desc";
                            } else {
                                $sql    = "select * from pos_bayar order by id desc";
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
                            <div class="table-responsive">
                                <table class="table m-0 table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama POS Pembayaran</th>
                                            <th>Keterangan</th>

                                            <th style="width:10%">Opsi</th>
                                        </tr>
                                    </thead>

                                    <?php while (($count < $rpp) && ($i < $tcount)) {
                                        mysqli_data_seek($result, $i);
                                        $fill = mysqli_fetch_array($result);
                                    ?>
                                        <tr>

                                            <td><?php echo ++$no_urut; ?></td>
                                            <td><?php echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
                                            <td><?php echo mysqli_real_escape_string($conn, $fill['keterangan']); ?></td>



                                            <td>
                                                <?php if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                                                    <a href="pos_bayar_edit?q=<?php echo $fill['id']; ?>" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-edit"></i> </a>

                                                <?php } ?>

                                                <?php if ($chmod >= 5 || $_SESSION['jabatan'] == 'admin') { ?>


                                                    <button class="demo-delete-row btn btn-danger btn-sm btn-icon" onclick="window.location.href='component/delete/delete_pos?no=<?php echo $fill['id'] . '&'; ?>forward=<?php echo "pos_bayar" . '&'; ?>forwardpage=<?php echo $halaman . '&'; ?>chmod=<?php echo $chmod; ?>'"><i class="fa fa-times"></i></button>


                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                        $count++;
                                    } ?>

                                    </tbody>
                                </table>
                                <div align="right">
                                    <?php if ($tcount >= $rpp) {
                                        echo paginate_one($reload, $page, $tpages);
                                    } else {
                                    } ?>
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



    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->






    <!-- Sidebar Kanan -->
    <?php

    right();

    ?>

    <!-- End Sidebar Kanan -->



    <div id="pos" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Tambah POS Pembayaran</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">POS Pembayaran</label>
                                    <input type="text" class="form-control" id="field-3" name="nama" placeholder="Contoh: SPP" required>

                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">Deskripsi</label>
                                    <textarea class="form-control" id="field-7" placeholder="Sumbangan Pelaksanaan Pendidikan" name="ket"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-info waves-effect waves-light">Simpan</button>

                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->




    <!-- Letak Kode PHP Bawah -->


    <?php
    if (isset($_POST['tambah'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
            $ket = mysqli_real_escape_string($conn, $_POST["ket"]);

            $sqla = "select * from pos_bayar where nama='$nama'";
            $result = mysqli_query($conn, $sqla);


            if (mysqli_num_rows($result) < 1) {

                $sql = "INSERT INTO pos_bayar VALUES('','$nama','$ket')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script type='text/javascript'>window.location = '$forwardpage?insert=true';</script>";
                } else {
                    echo "<script type='text/javascript'>window.location = '$forwardpage?insert=false';</script>";
                }
            } else {
                echo "<script type='text/javascript'>window.location = '$forwardpage?insert=exist';</script>";
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


    <script>
        window.setTimeout(function() {
            $("#myAlert").fadeTo(200, 0).slideUp(400, function() {
                $(this).remove();
            });
        }, 2000);
    </script>



    </body>

</html>
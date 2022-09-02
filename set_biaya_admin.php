<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title><?php echo $app; ?></title>
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

    $halaman = "set_bulan"; // halaman
    $dataapa = "Set Biaya Admin"; // data
    $tabeldatabase = "months"; // tabel database
    $chmod = $chmenu8; // Hak akses Menu
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

                <script>
                    window.setTimeout(function() {
                        $("#myAlert").fadeTo(200, 0).slideUp(400, function() {
                            $(this).remove();
                        });
                    }, 2000);
                </script>


                <?php
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $msg = $_GET['update'];

                if ($msg == "false") {
                ?>
                    <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>Gagal Query!</strong> Terjadi kesalahan
                    </div>

                <?php } else if ($msg == "true") { ?>
                    <div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>Berhasil!</strong> Nama Bulan telah diupdate
                    </div>


                <?php } else if ($msg == "blank") { ?>
                    <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>GAGAL!</strong> Nama Bulan wajib diisi
                    </div>

                <?php } ?>




                <div class="row">
                    <div class="col-6">
                        <div class="card-box">
                            <h4 class="header-title">Set Biaya Admin</h4>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Biaya</th>
                                            <th class="text-center" style="width:20%">
                                                <i class="fas fa-cog"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        $rek = mysqli_query($conn, "SELECT * FROM biaya_admin WHERE id = 1");
                                        while ($fill = mysqli_fetch_assoc($rek)) {; ?>
                                            <tr>
                                                <form id="form" method="post">
                                                    <td>
                                                        <input type="number" class="form-control" id="biaya" name="biaya" value="<?php echo $fill['biaya']; ?>" required />
                                                    </td>
                                                    <td>
                                                        <?php if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                                            <button type="submit" class="demo-delete-row btn btn-info btn-sm btn-icon">
                                                                <i class="fa fa-save"></i> Simpan
                                                            </button>
                                                    </td>
                                                </form>

                                            <?php } ?>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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

<script>
    $('#form').on('submit', e => {
        e.preventDefault()
        fetch('ajax/update_biaya_admin.php', {
                method: 'POST',
                headers: {
                    Accept: 'application.json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    biaya: $('#biaya').val(),
                }),
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.code == 200) {
                    alert("Update biaya admin berhasil")
                } else {
                    alert("Update biaya admin gagal")
                }
            })
            .catch((error) => {
                console.log(error)
                alert("terjadi kesalahan ketika update biaya admin")
            });
    })
</script>
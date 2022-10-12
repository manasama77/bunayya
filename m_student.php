<!DOCTYPE html>
<html>

<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Siswa | <?php echo $app; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
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
    $dataapa = "Siswa"; // data
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
                                    <li class="breadcrumb-item"><a href="m_period">Manajemen</a></li>
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
                    <div class="col-4">
                        <?php if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                            <a href="m_student_add" class="btn btn-success waves-effect width-md waves-light">Tambah</a>
                            <a href="m_student_import" class="btn btn-blue waves-effect width-md waves-light">Import</a>
                        <?php } ?>



                    </div>

                    <div class="col-3">
                        <div class="btn-group btn-group-justified text-white mb-2">
                            <a class="btn btn-info waves-effect waves-light" role="button" href="#">Aktif (<?php echo $b2['active']; ?>)</a>
                            <a class="btn btn-secondary waves-effect waves-light" role="button" href="m_student_off">Nonaktif (<?php echo $b1['inactive']; ?>)</a>

                        </div>
                    </div>
                </div>

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
                if ($msg == "true") { ?>
                    <div id="myAlert" class="alert alert-success text-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>Berhasil!</strong> Data Siswa telah disimpan
                    </div>
                <?php } else if ($msg == "import") { ?>

                    <div id="myAlert" class="alert alert-info text-info alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>Proses Import Selesai!</strong> Silahkan cek kembali data hasil import apabila perlu
                    </div>
                <?php } else if ($msg == "false") { ?>
                    <div id="myAlert" class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span> </button>
                        <strong>GAGAL!</strong> Periksa kembali Input Anda
                    </div>
                <?php } ?>


                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title">Data Siswa Aktif</h4>
                            <p class="sub-header">
                                Daftar Siswa ditampilkan dengan secara dinamis untuk mempermudah administrasi. <code>Gunakan Tombol Copy,Excel dan PDF untuk Export data ke Aplikasi lain</code>
                            </p>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" data-page-length='25'>

                                <?php
                                error_reporting(E_ALL ^ E_DEPRECATED);
                                $sql    = "select * from student where status='active' order by student_id";
                                $result = mysqli_query($conn, $sql);
                                $no_urut = 0;
                                ?>
                                <thead>
                                    <tr>
                                        <th style="width:10px">No</th>
                                        <th style="width:20px">NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Nama Ibu</th>
                                        <th>Status</th>
                                        <th style="width:15%"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($fill = mysqli_fetch_array($result)) { ?>


                                        <tr>
                                            <td><?php echo ++$no_urut; ?></td>
                                            <td><?php echo mysqli_real_escape_string($conn, $fill['nis']); ?></td>
                                            <td><?php echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
                                            <td><?php $kls = $fill['kelas_id'];
                                                $q = mysqli_fetch_assoc(mysqli_query($conn, "SELECT kelas FROM class WHERE no=$kls"));
                                                echo $q['kelas'];
                                                ?>

                                            </td>
                                            <td><?php echo mysqli_real_escape_string($conn, $fill['ibu']); ?></td>
                                            <td><?php echo mysqli_real_escape_string($conn, $fill['status']); ?></td>

                                            <td>


                                                <?php if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                                    <a href="m_student_add?id=<?php echo $fill['student_id']; ?>" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-wrench"></i> </a>

                                                    <a href="m_student_detail?id=<?php echo $fill['student_id']; ?>" class="btn btn-icon waves-effect waves-light btn-info"> <i class="fas fa-eye"></i> </a>

                                                <?php } ?>




                                                <?php if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                                                    <button type="button" class="btn btn-small btn-icon waves-effect waves-light btn-danger" onclick="window.location.href='deletion?key=<?php echo $fill['student_id'] . '&'; ?>f=<?php echo "student" . '&'; ?>r=<?php echo $halaman . '&'; ?>d=Siswa'"> <i class="fas fa-times"></i> </button>
                                                <?php } ?>



                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end container-fluid -->

        </div> <!-- end content -->




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



    <!-- Datatables-->

    <!-- Required datatable js -->
    <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/vfs_fonts.js"></script>
    <script src="assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables/buttons.print.min.js"></script>
    <script src="assets/libs/datatables/buttons.colVis.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatables init -->
    <script src="assets/js/pages/datatables.init.js"></script>





    <!-- END Lib & Plugins-->






    </body>

</html>
<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Daftar Tunggakan |<?php echo $app; ?></title>
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
        header("location:logout.php");
        exit;
    }
    ?>

    <?php
    //Setting Halaman
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    include "configuration/config_chmod.php";

    $halaman       = "pay_outstanding";                                 // halaman
    $dataapa       = "Tunggakan Bulanan";                               // data
    $tabeldatabase = "kosong";                                          // tabel database
    $chmod         = $chmenu1;                                          // Hak akses Menu
    $forward       = mysqli_real_escape_string($conn, $tabeldatabase);  // tabel database
    $forwardpage   = mysqli_real_escape_string($conn, $halaman);        // halaman


    $sqlnya = "SELECT month_id,month_name FROM months WHERE status='active'";
    $b1        = mysqli_fetch_assoc(mysqli_query($conn, $sqlnya));
    $cons      = $b1['month_id'];
    $namabulan = $b1['month_name'];

    $sqlnya = "SELECT no FROM periode WHERE status='active'";
    $b2     = mysqli_fetch_assoc(mysqli_query($conn, $sqlnya));
    $t      = $b2['no'];
    //End Setting Halaman
    ?>

    <?php
    body();
    theader();
    etc();
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
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="pay_add">Pembayaran</a></li>
                                    <li class="breadcrumb-item active"><?php echo $dataapa; ?></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Tunggakan Bulanan</h4>
                        </div>
                    </div>
                </div>
                <!-- end halaman dan breadcrumbs -->

                <!-- ISI HALAMAN -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <h4 class=" col-10 header-title">Data Tunggakan Pembayaran Bulanan (per <?php echo $namabulan; ?>)</h4>
                                <div class="col-2">
                                    <form method="get">
                                        <select class="form-control" data-toggle="select2" name="bulanaktif" onchange="this.form.submit()">
                                            <?php
                                            $sql = mysqli_query($conn, "select * from months");
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                if ($cons == $row['month_id'])
                                                    echo "<option value='" . $row['month_id'] . "' selected='selected'>" . $row['month_name'] . "</option>";
                                                else
                                                    echo "<option value='" . $row['month_id'] . "'>" . $row['month_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <?php
                            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

                            $sqlnya = "SELECT DISTINCT(student_id) FROM bulanan WHERE period_id='$t' AND month_id<='$cons' AND bulanan_status LIKE '%belum%'";
                            $result = mysqli_query($conn, $sqlnya);
                            $rpp    = 15;
                            $reload = "$halaman" . "?pagination=true";
                            $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);
                            $count  = 0;
                            $tcount  = mysqli_num_rows($result);
                            $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;

                            if ($page <= 0) {
                                $page = 1;
                            }

                            $i       = ($page - 1) * $rpp;
                            $no_urut = ($page - 1) * $rpp;
                            ?>
                            <div class="table-responsive">
                                <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>NIS</th>
                                            <th>Siswa</th>
                                            <th>Kelas</th>
                                            <th>Tunggakan</th>
                                            <th>Pembayaran Terakhir</th>
                                            <th class="hidden-sm">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while (($count < $rpp) && ($i < $tcount)) {
                                            // mysqli_data_seek($result, $i);
                                            $row = mysqli_fetch_array($result);

                                            $id     = $row['student_id'];
                                            $sqlnya = "SELECT * FROM student WHERE student_id = '$id'";
                                            $b3     = mysqli_fetch_assoc(mysqli_query($conn, $sqlnya));
                                            $nrb3   = mysqli_num_rows(mysqli_query($conn, $sqlnya));

                                            $nis    = $id;
                                            $nama   = "";
                                            $avatar = "student/image/placeholder.png";
                                            if ($nrb3 > 0) {
                                                $nis    = $b3['nis'];
                                                $nama   = $b3['nama'];
                                                $avatar = "student/" . $b3['avatar'];
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo ++$no_urut; ?></td>
                                                <td>
                                                    <b><?= $nis; ?></b>
                                                </td>
                                                <td>
                                                    <a href="javascript: void(0);" class="text-body">
                                                        <img src="<?= $avatar; ?>" alt="foto-siswa" title="contact-img" class="rounded-circle avatar-sm" />
                                                        <span class="ml-1">
                                                            <b>
                                                                <?= $nama; ?>
                                                            </b>
                                                        </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $kls = $b3['kelas_id'];
                                                    $b4  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM class WHERE no='$kls'"));
                                                    echo $b4['kelas'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $b5 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bulanan_bill) as oustand FROM bulanan WHERE student_id='$id' AND period_id='$t' AND month_id<='$cons' AND bulanan_status LIKE '%belum%'"));
                                                    echo number_format($b5['oustand']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $b6 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT tgl_input FROM bulanan WHERE student_id='$id' AND period_id='$t' AND bulanan_status LIKE '%sudah%' ORDER BY tgl_input"));

                                                    if ($b6['tgl_input'] == '') {
                                                        echo 'belum ada pembayaran';
                                                    } else {
                                                        echo date('d/m/y', strtotime($b6['tgl_input']));
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false"> Tindakan <i class="mdi mdi-chevron-down"></i> </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="pay_add?t=<?php echo $t; ?>&s=<?php echo $b3['nis']; ?>">Lihat</a>
                                                            <a class="dropdown-item" href="https://api.whatsapp.com/send?phone=<?php echo $b3['nohp']; ?>&text=Hai%20%2A<?php echo $b3['nama']; ?>%2A%2C%0D%0A%0D%0AKamu%20memiliki%20tagihan%20sebesar%20%2ARp%20<?php echo number_format($b5['oustand']) ?>%2A%20yang%20perlu%20dibayarkan%20ke%20Pihak%20Sekolah.%20Segera%20lakukan%20pembayaran%20untuk%20kelancaran%20kegiatan%20belajar%20mengajar.%20Abaikan%20pesan%20ini%20apabila%20kamu%20telah%20membayar.%0D%0A%0D%0ASalam%2C%20%0D%0APetugas%20TU" target="_blank">Whatsapp</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div align="right">
                                    <?php
                                    if ($tcount >= $rpp) {
                                        echo paginate_one($reload, $page, $tpages);
                                    }
                                    ?>
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
    <!-- Letak Kode PHP Bawah -->
    <?php
    if (isset($_GET['bulanaktif'])) {
        $bulan = $_GET['bulanaktif'];
        $a1 = mysqli_query($conn, "UPDATE months SET status='inactive'");
        $a1 = mysqli_query($conn, "UPDATE months SET status='active' WHERE month_id='$bulan'");
        echo "<script type='text/javascript'>window.location = '$forwardpage';</script>";
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
    </body>

</html>
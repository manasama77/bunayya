<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Laporan Per Kelas | <?php echo $app; ?></title>
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

    $halaman = "report_byclass"; // halaman
    $dataapa = "Laporan Kelas"; // data
    $tabeldatabase = "kosong"; // tabel database
    $chmod = $chmenu6; // Hak akses Menu
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

                                    <li class="breadcrumb-item active"><?php echo $dataapa; ?></li>
                                </ol>
                            </div>
                            <h4 class="page-title"><?php echo $dataapa; ?></h4>
                        </div>
                    </div>
                </div>
                <!-- end halaman dan breadcrumbs -->


                <!-- ISI HALAMAN -->



                <div class="col-12">
                    <div class="card-box">



                        <div class="row">
                            <div class="col-lg-2">
                                <h5>Filter Laporan</h5>
                            </div>

                            <div class="col-lg-9">

                                <form class="form-inline" method="get">
                                    <div class="form-group mr-2">
                                        <label for="exampleInputName2" class="mr-2">Pilih Tahun Ajaran</label>
                                        <select style="width: 200px" name="t">
                                            <?php
                                            $sql = mysqli_query($conn, "select * from periode order by no desc");
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                if ($row['status'] == 'active')
                                                    echo "<option value='" . $row['no'] . "' data-tahun='" . $row['period_name'] . "' selected='selected'>" . $row['period_name'] . "</option>";
                                                else
                                                    echo "<option value='" . $row['no'] . "' data-tahun='" . $row['period_name'] . "' >" . $row['period_name'] . "</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="form-group mr-2">
                                        <label for="exampleInputEmail2" class="mr-2">Pilih Kelas</label>
                                        <select class="form-control" name="c">
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
                                    <button type="submit" class="btn btn-info waves-effect waves-light btn-md">
                                        Filter
                                    </button>
                                </form>
                            </div>

                        </div>


                    </div>
                </div>


                <?php

                if (isset($_GET['c'])) {
                    $t = $_GET['t'];
                    $c = $_GET['c'];
                    $a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT kelas FROM class WHERE no='$c'"));

                    $sql_a = "SELECT * FROM jenis_bayar WHERE period_id='$t' AND jenis_pembayaran='bulanan'";
                    $sql_b = "SELECT * FROM student WHERE kelas_id='$c'";

                    $sql = mysqli_query($conn, "SELECT * FROM months");
                    $sql1 = mysqli_query($conn, $sql_a);
                    $sql2 = mysqli_query($conn, $sql_b);

                    $query_a = mysqli_query($conn, $sql_a);
                    $query_b = mysqli_query($conn, $sql_b);
                    $query_c = mysqli_query($conn, $sql_a);

                    $data_lunas_ga_lunas        = [];
                    $total_terbayarkan_25       = 0;
                    $total_terbayarkan_28       = 0;
                    $total_belum_terbayarkan_25 = 0;
                    $total_belum_terbayarkan_28 = 0;

                    $x = 0;
                    while ($exec_b = mysqli_fetch_assoc($query_b)) {
                        $student_id = $exec_b['student_id'];
                        $data_lunas_ga_lunas[$x] = [
                            'student_id' => $student_id,
                            'data'       => []
                        ];
                        $y = 0;
                        while ($exec_a = mysqli_fetch_assoc($query_a)) {
                            $jenis_id = $exec_a['jenis_id'];
                            $data_lunas_ga_lunas[$x]['data'][$y]['jenis_id'] = $jenis_id;

                            $sql_bulanan_terbayarkan = "SELECT sum(bulanan_bill) as sum_bulanan_bill_terbayararkan FROM bulanan WHERE jenis_id='" . $jenis_id . "' AND period_id='" . $t . "' AND student_id='" . $student_id . "' AND month_id between 1 and 12 and bulanan_status = 'sudah'";
                            $query_bulanan_terbayarkan = mysqli_query($conn, $sql_bulanan_terbayarkan);
                            $exec_bulanan_terbayarkan = mysqli_fetch_assoc($query_bulanan_terbayarkan);
                            $sum_bulanan_bill_terbayararkan = ($exec_bulanan_terbayarkan['sum_bulanan_bill_terbayararkan']) ? $exec_bulanan_terbayarkan['sum_bulanan_bill_terbayararkan'] : 0;

                            $sql_bulanan_belum_terbayarkan = "SELECT sum(bulanan_bill) as sum_bulanan_bill_belum_terbayararkan FROM bulanan WHERE jenis_id='" . $jenis_id . "' AND period_id='" . $t . "' AND student_id='" . $student_id . "' AND month_id between 1 and 12 and bulanan_status = 'belum'";
                            $query_bulanan_belum_terbayarkan = mysqli_query($conn, $sql_bulanan_belum_terbayarkan);
                            $exec_bulanan_belum_terbayarkan = mysqli_fetch_assoc($query_bulanan_belum_terbayarkan);
                            $sum_bulanan_bill_belum_terbayararkan = ($exec_bulanan_belum_terbayarkan['sum_bulanan_bill_belum_terbayararkan']) ? $exec_bulanan_belum_terbayarkan['sum_bulanan_bill_belum_terbayararkan'] : 0;

                            $data_lunas_ga_lunas[$x]['data'][$y]['terbayarkan'] = $sum_bulanan_bill_terbayararkan;
                            $data_lunas_ga_lunas[$x]['data'][$y]['belum_terbayarkan'] = $sum_bulanan_bill_belum_terbayararkan;
                            $y++;
                        }
                        mysqli_data_seek($query_a, 0);
                        $x++;
                    }
                    mysqli_data_seek($query_b, 0);

                ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title"> <a onclick="window.location.href='configuration/config_phpexcel_multi?forward=bulanan&t=<?php echo $t; ?>&c=<?php echo $c; ?>&tipe=bulanan'" class="btn btn-xs btn-primary waves-effect waves-light btn-md"><i class="fas fa-download"> Excel</i> </a></h4>


                                <p class="sub-header">Laporan Siswa Kelas
                                    <b><?php echo '' . $a['kelas'] . ''; ?></b>
                                </p>


                                <div class="table-responsive">

                                    <table class="table table-responsive table-hover table-bordered" style="white-space: nowrap;">
                                        <tr>
                                            <th rowspan="2">Kelas</th>
                                            <th rowspan="2">Nama</th>


                                            <?php
                                            while ($row = mysqli_fetch_assoc($sql1)) {
                                            ?>
                                                <th colspan="<?php echo mysqli_num_rows($sql) + 2 ?>">
                                                    <center><?php echo $row['nama'] . ' - T.A ' . $row['tahunajar'] . ''; ?></center>
                                                </th>
                                            <?php } ?>

                                        </tr>
                                        <tr>
                                            <?php
                                            $count = mysqli_num_rows($sql1);
                                            for ($i = 0; $i < $count; $i++) {

                                                echo "
                                                <th><small>Terbayarkan</small></th>
                                                <th><small>Belum<br />Terbayarkan</small></th>
                                                ";

                                                while ($data = mysqli_fetch_array($sql)) {
                                                    echo '<th>' . $data['month_name'] . '</th>';
                                                }
                                                mysqli_data_seek($sql, 0);
                                            }
                                            ?>
                                        </tr>



                                        <?php
                                        while ($key = mysqli_fetch_assoc($sql2)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $a['kelas'] ?></td>
                                                <td><?php echo $key['nama'] ?></td>

                                                <?php
                                                $sql3 = mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE  period_id='$t' AND jenis_pembayaran='bulanan'");
                                                while ($rowan = mysqli_fetch_assoc($sql3)) {

                                                    $terbayarkan       = null;
                                                    $belum_terbayarkan = null;
                                                    foreach ($data_lunas_ga_lunas as $key_lunas_ga_lunas => $value_lunas_ga_lunas) {
                                                        // echo '<pre>' . print_r($key_lunas_ga_lunas, 1) . '</pre>';
                                                        // echo '<pre>' . print_r($value_lunas_ga_lunas, 1) . '</pre>';
                                                        // echo '<pre>' . print_r($value_lunas_ga_lunas['student_id'], 1) . '</pre>';
                                                        if ($value_lunas_ga_lunas['student_id'] == $key['student_id']) {
                                                            foreach ($value_lunas_ga_lunas['data'] as $key_value_lunas_ga_lunas) {
                                                                if ($key_value_lunas_ga_lunas['jenis_id'] == $rowan['jenis_id'] && $rowan['jenis_id'] != 29) {
                                                                    $terbayarkan       = "<th><small><strong>Rp." . number_format($key_value_lunas_ga_lunas['terbayarkan'], 0) . "</strong></small></th>";
                                                                    $belum_terbayarkan = "<th><small><strong>Rp." . number_format($key_value_lunas_ga_lunas['belum_terbayarkan'], 0) . "</strong></small></th>";

                                                                    if ($key_value_lunas_ga_lunas['jenis_id'] == 25) {
                                                                        $total_terbayarkan_25 += $key_value_lunas_ga_lunas['terbayarkan'];
                                                                        $total_belum_terbayarkan_25 += $key_value_lunas_ga_lunas['belum_terbayarkan'];
                                                                    }

                                                                    if ($key_value_lunas_ga_lunas['jenis_id'] == 28) {
                                                                        $total_terbayarkan_28 += $key_value_lunas_ga_lunas['terbayarkan'];
                                                                        $total_belum_terbayarkan_28 += $key_value_lunas_ga_lunas['belum_terbayarkan'];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    echo $terbayarkan;
                                                    echo $belum_terbayarkan;
                                                ?>

                                                    <?php while ($data = mysqli_fetch_array($sql)) {
                                                        $j = $rowan['jenis_id'];
                                                        $b = $data['month_id'];
                                                        $s = $key['student_id'];

                                                        $sql4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bulanan WHERE period_id='$t' AND student_id='$s' AND jenis_id='$j' AND month_id='$b'"));
                                                        if ($sql4['bulanan_status'] == 'belum') {
                                                            echo '<th class="table-danger">' . $sql4['bulanan_status'] . '<br/>Rp.' . number_format($sql4['bulanan_bill'], 0) . '</th>';
                                                        } else if ($sql4['bulanan_status'] == 'sudah') {
                                                            echo '<th class="table-success">' . $sql4['bulanan_status'] . '</th>';
                                                        }
                                                    }
                                                    mysqli_data_seek($sql, 0);

                                                    ?>
                                                <?php       } ?>

                                            </tr>
                                        <?php } ?>
                                        <tfoot>
                                            <tr>
                                                <?php
                                                for ($i = 0; $i < mysqli_num_rows($query_c) - 1; $i++) {
                                                ?>
                                                    <?php if ($i == 0) { ?>
                                                        <th colspan="2" style="text-align: right;">Grand Total</th>
                                                        <th>Rp.<?= number_format($total_terbayarkan_25, 0); ?></th>
                                                        <th>Rp.<?= number_format($total_belum_terbayarkan_25, 0); ?></th>
                                                        <th colspan="12" style="background-color:dimgray"></th>
                                                    <?php } ?>
                                                    <?php if ($i == 1) { ?>
                                                        <th>Rp.<?= number_format($total_terbayarkan_28, 0); ?></th>
                                                        <th>Rp.<?= number_format($total_belum_terbayarkan_28, 0); ?></th>
                                                        <th colspan="12" style="background-color:dimgray"></th>
                                                    <?php } ?>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        </tfoot>

                                    </table>

                                </div>



                            </div>
                        </div>
                    </div>


                <?php } ?>
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
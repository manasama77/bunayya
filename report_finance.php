<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Laporan Keuangan | <?php echo $app; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    $halaman = "report_finance"; // halaman
    $dataapa = "Laporan Keuangan"; // data
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



                <div class="col-12 d-print-none">
                    <div class="card-box">



                        <div class="row">
                            <div class="col-lg-3">
                                <h5>Filter Laporan</h5>
                            </div>

                            <div class="col-lg-9">

                                <form class="form-inline" method="get">
                                    <div class="form-group mr-2">
                                        <label for="exampleInputName2" class="mr-2">Pilih Rentang Tanggal</label>
                                        <input type="text" name="rentang" id="reportranges" class="form-control" />
                                    </div>


                                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-md">
                                        Tampilkan
                                    </button>
                                </form>
                            </div>

                        </div>


                    </div>
                </div>


                <?php
                $start_obj = new DateTime('first day of this month');
                $end_obj = new DateTime('last day of this month');

                $start = $start_obj->format('Y-m-d');
                $end = $end_obj->format('Y-m-d');
                if (isset($_GET['rentang'])) {
                    $dat = $_GET['rentang'];
                    list($start, $end) = explode(' - ', $dat);
                    $sql = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM data"));
                ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="clearfix">
                                    <div class="float-left mb-2"></div>
                                    <div class="float-right">
                                        <h3 class="m-0 d-print-none">LAPORAN KEUANGAN</h3>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-7 border-right">
                                        <div class="mt-3">
                                            <?Php
                                            echo '<p><b>' . $sql['nama'] . '</b></p>';
                                            echo '<p style="width:70%">' . $sql['alamat'] . '<br>P: ' . $sql['notelp'] . '<br>E: ' . $sql['email'] . ' </p>';
                                            ?>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="mt-3 text-md-right">
                                            <p><strong>LAPORAN KEUANGAN</strong></p>

                                            <p>Periode: <strong><?php echo '' . date('d/m/y', strtotime($start)) . ' - ' . date('d/m/y', strtotime($end)) . ''; ?></strong></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table mt-4 table-centered">
                                                <thead>
                                                    <tr>
                                                        <th>Kategori</th>
                                                        <th style="width:15%">Pemasukan</th>
                                                        <th style="width:15%">Pengeluaran</th>
                                                        <th style="width:15%">Total</th>

                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <tr class="table-secondary">
                                                        <td colspan="4"><b>PENERIMAAN</b></td>
                                                    </tr>

                                                    <?php
                                                    // pemasukan bulanan
                                                    $sub_total_masuk = 0;
                                                    $grand_total = 0;
                                                    $sql_bulanan = "
                                                    SELECT
                                                        uang_masuk_keluar.bulanan_id,
                                                        sum( uang_masuk_keluar.jumlah ) AS jumlah,
                                                        jenis_bayar.nama AS jenis_pembayaran 
                                                    FROM
                                                        uang_masuk_keluar
                                                        LEFT JOIN bulanan ON bulanan.`no` = uang_masuk_keluar.bulanan_id
                                                        LEFT JOIN jenis_bayar ON jenis_bayar.jenis_id = bulanan.jenis_id 
                                                    WHERE
                                                        uang_masuk_keluar.bulanan_id != 0
                                                        AND
                                                        uang_masuk_keluar.tipe != 'out'
                                                        AND
                                                        (
                                                            uang_masuk_keluar.tgl_update between '$start' and '$end'
                                                        )
                                                    GROUP BY jenis_bayar.jenis_id
                                                    ";
                                                    $query_bulanan = mysqli_query($conn, $sql_bulanan);
                                                    $nr_bulanan = mysqli_num_rows($query_bulanan);
                                                    while ($row = mysqli_fetch_array($query_bulanan)) {
                                                        $bulanan_id       = $row['bulanan_id'];
                                                        $sub_total_masuk += $row['jumlah'];
                                                        $grand_total     += $row['jumlah'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?= $row['jenis_pembayaran']; ?>
                                                            </td>
                                                            <td>
                                                                <?= number_format($row['jumlah']); ?>
                                                            </td>
                                                            <td style="width:15%"></td>
                                                            <td><?= number_format($sub_total_masuk); ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                    <?php
                                                    // pemasukan bebas
                                                    $sql_bebas = "
                                                    SELECT
                                                        uang_masuk_keluar.bebas_id,
                                                        sum( uang_masuk_keluar.jumlah ) AS jumlah,
                                                        jenis_bayar.nama AS jenis_pembayaran 
                                                    FROM
                                                        uang_masuk_keluar
                                                        LEFT JOIN bebasan ON bebasan.`no` = uang_masuk_keluar.bebas_id
                                                        LEFT JOIN jenis_bayar ON jenis_bayar.jenis_id = bebasan.jenis_id 
                                                    WHERE
                                                        uang_masuk_keluar.bebas_id != 0 
                                                        AND uang_masuk_keluar.tipe != 'out' 
                                                        AND
                                                        (
                                                            uang_masuk_keluar.tgl_update between '$start' and '$end'
                                                        )
                                                    GROUP BY
                                                        jenis_bayar.jenis_id
                                                    ";
                                                    $query_bebas = mysqli_query($conn, $sql_bebas);
                                                    $nr_bebas = mysqli_num_rows($query_bebas);
                                                    while ($row = mysqli_fetch_array($query_bebas)) {
                                                        $bebas_id  = $row['bebas_id'];
                                                        $sub_total_masuk   += $row['jumlah'];
                                                        $grand_total += $row['jumlah'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?= $row['jenis_pembayaran']; ?>
                                                            </td>
                                                            <td>
                                                                <?= number_format($row['jumlah']); ?>
                                                            </td>
                                                            <td style="width:15%"></td>
                                                            <td><?= number_format($sub_total_masuk); ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                    <?php
                                                    // pemasukan kategori
                                                    $sql_kategori = "
                                                    SELECT
                                                        uang_masuk_keluar.kategori_id,
                                                        sum( uang_masuk_keluar.jumlah ) AS jumlah,
                                                        uang_kategori.nama AS jenis_pembayaran 
                                                    FROM
                                                        uang_masuk_keluar
                                                        LEFT JOIN uang_kategori ON uang_kategori.kategori_id = uang_masuk_keluar.kategori_id 
                                                    WHERE
                                                        uang_masuk_keluar.kategori_id != 0 
                                                        AND uang_masuk_keluar.student_id = 0 
                                                        AND uang_masuk_keluar.tipe != 'out' 
                                                        AND
                                                        (
                                                            uang_masuk_keluar.tgl_update between '$start' and '$end'
                                                        )
                                                    GROUP BY
                                                        uang_masuk_keluar.kategori_id
                                                    ";
                                                    $query_kategori = mysqli_query($conn, $sql_kategori);
                                                    $nr_kategori = mysqli_num_rows($query_kategori);
                                                    while ($row = mysqli_fetch_array($query_kategori)) {
                                                        $kategori_id  = $row['kategori_id'];
                                                        $sub_total_masuk   += $row['jumlah'];
                                                        $grand_total += $row['jumlah'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?= $row['jenis_pembayaran']; ?>
                                                            </td>
                                                            <td>
                                                                <?= number_format($row['jumlah']); ?>
                                                            </td>
                                                            <td style="width:15%"></td>
                                                            <td><?= number_format($sub_total_masuk); ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                    <?php
                                                    // pemasukan tabungan
                                                    $sql_tabungan = "
                                                    SELECT
                                                        uang_masuk_keluar.tabungan_id,
                                                        sum( uang_masuk_keluar.jumlah ) AS jumlah
                                                    FROM
                                                        uang_masuk_keluar
                                                    WHERE
                                                        uang_masuk_keluar.tabungan_id != 0
                                                        AND
                                                        uang_masuk_keluar.tipe != 'out'
                                                        AND
                                                        (
                                                            uang_masuk_keluar.tgl_update between '$start' and '$end'
                                                        )
                                                    ";
                                                    $query_tabungan = mysqli_query($conn, $sql_tabungan);
                                                    $nr_tabungan = mysqli_num_rows($query_tabungan);
                                                    while ($row = mysqli_fetch_array($query_tabungan)) {
                                                        $tabungan_id      = $row['tabungan_id'];
                                                        $sub_total_masuk += $row['jumlah'];
                                                        $grand_total     += $row['jumlah'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                Tabungan Masuk
                                                            </td>
                                                            <td>
                                                                <?= number_format($row['jumlah']); ?>
                                                            </td>
                                                            <td style="width:15%"></td>
                                                            <td><?= number_format($sub_total_masuk); ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                    <tr class="table-secondary">
                                                        <td colspan="4"><b>PENGELUARAN</b></td>
                                                    </tr>

                                                    <?php
                                                    $sub_total_pengeluaran = 0;
                                                    // pengeluaran kategori
                                                    $sql_kategori = "
                                                    SELECT
                                                        uang_masuk_keluar.kategori_id,
                                                        sum( uang_masuk_keluar.jumlah ) AS jumlah,
                                                        uang_kategori.nama AS jenis_pembayaran 
                                                    FROM
                                                        uang_masuk_keluar
                                                        LEFT JOIN uang_kategori ON uang_kategori.kategori_id = uang_masuk_keluar.kategori_id 
                                                    WHERE
                                                        uang_masuk_keluar.kategori_id != 0 
                                                        AND uang_masuk_keluar.student_id = 0 
                                                        AND uang_masuk_keluar.tipe = 'out' 
                                                        AND
                                                        (
                                                            uang_masuk_keluar.tgl_update between '$start' and '$end'
                                                        )
                                                    GROUP BY
                                                        uang_masuk_keluar.kategori_id
                                                    ";
                                                    $query_kategori = mysqli_query($conn, $sql_kategori);
                                                    $nr_kategori = mysqli_num_rows($query_kategori);
                                                    while ($row = mysqli_fetch_array($query_kategori)) {
                                                        $kategori_id  = $row['kategori_id'];
                                                        $sub_total_pengeluaran   += $row['jumlah'];
                                                        $grand_total -= $row['jumlah'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?= $row['jenis_pembayaran']; ?>
                                                            </td>
                                                            <td style="width:15%">
                                                            </td>
                                                            <td>
                                                                <?= number_format($row['jumlah']); ?>
                                                            </td>
                                                            <td><?= number_format($sub_total_pengeluaran); ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                    <tr>
                                                        <td style="width:10%"><b>GRAND TOTAL</b></td>
                                                        <td><b><?php echo number_format($sub_total_masuk); ?></b></td>
                                                        <td><b><?php echo number_format($sub_total_pengeluaran); ?></b></td>
                                                        <td><b><?php echo number_format($grand_total); ?></b></td>

                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="clearfix pt-4">
                                            <h6 class="text-muted">Keterangan:</h6>

                                            <small>
                                                Laporan Keuangan Sekolah Periode <b><?php echo '' . date('d/m/y', strtotime($start)) . ' sampai ' . date('d/m/y', strtotime($end)) . ''; ?></b>
                                            </small>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-md-right">
                                            <p><strong>dicetak: </strong> <?php echo date('d-m-Y'); ?></p>
                                            <p><strong>oleh: </strong> <?php echo $_SESSION['nama']; ?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="hidden-print mt-4">
                                    <div class="text-right d-print-none">
                                        <a href="javascript:window.print()" class="btn btn-blue waves-effect waves-light"><i class="fa fa-print mr-1"></i> Print</a>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- end row -->

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

    <script>
        let start = '<?= $start; ?>'
        let end = '<?= $end; ?>'
        $('#reportranges').val(`${start} - ${end}`);
        $('#reportranges').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
    </script>






    </body>

</html>
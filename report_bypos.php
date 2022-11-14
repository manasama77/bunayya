<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Laporan Iuran Non Bulanan | <?php echo $app; ?></title>
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

    $halaman       = "report_bypos";                                    // halaman
    $dataapa       = "Laporan Pembayaran Non Bulanan";                  // data
    $tabeldatabase = "kosong";                                          // tabel database
    $chmod         = $chmenu6;                                          // Hak akses Menu
    $forward       = mysqli_real_escape_string($conn, $tabeldatabase);  // tabel database
    $forwardpage   = mysqli_real_escape_string($conn, $halaman);        // halaman
    //End Setting Halaman
    menu();
    ?>
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
                    <div class="card">
                        <div class="card-header bg-info">
                            <h5>Filter Laporan</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="t">Pilih Rentang Tanggal</label>
                                        <select class="form-control" id="t" name="t" onchange="this.form.submit()">
                                            <option value=""></option>
                                            <?php
                                            $t = ($_GET['t']) ?? "";
                                            $sql = mysqli_query($conn, "select * from periode order by no desc");
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                                <option <?= ($t == $row['no']) ? "selected" : null; ?> value="<?= $row['no']; ?>">
                                                    <?= $row['period_name']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="j">Pos Pembayaran</label>
                                        <select class="form-control" id="j" name="j" onchange="this.form.submit()">
                                            <option value=""></option>
                                            <?php
                                            $sqlnya = "select * from jenis_bayar where jenis_pembayaran='bebas' AND period_id='$t' order by jenis_id desc";
                                            $sql    = mysqli_query($conn, $sqlnya);
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                                <option <?= ($_GET['j'] == $row['jenis_id']) ? "selected" : null; ?> value="<?= $row['jenis_id']; ?>"><?= $row['nama']; ?> | <?= $row['tahunajar']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group col">
                                        <button type="submit" class="btn btn-info waves-effect waves-light btn-md">
                                            Cari
                                        </button>
                                    </div> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php

                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                $t = $_GET['t'];
                $j = $_GET['j'];

                $sql1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE jenis_id='$j'"));
                $c = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM periode WHERE no='$t'"));

                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title"> <a onclick="window.location.href='configuration/config_phpexcel?forward=report_bebas&t=<?php echo $t; ?>&j=<?php echo $j; ?>&tipe=bebas'" class="btn btn-xs btn-primary waves-effect waves-light btn-md"><i class="fas fa-download"> Excel</i> </a></h4>

                            <p class="sub-header">
                                Tabel Data Pembayaran siswa untuk <b><?php echo $sql1['nama']; ?></b> Tahun ajaran <b><?php echo $c['period_name']; ?></b> diurutkan berdasarkan Kelas
                            </p>


                            <?php
                            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                            $sql    = "select * from student order by kelas_id";

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
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:10px" rowspan="2">NO</th>
                                            <th style="width:10px" rowspan="2">Kelas</th>
                                            <th style="width:10%" rowspan="2">NIS</th>
                                            <th style="width:20%" rowspan="2">Nama</th>
                                            <th colspan="3" rowspan="1" style="text-align: center"><?php echo $sql1['nama']; ?></th>
                                        </tr>
                                        <tr>
                                            <th rowspan="1">Sudah dibayar</th>
                                            <th rowspan="1">Sisa Pembayaran</th>
                                            <th rowspan="1">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while (($count < $rpp) && ($i < $tcount)) {
                                            mysqli_data_seek($result, $i);
                                            $fill = mysqli_fetch_array($result);
                                        ?>

                                            <tr>

                                                <td><?php echo ++$no_urut; ?></td>
                                                <td><?php $k = $fill['kelas_id'];
                                                    $a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT kelas FROM class WHERE no='$k'"));
                                                    echo $a['kelas'];
                                                    ?>

                                                </td>
                                                <td><?php echo $fill['nis']; ?></td>
                                                <td><?php echo $fill['nama']; ?></td>
                                                <?php $s = $fill['student_id'];
                                                $sql2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bebasan WHERE period_id='$t' AND jenis_id='$j' AND student_id='$s'"));
                                                ?>
                                                <td><?php echo number_format($sql2['sudahbayar'], 0); ?></td>
                                                <td><?php $selisih = $sql2['bill'] - $sql2['sudahbayar'];

                                                    if (($sql2['bill'] == 0)) {
                                                        $status = "";
                                                        $selisih = "";
                                                    } else if (($sql2['bill'] != 0) && $selisih <= 0) {
                                                        $selisih = 0;
                                                        $status = 'LUNAS';
                                                    } else if ($selisih == $sql2['bill']) {
                                                        $status = 'Belum Dibayar';
                                                    } else if (($selisih > 0) && ($selisih < $sql2['bill'])) {
                                                        $status = "DICICIL";
                                                    }

                                                    echo number_format($selisih, 0); ?></td>

                                                <?php if ($status == 'LUNAS') { ?>
                                                    <td class="table-success"><?php echo $status; ?></td>
                                                <?php } else { ?>
                                                    <td><?php echo $status; ?></td>
                                                <?php   }  ?>

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

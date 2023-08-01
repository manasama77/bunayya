<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Pembayaran |<?php echo $app; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Aplikasi Kelola Sales dan Keuangan" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <style>
        #nis {
            width: 100% !important;
        }
    </style>

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

    $halaman = "pay_add"; // halaman
    $dataapa = "Pembayaran Siswa"; // data
    $tabeldatabase = "kosong"; // tabel database
    $chmod = $chmenu1; // Hak akses Menu
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


                <!--
                    UPDATE: 2022-03-22
                    BY: @adampm
                -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="card-header bg-primary">Filter Data Siswa</h5>
                            <div class="card-body">
                                <form method="get">
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="height: 35px;">Tahun Ajaran</span>
                                                    <select class="form-control" id="t" name="t">
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

                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="height: 35px;">NIS</span>
                                                    <input type="text" class="form-control" id="nis" name="s" autocomplete="off" list="list_nis">
                                                    <datalist id="list_nis">
                                                        <?php
                                                        $sql = "select * from student where student.`status` = 'active'";
                                                        $query = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                            echo '<option value="' . $row['nis'] . '">' . $row['nama'] . '</option>';
                                                        }
                                                        ?>
                                                    </datalist>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-md">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <?php
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

                $periode = $_GET['t'];
                $siswa = $_GET['s'];

                $sq = mysqli_query($conn, "SELECT * FROM student WHERE nis='$siswa'");

                if (mysqli_num_rows($sq) > 0) {



                    $sql1 = mysqli_fetch_assoc($sq);
                    $k = $sql1['kelas_id'];
                    $id = $sql1['student_id'];

                    $sql2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM periode WHERE no='$periode'"));

                    $sql3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM class WHERE no='$k'"));




                    if ($sql1['avatar'] != '') {
                        $subject = $sql1['avatar'];
                        $search = 'student/';
                        $trimmed = str_replace($search, '', $subject);
                    } else {
                        $trimmed = "image/placeholder.png";
                    }

                ?>
                    <div class="row">
                        <div class="col-9">
                            <div class="card-box">
                                <h4 class="header-title">Informasi Siswa</h4>

                                <div class="table-responsive">

                                    <table class="table table-striped mb-0">

                                        <tbody>
                                            <tr>

                                                <td>Tahun Ajaran</td>
                                                <td style="width:10px">:</td>
                                                <td><b><?php echo $sql2['period_name']; ?></b></td>
                                            </tr>
                                            <tr>

                                                <td>NIS</td>
                                                <td style="width:10px">:</td>
                                                <td><b><?php echo $sql1['nis']; ?></b></td>
                                            </tr>
                                            <tr>

                                                <td>Nama Siswa</td>
                                                <td style="width:10px">:</td>
                                                <td><b><?php echo $sql1['nama']; ?></b></td>
                                            </tr>
                                            <tr>

                                                <td>Kelas</td>
                                                <td style="width:10px">:</td>
                                                <td><?php echo $sql3['kelas']; ?></td>
                                            </tr>

                                            <tr>

                                                <td>Nama Ibu</td>
                                                <td style="width:10px">:</td>
                                                <td><b><?php echo $sql1['ibu']; ?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <br>
                                <a href="pay_statement?t=<?php echo $periode; ?>&id=<?php echo $id; ?>" class="btn btn-warning waves-effect width-md waves-light">CETAK SEMUA TAGIHAN</a>
                            </div>
                        </div>

                        <!-- Foto Siswa -->
                        <div class="col-3">
                            <div class="card-box">
                                <img src="student/<?php echo $trimmed; ?>" alt="image" class="img-fluid rounded" width="250" />
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-6">
                            <div class="card-box">
                                <h4 class="header-title mb-4">Transaksi Bulanan Terakhir</h4>
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Pembayaran</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nom = 0;
                                        $sqlxa = mysqli_query($conn, "SELECT * FROM bulanan WHERE student_id='$id' AND bulanan_status LIKE '%sudah%' ORDER BY tgl_input desc LIMIT 5");
                                        while ($fill = mysqli_fetch_assoc($sqlxa)) { ?>
                                            <tr>
                                                <th scope="row"><?php echo ++$nom; ?></th>
                                                <td><?php $jen = $fill['jenis_id'];
                                                    $y = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE jenis_id='$jen'"));
                                                    echo $y['nama'] . " - TA " . $y['tahunajar']; ?>
                                                </td>
                                                <td><?php echo number_format($fill['bulanan_bill'] + $fill['biaya_admin']); ?></td>
                                                <td><?php echo date('d/m/y', strtotime($fill['tgl_input'])); ?></td>
                                            </tr>
                                        <?php       } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>


                        <div class="col-6">
                            <div class="card-box">
                                <h4 class="header-title mb-4">Daftar Transaksi Non Bulanan</h4>

                                <table class="table mb-0">
                                    <thead class="thead">
                                        <tr>
                                            <th>#</th>
                                            <th>Pembayaran</th>
                                            <th>Tagihan</th>
                                            <th>Sudah Dibayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nom = 0;
                                        $sqlxa = mysqli_query($conn, "SELECT * FROM bebasan WHERE student_id='$id' ORDER BY tgl_input desc LIMIT 5");
                                        while ($fill = mysqli_fetch_assoc($sqlxa)) { ?>
                                            <tr>
                                                <th scope="row"><?php echo ++$nom; ?></th>
                                                <td><?php $jen = $fill['jenis_id'];
                                                    $y = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE jenis_id='$jen'"));
                                                    echo $y['nama'] . " - TA " . $y['tahunajar']; ?>
                                                </td>
                                                <td><?php echo number_format($fill['bill'] + $fill['biaya_admin']); ?></td>
                                                <td><?php echo number_format($fill['sudahbayar']); ?></td>
                                            </tr>
                                        <?php       } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-4">Tabel Pembayaran</h4>

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                            <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                            <span class="d-none d-sm-block">Bulanan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link">
                                            <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                                            <span class="d-none d-sm-block">Bebas</span>
                                        </a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="home">
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Pembayaran</th>
                                                        <th>Belum Bayar</th>

                                                        <?php
                                                        $sql = mysqli_query($conn, "SELECT * FROM months ORDER by month_id");

                                                        while ($row = mysqli_fetch_assoc($sql)) {
                                                            echo '<th >' . $row['month_name'] . '</th>';
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $sqlnya = "SELECT DISTINCT jenis_id FROM bulanan WHERE student_id='$id' and period_id = '$periode' ORDER by `no`";
                                                    $sql = mysqli_query($conn, $sqlnya);
                                                    $no = 0;
                                                    while ($row = mysqli_fetch_assoc($sql)) {
                                                    ?>
                                                        <tr>
                                                            <th scope="row"><?php echo ++$no; ?></th>
                                                            <td><?php $j = $row['jenis_id'];
                                                                $qr = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama,tahunajar FROM jenis_bayar WHERE jenis_id='$j'"));
                                                                echo $qr['nama']; ?>-T.A <?php echo $qr['tahunajar']; ?>

                                                            </td>
                                                            <td>
                                                                <?php $qa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bulanan_bill) as bill FROM bulanan WHERE jenis_id='$j' AND period_id='$periode' AND student_id='$id' AND bulanan_status LIKE '%belum%'"));
                                                                echo number_format($qa['bill']); ?>

                                                            </td>
                                                            <?php

                                                            $i = 0;
                                                            while ($i <= 11) {
                                                                $i++;
                                                                $qs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bulanan WHERE jenis_id='$j' AND period_id='$periode' AND student_id='$id' AND month_id='$i'"));
                                                                if ($qs['bulanan_status'] == 'sudah') {
                                                                    echo ' <td class="table-danger"><a href="pay_receipt?no=' . $qs['no'] . '&tipe=1">' . date('d/m/y', strtotime($qs['tgl_input'])) . '</a> </td>';
                                                                } else {
                                                                    echo ' <td ><a href="pay_save?no=' . $qs['no'] . '"><b>' . number_format($qs['bulanan_bill']) . '</b></a> </td>';
                                                                }
                                                            }
                                                            ?>

                                                        </tr>

                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="tab-pane " id="profile">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Pembayaran</th>
                                                    <th>Tagihan</th>
                                                    <th>Dibayar</th>
                                                    <th>Status</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $sqla = mysqli_query($conn, "SELECT * FROM bebasan WHERE student_id='$id' ORDER by no");
                                                $nom = 0;
                                                while ($rowa = mysqli_fetch_assoc($sqla)) { ?>

                                                    <tr>
                                                        <th scope="row"><?php echo ++$nom; ?></th>
                                                        <td><?php $j = $rowa['jenis_id'];
                                                            $qr = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama,tahunajar FROM jenis_bayar WHERE jenis_id='$j'"));
                                                            echo $qr['nama']; ?>-T.A <?php echo $qr['tahunajar']; ?>

                                                        </td>
                                                        <td><?php echo number_format($rowa['bill']); ?></td>
                                                        <td><?php echo number_format($rowa['sudahbayar']); ?></td>
                                                        <?php if ($rowa['status'] != 'belum') { ?>
                                                            <td class="table-danger"><?php echo $rowa['status']; ?></td>
                                                        <?php } else { ?>
                                                            <td><?php echo $rowa['status']; ?></td>
                                                        <?php } ?>
                                                        <td>
                                                            <?php if ($rowa['status'] == 'belum') { ?>

                                                                <a href="pay_save?no=<?php echo $rowa['no']; ?>&bebas=yes" class="demo-delete-row btn btn-danger btn-sm btn-icon"><i class="fa fa-money-bill-alt"></i></a>

                                                            <?php } else { ?>

                                                                <a href="pay_receipt?no=<?php echo $rowa['no']; ?>&tipe=2"> <?php echo date('d/m/y', strtotime($qs['tgl_input'])); ?></a>

                                                            <?php } ?>


                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- END ISI HALAMAN -->
                <?php } else { ?>


                    <div class="col-6">
                        <div class="card-box">
                            <b>Tidak ditemukan siswa dengan NIS Tersebut</b>
                        </div>
                    </div>

                <?php } ?>

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
    <!-- <script src="assets/libs/select2/select2.min.js"></script> -->
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
    <!-- <script src="assets/libs/select2/select2.min.js"></script> -->

    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script src="assets/js/pages/sweet-alerts.init.js"></script>


    <!-- Init js-->
    <script src="assets/js/pages/form-pickers.init.js"></script>

    <!-- Init js-->
    <script src="assets/js/pages/form-advanced.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <!-- END Lib & Plugins-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>





    </body>

</html>

<script>
    // $('#nis').select2({
    //     placeholder: 'Cari Siswa',
    // })
    $(document).ready(() => {})
</script>
<!DOCTYPE html>
<html>
<?php
include "configuration/config_include.php";
include "configuration/config_all_stat.php";
// include "configuration/config_constants.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
?>

<head>
    <meta charset="utf-8" />
    <title>Pembayaran |<?php echo $app; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Aplikasi Kelola Sales dan Keuangan" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <?php
    session();
    connect();
    head();
    timing();

    // PROSES BAYAR BULANAN
    if (isset($_POST['simpan'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $no               = mysqli_real_escape_string($conn, $_POST["no"]);
            $t                = mysqli_real_escape_string($conn, $_POST["t"]); // tahun ajar
            $s                = mysqli_real_escape_string($conn, $_POST["s"]); // student id
            $dibayar          = mysqli_real_escape_string($conn, str_replace(array('.', ','), '', $_POST["dibayar"]));
            $kembali          = mysqli_real_escape_string($conn, str_replace(array('.', ','), '', $_POST["kembali"]));
            $tagih            = mysqli_real_escape_string($conn, str_replace(array('.', ','), '', $_POST["tagih"]));
            $biaya_admin      = mysqli_real_escape_string($conn, str_replace(array('.', ','), '', $_POST["biaya_admin"]));
            $jenis_pembayaran = mysqli_real_escape_string($conn, str_replace(array('.', ','), '', $_POST["jenis_pembayaran"]));
            $now              = date("Y-m-d");
            $user             = $_SESSION['nama'];

            $sql_student = "select * from student where nis = '$s'";
            $query_student = mysqli_query($conn, $sql_student);
            $nr_student = mysqli_num_rows($query_student);

            if ($nr_student == 0) {
                echo "<script type='text/javascript'>  alert('Student Not Found');</script>";
                echo "<script type='text/javascript'>window.location = 'pay_add?t=$t&s=$s';</script>";
            }

            $row_student = mysqli_fetch_assoc($query_student);
            $email = ($row_student['email'] == "") ? null : $row_student['email'];

            $nama = mysqli_real_escape_string($conn, $_POST["namapr"]);
            $stu = mysqli_real_escape_string($conn, $_POST["stu"]);

            if ($dibayar >= $tagih + $biaya_admin) {
                // start transaction
                mysqli_autocommit($conn, FALSE);

                $sql = mysqli_query($conn, "UPDATE bulanan SET bulanan_status = 'sudah', bulanan_bayar = '$dibayar', biaya_admin = '$biaya_admin', kasir = '$user', tgl_input = '$now' WHERE no = '$no'");

                $sqlnya   = "SELECT * FROM uang_masuk_keluar WHERE student_id = '$stu' AND period_id = '$t' AND bulanan_id = '$no'";
                $querynya = mysqli_query($conn, $sqlnya);
                $nr       = mysqli_num_rows($querynya);

                // echo '<pre>' . print_r($nr, 1) . '</pre>';
                // exit;

                if ($nr == 0) {
                    $sql_uang = "INSERT INTO uang_masuk_keluar (tipe, nama, keterangan, jumlah, kasir, kategori_id, student_id, period_id, bebas_id, bulanan_id, tabungan_id, tgl_update, tgl_input, jenis_pembayaran) VALUES('pay', '$nama', 'pembayaran bulanan', '$dibayar', '$user', '1', '$stu', '$t', '0', '$no', 0, '$now', '$now', '" . $jenis_pembayaran . "')";
                    $sql1 = mysqli_query($conn, $sql_uang);
                }

                if (!mysqli_commit($conn)) {
                    echo "<script type='text/javascript'>  alert('Proses simpan gagal, tidak terhubung dengan database');</script>";
                    echo "<script type='text/javascript'>window.location = 'pay_save?no=$no';</script>";
                    exit();
                }

                mysqli_autocommit($conn, true);

                // $email = "adam.pm77@gmail.com";

                if ($email) {
                    $subject = $nama;

                    $sql_tahun_ajar   = "select * from periode where no = '$t'";
                    $query_tahun_ajar = mysqli_query($conn, $sql_tahun_ajar);
                    $row_tahun_ajar   = mysqli_fetch_assoc($query_tahun_ajar);

                    $id_kelas    = $row_student['kelas_id'];
                    $sql_kelas   = "select * from class where no = '$id_kelas'";
                    $query_kelas = mysqli_query($conn, $sql_kelas);
                    $row_kelas   = mysqli_fetch_assoc($query_kelas);

                    $sql_bebasan   = "select * from bulanan where no = '$no'";
                    $query_bebasan = mysqli_query($conn, $sql_bebasan);
                    $row_bebasan   = mysqli_fetch_assoc($query_bebasan);

                    $kembalian = $dibayar - ($tagih + $biaya_admin);
                    $status = "Lunas";

                    $sql_sekolah = "SELECT * FROM `data`";
                    $query_sekolah = mysqli_query($conn, $sql_sekolah);
                    $row_sekolah = mysqli_fetch_assoc($query_sekolah);

                    kirimEmailBulanan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bebasan, $dibayar, $kembalian, $status, $user, $row_sekolah);

                    // mysqli_rollback($conn);
                }

                echo "<script type='text/javascript'>  alert('Pembayaran telah disimpan');</script>";
                echo "<script type='text/javascript'>window.location = 'pay_add?t=$t&s=$s';</script>";
            } else {
                echo "<script type='text/javascript'>  alert('Gagal, Jumlah bayar tidak boleh kurang dari yang ditagih');</script>";
                echo "<script type='text/javascript'>window.location = 'pay_save?no=$no';</script>";
            }
        }
    }
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
    // PROSES BAYAR BEBASAN
    if (isset($_POST['save'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $now  = date("Y-m-d");
            $user = $_SESSION['nama'];

            $no = mysqli_real_escape_string($conn, $_POST["no"]);
            $t  = mysqli_real_escape_string($conn, $_POST["t"]);
            $s  = mysqli_real_escape_string($conn, $_POST["s"]);

            $sql_student   = "select * from student where nis = '$s'";
            $query_student = mysqli_query($conn, $sql_student);
            $nr_student    = mysqli_num_rows($query_student);

            if ($nr_student == 0) {
                echo "<script type='text/javascript'>  alert('Student Not Found');</script>";
                echo "<script type='text/javascript'>window.location = 'pay_add?t=$t&s=$s';</script>";
            }

            $row_student = mysqli_fetch_assoc($query_student);
            $email       = ($row_student['email'] == "") ? null : $row_student['email'];

            $dibayar     = mysqli_real_escape_string($conn, str_replace(".", "", $_POST["dibayar"]));
            $biaya_admin = mysqli_real_escape_string($conn, str_replace(".", "", $_POST["biaya_admin_bebas"]));
            $bill        = mysqli_real_escape_string($conn, str_replace(".", "", $_POST["bill"]));
            $sudah       = mysqli_real_escape_string($conn, str_replace(".", "", $_POST["sudah"]));
            $nama        = mysqli_real_escape_string($conn, $_POST["namapr"]) . " - " . $row_student['nama'];
            $stu         = mysqli_real_escape_string($conn, $_POST["stu"]);

            $bayar = $sudah + $dibayar;

            if ($bayar >= $bill + $biaya_admin) {
                $sqlan = "UPDATE bebasan 
                SET 
                    biaya_admin = 
                    CASE WHEN biaya_admin = 0 
                        THEN $biaya_admin 
                        ELSE biaya_admin 
                    END,
                    `status` = 'sudah', 
                    sudahbayar = '$bayar', 
                    kasir = '$user',
                    tgl_input = '$now' 
                WHERE 
                    no = '$no'
                ";
                $sql = mysqli_query($conn, $sqlan);

                $message = "Pembayaran berhasil dilunasi";
                $target  = "pay_add?t=$t&s=$s";

                if ($email) {
                    $subject = $nama;

                    $sql_tahun_ajar = "select * from periode where no = '$t'";
                    $query_tahun_ajar = mysqli_query($conn, $sql_tahun_ajar);
                    $row_tahun_ajar = mysqli_fetch_assoc($query_tahun_ajar);

                    $id_kelas = $row_student['kelas_id'];
                    $sql_kelas = "select * from class where no = '$id_kelas'";
                    $query_kelas = mysqli_query($conn, $sql_kelas);
                    $row_kelas = mysqli_fetch_assoc($query_kelas);

                    $sql_bebasan   = "select * from bebasan where no = '$no'";
                    $query_bebasan = mysqli_query($conn, $sql_bebasan);
                    $row_bebasan   = mysqli_fetch_assoc($query_bebasan);

                    $kembalian = $bayar - $bill + $biaya_admin;
                    $status = "Lunas";

                    kirimEmailBebasan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bebasan, $dibayar, $kembalian, $status, $user);
                }
            } else {
                $sqlan = "UPDATE bebasan 
                SET 
                    biaya_admin = 
                        CASE WHEN biaya_admin = 0 
                            THEN $biaya_admin 
                            ELSE biaya_admin 
                        END, 
                    sudahbayar = '$bayar',
                    kasir = '$user',
                    tgl_input = '$now' 
                WHERE no = '$no'
                ";
                $sql = mysqli_query($conn, $sqlan);

                $message = 'Berhasil, Cicilan pembayaran telah disimpan';
                $target  = "pay_save?no=$no&bebas=yes";

                if ($email) {
                    $subject = $nama;

                    $sql_tahun_ajar = "select * from periode where no = '$t'";
                    $query_tahun_ajar = mysqli_query($conn, $sql_tahun_ajar);
                    $row_tahun_ajar = mysqli_fetch_assoc($query_tahun_ajar);

                    $id_kelas = $row_student['kelas_id'];
                    $sql_kelas = "select * from class where no = '$id_kelas'";
                    $query_kelas = mysqli_query($conn, $sql_kelas);
                    $row_kelas = mysqli_fetch_assoc($query_kelas);

                    $sql_bebasan   = "select * from bebasan where no = '$no'";
                    $query_bebasan = mysqli_query($conn, $sql_bebasan);
                    $row_bebasan   = mysqli_fetch_assoc($query_bebasan);

                    $kembalian = 0;
                    $status = "Cicil";

                    kirimEmailBebasan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bebasan, $dibayar, $kembalian, $status, $user);
                }
            }

            $sqlan = "INSERT INTO bebasan_pay 
                (
                    bebasan_id,
                    period_id,
                    student_id,
                    tanggal,
                    kasir,
                    jumlah
                )
                VALUES
                (
                    '$no',
                    '$t',
                    '$stu',
                    '$now',
                    '$user',
                    '$dibayar'
                )";
            $sql1 = mysqli_query($conn, $sqlan);

            $sqlan = "INSERT INTO uang_masuk_keluar 
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
                    tabungan_id, 
                    tgl_update, 
                    tgl_input, 
                    jenis_pembayaran
                )
                VALUES
                (
                    'pay', 
                    '$nama', 
                    'pembayaran cicilan $nama', 
                    '$dibayar', 
                    '$user', 
                    '1', 
                    '$stu', 
                    '$t', 
                    '$no', 
                    '0', 
                    '0', 
                    '$now',
                    '$now', 
                    'cash'
                )
                ";
            $sql2 = mysqli_query($conn, $sqlan);

            echo "<script type='text/javascript'>  alert($message);</script>";
            echo "<script type='text/javascript'>window.location = '$target';</script>";
        }
    }
    ?>

    <?php
    body();
    theader();
    etc();


    //Setting Halaman

    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    include "configuration/config_chmod.php";

    $halaman       = "kosong";                                          // halaman
    $dataapa       = "Pembayaran";                                      // data
    $tabeldatabase = "kosong";                                          // tabel database
    $chmod         = $chmenu1;                                          // Hak akses Menu
    $forward       = mysqli_real_escape_string($conn, $tabeldatabase);  // tabel database
    $forwardpage   = mysqli_real_escape_string($conn, $halaman);        // halaman
    $no            = $_GET['no'];

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
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="pay_add">Pembayaran</a></li>
                                    <li class="breadcrumb-item active"><?php echo $dataapa; ?></li>
                                </ol>
                            </div>
                            <h4 class="page-title"><?php echo $dataapa; ?></h4>
                        </div>
                    </div>
                </div>
                <!-- end halaman dan breadcrumbs -->


                <!-- ISI HALAMAN -->
                <?php if (!isset($_GET['bebas'])) {
                    $sql = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bulanan LEFT JOIN months on months.month_id = bulanan.month_id WHERE no='$no'"));
                    $j = $sql['jenis_id'];
                    $s = $sql['student_id'];
                    $t = $sql['period_id'];
                    $nama_bulannya = $sql['month_name'];

                    $sqla = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE jenis_id='$j'"));
                    $sqlb = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM student WHERE student_id='$s'"));


                ?>

                    <form method="post" action="pay_save.php">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Form Pembayaran Bulanan</h4>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Pembayaran</label>
                                                <input type="text" class="form-control" name="namapr" value="<?php echo $sqla['nama'] . " T.A " . $sqla['tahunajar'] . " " . $nama_bulannya; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                                <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran" required>
                                                    <option value="cash">Cash</option>
                                                    <option value="transfer">Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Siswa</label>
                                                <input type="text" class="form-control" value="<?php echo $sqlb['nama']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="tagih">Jumlah Tagihan</label>
                                                <input type="text" class="form-control" value="<?= $sql['bulanan_bill']; ?>" id="tagih" name="tagih" readonly>
                                                <input type="hidden" class="form-control" name="no" value="<?php echo $no; ?>" readonly>
                                                <input type="hidden" class="form-control" name="t" value="<?php echo $t; ?>" readonly>
                                                <input type="hidden" class="form-control" name="s" value="<?php echo $sqlb['nis']; ?>" readonly>
                                                <input type="hidden" class="form-control" name="stu" value="<?php echo $s; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <?php
                                                $sql_biaya_admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biaya_admin WHERE id = 1"));
                                                $biaya_admin = $sql_biaya_admin['biaya'];
                                                ?>
                                                <label for="biaya_admin">Biaya Admin</label>
                                                <input type="text" class="form-control" id="biaya_admin" name="biaya_admin" value="<?= $biaya_admin; ?>" required readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="total_tagihan">Total Tagihan</label>
                                                <input type="text" class="form-control" id="total_tagihan" name="total_tagihan" value="<?= $sql['bulanan_bill'] + $biaya_admin; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="dibayarkan">Jumlah Dibayarkan</label>
                                                <input type="text" class="form-control" id="dibayarkan" name="dibayar" autocomplete="off" min="0" placeholder="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // function sum() {
                                //     let regexDecimal = /[.,\s]/g;

                                //     let txtFirstNumberValue = document.getElementById('dibayarkan').value
                                //     let txtSecondNumberValue = document.getElementById('tagih').value;
                                //     let biaya_admin = document.getElementById('biaya_admin').value

                                //     txtSecondNumberValue = txtSecondNumberValue.replace(regexDecimal, '')
                                //     console.log("txtSecondNumberValue", txtSecondNumberValue)


                                //     let result = parseFloat(txtFirstNumberValue) - parseFloat(txtSecondNumberValue) - biaya_admin;
                                //     if (!isNaN(result)) {
                                //         document.getElementById('kembalinye').value = result;
                                //     }
                                //     // if (!$(jumlah).val()) {
                                //     //     document.getElementById('kembalinye').value = "0";
                                //     // }
                                //     if (!$(hargajual).val()) {
                                //         document.getElementById('kembalinye').value = "0";
                                //     }
                                // }
                            </script>

                            <?php if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                <div class="col-lg-3">
                                    <div class="card-box">
                                        <h4 class="header-title">Tindakan</h4>

                                        <div class="table-responsive">

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Uang Kembalian</label>
                                                <input type="text" class="form-control" id="kembalinye" name="kembali" readonly>
                                            </div>


                                            <button type="submit" name="simpan" class="btn btn-block btn-success waves-effect width-md waves-light" disabled>SIMPAN</button>

                                            <a href="pay_add?t=<?php echo $t; ?>&s=<?php echo $sqlb['nis']; ?>" class="btn btn-block btn-danger waves-effect width-md waves-light">KEMBALI</a>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </form>

                <?php } else {


                    $sql = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bebasan WHERE no='$no'"));
                    $j = $sql['jenis_id'];
                    $s = $sql['student_id'];
                    $t = $sql['period_id'];

                    $sqla = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE jenis_id='$j'"));
                    $sqlb = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM student WHERE student_id='$s'"));


                ?>

                    <form method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Form Pembayaran Siswa</h4>

                                    <div class="table-responsive">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama Pembayaran</label>
                                            <input type="text" class="form-control" name="namapr" value="<?php echo $sqla['nama'] . " T.A " . $sqla['tahunajar']; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Siswa</label>
                                            <input type="text" class="form-control" value="<?php echo $sqlb['nama']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="stu" value="<?php echo $s; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="tagihan">Tagihan</label>
                                            <input type="text" class="form-control rupiah" id="tagihan" value="<?php echo $sql['bill']; ?>" name="bill" readonly>
                                            <input type="hidden" class="form-control" name="no" value="<?php echo $no; ?>" readonly>
                                            <input type="hidden" class="form-control" name="t" value="<?php echo $t; ?>" readonly>
                                            <input type="hidden" class="form-control" name="s" value="<?php echo $sqlb['nis']; ?>" readonly>


                                        </div>

                                        <div class="form-group">
                                            <?php
                                            $sql_biaya_admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biaya_admin WHERE id = 1"));
                                            $biaya_admin = $sql_biaya_admin['biaya'];
                                            ?>
                                            <label for="biaya_admin_bebas">Biaya Admin</label>
                                            <input type="text" class="form-control rupiah" id="biaya_admin_bebas" name="biaya_admin_bebas" value="<?= $biaya_admin; ?>" required readonly />
                                        </div>

                                        <div class="form-group">
                                            <label for="paid">Sudah Dibayarkan</label>
                                            <input type="text" class="form-control rupiah" id="paid" value="<?php echo $sql['sudahbayar']; ?>" name="sudah" readonly>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            $sisa_pembayaran = $sql['bill'] + $biaya_admin -  $sql['sudahbayar'];
                                            ?>
                                            <label for="sisa">Sisa Pembayaran</label>
                                            <input type="text" class="form-control rupiah" id="sisa" value="<?= $sisa_pembayaran; ?>" readonly>
                                        </div>



                                        <div class="form-group">
                                            <label for="dibayar">Jumlah Bayar</label>
                                            <input type="text" class="form-control rupiah" id="dibayar" name="dibayar" autocomplete="off">
                                        </div>

                                        <button type="submit" name="save" class="btn btn-block btn-success waves-effect width-md waves-light">SIMPAN</button>
                                        <a href="pay_add?t=<?php echo $t; ?>&s=<?php echo $sqlb['nis']; ?>" class="btn btn-block btn-danger waves-effect width-md waves-light">KEMBALI</a>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Riwayat Pembayaran</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <i class="fas fa-cog"></i>
                                                    </th>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Diterima</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $nom = 0;
                                                $sqli = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as jml FROM bebasan_pay WHERE bebasan_id='$no'"));
                                                $sqlq = mysqli_query($conn, "SELECT * FROM bebasan_pay WHERE bebasan_id='$no'");
                                                while ($row = mysqli_fetch_assoc($sqlq)) {
                                                ?>
                                                    <tr>
                                                        <th class="text-center">
                                                            <a href="pay_receipt?no=<?= $no; ?>&tipe=2" target="_blank" class="btn btn-info btn-sm">
                                                                <i class="fas fa-print"></i>
                                                            </a>
                                                        </th>
                                                        <th scope="row"><?= ++$nom; ?></th>
                                                        <td><?= date('d-m-y', strtotime($row['tanggal'])); ?></td>
                                                        <td><?= $row['kasir']; ?></td>
                                                        <td><?= number_format($row['jumlah'], 0); ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if ($sqli['jml'] > 0) { ?>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <th scope="row">#</th>
                                                        <td colspan="2"><b>Total</b></td>
                                                        <td><b><?= number_format($sqli['jml']); ?></b></td>
                                                    </tr>
                                                <?php
                                                } else {
                                                    echo '<tr><td colspan="5" style="text-align:center"> Belum Ada Pembayaran Tercatat</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </form>

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

    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const bebas = urlParams.get('bebas')

        const autoNumericOptions = {
            digitGroupSeparator: '.',
            decimalCharacter: ',',
            allowDecimalPadding: false,
            decimalPlaces: 0,
            modifyValueOnWheel: false
        }

        let tagihanNumeric;
        let biayaAdminNumeric;
        let paidNumeric;
        let dibayarNumeric;
        let sisaNumeric;
        let totalTagihanNumeric;
        let kembalianNumeric;

        $(document).ready(function() {
            if (bebas) {
                tagihanNumeric = new AutoNumeric('#tagihan', autoNumericOptions);
                biayaAdminNumeric = new AutoNumeric('#biaya_admin_bebas', autoNumericOptions);
                paidNumeric = new AutoNumeric('#paid', autoNumericOptions);
                dibayarNumeric = new AutoNumeric('#dibayar', autoNumericOptions);
                sisaNumeric = new AutoNumeric('#sisa', autoNumericOptions);
            } else {
                tagihanNumeric = new AutoNumeric('#tagih', autoNumericOptions);
                biayaAdminNumeric = new AutoNumeric('#biaya_admin', autoNumericOptions);
                totalTagihanNumeric = new AutoNumeric('#total_tagihan', autoNumericOptions);
                dibayarNumeric = new AutoNumeric('#dibayarkan', autoNumericOptions);
                kembalianNumeric = new AutoNumeric('#kembalinye', autoNumericOptions);
            }

            $('#dibayar').on('keyup', e => {
                let tagihan = parseInt(tagihanNumeric.get())
                let biaya_admin = parseInt(biayaAdminNumeric.get())
                let paid = parseInt(paidNumeric.get())
                let dibayar = parseInt(dibayarNumeric.get())

                console.log(tagihan + biaya_admin)

                if (dibayar + paid > tagihan + biaya_admin) {
                    alert("Jumlah pembayaran melebihi Tagihan + Biaya admin")
                    $('button[name="save"]').prop('disabled', true)
                } else {
                    $('button[name="save"]').prop('disabled', false)
                }
            })

            $('#dibayarkan').on('keyup', e => {
                let tagihan = parseInt(tagihanNumeric.get())
                let biaya_admin = parseInt(biayaAdminNumeric.get())
                let total_tagihan = tagihan + biaya_admin;
                let dibayar = parseInt(dibayarNumeric.get())
                let kembalian = dibayar - total_tagihan;

                // $('#kembalinye').val(kembalian)
                kembalianNumeric.set(kembalian)

                if (dibayar < tagihan + biaya_admin) {
                    $('button[name="simpan"]').prop('disabled', true)
                } else {
                    $('button[name="simpan"]').prop('disabled', false)
                }
            })

            // $("input[type='submit']").click(function(e) {
            //     e.preventDefault(); // Prevent the page from submitting on click.
            //     $(this).attr('disabled', true); // Disable this input.
            //     $(this).parent("form").submit(); // Submit the form it is in.
            // });
        })
    </script>
    </body>

</html>

<?php
function kirimEmailBebasan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bebasan, $dibayar, $kembalian, $status, $user)
{
    try {
        ob_start();
        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.trijayasolution.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'noreply@trijayasolution.com';                     //SMTP username
        $mail->Password   = 'trijaya@212#';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('noreply@trijayasolution.com', 'No Reply');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $tanggal_now = new DateTime();
        include('format_email_bebasan.php');
        $page = ob_get_contents();
        ob_end_clean();
        $mail->Body = $page;

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return true;
    }
}

function kirimEmailBulanan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bulanan, $dibayar, $kembalian, $status, $user, $row_sekolah)
{
    try {
        ob_start();
        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();
        $mail->SMTPDebug  = SMTP::DEBUG_OFF;
        $mail->Host       = 'mail.trijayasolution.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'noreply@trijayasolution.com';
        $mail->Password   = 'trijaya@212#';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        // $mail->Host       = 'sandbox.smtp.mailtrap.io';
        // $mail->Username   = '1fbb19b40b41dc';
        // $mail->Password   = '83ea0541531542';
        // $mail->Port       = 2525;

        //Recipients
        $mail->setFrom('noreply@trijayasolution.com', 'No Reply');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);  //Set email format to HTML
        $mail->Subject = $subject;
        $tanggal_now   = new DateTime();
        include('format_email_bulanan.php');
        $page = ob_get_contents();
        ob_end_clean();
        $mail->Body = $page;

        // $mail->send();

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return true;
    }
}
?>
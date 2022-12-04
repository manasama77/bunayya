<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

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
    if (isset($_POST['save'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $no = mysqli_real_escape_string($conn, $_POST["no"]);
            $t = mysqli_real_escape_string($conn, $_POST["t"]);
            $s = mysqli_real_escape_string($conn, $_POST["s"]);

            $sql_student = "select * from student where nis = '$s'";
            $query_student = mysqli_query($conn, $sql_student);
            $nr_student = mysqli_num_rows($query_student);

            if ($nr_student == 0) {
                echo "<script type='text/javascript'>  alert('Student Not Found');</script>";
                echo "<script type='text/javascript'>window.location = 'pay_add?t=$t&s=$s';</script>";
            }

            $row_student = mysqli_fetch_assoc($query_student);
            $email = ($row_student['email'] == "") ? null : $row_student['email'];

            $dibayar = mysqli_real_escape_string($conn, str_replace(".", "", $_POST["dibayar"]));
            $biaya_admin = mysqli_real_escape_string($conn, str_replace(".", "", $_POST["biaya_admin_bebas"]));
            $bill = mysqli_real_escape_string($conn, str_replace(".", "", $_POST["bill"]));
            $sudah = mysqli_real_escape_string($conn, str_replace(".", "", $_POST["sudah"]));

            $bayar = $sudah + $dibayar;

            $now = date("Y-m-d");
            $user = $_SESSION['nama'];


            $nama = mysqli_real_escape_string($conn, $_POST["namapr"]);
            $stu = mysqli_real_escape_string($conn, $_POST["stu"]);

            if ($bayar >= $bill + $biaya_admin) {
                $sql = mysqli_query($conn, "UPDATE bebasan SET biaya_admin = CASE WHEN biaya_admin = 0 THEN $biaya_admin ELSE biaya_admin END, `status`='sudah', sudahbayar='$bayar', kasir='$user',tgl_input='$now' WHERE no='$no'");
                $sql1 = mysqli_query($conn, "INSERT INTO bebasan_pay VALUES('','$no','$t','$stu','$now','$user','$dibayar')");
                $sql2 = mysqli_query($conn, "INSERT INTO uang_masuk_keluar (tipe, nama, keterangan, jumlah, kasir, kategori_id, student_id, period_id, bebas_id, bulanan_id, tabungan_id, tgl_update, tgl_input, jenis_pembayaran) VALUES('pay', '$nama', 'pelunasan $nama', '$dibayar', '$user', '1', '$stu', '$t', '$no', '0', '0', '$now', '$now', 'cash')");

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

                echo "<script type='text/javascript'>  alert('Pembayaran berhasil dilunasi');</script>";
                echo "<script type='text/javascript'>window.location = 'pay_add?t=$t&s=$s';</script>";
            } else {
                $sql = mysqli_query($conn, "UPDATE bebasan SET biaya_admin = CASE WHEN biaya_admin = 0 THEN $biaya_admin ELSE biaya_admin END, sudahbayar='$bayar',kasir='$user',tgl_input='$now' WHERE no='$no'");
                $sql1 = mysqli_query($conn, "INSERT INTO bebasan_pay VALUES('','$no','$t','$stu','$now','$user','$dibayar')");
                $sql2 = mysqli_query($conn, "INSERT INTO uang_masuk_keluar (tipe, nama, keterangan, jumlah, kasir, kategori_id, student_id, period_id, bebas_id, bulanan_id, tabungan_id, tgl_update, tgl_input, jenis_pembayaran) VALUES('pay', '$nama', 'pembayaran cicilan $nama', '$dibayar', '$user', '1', '$stu', '$t', '$no', '0', '0', '$now','$now', 'cash')");

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

                echo "<script type='text/javascript'>  alert('Berhasil, Cicilan pembayaran telah disimpan');</script>";
                echo "<script type='text/javascript'>window.location = 'pay_save?no=$no&bebas=yes';</script>";
            }
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

    if (isset($_POST['simpan'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $no               = mysqli_real_escape_string($conn, $_POST["no"]);
            $t                = mysqli_real_escape_string($conn, $_POST["t"]);
            $s                = mysqli_real_escape_string($conn, $_POST["s"]);
            $dibayar          = mysqli_real_escape_string($conn, $_POST["dibayar"]);
            $kembali          = mysqli_real_escape_string($conn, $_POST["kembali"]);
            $tagih            = mysqli_real_escape_string($conn, $_POST["tagih"]);
            $biaya_admin      = mysqli_real_escape_string($conn, $_POST["biaya_admin"]);
            $jenis_pembayaran = mysqli_real_escape_string($conn, $_POST["jenis_pembayaran"]);
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
                $sql = mysqli_query($conn, "UPDATE bulanan SET bulanan_status='sudah', bulanan_bayar='$dibayar', biaya_admin='$biaya_admin', kasir='$user',tgl_input='$now' WHERE no='$no'");
                $sql_uang = "INSERT INTO uang_masuk_keluar (tipe, nama, keterangan, jumlah, kasir, kategori_id, student_id, period_id, bebas_id, bulanan_id, tabungan_id, tgl_update, tgl_input, jenis_pembayaran) VALUES('pay', '$nama', 'pembayaran bulanan', '$dibayar', '$user', '1', '$stu', '$t','0', '$no', 0, '$now', '$now', '" . $jenis_pembayaran . "')";
                $sql1 = mysqli_query($conn, $sql_uang);

                if ($email) {
                    $subject = $nama;

                    $sql_tahun_ajar = "select * from periode where no = '$t'";
                    $query_tahun_ajar = mysqli_query($conn, $sql_tahun_ajar);
                    $row_tahun_ajar = mysqli_fetch_assoc($query_tahun_ajar);

                    $id_kelas = $row_student['kelas_id'];
                    $sql_kelas = "select * from class where no = '$id_kelas'";
                    $query_kelas = mysqli_query($conn, $sql_kelas);
                    $row_kelas = mysqli_fetch_assoc($query_kelas);

                    $sql_bebasan   = "select * from bulanan where no = '$no'";
                    $query_bebasan = mysqli_query($conn, $sql_bebasan);
                    $row_bebasan   = mysqli_fetch_assoc($query_bebasan);

                    $kembalian = $dibayar - $tagih + $biaya_admin;
                    $status = "Lunas";

                    kirimEmailBulanan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bebasan, $dibayar, $kembalian, $status, $user);
                }

                echo "<script type='text/javascript'>  alert('Pembayaran telah disimpan');</script>";
                echo "<script type='text/javascript'>window.location = 'pay_add?t=$t&s=$s';</script>";
            } else {
                echo "<script type='text/javascript'>  alert('Gagal, Jumlah bayar tidak boleh kurang dari yang ditagih');</script>";
                echo "<script type='text/javascript'>window.location = 'pay_save?no=$no';</script>";
            }
        }
    } ?>
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

                    <form method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title">Form Pembayaran Bulanan</h4>

                                    <div class="table-responsive">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama Pembayaran</label>
                                            <input type="text" class="form-control" name="namapr" value="<?php echo $sqla['nama'] . " T.A " . $sqla['tahunajar'] . " " . $nama_bulannya; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Siswa</label>
                                            <input type="text" class="form-control" value="<?php echo $sqlb['nama']; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Jumlah Tagihan</label>
                                            <input type="text" class="form-control" value="<?php echo $sql['bulanan_bill']; ?>" id="tagih" name="tagih" readonly>
                                            <input type="hidden" class="form-control" name="no" value="<?php echo $no; ?>" readonly>
                                            <input type="hidden" class="form-control" name="t" value="<?php echo $t; ?>" readonly>
                                            <input type="hidden" class="form-control" name="s" value="<?php echo $sqlb['nis']; ?>" readonly>
                                            <input type="hidden" class="form-control" name="stu" value="<?php echo $s; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            $sql_biaya_admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biaya_admin WHERE id = 1"));
                                            $biaya_admin = $sql_biaya_admin['biaya'];
                                            ?>
                                            <label for="biaya_admin">Biaya Admin</label>
                                            <input type="text" class="form-control" id="biaya_admin" name="biaya_admin" value="<?= $biaya_admin; ?>" required readonly />
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Jumlah Dibayarkan</label>
                                            <input type="text" class="form-control" id="dibayarkan" name="dibayar" onkeyup="sum();" autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                            <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran" required>
                                                <option value="cash">Cash</option>
                                                <option value="transfer">Transfer</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <script>
                                function sum() {
                                    var txtFirstNumberValue = document.getElementById('dibayarkan').value
                                    var txtSecondNumberValue = document.getElementById('tagih').value;
                                    let biaya_admin = document.getElementById('biaya_admin').value
                                    var result = parseFloat(txtFirstNumberValue) - parseFloat(txtSecondNumberValue) - biaya_admin;
                                    if (!isNaN(result)) {
                                        document.getElementById('kembalinye').value = result;
                                    }
                                    if (!$(jumlah).val()) {
                                        document.getElementById('kembalinye').value = "0";
                                    }
                                    if (!$(hargajual).val()) {
                                        document.getElementById('kembalinye').value = "0";
                                    }
                                }
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


                                            <button type="submit" name="simpan" class="btn btn-block btn-success waves-effect width-md waves-light">SIMPAN</button>

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






    </body>

</html>

<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
<script>
    const autoNumericOptions = {
        digitGroupSeparator: '.',
        decimalCharacter: ',',
        allowDecimalPadding: false,
        decimalPlaces: 0,
        minimumValue: 0,
        modifyValueOnWheel: false
    }
    let tagihanNumeric = new AutoNumeric('#tagihan', autoNumericOptions);
    let biayaAdminNumeric = new AutoNumeric('#biaya_admin_bebas', autoNumericOptions);
    let paidNumeric = new AutoNumeric('#paid', autoNumericOptions);
    let dibayarNumeric = new AutoNumeric('#dibayar', autoNumericOptions);
    let sisaNumeric = new AutoNumeric('#sisa', autoNumericOptions);

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
</script>

<?php
function kirimEmailBebasan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bebasan, $dibayar, $kembalian, $status, $user)
{
    try {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.trijayasolution.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'noreply@trijayasolution.com';                     //SMTP username
        $mail->Password   = 'noreply@212';                               //SMTP password
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
        $mail->Body = ob_get_contents();
        ob_end_clean();

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit;
    }
}

function kirimEmailBulanan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bulanan, $dibayar, $kembalian, $status, $user)
{
    try {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.trijayasolution.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'noreply@trijayasolution.com';                     //SMTP username
        $mail->Password   = 'noreply@212';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('noreply@trijayasolution.com', 'No Reply');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $tanggal_now = new DateTime();
        include('format_email_bulanan.php');
        $mail->Body = ob_get_contents();
        ob_end_clean();

        // $mail->send();

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit;
    }
}
?>
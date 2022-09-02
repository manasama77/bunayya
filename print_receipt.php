<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
</head>

<?php
include "configuration/config_include.php";
include "configuration/config_all_stat.php";
connect();
$sql = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM data"));

$no   = $_GET['no'];
$tipe = $_GET['tipe'];

if ($tipe == '1') {
    $tabel                  = "bulanan";
    $a                      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM $tabel WHERE no='$no'"));
    $month                  = $a['month_id'];
    $e                      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM months WHERE month_id='$month'"));
    $judul_pembayaran       = "Bukti Pembayaran";
    $judul_pembayaran_table = "Pembayaran";
} else {
    $tabel                  = "bebasan";
    $a                      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM $tabel WHERE no='$no'"));
    $judul_pembayaran       = "Bukti Pelunasan";
    $judul_pembayaran_table = "Dibayarkan";
}

$siswa = $a['student_id'];
$b     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM student WHERE student_id='$siswa'"));
$kelas = $b['kelas_id'];

$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM class WHERE no='$kelas'"));

$jenis = $a['jenis_id'];
$c     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE jenis_id='$jenis'"));

$keterangan = null;
if ($jenis == 25) {
    $exec_pos_bayar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pos_bayar WHERE id = 16"));
    $keterangan     = $exec_pos_bayar['keterangan'];
}
?>


<body onload="window.print();">

    <!-- <body> -->
    <div style="font-size:6px; font-family:'Verdana'; width:100%;">
        <label style="font-size:8px; display:block; width:x; height:y; text-align:center; word-wrap: break-word;">
            <strong>
                <?= $sql['nama']; ?>
            </strong>
        </label>
        <p style="text-align:center;">
            <strong>
                <?= $sql['alamat']; ?><br />
                <?= $sql['notelp']; ?><br />
                <?= $sql['email']; ?><br />
            </strong>
        </p>
        <p style="text-align: center;"><?= $a['tgl_input']; ?> <?= date('H:i:s'); ?></p>
        <table style="width:100%">
            <tbody>
                <tr>
                    <td style="width: 10%; vertical-align:top; word-wrap: break-word;">Nama</td>
                    <td style="width: 5%; vertical-align:top;">:</td>
                    <td style="width: 85%; vertical-align:top;"><?= $b['nama']; ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?= $d['kelas']; ?></td>
                </tr>
            </tbody>
        </table>
        <table cellpadding="0" style="width:100%;">
            <tbody>
                <tr>
                    <td colspan="3" style="border:1px solid;"></td>
                </tr>
                <?php if ($tipe == 1) { ?>
                    <tr>
                        <td style="vertical-align: top;"><b>Pembayaran</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b><?= $c['nama'] . " T.A " . $c['tahunajar']; ?> (<?= $e['month_name']; ?>)</b><br />
                            <?php
                            if ($keterangan != null) {
                                echo '<small>' . $keterangan . '</small>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;"><b>Tagihan</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b><?= number_format($a['bulanan_bill'], 0); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;"><b>Biaya Admin</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b><?= number_format($a['biaya_admin'], 0); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;"><b>Pembayaran</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b><?= number_format($a['bulanan_bayar'], 0); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;"><b>Kembalian</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b><?= number_format($a['bulanan_bayar'] - $a['bulanan_bill'] - $a['biaya_admin'], 0); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;"><b>Status</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b>LUNAS</b>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td style="vertical-align: top;"><b>Pembayaran</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b><?= $c['nama'] . " T.A " . $c['tahunajar']; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;"><b>Tagihan</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b><?= number_format($a['bill'] + $a['biaya_admin'], 0); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;"><b>Pembayaran</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b><?= number_format($a['sudahbayar'], 0); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;"><b>Status</b></td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <b>LUNAS</b>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" style="border:1px solid;"></td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%">
            <tr>
                <td style="text-align: center; height: 30px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold; height: 5px;">
                    <u><?= $a['kasir']; ?></u><br />
                    (Petugas)
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold; height: 5px;">
                    Terima Kasih
                </td>
            </tr>
        </table>
        <br />
    </div>
    <hr style="border:1px solid;" />
</body>

</html>
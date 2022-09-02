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
    <div style="font-size:6px; font-family:'Verdana'; width:100%;">
        <label style="font-size:8px; display:block; width:x; height:y; text-align:center;">
            <strong>
                <?= $sql['nama']; ?>
            </strong>
        </label>
        <p style="text-align:center;">
            <strong>
                <small>
                    <?= $sql['alamat']; ?><br />
                    <?= $sql['notelp']; ?><br />
                    <?= $sql['email']; ?><br />
                </small>
            </strong>
        </p>
        <table style="width:100%">
            <tr>
                <td style="text-align: center; font-size: 8px; font-weight: bold;"><?= $judul_pembayaran; ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <?= $b['nis']; ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <?= $b['nama']; ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <?= $d['kelas']; ?> - <?= $c['tahunajar']; ?>
                </td>
            </tr>
        </table>
        <br>
        <table cellpadding="0" style="width:100%;">
            <thead>
                <tr>
                    <td colspan="4" style="border:1px solid;"></td>
                </tr>
                <tr>
                    <th style="width:7%; text-align:left; font-size: 6px;">No</th>
                    <th style="text-align:left; font-size: 6px;">Pembayaran</th>
                    <th style="width:20%; text-align:center; font-size: 6px;">Tagihan</th>
                    <th style="width:20%; text-align:center; font-size: 6px;">
                        <?= $judul_pembayaran_table; ?>
                    </th>
                </tr>
                <tr>
                    <td colspan="4" style="border:1px solid;"></td>
                </tr>
            </thead>
            <tbody style="font-size: 6px;">
                <?php if ($tipe == 1) { ?>
                    <tr>
                        <td style="vertical-align: top;">1</td>
                        <td style="vertical-align: top;">
                            <b><?= $c['nama'] . " T.A " . $c['tahunajar']; ?> (<?= $e['month_name']; ?>)</b> <br />
                            diterima pada <?= date('d/m/y', strtotime($a['tgl_input'])); ?>
                            <?php
                            if ($keterangan != null) {
                                echo '<br/><small>' . $keterangan . '</small>';
                            }
                            ?>
                        </td>
                        <td style="text-align: center; vertical-align: top;">
                            <?= number_format($a['bulanan_bill'], 3); ?>
                        </td>
                        <td style="text-align: center; vertical-align: top;">
                            <?= number_format($a['bulanan_bayar'], 3); ?>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td style="vertical-align: top;">1</td>
                        <td style="vertical-align: top;">
                            <b><?= $c['nama'] . " T.A " . $c['tahunajar']; ?></b> <br />
                            diterima pada <?= date('d/m/y', strtotime($a['tgl_input'])); ?>
                        </td>
                        <td style="text-align: right; vertical-align: top;">
                            <?= number_format($a['bill']); ?>
                        </td>
                        <td style="text-align: right; vertical-align: top;">
                            <?= number_format($a['sudahbayar']); ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" style="border:1px solid;"></td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%">
            <tr>
                <td style="text-align: center; font-size: 6px; font-weight: bold;">LUNAS</td>
            </tr>
            <tr>
                <td style="text-align: center; height: 30px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold;">
                    <u><?= $a['kasir']; ?></u><br />
                    (Petugas)
                </td>
            </tr>
        </table>
        <br />
    </div>
</body>

</html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

$id = $_GET['id'];

if (!$id) {
    echo "<script type='text/javascript'>alert('ID TIDAK DITEMUKAN');</script>";
    header("location:tabungan.php");
}

$sql  = "select * from log_tabungan where id = '$id'";
$exec = mysqli_query($conn, $sql);
$nr   = mysqli_num_rows($exec);

if ($nr == 0) {
    echo "<script type='text/javascript'>alert('ID TIDAK DITEMUKAN');</script>";
    header("location:tabungan.php");
}

$row                = mysqli_fetch_assoc($exec);
$id_master_tabungan = $row['id_master_tabungan'];
$nilai              = $row['nilai'];
$tipe               = $row['tipe'];

if ($tipe == "masuk") {
    $sql_x  = "update master_tabungan set tabungan = tabungan - $nilai where id = '$id_master_tabungan'";
    echo '<pre>' . print_r($sql_x, 1) . '</pre>';
    exit;
    $exec_x = mysqli_query($conn, $sql_x);
} else {
    $sql_x  = "update master_tabungan set tabungan = tabungan + $nilai where id = '$id_master_tabungan'";
    $exec_x = mysqli_query($conn, $sql_x);
}

$sql_d  = "delete from log_tabungan where id = '" . $id . "'";
$exec_d = mysqli_query($conn, $sql_d);

$sql_e  = "delete from uang_masuk_keluar where tabungan_id = '" . $id . "'";
$exec_e = mysqli_query($conn, $sql_d);

echo "<script type='text/javascript'>alert('DELETE BERHASIL');</script>";
header("location:tabungan.php");

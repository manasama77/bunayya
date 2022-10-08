<?php
include 'configuration/config_connect.php';
require 'vendor/autoload.php';

use Midtrans\Config;
use Midtrans\Transaction;

Config::$serverKey = "SB-Mid-server-B68UlkxCiQcNxTHltyysL5ke";

$sql = "select * from pembayaran_midtrans where transaction_status = 'pending'";
// $sql = "select * from pembayaran_midtrans";
$query = mysqli_query($conn, $sql);
$nr = mysqli_num_rows($query);

if ($nr == 0) {
    exit;
}

while ($row = mysqli_fetch_assoc($query)) {
    $id            = $row['id'];
    $token         = $row['token'];
    $payment_table = $row['payment_table'];
    $payment_no    = $row['payment_no'];
    $payment_name  = $row['payment_name'];
    $student_id    = $row['student_id'];

    $trans              = Transaction::status($id);
    $transaction_time   = $trans->transaction_time;
    $transaction_id     = $trans->transaction_id;
    $transaction_status = $trans->transaction_status;
    $gross_amount       = $trans->gross_amount;
    $payment_type       = $trans->payment_type;

    $sql_midtrans = "
    update pembayaran_midtrans 
    set 
        transaction_time   = '$transaction_time',
        transaction_status = '$transaction_status',
        transaction_id     = '$transaction_id',
        gross_amount       = '$gross_amount',
        payment_type       = '$payment_type'
    where id = '$id';
    ";
    $query_midtrans = mysqli_query($conn, $sql_midtrans);

    if ($transaction_status == "settlement") {
        if ($payment_table == "bulanan") {
            $sql_md     = "select student_id from pembayaran_midtrans where id = '$id'";
            $query_md   = mysqli_query($conn, $sql_md);
            $row_md     = mysqli_fetch_assoc($query_md);
            $student_id = $row_md['student_id'];

            $sql_siswa   = "select nama from student where student_id = '$student_id'";
            $query_siswa = mysqli_query($conn, $sql_siswa);
            $row_siswa   = mysqli_fetch_assoc($query_siswa);

            $sql_pembayaran = "
                UPDATE bulanan 
                SET 
                    bulanan_status = 'sudah',
                    bulanan_bayar  = '" . $gross_amount . "',
                    kasir          = '" . $row_siswa['nama'] . "',
                    tgl_input      = '" . date('Y-m-d') . "'
                WHERE no= '" . $payment_no . "'
            ";
            $query_pembayaran = mysqli_query($conn, $sql_pembayaran);

            $sql_bulanan   = "SELECT * FROM bulanan WHERE no = '" . $payment_no . "'";
            $query_bulanan = mysqli_query($conn, $sql_bulanan);
            $arr_bulanan   = mysqli_fetch_assoc($query_bulanan);
            $period_id     = $arr_bulanan['period_id'];

            $sql_uang_masuk = "
                INSERT INTO uang_masuk_keluar 
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
                    tgl_update,
                    tgl_input,
                    jenis_pembayaran
                )
                VALUES 
                (
                    'pay',
                    '" . $payment_name . "',
                    'pembayaran bulanan',
                    '" . $gross_amount . "',
                    'siswa',
                    '1',
                    '" . $student_id . "',
                    '" . $period_id . "',
                    '0',
                    '" . $payment_no . "',
                    '" . date('Y-m-d') . "',
                    '" . date('Y-m-d') . "', 
                    'transfer'
                )
            ";
            $query_uang_masuk = mysqli_query($conn, $sql_uang_masuk);
        }
    }
}

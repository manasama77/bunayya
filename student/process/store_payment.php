<?php
require "../../configuration/config_connect.php";
require __DIR__ . '../../../vendor/autoload.php';
session_start();

use Midtrans\Config;
use Midtrans\Snap;

Config::$serverKey    = "SB-Mid-server-pIjcTHoz8CGfbFJuZK7d6iZi";
Config::$isProduction = false;
Config::$isSanitized  = true;
Config::$is3ds        = true;

$no             = $_POST['no'];
$nama_tagihan   = $_POST['nama_tagihan'];
$tagihan        = $_POST['tagihan'];
$biaya_admin    = $_POST['biaya_admin'];
$jumlah_tagihan = $_POST['jumlah_tagihan'];
$email          = $_POST['email'];

$sql         = "SELECT * FROM student WHERE nis = '" . $_SESSION['nis'] . "'";
$arr_student = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$nama_siswa  = $arr_student['nama'];
$waortu      = $arr_student['waortu'];

$sql     = "INSERT INTO pembayaran_midtrans (bulanan_no, token, transaction_time, transaction_status, transaction_id, payment_type) VALUES ('$no', '$token', null, 'pending', null, null)";
$exec    = mysqli_query($conn, $sql);
$last_id = mysqli_insert_id($conn);

$params = [
    'transaction_details' => [
        'order_id'     => $last_id,
        'gross_amount' => $jumlah_tagihan,
    ],
    'item_details' => [
        [
            'id'       => $no,
            'price'    => $jumlah_tagihan,
            'quantity' => 1,
            'name'     => $nama_tagihan,
        ]
    ],
    'customer_details' => [
        [
            'first_name' => $nama_siswa,
            'email'      => $email,
            'phone'      => $waortu,
        ]
    ],
    'enabled_payments' => [
        'bca_klikbca',
        'bca_klikpay',
        'bri_epay',
        'bca_va',
        'echannel',
        'permata_va',
        'bni_va',
        'bri_va',
        'other_va',
        'gopay',
        'indomaret',
        'danamon_online',
        'akulaku',
        'shopeepay',
        'kredivo',
    ],
];

$token = Snap::getSnapToken($params);

if (!$exec) {
    echo "Proses Insert Token Gagal";
    exit;
}

$sql = "UPDATE pembayaran_midtrans SET token = '" . $token . "' id = '" . $last_id . "'";
mysqli_query($conn, $sql);

$_SESSION['snap_token'] = $token;
header('location:../pembayaran_midtrans.php');

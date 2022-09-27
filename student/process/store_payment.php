<?php
require "../../configuration/config_connect.php";
require __DIR__ . '../../../vendor/autoload.php';
session_start();

use Midtrans\Config;
use Midtrans\Snap;
use Ramsey\Uuid\Uuid;

Config::$serverKey    = "SB-Mid-server-B68UlkxCiQcNxTHltyysL5ke";
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

$uuid = Uuid::uuid4();
$sql     = "INSERT INTO pembayaran_midtrans (id, bulanan_no, token, transaction_time, transaction_status, transaction_id, payment_type) VALUES ('" . $uuid->toString() . "', '$no', null, null, 'pending', null, null)";
$exec    = mysqli_query($conn, $sql);

$params = [
    'transaction_details' => [
        'order_id'     => $uuid,
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

$sql = "UPDATE pembayaran_midtrans SET token = '" . $token . "' WHERE id = '" . $uuid->toString() . "'";
mysqli_query($conn, $sql);

$_SESSION['snap_token'] = $token;
header('location:../pembayaran_midtrans.php');

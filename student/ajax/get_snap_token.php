<?php
require "../../configuration/config_connect.php";
require __DIR__ . '../../../vendor/autoload.php';
session_start();

use Midtrans\Snap;
use Midtrans\Config;
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
$payment_table  = strtolower($_POST['payment_table']);
$email          = $_POST['email'];

$sql         = "SELECT * FROM student WHERE nis = '" . $_SESSION['nis'] . "'";
$arr_student = mysqli_fetch_assoc(mysqli_query($conn, $sql));

$nama_siswa = $arr_student['nama'];
$waortu     = $arr_student['waortu'];

$uuid = Uuid::uuid4();
$sql     = "INSERT INTO pembayaran_midtrans (id, payment_no, token, transaction_time, transaction_status, transaction_id, payment_type, gross_amount, payment_table, payment_name, student_id) VALUES ('" . $uuid->toString() . "', '$no', null, null, 'pending', null, null, '$jumlah_tagihan', '$payment_table', '$nama_tagihan', '" . $_SESSION['id'] . "')";
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

$snapToken = Snap::getSnapToken($params);

$code    = 500;
$token   = null;
$message = $snapToken;

if ($snapToken) {
    $code    = 200;
    $token   = $snapToken;
    $message = "Token Created";

    $sql = "UPDATE pembayaran_midtrans SET token = '" . $token . "' WHERE id = '" . $uuid->toString() . "'";
    mysqli_query($conn, $sql);
}

echo json_encode([
    'code'    => $code,
    'token'   => $token,
    'message' => $message,
]);

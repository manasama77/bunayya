<?php

include '../configuration/config_connect.php';
header('Content-Type: application/json; charset=utf-8');
$no = $_POST['no'];

$sql   = "select * from pembayaran_midtrans where payment_no = '" . $no . "' and payment_status = 'pending'";
$query = mysqli_query($conn, $sql);
$nr    = mysqli_num_rows($query);

if ($nr == 0) {
    echo json_encode([
        'code' => 404,
        'message' => 'Pembayaran Tidak Ditemukan',
    ]);
    exit;
}

$row = mysqli_fetch_assoc($query);
echo json_encode([
    'code'    => 200,
    'message' => $row['token'],
]);
exit;

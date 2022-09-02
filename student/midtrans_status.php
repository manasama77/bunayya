<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "[405] Method Get Not Allowed";
    exit;
}

require "../configuration/config_connect.php";
require __DIR__ . '../../vendor/autoload.php';
session_start();

use Midtrans\Config;
use Midtrans\Notification;

Config::$serverKey    = "SB-Mid-server-pIjcTHoz8CGfbFJuZK7d6iZi";
Config::$isProduction = false;
Config::$isSanitized  = true;
Config::$is3ds        = true;

$notif = new Notification();

$transaction_id     = $notif->transaction_id;
$transaction_status = $notif->transaction_status;
$transaction_time   = $notif->transaction_time;
$payment_type       = $notif->payment_type;
$order_id           = $notif->order_id;
$fraud_status       = $notif->fraud_status;

if ($transaction_status == 'capture') {

    if ($fraud_status == 'challenge') {
        // Buat Query dan update status nya 'challenge'
        $sql = "UPDATE pembayaran_midtrans SET transaction_time = '" . $transaction_time . "', transaction_status = '" . $transaction_status . "' transaction_id = '" . $transaction_id . "', payment_type = '" . $payment_type . "' WHERE id = '" . $order_id . "'";
        mysqli_query($conn, $sql);
    } else if ($fraud_status == 'accept') {
        // Buat Query dan update status nya 'success'
        $sql = "UPDATE pembayaran_midtrans SET transaction_time = '" . $transaction_time . "', transaction_status = '" . $transaction_status . "' transaction_id = '" . $transaction_id . "', payment_type = '" . $payment_type . "' WHERE id = '" . $order_id . "'";
        mysqli_query($conn, $sql);
    }
} else if ($transaction_status == 'cancel') {

    if ($fraud_status == 'challenge') {
        // Buat Query dan update status nya 'failure'
        $sql = "UPDATE pembayaran_midtrans SET transaction_time = '" . $transaction_time . "', transaction_status = '" . $transaction_status . "' transaction_id = '" . $transaction_id . "', payment_type = '" . $payment_type . "' WHERE id = '" . $order_id . "'";
        mysqli_query($conn, $sql);
    } else if ($fraud_status == 'accept') {
        // Buat Query dan update status nya 'failure'
        $sql = "UPDATE pembayaran_midtrans SET transaction_time = '" . $transaction_time . "', transaction_status = '" . $transaction_status . "' transaction_id = '" . $transaction_id . "', payment_type = '" . $payment_type . "' WHERE id = '" . $order_id . "'";
        mysqli_query($conn, $sql);
    }
} else if ($transaction_status == 'deny') {
    // Buat Query dan update status nya 'failure'
    $sql = "UPDATE pembayaran_midtrans SET transaction_time = '" . $transaction_time . "', transaction_status = '" . $transaction_status . "' transaction_id = '" . $transaction_id . "', payment_type = '" . $payment_type . "' WHERE id = '" . $order_id . "'";
    mysqli_query($conn, $sql);
}

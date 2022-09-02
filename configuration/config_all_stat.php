<?php
include 'config_connect.php';
date_default_timezone_set("Asia/Jakarta");
$h      = date('d');
$b      = date('m');
$t      = date('Y');
$now    = date('Y-m-d');
$b1     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT month_id, month_name FROM months WHERE status='active'"));
$mon    = $b1['month_id'];
$moname = $b1['month_name'];

$b2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT no FROM periode WHERE status='active'"));
$t  = $b2['no'];


//nama app
$sqla = mysqli_query($conn, "SELECT app FROM backset");
$ape1 = mysqli_fetch_assoc($sqla);
$app  = $ape1['app'];


//dashboard card

$a1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM student"));
$a2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as expense FROM uang_masuk_keluar WHERE tipe='out' AND tgl_update='$now'"));
$a3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as income FROM uang_masuk_keluar WHERE tipe!='out' AND tgl_update='$now'"));
$a4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bulanan_bill) as outstanding FROM bulanan WHERE period_id='$t' AND month_id<='$mon' AND bulanan_status LIKE 'belum'"));


//student page
$b1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(student_id) as inactive FROM student WHERE status='inactive'"));
$b2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(student_id) as active FROM student WHERE status='active'"));

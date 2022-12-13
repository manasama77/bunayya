<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

include 'configuration/config_connect.php';
include "configuration/config_include.php";
include "configuration/config_all_stat.php";

session();

$nis = 22231001;
$sql_student = "select * from student where nis = '22231001'";
$query_student = mysqli_query($conn, $sql_student);
$nr_student = mysqli_num_rows($query_student);

if ($nr_student == 0) {
    echo "<script type='text/javascript'>  alert('Student Not Found');</script>";
    echo "<script type='text/javascript'>window.location = 'pay_add?t=$t&s=$s';</script>";
}
$row_student = mysqli_fetch_assoc($query_student);

$user = $_SESSION['nama'];
$email = "adam.pm77@gmail.com";
if ($email) {
    $subject = "test";

    $sql_tahun_ajar = "select * from periode where no = '6'";
    $query_tahun_ajar = mysqli_query($conn, $sql_tahun_ajar);
    $row_tahun_ajar = mysqli_fetch_assoc($query_tahun_ajar);

    $id_kelas = 21;
    $sql_kelas = "select * from class where no = '$id_kelas'";
    $query_kelas = mysqli_query($conn, $sql_kelas);
    $row_kelas = mysqli_fetch_assoc($query_kelas);

    $no = 3756;
    $sql_bebasan   = "select * from bulanan where no = '$no'";
    $query_bebasan = mysqli_query($conn, $sql_bebasan);
    $row_bebasan   = mysqli_fetch_assoc($query_bebasan);

    $dibayar = 1;
    $tagih = 1;
    $biaya_admin = 1;
    $kembalian = $dibayar - $tagih + $biaya_admin;
    $status = "Lunas";

    kirimEmailBulanan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bebasan, $dibayar, $kembalian, $status, $user);
}

function kirimEmailBulanan($email, $subject, $row_student, $row_tahun_ajar, $row_kelas, $row_bulanan, $dibayar, $kembalian, $status, $user)
{
    try {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.trijayasolution.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'noreply@trijayasolution.com';                     //SMTP username
        $mail->Password   = 'noreply@212';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('noreply@trijayasolution.com', 'No Reply');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $tanggal_now = new DateTime();
        ob_start();
        include('format_email_bebasan.php');
        $mail->Body = ob_get_contents();
        ob_end_clean();

        // $mail->send();

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit;
    }
}

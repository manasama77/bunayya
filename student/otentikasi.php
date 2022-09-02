<?php
error_reporting(0);
session_start();

include "configuration/config_include.php";
include "configuration/config_connect.php";
connect();
timing();

$username = $password = "";


$tabeldatabase = "student"; // tabel database
$forward = mysqli_real_escape_string($conn, $tabeldatabase);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $captcha = $_POST["captcha"];
  $captchaUser = filter_var($_POST["captcha"], FILTER_SANITIZE_STRING);
  if (empty($captcha)) {
    return header("Location: login?msg=captcha");
  } elseif ($_SESSION['CAPTCHA_CODE'] != $captchaUser) {
    return header("Location: login?msg=captcha");
  }

  $username = $_POST['txtuser'];
  $password = mysqli_real_escape_string($conn, $_POST['txtpass']);
  $password = md5($password);
  $password = sha1($password);

  $sql = "select * from $forward where nis='$username' and password='$password'";

  $hasil = mysqli_query($conn, $sql);
  if (mysqli_num_rows($hasil) > 0) {
    $data = mysqli_fetch_assoc($hasil);
    $_SESSION['nis'] = $data['nis'];
    $_SESSION['nisn'] = $data['nisn'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['kelas'] = $data['kelas_id'];
    $_SESSION['avatar'] = $data['avatar'];
    $_SESSION['jabatan'] = "siswa";
    $_SESSION['id'] = $data['student_id'];
    $_SESSION['baseurl'] = $baseurl;

    login_validate();
    header("Location: index");
  } else {


    header("Location: login?msg=0");
  }
}

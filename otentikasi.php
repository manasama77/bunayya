<?php
error_reporting(0);
session_start();

include "configuration/config_include.php";
include 'configuration/config_connect.php';
connect();
timing();

$username = $password = "";


$tabeldatabase = "user"; // tabel database
$forward = mysqli_real_escape_string($conn, $tabeldatabase);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['txtuser']);
  $password = mysqli_real_escape_string($conn, $_POST['txtpass']);
  $password = md5($password);
  $password = sha1($password);

  $sql = "select * from $forward where userna_me='$username' and pa_ssword='$password'";



  $hasil = mysqli_query($conn, $sql);
  if (mysqli_num_rows($hasil) > 0) {
    $data = mysqli_fetch_assoc($hasil);
    $_SESSION['username'] = $data['userna_me'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['jabatan'] = $data['jabatan'];
    $_SESSION['avatar'] = $data['avatar'];
    $_SESSION['nouser'] = $data['no'];
    $_SESSION['baseurl'] = $baseurl;
    $_SESSION['auth'] = "petugas";
    login_validate();
    header("Location: index");
  } else {

    $captcha = $_POST["captcha"];
    $captchaUser = filter_var($_POST["captcha"], FILTER_SANITIZE_STRING);
    if (empty($captcha)) {
      return header("Location: login_admin?msg=captcha");
    } elseif ($_SESSION['CAPTCHA_CODE'] != $captchaUser) {
      return header("Location: login_admin?msg=captcha");
    }

    $sqla = "SELECT * FROM $forward WHERE email='$username' AND pa_ssword='$password'";
    $result = mysqli_query($conn, $sqla);

    if (mysqli_num_rows($result) > 0) {

      $data = mysqli_fetch_assoc($result);
      $_SESSION['username'] = $data['userna_me'];
      $_SESSION['email'] = $data['email'];
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['jabatan'] = $data['jabatan'];
      $_SESSION['avatar'] = $data['avatar'];
      $_SESSION['nouser'] = $data['no'];
      $_SESSION['baseurl'] = $baseurl;
      $_SESSION['auth'] = "petugas";
      login_validate();
      header("Location: index");
    } else {
      header("Location: login_admin?msg=0");
    }
  }
}

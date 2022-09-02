
  <link href="assets/libs/spinkit/spinkit.css" rel="stylesheet" type="text/css" >

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />
 
 <table width="100%" align="center" cellspacing="0">



  <tr>
    <td height="500px" align="center" valign="middle">
      Sedang Menghapus ....
       <div class="sk-wave">
                                        <div class="sk-rect sk-rect1"></div>
                                        <div class="sk-rect sk-rect2"></div>
                                        <div class="sk-rect sk-rect3"></div>
                                        <div class="sk-rect sk-rect4"></div>
                                        <div class="sk-rect sk-rect5"></div>
                                    </div>
    </td>
  </tr>
</table>


<?php 
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
include "configuration/config_include.php";
connect();session();


$resetlah=$_GET['reset'];

sleep(10);


 if(isset($resetlah)){
       if($_SERVER["REQUEST_METHOD"] == "GET"){

$user = $_SESSION['username'];

$sql = "SELECT userna_me FROM user where userna_me = '$user' ";

$result=mysqli_query($conn,$sql);

                  if(mysqli_num_rows($result)>0){

$trun1 = mysqli_query($conn, 'TRUNCATE TABLE bebasan');
$trun2 = mysqli_query($conn, 'TRUNCATE TABLE bebasan_pay');
$trun3 = mysqli_query($conn, 'TRUNCATE TABLE bulanan ');
$trun4 = mysqli_query($conn, 'TRUNCATE TABLE class ');
$trun5 = mysqli_query($conn, 'TRUNCATE TABLE events ');
$trun6 = mysqli_query($conn, 'TRUNCATE TABLE graduation ');
$trun7 = mysqli_query($conn, 'TRUNCATE TABLE jenis_bayar ');
$trun8 = mysqli_query($conn, 'TRUNCATE TABLE periode ');
$trun9 = mysqli_query($conn, 'TRUNCATE TABLE pos_bayar ');
$trun10 = mysqli_query($conn, 'TRUNCATE TABLE uang_masuk_keluar ');
$trun11 = mysqli_query($conn, 'TRUNCATE TABLE student ');


if ($trun11){
   echo "<script type='text/javascript'>window.location = 'set_keamanan?reset=true';</script>";
   

} else { echo "<script type='text/javascript'>window.location = 'set_keamanan?reset=false';</script>";

                    }
} }
}

?>
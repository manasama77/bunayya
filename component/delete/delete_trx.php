<?php
include "../../configuration/config_connect.php";
include "../../configuration/config_session.php";
include "../../configuration/config_chmod.php";
include "../../configuration/config_etc.php";
$forward =$_GET['forward'];
$no = $_GET['no'];
$chmod = $_GET['chmod'];
$forwardpage = $_GET['forwardpage'];
$jenis=$_GET['jenis'];
$akun=$_GET['akun'];
$jml=$_GET['jumlah'];
?>
<link href="../../assets/libs/spinkit/spinkit.css" rel="stylesheet" type="text/css" >
                                   


<?php
if( $chmod == '4' || $chmod == '5' || $_SESSION['jabatan'] =='admin' || $_SESSION['jabatan'] == 'guru'){

 $sql = "delete from $forward where no='".$no."'";
 if (mysqli_query($conn, $sql)) {


    if($jenis=='income'){
        $cek=mysqli_fetch_assoc(mysqli_query($conn, "SELECT debit FROM coa WHERE akun='$akun'"));
             $debit=$cek['debit']-$jml;
              $up=mysqli_query($conn, "UPDATE coa SET debit='$debit' WHERE akun='$akun'");
    } else {
      $cek=mysqli_fetch_assoc(mysqli_query($conn, "SELECT kredit FROM coa WHERE akun='$akun'"));
             $kredit=$cek['kredit']-$jml;
              $up=mysqli_query($conn, "UPDATE coa SET kredit='$kredit' WHERE akun='$akun'");
    }


 ?>

  <body onload="setTimeout(function() { document.frm1.submit() }, 10)">
  <form action="<?php echo $baseurl; ?>/<?php echo $forwardpage;?>" name="frm1" method="post">

  <input type="hidden" name="hapusberhasil" value="1" />

<?php
 } else{
 ?>   <body onload="setTimeout(function() { document.frm1.submit() }, 10)">
	  <input type="hidden" name="hapusberhasil" value="2" />
 <?php
 }
}
else{

 ?>
  <body onload="setTimeout(function() { document.frm1.submit() }, 10)">
   <form action="<?php echo $baseurl; ?>/<?php echo $forwardpage;?>" name="frm1" method="post">


	  <input type="hidden" name="hapusberhasil" value="2" />
 <?php
 }
?>
<table width="100%" align="center" cellspacing="0">
  <tr>
    <td height="500px" align="center" valign="middle">
      
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


   </form>
<meta http-equiv="refresh" content="10;url=jump?forward=<?php echo $forward.'&';?>forwardpage=<?php echo $forwardpage.'&'; ?>chmod=<?php echo $chmod; ?>">
</body>

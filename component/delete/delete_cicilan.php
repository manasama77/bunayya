<?php
include "../../configuration/config_connect.php";
include "../../configuration/config_session.php";
include "../../configuration/config_chmod.php";
include "../../configuration/config_etc.php";
$forward =$_GET['forward'];
$no = $_GET['no'];
$chmod = $_GET['chmod'];
$forwardpage = $_GET['forwardpage'];
$jml= $_GET['jml'];
$kode= $_GET['kode'];
$pos=$_GET['akun'];

?>
<link href="../../assets/libs/spinkit/spinkit.css" rel="stylesheet" type="text/css" >
                                   


<?php
if( $chmod == '4' || $chmod == '5' || $_SESSION['jabatan'] =='admin' || $_SESSION['jabatan'] == 'guru'){

 $sql = "delete from $forward where no='".$no."'";
 if (mysqli_query($conn, $sql)) {

$cek=mysqli_fetch_assoc(mysqli_query($conn, "SELECT sudahbayar,akun_pinjam FROM akun_pinjaman WHERE kode='$kode'"));
             $sdh=$cek['sudahbayar']-$jml;
            $pj=$cek['akun_pinjam'];

               $up=mysqli_query($conn, "UPDATE akun_pinjaman SET sudahbayar='$sdh', status='diubah' WHERE kode='$kode'");

$ceka=mysqli_fetch_assoc(mysqli_query($conn, "SELECT kredit FROM coa WHERE akun='$pj'"));
             $kr=$ceka['kredit']-$jml;

                $up1=mysqli_query($conn, "UPDATE coa SET kredit='$kr' WHERE akun='$pj'");

             $ceke=mysqli_fetch_assoc(mysqli_query($conn, "SELECT kredit FROM coa WHERE akun='$pos'"));
             $kre=$ceke['kredit']-$jml;
             
                  
                            $up2=mysqli_query($conn, "UPDATE coa SET kredit='$kre' WHERE akun='$pos'");


 ?>

  <body onload="setTimeout(function() { document.frm1.submit() }, 10)">
  <form action="<?php echo $baseurl; ?>/<?php echo $forwardpage;?>?kode=<?php echo $kode;?>" name="frm1" method="post">

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
   <form action="<?php echo $baseurl; ?>/<?php echo $forwardpage;?>?kode=<?php echo $kode;?>" name="frm1" method="post">


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

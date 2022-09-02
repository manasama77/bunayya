<?php

require_once('configuration/config_connect.php');
//echo $_POST['title'];
if (isset($_POST['kategori']) && isset($_POST['kodewarna']) && isset($_POST['save']) ){
	
	$kat = $_POST['kategori'];
	$warna = $_POST['kodewarna'];
	

	$sql = mysqli_query($conn,"INSERT INTO event_colors values ('', '$kat', '$warna')");
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	
}


 if (isset($_POST['kasave']) ){

	$kat = $_POST['kat'];
	$warna = $_POST['katcolor'];
	$no = $_POST['katid'];

	if(isset($_POST['hapus'])){

$sql21=mysqli_query($conn,"DELETE FROM event_colors WHERE no='$no'");

	} else {
$sql3=mysqli_query($conn,"UPDATE event_colors SET warna='$kat',kodewarna='$warna' WHERE no='$no'");
	}

}


header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>

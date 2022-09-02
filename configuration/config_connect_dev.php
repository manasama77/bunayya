<?php

error_reporting(E_ALL ^ E_DEPRECATED);
$servername = "localhost";
$username = "u8625483_smabunayya";
$password = "smabunayya";
$dbname="u8625483_smabunaya";

   	// Create connection
	global $conn;
	$conn = mysqli_connect($servername, $username, $password,$dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	try
{
	$bdd = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', ''.$username.'', ''.$password.'');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}

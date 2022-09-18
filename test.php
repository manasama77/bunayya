<?php
include 'configuration/config_connect.php';

$sql = "insert into test (name) values ('test cron')";
$query = mysqli_query($conn, $sql);

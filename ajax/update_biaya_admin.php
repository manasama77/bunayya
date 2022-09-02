<?php
include "../configuration/config_include.php";
include "../configuration/config_all_stat.php";

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);

$biaya = $decoded['biaya'];

$sql = "UPDATE biaya_admin SET biaya = " . $biaya . " WHERE id = 1";
if (mysqli_query($conn, $sql)) {
    echo json_encode(['code' => 200]);
} else {
    echo json_encode(['code' => 500]);
}

mysqli_close($conn);

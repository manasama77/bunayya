<?php
include "../configuration/config_include.php";
include "../configuration/config_all_stat.php";

$id = $_GET['id'];

if (!$id) {
    echo json_encode([
        'code' => 500,
        'data' => []
    ]);
    exit;
}

$sql = "
select 
    log_tabungan.id,
    log_tabungan.tanggal_transaksi,
    log_tabungan.nilai,
    log_tabungan.tipe
from log_tabungan 
where log_tabungan.id_master_tabungan = '" . $id . "'
order by log_tabungan.tanggal_transaksi desc
";

$query = mysqli_query($conn, $sql);
$nr    = mysqli_num_rows($query);
if ($nr > 0) {
    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $tgl_obj = new DateTime($row['tanggal_transaksi']);
        $nested['id']                = $row['id'];
        $nested['tanggal_transaksi'] = $tgl_obj->format('d M Y H:i');
        $nested['nilai']             = $row['nilai'];
        $nested['tipe']              = $row['tipe'];
        array_push($data, $nested);
    }
    echo json_encode([
        'code' => 200,
        'data' => $data,
    ]);
} else {
    echo json_encode([
        'code' => 404,
        'data' => []
    ]);
}

mysqli_close($conn);

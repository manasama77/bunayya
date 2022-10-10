<?php
include "../configuration/config_include.php";
include "../configuration/config_all_stat.php";

$id_kelas = $_POST['id_kelas'];
$id_siswa = $_POST['id_siswa'];
$tipe     = $_POST['tipe'];
$nilai    = $_POST['nilai'];

$sql_tabungan   = "select id, tabungan from master_tabungan where id_siswa = '" . $id_siswa . "'";
$query_tabungan = mysqli_query($conn, $sql_tabungan);
$nr_tabungan    = mysqli_num_rows($query_tabungan);

$tanggal_transaksi = date('Y-m-d H:i:s');

if ($tipe == "keluar") {
    if ($nr_tabungan == 0) {
        echo json_encode([
            'code'    => 400,
            'message' => "Saldo tidak mencukupi",
            'saldo'   => 0,
            'data'    => []
        ]);
        exit;
    }

    $row      = mysqli_fetch_assoc($query_tabungan);
    $tabungan = $row['tabungan'];

    if ($nilai > $tabungan) {
        echo json_encode([
            'code'    => 400,
            'message' => "Saldo tidak mencukupi",
            'saldo'   => $tabungan,
            'data'    => []
        ]);
        exit;
    }
}

if ($nr_tabungan == 0) {
    // insert baru
    $sql                = "insert into master_tabungan (id_siswa, tabungan) values ('$id_siswa', '$nilai')";
    $exec               = mysqli_query($conn, $sql);
    $id_master_tabungan = mysqli_insert_id($conn);

    $sql = "insert into log_tabungan (tanggal_transaksi, id_master_tabungan, nilai, tipe) values ('$tanggal_transaksi', '$id_master_tabungan', '$nilai', '$tipe')";
    $exec = mysqli_query($conn, $sql);

    echo json_encode([
        'code'    => 200,
        'message' => "success",
        'saldo'   => $nilai,
        'data'    => [],
    ]);
    exit;
} else {
    if ($tipe == "masuk") {
        $row      = mysqli_fetch_assoc($query_tabungan);
        $id       = $row['id'];
        $tabungan = $row['tabungan'];

        $sql = "update master_tabungan set tabungan = tabungan + '$nilai' where id = '$id'";
        $exec = mysqli_query($conn, $sql);

        $sql = "insert into log_tabungan (tanggal_transaksi, id_master_tabungan, nilai, tipe) values ('$tanggal_transaksi', '$id', '$nilai', '$tipe')";
        $exec = mysqli_query($conn, $sql);

        echo json_encode([
            'code'    => 200,
            'message' => "success",
            'saldo'   => $nilai + $tabungan,
            'data'    => [],
        ]);
        exit;
    } else {
        $sql_tabungan   = "select id, tabungan from master_tabungan where id_siswa = '" . $id_siswa . "'";
        $query_tabungan = mysqli_query($conn, $sql_tabungan);
        $nr_tabungan    = mysqli_num_rows($query_tabungan);

        $row      = mysqli_fetch_assoc($query_tabungan);
        $id       = $row['id'];
        $tabungan = $row['tabungan'];

        $sql = "update master_tabungan set tabungan = tabungan - '$nilai' where id = '$id'";
        $exec = mysqli_query($conn, $sql);

        $sql = "insert into log_tabungan (tanggal_transaksi, id_master_tabungan, nilai, tipe) values ('$tanggal_transaksi', '$id', '$nilai', '$tipe')";
        $exec = mysqli_query($conn, $sql);

        echo json_encode([
            'code'    => 200,
            'message' => "success",
            'saldo'   => $tabungan - $nilai,
            'data'    => [],
        ]);
        exit;
    }
}

mysqli_close($conn);

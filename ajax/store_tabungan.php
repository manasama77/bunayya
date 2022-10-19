<?php
include "../configuration/config_include.php";
include "../configuration/config_all_stat.php";

session_start();

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

    $sql     = "insert into log_tabungan (tanggal_transaksi, id_master_tabungan, nilai, tipe) values ('$tanggal_transaksi', '$id_master_tabungan', '$nilai', '$tipe')";
    $exec    = mysqli_query($conn, $sql);
    $last_id = mysqli_insert_id($conn);

    $sql_siswa   = "select * from student where student_id = '" . $id_siswa . "'";
    $query_siswa = mysqli_query($conn, $sql_siswa);
    $nr_siswa    = mysqli_num_rows($query_siswa);
    if ($nr_siswa == 0) {
        echo json_encode([
            'code'    => 500,
            'message' => "Siswa not found",
            'saldo'   => 0,
            'data'    => [],
        ]);
        exit;
    }
    $row_siswa            = mysqli_fetch_assoc($query_siswa);
    $nis_siswa            = $row_siswa['nis'];
    $nama_siswa           = $row_siswa['nama'];
    $nama_transaksi       = "Tabungan";
    $keterangan_transaksi = "Tabungan $nis_siswa $nama_siswa";
    $kasir                = $_SESSION['nama'];
    $kategori_id          = 9998;                                 // id dari table uang_kategori;

    $sql_periode   = "select * from periode where status = 'active'";
    $query_periode = mysqli_query($conn, $sql_periode);
    $nr_periode    = mysqli_num_rows($query_periode);
    if ($nr_periode == 0) {
        echo json_encode([
            'code'    => 500,
            'message' => "Periode not found",
            'saldo'   => 0,
            'data'    => [],
        ]);
        exit;
    }
    $row_period  = mysqli_fetch_assoc($query_periode);
    $period_name = $row_period['period_name'];

    $now = date("Y-m-d");

    $sql_uang = "insert into uang_masuk_keluar 
    (
        tipe, 
        nama, 
        keterangan,
        jumlah,
        kasir,
        kategori_id,
        student_id,
        period_id,
        bebas_id,
        bulanan_id,
        tabungan_id,
        tgl_update,
        tgl_input,
        jenis_pembayaran
    )
    VALUES
    (
        'in',
        '$keterangan_transaksi',
        '$keterangan_transaksi',
        '$nilai',
        '$kasir',
        '$kategori_id',
        '$id_siswa',
        '$period_name',
        '0',
        '0',
        '$last_id',
        '$now',
        '$now',
        'cash'
    )
    ";
    $query_uang = mysqli_query($conn, $sql_uang);

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
        $last_id = mysqli_insert_id($conn);

        $sql_siswa   = "select * from student where student_id = '" . $id_siswa . "'";
        $query_siswa = mysqli_query($conn, $sql_siswa);
        $nr_siswa    = mysqli_num_rows($query_siswa);
        if ($nr_siswa == 0) {
            echo json_encode([
                'code'    => 500,
                'message' => "Siswa not found",
                'saldo'   => 0,
                'data'    => [],
            ]);
            exit;
        }
        $row_siswa            = mysqli_fetch_assoc($query_siswa);
        $nis_siswa            = $row_siswa['nis'];
        $nama_siswa           = $row_siswa['nama'];
        $nama_transaksi       = "Tabungan";
        $keterangan_transaksi = "Tabungan $nis_siswa $nama_siswa";
        $kasir                = $_SESSION['nama'];
        $kategori_id          = 9998;                                 // id dari table uang_kategori;

        $sql_periode   = "select * from periode where status = 'active'";
        $query_periode = mysqli_query($conn, $sql_periode);
        $nr_periode    = mysqli_num_rows($query_periode);
        if ($nr_periode == 0) {
            echo json_encode([
                'code'    => 500,
                'message' => "Periode not found",
                'saldo'   => 0,
                'data'    => [],
            ]);
            exit;
        }
        $row_period  = mysqli_fetch_assoc($query_periode);
        $period_name = $row_period['period_name'];

        $now = date("Y-m-d");

        $sql_uang = "insert into uang_masuk_keluar 
        (
            tipe, 
            nama, 
            keterangan,
            jumlah,
            kasir,
            kategori_id,
            student_id,
            period_id,
            bebas_id,
            bulanan_id,
            tabungan_id,
            tgl_update,
            tgl_input,
            jenis_pembayaran
        )
        VALUES
        (
            'in',
            '$keterangan_transaksi',
            '$keterangan_transaksi',
            '$nilai',
            '$kasir',
            '$kategori_id',
            '$id_siswa',
            '$period_name',
            '0',
            '0',
            '$last_id',
            '$now',
            '$now',
            'cash'
        )
        ";
        // echo $sql_uang;
        // exit;
        $query_uang = mysqli_query($conn, $sql_uang);

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

        $sql     = "insert into log_tabungan (tanggal_transaksi, id_master_tabungan, nilai, tipe) values ('$tanggal_transaksi', '$id', '$nilai', '$tipe')";
        $exec    = mysqli_query($conn, $sql);
        $last_id = mysqli_insert_id($conn);

        $sql_siswa   = "select * from student where student_id = '" . $id_siswa . "'";
        $query_siswa = mysqli_query($conn, $sql_siswa);
        $nr_siswa    = mysqli_num_rows($query_siswa);
        if ($nr_siswa == 0) {
            echo json_encode([
                'code'    => 500,
                'message' => "Siswa not found",
                'saldo'   => 0,
                'data'    => [],
            ]);
            exit;
        }
        $row_siswa            = mysqli_fetch_assoc($query_siswa);
        $nis_siswa            = $row_siswa['nis'];
        $nama_siswa           = $row_siswa['nama'];
        $nama_transaksi       = "Tabungan";
        $keterangan_transaksi = "Tabungan $nis_siswa $nama_siswa";
        $kasir                = $_SESSION['nama'];
        $kategori_id          = 9999;                                 // id dari table uang_kategori;

        $sql_periode   = "select * from periode where status = 'active'";
        $query_periode = mysqli_query($conn, $sql_periode);
        $nr_periode    = mysqli_num_rows($query_periode);
        if ($nr_periode == 0) {
            echo json_encode([
                'code'    => 500,
                'message' => "Periode not found",
                'saldo'   => 0,
                'data'    => [],
            ]);
            exit;
        }
        $row_period  = mysqli_fetch_assoc($query_periode);
        $period_name = $row_period['period_name'];

        $now = date("Y-m-d");

        $sql_uang = "insert into uang_masuk_keluar 
        (
            tipe, 
            nama, 
            keterangan,
            jumlah,
            kasir,
            kategori_id,
            student_id,
            period_id,
            bebas_id,
            bulanan_id,
            tabungan_id,
            tgl_update,
            tgl_input,
            jenis_pembayaran
        )
        VALUES
        (
            'out',
            '$keterangan_transaksi',
            '$keterangan_transaksi',
            '$nilai',
            '$kasir',
            '$kategori_id',
            '$id_siswa',
            '$period_name',
            '0',
            '0',
            '$last_id',
            '$now',
            '$now',
            'cash'
        )
        ";
        $query_uang = mysqli_query($conn, $sql_uang);

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

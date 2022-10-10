<?php
include "../configuration/config_include.php";
include "../configuration/config_all_stat.php";

$id_kelas = $_GET['id_kelas'];

if (!$id_kelas) {
    echo json_encode([
        'code' => 500,
        'data' => []
    ]);
    exit;
}

$sql = "
select 
    student.student_id,
    student.nis,
    student.nama,
    IFNULL(master_tabungan.tabungan, 0) as saldo 
from student 
left join master_tabungan on master_tabungan.id_siswa = student.student_id
where student.kelas_id = '" . $id_kelas . "' 
    and student.status = 'active' 
order by student.nama asc
";
$query = mysqli_query($conn, $sql);
$nr = mysqli_num_rows($query);
if ($nr > 0) {

    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $nested['student_id'] = $row['student_id'];
        $nested['nis']        = $row['nis'];
        $nested['nama']       = $row['nama'];
        $nested['saldo']      = $row['saldo'];
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

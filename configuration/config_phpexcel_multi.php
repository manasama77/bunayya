<?php
include "config_connect.php";

// Load plugin PHPExcel nya
require_once '../assets/PHPExcel/PHPExcel.php';
require_once '../assets/PHPExcel/PHPExcel/IOFactory.php';

$t = $_GET['t'];
$c = $_GET['c'];

$style_col = array(
	'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => 'FF0000')
	)
);

$sql4  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT kelas FROM class WHERE no='$c'"));
$kelas = $sql4['kelas'];

/* Create new PHPExcel object*/
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator('SPP PINTAR')
	->setLastModifiedBy('SPP PINTAR')
	->setTitle("Data Laporan Bulanan")
	->setSubject("SPP PINTAR")
	->setDescription("Laporan Bulanan SPP Pintar")
	->setKeywords("Data SPP PINTAR");

$actsheet = 0;

$sql1 = mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE period_id='$t' AND jenis_pembayaran='bulanan'");
while ($row = mysqli_fetch_assoc($sql1)) {
	//-------------------------------------------------------------------------------------------//
	$j     = $row['jenis_id'];
	$jname = $row['nama'];

	/* Create a first sheet, representing sales data*/
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex($actsheet);
	foreach (range('B', 'R') as $columnID) {
		$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			->setAutoSize(true);
	}
	$actsheet++;

	$objPHPExcel->getActiveSheet()->mergeCells('A1:R1');
	$objPHPExcel->getActiveSheet()->getStyle("A1:R1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->setCellValue('A1', "Laporan Bulanan");

	$objPHPExcel->getActiveSheet()->setCellValue('A3', 'NO');
	$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Kelas');
	$objPHPExcel->getActiveSheet()->setCellValue('C3', 'NIS');
	$objPHPExcel->getActiveSheet()->setCellValue('D3', 'NAMA');

	$rownya = "E";
	$sqlnya = mysqli_query($conn, "SELECT * FROM months");
	while ($bulan = mysqli_fetch_assoc($sqlnya)) {
		$objPHPExcel->getActiveSheet()->setCellValue($rownya . '1', $bulan['month_name']);
		$rownya++;
	}

	$objPHPExcel->getActiveSheet()->setCellValue($rownya++ . '1', "Terbayarkan");
	$objPHPExcel->getActiveSheet()->setCellValue($rownya++ . '1', "Belum Terbayarkan");

	$i    = 4;
	$nom  = 1;
	$sql2 = mysqli_query($conn, "SELECT * FROM student WHERE kelas_id = '" . $c . "'");

	while ($rowstudent = mysqli_fetch_array($sql2)) {
		$total_terbayarkan       = 0;
		$total_belum_terbayarkan = 0;

		$name  = $rowstudent['nama'];
		$nis   = $rowstudent['nis'];
		$kelas = $sql4['kelas'];
		$s     = $rowstudent['student_id'];

		$objPHPExcel->getActiveSheet()->setCellValue("A$i", $nom++);
		$objPHPExcel->getActiveSheet()->setCellValue("B$i", $kelas);
		$objPHPExcel->getActiveSheet()->setCellValue("C$i", $nis);
		$objPHPExcel->getActiveSheet()->setCellValue("D$i", $name);

		$m = "E";
		$sql = mysqli_query($conn, "SELECT * FROM months");
		while ($bulan = mysqli_fetch_assoc($sql)) {

			$b = $bulan['month_id'];
			$sqlnya = "SELECT bulanan.*, uang_masuk_keluar.jenis_pembayaran FROM bulanan LEFT JOIN uang_masuk_keluar ON uang_masuk_keluar.bulanan_id = bulanan.no WHERE bulanan.period_id='$t' AND bulanan.student_id='$s' AND bulanan.jenis_id='$j' AND bulanan.month_id='$b'";
			$sql5 = mysqli_fetch_assoc(mysqli_query($conn, $sqlnya));


			if ($sql5['bulanan_status'] == 'belum') {
				$objPHPExcel->getActiveSheet()->setCellValue('' . $m . '' . $i . '', $sql5['bulanan_status'] . "\n" . $sql5['bulanan_bill']);
				$objPHPExcel->getActiveSheet()->getStyle('' . $m . '' . $i . '')->applyFromArray($style_col);
				$objPHPExcel->getActiveSheet()->getStyle('' . $m . '' . $i . '')->getAlignment()->setWrapText(true);
				$total_belum_terbayarkan += $sql5['bulanan_bill'];
			} else {
				$objPHPExcel->getActiveSheet()->setCellValue('' . $m . '' . $i, $sql5['bulanan_status'] . "\n" . $sql5['jenis_pembayaran']);
				$objPHPExcel->getActiveSheet()->getStyle('' . $m . '' . $i . '')->getAlignment()->setWrapText(true);
				$total_terbayarkan += $sql5['bulanan_bayar'];
			}
			$m++;
		}

		$objPHPExcel->getActiveSheet()->setCellValue('' . $m++ . '' . $i . '', $total_terbayarkan);
		$objPHPExcel->getActiveSheet()->setCellValue('' . $m++ . '' . $i . '', $total_belum_terbayarkan);

		$i++;
	}

	/*Rename sheet*/
	$objPHPExcel->getActiveSheet()->setTitle('' . $jname . '');


	//---------------------------------------------------------------------------------------//
}

$objPHPExcel->setActiveSheetIndexByName('Worksheet');
$sheetIndex = $objPHPExcel->getActiveSheetIndex();
$objPHPExcel->removeSheetByIndex($sheetIndex);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Laporan Bulanan.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// $write = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$write->save('php://output');

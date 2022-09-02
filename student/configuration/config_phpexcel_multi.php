<?php


include "config_connect.php";

// Load plugin PHPExcel nya
require_once '../assets/PHPExcel/PHPExcel.php';
require_once '../assets/PHPExcel/PHPExcel/IOFactory.php';

$t = $_GET['t'];
$c = $_GET['c'];



$style_col =	array(
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => 'FF0000')
	)
);


$sql1 = mysqli_query($conn, "SELECT * FROM jenis_bayar WHERE period_id='$t' AND jenis_pembayaran='bulanan'");

$sql4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT kelas FROM class WHERE no='$c'"));

/* Create new PHPExcel object*/
$objPHPExcel = new PHPExcel();

$actsheet = 0;
while ($row = mysqli_fetch_assoc($sql1)) {
	//-------------------------------------------------------------------------------------------//
	$j = $row['jenis_id'];
	$jname = $row['nama'];

	/* Create a first sheet, representing sales data*/
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex('' . $actsheet++ . '');
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NO');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kelas');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NIS');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'NAMA');

	$i = "E";
	$sql = mysqli_query($conn, "SELECT * FROM months");
	while ($bulan = mysqli_fetch_assoc($sql)) {

		$objPHPExcel->getActiveSheet()->setCellValue('' . $i . '1', $bulan['month_name']);
		$i++;
	}

	$objPHPExcel->getActiveSheet()->setCellValue('' . $i++ . '1', "Terbayarkan");

	$objPHPExcel->getActiveSheet()->setCellValue('' . $i++ . '1', "Belum Terbayarkan");



	$i = 2;
	$nom = 1;
	$sql2 = mysqli_query($conn, "SELECT * FROM student WHERE kelas_id='$c'");
	while ($row = mysqli_fetch_array($sql2)) {
		$total_terbayarkan       = 0;
		$total_belum_terbayarkan = 0;

		$name = $row['nama'];
		$nis = $row['nis'];
		$kelas = $sql4['kelas'];
		$s = $row['student_id'];

		$objPHPExcel->getActiveSheet()->setCellValue("A$i", $nom++);
		$objPHPExcel->getActiveSheet()->setCellValue("B$i", $kelas);
		$objPHPExcel->getActiveSheet()->setCellValue("C$i", $nis);
		$objPHPExcel->getActiveSheet()->setCellValue("D$i", $name);



		$m = "E";
		$sql = mysqli_query($conn, "SELECT * FROM months");
		while ($bulan = mysqli_fetch_assoc($sql)) {

			$b = $bulan['month_id'];

			$sql5 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bulanan WHERE period_id='$t' AND student_id='$s' AND jenis_id='$j' AND month_id='$b'"));


			if ($sql5['bulanan_status'] == 'belum') {
				$objPHPExcel->getActiveSheet()->setCellValue('' . $m . '' . $i . '', $sql5['bulanan_status'] . "\n" . $sql5['bulanan_bill']);
				$objPHPExcel->getActiveSheet()->getStyle('' . $m . '' . $i . '')->applyFromArray($style_col);
				$objPHPExcel->getActiveSheet()->getStyle('' . $m . '' . $i . '')->getAlignment()->setWrapText(true);
				$total_belum_terbayarkan += $sql5['bulanan_bill'];
			} else {
				$objPHPExcel->getActiveSheet()->setCellValue('' . $m . '' . $i . '', $sql5['bulanan_status']);
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









/* Redirect output to a client’s web browser (Excel5)*/
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="name_of_file.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

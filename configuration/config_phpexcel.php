<?php
// Load file koneksi.php
include "config_connect.php";

// Load plugin PHPExcel nya
require_once '../assets/PHPExcel/PHPExcel.php';


$forward = $_GET['forward'];


// Panggil class PHPExcel nya
$excel = new PHPExcel();

// Settingan awal fil excel
$excel->getProperties()->setCreator('SPP PINTAR')
	->setLastModifiedBy('SPP PINTAR')
	->setTitle("Data Laporan")
	->setSubject("SPP PINTAr")
	->setDescription("Laporan SPP Pintar")
	->setKeywords("Data SPP PINTAR");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
	'font' => array('bold' => true), // Set font nya jadi bold
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);



$excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1




if ($forward == 'report_trx') {

	$start = $_GET['start'];
	$end = $_GET['end'];
	$tipe = $_GET['tipe'];



	$excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN TRANSAKSI "); // Set kolom A1 dengan tulisan "DATA SISWA"

	// Buat header tabel nya pada baris ke 3


	$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
	$excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAl"); // Set kolom B3 dengan tulisan "NIS"
	$excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
	$excel->setActiveSheetIndex(0)->setCellValue('D3', "TIPE"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
	$excel->setActiveSheetIndex(0)->setCellValue('E3', "JUMLAH"); // Set kolom E3 dengan tulisan "TELEPON"
	$excel->setActiveSheetIndex(0)->setCellValue('F3', "OLEH"); // Set kolom F3 dengan tulisan "ALAMAT"



	// Apply style header yang telah kita buat tadi ke masing-masing kolom header
	$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);

	// Set height baris ke 1, 2 dan 3
	$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
	$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
	$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

	// Buat query untuk menampilkan semua data siswa
	if ($tipe == 'all') {
		$sql = mysqli_query($conn, "SELECT * FROM uang_masuk_keluar WHERE tgl_input BETWEEN '" . $start . "' AND  '" . $end . "'");
	} else if ($tipe == 'inc') {
		$sql = mysqli_query($conn, "SELECT * FROM uang_masuk_keluar WHERE tipe !='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end . "'");
	} else if ($tipe == 'exp') {
		$sql = mysqli_query($conn, "SELECT * FROM uang_masuk_keluar WHERE tipe='out' AND tgl_input BETWEEN '" . $start . "' AND  '" . $end . "'");
	}

	$in = "PEMASUKAN";
	$out = "PENGELUARAN";
	$namanya = "Laporan Transaksi";

	$no = 1; // Untuk penomoran tabel, di awal set dengan 1
	$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
	while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
		$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
		$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['tgl_update']);
		$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['nama']);

		if ($data['tipe'] == 'out') {

			$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $out);
		} else {
			$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $in);
		}

		$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['jumlah']);
		// Khusus untuk no telepon. kita set type kolom nya jadi STRING
		//	$excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $data['telp'], PHPExcel_Cell_DataType::TYPE_STRING);

		$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['kasir']);

		// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		$excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);

		$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);

		$no++; // Tambah 1 setiap kali looping
		$numrow++; // Tambah 1 setiap kali looping


		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F


	}


	// Set orientasi kertas jadi LANDSCAPE
	$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

	// Set judul file excel nya
	$excel->getActiveSheet(0)->setTitle("data");
	$excel->setActiveSheetIndex(0);
}


if ($forward == 'report_bebas') {
	$t = $_GET['t'];
	$j = $_GET['j'];
	$namanya = "Laporan Pembayaran";


	$excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN PEMBAYARAN NON BULANAN "); // Set kolom A1 dengan tulisan "DATA SISWA"

	// Buat header tabel nya pada baris ke 3


	$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
	$excel->setActiveSheetIndex(0)->setCellValue('B3', "KELAS"); // Set kolom B3 dengan tulisan "NIS"
	$excel->setActiveSheetIndex(0)->setCellValue('C3', "NIS"); // Set kolom C3 dengan tulisan "NAMA"
	$excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
	$excel->setActiveSheetIndex(0)->setCellValue('E3', "SUDAH DIBAYAR"); // Set kolom E3 dengan tulisan "TELEPON"
	$excel->setActiveSheetIndex(0)->setCellValue('F3', "SISA"); // Set kolom F3 dengan tulisan "ALAMAT"
	$excel->setActiveSheetIndex(0)->setCellValue('G3', "STATUS"); // Set kolom F3 dengan tulisan "ALAMAT"


	// Apply style header yang telah kita buat tadi ke masing-masing kolom header
	$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);

	// Set height baris ke 1, 2 dan 3
	$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
	$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
	$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);


	$no = 1; // Untuk penomoran tabel, di awal set dengan 1
	$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4

	$sql = mysqli_query($conn, "SELECT * from student order by kelas_id");



	while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
		$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);

		$k = $data['kelas_id'];
		$a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT kelas FROM class WHERE no='$k'"));

		$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $a['kelas']);
		$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['nis']);
		$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['nama']);

		$s = $data['student_id'];
		$sql2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bebasan WHERE period_id='$t' AND jenis_id='$j' AND student_id='$s'"));
		$sudah = $sql2['sudahbayar'];
		$belum = $sql2['bill'];
		$selisih = $belum - $sudah;

		if ($belum == 0) {
			$status = "";
		} else if ($selisih == $belum) {
			$status = "BELUM DIBAYAR";
		} else if ($selisih <= 0) {
			$status = "LUNAS";
			$selisih = 0;
		} else if (($selisih > 0) && ($selisih < $belum)) {
			$status = "DICICIL";
		}
		$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $sudah);
		$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $selisih);
		$excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $status);


		$excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);

		$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);

		$no++; // Tambah 1 setiap kali looping
		$numrow++; // Tambah 1 setiap kali looping



		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F

	}




	// Set orientasi kertas jadi LANDSCAPE
	$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

	// Set judul file excel nya
	$excel->getActiveSheet(0)->setTitle("data");
	$excel->setActiveSheetIndex(0);
}
// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $namanya . '.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');

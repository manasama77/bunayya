


<?php


// Load file koneksi.php
include "configuration/config_connect.php";

if (isset($_GET['import'])) { // Jika user mengklik tombol Import
	// Load librari PHPExcel nya
	ini_set('max_execution_time', '300'); //300 seconds = 5 minutes

	require_once 'assets/PHPExcel/PHPExcel.php';

	$inputFileType = 'CSV';
	$inputFileName = 'tmp/data.csv';

	$reader = PHPExcel_IOFactory::createReader($inputFileType)->setDelimiter(';');
	$excel = $reader->load($inputFileName);

	$numrow = 1;
	$worksheet = $excel->getActiveSheet();
	foreach ($worksheet->getRowIterator() as $row) {
		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if ($numrow > 1) {
			// START -->
			// Skrip untuk mengambil value nya
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

			$get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
			foreach ($cellIterator as $cell) {
				array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
			}
			// <-- END

			// Ambil data value yang telah di ambil dan dimasukkan ke variabel $get

			$nis = $get[0];
			$nisn = $get[1]; // Ambil data nama
			$nama = $get[2]; // Ambil data hbeli
			$gender = $get[3]; // Ambil data hjual
			$tempat = $get[4]; // Ambil data alamat
			$tgllahir = date('Y-m-d', strtotime($get[5])); // Ambil data NIS
			$hobi = $get[6]; // Ambil data nama
			$nohp = $get[7]; // Ambil data jenis kelamin
			$ibu = $get[8]; // Ambil data telepon

			$ayah = $get[9]; // Ambil data NIS
			$waortu = $get[10]; // Ambil data nama

			$alamat = $get[11];
			$kelas = $get[12];
			$email = $get[13];
			// Cek jika semua data tidak diisi
			if ($nis == "" && $nisn == "" && $nama == "" && $gender == "" && $tempat == "" && $tgllahir == "" && $nohp == "" && $ibu == "" && $ayah == "" && $waortu == "" && $alamat == "" && $kelas == "" && $email == "")
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)


			$now = date('Y-m-d');
			$password = "123456";
			$pass = sha1(md5($password));
			$avatar = "image/placeholder.png";

			// Tambahkan value yang akan di insert ke variabel $query
			// Buat query Insert
			$query = "INSERT INTO student VALUES('','" . $nis . "','" . $nisn . "','" . $pass . "','" . $nama . "','" . $gender . "','" . $tempat . "','" . $tgllahir . "','" . $avatar . "','" . $nohp . "','" . $hobi . "','" . $alamat . "','" . $ibu . "','" . $ayah . "','" . $waortu . "','" . $kelas . "','" . $kelas . "','','active','" . $now . "','" . $now . "','" . $email . "')";
			mysqli_query($conn, $query);
		}

		$numrow++; // Tambah 1 setiap kali looping
	}
}


header('location: m_student.php?insert=import'); // Redirect ke halaman awal
?>

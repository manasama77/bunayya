<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>
<head>
        <meta charset="utf-8" />
        <title>Import Data Siswa |<?php echo $app;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Aplikasi Kelola Sales dan Keuangan" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
<?php
connect();
head();timing();
session();
?>

<?php

if (!login_check()) {
?>
<meta http-equiv="refresh" content="0; url=logout" />
<?php
exit(0);
}
?>

<?php
body();
theader();
etc();


//Setting Halaman

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "configuration/config_chmod.php";

$halaman = "m_student_import"; // halaman
$dataapa = "Import Data"; // data
$tabeldatabase = "student"; // tabel database
$chmod = $chmenu4; // Hak akses Menu
$forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
$forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman


//End Setting Halaman
 
?>

<?php

menu();

?>




<!-- Letak Kode PHP atas -->




<!-- END Letak Kode PHP atas -->





  <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->


            <div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- halaman dan breadcrumbs -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index">DashBoard</a></li>
                                            <li class="breadcrumb-item"><a href="m_student">Siswa</a></li>
                                            <li class="breadcrumb-item active"><?php echo $dataapa;?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $dataapa;?></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end halaman dan breadcrumbs --> 


<!-- ISI HALAMAN -->


                        	 <div class="row">
                            <div class="col-9">
                                <div class="card-box">
                                    <h4 class="header-title">Petunjuk Singkat</h4>
                                    <p class="sub-header">
                                        Data siswa bisa diimport melalui Excel memakai format CSV. Silahkan klik tombol download untuk memperoleh file CSV.
                                         <button onclick="window.location.href='tmp/format_upload_siswa.csv'" class="btn btn-primary waves-effect">
                    <span class="fas fa-download"></span>
                    
                </button>
                                    </p>

                                   
                                     <div class="col-xl-12 mt-3 mt-xl-0">
                                            <h4 class="header-title">Catatan:</h4>
                                            <ol class="mb-0">
                                                <li>
                                                    Pengisian Data Jenis <b>TANGGAL</b> wajib diisi dengan format <b>YYYY-MM-DD</b>, contohnya <b>2020-12-31</b>
                                                </li>
                                                <li>
                                                    Gender diisi dengan <b>Laki Laki</b> atau <b>Perempuan</b> penulisan wajib sama persis
                                                </li>
                                                <li>
                                                    Data NIS dan NISN wajib diisi dan harus unik <b>(tidak boleh ada data yang sama antar siswa)</b>
                                                </li>
                                                <li>
                                                    Kolom <b>kelas_id</b> diisi sesuai dengan ID kelas masing-masing yang ada di menu Manajemen Data->Kelas
                                                </li>
                                               
                                            </ol>
                                        </div> <!-- end col -->

                                   <form method="post" action="" enctype="multipart/form-data">
                                    <div class="col-xl-12">

                                        <div class="row">
                                        <div class="form-group col-md-3">
                                         <label for="inputZip" class="col-form-label">File CSV Data Siswa</label>
                                         <input type="file" name="file" class="form-control">
                                        </div>

                                         <div class="form-group col-md-3">
                                            <label for="inputZip" class="col-form-label">&nbsp;&nbsp;</label><br>
                                             <button class="btn btn-info waves-effect"  type="submit" name="preview" >
                                             <span class="fas fa-upload"></span>
                                             Upload
                                              </button>
                                         </div>
                                     </div>

                                    </div>
                                    </form>
                                </div>
                            </div>




                             <div class="col-3">
                                <div class="card-box">
                                    <h4 class="header-title">Petunjuk Singkat</h4>
                                    <p class="sub-header">
                                        Anda bisa menambahkan data siswa yang sudah ada di database melalui import atau jika ingin mereset(hapus) semua data siswa yang ada silahkan klik tombol reset dibawah
                                         </p>

                                   
                                     <div class="col-xl-12 mt-3 mt-xl-0">
                                            <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#pengeluaran">
                                             <span class="fas fa-times"></span> RESET DATA SISWA</button>
                                        </div> <!-- end col -->

                                  
                                </div>
                            </div>





                        </div>
                     




                         <?php
            // Jika user telah mengklik tombol Preview
            if(isset($_POST['preview'])){
                $nama_file_baru = 'data.csv';

                // Cek apakah terdapat file data.xlsx pada folder tmp
                if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
                    unlink('tmp/'.$nama_file_baru); // Hapus file tersebut

                $nama_file = $_FILES['file']['name']; // Ambil nama file yang akan diupload
                $tmp_file = $_FILES['file']['tmp_name'];
                $ext = pathinfo($nama_file, PATHINFO_EXTENSION); // Ambil ekstensi file yang akan diupload

                // Cek apakah file yang diupload adalah file CSV
                if($ext == "csv"){
                    // Upload file yang dipilih ke folder tmp
                    move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

                    // Load librari PHPExcel nya
                    require_once 'assets/PHPExcel/PHPExcel.php';

                    $inputFileType = 'CSV';
                    $inputFileName = 'tmp/data.csv';

                    $reader = PHPExcel_IOFactory::createReader($inputFileType);
                    $excel = $reader->load($inputFileName);

                    // Buat sebuah tag form untuk proses import data ke database
                    echo "<form method='post' action='m_student_act.php'>";

                    // Buat sebuah div untuk alert validasi kosong
                    echo "<div class='alert alert-danger' id='kosong'>
                    Silahkan Periksa kembali, bagian yang belum diisi akan berwarna merah. Jika Sudah benar klik Import di Pojok Kiri Bawah
                    </div>";

                    echo "<div class='row'>";
                    echo  "<div class='col-12'>";
                    echo  "<div class='card-box'>";
                    echo "<table class='table table-bordered'>
                    <tr>
                        <th colspan='14' class='text-center'>Preview Data Siswa (sebelum import)</th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                       
                        <th>gender/jenis kelamin</th>
                       
                        <th>Tempat Kelahiran</th>
                        <th>Tanggal lahir</th>
                        <th>No.Hp</th>
                        <th>Nama Ibu</th>
                         <th>Nama Ayah</th>
                        <th>No.Hp Orang tua</th>
                       <th>Hobi</th>
                        <th>Alamat</th>
                         <th>kelas_id</th>
                       
                    </tr>";

                    $numrow = 1;
                    $kosong = 0;
                    $a=mysqli_fetch_assoc(mysqli_query($conn,"SELECT MAX(student_id) as maxnum FROM student ORDER BY student_id"));
                    $mulai=$a['maxnum'];
                    $worksheet = $excel->getActiveSheet();
                    foreach ($worksheet->getRowIterator() as $row) { // Lakukan perulangan dari data yang ada di csv
                        // Cek $numrow apakah lebih dari 1
                        // Artinya karena baris pertama adalah nama-nama kolom
                        // Jadi dilewat saja, tidak usah diimport
                        if($numrow > 1){
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
                            $no = ++$mulai; // Ambil data kode
                             $nis = $get[0];
                            $nisn = $get[1]; // Ambil data nama
                            $nama = $get[2]; // Ambil data hbeli
                            $gender = $get[3]; // Ambil data hjual
                            $tempat = $get[4]; // Ambil data alamat
                            $tgllahir = date('Y-m-d',strtotime($get[5])); // Ambil data NIS
                            $hobi = $get[6]; // Ambil data nama
                            $nohp = $get[7]; // Ambil data jenis kelamin
                            $ibu = $get[8]; // Ambil data telepon
                           
                            $ayah = $get[9]; // Ambil data NIS
                            $waortu= $get[10]; // Ambil data nama
                           
                            $alamat = $get[11];
                             $kelas = $get[12];
                         
                            

                            // Cek jika semua data tidak diisi
                            if($nis == "" && $nisn == "" && $nama == "" && $gender == "" && $tempat == "" && $tgllahir == "" && $nohp == "" && $ibu == "" && $ayah == "" && $waortu == "" && $alamat == "" && $kelas== "")
                                continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                            // Validasi apakah semua data telah diisi
                             $no_td = ( ! empty($no))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                              $nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                            $nisn_td = ( ! empty($nisn))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                            $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                              $gender_td = ( ! empty($gender))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                            $tempat_td = ( ! empty($tempat))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
                            $tgllahir_td = ( ! empty($tgllahir))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                            $hobi_td = ( ! empty($hobi))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                            $nohp_td = ( ! empty($nohp))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                            $ibu_td = ( ! empty($ibu))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                            $ayah_td = ( ! empty($ayah))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                           
                            $waortu_td = ( ! empty($waortu))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                            $alamat_td = ( ! empty($alamat))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                             $kelas_td = ( ! empty($kelas))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                         

                            // Jika salah satu data ada yang kosong
                            if($nis == "" or $nisn == "" or $nama == "" or $gender == "" or $tempat == "" or $tgllahir == "" or $hobi == "" or $nohp == "" or $ibu == "" or $ayah == "" or $waortu == "" or $alamat == "" or $kelas == ""){
                                $kosong++; // Tambah 1 variabel $kosong
                            }

                            echo "<tr>";
                              echo "<td".$no_td.">".$no."</td>";
                            echo "<td".$nis_td.">".$nis."</td>";
                            echo "<td".$nisn_td.">".$nisn."</td>";
                            echo "<td".$nama_td.">".$nama."</td>";
                            echo "<td".$gender_td.">".$gender."</td>";
                            echo "<td".$tempat_td.">".$tempat."</td>";
                           
                            echo "<td".$tgllahir_td.">".$tgllahir."</td>";
                            echo "<td".$hobi_td.">".$hobi."</td>";
                            echo "<td".$nohp_td.">".$nohp."</td>";
                            echo "<td".$ibu_td.">".$ibu."</td>";
                            echo "<td".$ayah_td.">".$ayah."</td>";
                            echo "<td".$waortu_td.">".$waortu."</td>";
                          
                             echo "<td".$alamat_td.">".$alamat."</td>";
                             echo "<td".$kelas_td.">".$kelas."</td>";
                         
                            echo "</tr>";
                        }

                        $numrow++; // Tambah 1 setiap kali looping
                    }

                    echo "</table>";
                    

                    // Cek apakah variabel kosong lebih dari 1
                    // Jika lebih dari 1, berarti ada data yang masih kosong
                    if($kosong > 1){
                    ?>
                        <script>
                        $(document).ready(function(){
                            // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                            $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                            $("#kosong").show(); // Munculkan alert validasi kosong
                        });
                        </script>
                    <?php
                    }else{ // Jika semua data sudah diisi
                        echo "<hr>";

                        // Buat sebuah tombol untuk mengimport data ke database
                        echo "<a href='m_spinner?import=1' class='btn btn-success waves-effect width-md waves-light'><span class='fas fa-upload'></span> Import</a>";

                         echo "</div>";
                      echo "</div>";
                       echo "</div>";
                    }

                    echo "</form>";
                }else{ // Jika file yang diupload bukan File CSV
                    // Munculkan pesan validasi
                    echo "<div class='alert alert-danger'>
                    Hanya File CSV (.csv) yang diperbolehkan
                    </div>";
                }
            }
            ?>






   <!-- END ISI HALAMAN -->


                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->
<!--FOOTER-->
                
<?php footer();?>

<!-- END FOOTER-->

            </div>



              <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

 <div id="pengeluaran" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" >Konfirmasi Reset/Hapus Permanen</h4>
                                                </div>
                                                <div class="modal-body">

                                                     <div class="col-xl-12 mt-3 mt-xl-0">
                                            <h4 class="header-title">Tindakan ini akan mengakibatkan:</h4>
                                            <ol class="mb-0">
                                                <li>
                                                    Semua data siswa, transaksi pembayaran siswa, kelulusan, kenaikan kelas dan data lain terkait siswa terhapus
                                                </li>
                                                <li>
                                                    Penghapusan bersifat <b>permanen</b> dan tidak bisa dikembalikan
                                                </li>
                                                
                                              
                                               
                                            </ol>
                                        </div> <!-- end col -->


                                                  
                                            </div>
                                                <form method="post" action="">
                                             <div class="modal-footer">

                                                 <button name="reset" type="submit" class="btn btn-danger waves-effect waves-light pull-left">YA, Reset Permanen</button>
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                                   

                                                </div>
                                            </form>

                                        </div>
                                    </div><!-- /.modal -->






<!-- Sidebar Kanan -->
<?php

right();

?>

<!-- End Sidebar Kanan -->





<!-- Letak Kode PHP Bawah -->


 <?php 

 if(isset($_POST["reset"])){
       if($_SERVER["REQUEST_METHOD"] == "POST"){

$user = $_SESSION['username'];

$sql = "SELECT userna_me FROM user where userna_me = '$user' ";

$result=mysqli_query($conn,$sql);

                  if(mysqli_num_rows($result)>0){

$trun1 = mysqli_query($conn, 'TRUNCATE TABLE student ');


if ($trun1){
   echo "<script type='text/javascript'>  alert('Berhasil, Data siswa telah direset permanen!'); </script>";
              echo "<script type='text/javascript'>window.location = '$forwardpage';</script>";
   

} else {  echo "<script type='text/javascript'>  alert('GAGAL, Data siswa gagal di reset seluruhnya. Terjadi kesalahan dalam proses reset. Ulangi lagi dan pastikan internet anda stabil');</script>";}

                    } else {
                        echo "<script type='text/javascript'>  alert('GAGAL, Data telah di RESET Sebelumnya dan belum ada perubahaan sejak itu!'); </script>";
              echo "<script type='text/javascript'>window.location = '$forwardpage';</script>";
                    }
} }


?>


<!-- END Letak Kode PHP bawah -->




<!-- Library & Pluggins-->
  <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <script src="assets/libs/switchery/switchery.min.js"></script>
        <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="assets/libs/select2/select2.min.js"></script>
        <script src="assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
        <script src="assets/libs/autocomplete/jquery.autocomplete.min.js"></script>
        <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

         <script src="assets/libs/moment/moment.min.js"></script>
        <script src="assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
      

      <!-- Daterange dan Select2-->

       <script src="assets/datepicker/bootstrap-datepicker.js"></script>
         <script src="assets/daterangepicker/daterangepicker.js"></script>
            <script src="assets/libs/select2/select2.min.js"></script>

              <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <script src="assets/js/pages/sweet-alerts.init.js"></script>


         <!-- Init js-->
        <script src="assets/js/pages/form-pickers.init.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

<!-- END Lib & Plugins-->






</body>
</html>
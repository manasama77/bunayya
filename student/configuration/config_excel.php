<?php include 'config_connect.php';

$forward = $_GET['forward'];
$nama=$_GET['nama'];
$dat=$_GET['range'];

list($start, $end) = explode(' - ', $dat);


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$nama-$start-$end.xls");

?>
<?php if($forward == 'akun_trx'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Tanggal</th>
                                              <th>Jenis Transaksi</th>
                                              <th>Nama</th>
                                              <th>Akun</th>
                                              <th>Jumlah</th>
                                              <th>Kategori</th>
                                              <th>Keterangan</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
					$query1="SELECT * FROM  $forward where tgl BETWEEN '" . $start . "' AND  '" . $end . "' order by no ";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
  <td><?php echo ++$no_urut;?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['tgl']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['jenis']); ?></td>
   <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['akun']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['jumlah']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['kategori']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['keterangan']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>

<?php if($forward == 'akun_modal'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Tanggal</th>
                                              <th>Jenis Transaksi</th>
                                              <th>Nama</th>
                                              <th>Akun</th>
                                              <th>Jumlah</th>
                                              <th>Kategori</th>
                                              <th>Keterangan</th>
                                            </tr>
                                        </thead>
                      <?php
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
          $query1="SELECT * FROM  $forward where tanggal BETWEEN '" . $start . "' AND  '" . $end . "' order by no ";
        $hasil = mysqli_query($conn,$query1);
        $no = 1;
        while ($fill = mysqli_fetch_assoc($hasil)){
          ?>
                     <tbody>
<tr>
  <td><?php echo ++$no_urut;?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['tanggal']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['jenis']); ?></td>
   <td><?php  echo mysqli_real_escape_string($conn, $fill['nama']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['akun']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['jumlah']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['kategori']); ?></td>
  <td><?php  echo mysqli_real_escape_string($conn, $fill['keterangan']); ?></td>
            </tr><?php
          ;
        }

        ?>
                  </tbody></table>
<?php } ?>

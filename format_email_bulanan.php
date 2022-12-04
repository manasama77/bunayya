<p style="font-weight: 700; color: black;">Halo Abizhar Naufal Azhad,</p>
<p style="font-weight: 700; color: black;">Selamatyah.. Kamu Sudah Melakukan Pembayaran Berikut Detail Transaksinya :</p>

<table>
    <tr>
        <td>Tanggal Transaksi</td>
        <td>:</td>
        <td>
            <?= $tanggal_now->format('d M Y H:i:s'); ?>
        </td>
    </tr>
    <tr>
        <td>Nama Siswa</td>
        <td>:</td>
        <td><?= $row_student['nama']; ?></td>
    </tr>
    <tr>
        <td>NIS</td>
        <td>:</td>
        <td><?= $row_student['nis']; ?></td>
    </tr>
    <tr>
        <td>Tahun Ajaran</td>
        <td>:</td>
        <td><?= $row_tahun_ajar['period_name']; ?></td>
    </tr>
    <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?= $row_kelas['kelas']; ?></td>
    </tr>
    <tr>
        <td>Jenis Tagihan</td>
        <td>:</td>
        <td><?= $subject; ?></td>
    </tr>
    <tr>
        <td>Biaya Tagihan</td>
        <td>:</td>
        <td>Rp <?= number_format($row_bulanan['bulanan_bill'], 0, ',', '.'); ?></td>
    </tr>
    <tr>
        <td>Biaya Admin</td>
        <td>:</td>
        <td>Rp <?= number_format($row_bulanan['biaya_admin'], 0, ',', '.'); ?></td>
    </tr>
    <tr>
        <td>Pembayaran</td>
        <td>:</td>
        <td>Rp <?= number_format($dibayar, 0, ',', '.'); ?></td>
    </tr>
    <tr>
        <td>Sisa Pembayaran</td>
        <td>:</td>
        <td>Rp
            <?php
            $sisa_pembayaran = $row_bulanan['bulanan_bill'] + $row_bulanan['biaya_admin'] - $dibayar;
            if ($sisa_pembayaran <= 0) {
                $sisa_pembayaran = 0;
            }
            ?>
            <?= number_format($sisa_pembayaran, 0, ',', '.'); ?>
        </td>
    </tr>
    <tr>
        <td>Kembalian</td>
        <td>:</td>
        <td>Rp <?= number_format($kembalian, 0, ',', '.'); ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td>:</td>
        <td><?= $status; ?></td>
    </tr>
    <tr>
        <td>Kasir</td>
        <td>:</td>
        <td><?= $user; ?></td>
    </tr>
</table>

<p>informasi Lebih Lanjut Silakan Hubungi Kami di layanan Email infosd@sekolahbunayya.sch.id Atau Melalui Tlp/WhatsApp 081288643498</p>

<p style="font-weight: 700; color: black;">-Salam Sukses-</p>
<p style="font-weight: 700; color: black;">Admin SDIT Bunayya</p>
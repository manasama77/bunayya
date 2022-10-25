<?php
include "configuration/config_include.php";
include "configuration/config_all_stat.php";
if (isset($_SESSION['snap_token'])) {
    unset($_SESSION['snap_token']);
}

$arr_biaya_admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biaya_admin WHERE id = 1"));
$biaya_admin     = $arr_biaya_admin['biaya'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>History Tabugan | <?php echo $app; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Aplikasi Kelola Sales dan Keuangan" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <?php
    connect();
    head();
    timing();
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

    $halaman = "tabungan"; // halaman
    $dataapa = "Tabugan"; // data
    $tabeldatabase = "kosong"; // tabel database
    $chmod = 5; // Hak akses Menu
    $forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
    $forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman
    $id = $_SESSION['id'];
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

                                    <li class="breadcrumb-item active"><?php echo $dataapa; ?></li>
                                </ol>
                            </div>
                            <h4 class="page-title"><?php echo $dataapa; ?></h4>
                        </div>
                    </div>
                </div>
                <!-- end halaman dan breadcrumbs -->


                <!-- ISI HALAMAN -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">History Tabungan</h4>
                            <?php
                            $sql = "select * from master_tabungan where id_siswa = '$id'";
                            $query = mysqli_query($conn, $sql);
                            $nr = mysqli_num_rows($query);
                            $saldo = 0;
                            if ($nr == 1) {
                                $ass = mysqli_fetch_assoc($query);
                                $saldo = $ass['tabungan'];
                            }
                            ?>
                            <p>Saldo: Rp. <?= number_format($saldo, 0); ?></p>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:10px" class="text-center">No.</th>
                                            <th class="text-center">Tanggal Transaksi</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-right">Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "select * from master_tabungan as tabungan right join log_tabungan as log on log.id_master_tabungan = tabungan.id where tabungan.id_siswa = '$id'";
                                        $query = mysqli_query($conn, $sql);
                                        $no = 0;
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            ++$no;
                                            $tanggal_transaksi = new DateTime($row['tanggal_transaksi']);
                                            $jenis             = ucfirst($row['tipe']);
                                            $nominal           = number_format($row['nilai'], 0);
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= $tanggal_transaksi->format('d M Y H:i'); ?></td>
                                                <td class="text-center"><?= $jenis; ?></td>
                                                <td class="text-right"><?= $nominal; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END ISI HALAMAN -->
            </div> <!-- end container-fluid -->
        </div> <!-- end content -->
        <!--FOOTER-->

        <?php footer(); ?>

        <!-- END FOOTER-->

    </div>

    <!-- Modal -->
    <form id="form_bayar">
        <div class="modal fade" id="modal_bayar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_bayar_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="payment_table">Jenis Pembayaran</label>
                            <input type="text" class="form-control" id="payment_table" name="payment_table" readonly />
                        </div>
                        <div class="form-group">
                            <label for="nama_tagihan">Nama Tagihan</label>
                            <input type="text" class="form-control" id="nama_tagihan" name="nama_tagihan" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="tagihan">Tagihan</label>
                            <input type="text" class="form-control" id="tagihan" name="tagihan" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="biaya_admin">Biaya Admin</label>
                            <input type="text" class="form-control" id="biaya_admin" name="biaya_admin" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="jumlah_tagihan">Jumlah Tagihan</label>
                            <input type="text" class="form-control" id="jumlah_tagihan" name="jumlah_tagihan" readonly required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="email" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="no" name="no" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->






    <!-- Sidebar Kanan -->


    <!-- End Sidebar Kanan -->





    <!-- Letak Kode PHP Bawah -->




    <!-- END Letak Kode PHP bawah -->




    <!-- Library & Pluggins-->
    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <script src="../assets/libs/switchery/switchery.min.js"></script>
    <script src="../assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="../assets/libs/select2/select2.min.js"></script>
    <!-- <script src="../assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script> -->
    <script src="../assets/libs/autocomplete/jquery.autocomplete.min.js"></script>
    <script src="../assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="../assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="../assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

    <script src="../assets/libs/moment/moment.min.js"></script>
    <script src="../assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="../assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="../assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>


    <!-- Daterange dan Select2-->

    <script src="../assets/datepicker/bootstrap-datepicker.js"></script>
    <script src="../assets/daterangepicker/daterangepicker.js"></script>
    <script src="../assets/libs/select2/select2.min.js"></script>

    <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script src="../assets/js/pages/sweet-alerts.init.js"></script>


    <!-- Init js-->
    <script src="../assets/js/pages/form-pickers.init.js"></script>

    <!-- Init js-->
    <!-- <script src="../assets/js/pages/form-advanced.init.js"></script> -->

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-3v_Zj6qsRZR6NVYW"></script>

    <!-- END Lib & Plugins-->
    </body>

</html>

<script type="text/javascript">
    let noTagihan = null
    let namaTagihan = null
    let snapToken = null

    $(document).ready(e => {
        $('.btn_bayar').on('click', function(e) {
            e.preventDefault()
            let no = $(this).data('no')
            let title = $(this).data('title')
            let bill = $(this).data('bill')
            let admin = $(this).data('admin')
            let total = $(this).data('total')
            let bulan = $(this).data('bulan')
            let payment_table = $(this).data('payment_table')
            let email = $('#email').val('')
            cekToken(no, title, bill, admin, total, bulan, payment_table)
        })

        $('#form_bayar').on('submit', e => {
            e.preventDefault()
            getSnapToken()
        })
    })

    function cekToken(no, title, bill, admin, total, bulan, payment_table) {
        $.ajax({
            url: `cek_token.php`,
            method: 'post',
            dataType: 'json',
            data: {
                no: no
            }
        }).fail(e => {
            console.log(e)
        }).done(e => {
            console.log(e)
            if (e.code == 404) {
                showModalBayar(no, title, bill, admin, total, bulan, payment_table)
            } else if (e.code == 200) {
                snapToken = e.message
                showSnapMidtrans()
            }
        })
    }

    function showSnapMidtrans() {
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                /* You may add your own implementation here */
                alert("Pembayaran Berhasil");
                window.location.reload()
                console.log(result);
            },
            onPending: function(result) {
                /* You may add your own implementation here */
                alert("Pembayaran belum selesai");
                console.log(result);
            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("Pembayaran Gagal");
                console.log(result);
            },
            onClose: function() {
                window.location.reload()
            }
        })
    }

    function showModalBayar(no, title, bill, admin, total, bulan, payment_table) {
        noTagihan = no
        namaTagihan = `${title} ${bulan}`
        $('#modal_bayar_title').text("Pembayaran")
        $('#payment_table').val(`${payment_table}`)
        $('#nama_tagihan').val(`${title} ${bulan}`)
        $('#tagihan').val(bill)
        $('#biaya_admin').val(admin)
        $('#jumlah_tagihan').val(total)
        $('#no').val(no)
        $('#modal_bayar').modal('show')
    }

    function getSnapToken() {
        postSnapToken().then((data) => {
            if (data.code == 200) {
                $('#modal_bayar').modal('hide')
                snapToken = data.token
                showSnapMidtrans()
            } else {
                throw "Tidak Terhubung dengan Midtrans, gagal mendapatkan token"
            }
        }).catch((error) => {
            console.error('Error:', error);
            alert(`Error ${error}`)
        });
    }

    async function postSnapToken() {
        let url = 'ajax/get_snap_token.php'
        let formData = new FormData()
        formData.append('no', noTagihan)
        formData.append('nama_tagihan', namaTagihan)
        formData.append('tagihan', $('#tagihan').val())
        formData.append('biaya_admin', $('#tagihan').val())
        formData.append('jumlah_tagihan', $('#jumlah_tagihan').val())
        formData.append('payment_table', $('#payment_table').val())
        formData.append('email', $('#email').val())

        const response = await fetch(url, {
            method: 'post',
            body: formData,
            cache: 'no-cache',
        })
        return response.json()
    }
</script>
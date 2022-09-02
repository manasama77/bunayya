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
    <title>Ringkasan Tagihan | <?php echo $app; ?></title>
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

    $halaman = "ringkasan"; // halaman
    $dataapa = "Tagihan"; // data
    $tabeldatabase = "kosong"; // tabel database
    $chmod = 5; // Hak akses Menu
    $forward = mysqli_real_escape_string($conn, $tabeldatabase); // tabel database
    $forwardpage = mysqli_real_escape_string($conn, $halaman); // halaman

    $a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM periode WHERE status='active'"));
    $periode = $a['no'];
    $id = $_SESSION['id'];
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
                            <h4 class="header-title">Bulanan</h4>
                            <p class="sub-header">
                                Lakukan Pembayaran bulanan secara rutin untuk kelancaran kegiatan belajar mengajar
                            </p>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">No.</th>
                                            <th>Nama Pembayaran</th>
                                            <th>Belum Bayar</th>
                                            <?php $sql = mysqli_query($conn, "SELECT * FROM months ORDER by month_id");

                                            while ($rowt = mysqli_fetch_assoc($sql)) {
                                                if ($rowt['status'] == 'inactive') {
                                                    echo '<th>' . $rowt['month_name'] . '</th>';
                                                } else {
                                                    echo '<th class="table-info">' . $rowt['month_name'] . '</th>';
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($conn, "SELECT DISTINCT jenis_id FROM bulanan WHERE student_id='$id' ORDER by no");
                                        $no  = 0;
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo ++$no; ?></th>
                                                <td>
                                                    <?php
                                                    $j  = $row['jenis_id'];
                                                    $qr = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama, tahunajar FROM jenis_bayar WHERE jenis_id = '$j'"));
                                                    echo $qr['nama'] . "-T.A" . $qr['tahunajar'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $qa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bulanan_bill) as bill FROM bulanan WHERE jenis_id='$j' AND period_id = '$periode' AND student_id = '$id' AND bulanan_status LIKE '%belum%'"));
                                                    echo number_format($qa['bill']);
                                                    ?>
                                                </td>
                                                <?php
                                                $i = 0;
                                                while ($i <= 11) {
                                                    $i++;
                                                    $qs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bulanan WHERE jenis_id='$j' AND period_id='$periode' AND student_id='$id' AND month_id='$i'"));
                                                    if ($qs['bulanan_status'] == 'sudah') {
                                                        echo '<td class="table-success"><a href="receipt?no=' . $qs['no'] . '&tipe=1">' . date('d/m/y', strtotime($qs['tgl_input'])) . '</a><br>LUNAS </td>';
                                                    } else {
                                                        $title_bayar = $qr['nama'] . "-T.A" . $qr['tahunajar'];
                                                        $total       = $qs['bulanan_bill'] + $biaya_admin;
                                                        echo '<td><a href="#" class="btn_bayar" data-no="' . $qs['no'] . '" data-title="' . $title_bayar . '" data-bill="' . $qs['bulanan_bill'] . '" data-admin="' . $biaya_admin . '" data-total="' . $total . '"><b>' . number_format($qs['bulanan_bill']) . '</b></a></td>';
                                                    }
                                                }
                                                ?>

                                            </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




                <?php
                $b = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bebasan WHERE student_id='$id'"));

                if ($b > 0) {
                ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title">Non Bulanan</h4>
                                <p class="sub-header">
                                    Lakukan Pembayaran sebelum jatuh tempo
                                </p>


                                <div class="table-responsive">

                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Pembayaran</th>
                                                <th>Tagihan</th>
                                                <th>Dibayar</th>
                                                <th>Status</th>
                                                <th>Lihat</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $sqla = mysqli_query($conn, "SELECT * FROM bebasan WHERE student_id='$id' ORDER by no");
                                            $nom = 0;
                                            while ($rowa = mysqli_fetch_assoc($sqla)) { ?>

                                                <tr>
                                                    <th scope="row"><?php echo ++$nom; ?></th>
                                                    <td><?php $j = $rowa['jenis_id'];
                                                        $qr = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama,tahunajar FROM jenis_bayar WHERE jenis_id='$j'"));
                                                        echo $qr['nama']; ?>-T.A <?php echo $qr['tahunajar']; ?>

                                                    </td>
                                                    <td><?php echo number_format($rowa['bill']); ?></td>
                                                    <td><?php echo number_format($rowa['sudahbayar']); ?></td>
                                                    <?php if ($rowa['status'] != 'belum') { ?>
                                                        <td class="table-danger"><?php echo $rowa['status']; ?></td>
                                                    <?php } else { ?>
                                                        <td><?php echo $rowa['status']; ?></td>
                                                    <?php } ?>
                                                    <td>


                                                        <a href="summary_detail?no=<?php echo $rowa['no']; ?>&j=<?php echo $j; ?>" class="demo-delete-row btn btn-danger btn-sm btn-icon"><i class="fa fa-eye"></i></a>



                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- END ISI HALAMAN -->



            </div> <!-- end container-fluid -->

        </div> <!-- end content -->
        <!--FOOTER-->

        <?php footer(); ?>

        <!-- END FOOTER-->

    </div>

    <!-- Modal -->
    <form id="form_bayar" method="post" action="process/store_payment.php">
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
    <script src="../assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
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
    <script src="../assets/js/pages/form-advanced.init.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Q8fsKFh_-jm0ltah"></script>

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
            let email = $('#email').val('')
            showModalBayar(no, title, bill, admin, total)
        })
    })

    function showModalBayar(no, title, bill, admin, total, email) {
        noTagihan = no
        namaTagihan = title
        $('#modal_bayar_title').text(title)
        $('#nama_tagihan').val(title)
        $('#tagihan').val(bill)
        $('#biaya_admin').val(admin)
        $('#jumlah_tagihan').val(total)
        $('#no').val(no)
        $('#modal_bayar').modal('show')
    }

    function getSnapToken() {
        postSnapToken().then((data) => {
            if (e.code == 200) {
                $('#modal_bayar').modal('hide')
                snapToken = e.token
                showSnapMidtrans()
            } else {
                alert("Tidak Terhubung dengan Midtrans, gagal mendapatkan token")
            }
        }).catch((error) => {
            console.error('Error:', error);
        });
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
                /* You may add your own implementation here */
                alert('Kamu belum menyelesaikan pembayaran');
            }
        })
    }

    async function postSnapToken() {
        let url = 'ajax/get_snap_token.php'
        let formData = new FormData()
        formData.append('no', noTagihan)
        formData.append('nama_tagihan', namaTagihan)
        formData.append('tagihan', $('#tagihan').val())
        formData.append('biaya_admin', $('#tagihan').val())
        formData.append('jumlah_tagihan', $('#jumlah_tagihan').val())
        formData.append('email', $('#email').val())

        const response = await fetch(url, {
            method: 'post',
            body: formData,
            cache: 'no-cache',
        })
        return response.json()
    }
</script>
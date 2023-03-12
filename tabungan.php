<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Tabungan | <?php echo $app; ?></title>
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
    pagination();
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
    $chmod = $chmenu3; // Hak akses Menu
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
                                    <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tabungan</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Tabungan</h4>
                        </div>
                    </div>
                </div>
                <!-- end halaman dan breadcrumbs -->


                <!-- ISI HALAMAN -->
                <?php
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                ?>
                <div class="row">
                    <div class="col-12">
                        <?php if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                            <a href="tabungan_add.php" class="btn btn-success waves-effect waves-light">Tambah Tabungan</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tables">
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <th class="text-center">
                                                    <i class="fas fa-cog"></i>
                                                </th>
                                                <th>Tanggal</th>
                                                <th>Kelas</th>
                                                <th>NIS</th>
                                                <th>Siswa</th>
                                                <th>Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "select 
                                                master_tabungan.id,
                                                master_tabungan.tabungan as saldo,
                                                student.nis,
                                                student.nama,
                                                class.kelas
                                            from master_tabungan 
                                            left join student on student.student_id = master_tabungan.id_siswa
                                            left join class on class.no = student.kelas_id
                                            order by student.nama asc
                                            ";
                                            $query = mysqli_query($conn, $sql);
                                            $nr = mysqli_num_rows($query);

                                            if ($nr == 0) {
                                                echo '<tr><td colspan="6" class="text-center">-Tidak ada data-</td></tr>';
                                            } else {
                                                $saldo_akhir = 0;
                                                while ($row = mysqli_fetch_assoc($query)) {
                                                    $tgl_obj = new DateTime($row['tanggal_transaksi']);
                                                    $namanya = addcslashes($row['nama'], "'");
                                            ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="detailLog('<?= $row['id']; ?>', '<?= $tgl_obj->format('d-m-Y H:i'); ?>', '<?= $row['kelas'] ?>', '<?= $row['nis'] ?>', '<?= $namanya  ?>', '<?= number_format($row['saldo'], 0) ?>')">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </td>
                                                        <td><?= $tgl_obj->format('d-m-Y H:i'); ?></td>
                                                        <td><?= $row['kelas'] ?></td>
                                                        <td><?= $row['nis'] ?></td>
                                                        <td><?= $row['nama'] ?></td>
                                                        <td class="text-right"><?= number_format($row['saldo'], 0) ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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

    <div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail Data Tabungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kelas</th>
                                    <th>NIS</th>
                                    <th>Siswa</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="tanggal"></td>
                                    <td class="kelas"></td>
                                    <td class="nis"></td>
                                    <td class="siswa"></td>
                                    <td class="saldo"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Tipe</th>
                                    <th class="text-right">Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="table_list">
                                <tr>
                                    <td colspan="4" class="text-center">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
    <!-- Sidebar Kanan -->
    <?php
    right();
    ?>
    <!-- End Sidebar Kanan -->
    <!-- Letak Kode PHP Bawah -->
    <!-- END Letak Kode PHP bawah -->
    <!-- Library & Pluggins-->
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <script src="assets/libs/switchery/switchery.min.js"></script>
    <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="assets/libs/select2/select2.min.js"></script>
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
    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <!-- END Lib & Plugins-->
    <script>
    </script>
    </body>

</html>

<script>
    $(document).ready(() => {
        $('#tables').DataTable({
            order: [
                [1, 'asc']
            ],
            columnDefs: [{
                targets: [0],
                orderable: false,
            }]
        })
    })

    function deleteLog(id) {
        var result = confirm("Delete Data?");
        if (result) {
            window.location.href = `tabungan_delete.php?id=${id}`
        }
    }

    function detailLog(id, tanggal, kelas, nis, siswa, saldo) {
        ajaxDetail(id).fail(e => {
            console.log(e)
        }).done(e => {
            console.log(e)
            $('.tanggal').text(tanggal)
            $('.kelas').text(kelas)
            $('.nis').text(nis)
            $('.siswa').text(siswa)
            $('.saldo').text(saldo)

            let htmlnya = ''
            if (e.code == 200) {
                let data = e.data

                data.forEach(el => {
                    let id_log = el.id
                    let nilai_log = el.nilai
                    let tanggal_transaksi_log = el.tanggal_transaksi
                    let tipe_log = el.tipe

                    htmlnya += `
                    <tr>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteLog('${id_log}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        <td>${tanggal_transaksi_log}</td>
                        <td>${tipe_log}</td>
                        <td class="text-right">${nilai_log}</td>
                    </tr>
                    `
                });
            }

            $('#table_list').html(htmlnya)
            $('#modal_detail').modal('show')
        })
    }

    function ajaxDetail(id) {
        return $.ajax({
            url: './ajax/get_detail_tabungan.php',
            method: 'get',
            dataType: 'json',
            data: {
                id
            },
            beforeSend: function() {

            }
        })
    }
</script>
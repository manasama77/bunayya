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
                                    <table class="table table-bordered">
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <th class="text-center">
                                                    <i class="fas fa-cog"></i>
                                                </th>
                                                <th>Tanggal</th>
                                                <th>Kelas</th>
                                                <th>NIS</th>
                                                <th>Siswa</th>
                                                <th>Tipe</th>
                                                <th>Nominal</th>
                                                <th>Saldo Akhir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "select 
                                                log_tabungan.id,
                                                log_tabungan.tanggal_transaksi,
                                                class.kelas,
                                                student.nis,
                                                student.nama,
                                                log_tabungan.tipe,
                                                log_tabungan.nilai
                                            from master_tabungan 
                                            left join student on student.student_id = master_tabungan.id_siswa
                                            left join class on class.no = student.kelas_id
                                            left join log_tabungan on log_tabungan.id_master_tabungan = master_tabungan.id
                                            order by class.no asc
                                            ";
                                            $query = mysqli_query($conn, $sql);
                                            $nr = mysqli_num_rows($query);

                                            if ($nr == 0) {
                                                echo '<tr><td colspan="8" class="text-center">-Tidak ada data-</td></tr>';
                                            }
                                            $saldo_akhir = 0;
                                            while ($row = mysqli_fetch_assoc($query)) {
                                                $tgl_obj = new DateTime($row['tanggal_transaksi']);
                                                $saldo_akhir += $row['nilai'];
                                            ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteLog('<?= $row['id']; ?>')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                    <td><?= $tgl_obj->format('d-m-Y H:i'); ?></td>
                                                    <td><?= $row['kelas'] ?></td>
                                                    <td><?= $row['nis'] ?></td>
                                                    <td><?= $row['nama'] ?></td>
                                                    <td><?= strtoupper($row['tipe']) ?></td>
                                                    <td class="text-right"><?= number_format($row['nilai'], 0) ?></td>
                                                    <td class="text-right"><?= number_format($saldo_akhir, 0) ?></td>
                                                </tr>
                                            <?php } ?>
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

    <form id="form_add">
        <div class="modal fade" id="modal_tambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Tabungan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_class">Kelas</label>
                            <select class="form-control" id="id_periode" name="id_periode">
                                <option value=""></option>
                                <?php
                                $sql = "select * from class where status = 'active' order by kelas asc";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($query)) {
                                    echo '<option value="' . $row['no'] . '">' . $row['kelas'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
    <!-- END Lib & Plugins-->
    <script>
    </script>
    </body>

</html>

<script>
    $(document).ready(() => {
        $('#modal_tambah').on('click', e => {
            e.preventDefault()
            $('#modal_tambah').modal('show')
        })
    })

    function deleteLog(id) {
        var result = confirm("Delete Data?");
        if (result) {
            window.location.href = `tabungan_delete.php?id=${id}`
        }
    }
</script>
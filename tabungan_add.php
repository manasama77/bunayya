<!DOCTYPE html>
<html>
<?php

include "configuration/config_include.php";
include "configuration/config_all_stat.php";

?>

<head>
    <meta charset="utf-8" />
    <title>Tambah Tabungan | <?php echo $app; ?></title>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tambah Tabungan</a></li>
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
                        <a href="tabungan.php" class="btn btn-dark waves-effect waves-light">Kembali Ke List Tabungan</a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-4 offset-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form id="form">
                                    <div class="form-group">
                                        <label for="id_kelas">Kelas</label>
                                        <select class="form-control" id="id_kelas" name="id_kelas" required>
                                            <option value=""></option>
                                            <?php
                                            $sql   = "select * from class where status = 'active'";
                                            $query = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_assoc($query)) {
                                                echo '<option value="' . $row['no'] . '">' . $row['kelas'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_siswa">Kelas</label>
                                        <select class="form-control" id="id_siswa" name="id_siswa" data-placeholder="Pilih Siswa" required readonly>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="saldo">Saldo</label>
                                        <input type="text" class="form-control" id="saldo" name="saldo" value="0" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipe">Tipe </label>
                                        <select class="form-control" id="tipe" name="tipe" required>
                                            <option value="masuk">Masuk</option>
                                            <option value="keluar">Keluar</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nilai">Nominal</label>
                                        <input type="number" class="form-control" id="nilai" name="nilai" min="0" max="99999999" required />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block" id="simpan">
                                            <i class="fas fa-save fa-fw"></i> Save
                                        </button>
                                    </div>
                                </form>
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
        $('#form').on('submit', e => {
            e.preventDefault()
            storeTabungan()
        })
        $('#id_kelas').on('change', e => {
            e.preventDefault()
            let id_kelas = $('#id_kelas').val()

            if (id_kelas) {
                getListSiswa(id_kelas)
            } else {
                clearForm()
            }
        })

        $('#id_siswa').on('change', e => {
            e.preventDefault()
            let id_siswa = $('#id_siswa').val()

            if (id_kelas) {
                let saldo = $('#id_siswa :selected').data('saldo')
                $('#saldo').val(saldo)
            } else {
                $('#saldo').val(0)
            }
        })
    })

    function clearForm() {
        $('#id_siswa').val('').html('').prop('readonly', true)
        $('#saldo').val(0)
    }

    function getListSiswa(id_kelas) {
        $.ajax({
            url: `ajax/get_list_siswa.php?id_kelas=${id_kelas}`,
            method: 'get',
            dataType: 'json',
            beforeSend: () => {
                clearForm()
            }
        }).fail(e => {
            console.log(e.responseText)
        }).done(e => {
            console.log(e)
            let htmlnya = '<option value=""></option>'
            let code = e.code;
            let data = e.data;

            if (code == 200) {
                data.forEach(ccd => {
                    let student_id = ccd.student_id
                    let nis = ccd.nis
                    let nama = ccd.nama
                    let saldo = ccd.saldo
                    htmlnya += `<option value="${student_id}" data-saldo="${saldo}">(${nis}) - ${nama}</option>`
                });
            }

            $('#id_siswa').html(htmlnya).attr('readonly', false)
        })
    }

    function storeTabungan() {
        $.ajax({
            url: `ajax/store_tabungan.php`,
            method: 'post',
            dataType: 'json',
            data: $('#form').serialize(),
            beforeSend: () => {
                $('#simpan').prop('disabled', true)
            }
        }).fail(e => {
            console.log(e.responseText)
            $('#simpan').prop('disabled', false)
        }).done(e => {
            if (e.code == 400) {
                alert(e.message)
                $('#saldo').val(e.saldo)
                $('#simpan').prop('disabled', false)
            } else if (e.code == 200) {
                alert('Success')
                window.location.reload()
            } else {
                alert('Terjadi kesalahan, tidak terhubung dengan database')
                $('#simpan').prop('disabled', false)
            }
        })
    }
</script>
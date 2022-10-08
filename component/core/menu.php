<?php
include "configuration/config_connect.php";
include "configuration/config_chmod.php";
?>

<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigasi</li>

                <li>
                    <a href="index">
                        <i class="fe-airplay"></i>
                        <span class="badge badge-success badge-pill float-right"></span>
                        <span> Beranda </span>
                    </a>

                </li>

                <?php

                if ($chmenu1 >= 2 || $_SESSION['jabatan'] == 'admin') { ?>


                    <li class="menu-title">Tata Usaha</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fas fa-user-friends"></i>
                            <span> Pembayaran SPP </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="pay_add">Tambah</a></li>
                            <li><a href="pay_outstanding">Tunggakan Bulanan</a></li>

                            <!--            <li><a href="pay_data">Pembayaran Siswa</a></li>  -->

                        </ul>
                    </li>



                <?php } else {
                }

                if ($chmenu2 >= 2 || $_SESSION['jabatan'] == 'admin') { ?>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fas fa-tasks"></i>
                            <span> Atur Pembayaran </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="pos_bayar">Pos Pembayaran</a></li>
                            <li><a href="pos_jenis">Jenis Pembayaran</a></li>


                        </ul>
                    </li>

                <?php } else {
                }

                if ($chmenu3 >= 2 || $_SESSION['jabatan'] == 'admin') { ?>




                    <li>
                        <a href="javascript: void(0);">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span> Jurnal Umum</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul class="nav-second-level" aria-expanded="false">

                            <li><a href="u_income">Penerimaan</a></li>
                            <li><a href="u_expense">Pengeluaran</a></li>
                            <li><a href="u_kategori">Kategori</a></li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="tabungan">
                            <i class="far fa-money-bill-alt"></i>
                            <span>Tabungan</span>
                        </a>
                    </li> -->


                <?php } else {
                }

                if ($chmenu4 >= 2 || $_SESSION['jabatan'] == 'admin') { ?>

                    <li class="menu-title">Manajemen Sekolah</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span> Manajemen Data</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul class="nav-second-level" aria-expanded="false">

                            <li><a href="m_period">Tahun Ajaran</a></li>
                            <li><a href="m_class">Kelas</a></li>
                            <li><a href="m_student">Siswa</a></li>
                            <li><a href="m_upgrade">Kenaikan Kelas</a></li>
                            <li><a href="m_graduation">Kelulusan</a></li>
                            <li><a href="m_alumnus">Alumni</a></li>


                        </ul>
                    </li>

                <?php } else {
                }

                if ($chmenu5 >= 2 || $_SESSION['jabatan'] == 'admin') { ?>
                    <li>
                        <a href="info_list">
                            <i class="far fa-money-bill-alt"></i>
                            <span> Pengumuman </span>
                        </a>
                    </li>

                <?php } else {
                }

                if ($chmenu6 >= 2 || $_SESSION['jabatan'] == 'admin') { ?>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-bar-chart-2"></i>
                            <span> Laporan </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul class="nav-second-level" aria-expanded="false">

                            <li><a href="report_trx">Laporan Transaksi</a></li>
                            <li><a href="report_finance">Laporan Keuangan</a></li>
                            <li><a href="report_byclass">Pembayaran Bulanan</a></li>
                            <li><a href="report_bypos">Pembayaran Non Bulanan</a></li>

                        </ul>
                    </li>


                <?php } else {
                }

                if ($chmenu7 >= 2 || $_SESSION['jabatan'] == 'admin') { ?>
                    <li class="menu-title">Bagian IT</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class=" fas fa-user"></i>
                            <span> Manajemen User </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul class="nav-second-level" aria-expanded="false">

                            <li><a href="user_add">Tambah User</a></li>
                            <li><a href="user">Data User</a></li>
                            <li><a href="user_siswa">Data Siswa</a></li>
                            <li><a href="user_jabatan">Jabatan</a></li>
                        </ul>
                    </li>


                <?php } else {
                }

                if ($chmenu8 >= 2 || $_SESSION['jabatan'] == 'admin') { ?>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-folder-plus"></i>
                            <span> Pengaturan </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">

                            <li><a href="set_sekolah_data">Sekolah</a></li>
                            <li><a href="set_bulan">Nama Bulan</a></li>
                            <li><a href="set_aplikasi">Aplikasi & Backup</a></li>
                            <li><a href="set_keamanan">Reset & Keamanan</a></li>
                            <li><a href="set_biaya_admin">Set Biaya Admin</a></li>
                            <!--
                       <li><a href="set_tentang">Tentang</a></li>
                   -->
                        </ul>
                    </li>
                <?php } ?>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->

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


              
                       <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-user-friends"></i>
                        <span> Pembayaran </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="summary">Ringkasan </a></li>
                       <li><a href="history">Riwayat</a></li>

             <!--            <li><a href="pay_data">Pembayaran Siswa</a></li>  -->
                       
                    </ul>
                </li>


                 

                       <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-user-friends"></i>
                        <span> Pengaturan </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="profil">Edit Profil</a></li>
                       <li><a href="password">Ganti Password</a></li>

             <!--            <li><a href="pay_data">Pembayaran Siswa</a></li>  -->
                       
                    </ul>
                </li>


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
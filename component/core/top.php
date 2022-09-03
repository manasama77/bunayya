<?php
include "configuration/config_connect.php";
$sql = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama, avatar FROM data where no='0'"));
?>
<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?php echo $_SESSION['avatar']; ?>" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    <?php echo $_SESSION['nama']; ?> <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Selamat Datang !</h6>
                </div>

                <!-- item-->
                <a href="user_edit" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Profil</span>
                </a>

                <a href="login_lock" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>Kunci Layar</span>
                </a>


                <div class="dropdown-divider"></div>



                <!-- item-->
                <a href="logout" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>Logout</span>
                </a>



            </div>
        </li>

        <li class="dropdown notification-list">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                <i class="fe-settings noti-icon"></i>
            </a>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="index" class="logo text-center">
            <span class="logo-lg">
                <h3 style="color:white" class="text-muted">
                    <?= $sql['nama']; ?>
                </h3>
                <!-- <span class="logo-lg-text-light">UBold</span> -->
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">U</span> -->
                <img src="<?php echo $sql['avatar']; ?>" alt="" height="28">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li class="d-none d-sm-block">
            <form class="app-search">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn" type="submit">
                                <i class="fe-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </li>

    </ul>
</div>
<!-- end Topbar -->
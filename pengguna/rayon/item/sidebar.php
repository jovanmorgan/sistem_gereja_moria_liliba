<?php
// Dapatkan URL saat ini
$current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ".php");
?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main" style="z-index: 10;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard" target="_blank">
            <img src="../../assets/img/gml.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Gereja Moria Liliba</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'dashboard') ? 'active bg-gradient-primary' : ''; ?>" href="dashboard">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'pendeta') ? 'active bg-gradient-primary' : ''; ?>" href="pendeta">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Pendeta</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'majelis') ? 'active bg-gradient-primary' : ''; ?>" href="majelis">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">people_outline</i>
                    </div>
                    <span class="nav-link-text ms-1">Majelis</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'rayon') ? 'active bg-gradient-primary' : ''; ?>" href="rayon">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">location_city</i>
                    </div>
                    <span class="nav-link-text ms-1">Rayon</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'permohonan_pelayanan') ? 'active bg-gradient-primary' : ''; ?>" href="permohonan_pelayanan">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Permohonan Pelayanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'jadwal_pelayanan') ? 'active bg-gradient-primary' : ''; ?>" href="jadwal_pelayanan">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">event_note</i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Pelayanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'jenis_pelayanan') ? 'active bg-gradient-primary' : ''; ?>" href="jenis_pelayanan">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">category</i>
                    </div>
                    <span class="nav-link-text ms-1">Jenis Pelayanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'pengumuman') ? 'active bg-gradient-primary' : ''; ?>" href="pengumuman">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">announcement</i>
                    </div>
                    <span class="nav-link-text ms-1">Pengumuman</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'pembabtisan') ? 'active bg-gradient-primary' : ''; ?>" href="pembabtisan">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">water</i>
                    </div>
                    <span class="nav-link-text ms-1">pembaptisan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'katekasasi') ? 'active bg-gradient-primary' : ''; ?>" href="katekasasi">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">school</i>
                    </div>
                    <span class="nav-link-text ms-1">Katekasasi</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'profile') ? 'active bg-gradient-primary' : ''; ?>" href="profile">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">account_circle</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo ($current_page == 'logout') ? 'active bg-gradient-primary' : ''; ?>" href="logout">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">logout</i>
                    </div>
                    <span class="nav-link-text ms-1">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
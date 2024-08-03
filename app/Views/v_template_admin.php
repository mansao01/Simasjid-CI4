<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMASJID |
        <?= $judul ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">


    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <!-- Select2 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/select2/js/select2.full.min.js"></script>
    <style>
        /* Hide elements when sidebar is collapsed */
        .sidebar-mini.sidebar-collapse .brand-link,
        .sidebar-mini.sidebar-collapse .brand-link h2,
        .sidebar-mini.sidebar-collapse .brand-link b {
            display: none !important;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto 1fr;
            /* 1 kolom auto dan 1 kolom fleksibel */
            gap: 0.5rem;
            /* Spasi antara label dan select */
        }

        .grid-item {
            align-self: center;
            /* Vertikal align tengah */
        }

        .checked {
            color: orange;
        }

        .star-rating {
            direction: rtl;
            display: inline-block;
        }

        .star-rating input[type=radio] {
            display: none;
        }

        .star-rating label {
            color: #bbb;
            font-size: 18px;
            padding: 0;
            cursor: pointer;
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #f2b600;
        }

        .star-rating input[type=radio]:checked~label {
            color: #bbb;
        }

        .star-rating input[type=radio]:checked+label {
            color: #f2b600;
        }

        .star-rating input[type=radio]:checked+label~label {
            color: #f2b600;
        }

        .agenda-details {
            display: flex;
            justify-content: space-between;
        }

        .agenda-info,
        .agenda-personnel {
            width: 60%;
            /* Adjust the width as needed */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <?php
    $db = \Config\Database::connect();
    $web = $db->table('tbl_profil_masjid')->get()->getRowArray();
    ?>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <h5 class="nav-link"><b>
                            <?= $web['nama_masjid'] ?>
                        </b></h5>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Login/Logout') ?>">
                        <i class="fas fa-sign-out-alt"></i>&nbsp;LogOut
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-success elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('Admin') ?>" class="brand-link text-center">
                <img src="<?= base_url('uploads/masjid komplit.png') ?>" alt="" style="max-height: 100px; /* adjust as needed */"><br>
                <h2><b>SIMASJID</b></h2>
            </a>
            <a class="brand-link text-center text-success">
                <b>
                    <?= session()->get('nama_user') ?>
                </b>
            </a>
            <?php $id_user = session()->get('id_user'); ?>
            <!-- Sidebar -->
            <div class="sidebar">
                <!--Level -->
                <?php $role_id = session()->get('role_id'); ?>
                <!-- Sidebar user panel (optional) -->
                <?php if ($role_id == 'admin') : ?>
                    <!-- Sidebar Menu Admin -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                            <!-- Dashboard -->
                            <li class="nav-item">
                                <a href="<?= base_url('Admin') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <!-- /.Profil Masjid -->
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/Setting') ?>" class="nav-link <?= $menu == 'profil-masjid' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-fingerprint"></i>
                                    <p>
                                        Profil Masjid
                                    </p>
                                </a>
                            </li>

                            <!-- /.Pengurus Masjid -->
                            <li class="nav-item">
                                <a href="<?= base_url('PengurusMasjid') ?>" class="nav-link <?= $menu == 'pengurus-masjid' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-id-card"></i>
                                    <p>
                                        Pengurus Masjid
                                    </p>
                                </a>
                            </li>

                            <!-- /.Agenda -->
                            <li class="nav-item <?= $menu == 'agenda' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'agenda' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>
                                        Kegiatan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Agenda') ?>" class="nav-link <?= $submenu == 'agenda-berjalan' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Kegiatan Berjalan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('Agenda/KegiatanSelesai') ?>" class="nav-link <?= $submenu == 'kegiatan-selesai' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Kegiatan Selesai</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- /.Uang Kas -->
                            <li class="nav-item <?= $menu == 'kas-masjid' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'kas-masjid' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-money-bill-wave"></i>
                                    <p>
                                        Keuangan Masjid
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/KasMasuk') ?>" class="nav-link <?= $submenu == 'kas-masuk' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Kas Masuk</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/KasKeluar') ?>" class="nav-link <?= $submenu == 'kas-keluar' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-danger"></i>
                                            <p>Kas Keluar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid') ?>" class="nav-link <?= $submenu == 'rekap-kas' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Rekap Kas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- /.Imam dan Khoib -->
                            <li class="nav-item <?= $menu == 'imam-khotib' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'imam-khotib' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Imam dan Khotib
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('ImamKhotib') ?>" class="nav-link <?= $submenu == 'data-imam-khotib' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Data Petugas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('ImamKhotib/JadwalImamKhotib') ?>" class="nav-link <?= $submenu == 'jadwal-imam-khotib' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Jadwal Imam dan Khotib</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu admin -->
                <?php elseif ($role_id == 'pengurus') : ?>
                    <!-- Sidebar Menu Pengurus -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                            <!-- Dashboard -->
                            <li class="nav-item">
                                <a href="<?= base_url('Admin') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <!-- /.Agenda -->
                            <li class="nav-item <?= $menu == 'agenda' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'agenda' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>
                                        Kegiatan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Agenda/KegiatanBerjalan') ?>" class="nav-link <?= $submenu == 'agenda-berjalan' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Kegiatan Berjalan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('Agenda/KegiatanDitanggung') ?>" class="nav-link <?= $submenu == 'kegiatan-ditanggung' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-danger"></i>
                                            <p>Kegiatan Di Tanggung</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('Agenda/KegiatanSelesai') ?>" class="nav-link <?= $submenu == 'kegiatan-selesai' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Kegiatan Selesai</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- /.Uang Kas -->
                            <li class="nav-item <?= $menu == 'kas-masjid' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'kas-masjid' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-money-bill-wave"></i>
                                    <p>
                                        Keuangan Masjid
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/KasMasuk') ?>" class="nav-link <?= $submenu == 'kas-masuk' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Kas Masuk</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/KasKeluar') ?>" class="nav-link <?= $submenu == 'kas-keluar' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-danger"></i>
                                            <p>Kas Keluar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid') ?>" class="nav-link <?= $submenu == 'rekap-kas' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Rekap Kas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- /.Laporan Keuangan -->
                            <li class="nav-item <?= $menu == 'laporan-kas' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'laporan-kas' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                    <p>
                                        Laporan Kas
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/Laporan') ?>" class="nav-link <?= $submenu == 'laporan-kas-masjid' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Laporan Kas Masjid</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/RiwayatCetakLaporan') ?>" class="nav-link <?= $submenu == 'laporan-kas-riwayat' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Riwayat Cetak Laporan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu pengurus -->
                <?php elseif ($role_id == 'ketua') : ?>
                    <!-- Sidebar Menu Ketua -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                            <!-- Dashboard -->
                            <li class="nav-item">
                                <a href="<?= base_url('Admin') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <!-- Agenda -->
                            <li class="nav-item">
                                <a href="<?= base_url('Agenda') ?>" class="nav-link <?= $menu == 'agenda' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>
                                        Agenda
                                    </p>
                                </a>
                            </li>

                            <!-- /.Uang Kas -->
                            <li class="nav-item <?= $menu == 'kas-masjid' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'kas-masjid' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-money-bill-wave"></i>
                                    <p>
                                        Keuangan Masjid
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/KasMasuk') ?>" class="nav-link <?= $submenu == 'kas-masuk' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Kas Masuk</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/KasKeluar') ?>" class="nav-link <?= $submenu == 'kas-keluar' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-danger"></i>
                                            <p>Kas Keluar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid') ?>" class="nav-link <?= $submenu == 'rekap-kas' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Rekap Kas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- /.Uang Sosial -->
                            <li class="nav-item <?= $menu == 'kas-sosial' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'kas-sosial' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-hand-holding-heart"></i>
                                    <p>
                                        Uang Kas Sosial
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasSosial/KasMasuk') ?>" class="nav-link <?= $submenu == 'kas-sosial-masuk' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Kas Masuk</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasSosial/KasKeluar') ?>" class="nav-link <?= $submenu == 'kas-sosial-keluar' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-danger"></i>
                                            <p>Kas Keluar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasSosial') ?>" class="nav-link <?= $submenu == 'rekap-kas-sosial' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Rekap Kas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- /.Laporan Keuangan -->
                            <li class="nav-item <?= $menu == 'laporan-kas' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'laporan-kas' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                    <p>
                                        Laporan Kas
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/Laporan') ?>" class="nav-link <?= $submenu == 'laporan-kas-masjid' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Laporan Kas Masjid</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasSosial/Laporan') ?>" class="nav-link <?= $submenu == 'laporan-kas-sosial' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-danger"></i>
                                            <p>Laporan Kas Sosial</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- /.Rekening -->
                            <li class="nav-item">
                                <a href="<?= base_url('Rekening') ?>" class="nav-link <?= $menu == 'rekening' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-money-check"></i>
                                    <p>
                                        Rekening
                                    </p>
                                </a>
                            </li>

                            <!-- /.Donasi Masuk -->
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/DonasiMasuk') ?>" class="nav-link <?= $menu == 'donasi' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-hand-holding-usd"></i>
                                    <p>
                                        Donasi Masuk
                                    </p>
                                </a>
                            </li>

                            <!-- /.Qurban -->
                            <li class="nav-item <?= $menu == 'qurban' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'qurban' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>
                                        Qurban
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Tahun') ?>" class="nav-link <?= $submenu == 'tahun-qurban' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Tahun Qurban</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('PesertaQurban') ?>" class="nav-link <?= $submenu == 'peserta-qurban' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-danger"></i>
                                            <p>Peserta Qurban</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- /.User -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        User
                                    </p>
                                </a>
                            </li>

                            <!-- /.Setting -->
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/Setting') ?>" class="nav-link <?= $menu == 'setting' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Setting
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu Ketua -->
                <?php elseif ($role_id == 'jamaah') : ?>
                    <!-- Sidebar Menu Jamaah -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                            <!-- Dashboard -->
                            <li class="nav-item">
                                <a href="<?= base_url('Admin') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <!-- /.Profil -->
                            <li class="nav-item">
                                <a href="<?= base_url('Profile/ProfileJamaah/' . $id_user) ?>" class="nav-link <?= $menu == 'profile' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Profil
                                    </p>
                                </a>
                            </li>

                            <!-- /.Agenda -->
                            <li class="nav-item <?= $menu == 'agenda' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'agenda' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>
                                        Kegiatan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Agenda/KegiatanBerjalan') ?>" class="nav-link <?= $submenu == 'agenda-berjalan' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Kegiatan Berjalan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('Agenda/KegiatanSelesai') ?>" class="nav-link <?= $submenu == 'kegiatan-selesai' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Kegiatan Selesai</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- /.Uang Kas -->
                            <li class="nav-item <?= $menu == 'kas-masjid' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'kas-masjid' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-money-bill-wave"></i>
                                    <p>
                                        Keuangan Masjid
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/KasMasuk') ?>" class="nav-link <?= $submenu == 'kas-masuk' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-success"></i>
                                            <p>Kas Masuk</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid/KasKeluar') ?>" class="nav-link <?= $submenu == 'kas-keluar' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-danger"></i>
                                            <p>Kas Keluar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('KasMasjid') ?>" class="nav-link <?= $submenu == 'rekap-kas' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Rekap Kas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu jamaah -->
                <?php endif; ?>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">
                                <?= $judul ?>
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li> -->
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        if ($page) {
                            echo view($page);
                        }
                        ?>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <!-- Anything you want -->
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; Skripsi SI UMK 2024.</strong> 
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        $(function() {
            $("#example2").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            });
        });
    </script>
</body>

</html>
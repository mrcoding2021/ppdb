<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- <title><?= $title ?></title> -->

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url() ?>asset/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- <script src="<?= base_url() ?>asset/admin/vendor/jquery/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>asset/vendor/jquery-ui/jquery-ui.js"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url() ?>asset/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('asset/admin/css/my.css') ?>">
    <link rel="stylesheet" href="<?= base_url() ?>asset/vendor/jquery-ui/jquery-ui.css">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script src="<?= base_url() ?>asset/admin/js/demo/datatables-demo.js"></script>
    
</head>
<style>
    .bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #f3f3f3;
        opacity: 0.8;
    }

    #loader {
        position: relative;
        top: 40vh;
        margin: auto;
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 0.5s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
               
    .ui-autocomplete {
        max-height: 200px;
                   overflow-y: auto;
                   /* prevent horizontal scrollbar */
                   overflow-x: hidden;
               }

              
               * html .ui-autocomplete {
                   height: 200px;
               }
</style>
<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="text-center" href="#">
                <img src="<?= base_url('asset/img/logo-sdit.png') ?>" width="200" alt="">
                <h5 class=" text-center text-white">SDIT Insan Mulia</h5>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php if ($title == 'Admin') : ?>
                <li class="nav-item hover active bg-darknes">
                <?php else : ?>
                <li class="nav-item hover">
                <?php endif ?>
                <a class="nav-link" href="<?php echo base_url('admin') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <!-- <hr class="sidebar-divider"> -->
                <style>
                    .hover:hover {
                        background-color: darkslategrey;
                    }

                    .bg-darknes {
                        background-color: darkslategrey;
                    }
                </style>
                <?php foreach ($admin as $key) : ?>

                    <?php
                    $data = $key['id_user'];
                    $array = array(
                        'acces' => $data,
                        'is_active' => 1,
                        'parent' => 0
                    );
                    $menu = $this->db->get_where('tb_menu', $array)->result_array();;
                    // $queryMenu = "SELECT * FROM `tb_menu` WHERE `acces` = $data AND `is_active`= 1 AND 'parent' = 0";
                    // $menu = $this->db->query($queryMenu)->result_array();
                    ?>
                    <?php foreach ($menu as $m) : ?>
                        <!-- Nav Item - Pages Collapse Menu -->
                        <?php if ($title == $m['nama']) : ?>
                            <li class="nav-item hover active bg-darknes">
                            <?php else : ?>
                            <li class="nav-item hover">
                            <?php endif ?>
                            <?php if ($m['dropdown'] == 1) : ?>
                                <a class="nav-link collapsed" data-target="#<?= str_replace(' ', '-', $m['nama']) ?>" data-toggle="collapse">
                                    <i class="fas fa-fw <?= $m['icon'] ?>"></i>
                                    <span><?= $m['nama'] ?></span>
                                </a>
                                <div id="<?= str_replace(' ', '-', $m['nama']) ?>" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <?php
                                        $menu2 = $this->db->get_where(
                                            'tb_menu',
                                            array(
                                                'parent' => $m['id_menu'],
                                                'dropdown' => 0,
                                                'is_active' => 1
                                            )
                                        )->result_array();
                                        foreach ($menu2 as $m2) : ?>
                                            <a class="collapse-item" href="<?= base_url($m2['attr_href']) ?>"><?= $m2['nama'] ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <a class="nav-link collapsed" href="<?= base_url($m['attr_href']) ?>" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-fw <?= $m['icon'] ?>"></i>
                                    <span><?= $m['nama'] ?></span>
                                </a>
                            <?php endif ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>


                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item my-auto">
                            <span>
                                
                            </span>
                        </li>
                        <!-- Nav Item - Alerts -->
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang,
                                    <?= $this->session->userdata('user') ?>
                                </span>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('admin/profil') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="<?= base_url('admin/change_password') ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('admin/logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
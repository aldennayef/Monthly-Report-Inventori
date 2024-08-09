<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$user['sub_department']?> | Tambah Menu</title>

    <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/sweetalert2-theme-bootstrap-4/sweetalert2.min.css')?>">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="<?=base_url('assets/img/AdminLTELogo.png')?>" alt="AdminLTELogo" height="60" width="60">
    </div>

    <nav class="main-header navbar navbar-expand navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php 
                if ($this->session->userdata('role_id') == 1) {
                    echo base_url('butterfly');
                } elseif ($this->session->userdata('role_id') == 2) {
                    echo base_url('maloch');
                } elseif ($this->session->userdata('role_id') == 3) {
                    echo base_url('zephys');
                } elseif ($this->session->userdata('role_id') == 4) {
                    echo base_url('gon');
                } else {
                    echo base_url('errorpage'); // fallback jika role_id tidak sesuai
                }
                ?>" class="nav-link">Home</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="darkModeSwitch" role="button">
                    <i class="fas fa-sun"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="<?php
            if ($this->session->userdata('role_id') == 1) {
                echo base_url('butterfly');
            } elseif ($this->session->userdata('role_id') == 2) {
                echo base_url('maloch');
            } elseif ($this->session->userdata('role_id') == 3) {
                echo base_url('zephys');
            } elseif ($this->session->userdata('role_id') == 4) {
                echo base_url('gon');
            } else {
                echo base_url('errorpage'); // fallback jika role_id tidak sesuai
            }
        ?>" class="brand-link">
            <img src="<?=base_url('assets/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><?=$user['department']?></span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?=base_url('assets/img/user2-160x160.jpg')?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?=$user['nama']?></a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="<?php 
                        if ($this->session->userdata('role_id') == 1) {
                            echo base_url('butterfly');
                        } elseif ($this->session->userdata('role_id') == 2) {
                            echo base_url('maloch');
                        } elseif ($this->session->userdata('role_id') == 3) {
                            echo base_url('zephys');
                        } elseif ($this->session->userdata('role_id') == 4) {
                            echo base_url('gon');
                        } else {
                            echo base_url('errorpage'); // fallback jika role_id tidak sesuai
                        }
                    ?>" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                    <li class="nav-header">FEATURES</li>
                    <?php foreach ($menu as $m): ?>
                        <li class="nav-item">
                            <a href="<?=base_url($m['link_href'])?>" class="nav-link">
                                <i class="nav-icon far fa-circle text-info"></i>
                                <p><?= $m['menu'] ?></p>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <li class="nav-header">ACTIONS</li>
                    <li class="nav-item">
                        <a href="<?=base_url('logout')?>" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sistem Informasi Monthly Report (SIMR)</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Menu</h3>
                            </div>
                            <form action="<?=base_url('freya')?>" method="POST">
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bars"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Menu" name="menu" autocomplete="off" required>
                                        <div class="input-group">
                                            <?= form_error('menu', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Link" name="link_href" autocomplete="off" required>
                                        <div class="input-group">
                                            <?= form_error('link_href', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Otorisasi Role</label>
                                        <?php foreach ($roles as $role): ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="access_role" value="<?=$role['id']?>" required>
                                                <label class="form-check-label"><?=$role['role']?></label>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="input-group">
                                            <?= form_error('access_role', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-primary" id="btnAdd" name="btnAdd">Tambah Menu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark"></aside>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
        &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>. All rights reserved.
    </footer>
</div>

<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<script src="<?=base_url('assets/js/adminlte.js')?>"></script>
<!-- Light-Dark Mode -->
<script src="<?=base_url('assets/js/lightdarkmode.js')?>"></script>
<!-- SweetAlert2 -->
<script src="<?=base_url('assets/plugins/sweetalert2/sweetalertnotif2.min.js')?>"></script>

<script>
$(document).ready(function(){
    $('#btnAdd').on('click', function (e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Pastikan semua data sudah benar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambah menu!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('form').submit();
            }
        })
    });
});
</script>

</body>
</html>

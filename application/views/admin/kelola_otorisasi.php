<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$user['sub_department']?> | Kelola Otorisasi</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/sweetalert2-theme-bootstrap-4/sweetnotifalert2.min.css')?>">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
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

    <!-- Right navbar links -->
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
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
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

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="<?=base_url('assets/img/user2-160x160.jpg')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block"><?=$user['nama']?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
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
    <!-- /.sidebar-menu -->
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
            <h1 class="m-0">Kelola Otorisasi Menu</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Ototisasi Menu</h3>
                    </div>
                    <form name="updateAuthorize" method="post" action="<?= base_url('upsi/'.$menu_id) ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="menu_name">Nama Menu</label>
                                <input type="text" id="menu_name" name="menu_name" class="form-control" value="<?= $menu_details['menu'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="menu_link">Link</label>
                                <input type="text" id="menu_link" name="menu_link" class="form-control" value="<?= $menu_details['link_href'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="roles">Roles</label>
                                <?php foreach ($roles as $role): ?>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="role_<?= $role['role_id'] ?>" name="roles[]" value="<?= $role['role_id'] ?>"
                                            <?= in_array($role['role_id'], array_column($access_roles, 'role_id')) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="role_<?= $role['role_id'] ?>"><?= $role['role'] ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button type="submit" class="btn btn-primary" id="buttonUpdate" name="buttonUpdate">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
    </div>
    &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>. All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/js/adminlte.js')?>"></script>
<!-- Light-Dark Mode -->
<script src="<?=base_url('assets/js/lightdarkmode.js')?>"></script>
<script src="<?=base_url('assets/plugins/sweetalert2/sweetalertnotif2.min.js')?>"></script>

<script>
    $('#buttonUpdate').on('click', function (e) {
    e.preventDefault();
    var isValid = true;

    // Periksa setiap input yang diperlukan
    $('input[required], select[required]').each(function() {
        if ($(this).val() === '') {
            isValid = false;
            return false; // Menghentikan loop jika ada yang kosong
        }
    });

    if (!isValid) {
        Swal.fire({
            icon: 'warning',
            title: 'Mohon lengkapi data',
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            confirmButton: 'Oke'
        });
    } else {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Pastikan semua data sudah benar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, update data!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('form[name="updateAuthorize"]').submit();
        }
    });
    }
});

</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$user['sub_department']?> | Edit Akses Report</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/sweetalert2-theme-bootstrap-4/sweetnotifalert2.min.css')?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>">
    <style>
        .card-header {
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .card-header h5 {
            flex-grow: 1;
            margin: 0;
        }
        .select-all-container {
            display: flex;
            align-items: center;
        }
        .select-all-checkbox {
            margin-right: 8px;
        }
    </style>
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
            <h1 class="m-0">Sistem Informasi Monthly Report (SIMR)</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Akses Report</h3>
                    </div>
                    <form name="editAksesReport" method="post" action="<?= base_url('user/admin/edit_akses_report') ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="manager_id" value="<?= $manager['id'] ?>">
                                <label for="manager_name">Nama Manager</label>
                                <input type="text" id="manager_name" name="manager_name" class="form-control" value="<?= $manager['nama'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" id="department" name="department" class="form-control" value="<?= $manager['department'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="reports">List Reports</label>
                                <?php foreach ($grouped_reports as $department => $reports): ?>
                                    <div class="card">
                                        <div class="card-header select-all-container">
                                            <input type="checkbox" class="select-all-checkbox" data-department="<?= strtolower(str_replace(' ', '_', $department)) ?>" />
                                            <h5 class="mb-0">
                                                <a class="card-link" data-toggle="collapse" href="#<?= strtolower(str_replace(' ', '_', $department)) ?>_collapse">
                                                    <?= $department ?>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="<?= strtolower(str_replace(' ', '_', $department)) ?>_collapse" class="collapse">
                                            <div class="card-body">
                                                <?php foreach ($reports as $report): ?>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input report-checkbox" data-department="<?= strtolower(str_replace(' ', '_', $department)) ?>" id="report_<?= $report['id'] ?>" name="reports[]" value="<?= $report['id'] ?>"
                                                            <?= in_array($report['id'], array_column($access_reports, 'kolom_id')) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="report_<?= $report['id'] ?>">
                                                            <?= $report['report'] ?> (<?= $report['sub_report'] ?> - <?= $report['status'] ?>)
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
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
    $(document).ready(function() {
        // Fungsi untuk mengatur checkbox "Select All"
        $(document).on('change', '.select-all-checkbox', function(event) {
            event.stopPropagation();
            var department = $(this).data('department');
            var isChecked = $(this).is(':checked');
            $('.report-checkbox[data-department="' + department + '"]').prop('checked', isChecked);
        });

        // Fungsi untuk toggle collapse saat card-header diklik, kecuali saat checkbox diklik
        $('.card-header').on('click', function(event) {
            if (!$(event.target).is('.select-all-checkbox')) {
                var target = $(this).find('.card-link').attr('href');
                $(target).collapse('toggle');
            }
        });

        $('#buttonUpdate').on('click', function(e) {
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
                    confirmButtonText: 'Oke'
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
                        var formData = $('form[name="editAksesReport"]').serialize();
                        $.ajax({
                            url: '<?= base_url('user/admin/edit_akses_report') ?>', // Sesuaikan URL dengan URL tujuan submit form
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil disimpan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke'
                                }).then(() => {
                                    window.location.href = '<?= base_url('rourke') ?>'; // Ganti dengan URL tujuan Anda
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error: ' + status + error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi kesalahan saat menyimpan data',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke'
                                });
                            }
                        });
                    }
                });
            }
        });
    });
</script>

</body>
</html>

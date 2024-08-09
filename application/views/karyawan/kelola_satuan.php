<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$user['sub_department']?> | Kelola Satuan</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?=base_url('assets/img/AdminLTELogo.png')?>" alt="AdminLTELogo" height="60" width="60">
</div>

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
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
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
            <p>
            Log Out
            </p>
        </a>
        </li>
    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper -->
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <a href="<?=base_url('taara')?>">
                    <button type="button" class="btn btn-success mb-2">
                        <i class="fas fa-plus"></i> Add Satuan
                    </button>
                    </a>
                </div>
            </div>

            <!-- Tabel untuk menampilkan kolom yang sudah ada -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">LIST SATUAN</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nama Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($satuan)): ?>
                                        <?php foreach($satuan as $satuans): ?>
                                            <tr>
                                                <td><?= $satuans['satuan'] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn" data-satuanid="<?= $satuans['id'] ?>"><i class="fas fa-pen"></i> Edit</button> | 
                                                    <button class="btn btn-sm btn-danger btnDel" data-satuanid="<?= $satuans['id'] ?>"><i class="fas fa-trash"></i> Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">Tidak ada kolom yang ditemukan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
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

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?=base_url('assets/plugins/jquery-mousewheel/jquery.mousewheel.js')?>"></script>
<script src="<?=base_url('assets/plugins/raphael/raphael.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/jquery-mapael/jquery.mapael.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/jquery-mapael/maps/usa_states.min.js')?>"></script>
<!-- ChartJS -->
<script src="<?=base_url('assets/plugins/chart.js/Chart.min.js')?>"></script>
<!-- Light-Dark Mode -->
<script src="<?=base_url('assets/js/lightdarkmode.js')?>"></script>
<!-- SweetAlert2 -->
<script src="<?=base_url('assets/plugins/sweetalert2/sweetalertnotif2.min.js')?>"></script> 

<!-- Pastikan jQuery sudah dimuat sebelum script ini -->
<script>
$(document).ready(function() {
    // Event listener untuk tombol edit
    $('.edit-btn').on('click', function() {
        var satuanId = $(this).data('satuanid');
        window.location.href = "<?= base_url('arum') ?>/" + satuanId;
    });

    $('#department').change(function() {
        var department_id = $(this).val();
        console.log('Selected Department ID:', department_id);
        if(department_id != '') {
            $.ajax({
                url: "<?= base_url('user/admin/get_sub_departments') ?>",
                method: "POST",
                data: {department_id: department_id},
                dataType: "json",
                success: function(data) {
                    console.log('Received Data:', data);
                    $('#sub_department').html('<option value="">Select Sub Department</option>');
                    $.each(data, function(key, value) {
                        $('#sub_department').append('<option value="' + value.id + '" data-role="' + value.role_id + '">' + value.sub_department + '</option>');
                    });
                    $('#sub_department').removeAttr('disabled');
                    $('#sub_department').change(function() {
                        var selected_role_id = $(this).find(':selected').data('role');
                        $('#role_id').val(selected_role_id);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            $('#sub_department').html('<option value="">Select Sub Department</option>');
            $('#sub_department').attr('disabled', 'disabled');
        }
    });

    // Inisialisasi untuk disable sub_department pertama kali
    $('#sub_department').attr('disabled', 'disabled');

    // Tombol delete
    $('.btnDel').on('click', function (e) {
        e.preventDefault();

        var satuanId = $(this).data('satuanid'); // Get satuan ID from data attribute

        Swal.fire({
            title: 'Delete Satuan',
            text: "Apakah anda yakin menghapus satuan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('laville') ?>", // Adjust this URL to your actual delete endpoint
                    method: "POST",
                    data: {id: satuanId},
                    success: function(response) {
                        // Handle success (reload the page, show a success message, etc.)
                        Swal.fire(
                            'Deleted!',
                            'Satuan telah dihapus.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        Swal.fire(
                            'Error!',
                            'Ada kesalahan dalam menghapus satuan.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
</body>
</html>

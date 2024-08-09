<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$user['sub_department']?> | Kelola Kolom</title>

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
                    <a href="<?=base_url('seizu')?>">
                    <button type="button" class="btn btn-success mb-2">
                        <i class="fas fa-plus"></i> Add Report
                    </button>
                    </a>
                </div>
            </div>

            <!-- Tabel untuk menampilkan kolom yang sudah ada -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">LIST KOLOM</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" id="table_search" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="debounceSearch()">
                                    <div class="input-group-append">
                                    <button type="button" class="btn btn-default" onclick="searchReports()">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Kolom</th>
                                        <th>Sub Kolom</th>
                                        <th>Spesifikasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="search_results">
                                    <?php if(!empty($columns)): ?>
                                        <?php $i=1;foreach($columns as $column): ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $column['report'] ?></td>
                                                <td><?= $column['sub_report'] ?></td>
                                                <td><?= $column['status'] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn" data-columnid="<?= $column['id'] ?>"><i class="fas fa-pen"></i> Edit</button> 
                                                    <?php if($this->session->userdata('role_id') == 1): ?>
                                                        | <button class="btn btn-sm btn-danger btnDel" data-userid="<?= $column['id'] ?>"><i class="fas fa-trash"></i> Delete</button>
                                                    <?php endif; ?>
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
    function addEditButtonListeners() {
    $('.edit-btn').on('click', function() {
        var columnId = $(this).data('columnid');
        window.location.href = "<?= base_url('edit_column/') ?>" + columnId;
    });
    }

    // Event listener untuk tombol delete
    function addDeleteButtonListeners() {
    $('.btnDel').on('click', function (e) {
        e.preventDefault();

        var columnId = $(this).data('columnid'); // Get column ID from data attribute

        Swal.fire({
            title: 'Delete Report',
            text: "Apakah anda yakin menghapus report ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('shin') ?>", // Adjust this URL to your actual delete endpoint
                    method: "POST",
                    data: {id: columnId},
                    success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'Report telah dihapus.',
                        'success'
                    ).then(() => {
                        searchReports(); // Refresh the data after deletion
                    });
                },
                    error: function(xhr, status, error) {
                        Swal.fire(
                        'Error!',
                        'Ada kesalahan dalam menghapus report.',
                        'error'
                        );
                    }
                });
            }
        });
    });
    }

        let debounceTimeout;
        function debounceSearch() {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(searchReports, 100); // Debounce selama 100ms
        }

        // Fungsi untuk melakukan pencarian
        function searchReports() {
        var query = $('#table_search').val();
        $.ajax({
            url: "<?= base_url('kepot') ?>",
            method: 'GET',
            data: { query: query },
            success: function(response) {
            var results = $('#search_results');
            if (results) {
                if (response.trim() === '') {
                results.html('<tr><td colspan="6">Data tidak ditemukan</td></tr>');
                } else {
                results.html(response);
                addEditButtonListeners(); // Tambahkan event listener untuk tombol edit setelah hasil pencarian dimuat
                addDeleteButtonListeners(); // Tambahkan event listener untuk tombol delete setelah hasil pencarian dimuat
                }
            } else {
                console.error('Element with id "search_results" not found.');
            }
            },
            error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + error);
            }
        });
        }

        // Inisialisasi event listener pada saat pertama kali halaman dimuat
        addEditButtonListeners();
        addDeleteButtonListeners();

        $('#table_search').on('keyup', debounceSearch);
    });
</script>
</body>
</html>

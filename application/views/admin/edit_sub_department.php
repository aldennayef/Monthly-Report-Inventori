<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$user['sub_department']?> | Edit Sub Department</title>

<!-- Google Font: Source Sans Pro -->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
<!-- Theme style -->
<link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">
<link rel="stylesheet" href="<?=base_url('/plugins/sweetalert2-theme-bootstrap-4/sweetnotifalert2.min.css')?>">
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
        <div class="col-6">
            <!-- Input data -->
            <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Data Sub Department</h3>
            </div>
            <form action="<?=base_url('admin/edit_sub_department')?>" name="editForm" method="POST">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Kode Department" id="kodedept" name="kodedept" value="<?=$dataTarget['kode_dept']?>" autocomplete="off" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-landmark"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Sub Department" name="sub_department" value="<?=$dataTarget['sub_department']?>" autocomplete="off" required>
                    </div>
                    
                    <!-- Dropdown untuk memilih department -->
                    <div class="form-group mb-3">
                        <label for="department">Pilih Department</label>
                        <select class="form-control" id="department" name="department_id" required>
                            <?php foreach ($department as $dept): ?>
                                <option value="<?=$dept['id']?>" <?=($dept['id'] == $dataTarget['department_id']) ? 'selected' : ''?>><?=$dept['department']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input type="hidden" class="form-control" id="id" name="id" readonly value="<?=$dataTarget['id']?>">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" id="btnEdit" name="btnEdit">Submit</button>
                    </div>
                </div>
            </form>
            </div>
            <!-- /.card -->
        </div>
        </div>
        <!-- /.row -->

    </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

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
    $(document).ready(function(){
        $('#department').change(function() {
        var department_id = $(this).val();
        $.ajax({
            url: '<?= base_url('user/admin/get_department_code') ?>',
            method: 'POST',
            data: { department_id: department_id },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.kode) {
                    $('#kodedept').val(data.kode);
                } else {
                    $('#kodedept').val('');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    });

    // Tombol submit
    $('#btnEdit').on('click', function (e) {
        e.preventDefault();
        var isValid = true;

        var kodeDept = $('input[name="kodedept"]').val().trim();
        var subdepartment = $('input[name="sub_department"]').val().trim();

        // Periksa setiap input yang diperlukan
        $('input[required]').each(function() {
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
        } 
        else {
            $.ajax({
                url: '<?=base_url('user/admin/check_sub_department_added')?>', // Sesuaikan URL dengan fungsi check_user_add
                type: 'POST',
                data: {kodedept:kodeDept, sub_department:subdepartment},
                dataType: 'json',
                success: function(response) {
                if (response.status === '1') {
                    Swal.fire({
                    icon: 'warning',
                    title: 'Sub Department Sudah Ada !',
                    text: subdepartment+' Sudah Ada !',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Oke'
                    });
                }
                else {
                    Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Pastikan semua data sudah benar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan data!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form jika konfirmasi
                        var formData = $('form[name="editForm"]').serialize();
                        $.ajax({
                            url: '<?=base_url('denji')?>', // Sesuaikan URL dengan URL tujuan submit form
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                            // Tampilkan pesan sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Sub Department berhasil diupdate !',
                                showConfirmButton: true,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Oke'
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location.href = '<?=base_url('angela')?>';
                                }
                            })
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
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        }
    });
});
</script>


</body>
</html>

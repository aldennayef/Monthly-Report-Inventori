<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$user['sub_department']?> | Tambah Department</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/sweetalert2-theme-bootstrap-4/sweetnotifalert2.min.css')?>">
  <style>
    .menu-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      justify-content: center;
    }
    .menu-item {
      cursor: pointer;
      padding: 10px;
      text-align: center;
      font-size: 16px;
      transition: background-color 0.3s ease, color 0.3s ease;
      display: inline-block;
    }
    .menu-item.active, .menu-item:hover {
      background-color: #03346E;
      color: white;
    }
    .form-section {
      display: none;
    }
    .form-section.active {
      display: block;
    }
  </style>
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

        <div class="row mt-4">
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="menu-container">
                            <div class="menu-item" id="department-menu">Department</div>
                            <div class="menu-item" id="sub-department-menu">Sub Department</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-6">
            <!-- Input data -->
            <div class="card card-info form-section" id="department-form">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Input Data Department</h3>
                    </div>
                    <form action="" name="departmentForm" method="POST">
                        <div class="card-body">
                        
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Kode Department" name="kode_dept" autocomplete="off" required>
                                <div class="input-group">
                                    <?= form_error('kode_dept', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-landmark"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Department" name="department" autocomplete="off" required>
                                <div class="input-group">
                                    <?= form_error('department', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary" id="btnAddDepartment" name="btnAddDepartment">Submit</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->
            </div>
          </div>

          <div class="col-6">
            <div class="card card-info form-section" id="sub-department-form">
                <!-- Input data -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Input Data Sub Department</h3>
                    </div>
                    <form action="" name="subdepartmentForm" method="POST">
                        <div class="card-body">

                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" id="department" name="department">
                                    <option value="">Select Department</option>
                                    <?php foreach ($department as $depart): ?>
                                        <option value="<?=$depart['id']?>" data-kode="<?=$depart['kode']?>" data-namadept="<?=$depart['department']?>"><?=$depart['department']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- /input-group -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Sub Department" name="sub_department" autocomplete="off">
                            </div>
                            <input type="text" class="form-control" id="kodedept" name="kodedept" readonly hidden>
                            <input type="text" class="form-control" id="namadepartment" name="namadepartment" readonly hidden>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary" id="btnAddSubDepartment" name="btnAddSubDepartment">Submit</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
    $(document).ready(function() {
        // Set default active menu and form
      $('#department-menu').addClass('active');
      $('#department-form').addClass('active');

      $('#department-menu').click(function() {
        $('#department-form').addClass('active');
        $('#sub-department-form').removeClass('active');
        $(this).addClass('active');
        $('#sub-department-menu').removeClass('active');
      });

      $('#sub-department-menu').click(function() {
        $('#sub-department-form').addClass('active');
        $('#department-form').removeClass('active');
        $(this).addClass('active');
        $('#department-menu').removeClass('active');
      });

      $('#department').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var kode = selectedOption.data('kode');
            var namadept = selectedOption.data('namadept');
            $('#kodedept').val(kode);
            $('#namadepartment').val(namadept);
        });
    });

  // Tombol submit department
  $('#btnAddSubDepartment').on('click', function (e) {
    e.preventDefault();
    
    // Validasi form
    var kodeDept = $('input[name="kodedept"]').val().trim();
    var subdepartment = $('input[name="sub_department"]').val().trim();
    var namadepartment = $('input[name="namadepartment"]').val()

    if(!kodeDept || !subdepartment) {
      // Jika ada input yang kosong
      Swal.fire({
        icon: 'warning',
        title: 'Mohon lengkapi data',
        showConfirmButton: true,
        confirmButtonColor: '#3085d6',
        confirmButton: 'Oke'
      });
      return;
    }
    else{
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
              text: subdepartment+' Sudah Ada di '+namadepartment+' !',
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
                var formData = $('form[name="subdepartmentForm"]').serialize();
                  $.ajax({
                    url: '<?=base_url('joker')?>', // Sesuaikan URL dengan URL tujuan submit form
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                      // Tampilkan pesan sukses
                      Swal.fire({
                        icon: 'success',
                        title: 'Sub Department berhasil ditambahkan',
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

// Tombol submit sub department
$('#btnAddDepartment').on('click', function (e) {
    e.preventDefault();
    
    // Validasi form
    var kodeDept = $('input[name="kode_dept"]').val().trim();
    var department = $('input[name="department"]').val().trim();

    if (!kodeDept || !department) {
        // Jika ada input yang kosong
        Swal.fire({
            icon: 'warning',
            title: 'Mohon lengkapi data',
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            confirmButton: 'Oke'
        });
        return;
    }
    else{
      $.ajax({
        url: '<?=base_url('user/admin/check_department_added')?>', // Sesuaikan URL dengan fungsi check_user_add
        type: 'POST',
        data: {kode_dept:kodeDept},
        dataType: 'json',
        success: function(response) {
          if (response.status === '1') {
            Swal.fire({
              icon: 'warning',
              title: 'Kode Department Sudah Ada !',
              showConfirmButton: true,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Oke'
            });
          }else {
            // Tampilkan konfirmasi sebelum submit
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
                var formData = $('form[name="departmentForm"]').serialize();
                $.ajax({
                    url: '<?=base_url('flash')?>', // Sesuaikan URL dengan URL tujuan submit form
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                      // Tampilkan pesan sukses
                      Swal.fire({
                        icon: 'success',
                        title: 'Department berhasil ditambahkan',
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Oke'
                      }).then((result) => {
                        if (result.isConfirmed){
                            window.location.href='<?=base_url('angela')?>';
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
</script>


</body>
</html>

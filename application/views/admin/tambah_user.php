<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$user['sub_department']?> | Tambah User</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('plugins/sweetalert2-theme-bootstrap-4/sweetnotifalert2.min.css')?>">
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
                <h3 class="card-title">Input Data User</h3>
              </div>
                <form action="<?=base_url('kahli')?>" name="userForm" method="POST">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" required>
                            <div class="input-group">
                              <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password" value="1234" required>
                            <div class="input-group-append">
                              <span class="input-group-text" id="togglePassword">
                                <i class="fas fa-eye"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-pen"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nama" name="nama" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="NIK" name="nik" autocomplete="off" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" id="department" name="department" required>
                              <option value="">Select Department</option>
                              <?php foreach ($department as $depart):?>
                              <option value="<?=$depart['id']?>"><?=$depart['department']?></option>
                              <?php endforeach;?>
                            </select>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label>Sub Department</label>
                            <select class="form-control" id="sub_department" name="sub_department" required>
                              <option value=""></option>
                            </select>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label>Posisi</label>
                            <select class="form-control" id="posisi" name="posisi" required>
                              <option value="1">Admin</option>
                              <option value="4">Admin Department</option>
                              <option value="2">Manager</option>
                              <option value="3">PIC</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" id="btnAdd" name="btnAdd">Submit</button>
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
  $(document).ready(function(){
    $('#togglePassword').on('click', function() {
      const passwordField = $('#password');
      const passwordFieldType = passwordField.attr('type');
      const icon = $(this).find('i');
      
      if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordField.attr('type', 'password');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });

    $('#department').change(function(){
      var department_id = $(this).val();

      // Jika department bukan Admin
      if(department_id != '1'){ // Gantilah '1' dengan ID department untuk Admin yang benar
        $('#posisi').html('<option value="4">Admin Department</option><option value="2">Manager</option><option value="3">PIC</option>');
      }
      else {
        $('#posisi').html('<option value="1">Admin</option>');
      }

      if(department_id != ''){
        $.ajax({
          url: "<?=base_url('user/admin/get_sub_departments')?>",
          method: "POST",
          data: {department_id: department_id},
          dataType: "json",
          success: function(data){
            console.log('Received Data:', data);
            $('#sub_department').html('<option value="">Select Sub Department</option>');
            $.each(data, function(key, value){
              $('#sub_department').append('<option value="'+value.id+'">'+value.sub_department+'</option>');
            });
            // Hilangkan opsi default
            $('#sub_department').removeAttr('disabled');
            // Set nilai role_id saat sub_department dipilih
            // $('#sub_department').change(function(){
            //   var selected_subid = $(this).val();
            //   $('#subid').val(selected_subid);
            // });
          },
          error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
          }
        });
      } else {
        $('#sub_department').html('<option value="">Select Sub Department</option>');
        // Kembalikan opsi default
        $('#sub_department').attr('disabled', 'disabled');
      }
    });

    // Inisialisasi untuk disable sub_department pertama kali
    $('#sub_department').attr('disabled', 'disabled');
    
  });

  $('#department').change(function(){
    var department = $(this).val();
  });

  $('#sub_department').change(function(){
    var subdepartment = $(this).val();
  });


  // Tombol submit
  $('#btnAdd').on('click', function (e) {
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
      var username = $('input[name="username"]').val(); // Ambil nilai username
      var nik = $('input[name="nik"]').val(); // Ambil nilai nik

      // Lakukan AJAX request untuk memeriksa username dan nik
      $.ajax({
        url: '<?=base_url('user/admin/check_user_add')?>', // Sesuaikan URL dengan fungsi check_user_add
        type: 'POST',
        data: {username: username, nik:nik},
        dataType: 'json',
        success: function(response) {
          if (response.status === '1') {
            Swal.fire({
              icon: 'warning',
              title: 'Username sudah ada !',
              showConfirmButton: true,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Oke'
            });
          }
          else if(response.status === '2'){
            Swal.fire({
              icon: 'warning',
              title: 'NIK sudah ada !',
              showConfirmButton: true,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Oke'
            });
          } else {
            // Jika username tidak ada, lanjutkan dengan penyimpanan data
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
                var formData = $('form[name="userForm"]').serialize();
                $.ajax({
                  url: '<?=base_url('kahli')?>', // Sesuaikan URL dengan URL tujuan submit form
                  type: 'POST',
                  data: formData,
                  success: function(response) {
                    // Tampilkan pesan sukses
                    Swal.fire({
                      icon: 'success',
                      title: 'Data berhasil ditambahkan!',
                      showConfirmButton: true,
                      confirmButtonColor: '#3085d6'
                    }).then(() => {
                      window.location.href = "<?=base_url('murad')?>";
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
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error: ' + status + error);
        }
      });
    }
  });


      // // Validasi form
      // var username = $('input[name="username"]').val().trim();
      // var nama = $('input[name="nama"]').val().trim();
      // var nik = $('input[name="nik"]').val().trim();
      // var password = $('input[name="password"]').val().trim();

      // if (!username || !nama || !nik || !password || !department || !subdepartment || !posisi) {
      //   // Jika ada input yang kosong
      //   Swal.fire({
      //     icon: 'warning',
      //     title: 'Mohon lengkapi data',
      //     showConfirmButton: true,
      //     confirmButtonColor: '#3085d6',
      //     confirmButton: 'Oke'
      //   });
      //   return;
      // }

      // if (password.length < 8) {
      //   // Jika password kurang dari 8 karakter
      //   Swal.fire({
      //     icon: 'warning',
      //     title: 'Password minimal 8 karakter!',
      //     showConfirmButton: true,
      //     confirmButtonColor: '#3085d6',
      //     confirmButtonText: 'Oke'
      //   });
      //   return;
      // }
      
      // Swal.fire({
      //   title: 'Apakah anda yakin?',
      //   text: "Pastikan semua data sudah benar!",
      //   icon: 'warning',
      //   showCancelButton: true,
      //   confirmButtonColor: '#3085d6',
      //   cancelButtonColor: '#d33',
      //   confirmButtonText: 'Ya, simpan data!'
      // }).then((result) => {
      //   if (result.isConfirmed) {
      //     var formData = $('form[name="userForm"]').serialize();
      //     $.ajax({
      //         url: '<?=base_url('kahli')?>', // Sesuaikan URL dengan URL tujuan submit form
      //         type: 'POST',
      //         data: formData,
      //         success: function(response) {
      //           // Tampilkan pesan sukses
      //           Swal.fire({
      //             icon: 'success',
      //             title: 'User berhasil ditambahkan',
      //             showConfirmButton: true,
      //             confirmButtonColor: '#3085d6',
      //             confirmButtonText: 'Oke'
      //           }).then((result) => {
      //             if (result.isConfirmed){
      //                 window.location.reload();
      //             }
      //           })
      //         },
      //         error: function(xhr, status, error) {
      //           console.error('AJAX Error: ' + status + error);
      //           Swal.fire({
      //             icon: 'error',
      //             title: 'Terjadi kesalahan saat menyimpan data',
      //             showConfirmButton: true,
      //             confirmButtonColor: '#3085d6',
      //             confirmButtonText: 'Oke'
      //           });
      //         }
      //     });
      //   }
      // })
</script>


</body>
</html>

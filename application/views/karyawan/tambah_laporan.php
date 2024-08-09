<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$user['sub_department']?> | Tambah Data Laporan</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/daterangepicker/daterangepicker.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/plugins/sweetalert2-theme-bootstrap-4/sweetnotifalert2.min.css')?>">
  <style>
    select[readonly] {
    pointer-events: none;
    touch-action: none;
    background-color: #e9ecef;
    opacity: 1;
  }
  .table-overview {
    max-height:45vh; /* Batas tinggi tabel */
    overflow-y: auto;  /* Menampilkan scrollbar jika melebihi batas */
  }

  /* Menghilangkan spinner pada input type number di Chrome/Safari */
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Menghilangkan spinner pada input type number di Firefox */
  input[type=number] {
    -moz-appearance: textfield;
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
          }?>" class="nav-link">Home</a>
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
              }?>" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
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
          <div class="col-4">
            <!-- Input data -->
            <div class="card card-info" id="addForm">
              <div class="card-header">
                <h3 class="card-title">Add Laporan Data</h3>
              </div>
              <form action="" name="laporanForm" method="POST">
                <div class="card-body">

                  <div class="row">
                    <div class="col-11">
                      <div class="form-group">
                        <label>Pilih Report</label>
                        <select class="form-control" id="report" name="report" required>
                          <?php foreach ($report as $rep):?>
                          <option value="<?=$rep['report']?>"><?=$rep['report']?></option>
                          <?php endforeach;?>
                        </select>
                        <div class="input-group">
                            <?= form_error('report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                        <label>Pilih Sub Report</label>
                        <select class="form-control" id="subreport" name="subreport" required>
                        </select>
                        <div class="input-group">
                          <?= form_error('sub_report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Pilih Spesifikasi</label>
                        <select class="form-control" id="status" name="status" required>
                        </select>
                        <div class="input-group">
                          <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Isi Value</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-database"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Value" id="value" name="value" autocomplete="off" required>
                          <div class="input-group">
                              <?= form_error('value', '<small class="text-danger">', '</small>'); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-5">
                      <div class="form-group">
                        <label>Satuan</label>
                        <div class="input-group mb-3">
                          <select class="form-control" name="satuan" id="satuan" required>
                            <!-- Opsi satuan akan diisi dengan JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label>Bulan:</label>
                        <div class="input-group">
                          <select class="form-control" id="bulan" name="bulan" required <?= !$canEdit ? 'readonly' : ''; ?>>
                            <!-- Opsi bulan akan diisi dengan JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label>Tahun:</label>
                        <div class="input-group">
                          <select class="form-control" id="tahun" name="tahun" required <?= !$canEdit ? 'readonly' : ''; ?>>
                            <!-- Opsi tahun akan diisi dengan JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" id="id" name="id" readonly  required>
                  <input type="hidden" id="selectedReport" name="selectedReport" value="">
                  <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" id="btnAdd" name="btnAdd">Tambah Data</button>
                  </div>
                </div>
                  <!-- /.card-body -->
              </form>
            </div>
            <div class="card card-info" id="editForm">
              <div class="card-header">
                <h3 class="card-title">Edit Laporan Data</h3>
              </div>
              <form action="" name="editLaporanForm" method="POST">
                <div class="card-body">

                  <div class="row">
                    <div class="col-11">
                      <div class="form-group">
                        <label>Pilih Report</label>
                        <select class="form-control" id="reportedit" name="reportedit" required readonly>
                          <?php foreach ($report as $rep):?>
                          <option value="<?=$rep['report']?>"><?=$rep['report']?></option>
                          <?php endforeach;?>
                        </select>
                        <div class="input-group">
                            <?= form_error('report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                        <label>Pilih Sub Report</label>
                        <input type="text" class="form-control" id="subreportedit" name="subreportedit" required readonly>
                        <div class="input-group">
                          <?= form_error('sub_report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Pilih Spesifikasi</label>
                        <input type="text" class="form-control" id="statusedit" name="statusedit" required readonly>
                        <div class="input-group">
                          <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Isi Value</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-database"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="Value" id= "valueedit" name="valueedit" autocomplete="off" required>
                          <div class="input-group">
                              <?= form_error('value', '<small class="text-danger">', '</small>'); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-5">
                      <div class="form-group">
                        <label>Satuan</label>
                        <div class="input-group mb-3">
                          <select class="form-control" name="satuanedit" id="satuanedit" required>
                            
                          </select>
                          <input type="hidden" name="satuanbefore" id="satuanbefore" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label>Bulan:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="bulanedit" name="bulanedit" required <?= !$canEdit ? 'readonly' : ''; ?> readonly>
                          <input type="hidden" id="valuebulanedit" name="valuebulanedit">
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label>Tahun:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="tahunedit" name="tahunedit" required <?= !$canEdit ? 'readonly' : ''; ?> readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" id="idedit" name="idedit" readonly  required>
                  <input type="hidden" id="selectedReport" name="selectedReport" value="">
                  <input type="hidden" id="editLapType" name="editLapType" value="editlaporanperiodesekarang">
                  <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" id="btnEdit" name="btnEdit">Edit Data</button>
                  </div>
                </div>
                  <!-- /.card-body -->
              </form>
            </div>
            <!-- /.card -->
          </div>

          <div class="col-8">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Overview</h3>
              </div>
              <div class="card-body">
                <div class="table-overview" id="overviewArea">
                  <!-- Hasil submit akan tampil di sini -->
                </div>
              </div>
            </div>
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
<!-- Date Picker-->
<script src="<?=base_url('assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?=base_url('assets/plugins/moment/moment.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
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
    displayData();
    
    // localStorage.clear();
    // Event delegation untuk tombol edit
    $(document).on('click', '.edit-btn', function() {
      var laporanId = $(this).data('laporanid');
      var period = $(this).data('period');

      $.ajax({
        url: 'user/karyawan/get_data_report',
        type: 'POST',
        data: {id: laporanId, period:period},
        dataType: 'json', // Tetapkan dataType sebagai 'json'
        success: function(response) {
          console.log(response);
          if (response.length > 0 && !response[0].error) {
            var data = response[0]; // Mengakses objek pertama dalam array

            // Misalkan field form memiliki ID yang sesuai dengan nama kolom di database
            $('#editForm select[name="reportedit"]').val(data.report);
            $('#editForm input[name="subreportedit"]').val(data.sub_report);
            $('#editForm input[name="valueedit"]').val(numberWithCommas(data.value));
            $('#editForm select[name="satuanedit"]').val(data.satuan);
            $('#editForm input[name="satuanbefore"]').val(data.satuan);
            $('#editForm input[name="statusedit"]').val(data.status);
            // Menggunakan period untuk mengisi bulan dan tahun
            var period = new Date(data.periode);
            var month = ('0' + (period.getMonth() + 1)).slice(-2); // Bulan dimulai dari 0, tambahkan 1
            var year = period.getFullYear();
            var bulanNama = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 
            'Oktober', 'November', 'Desember'];
            $('#editForm input[name="bulanedit"]').val(bulanNama[month - 1]); // Tampilkan nama bulan
            $('#editForm input[name="valuebulanedit"]').val(month); // Simpan nilai angka bulan di input hidden
            $('#editForm input[name="tahunedit"]').val(year);
            $('#editForm input[name="idedit"]').val(data.id); // Assuming you have a hidden input for the ID

            // Tampilkan form edit, sembunyikan form add
            $('#editForm').show();
            $('#addForm').hide();
          } else {
            alert(response.error);
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });

    
    // Function untuk menampilkan form add dan menyembunyikan form edit
    function showAddForm() {
      $('#addForm').show();
      $('#editForm').hide();
    }

    // Menyembunyikan form edit saat halaman pertama kali dimuat
    showAddForm();

    function numberWithCommas(x) {
        x = x.toString().replace(/,/g, ''); // Hapus koma yang sudah ada
        var parts = x.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return parts.join('.');
    }

    $('#addForm input[name="value"]').on('input', function() {
        this.value = numberWithCommas(this.value);
    });

    $('#editForm input[name="valueedit"]').on('input', function() {
        this.value = numberWithCommas(this.value);
    });

    // Jika nilai negatif atau 0, set ke kosong
    $('#addForm input[name="value"]').on('input', function() {
        if (parseFloat(this.value.replace(/,/g, '')) <= 0) {
            this.value = "";
        }
    });

    $('#editForm input[name="valueedit"]').on('input', function() {
        if (parseFloat(this.value.replace(/,/g, '')) <= 0) {
            this.value = "";
        }
    });

    // Ambil satuan saat halaman dimuat
    $.ajax({
      url: '<?= base_url('raz') ?>',
      method: 'POST',
      success: function(response) {
        var data = JSON.parse(response);
        if (data.status) {
          $('#satuan').empty(); // Kosongkan select 'satuan' terlebih dahulu
          $('#satuanedit').empty(); // Kosongkan select 'satuan' terlebih dahulu
          data.data.forEach(function(satuan) {
            $('#satuan').append('<option value="' + satuan.satuan + '">' + satuan.satuan + '</option>');
            $('#satuanedit').append('<option value="' + satuan.satuan + '">' + satuan.satuan + '</option>');
          });
        } else {
          $('#satuan').append('<option value="">No satuan found</option>');
        }
      },
      error: function(xhr, status, error) {
        console.error("AJAX Error: " + status + error);
      }
    });

    $('#btnAdd').on('click', function(e) {
      e.preventDefault();
      var isValid = true;

      // Periksa setiap input yang diperlukan
      $('#addForm input[required], #addForm select[required]').each(function() {
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
          confirmButtonText: 'Ya, simpan data!'
        }).then((result) => {
          if (result.isConfirmed) {
            var formData = $('form[name="laporanForm"]').serialize();
            $.ajax({
              url: '<?=base_url('zata')?>', // Sesuaikan URL dengan URL tujuan submit form
              type: 'POST',
              data: formData,
              success: function(response) {
                // Parsing output var_dump
                var data = JSON.parse(response);

                // ///////////////////////////////////////////////////////////////////////////////

                // // Tampilkan hasil submit di area result
                // displayResults(data.report);

                // Set nilai report yang dipilih
                $('#selectedReport').val(data.report);
                displayData();

                // Tampilkan pesan sukses
                Swal.fire({
                  icon: 'success',
                  title: 'Data berhasil disimpan',
                  showConfirmButton: true,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Oke'
                });

                // Reset form setelah submit
                $('form[name="laporanForm"]')[0].reset();

                // Atur kembali nilai report
                $('#report').val($('#selectedReport').val()).trigger('change');

                // Set nilai bulan yang dipilih
                $('#bulan').val(data.bulan);
                // Set nilai tahun yang dipilih
                $('#tahun').val(data.tahun);
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

    $(document).on('click', '.delete-btn', function() {
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
          var laporanId = $(this).data('laporanid');
          var period = $(this).data('period');
          $.ajax({
            url: '<?=base_url('user/karyawan/delete_laporan')?>', // Sesuaikan URL dengan URL tujuan submit form
            type: 'POST',
            dataType: 'json',
            data: {id: laporanId, period:period},
            success: function(response) {

              // Tampilkan pesan sukses
              Swal.fire({
                icon: 'success',
                title: 'Data berhasil dihapus',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Oke'
              }).then((result)=>{
                window.location.reload();
              });
            },
            error: function(xhr, status, error) {
              console.error('AJAX Error: ' + status + error);
              console.log('Response:', xhr.responseText); // Tambahkan log ini untuk debugging
              Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan saat menghapus data',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Oke'
              });
            }
          });
        }
      });
    });

    // Fungsi untuk menampilkan hasil berdasarkan report yang dipilih
    function displayResults(report) {
      var storedReports = JSON.parse(localStorage.getItem('storedReports')) || {};
      var reports = storedReports[report] || [];
      
      // Ambil bulan dan tahun yang dipilih
      var selectedMonth = parseInt($('#bulan').val());
      var selectedYear = parseInt($('#tahun').val());
      var periode = selectedYear + '-' + ('0' + selectedMonth).slice(-2);

      var tableHtml = '<table class="table table-bordered">';
      tableHtml += '<thead><tr><th style="text-align: center;">No</th><th style="text-align: center;">Report</th><th style="text-align: center;">Sub Report</th><th style="text-align: center;">Value</th><th style="text-align: center;">Satuan</th><th style="text-align: center;">Spesifikasi</th><th style="text-align: center;">Period</th><th style="text-align: center;">Aksi</th></tr></thead>';
      tableHtml += '<tbody>';
      
      // Jika tidak ada laporan, beri pesan kosong
      if (reports.length === 0) {
        tableHtml += '<tr><td colspan="7" class="text-center">Tidak ada data untuk ditampilkan</td></tr>';
      } else {
        reports.forEach(function(data, index) {
          var dataPeriod = new Date(data.period);
          var dataMonth = dataPeriod.getMonth() + 1; // Bulan dimulai dari 0, jadi tambahkan 1
          var dataYear = dataPeriod.getFullYear();
          var isPreviousMonth = (dataYear === selectedYear && dataMonth === selectedMonth - 1) || 
                                (selectedMonth === 1 && dataMonth === 12 && dataYear === selectedYear - 1);

          tableHtml += '<tr>';
          tableHtml += '<td>' + (index + 1) + '</td>';
          tableHtml += '<td>' + data.report + '</td>';
          tableHtml += '<td>' + data.subreport + '</td>';
          tableHtml += '<td>' + data.value + '</td>';
          tableHtml += '<td>' + data.satuan + '</td>';
          tableHtml += '<td>' + data.status + '</td>';
          tableHtml += '<td>' + getMonthName(dataMonth) + ' ' + dataYear + '</td>'; // Gunakan nama bulan
          if (data.period === periode) {
            tableHtml += '<td><button class="btn btn-sm btn-primary edit-btn" data-laporanid="'+
                          data.id+'" data-period="'+data.period+'"><i class="fas fa-pen"></i></button>&nbsp;<button class="btn btn-sm btn-danger delete-btn" data-laporanid="'+
                          data.id+'" data-period="'+data.period+'"><i class="fas fa-trash"></i></button></td>';
          } else if (!isPreviousMonth) {
            tableHtml += '<td><button class="btn btn-sm btn-primary edit-btn" data-laporanid="'+
                          data.id+'" data-period="'+data.period+'"><i class="fas fa-pen"></i></button>&nbsp;<button class="btn btn-sm btn-danger delete-btn" data-laporanid="'+
                          data.id+'" data-period="'+data.period+'"><i class="fas fa-trash"></i></button></td>';
          }
          else {
            tableHtml += '<td></td>'; // Kosongkan kolom aksi jika tombol edit dihilangkan
          }
          tableHtml += '</tr>';
        });
      }

      tableHtml += '</tbody></table>';
      $('#overviewArea').html(tableHtml);
    }

    // Fungsi untuk mengonversi angka bulan menjadi nama bulan
    function getMonthName(month) {
      var bulanNama = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      return bulanNama[month - 1];
    }

    // Tampilkan hasil saat pilihan report diubah
    // $('#report').change(function() {
    //   var report = $(this).val();
    //   displayResults(report);
    // });

    $('#report').change(function() {
        displayData();
    });


    function displayData(){
    var selectedReport = $('#report').val();
    if (selectedReport) {
        $.ajax({
            url: '<?= base_url('user/karyawan/get_report_data') ?>', // Sesuaikan URL
            type: 'POST',
            data: { report: selectedReport },
            dataType: 'json',
            success: function(data) {
                var selectedMonth = parseInt($('#bulan').val());
                var selectedYear = parseInt($('#tahun').val());
                var periode = selectedYear + '-' + ('0' + selectedMonth).slice(-2) + '-01';
                var tableHtml = '<table class="table table-bordered">';
                tableHtml += '<thead><tr><th style="text-align: center;">ID</th><th style="text-align: center;">Report</th><th style="text-align: center;">Sub Report</th><th style="text-align: center;">Spesifikasi</th><th style="text-align: center;">Value</th><th style="text-align: center;">Satuan</th><th style="text-align: center;">Periode</th><th style="text-align: center;">Aksi</th></tr></thead>';
                tableHtml += '<tbody>';

                if (data.length === 0) {
                    tableHtml += '<tr><td colspan="8" class="text-center">Tidak ada data untuk ditampilkan</td></tr>';
                } else {
                    data.forEach(function(item, index) {
                        var dataPeriod = new Date(item.periode);
                        var dataMonth = dataPeriod.getMonth() + 1; // Bulan dimulai dari 0, jadi tambahkan 1
                        var dataYear = dataPeriod.getFullYear();
                        var currentPeriod = selectedYear === dataYear && selectedMonth === dataMonth;

                        tableHtml += '<tr>';
                        tableHtml += '<td>' + (index + 1) + '</td>';
                        tableHtml += '<td>' + item.report + '</td>';
                        tableHtml += '<td>' + item.sub_report + '</td>';
                        tableHtml += '<td>' + item.status + '</td>';
                        tableHtml += '<td>' + item.value + '</td>';
                        tableHtml += '<td>' + item.satuan + '</td>';
                        tableHtml += '<td>' + getMonthName(dataMonth) + ' ' + dataYear + '</td>';

                        if (currentPeriod) {
                            tableHtml += '<td><button class="btn btn-sm btn-primary edit-btn" data-laporanid="' +
                                          item.id + '" data-period="' + item.periode + '"><i class="fas fa-pen"></i></button>&nbsp;<button class="btn btn-sm btn-danger delete-btn" data-laporanid="' +
                                          item.id + '" data-period="' + item.periode + '"><i class="fas fa-trash"></i></button></td>';
                        } else {
                            tableHtml += '<td></td>'; // Kosongkan kolom aksi jika tombol edit dihilangkan
                        }

                        tableHtml += '</tr>';
                    });
                }

                tableHtml += '</tbody></table>';
                $('#overviewArea').html(tableHtml);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    } else {
        $('#overviewArea').html('<p class="text-center">Pilih report untuk melihat data</p>');
    }
}


    $('#btnEdit').on('click', function(e) {
      e.preventDefault();
      var isValid = true;

      // Periksa setiap input yang diperlukan
      $('#editForm input[required], #editForm select[required]').each(function() {
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
          confirmButtonText: 'Ya, simpan data!'
        }).then((result) => {
          if (result.isConfirmed) {
            var formData = $('form[name="editLaporanForm"]').serialize();
            $.ajax({
              url: '<?=base_url('ilumia')?>', // Sesuaikan URL dengan URL tujuan submit form
              type: 'POST',
              dataType: 'json', // Memastikan respons diharapkan dalam format JSON
              data: formData,
              success: function(response) {
                // Respons sudah berupa objek JavaScript, tidak perlu parse lagi

                // Simpan hasil submit ke localStorage
                // var storedReports = JSON.parse(localStorage.getItem('storedReports')) || {};

                // if (!storedReports[response.report]) {
                //   storedReports[response.report] = [];
                // }

                // var existingItem = storedReports[response.report].find(item => 
                //     item.subreport === response.subreport && 
                //     item.satuan === response.satuanbefore && 
                //     item.period === response.period && 
                //     item.status === response.status
                // );

                // if (existingItem) {
                //   existingItem.value = Number(response.value); // Pastikan konversi tipe
                //   existingItem.satuan = response.satuan;
                //   localStorage.setItem('storedReports', JSON.stringify(storedReports));
                // }else{
                //   storedReports[response.report].value = Number(response.value); // Pastikan konversi tipe
                //   storedReports[response.report].satuan = response.satuan;
                //   localStorage.setItem('storedReports', JSON.stringify(storedReports));
                // }
                
                // // Tampilkan hasil submit di area result
                // displayResults(response.report);
                $('#editForm').hide();
                $('#addForm').show();
                $('#report').val(response.report);

                displayData();
                
                // Tampilkan pesan sukses
                Swal.fire({
                  icon: 'success',
                  title: 'Data berhasil disimpan',
                  showConfirmButton: false,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Oke',
                  timer: 1500
                });
              },
              error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
                console.log('Response:', xhr.responseText); // Tambahkan log ini untuk debugging
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

  $(document).ready(function() {
    // Event listener untuk perubahan pada select 'Report'
    $('#report').change(function() {
      var report = $(this).val(); // Ambil nilai yang dipilih dari 'Report'
      
      // Lakukan AJAX request untuk mengambil sub report berdasarkan report yang dipilih
      $.ajax({
        url: "<?php echo base_url('user/karyawan/get_sub_reports'); ?>", // Sesuaikan dengan URL yang benar
        type: "POST",
        data: { report: report },
        dataType: "json",
        success: function(data) {
          // Simpan data yang diperoleh dari server
          reportData = data;

          // Kosongkan select 'Sub Report' dan 'Status' terlebih dahulu
          $('#subreport').empty();
          $('#status').empty();
            
          // Gunakan Set untuk mengeliminasi duplikat sub_report
          var subReportSet = new Set();

          $.each(data, function(key, value) {
            subReportSet.add(value.sub_report);
          });

          // Tambahkan option baru untuk setiap sub report unik yang diperoleh dari AJAX response
          subReportSet.forEach(function(sub_report) {
            $('#subreport').append('<option value="' + sub_report + '">' + sub_report + '</option>');
          });
          
          $('#subreport').change(function() {
            $('#status').empty();
            $('#status').append('<option value="">Pilih Spesifikasi</option>'); // Tambahkan option default kosong

            var selectedSubReport = $(this).val();
            var statusSet = new Set();

            // Filter status berdasarkan sub report yang dipilih
            $.each(reportData, function(key, value) {
              if (value.sub_report === selectedSubReport) {
                statusSet.add(value.status);
              }
            });

            // Tambahkan option baru untuk setiap status yang sesuai dengan sub report yang dipilih
            statusSet.forEach(function(status) {
              $('#status').append('<option value="' + status + '">' + status + '</option>');
            });
          });

          // Trigger change event pertama kali untuk subreport jika ada data
          if (data.length > 0) {
            $('#subreport').trigger('change');
          }
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error: " + status + error);
        }
      });
    });

    // Trigger change event pertama kali jika 'Report' sudah terpilih dari PHP
    $('#report').trigger('change');
  });

  $(document).ready(function() {
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1; // Bulan 1-12
    var currentYear = currentDate.getFullYear();

    // Array nama bulan dalam bahasa Indonesia
    var bulanOptions = [
      { value: '01', text: 'Januari' },
      { value: '02', text: 'Februari' },
      { value: '03', text: 'Maret' },
      { value: '04', text: 'April' },
      { value: '05', text: 'Mei' },
      { value: '06', text: 'Juni' },
      { value: '07', text: 'Juli' },
      { value: '08', text: 'Agustus' },
      { value: '09', text: 'September' },
      { value: '10', text: 'Oktober' },
      { value: '11', text: 'November' },
      { value: '12', text: 'Desember' }
    ];

    // Hapus semua opsi sebelumnya
    var bulanSelect = $('#bulan');
    bulanSelect.empty();

    // Logika untuk menampilkan bulan yang sesuai berdasarkan tanggal
    if (currentDate.getDate() < 6) {
      // Jika tanggal antara 1 dan 5, tampilkan dua bulan lalu dan bulan lalu
      var prevMonth1 = currentMonth - 2;
      var prevMonth2 = currentMonth - 1;
      var prevYear1 = currentYear;
      var prevYear2 = currentYear;

      if (prevMonth1 < 1) {
        prevMonth1 += 12;
        prevYear1--;
      }

      if (prevMonth2 < 1) {
        prevMonth2 += 12;
        prevYear2--;
      }

      bulanSelect.append(new Option(bulanOptions[prevMonth1 - 1].text, ('0' + prevMonth1).slice(-2)));
      bulanSelect.append(new Option(bulanOptions[prevMonth2 - 1].text, ('0' + prevMonth2).slice(-2)));
    } else {
      // Jika tanggal antara 6 dan akhir bulan, tampilkan bulan ini dan bulan lalu
      var prevMonth = currentMonth - 1;
      var prevYear = currentYear;

      if (prevMonth < 1) {
        prevMonth += 12;
        prevYear--;
      }

      bulanSelect.append(new Option(bulanOptions[prevMonth - 1].text, ('0' + prevMonth).slice(-2)));
      bulanSelect.append(new Option(bulanOptions[currentMonth - 1].text, ('0' + currentMonth).slice(-2)));
    }

    // Set default value untuk bulan
    if (currentDate.getDate() < 6) {
      bulanSelect.val(('0' + prevMonth2).slice(-2));
    } else {
      bulanSelect.val(('0' + currentMonth).slice(-2));
    }

    // Isi opsi tahun
    var tahunSelect = $('#tahun');
    for (var i = 0; i <= 1; i++) { // Tahun sekarang dan tahun sebelumnya
      tahunSelect.append(new Option(currentYear - i, currentYear - i));
    }

    // Set default value untuk tahun
    tahunSelect.val(currentYear);

    // Set readonly untuk dropdown tahun
    tahunSelect.attr('readonly', true);

    // Event listener untuk perubahan pada bulan
    bulanSelect.change(function() {
      var selectedMonth = parseInt($(this).val());
      if (selectedMonth > currentMonth) {
        tahunSelect.val(currentYear - 1);
      } else {
        tahunSelect.val(currentYear);
      }
    });


    $('#report, #subreport, #status').change(function() {
      var report = $('#report').val();
      var subreport = $('#subreport').val();
      var status = $('#status').val();

      if(report && subreport && status) {
        $.ajax({
          url: '<?= base_url('user/karyawan/get_attribute_id') ?>',
          method: 'POST',
          data: { report: report, subreport: subreport, status: status },
          success: function(response) {
            var data = JSON.parse(response);
            if(data.status) {
              $('#id').val(data.id);
            } else {
              $('#id').val('');
            }
          }
        });
      }
    });
  });

  // function numberWithCommas(x) {
  //   x = x.toString();
  //   var pattern = /(-?\d+)(\d{3})/;
  //   while (pattern.test(x))
  //     x = x.replace(pattern, "$1.$2");
  //   return x;
  // }

  document.getElementById('value').addEventListener('input', function (e) {
    var value = this.value.replace(/\D/g, '');
    this.value = numberWithCommas(value);
  });

  document.querySelector('form[name="laporanForm"]').addEventListener('submit', function (e) {
    var valueInput = document.getElementById('value');
    valueInput.value = valueInput.value.replace(/\./g, ''); // Hapus semua titik sebelum submit
  });

  document.getElementById('valueedit').addEventListener('input', function (e) {
    var value = this.value.replace(/\D/g, '');
    this.value = numberWithCommas(value);
  });

  document.querySelector('form[name="laporanForm"]').addEventListener('submit', function (e) {
    var valueInput = document.getElementById('valueedit');
    valueInput.value = valueInput.value.replace(/\./g, ''); // Hapus semua titik sebelum submit
  });

</script>


</body>
</html>

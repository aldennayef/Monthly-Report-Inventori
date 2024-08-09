<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$user['sub_department']?> | Edit Data Laporan</title>

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
            <div class="col-8">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Detail Data</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                      <table class="table table-head-fixed text-nowrap">
                        <thead>
                          <tr>
                            <th>Report</th>
                            <th>Sub Report</th>
                            <th>Spesifikasi</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Periode</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $bulanIndo = [ 1 => 'Januari', 2 => 'Februari',3 => 'Maret',
                                  4 => 'April',5 => 'Mei',6 => 'Juni',7 => 'Juli',8 => 'Agustus',
                                  9 => 'September',10 => 'Oktober',11 => 'November',12 => 'Desember'];
                            foreach ($laporan as $row): ?>
                            <tr>
                              <td><?= $row['report'] ?></td>
                              <td><?= $row['sub_report'] ?></td>
                              <td><?= $row['status'] ?></td>
                              <td><?= $row['total_value'] ?></td>
                              <td><?= $row['satuan'] ?></td>
                              <td>
                                <?php $date = new DateTime($row['periode']); // Menggunakan DateTime untuk parsing
                                  $bulan = $date->format('n'); // Mendapatkan bulan sebagai angka
                                  $tahun = $date->format('Y'); // Mendapatkan tahun
                                  echo $bulanIndo[$bulan] . ' ' . $tahun;?>
                              </td>
                              <td>
                                <button class="btn btn-sm btn-primary edit-btn"
                                        data-laporanid="<?= $row['id'] ?>"
                                        data-status="<?= $row['status_periode'] ?>"
                                        data-periode="<?= $row['periode'] ?>">
                                  <i class="fas fa-pen"></i> Edit
                                </button>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
          <div class="col-4">
            <!-- Input data -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Laporan Data</h3>
              </div>
              <form action="<?=base_url('ilumia')?>" name="editLaporanForm" method="POST">
                  <div class="card-body">
                      <div class="form-group">
                        <label>Pilih Report</label>
                        <select class="form-control" id="report" name="report" required disabled>
                        <?php foreach ($laporan as $rep): ?>
                        <option value="<?=$rep['report']?>" <?= ($rep['report'] == $laporan[0]['report']) ? 'selected' : '' ?>><?=$rep['report']?></option>
                        <?php endforeach; ?>
                        </select>
                        <div class="input-group">
                          <?= form_error('report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Pilih Sub Report</label>
                        <select class="form-control" id="subreport" name="subreport" required disabled>
                          <option value="<?= $laporan[0]['sub_report'] ?>" selected><?= $laporan[0]['sub_report'] ?></option>
                        </select>
                        <div class="input-group">
                        <?= form_error('sub_report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Pilih Spefisikasi</label>
                        <select class="form-control" id="status" name="status" required disabled>
                        <option value="<?= $laporan[0]['status'] ?>" selected><?= $laporan[0]['status'] ?></option>
                        </select>
                        <div class="input-group">
                        <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Isi Value</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-database"></i></span>
                        </div>
                        <input type="number" class="form-control" placeholder="Value" name="value" autocomplete="off" required>
                        <div class="input-group">
                          <?= form_error('value', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Satuan</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-database"></i></span>
                        </div>
                        <select class="form-control" name="satuan" id="satuan" required>
                          <?php foreach ($satuan as $s): ?>
                          <option value="<?= $s['satuan'] ?>" <?= ($s['satuan'] == $laporan[0]['satuan']) ? 'selected' : '' ?>><?= $s['satuan'] ?></option>
                          <?php endforeach; ?>
                        </select>
                        <div class="input-group">
                          <?= form_error('satuan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Date:</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal" value="" required disabled/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" class="form-control" id="id" name="id" value="" readonly required>
                      <input type="hidden" id="selectedReport" name="selectedReport" value="<?= $laporan[0]['report'] ?>">
                      <input type="hidden" id="editLapType" name="editLapType" value="editlaporanperiodesebelumnya">
                      <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" id="btnEdit" name="btnEdit">Submit</button>
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
  document.addEventListener('DOMContentLoaded', function() {
    var currentDate = new Date(); // Tanggal sekarang
    var currentDay = currentDate.getDate();
    var currentMonth = currentDate.getMonth(); // 0-11 (Januari adalah 0)
    var currentYear = currentDate.getFullYear();

    // Tentukan periode sekarang
    var periodeNow;
    if (currentDay > 5) {
        periodeNow = currentYear + '-' + ('0' + (currentMonth + 1)).slice(-2) + '-01';
    } else {
        if (currentMonth === 0) {
            // Jika bulan sekarang Januari, bulan sebelumnya adalah Desember tahun sebelumnya
            periodeNow = (currentYear - 1) + '-12-01';
        } else {
            periodeNow = currentYear + '-' + ('0' + currentMonth).slice(-2) + '-01';
        }
    }

    // Hitung periode bulan sebelumnya
    var previousMonth = new Date(currentDate);
    previousMonth.setMonth(previousMonth.getMonth() - 1);
    var previousYear = previousMonth.getFullYear();
    var previousMonthNumber = previousMonth.getMonth() + 1; // 0-11, tambahkan 1 agar 1-12

    var previousPeriod = previousYear + '-' + ('0' + previousMonthNumber).slice(-2) + '-01';

    // Ambil semua tombol edit
    var editButtons = document.querySelectorAll('.edit-btn');

    // Loop melalui semua tombol dan sesuaikan visibilitas
    editButtons.forEach(function(button) {
        var periode = button.getAttribute('data-periode');
        var statusPeriode = button.getAttribute('data-status');

        if (periode === periodeNow || periode === previousPeriod) {
          if(statusPeriode === '0'){
            // Jika periode adalah periode sekarang atau satu bulan sebelumnya, tampilkan tombol edit
            button.style.display = 'inline-block';
          }else{
            
            button.style.display = 'none';
          }
        } else {
            // Untuk kondisi lain, sembunyikan tombol edit
            button.style.display = 'none';
        }
    });
  });
$(document).ready(function() {
  // Ambil satuan saat halaman dimuat
  $.ajax({
    url: '<?= base_url('raz') ?>',
    method: 'POST',
    success: function(response) {
      var data = JSON.parse(response);
      if (data.status) {
        $('#satuan').empty(); // Kosongkan select 'satuan' terlebih dahulu
        data.data.forEach(function(satuan) {
          $('#satuan').append('<option value="' + satuan.satuan + '">' + satuan.satuan + '</option>');
        });
      } else {
        $('#satuan').append('<option value="">No satuan found</option>');
      }
    },
    error: function(xhr, status, error) {
      console.error("AJAX Error: " + status + error);
    }
  });

  $('.edit-btn').on('click', function() {
    var laporanId = $(this).data('laporanid');

    $.ajax({
      url: '<?=base_url('user/karyawan/get_laporan_data')?>',
      type: 'GET',
      data: { laporanid: laporanId },
      success: function(response) {
        var data = JSON.parse(response);
        if (data.status) {
          // Fill the form with the received data
          $('#report').val(data.laporan.report);
          $('#subreport').val(data.laporan.sub_report);
          $('#status').val(data.laporan.status);
          $('input[name="value"]').val(data.laporan.total_value);
          $('select[name="satuan"]').val(data.laporan.satuan);
          $('input[name="tanggal"]').val(data.laporan.periode.substring(0, 7));
          $('#id').val(data.laporan.id_kv);
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Data tidak ditemukan',
            text: data.message
          });
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX Error: ' + status + error);
        Swal.fire({
          icon: 'error',
          title: 'Terjadi kesalahan',
          text: 'Gagal mengambil data. Silahkan coba lagi.'
        });
      }
    });
  });

  $('#btnEdit').on('click', function(e) {
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
        confirmButtonText: 'Ya, simpan data!'
      }).then((result) => {
        if (result.isConfirmed) {
          var formData = $('form[name="editLaporanForm"]').serialize();
          $.ajax({
            url: '<?=base_url('ilumia')?>', // Sesuaikan URL dengan URL tujuan submit form
            type: 'POST',
            data: formData,
            success: function(response) {
              
              // Tampilkan pesan sukses
              Swal.fire({
                icon: 'success',
                title: 'Data berhasil diupdate',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6'
              }).then(()=>{
                location.reload();
              });

              // Reset form setelah submit
              $('form[name="editLaporanForm"]')[0].reset();
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

// Fungsi untuk menampilkan hasil berdasarkan report yang dipilih
function displayResults(report) {
  var storedReports = JSON.parse(localStorage.getItem('storedReports')) || {};
  var reports = storedReports[report] || [];
  var tableHtml = '<table class="table table-bordered">';
  tableHtml += '<thead><tr><th>ID</th><th>Report</th><th>Sub Report</th><th>Value</th><th>Satuan</th><th>Period</th></tr></thead>';
  tableHtml += '<tbody>';
  reports.forEach(function(data) {
    tableHtml += '<tr><td>' + data.id + '</td><td>' + data.report + '</td><td>' + data.subreport + '</td><td>' + data.value + '</td><td>' + data.satuan + '</td><td>' + data.period + '</td></tr>';
  });
  tableHtml += '</tbody></table>';
  $('#resultArea').html(tableHtml);
}

// Tampilkan hasil saat pilihan report diubah
$('#report').change(function() {
  var report = $(this).val();
  displayResults(report);
});

// Fungsi lain tetap sama seperti sebelumnya

});

// Fungsi untuk parsing output var_dump PHP
function parseVarDump(str) {
  var match,
    reKeyValue = /\["([^"]+)"\]=>\s*(string\(\d+\)\s*"([^"]+)"|int\(\d+\))/g,
    result = {};
  while (match = reKeyValue.exec(str)) {
    result[match[1]] = match[3] || match[2];
  }
  return result;
}

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

$(function () {
  //Date picker
  $('#reservationdate').datetimepicker({
    format: 'YYYY-MM',
    useCurrent: false
  });
});

$(document).ready(function() {
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

</script>


</body>
</html>

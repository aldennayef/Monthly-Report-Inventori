<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$user['sub_department']?> | Tambah Report</title>

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
    .autocomplete {
    /*the container must be positioned relative:*/
    position: relative;
    }
    input {
    border: 1px solid transparent;
    background-color: #f1f1f1;
    }
    input[type=text] {
    background-color: #f1f1f1;
    }
    input[type=submit] {
    background-color: DodgerBlue;
    color: #fff;
    }
    .autocomplete-items {
    position: absolute;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /* Position the autocomplete items to be the same width as the container: */
    top: 100%;
    left: 0;
    right: 0;
    background-color: #ffffff; /* Set background menjadi hitam */
}

.autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #3e4444; /* Set background item menjadi hitam */
    color: white; /* Set warna teks menjadi putih */
}

.autocomplete-items div:hover {
    /* Ketika hovering pada item: */
    background-color: #333; /* Warna saat hover */
}

.autocomplete-active {
    /* Ketika menavigasi melalui item menggunakan tombol panah: */
    background-color: #555 !important; /* Warna aktif saat menggunakan panah */
    color: #ffffff; /* Warna teks saat aktif */
}

#overviewArea {
            max-height: 450px; /* Sesuaikan tinggi maksimum sesuai kebutuhan Anda */
            overflow-y: auto; /* Menambahkan scroll vertikal jika tinggi konten melebihi batas */
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
        <div class="col-6">
        <!-- Input data -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add Report & Sub Report</h3>
            </div>
            <form action="<?= base_url('kirito') ?>" name="addColumnForm" method="POST">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-database"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Report" id="report" name="report" value="<?= isset($report) ? $report : '' ?>" autocomplete="off" required>
                        <div class="input-group">
                            <?= form_error('report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Sub Report" id="sub_report" name="sub_report" value="<?= isset($sub_report) ? $sub_report : '' ?>" autocomplete="off" required>
                        <div class="input-group">
                            <?= form_error('sub_report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group mb-3 autocomplete">
                        <label>Spesifikasi</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="Spesifikasi" required autocomplete="off">
                    </div>

                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" id="btnAdd" name="btnAdd">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
        </div>
        <div class="col-6 ">
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
    var countries = <?= $suggested_status ?>;

    function autocomplete(inp, arr) {
        var currentFocus;
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) { return false; }
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);
            for (i = 0; i < arr.length; i++) {
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    b.addEventListener("click", function(e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                currentFocus++;
                addActive(x);
            } else if (e.keyCode == 38) {
                currentFocus--;
                addActive(x);
            } else if (e.keyCode == 13) {
                e.preventDefault();
                if (currentFocus > -1) {
                    if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            if (!x) return false;
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }

    // Inisialisasi autocomplete untuk status
    autocomplete(document.getElementById("status"), countries);

    $(document).ready(function() {
        // Fetch existing report names for autocomplete
        $.ajax({
            url: '<?=base_url('pessi')?>', // Sesuaikan URL dengan URL untuk mendapatkan daftar report
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                autocomplete(document.getElementById("report"), data);
            }
        });

        $('#department').change(function() {
            var department_id = $(this).val();
            if (department_id != '') {
                $.ajax({
                    url: "<?=base_url('user/admin/get_sub_departments')?>",
                    method: "POST",
                    data: { department_id: department_id },
                    dataType: "json",
                    success: function(data) {
                        console.log('Received Data:', data);
                        $('#sub_department').html('<option value="">Select Sub Department</option>');
                        $.each(data, function(key, value) {
                            $('#sub_department').append('<option value="'+value.id+'" data-role="'+value.role_id+'">'+value.sub_department+'</option>');
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

        $('#sub_department').attr('disabled', 'disabled');

        $('#btnAdd').on('click', function(e) {
        e.preventDefault(); // Menghentikan submit form secara default
        var formData = $('form[name="addColumnForm"]').serialize(); // Mengambil data dari form

            $.ajax({url: '<?=base_url('kirito')?>', // Sesuaikan URL dengan endpoint server Anda
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        $('#report').val(response.data[0].report);
                        $('#sub_report').val(''); // Pastikan ini benar-benar dijalankan
                        $('#status').val(''); // Pastikan ini benar-benar dijalankan
                        displayResults(response.data);
                        autocomplete(document.getElementById("status"), response.suggestions);
                    });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Oke'
                        });
                    }
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
        });

        function displayResults(data) {
            var tableHtml = '<table class="table table-bordered">';
            tableHtml += '<thead><tr><th>Report</th><th>Sub Report</th><th>Status</th></tr></thead>';
            tableHtml += '<tbody>';
            data.forEach(function(row) {
                tableHtml += '<tr>';
                tableHtml += '<td>' + row.report + '</td>';
                tableHtml += '<td>' + row.sub_report + '</td>';
                tableHtml += '<td>' + row.status + '</td>';
                tableHtml += '</tr>';
            });
            tableHtml += '</tbody></table>';
            $('#overviewArea').html(tableHtml);
        }
    });
</script>



</body>
</html>

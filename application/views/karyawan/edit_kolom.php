<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Kolom</title>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/sweetnotifalert2.min.css') ?>">
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

</style>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
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
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Backup Data</a>
        </li>
    </ul>
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

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
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
    <img src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?= $user['department'] ?></span>
</a>

<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block"><?= $user['nama'] ?></a>
    </div>
    </div>

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
            <a href="<?= base_url($m['link_href']) ?>" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p><?= $m['menu'] ?></p>
            </a>
        </li>
        <?php endforeach; ?>
        <li class="nav-header">ACTIONS</li>
        <li class="nav-item">
        <a href="<?= base_url('logout') ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
        </a>
        </li>
    </ul>
    </nav>
</div>
</aside>

<!-- Content Wrapper. Contains page content -->
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
        <div class="col-6">
        <!-- Input data -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Report & Sub Report</h3>
            </div>
            <form action="<?= base_url('aang') ?>" name="editColumnForm" method="POST">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?= $kolom['id'] ?>">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-database"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Report" name="report" value="<?= $kolom['report'] ?>" autocomplete="off" required>
                        <div class="input-group">
                            <?= form_error('report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Sub Report" name="sub_report" value="<?= $kolom['sub_report'] ?>" autocomplete="off" required>
                        <div class="input-group">
                            <?= form_error('sub_report', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group mb-3 autocomplete">
                        <label>Spesifikasi</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="Spesifikasi" value="<?= $kolom['status'] ?>"required autocomplete="off">
                    </div>
                    
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" id="btnEdit" name="btnEdit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
</section>
</div>

<aside class="control-sidebar control-sidebar-dark"></aside>

<footer class="main-footer">
<div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
</div>
&copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>. All rights reserved.
</footer>
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/js/adminlte.js') ?>"></script>
<!-- Light-Dark Mode -->
<script src="<?=base_url('assets/js/lightdarkmode.js')?>"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalertnotif2.min.js') ?>"></script> 

<!-- Pastikan jQuery sudah dimuat sebelum script ini -->
<script>

var countries = <?= $suggested_status?>;

function autocomplete(inp, arr) {
/*the autocomplete function takes two arguments,
the text field element and an array of possible autocompleted values:*/
var currentFocus;
/*execute a function when someone writes in the text field:*/
inp.addEventListener("input", function(e) {
    var a, b, i, val = this.value;
    /*close any already open lists of autocompleted values*/
    closeAllLists();
    if (!val) { return false;}
    currentFocus = -1;
    /*create a DIV element that will contain the items (values):*/
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    /*append the DIV element as a child of the autocomplete container:*/
    this.parentNode.appendChild(a);
    /*for each item in the array...*/
    for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        /*create a DIV element for each matching element:*/
        b = document.createElement("DIV");
        /*make the matching letters bold:*/
        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
        b.innerHTML += arr[i].substr(val.length);
        /*insert a input field that will hold the current array item's value:*/
        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
        /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
        });
        a.appendChild(b);
        }
    }
});
/*execute a function presses a key on the keyboard:*/
inp.addEventListener("keydown", function(e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
    } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
    } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
        /*and simulate a click on the "active" item:*/
        if (x) x[currentFocus].click();
        }
    }
});
function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("autocomplete-active");
    }
}
function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
    if (elmnt != x[i] && elmnt != inp) {
    x[i].parentNode.removeChild(x[i]);
    }
}
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}

autocomplete(document.getElementById("status"), countries);

$(document).ready(function(){
    $('#btnEdit').on('click', function (e) {
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
                confirmButtonText: 'Ya, simpan data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('form[name="editColumnForm"]').submit();
                }
            });
        }
    });
});
</script>
</body>
</html>

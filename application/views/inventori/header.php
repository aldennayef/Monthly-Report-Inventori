<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if($this->session->userdata('role_id')!=3){ ?>
        <title><?=$user['department']?> | SIMI Dashboard</title>
        <?php } else{ ?>
        <title><?=$user['sub_department']?> | SIMI Dashboard</title>
        <?php }?>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/daterangepicker/daterangepicker.css')?>">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
        <!-- JQVMap -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/jqvmap/jqvmap.min.css')?>">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url('assets/dist/css/adminlte.min.css')?>">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
        <!-- summernote -->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/summernote/summernote-bs4.min.css')?>">
        <!--SweetAlert-->
        <link rel="stylesheet" href="<?=base_url('assets/plugins/sweetalert2-theme-bootstrap-4/sweetnotifalert2.min.css')?>">

        <style>
            .navbar-nav .nav-item i {
                cursor: pointer;
            }
            .navbar-nav .nav-item i.fa-sun {
            color: #f39c12; /* Warna untuk ikon matahari (light mode) */
            }
            .navbar-nav .nav-item i.fa-moon {
            color: #ffffff; /* Warna untuk ikon bulan (dark mode) */
            }

            /*view : tambah cluster */
            .input-row-cluster {
                display: flex;
                align-items: center; /* Pastikan tombol sejajar dengan input */
            }
            .input-row-cluster .btn-remove-row-cluster {
                height: 100%; /* Sesuaikan tinggi tombol dengan tinggi baris input */
                align-self: center;
            }
            .input-row-cluster .input-group {
                flex-grow: 1; /* Agar input mengambil sisa ruang */
            }
            .input-row-item {
                display: flex;
                align-items: center; /* Pastikan tombol sejajar dengan input */
            }
            .input-row-item .input-group {
                flex-grow: 1; /* Agar input mengambil sisa ruang */
            }
            .labelitem {
                display: flex;
                align-items: center; /* Menyelaraskan teks dan nomor urut secara vertikal */
                font-weight: bold; /* Menebalkan teks label */
                font-size: 14px; /* Menyesuaikan ukuran font */
                margin-bottom: 0.5rem; /* Menambahkan jarak bawah agar tidak terlalu dekat dengan input */
            }

            .item-number {
                margin-right: 5px; /* Menambahkan jarak antara nomor urut dan teks "Kode Item" */
                font-size: 14px; /* Menyesuaikan ukuran font nomor urut agar sesuai dengan teks */
            }
            .autocompletes-items {
                position: absolute;
                border: 1px solid #d4d4d4;
                border-bottom: none;
                border-top: none;
                z-index: 99;
                /* Position the autocomplete items to be the same width as the container: */
                top: 100%;
                left: 0;
                right: 0;
                max-height: 200px; /* Atur tinggi maksimum */
                overflow-y: auto; /* Tambahkan scrollbar vertikal */
                background-color: #b1d4e0;
            }

            .autocompletes-active {
                background-color: #0a75ad; /* Warna background saat dihover atau dipilih */
                color: #ffffff; /* Warna teks saat dihover atau dipilih */
            }


        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="<?=base_url('assets/dist/img/AdminLTELogo.png')?>" alt="AdminLTELogo" height="60" width="60">
            </div>

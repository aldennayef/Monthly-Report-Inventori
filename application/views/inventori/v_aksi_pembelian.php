<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Inventori (SIMI)</title>
    <!-- CSS dan JS lainnya -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome/css/all.min.css')?>">
</head>
<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sistem Informasi Inventori (SIMI)</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        
        <?php if($aksi === 'add'){ ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Input data -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Input Data PO Pembelian</h3>
                            </div>
                            <form action="" name="pembelianForm" id="pembelianForm" method="POST">
                                <div class="card-body" id="itemInputs">
                                    <div class="row">
                                        <div class="col-2">
                                            <label class='labelitem'>Kode Beli</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check" placeholder="Kode Beli" name="kodebeli" value="<?= $next_kode_beli ?>" readonly autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Nomor PO</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check" placeholder="No PO" name="nopo" id="nopo" value="<?= $next_no_po ?>" readonly autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- <div class="col-3">
                                            <label>Tanggal</label>
                                            <div class="input-group mb-3">
                                                <input type="datetime-local" class="form-control" placeholder="Tanggal" name="tanggal" autocomplete="off" id="datetimeInput">&nbsp;&nbsp;
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row input-row-item">
                                        <div class="col-3">
                                            <label><span class="item-number">1</span>. Kode Item</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control input-check" name="kodeitem[]" autocomplete="off">
                                                    <option value="" selected disabled>Pilih Kode Item</option>
                                                    <?php foreach ($items as $item): ?>
                                                        <option value="<?= $item['ikode_item'] ?>"><?= $item['ikode_item'] ?> - <?= $item['inama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Quantity</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check quantity-input" placeholder="Qty" name="qty[]" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Satuan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check" placeholder="Satuan" name="satuan[]" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Harga Satuan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check harga-input" placeholder="Harga per Satuan" name="hargapersatuan[]" autocomplete="off">
                                                <!-- <div class="input-group-append">
                                                    &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-primary btn-add-row-item" type="button"><i class="fas fa-plus"></i></button>
                                                    <button class="btn btn-sm btn-danger btn-remove-row-item" type="button" style="display:none;"><i class="fas fa-trash"></i></button>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label>Exp Date</label>
                                            <div class="input-group mb-3">
                                                <input type="datetime-local" class="form-control" placeholder="Expire Date" name="expdate[]" autocomplete="off" id="datetimeInput" required>&nbsp;&nbsp;
                                                <div class="input-group-append">
                                                    &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-primary btn-add-row-item" type="button"><i class="fas fa-plus"></i></button>
                                                    <button class="btn btn-sm btn-danger btn-remove-row-item" type="button" style="display:none;"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="type" id="type" value="add" hidden>
                                    <!-- /.card-body -->
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary" id="btnAddItem" name="btnAddItem">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php } else { ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Input data -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Update Data PO Pembelian</h3>
                            </div>
                            <form action="" name="pembelianForm" id="pembelianForm" method="POST">
                                <div class="card-body" id="itemInputs">
                                    <div class="row">
                                        <div class="col-2">
                                            <label class='labelitem'>Kode Beli</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check" placeholder="Kode Beli" name="kodebeli" value="<?= $next_kode_beli ?>" readonly autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Nomor PO</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check" placeholder="No PO" name="nopo" id="nopo" value="<?= $next_no_po ?>" readonly autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label>Tanggal</label>
                                            <div class="input-group mb-3">
                                                <input type="datetime-local" class="form-control" placeholder="Tanggal" name="tanggal" autocomplete="off" id="datetimeInput">&nbsp;&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row input-row-item">
                                        <div class="col-3">
                                            <label><span class="item-number">1</span>. Kode Item</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control input-check" name="kodeitem[]" autocomplete="off">
                                                    <option value="" selected disabled>Pilih Kode Item</option>
                                                    <?php foreach ($items as $item): ?>
                                                        <option value="<?= $item['ikode_item'] ?>"><?= $item['ikode_item'] ?> - <?= $item['inama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Quantity</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check quantity-input" placeholder="Qty" name="qty[]" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Satuan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check" placeholder="Satuan" name="satuan[]" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Harga Satuan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control input-check harga-input" placeholder="Harga per Satuan" name="hargapersatuan[]" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label>Exp Date</label>
                                            <div class="input-group mb-3">
                                                <input type="datetime-local" class="form-control" placeholder="Expire Date" name="expdate[]" autocomplete="off" id="datetimeInput" required>&nbsp;&nbsp;
                                                <div class="input-group-append">
                                                    &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-primary btn-add-row-item" type="button"><i class="fas fa-plus"></i></button>
                                                    <button class="btn btn-sm btn-danger btn-remove-row-item" type="button" style="display:none;"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="type" id="type" value="add" hidden>
                                    <!-- /.card-body -->
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary" id="btnAddItem" name="btnAddItem">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php } ?>

        <!-- jQuery -->
        <script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
        <!-- daterangepicker -->
        <script src="<?=base_url('assets/plugins/moment/moment.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
        <!-- Summernote -->
        <script src="<?=base_url('assets/plugins/summernote/summernote-bs4.min.js')?>"></script>
        <!-- Sparkline -->
        <script src="<?=base_url('assets/plugins/sparklines/sparkline.js')?>"></script>
        <!-- JQVMap -->
        <script src="<?=base_url('assets/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?=base_url('assets/plugins/jquery-knob/jquery.knob.min.js')?>"></script>
        <!-- overlayScrollbars -->
        <script src="<?=base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url('assets/dist/js/adminlte.js')?>"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- Light-Dark Mode -->
        <script src="<?=base_url('assets/js/lightdarkmode.js')?>"></script>
        <!-- SweetAlert2 -->
        <script src="<?=base_url('assets/plugins/sweetalert2/sweetalertnotif2.min.js')?>"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var now = new Date();
                var datetime = now.getFullYear() + '-' 
                    + ('0' + (now.getMonth() + 1)).slice(-2) + '-' 
                    + ('0' + now.getDate()).slice(-2) + 'T' 
                    + ('0' + now.getHours()).slice(-2) + ':' 
                    + ('0' + now.getMinutes()).slice(-2);

                document.getElementById('datetimeInput').value = datetime;
            });

            $(document).ready(function() {
                // Event listener untuk input quantity dan harga satuan
                $('#itemInputs').on('input', '.quantity-input, .harga-input', function() {
                    var value = $(this).val();

                    // Hapus karakter yang bukan angka, titik, atau koma
                    var cleanedValue = value.replace(/[^0-9.,]/g, '');

                    // Cek apakah ada lebih dari satu titik
                    if ((cleanedValue.match(/\./g) || []).length > 1) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning!',
                            text: 'Hanya boleh ada satu titik desimal.',
                        });
                        cleanedValue = cleanedValue.substring(0, cleanedValue.length - 1); // Hapus karakter titik tambahan
                    }

                    // Cek apakah titik berada di depan tanpa didahului oleh angka
                    if (/^\./.test(cleanedValue)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning!',
                            text: 'Titik tidak boleh di depan tanpa didahului oleh angka.',
                        });
                        cleanedValue = ''; // Kosongkan input jika tidak valid
                    }

                    // Cek apakah angka diawali dengan 0 yang tidak diikuti oleh titik
                    if (/^0[^.]/.test(cleanedValue)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning!',
                            text: 'Angka tidak boleh diawali dengan 0 kecuali diikuti titik.',
                        });
                        cleanedValue = cleanedValue.substring(0, cleanedValue.length - 1); // Hapus karakter yang tidak valid
                    }

                    // Cek apakah koma dimasukkan setelah titik atau ada lebih dari satu koma berturut-turut
                    var dotIndex = cleanedValue.indexOf('.');
                    var lastCommaIndex = cleanedValue.lastIndexOf(',');

                    if (dotIndex !== -1 && lastCommaIndex > dotIndex) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning!',
                            text: 'Koma tidak boleh dimasukkan setelah titik desimal.',
                        });
                        cleanedValue = cleanedValue.substring(0, lastCommaIndex); // Hapus koma yang dimasukkan setelah titik
                    }

                    // Cek apakah ada lebih dari satu koma berturut-turut
                    if (/,,/.test(cleanedValue)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning!',
                            text: 'Koma tidak boleh dimasukkan berturut-turut.',
                        });
                        cleanedValue = cleanedValue.replace(/,,/g, ','); // Hapus koma ganda
                    }

                    // Format angka dengan koma sebagai pemisah ribuan
                    var formattedValue = formatNumber(cleanedValue);

                    // Perbarui nilai input
                    $(this).val(formattedValue);
                });

                // Fungsi untuk memformat angka dengan koma sebagai pemisah ribuan
                function formatNumber(num) {
                    // Pisahkan bagian desimal jika ada
                    var parts = num.split('.');
                    // Format bagian ribuan
                    parts[0] = parts[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    // Gabungkan kembali jika ada bagian desimal
                    return parts.join('.');
                }

                // Fungsi untuk membersihkan input dari karakter selain angka, titik, dan koma
                function cleanInput(input) {
                    return input.replace(/[^0-9.,]/g, '');
                }

                // Fungsi untuk menghapus tanda koma sebelum form disubmit
                function removeCommasFromInputs() {
                    $('#itemInputs .quantity-input, #itemInputs .harga-input').each(function() {
                        var value = $(this).val();
                        $(this).val(value.replace(/,/g, ''));
                    });
                }

                function allInputsFilled() {
                    var allFilled = true;
                    $('#itemInputs .input-row-item').each(function() {
                        $(this).find('.input-check, input[name="tanggal"], input[name="expdate"]').each(function() {
                            var value = $(this).val();

                            // Cek jika value adalah null, undefined, atau kosong
                            if (value === null || value === undefined || value.trim() === '') {
                                allFilled = false;
                                return false; // Keluar dari loop jika ditemukan inputan kosong
                            }
                        });
                        if (!allFilled) {
                            return false; // Keluar dari loop jika ditemukan inputan kosong
                        }
                    });
                    return allFilled;
                }

                function updateItemNumbers() {
                    $('#itemInputs .input-row-item').each(function(index) {
                        $(this).find('.item-number').text(index + 1);
                    });
                }

                function addNewItemRow() {
                    var lastRow = $('.input-row-item').last(); // Dapatkan baris terakhir
                    var newRow = lastRow.clone(); // Clone baris terakhir

                    // Kosongkan semua input di baris baru
                    newRow.find('select[name="kodeitem[]"]').val(''); // Kosongkan pilihan kode item
                    newRow.find('input[name="qty[]"]').val(''); // Kosongkan quantity
                    newRow.find('input[name="satuan[]"]').val(''); // Kosongkan satuan
                    newRow.find('input[name="hargapersatuan[]"]').val(''); // Kosongkan harga satuan
                    newRow.find('input[name="expdate[]"]').val(''); // Kosongkan exp date

                    // Tambahkan baris baru ke dalam DOM
                    $('#itemInputs').append(newRow);

                    // Update visibilitas tombol plus dan remove
                    checkRemoveButtonVisibility();
                    updateItemNumbers();
                }

                // Fungsi untuk memeriksa visibilitas tombol remove dan plus
                function checkRemoveButtonVisibility() {
                    var rowCount = $('#itemInputs .input-row-item').length;

                    $('#itemInputs .input-row-item').each(function(index) {
                        var removeButton = $(this).find('.btn-remove-row-item');
                        var addButton = $(this).find('.btn-add-row-item');

                        // Tampilkan tombol remove jika lebih dari satu baris, sembunyikan jika hanya satu baris
                        if (rowCount > 1) {
                            removeButton.show();
                        } else {
                            removeButton.hide();
                        }

                        // Tampilkan tombol plus hanya di baris terakhir
                        if (index === rowCount - 1) {
                            addButton.show();
                        } else {
                            addButton.hide();
                        }
                    });
                }

                // Event listener untuk menambah baris baru
                $('#itemInputs').on('click', '.btn-add-row-item', function() {
                    addNewItemRow();
                });

                // Event listener untuk menghapus baris
                $('#itemInputs').on('click', '.btn-remove-row-item', function() {
                    $(this).closest('.input-row-item').remove();
                    updateItemNumbers();
                    checkRemoveButtonVisibility(); // Periksa visibilitas tombol setelah baris dihapus
                });

                $('#itemInputs').on('change', 'select[name="kodeitem[]"]', function() {
                    var kodeItem = $(this).val();
                    var $row = $(this).closest('.input-row-item');
                    
                    if (kodeItem) {
                        $.ajax({
                            url: '<?= base_url('inventori/proses/cek_kode_item') ?>', // Ubah URL sesuai dengan rute Anda
                            type: 'POST',
                            data: {kodeitem: kodeItem},
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    // Jika kode item ditemukan, isi otomatis input satuan dan harga
                                    $row.find('input[name="satuan[]"]').val(response.data.satuan);
                                    
                                    if (response.data.hargasatuan !== null) {
                                        $row.find('input[name="hargapersatuan[]"]').val(response.data.hargasatuan);
                                    } else {
                                        $row.find('input[name="hargapersatuan[]"]').val(''); // Kosongkan jika harga tidak ditemukan
                                    }
                                } else {
                                    // Jika tidak ditemukan, kosongkan input satuan dan harga
                                    $row.find('input[name="satuan[]"]').val('');
                                    $row.find('input[name="hargapersatuan[]"]').val('');
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat mengecek kode item.',
                                });
                            }
                        });
                    }
                });

                $('#pembelianForm').on('submit', function(e) {
                    e.preventDefault(); // Mencegah submit form standar

                    if (!allInputsFilled()) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Belum Lengkap!',
                            text: 'Harap isi semua inputan sebelum mengirim.',
                        });
                        return;
                    }

                    removeCommasFromInputs(); // Hapus tanda koma sebelum data dikirim

                    var isValid = true;
                    var lastRow = $('#itemInputs .input-row-item').last();
                    var lastRowIsEmpty = true;
                    var emptyInputNumber = null;

                    // Cek apakah inputan terakhir kosong
                    lastRow.find('.input-check').each(function() {
                        if ($(this).val() !== '') {
                            lastRowIsEmpty = false;
                        }
                    });

                    // Hapus baris terakhir jika kosong
                    if (lastRowIsEmpty && $('.input-row-item').length > 1) {
                        lastRow.remove();
                    }

                    // Cek apakah ada inputan yang tidak terisi selain inputan terakhir
                    $('#itemInputs .input-row-item').not(':last').each(function(index) {
                        var row = $(this);
                        row.find('.input-check, [name="tanggal"], [name="expdate"]').each(function() {
                            if ($(this).val() === '') {
                                isValid = false;
                                emptyInputNumber = index + 1; // Simpan nomor inputan yang kosong
                                $(this).focus(); // Arahkan kursor ke inputan yang belum terisi
                                return false; // Keluar dari loop jika ditemukan inputan kosong
                            }
                        });
                        if (!isValid) {
                            return false; // Keluar dari loop jika ditemukan inputan kosong
                        }
                    });

                    if (isValid) {
                        // Pastikan inputan terakhir yang kosong tidak disubmit
                        var formData = $('#pembelianForm').serializeArray();
                        var cleanedData = formData.filter(function(item) {
                            return item.value.trim() !== ""; // Hanya menyertakan input yang tidak kosong
                        });

                        if (cleanedData.length > 0) {
                            // Jika valid dan ada data yang akan disubmit, submit form via AJAX
                            $.ajax({
                                url: '<?= base_url('akpb') ?>',
                                method: 'POST',
                                data: $.param(cleanedData),
                                success: function(response) {
                                    if (response.status === 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            text: 'Tambah data PO berhasil.',
                                        }).then(function() {
                                            window.location.href = '<?= base_url('deb') ?>';
                                        });
                                    } else if (response.status === 'duplicate') {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: 'Kode ' + response.kode + ' Sudah Ada !',
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: 'Tambah data PO gagal.',
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan dalam pengiriman data.',
                                    });
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Belum Lengkap!',
                                text: 'Harap isi semua inputan sebelum mengirim.',
                            });
                        }
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Belum Lengkap!',
                            text: 'Harap isi semua inputan pada nomor ' + emptyInputNumber + ' sebelum mengirim.',
                        });
                    }
                });

                // Periksa visibilitas tombol setelah baris dihapus atau ditambah
                checkRemoveButtonVisibility();
                updateItemNumbers();
            });
        </script>
    </body>
</html>

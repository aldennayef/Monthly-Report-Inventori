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
                <h3 class="card-title">Input Data Pemakaian</h3>
                </div>
                <form action="" name="pemakaianForm" id="pemakaianForm" method="POST" >
                    <div class="card-body">
                        <div id="itemInputs">
                            <div class="row">
                                <div class="col-2">
                                    <label>No Pakai</label>
                                    <div class="input-group mb-3">
                                    <input type="text" style="text-transform:uppercase" class="form-control input-check" placeholder="No Pakai" name="nopakai" value="<?=$next_no_pakai?>" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label>Jenis Pakai</label>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Jenis Pakai" name="jenispakai" value="karyawan" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label>NIK Pemakai</label>
                                    <div class="input-group mb-3 autocompletes">
                                        <input type="text" class="form-control input-check" placeholder="Cari NIK" name="nik" id="nik" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label>Nama Pemakai</label>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Nama Pemakai" name="nama" id="nama" value="" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label>Department</label>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Department Pemakai" name="department" id="department" value="" readonly autocomplete="off">
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
                                <div class="col-2">
                                    <label><span class="item-number">1</span>. Nama Item</label>
                                    <div class="input-group mb-3">
                                        <select class="form-control input-check" name="namaitem[]" autocomplete="off">
                                            <option value="" selected disabled>Pilih Nama Item</option>
                                            <?php foreach ($items as $item): ?>
                                                <option value="<?= $item['kode_item'] ?>"><?= $item['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="text" class="form-control input-check" name="idstock[]" readonly hidden autocomplete="off">
                                <div class="col-2">
                                    <label>Kode Item</label>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Kode Item" name="kodeitem[]" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label>Stok</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control input-check quantity-input" placeholder="stok" name="stok[]" readonly autocomplete="off">
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
                                    <input type="text" class="form-control input-check" placeholder="Satuan" name="satuan[]" disabled autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label>Pemberi</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control input-check" placeholder="Pemberi" name="pemberi[]" value="PIC <?=$user['sub_department']?>" readonly autocomplete="off">
                                        <div class="input-group-append">&nbsp;&nbsp;
                                            <button class="btn btn-sm btn-primary btn-add-row-item" type="button"><i class="fas fa-plus"></i></button>&nbsp;
                                            <button class="btn btn-sm btn-danger btn-remove-row-item" type="button" style="display: none;"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label>Deskripsi</label>
                                <div class="input-group mb-3">
                                    <textarea type="text" class="form-control input-check" placeholder="Deskripsi" name="deskripsi" autocomplete="off">Pengambilan item di <?=$user['sub_department']?></textarea>
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
                            <h3 class="card-title">Update Data Pemakaian</h3>
                        </div>
                        <form action="" name="updatePemakaianForm" id="updatePemakaianForm" method="POST" >
                            <div class="card-body" id="itemInputs">
                            <div class="row">
                                <div class="col-3">
                                    <label>Nomor Pakai</label>
                                    <div class="input-group mb-3">
                                    <select class="form-control input-check" name="nopakaiupdate" autocomplete="off" id="nopakaiupdate">
                                        <option value="" selected disabled>Pilih Nomor Pakai</option>
                                        <?php foreach ($data_pemakaian as $pem): ?>
                                            <option value="<?= $pem['nopakai'] ?>" 
                                                    data-waktu="<?= $pem['waktu'] ?>" 
                                                    data-nik="<?= $pem['nik_pemakai'] ?>" 
                                                    data-pemberi="<?= $pem['pemberi'] ?>"
                                                    data-items='<?= json_encode($pem['items']) ?>'>
                                                <?= $pem['nopakai'] ?> - <?= $pem['nama_pemakai'] ?> - <?= date('d F Y', strtotime($pem['waktu'])) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    </div>
                                </div>
                                <div class="col-2">
                                    <label>NIK Pemakai</label>
                                    <div class="input-group mb-3 autocompletes">
                                        <input type="text" class="form-control input-check" placeholder="Cari NIK" name="nikupdate" id="nikupdate" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label>Nama Pemakai</label>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Nama Pemakai" name="namaupdate" id="namaupdate" value="" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label>Department</label>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Department Pemakai" name="departmentupdate" id="departmentupdate" value="" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label>Pemberi</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Pemberi" name="pemberiupdate" autocomplete="off" id="pemberiupdate">&nbsp;&nbsp;
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label>Tanggal</label>
                                    <div class="input-group mb-3">
                                        <input type="datetime-local" class="form-control" placeholder="Tanggal" name="tanggalupdate" autocomplete="off" id="datetimeInputUpdate">&nbsp;&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="row input-row-item">
                                <div class="col-3">
                                    <label><span class="item-number">1</span>. Nama Item</label>
                                    <div class="input-group mb-3">
                                        <select class="form-control input-check" name="namaitemupdate[]" autocomplete="off">
                                            <option value="" selected disabled>Pilih Nama Item</option>
                                            <?php foreach ($items as $item): ?>
                                                <option value="<?= $item['no_po'] . '|' . $item['kode_item'] ?>"><?= $item['nama'] ?> - <?= $item['no_po'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="text" class="form-control input-check" name="idstockupdate[]" readonly hidden autocomplete="off">
                                <div class="col-2">
                                    <label>Kode Item</label>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Kode Item" name="kodeitemupdate[]" readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label>Quantity</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control input-check quantity-input" placeholder="Qty" name="qtyupdate[]" autocomplete="off">
                                        <input type="text" class="form-control input-check quantity-input" placeholder="stok" name="stokupdate[]" hidden readonly autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label>Satuan</label>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Satuan" name="satuanupdate[]" disabled autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label>Pemberi</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control input-check" placeholder="Pemberi" name="pemberi[]" value="PIC <?=$user['sub_department']?>" readonly autocomplete="off">
                                        <div class="input-group-append">&nbsp;&nbsp;
                                            <button class="btn btn-sm btn-primary btn-add-row-item" type="button"><i class="fas fa-plus"></i></button>&nbsp;
                                            <button class="btn btn-sm btn-danger btn-remove-row-item" type="button" style="display: none;"><i class="fas fa-trash"></i></button>
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
        $('input[name="qty[]"]').each(function() {
        var $this = $(this);
        var stok = parseFloat($this.closest('.input-row-item').find('input[name="stok[]"]').val());

        // Validasi input quantity agar hanya bisa angka dan titik
        $this.off('input keypress').on('keypress', function(event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            // Mengizinkan hanya angka dan titik
            if (charCode !== 46 && (charCode < 48 || charCode > 57)) {
                event.preventDefault(); // Mencegah karakter yang tidak diinginkan
            }
        }).on('input', function() {
            var value = $(this).val();
            // Hapus karakter yang bukan angka atau titik
            $(this).val(value.replace(/[^0-9.]/g, ''));

            // Cek apakah ada lebih dari satu titik
            if ((value.match(/\./g) || []).length > 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Hanya boleh ada satu titik desimal.',
                });
                $(this).val(value.substring(0, value.length - 1)); // Hapus karakter titik tambahan
                return;
            }

            // Cek apakah titik berada di depan tanpa didahului oleh angka
            if (/^\./.test(value)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Titik tidak boleh di depan tanpa didahului oleh angka.',
                });
                $(this).val(''); // Kosongkan input jika tidak valid
                return;
            }

            // Cek apakah angka diawali dengan 0 yang tidak diikuti oleh titik
            if (/^0[0-9]/.test(value)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Angka tidak boleh diawali dengan 0 kecuali diikuti titik.',
                });
                $(this).val(''); // Kosongkan input jika tidak valid
                return;
            }

            // Cek apakah quantity melebihi stok
            var quantity = parseFloat(value);
            if (quantity > stok) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Quantity tidak boleh melebihi stok yang tersedia.',
                });
                $(this).val(stok.toString()); // Set value ke stok maksimum yang tersedia
            }
        });
    });


        $('#nopakaiupdate').change(function() {
            // Dapatkan option yang dipilih
            var selectedOption = $(this).find('option:selected');

            // Ambil data yang diperlukan
            var waktu = selectedOption.data('waktu');
            var pemberi = selectedOption.data('pemberi');
            var nik = selectedOption.data('nik');
            var items = selectedOption.data('items'); // Data items dalam array

            // Isi input Tanggal, Pemberi, dan NIK dengan nilai yang sesuai
            $('#datetimeInputUpdate').val(waktu);
            $('#pemberiupdate').val(pemberi);
            $('#nikupdate').val(nik);

            // Cari data pengguna di array listuser
            var userData = listuser.find(user => user.startsWith(nik));

            if (userData) {
                // Memecah data pengguna menjadi NIK, Nama, dan Department
                var userDetails = userData.split(' - ');
                var nama = userDetails[1];
                var department = userDetails[2];

                // Isi otomatis input nama dan department
                $('#namaupdate').val(nama);
                $('#departmentupdate').val(department);
            }

            // Kosongkan semua baris item yang ada terlebih dahulu
            $('#itemInputs .input-row-item').not(':first').remove();

            // Isi data nama item, kode item, dan quantity untuk setiap item
            if (items && items.length > 0) {
                items.forEach(function(item, index) {
                    if (index === 0) {
                        // Untuk baris pertama, isi langsung
                        $('select[name="namaitemupdate[]"]').val(item.nama_item);
                        $('input[name="kodeitemupdate[]"]').val(item.kode_item);
                        $('input[name="qtyupdate[]"]').val(item.jml_pakai);
                        $('input[name="satuanupdate[]"]').val(item.satuan);
                        $('input[name="idstockupdate[]"]').val(item.id_stock);
                    } else {
                        // Tambahkan baris baru untuk item berikutnya
                        var newRow = $('#itemInputs .input-row-item:first').clone();

                        newRow.find('select[name="namaitemupdate[]"]').val(item.nama_item);
                        newRow.find('input[name="kodeitemupdate[]"]').val(item.kode_item);
                        newRow.find('input[name="qtyupdate[]"]').val(item.jml_pakai);
                        newRow.find('input[name="satuanupdate[]"]').val(item.satuan);
                        newRow.find('input[name="idstockupdate[]"]').val(item.id_stock);

                        // Tampilkan tombol remove pada baris tambahan
                        newRow.find('.btn-remove-row-item').show();

                        $('#itemInputs').append(newRow);
                    }
                });
            }
        });


        var listuser = <?= $all_user_ex_db ?>;

        function autocomplete(inp, arr) {
            var currentFocus;
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                closeAllLists();
                if (!val) { return false; }
                currentFocus = -1;
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocompletes-list");
                a.setAttribute("class", "autocompletes-items");
                this.parentNode.appendChild(a);

                // Loop untuk membuat item saran berdasarkan array 'arr'
                for (i = 0; i < arr.length; i++) {
                    // Memeriksa apakah nilai yang diinput cocok dengan array
                    if (arr[i].toUpperCase().indexOf(val.toUpperCase()) !== -1) {
                        b = document.createElement("DIV");
                        var matchStart = arr[i].toUpperCase().indexOf(val.toUpperCase());
                        b.innerHTML = arr[i].substr(0, matchStart);
                        b.innerHTML += "<strong>" + arr[i].substr(matchStart, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(matchStart + val.length);
                        
                        // Memecah array untuk mendapatkan bagian-bagian dari string 'NIK - Nama - Department'
                        var values = arr[i].split(' - ');
                        var nik = values[0];  // Bagian pertama adalah NIK

                        // Simpan NIK saja sebagai hidden value
                        b.innerHTML += "<input type='hidden' value='" + nik + "'>";
                        
                        // Tambahkan event listener untuk klik
                        b.addEventListener("click", function(e) {
                            // Input hanya NIK ke dalam field
                            inp.value = this.getElementsByTagName("input")[0].value;
                            fetchUserName(inp.value); // Ambil nama setelah NIK dipilih
                            closeAllLists();
                        });

                        a.appendChild(b);
                    }
                }
            });

            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocompletes-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) { // arrow DOWN key
                    currentFocus++;
                    addActive(x);
                } else if (e.keyCode == 38) { // arrow UP key
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) { // ENTER key
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
                x[currentFocus].classList.add("autocompletes-active");
                x[currentFocus].scrollIntoView({ behavior: 'smooth', block: 'nearest' }); // Scroll jika diperlukan
            }

            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocompletes-active");
                }
            }

            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autocompletes-items");
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


        // Inisialisasi autocomplete untuk NIK Pemakai
        <?php if($aksi === 'add'){?>
        autocomplete(document.getElementById("nik"), listuser);
        <?php } else { ?>
        autocomplete(document.getElementById("nikupdate"), listuser);
        <?php } ?>

        $('#nik').on('keydown', function(e) {
            var key = e.keyCode;
            // 8 adalah kode untuk backspace dan 46 adalah kode untuk delete
            if (key === 8) {
                $('#nama').val('');  // Reset nama saat tombol backspace atau delete ditekan
                $('#department').val('');  // Reset department saat tombol backspace atau delete ditekan
            }
        });

        $('#nikupdate').on('keydown', function(e) {
            var key = e.keyCode;
            // 8 adalah kode untuk backspace dan 46 adalah kode untuk delete
            if (key === 8) {
                $('#namaupdate').val('');  // Reset nama saat tombol backspace atau delete ditekan
                $('#departmentupdate').val('');  // Reset department saat tombol backspace atau delete ditekan
            }
        });

    
        function allInputsFilled() {
            var allFilled = true;
            $('#itemInputs .input-row-item').each(function() {
                $(this).find('.input-check, input[name="tanggal"]').each(function() {
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

            // Kosongkan input di baris baru
            newRow.find('select[name="namaitem[]"]').val(''); // Kosongkan pilihan nama item
            newRow.find('input[name="kodeitem[]"]').val(''); // Kosongkan kode item
            newRow.find('input[name="idstock[]"]').val(''); // Kosongkan kode item
            newRow.find('input[name="qty[]"]').val(''); // Kosongkan quantity
            newRow.find('input[name="stok[]"]').val(''); // Kosongkan quantity
            newRow.find('input[name="satuan[]"]').val(''); // Kosongkan satuan

            // Sembunyikan tombol `plus` di baris sebelumnya dan tampilkan tombol `remove`
            lastRow.find('.btn-add-row-item').hide();
            lastRow.find('.btn-remove-row-item').show();

            // Tambahkan baris baru ke dalam DOM
            $('#itemInputs').append(newRow);

            // Tampilkan tombol `plus` di baris baru dan sembunyikan tombol `remove` di baris baru
            newRow.find('.btn-add-row-item').show();
            newRow.find('.btn-remove-row-item').hide();

            // Autoscroll ke input baru
            newRow[0].scrollIntoView({ behavior: 'smooth' });

            updateItemNumbers();
        }

        function checkRemoveButtonVisibility() {
            var rowCount = $('#itemInputs .input-row-item').length;

            $('#itemInputs .input-row-item').each(function(index) {
            var removeButton = $(this).find('.btn-remove-row-item');
            var addButton = $(this).find('.btn-add-row-item');

            if (index === rowCount - 1) {
                addButton.show(); // Tampilkan tombol plus di baris terakhir
                removeButton.hide(); // Sembunyikan tombol remove di baris terakhir
            } else {
                addButton.hide(); // Sembunyikan tombol plus di baris sebelumnya
                removeButton.show(); // Tampilkan tombol remove di baris sebelumnya
            }

            // Hanya tampilkan tombol remove jika ada lebih dari satu baris
            if (rowCount > 1) {
                removeButton.show();
            } else {
                removeButton.hide();
            }
            });
        }

        // Bind event listener to all input fields
        $('#itemInputs').on('input', '.input-check', function() {
            checkRemoveButtonVisibility();
        });

        // Event listeners
        $('#itemInputs').on('click', '.btn-add-row-item', function() {
            addNewItemRow();
            checkRemoveButtonVisibility();
        });

        $('#itemInputs').on('click', '.btn-remove-row-item', function() {
            $(this).closest('.input-row-item').remove();
            updateItemNumbers();
            checkRemoveButtonVisibility(); // Periksa visibilitas tombol setelah baris dihapus
        });

        $('#itemInputs').on('change', 'select[name="namaitem[]"]', function() {
            var selectedValue = $(this).val();
            var values = selectedValue.split('|');
            var kodeItem = values[1];  // Ambil kode_item
            var $row = $(this).closest('.input-row-item');
            
            $.ajax({
                url: '<?= base_url('inventori/proses/cek_nama_item') ?>',
                type: 'POST',
                data: {kodeitem: selectedValue},
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Kosongkan inputan terlebih dahulu
                        $row.find('input[name="kodeitem[]"]').val('');
                        $row.find('input[name="idstock[]"]').val('');
                        $row.find('input[name="stok[]"]').val('');
                        $row.find('input[name="satuan[]"]').val('');
                        $row.find('input[name="qty[]"]').val('');
                        
                        // Jika ada data, isi inputan dan cek stok
                        if (response.data.length > 0) {
                            var stok = parseFloat(response.data[0].quantity_real); // Gunakan titik untuk perbandingan angka
                            $row.find('input[name="kodeitem[]"]').val(response.data[0].kode_item);
                            $row.find('input[name="idstock[]"]').val(response.data[0].id_stock);
                            $row.find('input[name="stok[]"]').val(response.data[0].quantity_real);
                            $row.find('input[name="satuan[]"]').val(response.data[0].satuan);

                            // Cek apakah stok 0, jika ya, disable input quantity
                            if (stok === 0) {
                                $row.find('input[name="qty[]"]').prop('disabled', true);
                            } else {
                                $row.find('input[name="qty[]"]').prop('disabled', false);
                            }

                            // Validasi input quantity agar hanya bisa angka dan titik
                            $row.find('input[name="qty[]"]').off('input keypress').on('keypress', function(event) {
                                var charCode = (event.which) ? event.which : event.keyCode;
                                // Mengizinkan hanya angka dan titik
                                if (charCode !== 46 && (charCode < 48 || charCode > 57)) {
                                    event.preventDefault(); // Mencegah karakter yang tidak diinginkan
                                }
                            }).on('input', function() {
                                var value = $(this).val();
                                // Hapus karakter yang bukan angka atau titik
                                $(this).val(value.replace(/[^0-9.]/g, ''));

                                // Cek apakah ada lebih dari satu titik
                                if ((value.match(/\./g) || []).length > 1) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Warning!',
                                        text: 'Hanya boleh ada satu titik desimal.',
                                    });
                                    $(this).val(value.substring(0, value.length - 1)); // Hapus karakter titik tambahan
                                    return;
                                }

                                // Cek apakah titik berada di depan tanpa didahului oleh angka
                                if (/^\./.test(value)) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Warning!',
                                        text: 'Titik tidak boleh di depan tanpa didahului oleh angka.',
                                    });
                                    $(this).val(''); // Kosongkan input jika tidak valid
                                    return;
                                }

                                // Cek apakah angka diawali dengan 0 yang tidak diikuti oleh titik
                                if (/^0[0-9]/.test(value)) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Warning!',
                                        text: 'Angka tidak boleh diawali dengan 0 kecuali diikuti titik.',
                                    });
                                    $(this).val(''); // Kosongkan input jika tidak valid
                                    return;
                                }

                                // Cek apakah quantity melebihi stok
                                var quantity = parseFloat(value);
                                if (quantity > stok) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Warning!',
                                        text: 'Quantity tidak boleh melebihi stok yang tersedia.',
                                    });
                                    $(this).val(stok.toString()); // Set value ke stok maksimum yang tersedia
                                }
                            });
                        }
                    } else {
                        // Jika tidak ditemukan, kosongkan input kode item dan satuan
                        $row.find('input[name="kodeitem[]"]').val('');
                        $row.find('input[name="idstock[]"]').val('');
                        $row.find('input[name="stok[]"]').val('');
                        $row.find('input[name="satuan[]"]').val(''); 
                        $row.find('input[name="qty[]"]').prop('disabled', false);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengecek nama item.',
                    });
                }
            });
        });



        // Fungsi untuk mengambil nama berdasarkan NIK
        function fetchUserName(nik) {
            if (nik.length > 0) {
                $.ajax({
                    url: '<?= base_url('inventori/proses/get_all_user_by_nik') ?>',
                    type: 'POST',
                    data: {nik: nik},
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#nama').val(response.nama);
                            $('#department').val(response.department);
                            $('#namaupdate').val(response.nama);
                            $('#departmentupdate').val(response.department);
                        } else {
                            $('#nama').val('');
                            $('#namaupdate').val('');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan dalam mengambil data.',
                        });
                    }
                });
            } else {
                $('#nama').val('');
                $('#namaupdate').val('');
            }
        }

        // Saat input NIK berubah (user mengetik)
        $('#nik').on('input', function() {
            var nik = $(this).val();
            // Ambil nama berdasarkan NIK saat enter ditekan atau item dipilih
            $(this).on('keypress', function(e) {
                if (e.keyCode == 13) { // Enter key
                    fetchUserName(nik);
                }
            });
        });

        // Saat input NIK berubah (user mengetik)
        $('#nikupdate').on('input', function() {
            var nik = $(this).val();
            // Ambil nama berdasarkan NIK saat enter ditekan atau item dipilih
            $(this).on('keypress', function(e) {
                if (e.keyCode == 13) { // Enter key
                    fetchUserName(nik);
                }
            });
        });

        // Saat user memilih dari daftar saran dengan klik
        $(document).on('click', '.autocompletes-items div', function() {
            var selectedNik = $(this).find('input').val();
            $('#nik').val(selectedNik);
            $('#nikupdate').val(selectedNik);
            fetchUserName(selectedNik);
        });


        $('#pemakaianForm').on('submit', function(e) {
            e.preventDefault(); // Mencegah submit form standar

            var nik = $('#nik').val().trim();

            // Cek apakah NIK sudah diisi
            if (nik === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap!',
                    text: 'Harap isi NIK sebelum mengirim.',
                });
                return; // Hentikan pengiriman form
            }

            if (!allInputsFilled()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap!',
                    text: 'Harap isi semua inputan sebelum mengirim.',
                });
                return;
            }

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
                row.find('.input-check, [name="tanggal"], [name="nik"]').each(function() {
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
                var formData = $('#pemakaianForm').serializeArray();
                var cleanedData = formData.filter(function(item) {
                    return item.value.trim() !== ""; // Hanya menyertakan input yang tidak kosong
                });

                if (cleanedData.length > 0) {
                    $.ajax({
                        url: '<?= base_url('akpkai') ?>',
                        method: 'POST',
                        data: $.param(cleanedData),
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Tambah data pemakaian berhasil.',
                                }).then(function() {
                                    window.location.href = '<?= base_url('depak') ?>';
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

        checkRemoveButtonVisibility();
        updateItemNumbers();
    });

</script>

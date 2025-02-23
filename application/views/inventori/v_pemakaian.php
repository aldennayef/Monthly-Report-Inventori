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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data Pemakaian <?=$user['sub_department']?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <a href="<?=base_url('apmp').'/add'?>">
                <button type="button" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Pemakaian
                </button>
                </a>
            </div>
            <table id="item" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>No Pakai</th>
                    <th>Item</th>
                    <th>Jumlah</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($pemakaian as $pk) {?>
                <tr>
                    <td><?=$i++?></td>
                    <td>
                        <span><?=$pk['nopakai']?></span>
                        <input type="text" class="form-control nopakai" value="<?=$pk['nopakai']?>" style="display:none;">
                    </td>
                    <td>
                        <span class="id-stock-text" hidden><?=$pk['id_stock']?></span>
                        <input type="text" class="form-control id-stock" value="<?=$pk['id_stock']?>" style="display:none;">
                        <span class="nama-item-text"><?=$pk['nama']?></span>
                        <span class="kode-item-text" hidden><?=$pk['kode_item']?></span>
                    </td>
                    <td>
                        <span class="jumlah-pakai-text"><?=$pk['jml_pakai']?></span>
                        <input type="text" class="form-control jumlah-pakai" value="" style="display:none;">
                        <input type="hidden" class="form-control jumlah-pakai-old" value="<?=$pk['jml_pakai']?>">
                        <input type="hidden" class="form-control stok-real" value="<?=$pk['quantity_real']?>">
                    </td>
                    <td>
                        <span class="nik-pemakai-text"><?=$pk['nik_pemakai']?></span>
                        <input type="text" class="form-control nik-pemakai" value="" style="display:none;">
                    </td>
                    <td>
                        <span class="nama-pemakai-text"><?=$pk['nama_pemakai']?></span>
                        <input type="text" class="form-control nama-pemakai" value="" style="display:none;">
                    </td>
                    <td>
                        <span class="deskripsi-text"><?=$pk['deskripsi']?></span>
                        <input type="text" class="form-control deskripsi" value="" style="display:none;">
                    </td>
                    <td>
                        <span class="waktu-text"><?=date('d F Y H:i:s', strtotime($pk['waktu']))?></span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-btn"><i class="fas fa-pen"></i></button>
                        <button class="btn btn-sm btn-success lock-btn" style="display:none;"><img src="<?=base_url('assets/gambar/save.png')?>" alt="save" style="width: 18px; height: 18px;"></button>
                        <button class="btn btn-sm btn-danger cancel-btn" style="display:none;"><i class="fas fa-times"></i></button>
                    </td>
                </tr>
                <?php }?>
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--CALL FOOTER-->
<footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
                </div>
            </footer>

        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
        <!-- DataTables  & Plugins -->
        <script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/jszip/jszip.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/pdfmake/pdfmake.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/pdfmake/vfs_fonts.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
        <script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>
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
            $(function () {
                    $('#item').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    });
                });
                $(document).ready(function() {
                // Event listener untuk tombol edit
                $('#item').on('click', '.edit-btn', function() {
        var row = $(this).closest('tr');
        var jmlpakaiText = row.find('.jumlah-pakai-text').text();
        var stokReal = parseFloat(row.find('.stok-real').val()) || 0;
        var jumlahPakaiOld = parseFloat(row.find('.jumlah-pakai-old').val()) || 0;

        row.find('.jumlah-pakai-text').hide();
        row.find('.jumlah-pakai').val(jmlpakaiText).show();
        $(this).hide(); // Sembunyikan tombol edit
        row.find('.lock-btn, .cancel-btn').show(); // Tampilkan tombol lock dan cancel

        // Tambahkan event listener untuk validasi input
        row.find('.jumlah-pakai').off('keypress input').on('keypress', function(event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            // Mengizinkan hanya angka dan titik
            if (charCode !== 46 && (charCode < 48 || charCode > 57)) {
                event.preventDefault(); // Mencegah karakter yang tidak diinginkan
            }
        }).on('input', function() {
            var value = $(this).val();
            // Hapus karakter yang bukan angka atau titik
            $(this).val(value.replace(/[^0-9.]/g, ''));

            // Validasi tambahan untuk memastikan tidak ada lebih dari satu titik
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

            // Logika validasi jumlah pakai
            var jumlahPakai = parseFloat($(this).val());
            if (stokReal === 0) {
                // Jika stok real 0, tidak boleh melebihi jumlah-pakai-old
                if (jumlahPakai > jumlahPakaiOld) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning!',
                        text: 'Jumlah pakai tidak boleh melebihi jumlah pakai sebelumnya karena stok real kosong.',
                    });
                    $(this).val(jumlahPakaiOld); // Setel nilai ke jumlah pakai lama
                }
            } else {
                // Jika stok real masih ada, tidak boleh melebihi stok-real + jumlah-pakai-old
                var maxJumlahPakai = stokReal + jumlahPakaiOld;
                if (jumlahPakai > maxJumlahPakai) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning!',
                        text: 'Jumlah pakai tidak boleh melebihi ' + maxJumlahPakai + ' karena stok terbatas.',
                    });
                    $(this).val(maxJumlahPakai); // Setel nilai ke stok-real + jumlah-pakai-old
                }
            }
        });
    });

                // Event listener untuk tombol lock
                $('#item').on('click', '.lock-btn', function() {
                    var row = $(this).closest('tr');
                    var nopakai = row.find('.nopakai').val();
                    var stokReal = parseFloat(row.find('.stok-real').val()) || 0;
                    var updatedJumlahPakai = parseFloat(row.find('.jumlah-pakai').val()) || 0;
                    var jumlahPakaiOld = row.find('.jumlah-pakai-old').val();
                    var jumlahpakai = parseFloat(row.find('.jumlah-pakai-old').val()) || 0;
                    var idStock = row.find('.id-stock').val();

                    // Hitung updateQuantityReal
                    var updateQuantityReal = stokReal + jumlahpakai - updatedJumlahPakai;

                    // Kirim data ke server via AJAX
                    $.ajax({
                        url: '<?= base_url('akpkai') ?>',  // Ganti dengan URL yang sesuai
                        method: 'POST',
                        data: {
                            nopakai: nopakai,
                            id_stock: idStock,
                            updateQuantity: updateQuantityReal,
                            updateJmlPakai: updatedJumlahPakai,
                            jumlahpakai: jumlahpakai,
                            type: "update",
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                // Jika berhasil, perbarui tampilan
                                row.find('.jumlah-pakai-text').text(updatedJumlahPakai).show();
                                row.find('.jumlah-pakai').hide();
                                row.find('.lock-btn, .cancel-btn').hide();
                                row.find('.edit-btn').show();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses !',
                                    text: 'Jumlah Pakai Diupdate !',
                                });
                            } else {
                                alert('Update gagal: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Terjadi kesalahan saat mengirim data.');
                        }
                    });
                });

                $('#item').on('click', '.cancel-btn', function() {
                    var row = $(this).closest('tr');

                    // Kembalikan nilai stok real, selisih, dan result ke nilai awal
                    // var originalRealStok = row.data('original-nama-item');
                    // var originalRealStok = row.data('original-kode-item');
                    // var originalRealStok = row.data('original-real-stok');
                    // var originalSelisih = row.data('original-selisih');
                    var originaljumlahpakai = row.data('original-jumlahpakai');

                    row.find('.jumlah-pakai').hide().val(''); // Sembunyikan input stok real dan kosongkan nilai input
                    row.find('.jumlah-pakai-text').text(originaljumlahpakai).show(); // Tampilkan kembali teks stok real

                    // Kembalikan nilai selisih dan result ke nilai awal
                    // row.find('.selisih-text').text(originalSelisih);
                    // row.find('.result-text').text(originalResult);

                    $(this).hide(); // Sembunyikan tombol cancel
                    row.find('.lock-btn').hide(); // Sembunyikan tombol lock
                    row.find('.edit-btn').show(); // Tampilkan kembali tombol edit
                });
            });
        </script>
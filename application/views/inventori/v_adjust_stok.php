

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
                                        <h3 class="card-title">Adjust Stok</h3>
                                    </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="<?=base_url('deastok')?>">
                                        <button type="button" class="btn btn-success mb-2">
                                            <i class="fas fa-info-circle"></i>&nbsp;Riwayat Adjust Stok
                                        </button>
                                    </a>

                                    <table id="item" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Item</th>
                                                <th>Nama Item</th>
                                                <th>Sisa Stok</th>
                                                <th>Stok Real</th>
                                                <th>Stok Adjust</th>
                                                <th>Detail</th>
                                                <th>Adjust Stok At</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach ($item as $items) { ?>
                                        <tr data-clusterid="<?=$items['id_cluster']?>">
                                            <td><?=$i++?></td>
                                            <td>
                                                <span><?=$items['kode_item']?></span>
                                                <input type="hidden" class="form-control kode-item" value="<?=$items['kode_item']?>">
                                            </td>
                                            <td>
                                                <span><?=$items['nama']?></span>
                                                <input type="hidden" class="form-control nama-item" value="<?=$items['nama']?>">
                                            </td>
                                            <td>
                                                <span><?=$items['quantity_real']?></span>
                                                <input type="hidden" class="form-control stok-old" value="<?=$items['quantity_real']?>">
                                            </td>
                                            
                                            <?php
                                            // Cari data opname yang sesuai dengan kode_item saat ini
                                            $matchedAdjustStok = null;
                                            foreach ($dataadjuststok as $das) {
                                                if ($das['kode_item'] == $items['kode_item']) {
                                                    $matchedAdjustStok = $das;
                                                    break;
                                                }
                                            }
                                            ?>
                                            
                                            <?php if ($matchedAdjustStok) { ?>
                                            <td>
                                                <span class="real-stok-text"><?=$matchedAdjustStok['stok_real']?></span>
                                                <input type="text" class="form-control real-stok" value="" style="display:none;">
                                            </td>
                                            <td>
                                                <span class="adjust-stok-text"><?=$matchedAdjustStok['stok_adjust']?></span>
                                            </td>
                                            <td>
                                                <span class="deskripsi-text"><?=$matchedAdjustStok['deskripsi']?></span>
                                            </td>
                                            <td>
                                                <span class="adjust-at-text"><?=date('d F Y H:i:s', strtotime($matchedAdjustStok['adjust_at']))?></span>
                                            </td>
                                            <?php } else { ?>
                                            <td>
                                                <span class="real-stok-text">-</span>
                                                <input type="text" class="form-control real-stok" value="" style="display:none;">
                                            </td>
                                            <td>
                                                <span class="adjust-stok-text">-</span>
                                            </td>
                                            <td>
                                                <span class="deskripsi-text">-</span>
                                            </td>
                                            <td>
                                            <span class="adjust-at-text">-</span>
                                            </td>
                                            <?php } ?>
                                            
                                            <td>
                                                <button class="btn btn-sm btn-primary adjust-btn">Adjust Stok</button>
                                                <button class="btn btn-sm btn-success submit-btn" style="display:none;">Submit</i></button>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
                // Event listener untuk mencegah input selain angka positif dan koma
                $('#item').on('input', '.real-stok', function() {
                    var value = $(this).val();

                    // Izinkan angka dan koma, hapus karakter lain
                    value = value.replace(/[^0-9,]/g, '');

                    // Pastikan hanya satu koma yang diperbolehkan
                    if ((value.match(/,/g) || []).length > 1) {
                        value = value.replace(/,/g, ''); // Hapus semua koma jika lebih dari satu
                    }

                    // Update nilai input
                    $(this).val(value);
                });
                
                // Event listener untuk tombol edit
                $('#item').on('click', '.adjust-btn', function() {
                    var row = $(this).closest('tr'); // Dapatkan baris yang sesuai dengan tombol yang diklik
                    var realStokText = row.find('.real-stok-text').text(); // Ambil teks stok real yang ada

                    row.find('.real-stok-text').hide(); // Sembunyikan teks stok real
                    row.find('.real-stok').val(realStokText).show(); // Tampilkan input dengan nilai yang ada
                    $(this).hide(); // Sembunyikan tombol edit
                    row.find('.submit-btn').show(); // Tampilkan tombol lock dan cancel
                });

                // Event listener untuk tombol lock
                $('#item').on('click', '.submit-btn', function() {
                    var row = $(this).closest('tr');
                    var updatedRealStok = row.find('.real-stok').val(); // Ambil nilai dari input stok real
                    // var oldRealStok = row.find('.stok-old').val(); // Ambil nilai stok real sebelumnya
                    var sisaStok = parseFloat(row.find('.stok-old').val()) || 0;
                    var clusterId = row.data('clusterid');
                    var kodeItem = row.find('.kode-item').val();
                    var namaItem = row.find('.nama-item').val();

                    // Adjust stok
                    var stokAdjust = updatedRealStok;
                    row.find('.adjust-stok-text').text(stokAdjust); 

                    if(stokAdjust < sisaStok){
                        var adjustDetail = 'Dikurang';
                    }else if(stokAdjust > sisaStok){
                        var adjustDetail = 'Ditambah';
                    }

                    // Kirim data ke server via AJAX
                    $.ajax({
                        url: '<?= base_url('astok') ?>',  // Ganti dengan URL yang sesuai
                        method: 'POST',
                        data: {
                            id_cluster: clusterId,
                            kode_item: kodeItem,
                            nama_item: namaItem,
                            quantity_real: updatedRealStok,
                            sisa_stok: sisaStok,
                            stokAdjust: stokAdjust,
                            adjustDetail:adjustDetail,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                // Jika berhasil, perbarui tampilan
                                row.find('.real-stok-text').text(updatedRealStok).show();
                                row.find('.real-stok').hide();
                                row.find('.submit-btn').hide();
                                row.find('.adjust-btn').show();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses !',
                                    text: response.message,
                                }).then(function() {
                                    // Refresh halaman setelah SweetAlert ditutup
                                    window.location.reload();
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

            });

        </script>
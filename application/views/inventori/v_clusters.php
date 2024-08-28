

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
                                        <h3 class="card-title">Data Clusters</h3>
                                    </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="<?=base_url('tbc')?>">
                                        <button type="button" class="btn btn-success mb-2">
                                            <i class="fas fa-plus"></i> Tambah Cluster
                                        </button>
                                    </a>
                                    <table id="item" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Cluster</th>
                                                <th>Cluster</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach ($clusters as $cluster) { ?>
                                            <tr data-clusterid="<?=$cluster['id_cluster']?>">
                                                <td><?=$i++?></td>
                                                <td>
                                                    <span class="kode-cluster-text"><?=$cluster['kode_cluster']?></span>
                                                    <input type="text" class="form-control kode-cluster-input" value="<?=$cluster['kode_cluster']?>" style="display:none;"></td>
                                                    <input type="hidden" class="form-control kode-cluster-old" value="<?=$cluster['kode_cluster']?>">
                                                <td>
                                                    <span class="cluster-text"><?=$cluster['nama_cluster']?></span>
                                                    <input type="text" class="form-control cluster-input" value="<?=$cluster['nama_cluster']?>" style="display:none;">
                                                    <input type="hidden" class="form-control cluster-old" value="<?=$cluster['nama_cluster']?>">
                                                    <input type="hidden" class="form-control type-input" value="update">
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-btn"><i class="fas fa-pen"></i></button>
                                                    <button class="btn btn-sm btn-success lock-btn" style="display:none;"><img src="<?=base_url('assets/gambar/save.png')?>" alt="save" style="width: 18px; height: 18px;"></button>
                                                    <button class="btn btn-sm btn-danger cancel-btn" style="display:none;"><i class="fas fa-times"></i></button>
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
                    // Event listener untuk tombol edit
                    $('#item').on('click', '.edit-btn', function() {
                        var row = $(this).closest('tr'); // Dapatkan baris yang sesuai dengan tombol yang diklik
                        var clusterText = row.find('.cluster-text').text(); // Ambil teks cluster yang ada
                        var kodeclusterText = row.find('.kode-cluster-text').text(); // Ambil teks cluster yang ada
                        row.find('.cluster-text').hide(); // Sembunyikan teks cluster
                        row.find('.cluster-input').val(clusterText).show(); // Tampilkan input dengan nilai yang ada
                        row.find('.kode-cluster-text').hide(); // Sembunyikan teks cluster
                        row.find('.kode-cluster-input').val(kodeclusterText).show(); // Tampilkan input dengan nilai yang ada
                        $(this).hide(); // Sembunyikan tombol edit
                        row.find('.lock-btn, .cancel-btn').show(); // Tampilkan tombol lock dan cancel
                    });

                    // Event listener untuk tombol lock
                    $('#item').on('click', '.lock-btn', function() {
                        var row = $(this).closest('tr');
                        var updatedClusterText = row.find('.cluster-input').val(); // Ambil nilai dari input
                        var oldClusterText = row.find('.cluster-old').val(); // Ambil nilai dari input
                        var kodeupdatedClusterText = row.find('.kode-cluster-input').val(); // Ambil nilai dari input
                        var kodeoldClusterText = row.find('.kode-cluster-old').val(); // Ambil nilai dari input
                        var type_input = row.find('.type-input').val(); // Ambil nilai dari input
                        var clusterId = row.data('clusterid');
                        $.ajax({
                            url: '<?= base_url('act') ?>',  // Ganti dengan URL yang sesuai
                            method: 'POST',
                            data: {
                                id_cluster: clusterId,
                                nama_cluster: updatedClusterText,
                                nama_cluster_old: oldClusterText,
                                kode_cluster: kodeupdatedClusterText,
                                kode_cluster_old: kodeoldClusterText,
                                type: type_input,
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    // Jika berhasil, perbarui tampilan
                                    row.find('.cluster-text').text(updatedClusterText).show();
                                    row.find('.cluster-input').hide();
                                    row.find('.kode-cluster-text').text(kodeupdatedClusterText).show();
                                    row.find('.kode-cluster-input').hide();
                                    row.find('.lock-btn, .cancel-btn').hide();
                                    row.find('.edit-btn').show();
                                } 
                                else if(response.status === 'duplicate'){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Kode Sudah Ada !',
                                    });
                                }
                                else {
                                    alert('Update gagal: ' + response.message);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan saat mengirim data.');
                            }
                        });
                        // Lakukan AJAX untuk menyimpan nilai baru di server jika perlu
                        // row.find('.cluster-text').text(updatedClusterText).show(); // Perbarui dan tampilkan teks cluster baru
                        // row.find('.cluster-input').hide(); // Sembunyikan input cluster
                        // $(this).hide(); // Sembunyikan tombol lock
                        // row.find('.cancel-btn').hide(); // Sembunyikan tombol cancel
                        // row.find('.edit-btn').show(); // Tampilkan kembali tombol edit
                    });

                    // Event listener untuk tombol cancel
                    $('#item').on('click', '.cancel-btn', function() {
                        var row = $(this).closest('tr');
                        row.find('.cluster-input').hide(); // Sembunyikan input cluster
                        row.find('.cluster-text').show(); // Tampilkan kembali teks cluster
                        row.find('.kode-cluster-input').hide(); // Sembunyikan input cluster
                        row.find('.kode-cluster-text').show(); // Tampilkan kembali teks cluster
                        $(this).hide(); // Sembunyikan tombol cancel
                        row.find('.lock-btn').hide(); // Sembunyikan tombol lock
                        row.find('.edit-btn').show(); // Tampilkan kembali tombol edit
                    });
                });
        </script>
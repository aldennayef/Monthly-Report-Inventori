
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
                                        <h3 class="card-title">Data Users</h3>
                                    </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="item" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>Department</th>
                                                <th>Sub Department</th>
                                                <th>Cluster</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($all_users as $allusers) {?>
                                            <tr data-nik="<?=$allusers['nik']?>">
                                                <td><?=$allusers['nama']?></td>
                                                <input type="hidden" name="namauser" class="nama-user" id="namauser" value="<?=$allusers['nama']?>">
                                                <td><?=$allusers['nik']?></td>
                                                <td><?=$allusers['department']?></td>
                                                <td><?=$allusers['sub_department']?></td>
                                                <td class="cluster-cell">
                                                    <span class="cluster-text"><?=$allusers['nama_cluster']?></span>
                                                    <select class="form-control cluster-select" name="cluster" id="cluster" style="display:none;">
                                                        <?php foreach ($clusters as $cluster): ?>
                                                            <option value="<?=$cluster['id_cluster']?>"><?=$cluster['nama_cluster']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-user-btn"><i class="fas fa-pen"></i></button>
                                                    <button class="btn btn-sm btn-success lock-user-btn" style="display:none;"><i class="fas fa-lock"></i></button>
                                                    <button class="btn btn-sm btn-danger cancel-user-btn" style="display:none;"><i class="fas fa-times"></i></button>
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
                    $('#item').on('click', '.edit-user-btn', function() {
                        var row = $(this).closest('tr'); // Dapatkan baris yang sesuai dengan tombol yang diklik
                        row.find('.cluster-text').hide(); // Sembunyikan teks cluster
                        row.find('.cluster-select').show(); // Tampilkan dropdown cluster
                        $(this).hide(); // Sembunyikan tombol edit
                        row.find('.lock-user-btn, .cancel-user-btn').show(); // Tampilkan tombol lock dan cancel
                    });

                    // Event listener untuk tombol lock
                    $('#item').on('click', '.lock-user-btn', function() {
                        var row = $(this).closest('tr');
                        var nik = row.data('nik'); // Dapatkan NIK dari data attribute
                        var selectedClusterValue = row.find('.cluster-select').val(); // Ambil nilai cluster yang dipilih
                        var namauserValue = row.find('.nama-user').val(); // Ambil nilai cluster yang dipilih

                        // Lakukan AJAX untuk menyimpan nilai baru di server
                        $.ajax({
                            url: '<?= base_url("inventori/proses/aksi_users") ?>', // Ubah URL ke controller aksi_users
                            method: 'POST',
                            data: {
                                nik: nik,
                                nama_user: namauserValue,
                                id_cluster: selectedClusterValue
                            },
                            success: function(response) {
                                if (response.status === 'success_add' || response.status === 'success_update') {
                                    var selectedClusterText = row.find('.cluster-select option:selected').text(); // Ambil teks cluster yang dipilih
                                    row.find('.cluster-text').text(selectedClusterText).show(); // Perbarui dan tampilkan teks cluster baru
                                    row.find('.cluster-select').hide(); // Sembunyikan dropdown cluster
                                    row.find('.lock-user-btn, .cancel-user-btn').hide(); // Sembunyikan tombol lock dan cancel
                                    row.find('.edit-user-btn').show(); // Tampilkan kembali tombol edit
                                } else {
                                    alert('Update gagal!');
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan dalam pengiriman data.');
                            }
                        });
                    });

                    // Event listener untuk tombol cancel
                    $('#item').on('click', '.cancel-user-btn', function() {
                        var row = $(this).closest('tr');
                        row.find('.cluster-select').hide(); // Sembunyikan dropdown cluster
                        row.find('.cluster-text').show(); // Tampilkan kembali teks cluster
                        $(this).hide(); // Sembunyikan tombol cancel
                        row.find('.lock-user-btn').hide(); // Sembunyikan tombol lock
                        row.find('.edit-user-btn').show(); // Tampilkan kembali tombol edit
                    });
                });
            </script>
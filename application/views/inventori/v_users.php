
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

            <script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>

            <script>
                $(document).ready(function() {
                $('.edit-user-btn').click(function() {
                    var row = $(this).closest('tr'); // Dapatkan baris yang sesuai dengan tombol yang diklik
                    row.find('.cluster-text').hide(); // Sembunyikan teks cluster
                    row.find('.cluster-select').show(); // Tampilkan dropdown cluster
                    $(this).hide(); // Sembunyikan tombol edit
                    row.find('.lock-user-btn, .cancel-user-btn').show(); // Tampilkan tombol lock dan cancel
                });

                // Event listener untuk tombol lock
                $('.lock-user-btn').click(function() {
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
                $('.cancel-user-btn').click(function() {
                    var row = $(this).closest('tr');
                    row.find('.cluster-select').hide(); // Sembunyikan dropdown cluster
                    row.find('.cluster-text').show(); // Tampilkan kembali teks cluster
                    $(this).hide(); // Sembunyikan tombol cancel
                    row.find('.lock-user-btn').hide(); // Sembunyikan tombol lock
                    row.find('.edit-user-btn').show(); // Tampilkan kembali tombol edit
                });
                });
            </script>
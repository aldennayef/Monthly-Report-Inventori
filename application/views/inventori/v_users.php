
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
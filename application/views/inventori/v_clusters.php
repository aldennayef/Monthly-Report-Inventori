

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
                                                    <button class="btn btn-sm btn-success lock-btn" style="display:none;"><i class="fas fa-lock"></i></button>
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
            
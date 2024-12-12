

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
                                        <h3 class="card-title">Data Opname</h3>
                                    </div>
                                <!-- /.card-header -->
                                <div class="card-body">
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
                                                <th>Waktu Opname</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach ($detail_adjuststok as $dajs) { ?>
                                        <tr data-clusterid="<?=$dajs['id_cluster']?>">
                                            <td><?=$i++?></td>
                                            <td>
                                                <span><?=$dajs['kode_item']?></span>
                                            </td>
                                            <td>
                                                <span><?=$dajs['nama']?></span>
                                            </td>
                                            <td>
                                                <span class="real-stok-text"><?=$dajs['sisa_stok']?></span>
                                            </td>
                                            <td>
                                                <span class="real-stok-text"><?=$dajs['stok_real']?></span>
                                            </td>
                                            <td>
                                                <span class="stokadjust-text"><?=$dajs['stok_adjust']?></span>
                                            </td>
                                            <td>
                                                <span class="deskripsi-text"><?=$dajs['deskripsi']?></span>
                                            </td>
                                            <td>
                                                <span><?=date('d F Y H:i:s', strtotime($dajs['adjust_at']))?></span>
                                            </td>
                                            
                                            <!-- <?php
                                            // Cari data opname yang sesuai dengan kode_item saat ini
                                            $matchedAdjustStok = null;
                                            foreach ($dataadjuststok as $dajs) {
                                                if ($dajs['kode_item'] == $dajs['kode_item']) {
                                                    $matchedAdjustStok = $dajs;
                                                    break;
                                                }
                                            }
                                            ?>
                                            
                                            <?php if ($matchedAdjustStok) { ?>
                                            <td>
                                                <span class="real-stok-text"><?=$matchedAdjustStok['sisa']?></span>
                                            </td>
                                            <td>
                                                <span class="real-stok-text"><?=$matchedAdjustStok['stok_real']?></span>
                                            </td>
                                            <td>
                                                <span class="selisih-text"><?=$matchedAdjustStok['selisih']?></span>
                                            </td>
                                            <td>
                                                <span class="result-text"><?=$matchedAdjustStok['hasil']?></span>
                                            </td>
                                            <?php } else { ?>
                                            <td>
                                                <span class="real-stok-text">-</span>
                                                <input type="text" class="form-control real-stok" value="" style="display:none;">
                                            </td>
                                            <td>
                                                <span class="selisih-text">-</span>
                                            </td>
                                            <td>
                                                <span class="result-text">-</span>
                                            </td>
                                            <?php } ?>
                                            
                                            <td>
                                                <span><?=date('d F Y', strtotime($dajs['waktu']))?></span>
                                            </td> -->
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
        </script>
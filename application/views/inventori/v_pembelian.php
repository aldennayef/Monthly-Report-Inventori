
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
                <h3 class="card-title">Data Items <?=$user['sub_department']?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                  <a href="<?=base_url('apbp').'/add'?>">
                    <button type="button" class="btn btn-success">
                      <i class="fas fa-plus"></i> Tambah Pembelian
                    </button>
                  </a>
                  <a href="<?=base_url('apbp').'/edit'?>">
                    <button type="button" class="btn btn-primary">
                      <i class="fas fa-edit"></i> Edit Pembelian
                    </button>
                  </a>
                </div>
                <table id="item" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Kode Beli</th>
                      <th>No PO</th>
                      <th>Kode Item</th>
                      <th>Quantity</th>
                      <th>Satuan</th>
                      <th>Status</th>
                      <th>Realisasi At</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($pembelian as $pemb) {?>
                    <tr>
                        <td><?=$pemb['kode_beli']?></td>
                        <td><?=$pemb['no_po']?></td>
                        <td><?=$pemb['kode_item']?></td>
                        <td><?=$pemb['quantity']?></td>
                        <td><?=$pemb['satuan']?></td>
                        <td><?=$pemb['status']?></td>
                        <td><?=strftime('%d %B %Y', strtotime($pemb['realisasi_at']))?></td>
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
        <script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
        <!-- SweetAlert2 -->
        <script src="<?=base_url('assets/plugins/sweetalert2/sweetalertnotif2.min.js')?>"></script>

        
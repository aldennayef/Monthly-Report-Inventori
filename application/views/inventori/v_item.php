
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
                <?php if($this->session->userdata('role_id')==3){ ?>
                  <div class="d-flex justify-content-between mb-2">
                    <a href="<?=base_url('aip').'/add'?>">
                      <button type="button" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Item
                      </button>
                    </a>
                    <a href="<?=base_url('aip').'/edit'?>">
                      <button type="button" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Item
                      </button>
                    </a>
                  </div>
                <?php } ?>
                <table id="item" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Kode Item</th>
                      <th>Jenis Item</th>
                      <th>Nama Item</th>
                      <?php if($this->session->userdata('role_id')==3){ ?>
                      <th>Note</th>
                      <?php } else { ?>
                      <th>PIC</th>
                      <?php } ?>
                      <th>Harga Satuan</th>
                      <th>Stok</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($this->session->userdata('role_id')==3){ ?>
                      <?php foreach ($item as $items) {?>
                      <tr>
                        <td><?=$items['ikode_item']?></td>
                        <td><?=$items['ijenis']?></td>
                        <td><?=$items['inama']?></td>
                        <td><?=$items['inote']?></td>
                        <td><?=$items['harga_satuan']?></td>
                        <td><?=$items['quantity_real']?></td>
                        <td><?=date('d F Y', strtotime($items['icreate_at']))?></td>
                      </tr>
                      <?php }?>
                    <?php } else { ?>
                      <?php foreach ($manager_item as $items) {?>
                      <tr>
                        <td><?=$items['ikode_item']?></td>
                        <td><?=$items['ijenis']?></td>
                        <td><?=$items['inama']?></td>
                        <td><?=$items['nama_user']?></td>
                        <td><?=$items['harga_satuan']?></td>
                        <td><?=$items['quantity_real']?></td>
                        <td><?=date('d F Y', strtotime($items['icreate_at']))?></td>
                      </tr>
                      <?php } ?>
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
                

                //Convert bulan ke bhs indonesia (v_item)
            document.addEventListener("DOMContentLoaded", function() {
                const monthNames = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];

                function formatTanggalIndonesia(tanggal) {
                    let date = new Date(tanggal);
                    let day = date.getDate();
                    let month = monthNames[date.getMonth()];
                    let year = date.getFullYear();

                    return `${day} ${month} ${year}`;
                }

                const dateCells = document.querySelectorAll("td:nth-child(5)");
                dateCells.forEach(function(cell) {
                    let originalDate = cell.innerText.trim();
                    if (originalDate) {
                        let formattedDate = formatTanggalIndonesia(originalDate);
                        cell.innerText = formattedDate;
                    }
                });

                
            });
          });
        </script>
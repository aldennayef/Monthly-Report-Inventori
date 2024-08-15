
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
                  <a href="<?=base_url('aip').'/add'?>">
                    <button type="button" class="btn btn-success">
                      <i class="fas fa-plus"></i> Tambah Pembelian
                    </button>
                  </a>
                  <a href="<?=base_url('aip').'/edit'?>">
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
  

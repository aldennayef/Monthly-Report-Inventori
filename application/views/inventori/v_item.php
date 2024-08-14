
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
              <a href="<?=base_url('tbi')?>">
              <button type="button" class="btn btn-success mb-2">
                <i class="fas fa-plus"></i> Tambah Item
              </button>
            </a>
                <table id="item" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Kode Item</th>
                      <th>Jenis Item</th>
                      <th>Nama Item</th>
                      <th>Note</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($item as $items) {?>
                    <tr>
                        <td><?=$items['kode_item']?></td>
                        <td><?=$items['jenis']?></td>
                        <td><?=$items['nama']?></td>
                        <td><?=$items['note']?></td>
                        <td><?=strftime('%d %B %Y', strtotime($items['create_at']))?></td>
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
  
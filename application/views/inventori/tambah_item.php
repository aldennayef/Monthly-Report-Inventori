
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
            <!-- Input data -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Input Data Items</h3>
                </div>
                <form action="" name="itemForm" id="itemForm" method="POST" >
                    <div class="card-body" id="itemInputs">
                        <div class="row input-row-item">
                            <div class="col-3">
                                <label class='labelitem'><span class="item-number">1</span>. Kode Item</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control input-check" placeholder="Kode Item" name="kodeitem[]" autocomplete="off" >
                                </div>
                            </div>
                            <div class="col-3">
                                <label>Jenis Item</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control input-check" placeholder="Jenis Item" name="jenisitem[]" autocomplete="off" >
                                </div>
                            </div>
                            <div class="col-3">
                                <label>Nama Item</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control input-check" placeholder="Nama Item" name="namaitem[]" autocomplete="off" >
                                </div>
                            </div>
                            <div class="col-3">
                                <label>Note</label>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Note" name="note[]" autocomplete="off" value="<?=$user['sub_department']?> 2024" >&nbsp;&nbsp;&nbsp;&nbsp;
                                  <button class="btn btn-sm btn-danger btn-remove-row-item" style="display:none;"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="type" id="type" value="add" hidden>
                    <!-- /.card-body -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" id="btnAddItem" name="btnAddItem">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

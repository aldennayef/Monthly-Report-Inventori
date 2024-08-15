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
  
<?php if($aksi === 'add'){ ?>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Input data -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Input Data PO Pembelian</h3>
            </div>
            <form action="" name="pembelianForm" id="pembelianForm" method="POST" >
                <div class="card-body" id="itemInputs">
                    <div class="row input-row-item">
                    <div class="col-2">
                        <label class='labelitem'><span class="item-number">1</span>. Kode Beli</label>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control input-check" placeholder="Kode Beli" name="kodebeli[]" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-2">
                        <label>Nomor PO</label>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control input-check" placeholder="NO PO" name="nopo[]" id="nopo" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-2">
                        <label>Kode Item</label>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control input-check" placeholder="Kode Item" name="kodeitem[]" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-1">
                        <label>Quantity</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control input-check" placeholder="Quantity" name="qty[]" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-1">
                        <label>Satuan</label>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control input-check" placeholder="Satuan" name="satuan[]" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-2">
                        <label>Harga Satuan</label>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control input-check" placeholder="Harga per Satuan" name="hargapersatuan[]" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-2">
                        <label>Tanggal</label>
                        <div class="input-group mb-3">
                            <input type="datetime-local" class="form-control" placeholder="Tanggal" name="tanggal[]" autocomplete="off" id="datetimeInput">
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
<?php } elseif($aksi === 'edit'){ ?>
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Input data -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Edit Data Items</h3>
            </div>
            <form action="" name="updateitemForm" id="updateitemForm" method="POST">
              <div class="card-body" id="itemInputs">
                <?php if(!empty($items)): ?>
                  <?php foreach($items as $item): ?>
                    <div class="row input-row-item">
                      <div class="col-3">
                        <label class='labelitem'><span class="item-number">1</span>. Kode Item</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control input-check" placeholder="Kode Item" name="kodeitem[]" value="<?=$item['kode_item']?>" autocomplete="off">
                          <input type="hidden" class="form-control input-check" name="oldkodeitem[]" value="<?=$item['kode_item']?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-3">
                        <label>Jenis Item</label>
                        <div class="input-group mb-3 autocompletes">
                          <input type="text" class="form-control input-check" placeholder="Jenis Item" name="jenisitem[]" id="jenisitem" value="<?=$item['jenis']?>" autocomplete="off">
                          <input type="hidden" class="form-control input-check" name="oldjenisitem[]" id="jenisitem" value="<?=$item['jenis']?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-3">
                        <label>Nama Item</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control input-check" placeholder="Nama Item" name="namaitem[]" value="<?=$item['nama']?>" autocomplete="off">
                          <input type="hidden" class="form-control input-check" name="oldnamaitem[]" value="<?=$item['nama']?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-3">
                        <label>Note</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Note" name="note[]" value="<?=$item['note']?>" autocomplete="off">&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="hidden" class="form-control" placeholder="Note" name="oldnote[]" value="<?=$item['note']?>" autocomplete="off">&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <input type="text" name="type" id="type" value="edit" hidden>
              <!-- /.card-body -->
              <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary" id="btnEditItem" name="btnEditItem">Submit</button>
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
<?php } ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
                    var now = new Date();
                    var datetime = now.getFullYear() + '-' 
                        + ('0' + (now.getMonth() + 1)).slice(-2) + '-' 
                        + ('0' + now.getDate()).slice(-2) + 'T' 
                        + ('0' + now.getHours()).slice(-2) + ':' 
                        + ('0' + now.getMinutes()).slice(-2);

                    document.getElementById('datetimeInput').value = datetime;
                });
</script>
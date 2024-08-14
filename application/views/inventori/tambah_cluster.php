
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
                    <h3 class="card-title">Input Data Clusters</h3>
                </div>
                <form action="" name="clusterForm" method="POST" id="clusterForm">
                    <div class="card-body" id="clusterInputs">
                        <div class="row input-row-cluster">
                            <div class="col-6">
                                <label>Kode Cluster</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Kode Cluster" name="kodecluster[]" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label>Nama Cluster</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control input-check" placeholder="Nama Cluster" name="namacluster[]" autocomplete="off" required>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-sm btn-danger btn-remove-row-cluster" style="display:none;"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="type" id="type" value="add" hidden>
                    <!-- /.card-body -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary" id="btnAdd" name="btnAdd">Submit</button>
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

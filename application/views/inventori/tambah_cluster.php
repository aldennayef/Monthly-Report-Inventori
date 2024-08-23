
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
      $(document).ready(function() {
      // js view tambah_cluster
        function addNewClusterRow() {
          var newRow = $('.input-row-cluster').first().clone(); // Clone the first row

          // Clear all inputs in the cloned row
          newRow.find('input').val('');

          // Update button to delete if there are more than one row
          newRow.find('.btn-remove-row-cluster').html('<i class="fas fa-trash"></i>').addClass('btn-danger').removeClass('btn-primary btn-add-row');

          // Append the new row
          $('#clusterInputs').append(newRow);

          // Autoscroll to the new input
          newRow[0].scrollIntoView({ behavior: 'smooth' });

          checkRowCount();
      }

      // Function to check if all input fields in the row are filled
      function checkInputs() {
          var lastRow = $('#clusterInputs .input-row-cluster').last();
          var allFilled = true;

          lastRow.find('.input-check').each(function() {
              if ($(this).val() === '') {
                  allFilled = false;
              }
          });

          if (allFilled) {
              addNewClusterRow();
          }
      }

      // Function to check the number of rows and show/hide remove buttons accordingly
      function checkRowCount() {
          var rowCount = $('#clusterInputs .input-row-cluster').length;

          if (rowCount > 1) {
              $('.btn-remove-row-cluster').html('<i class="fas fa-trash"></i>').addClass('btn-danger').removeClass('btn-primary btn-add-row');
              $('.btn-remove-row-cluster').show();
          } else {
              $('.btn-remove-row-cluster').html('<i class="fas fa-plus"></i>').removeClass('btn-danger').addClass('btn-primary btn-add-row');
          }
      }

      // Bind event listener to all input fields
      $('#clusterInputs').on('input', '.input-check', function() {
          checkInputs();
      });

      // Bind event listener to the delete button
      $('#clusterInputs').on('click', '.btn-remove-row-cluster', function() {
          var rowCount = $('#clusterInputs .input-row-cluster').length;
          if (rowCount > 1) {
              $(this).closest('.input-row-cluster').remove();
              checkRowCount();
          } else {
              addNewClusterRow();
              checkRowCount();
          }
      });

      $('#clusterForm').on('submit', function(e) {
          e.preventDefault(); // Prevent the form from submitting in the traditional way

          var allFilled = true;
          $('.input-check').each(function() {
              if ($(this).val() === '') {
                  allFilled = false;
              }
          });

          if (!allFilled) {
              Swal.fire({
                  icon: 'warning',
                  title: 'Mohon lengkapi data!',
                  text: 'Semua kolom wajib diisi.',
              });
          } else {
              Swal.fire({
                  title: 'Apakah anda yakin?',
                  text: "Pastikan semua data sudah benar!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, simpan data!'
              }).then((result) => {
                  if (result.isConfirmed) {
                      // Submit the form via AJAX
                      var formData = $('form[name="clusterForm"]').serialize();
                      $.ajax({
                          url: '<?= base_url('act') ?>',
                          method: 'POST',
                          data: formData,
                          success: function(response) {
                              if (response.status === 'success') {
                                  Swal.fire({
                                      icon: 'success',
                                      title: 'Berhasil!',
                                      text: 'Tambah cluster berhasil.',
                                  }).then(function() {
                                      window.location.href = '<?= base_url('decs') ?>'; // Redirect to 'decs' page
                                  });
                              } else if (response.status === 'duplicate'){
                                  Swal.fire({
                                      icon: 'error',
                                      title: 'Gagal!',
                                      text: 'Kode '+ response.kode +' Sudah Ada !',
                                  });
                              }
                              else {
                                  Swal.fire({
                                      icon: 'error',
                                      title: 'Gagal!',
                                      text: 'Tambah cluster gagal.',
                                  });
                              }
                          },
                          error: function() {
                              Swal.fire({
                                  icon: 'error',
                                  title: 'Error!',
                                  text: 'Terjadi kesalahan dalam pengiriman data.',
                              });
                          }
                      });
                  }
              });
          }
      });
      // Initial check for row count
      checkRowCount();
    });
  </script>
  </body>
</html>
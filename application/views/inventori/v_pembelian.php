
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
                <h3 class="card-title">Data Pembelian <?=$user['sub_department']?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="d-flex justify-content-between mb">
                  <div>
                    <a href="<?=base_url('apbp').'/add'?>">
                      <button type="button" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Pembelian
                      </button>
                    </a>
                  </div>
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
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($pembelian as $pemb) {?>
                    <tr>
                        <td>
                          <span class="kodebeli-text"><?=$pemb['kode_beli']?></span>
                          <input type="text" class="form-control kodebeli" value="<?=$pemb['kode_beli']?>" style="display:none;">
                        </td>
                        <td>
                          <span class="nopo-text"><?=$pemb['no_po']?></span>
                          <input type="text" class="form-control nopo" value="<?=$pemb['no_po']?>" style="display:none;">
                        </td>
                        <td>
                          <span class="kodeitem-text"><?=$pemb['kode_item']?></span>
                          <input type="text" class="form-control kodeitem" value="<?=$pemb['kode_item']?>" style="display:none;">
                        </td>
                        <td>
                          <span class="quantity-text"><?=$pemb['quantity']?></span>
                          <input type="text" class="form-control quantity-update" value="<?=number_format($pemb['quantity'])?>" style="display:none;">
                          <input type="text" class="form-control quantity-now" value="<?=$pemb['quantity_real']?>" style="display:none;">
                          <input type="text" class="form-control quantity-old" value="<?=$pemb['quantity']?>" style="display:none;">
                        </td>
                        <td>
                          <span class="satuan-text"><?=$pemb['satuan']?></span>
                          <input type="text" class="form-control satuan" value="<?=$pemb['satuan']?>" style="display:none;">
                        </td>
                        <td>
                          <span class="status-text"><?=$pemb['status']?></span>
                          <input type="text" class="form-control status" value="<?=$pemb['status']?>" style="display:none;">
                        </td>
                        <td>
                          <span class="tanggal-text"><?=date('d F Y', strtotime($pemb['realisasi_at']))?></span>
                        </td>
                        <td>
                          <button class="btn btn-sm btn-primary edit-btn"><i class="fas fa-pen"></i></button>
                          <button class="btn btn-sm btn-success lock-btn" style="display:none;"><i class="fas fa-lock"></i></button>
                          <button class="btn btn-sm btn-danger cancel-btn" style="display:none;"><i class="fas fa-times"></i></button>
                        </td>
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
            $('.quantity-update').on('input', function() {
        var $row = $(this).closest('td');
        var value = $(this).val();
        var quantityOld = parseFloat($row.find('.quantity-old').val()) || 0;
        var quantityNow = parseFloat($row.find('.quantity-now').val()) || 0;
        var minQuantity = quantityOld - quantityNow;

        // Hapus karakter yang bukan angka, titik, atau koma
        var cleanedValue = value.replace(/[^0-9.,]/g, '');

        // Cek apakah ada lebih dari satu titik
        if ((cleanedValue.match(/\./g) || []).length > 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Hanya boleh ada satu titik desimal.',
            });
            cleanedValue = cleanedValue.substring(0, cleanedValue.length - 1); // Hapus karakter titik tambahan
        }

        // Cek apakah titik berada di depan tanpa didahului oleh angka
        if (/^\./.test(cleanedValue)) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Titik tidak boleh di depan tanpa didahului oleh angka.',
            });
            cleanedValue = ''; // Kosongkan input jika tidak valid
        }

        // Cek apakah angka diawali dengan 0 yang tidak diikuti oleh titik
        if (/^0[^.]/.test(cleanedValue)) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Angka tidak boleh diawali dengan 0 kecuali diikuti titik.',
            });
            cleanedValue = cleanedValue.substring(0, cleanedValue.length - 1); // Hapus karakter yang tidak valid
        }

        // Cek apakah koma dimasukkan setelah titik atau ada lebih dari satu koma berturut-turut
        var dotIndex = cleanedValue.indexOf('.');
        var lastCommaIndex = cleanedValue.lastIndexOf(',');

        if (dotIndex !== -1 && lastCommaIndex > dotIndex) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Koma tidak boleh dimasukkan setelah titik desimal.',
            });
            cleanedValue = cleanedValue.substring(0, lastCommaIndex); // Hapus koma yang dimasukkan setelah titik
        }

        // Cek apakah ada lebih dari satu koma berturut-turut
        if (/,,/.test(cleanedValue)) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Koma tidak boleh dimasukkan berturut-turut.',
            });
            cleanedValue = cleanedValue.replace(/,,/g, ','); // Hapus koma ganda
        }

        // Format angka dengan koma sebagai pemisah ribuan
        var formattedValue = formatNumber(cleanedValue);

        // Perbarui nilai input
        $(this).val(formattedValue);
    });

    // Fungsi untuk memformat angka dengan koma sebagai pemisah ribuan
    function formatNumber(num) {
        // Pisahkan bagian desimal jika ada
        var parts = num.split('.');
        // Format bagian ribuan
        parts[0] = parts[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        // Gabungkan kembali jika ada bagian desimal
        return parts.join('.');
    }

    // Fungsi untuk membersihkan input dari karakter selain angka, titik, dan koma
    function cleanInput(input) {
        return input.replace(/[^0-9.,]/g, '');
    }
            // Event listener untuk tombol edit
            $('#item').on('click', '.edit-btn', function() {
              var row = $(this).closest('tr'); // Dapatkan baris yang sesuai dengan tombol yang diklik
              var quantityText = row.find('.quantity-text').text(); 
              var satuanText = row.find('.satuan-text').text(); 
              var kodebeliText = row.find('.kodebeli-text').text(); 
              var kodeitemText = row.find('.kodeitem-text').text(); 

              // $.ajax({
              //   url: '<?= base_url('inventori/proses/cek_pembelian') ?>',
              //   type: 'POST',
              //   data: {kode_item: kodeitemText, kode_beli:kodebeliText},
              //   dataType: 'json',
              //   success: function(response) {
              //     if (response.status === 'success') {
              //       // Kosongkan dropdown kode item dan satuan terlebih dahulu
              //       $row.find('input[name="kodeitem[]"]').val('');
              //       $row.find('input[name="idstock[]"]').val('');
              //       $row.find('input[name="stok[]"]').val('');
              //       $row.find('input[name="satuan[]"]').val('');
                    
              //       // Jika ada data, isi inputan kode item dan satuan
              //       if (response.data.length > 0) {
              //         $row.find('input[name="kodeitem[]"]').val(response.data[0].kode_item);
              //         $row.find('input[name="idstock[]"]').val(response.data[0].id_stock);
              //         $row.find('input[name="stok[]"]').val(response.data[0].quantity_real);
              //         $row.find('input[name="satuan[]"]').val(response.data[0].satuan);
              //       }
              //     } else {
              //       // Jika tidak ditemukan, kosongkan input kode item dan satuan
              //       $row.find('input[name="kodeitem[]"]').val('');
              //       $row.find('input[name="idstock[]"]').val('');
              //       $row.find('input[name="stok[]"]').val('');
              //       $row.find('input[name="satuan[]"]').val('');
              //     }
              //   },
              //   error: function() {
              //     Swal.fire({
              //       icon: 'error',
              //       title: 'Error!',
              //       text: 'Terjadi kesalahan saat mengecek nama item.',
              //     });
              //   }
              // });

              row.find('.quantity-text').hide();
              row.find('.satuan-text').hide();

              row.find('.satuan').val(satuanText).show();
              row.find('.quantity-update').val(quantityText).show();
              $(this).hide(); // Sembunyikan tombol edit
              row.find('.lock-btn, .cancel-btn').show(); // Tampilkan tombol lock dan cancel
            });

            $('#item').on('click', '.lock-btn', function() {
              var row = $(this).closest('tr');
              var kodebeli = row.find('.kodebeli').val(); 
              var kodeitem = row.find('.kodeitem').val();
              var quantityupdate = parseFloat(row.find('.quantity-update').val().replace(/,/g, '')) || 0;
              var quantitynow = parseFloat(row.find('.quantity-now').val()) || 0;
              var quantityold = parseFloat(row.find('.quantity-old').val()) || 0;
              var satuan = row.find('.satuan').val();

              // Hitung updateQuantity
              var updateQuantity = quantitynow + quantityupdate - quantityold;
              var minQuantity = quantityold - quantitynow;

              // Validasi quantity-update sebelum submit
              if (quantityupdate < minQuantity) {
                  Swal.fire({
                      icon: 'warning',
                      title: 'Warning!',
                      text: `Quantity tidak boleh kurang dari ${minQuantity}.`,
                  });
                  row.find('.quantity-update').val(minQuantity.toString()); // Setel ke nilai minimum yang valid
                  return; // Hentikan proses jika validasi gagal
              }

              // Validasi tambahan untuk input kosong (opsional)
              if (isNaN(quantityupdate) || quantityupdate === 0) {
                  Swal.fire({
                      icon: 'warning',
                      title: 'Warning!',
                      text: 'Quantity update tidak boleh kosong atau 0.',
                  });
                  return; // Hentikan proses jika validasi gagal
              }

              // Kirim data ke server via AJAX
              $.ajax({
                  url: '<?= base_url('akpb') ?>',  // Ganti dengan URL yang sesuai
                  method: 'POST',
                  data: {
                      kodebeli: kodebeli,
                      kodeitem: kodeitem,
                      updateQuantity: updateQuantity,
                      updateQtyPembelian: quantityupdate,
                      updateSatuan: satuan,
                      type: "update",
                  },
                  success: function(response) {
                      if (response.status === 'success') {
                          // Jika berhasil, perbarui tampilan
                          row.find('.quantity-text').text(quantityupdate).show();
                          row.find('.quantity-update').hide();
                          row.find('.satuan-text').text(satuan).show();
                          row.find('.satuan').hide();
                          row.find('.lock-btn, .cancel-btn').hide();
                          row.find('.edit-btn').show();
                          Swal.fire({
                              icon: 'success',
                              title: 'Sukses !',
                              text: 'Quantity Diupdate !',
                          });
                      } else {
                          alert('Update gagal: ' + response.message);
                      }
                  },
                  error: function() {
                      alert('Terjadi kesalahan saat mengirim data.');
                  }
              });
            });


            $('#item').on('click', '.cancel-btn', function() {
                var row = $(this).closest('tr');

                var originalquantity = row.data('original-quantity');
                var originalsatuan = row.data('original-satuan');

                row.find('.quantity-update').hide().val(''); // Sembunyikan input stok real dan kosongkan nilai input
                row.find('.quantity-text').text(originalquantity).show(); // Tampilkan kembali teks stok real
                row.find('.satuan').hide().val(''); // Sembunyikan input stok real dan kosongkan nilai input
                row.find('.satuan-text').text(originalsatuan).show(); // Tampilkan kembali teks stok real

                $(this).hide(); // Sembunyikan tombol cancel
                row.find('.lock-btn').hide(); // Sembunyikan tombol lock
                row.find('.edit-btn').show(); // Tampilkan kembali tombol edit
            });
          });
        </script>
        
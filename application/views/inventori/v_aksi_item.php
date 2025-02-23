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
              <h3 class="card-title">Input Data Items</h3>
            </div>
            <form action="" name="itemForm" id="itemForm" method="POST" >
              <div class="card-body" id="itemInputs">
                <div class="row input-row-item">
                  <div class="col-3">
                    <label class='labelitem'><span class="item-number">1</span>. Kode Item</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control input-check" placeholder="Kode Item" name="kodeitem[]" value="<?=$next_kode_item?>" readonly autocomplete="off">
                    </div>
                  </div>
                  <div class="col-3">
                    <label>Jenis Item</label>
                    <div class="input-group mb-3 autocompletes">
                      <input type="text" class="form-control input-check" placeholder="Jenis Item" name="jenisitem[]" id="jenisitem" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-3">
                    <label>Nama Item</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control input-check" placeholder="Nama Item" name="namaitem[]" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-3">
                    <label>Note</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Note" name="note[]" autocomplete="off" value="<?=$user['sub_department']?> 2024">&nbsp;&nbsp;&nbsp;&nbsp;
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
                          <input type="text" class="form-control input-check" placeholder="Kode Item" name="kodeitem[]" value="<?=$item['ikode_item']?>" autocomplete="off" readonly required>
                          <input type="hidden" class="form-control input-check" name="oldkodeitem[]" value="<?=$item['ikode_item']?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-3">
                        <label>Jenis Item</label>
                        <div class="input-group mb-3 autocompletes">
                          <input type="text" class="form-control input-check" placeholder="Jenis Item" name="jenisitem[]" id="jenisitem" value="<?=$item['ijenis']?>" autocomplete="off" required>
                          <input type="hidden" class="form-control input-check" name="oldjenisitem[]" id="jenisitem" value="<?=$item['ijenis']?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-3">
                        <label>Nama Item</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control input-check" placeholder="Nama Item" name="namaitem[]" value="<?=$item['inama']?>" autocomplete="off" required>
                          <input type="hidden" class="form-control input-check" name="oldnamaitem[]" value="<?=$item['inama']?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-3">
                        <label>Note</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Note" name="note[]" value="<?=$item['inote']?>" autocomplete="off" required>&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="hidden" class="form-control" placeholder="Note" name="oldnote[]" value="<?=$item['inote']?>" autocomplete="off">&nbsp;&nbsp;&nbsp;&nbsp;
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
            function updateItemNumbers() {
              $('#itemInputs .input-row-item').each(function(index) {
                $(this).find('.item-number').text(index + 1);
              });
            }

            function addNewItemRow() {
              var newRow = $('.input-row-item').first().clone(); // Clone the first row
              
              // Ambil nilai dari "Jenis Item" di baris terakhir yang sudah diisi
              var lastJenisItemValue = $('.input-row-item').last().find('input[name="jenisitem[]"]').val();
              var noteItemValue = $('.input-row-item').last().find('input[name="note[]"]').val();

              // Ambil nilai kode item terakhir dan tambahkan 1
              var lastKodeItem = $('.input-row-item').last().find('input[name="kodeitem[]"]').val();
              var kodeItemParts = lastKodeItem.split('_');
              var newKodeItem = kodeItemParts.slice(0, -1).join('_') + '_' + (parseInt(kodeItemParts.slice(-1)[0]) + 1);

              // Clear all inputs in the cloned row
              newRow.find('input').val(''); 
              newRow.find('input[name="kodeitem[]"]').val(newKodeItem);
              newRow.find('input[name="note[]"]').val(noteItemValue); // Set default value for Note
              newRow.find('input[name="jenisitem[]"]').val(lastJenisItemValue); // Set nilai "Jenis Item"

              // Append the new row
              $('#itemInputs').append(newRow);

              // Autoscroll to the new input
              newRow[0].scrollIntoView({ behavior: 'smooth' });
              initializeAutocomplete(newRow.find('#jenisitem'));

              checkRemoveButtonVisibility(); // Periksa visibilitas tombol remove
              updateItemNumbers();
            }

            function checkRemoveButtonVisibility() {
              var rowCount = $('#itemInputs .input-row-item').length;

              $('#itemInputs .input-row-item').each(function(index) {
                var removeButton = $(this).find('.btn-remove-row-item');
                if (index === rowCount - 1 || index === 0) {
                  removeButton.hide(); // Sembunyikan tombol remove pada baris terakhir
                } else {
                  removeButton.html('<i class="fas fa-trash"></i>').attr('type', 'button').removeClass('btn-primary btn-add-row').addClass('btn-danger').show();
                }
              });
            }

            // deteksi aksi apa. Add atau Edit
            var aksi = '<?= $aksi ?>';

            // Function to check if all input fields in the row are filled
            function checkInputsItem() {
              var lastRow = $('#itemInputs .input-row-item').last();
              var allFilled = true;

              lastRow.find('.input-check').each(function() {
                if ($(this).val() === '') {
                  allFilled = false;
                }
              });

              if (allFilled && aksi !== 'edit') {
                addNewItemRow();
              }

              checkRemoveButtonVisibility(); // Periksa visibilitas tombol remove setelah input berubah
            }

            // Bind event listener to all input fields
            $('#itemInputs').on('input', '.input-check', function() {
              if (aksi !== 'edit') {  // Hanya jalankan checkInputsItem jika bukan dalam mode edit
                checkInputsItem();
              }
            });

            function updateKodeItems() {
    var kodeItemParts = $('#itemInputs .input-row-item').first().find('input[name="kodeitem[]"]').val().split('_');
    var prefix = kodeItemParts.slice(0, -1).join('_'); // Mengambil prefix sebelum angka

    // Perbarui setiap kode item setelah penghapusan dengan menjaga prefix dan hanya mengubah angka terakhir
    $('#itemInputs .input-row-item').each(function(index) {
        var currentIndex = parseInt(kodeItemParts.slice(-1)[0]) + index; // Mengambil angka dari kode item pertama, lalu menambah index
        $(this).find('input[name="kodeitem[]"]').val(prefix + '_' + currentIndex); // Update kode item berdasarkan urutan
    });
}

            function removeItemRow(row) {
                var rowCount = $('#itemInputs .input-row-item').length;

                if (rowCount > 1) {
                    // Hapus baris yang tombol remove-nya diklik
                    row.remove();

                    updateItemNumbers();
                    updateKodeItems(); // Update kode item setelah menghapus baris
                    checkRemoveButtonVisibility(); // Periksa visibilitas tombol remove setelah baris dihapus
                }
            }

            // Bind event listener to the delete button
            $('#itemInputs').on('click', '.btn-remove-row-item', function() {
              var rowCount = $('#itemInputs .input-row-item').length;
              if (rowCount > 1) {
                var row = $(this).closest('.input-row-item');
                removeItemRow(row);
              } else {
                if (aksi !== 'edit') {  // Hanya jalankan addNewItemRow jika bukan dalam mode edit
                  addNewItemRow();
                }
                checkRemoveButtonVisibility();
              }
            });

            $('#itemForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah submit form standar

                var isValid = true;
                var lastRow = $('#itemInputs .input-row-item').last();
                var lastRowIsEmpty = true;
                var emptyInputNumber = null;
                var kodeItemArray = [];
                var duplicateFound = false;

                // Cek apakah ada duplikat kode item
                $('#itemInputs .input-row-item').each(function(index) {
                    var row = $(this);
                    var kodeItemInput = row.find('input[name="kodeitem[]"]');
                    var kodeItemVal = kodeItemInput.val().trim();

                    if (kodeItemVal !== '') {
                        if (kodeItemArray.includes(kodeItemVal)) {
                            duplicateFound = true;
                            kodeItemInput.val(''); // Kosongkan input yang duplikat
                            kodeItemInput.focus();
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Kode ' + kodeItemVal + ' duplikat!',
                            });
                            return false; // Keluar dari loop jika ditemukan duplikat
                        } else {
                            kodeItemArray.push(kodeItemVal);
                        }
                    }
                });

                if (duplicateFound) {
                    return; // Jika ada duplikat, hentikan proses lebih lanjut
                }

                // Cek apakah hanya ada satu inputan
                if ($('.input-row-item').length === 1) {
                    var singleRow = $('#itemInputs .input-row-item').first();
                    singleRow.find('.input-check').each(function() {
                        if ($(this).val().trim() === '') {
                            isValid = false;
                            $(this).focus(); // Arahkan kursor ke inputan yang belum terisi
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Belum Lengkap!',
                                text: 'Harap isi semua inputan sebelum mengirim.',
                            });
                            return false; // Keluar dari loop jika ditemukan inputan kosong
                        }
                    });

                    if (!isValid) {
                        return; // Hentikan jika inputan tunggal kosong
                    }
                }

                // Cek apakah inputan terakhir kosong
                lastRow.find('.input-check').each(function() {
                    if ($(this).val().trim() !== '') {
                        lastRowIsEmpty = false;
                    }
                });

                // Hapus baris terakhir jika kosong
                if (lastRowIsEmpty && $('.input-row-item').length > 1) {
                    lastRow.remove();
                }

                // Cek apakah ada inputan yang tidak terisi selain inputan terakhir
                $('#itemInputs .input-row-item').not(':last').each(function(index) {
                    var row = $(this);
                    row.find('.input-check').each(function() {
                        if ($(this).val().trim() === '') {
                            isValid = false;
                            emptyInputNumber = index + 1; // Simpan nomor inputan yang kosong
                            $(this).focus(); // Arahkan kursor ke inputan yang belum terisi
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Belum Lengkap!',
                                text: 'Harap isi semua inputan pada nomor ' + emptyInputNumber + ' sebelum mengirim.',
                            });
                            return false; // Keluar dari loop jika ditemukan inputan kosong
                        }
                    });
                    if (!isValid) {
                        return false; // Keluar dari loop jika ditemukan inputan kosong
                    }
                });

                if (isValid) {
                    // Hapus baris terakhir jika kosong
                    if (lastRowIsEmpty) {
                        lastRow.remove();
                    }

                    // Serialisasi data form
                    var formData = $('#itemForm').serializeArray();

                    // Submit form via AJAX
                    $.ajax({
                        url: '<?= base_url('akm') ?>',
                        method: 'POST',
                        data: $.param(formData),
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Tambah item berhasil.',
                                }).then(function() {
                                    window.location.href = '<?= base_url('dem') ?>'; // Redirect to 'decs' page
                                });
                            } else if (response.status === 'duplicate') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Kode ' + response.kode + ' Sudah Ada !',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Tambah item gagal.',
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



            checkRemoveButtonVisibility();
            updateItemNumbers();

            $('#updateitemForm').on('submit', function(e) {
              e.preventDefault(); // Mencegah submit form standar

              var isValid = true;
              var lastRow = $('#itemInputs .input-row-item').last();
              var lastRowIsEmpty = true;
              var emptyInputNumber = null;

              // Cek apakah inputan terakhir kosong
              lastRow.find('.input-check').each(function() {
                if ($(this).val() !== '') {
                  lastRowIsEmpty = false;
                }
              });

              // Hapus baris terakhir jika kosong
              if (lastRowIsEmpty && $('.input-row-item').length > 1) {
                lastRow.remove();
              }

              // Cek apakah ada inputan yang tidak terisi selain inputan terakhir
              $('#itemInputs .input-row-item').not(':last').each(function(index) {
                var row = $(this);
                row.find('.input-check').each(function() {
                  if ($(this).val() === '') {
                    isValid = false;
                    emptyInputNumber = index + 1; // Simpan nomor inputan yang kosong
                    $(this).focus(); // Arahkan kursor ke inputan yang belum terisi
                    return false; // Keluar dari loop jika ditemukan inputan kosong
                  }
                });
                if (!isValid) {
                  return false; // Keluar dari loop jika ditemukan inputan kosong
                }
              });

              if (isValid) {
                // Pastikan inputan terakhir yang kosong tidak disubmit
                var formData = $('#updateitemForm').serializeArray();
                var cleanedData = formData.filter(function(item) {
                  return item.value.trim() !== ""; // Hanya menyertakan input yang tidak kosong
                });

                  if (cleanedData.length > 0) {
                    // Jika valid dan ada data yang akan disubmit, submit form via AJAX
                    $.ajax({
                      url: '<?= base_url('akm') ?>',
                      method: 'POST',
                      data: $.param(cleanedData),
                      success: function(response) {
                        if (response.status === 'success') {
                          Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Update item berhasil.',
                          }).then(function() {
                            window.location.href = '<?= base_url('dem') ?>'; // Redirect to 'decs' page
                          });
                        } else if (response.status === 'duplicate') {
                          Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Kode ' + response.kode + ' Sudah Ada !',
                          });
                        } else {
                          Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Update item gagal.',
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
                  }else {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Data Belum Lengkap!',
                      text: 'Harap isi semua inputan sebelum mengirim.',
                    });
                  }
                }else {
                Swal.fire({
                  icon: 'warning',
                  title: 'Data Belum Lengkap!',
                  text: 'Harap isi semua inputan pada nomor ' + emptyInputNumber + ' sebelum mengirim.',
                });
              }
            });

            //Suggest inputan JENIS di tambah_item.php
            var listjenisitem = <?= $suggest_jenis ?>;

            function autocomplete(inp, arr) {
              var currentFocus;
              inp.addEventListener("input", function(e) {
                  var a, b, i, val = this.value;
                  closeAllLists();
                  if (!val) { return false; }
                  currentFocus = -1;
                  a = document.createElement("DIV");
                  a.setAttribute("id", this.id + "autocompletes-list");
                  a.setAttribute("class", "autocompletes-items");
                  this.parentNode.appendChild(a);
                  for (i = 0; i < arr.length; i++) {
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                      b = document.createElement("DIV");
                      b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                      b.innerHTML += arr[i].substr(val.length);
                      b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                      b.addEventListener("click", function(e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        closeAllLists();
                      });
                      a.appendChild(b);
                    }
                  }
              });
              inp.addEventListener("keydown", function(e) {
                  var x = document.getElementById(this.id + "autocompletes-list");
                  if (x) x = x.getElementsByTagName("div");
                  if (e.keyCode == 40) {
                    currentFocus++;
                    addActive(x);
                  } else if (e.keyCode == 38) {
                    currentFocus--;
                    addActive(x);
                  } else if (e.keyCode == 13) {
                    e.preventDefault();
                    if (currentFocus > -1) {
                      if (x) x[currentFocus].click();
                    }
                  }
              });
              function addActive(x) {
                if (!x) return false;
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autocompletes-active");
              }
              function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                  x[i].classList.remove("autocompletes-active");
                }
              }
              function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autocompletes-items");
                for (var i = 0; i < x.length; i++) {
                  if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                  }
                }
              }
              document.addEventListener("click", function(e) {
                closeAllLists(e.target);
              });
            }

            // Inisialisasi autocomplete untuk status
            autocomplete(document.getElementById("jenisitem"), listjenisitem);

            // Inisialisasi autocomplete untuk input baru
            function initializeAutocomplete(inputElement) {
              var listjenisitem = <?= $suggest_jenis ?>;
              autocomplete(inputElement[0], listjenisitem);
            }

            // Panggil initializeAutocomplete untuk input yang ada
            $('#itemInputs .input-row-item').each(function() {
              initializeAutocomplete($(this).find('#jenisitem'));
            });
          });
        </script>
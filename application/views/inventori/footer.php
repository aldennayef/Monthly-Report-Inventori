              
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
        <!-- jQuery UI 1.11.4 -->
        <script src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
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

            <script>
                $(function () {
                    $('#item').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    });
                });
            $(document).ready(function() {
                // Event listener untuk tombol edit
                $('.edit-btn').click(function() {
                    var row = $(this).closest('tr'); // Dapatkan baris yang sesuai dengan tombol yang diklik
                    var clusterText = row.find('.cluster-text').text(); // Ambil teks cluster yang ada
                    var kodeclusterText = row.find('.kode-cluster-text').text(); // Ambil teks cluster yang ada
                    row.find('.cluster-text').hide(); // Sembunyikan teks cluster
                    row.find('.cluster-input').val(clusterText).show(); // Tampilkan input dengan nilai yang ada
                    row.find('.kode-cluster-text').hide(); // Sembunyikan teks cluster
                    row.find('.kode-cluster-input').val(kodeclusterText).show(); // Tampilkan input dengan nilai yang ada
                    $(this).hide(); // Sembunyikan tombol edit
                    row.find('.lock-btn, .cancel-btn').show(); // Tampilkan tombol lock dan cancel
                });

                // Event listener untuk tombol lock
                $('.lock-btn').click(function() {
                    var row = $(this).closest('tr');
                    var updatedClusterText = row.find('.cluster-input').val(); // Ambil nilai dari input
                    var oldClusterText = row.find('.cluster-old').val(); // Ambil nilai dari input
                    var kodeupdatedClusterText = row.find('.kode-cluster-input').val(); // Ambil nilai dari input
                    var kodeoldClusterText = row.find('.kode-cluster-old').val(); // Ambil nilai dari input
                    var type_input = row.find('.type-input').val(); // Ambil nilai dari input
                    var clusterId = row.data('clusterid');
                    $.ajax({
                        url: '<?= base_url('act') ?>',  // Ganti dengan URL yang sesuai
                        method: 'POST',
                        data: {
                            id_cluster: clusterId,
                            nama_cluster: updatedClusterText,
                            nama_cluster_old: oldClusterText,
                            kode_cluster: kodeupdatedClusterText,
                            kode_cluster_old: kodeoldClusterText,
                            type: type_input,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                // Jika berhasil, perbarui tampilan
                                row.find('.cluster-text').text(updatedClusterText).show();
                                row.find('.cluster-input').hide();
                                row.find('.kode-cluster-text').text(kodeupdatedClusterText).show();
                                row.find('.kode-cluster-input').hide();
                                row.find('.lock-btn, .cancel-btn').hide();
                                row.find('.edit-btn').show();
                            } 
                            else if(response.status === 'duplicate'){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Kode Sudah Ada !',
                                });
                            }
                            else {
                                alert('Update gagal: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Terjadi kesalahan saat mengirim data.');
                        }
                    });
                    // Lakukan AJAX untuk menyimpan nilai baru di server jika perlu
                    // row.find('.cluster-text').text(updatedClusterText).show(); // Perbarui dan tampilkan teks cluster baru
                    // row.find('.cluster-input').hide(); // Sembunyikan input cluster
                    // $(this).hide(); // Sembunyikan tombol lock
                    // row.find('.cancel-btn').hide(); // Sembunyikan tombol cancel
                    // row.find('.edit-btn').show(); // Tampilkan kembali tombol edit
                });

                // Event listener untuk tombol cancel
                $('.cancel-btn').click(function() {
                    var row = $(this).closest('tr');
                    row.find('.cluster-input').hide(); // Sembunyikan input cluster
                    row.find('.cluster-text').show(); // Tampilkan kembali teks cluster
                    row.find('.kode-cluster-input').hide(); // Sembunyikan input cluster
                    row.find('.kode-cluster-text').show(); // Tampilkan kembali teks cluster
                    $(this).hide(); // Sembunyikan tombol cancel
                    row.find('.lock-btn').hide(); // Sembunyikan tombol lock
                    row.find('.edit-btn').show(); // Tampilkan kembali tombol edit
                });

                $('.edit-user-btn').click(function() {
                    var row = $(this).closest('tr'); // Dapatkan baris yang sesuai dengan tombol yang diklik
                    row.find('.cluster-text').hide(); // Sembunyikan teks cluster
                    row.find('.cluster-select').show(); // Tampilkan dropdown cluster
                    $(this).hide(); // Sembunyikan tombol edit
                    row.find('.lock-user-btn, .cancel-user-btn').show(); // Tampilkan tombol lock dan cancel
                });

                // Event listener untuk tombol lock
                $('.lock-user-btn').click(function() {
                    var row = $(this).closest('tr');
                    var nik = row.data('nik'); // Dapatkan NIK dari data attribute
                    var selectedClusterValue = row.find('.cluster-select').val(); // Ambil nilai cluster yang dipilih
                    var namauserValue = row.find('.nama-user').val(); // Ambil nilai cluster yang dipilih

                    // Lakukan AJAX untuk menyimpan nilai baru di server
                    $.ajax({
                        url: '<?= base_url("inventori/proses/aksi_users") ?>', // Ubah URL ke controller aksi_users
                        method: 'POST',
                        data: {
                            nik: nik,
                            nama_user: namauserValue,
                            id_cluster: selectedClusterValue
                        },
                        success: function(response) {
                            if (response.status === 'success_add' || response.status === 'success_update') {
                                var selectedClusterText = row.find('.cluster-select option:selected').text(); // Ambil teks cluster yang dipilih
                                row.find('.cluster-text').text(selectedClusterText).show(); // Perbarui dan tampilkan teks cluster baru
                                row.find('.cluster-select').hide(); // Sembunyikan dropdown cluster
                                row.find('.lock-user-btn, .cancel-user-btn').hide(); // Sembunyikan tombol lock dan cancel
                                row.find('.edit-user-btn').show(); // Tampilkan kembali tombol edit
                            } else {
                                alert('Update gagal!');
                            }
                        },
                        error: function() {
                            alert('Terjadi kesalahan dalam pengiriman data.');
                        }
                    });
                });

                // Event listener untuk tombol cancel
                $('.cancel-user-btn').click(function() {
                    var row = $(this).closest('tr');
                    row.find('.cluster-select').hide(); // Sembunyikan dropdown cluster
                    row.find('.cluster-text').show(); // Tampilkan kembali teks cluster
                    $(this).hide(); // Sembunyikan tombol cancel
                    row.find('.lock-user-btn').hide(); // Sembunyikan tombol lock
                    row.find('.edit-user-btn').show(); // Tampilkan kembali tombol edit
                });

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

                    // Clear all inputs in the cloned row
                    newRow.find('input').val(''); 
                    newRow.find('input[name="note[]"]').val(noteItemValue); // Set default value for Note
                    newRow.find('input[name="jenisitem[]"]').val(lastJenisItemValue); // Set nilai "Jenis Item"

                    // Append the new row
                    $('#itemInputs').append(newRow);

                    // Autoscroll to the new input
                    newRow[0].scrollIntoView({ behavior: 'smooth' });

                    checkRemoveButtonVisibility(); // Periksa visibilitas tombol remove
                    updateItemNumbers();
                }

                function checkRemoveButtonVisibility() {
                    var rowCount = $('#itemInputs .input-row-item').length;

                    $('#itemInputs .input-row-item').each(function(index) {
                        var removeButton = $(this).find('.btn-remove-row-item');
                        if (index === rowCount - 1) {
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

                // Bind event listener to the delete button
                $('#itemInputs').on('click', '.btn-remove-row-item', function() {
                    var rowCount = $('#itemInputs .input-row-item').length;
                    if (rowCount > 1) {
                        $(this).closest('.input-row-item').remove();
                        updateItemNumbers();
                        checkRemoveButtonVisibility(); // Periksa visibilitas tombol remove setelah baris dihapus
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
                        var formData = $('#itemForm').serializeArray();
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
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Belum Lengkap!',
                                text: 'Harap isi semua inputan sebelum mengirim.',
                            });
                        }
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Belum Lengkap!',
                            text: 'Harap isi semua inputan pada nomor ' + emptyInputNumber + ' sebelum mengirim.',
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
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Belum Lengkap!',
                                text: 'Harap isi semua inputan sebelum mengirim.',
                            });
                        }
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Belum Lengkap!',
                            text: 'Harap isi semua inputan pada nomor ' + emptyInputNumber + ' sebelum mengirim.',
                        });
                    }
                });

            });

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



        </script>
    </body>
</html>
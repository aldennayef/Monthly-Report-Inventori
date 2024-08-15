    function deleteItem(idCluster, kodeItem) {
                Swal.fire({
                    title: 'Delete Item',
                    text: "Apakah anda yakin menghapus item ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, saya yakin!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('akm') ?>", // Sesuaikan URL ini dengan endpoint delete Anda yang sebenarnya
                            method: "POST",
                            data: { id_cluster: idCluster, kode_item: kodeItem, type: 'delete' },
                            success: function(response) {
                                if(response.status === 'success'){
                                    Swal.fire(
                                        'Deleted!',
                                        'Item telah dihapus.',
                                        'success'
                                    ).then(() => {
                                        location.reload(); // Reload halaman untuk melihat perubahan
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Item gagal dihapus.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'Ada kesalahan dalam menghapus item.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

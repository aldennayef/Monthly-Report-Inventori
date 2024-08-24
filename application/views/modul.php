<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Modul</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">
    <style>
        body{
            background-image: url('<?=base_url('assets/gambar/bg-modul.jpg')?>');
            /* Full height */
            height: 100%; 

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .card {
            color: white;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            border: none; /* Menghilangkan border card agar lebih terintegrasi dengan gambar latar */
        }
        .card h4 {
            margin: 0;
        }
        .card-body {
            background-color: rgba(0, 0, 0, 0.5); /* Background semi-transparan untuk keterbacaan teks */
        }
    </style>
</head>
<body>
<div class="container mt-3">
    <!-- Judul Paling Atas -->
    <h2 class="mb-4 text-center" style="color: white;">Pilih Modul</h2>

    <?php if (!empty($moduls)): ?>
        <div class="row">
            <?php foreach ($moduls as $modul): ?>
                <div class="col-md-4 mb-4"> <!-- Menggunakan class mb-4 untuk memberi jarak bawah -->
                    <div class="card" style="background-image: url('<?=base_url('assets/gambar/bglogin.jpg')?>');">
                        <div class="card-header">
                            <h4><?= $modul['nama']; ?></h4>
                        </div>
                        <div class="card-body">
                            <a href="<?= $modul['link']; ?>" class="btn btn-primary buka-modul" data-link="<?= $modul['link']; ?>">Buka Modul</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Tidak ada modul yang tersedia.</p>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var cekNIK = <?= json_encode($cek_nik) ?>; // Pastikan cekNIK adalah boolean true atau false
    var roleID = <?= json_encode($this->session->userdata('role_id')) ?>; // Pastikan cekNIK adalah boolean true atau false

    // Loop melalui semua tombol "Buka Modul"
    document.querySelectorAll('.buka-modul').forEach(function(button) {
        var link = button.getAttribute('data-link');

        // Cek jika cekNIK adalah false dan link adalah 'inventori'
        if (!cekNIK && link === 'inventori' && roleID != 1 && roleID != 2 && roleID !=4) {
            button.classList.add('disabled'); // Menambahkan kelas 'disabled'
            button.classList.remove('btn-primary'); // Mengganti warna tombol menjadi abu-abu
            button.classList.add('btn-secondary');
            button.setAttribute('aria-disabled', 'true'); // Aksesibilitas
            button.setAttribute('href', '#'); // Menghapus link
        }
    });
});

</script>

</body>
</html>

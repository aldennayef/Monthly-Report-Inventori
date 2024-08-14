<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to SIMI Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">

    <style>
      .login-box .card-header img {
        width: 100px; /* adjust as needed */
      }
      body{
        background-image: url('<?=base_url('assets/gambar/bglogin-2.png')?>');
        /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
  </head>
  <body class="hold-transition login-page" style="background-color: rgb(70, 70, 70);">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <img src="<?=base_url('assets/gambar/indofood-cbp.jpeg')?>" alt="Logo">
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <form action="" method="post" id="formLogin" name="formLogin">
            <div class="input-group mb-3">
              <input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" REQUIRED>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off" REQUIRED>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-key"></span>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block" id="btnLogin" name="btnLogin">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('assets/js/adminlte.min.js')?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?=base_url('assets/plugins/sweetalert2/sweetalertnotif2.min.js')?>"></script>
    <script>
      $('#btnLogin').on('click', function(e) {
        e.preventDefault();
        var isValid = true;

        // Periksa setiap input yang diperlukan
        $('input[required]').each(function() {
          if ($(this).val() === '') {
            isValid = false;
            return false; // Menghentikan loop jika ada yang kosong
          }
        });

        if (!isValid) {
          Swal.fire({
            icon: 'warning',
            title: 'Mohon lengkapi data',
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Oke'
          });
        } else {
          var formData = $('form[name="formLogin"]').serialize();
          $.ajax({
            url: '<?=base_url('inventori/auth/login')?>', // Sesuaikan URL dengan URL tujuan submit form
            type: 'POST',
            dataType: 'json', // Memastikan respons diharapkan dalam format JSON
            data: formData,
            success: function(response) {
              if(response.status == '1'){
                Swal.fire({
                  icon: 'success',
                  title: response.detail,
                  showConfirmButton: false,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Oke',
                  timer: 1500
                }).then(() => {
                  window.location.href = '<?=base_url('dsb')?>';
                });
              }
              else if(response.status == '0'){
                Swal.fire({
                  icon: 'error',
                  title: response.detail,
                  showConfirmButton: false,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Oke',
                  timer: 1500
                });
              }
              else if(response.status == '2'){
                Swal.fire({
                  icon: 'error',
                  title: response.detail,
                  showConfirmButton: false,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Oke',
                  timer: 1500
                });
              }
            },
            error: function(xhr, status, error) {
              console.error('AJAX Error: ' + status + error);
              console.log('Response:', xhr.responseText); // Tambahkan log ini untuk debugging
              Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan saat masuk ke sistem',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Oke'
              });
            }
          });
        }
      });
    </script>
  </body>
</html>

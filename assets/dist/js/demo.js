(function ($) {
  'use strict'

  // Fungsi untuk Dark Mode dengan ikon matahari/bulan
  var $dark_mode_toggle = $('#dark-mode-toggle i').on('click', function () {
    if ($('body').hasClass('dark-mode')) {
      $('body').removeClass('dark-mode')
      $(this).removeClass('fa-sun').addClass('fa-moon') // Ubah ikon ke bulan
    } else {
      $('body').addClass('dark-mode')
      $(this).removeClass('fa-moon').addClass('fa-sun') // Ubah ikon ke matahari
    }
  })

  // Atur ikon awal berdasarkan mode yang ada
  if ($('body').hasClass('dark-mode')) {
    $dark_mode_toggle.removeClass('fa-moon').addClass('fa-sun')
  }
})(jQuery)

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Dashboard - Sistem Rental Biliar</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root { --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; }
      body { font-feature-settings: "cv02", "cv03", "cv04", "cv11"; }
    </style>
  </head>
  <body>
    <div class="page">
      
      @include('layouts.sidebar')

      <div class="page-wrapper">
        
        @include('layouts.navbar')

        <div class="page-body">
          <div class="container-xl">
            @yield('content')
          </div>
        </div>

        @include('layouts.footer')

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/js/tabler.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Notifikasi Sukses
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            @endif

            // 2. Notifikasi Gagal / Eror (Termasuk Pencegah Double Booking kemarin)
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Waduh, Gagal!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ok, Paham'
                });
            @endif
        });
    </script>
    @endif
    </body>
</html>
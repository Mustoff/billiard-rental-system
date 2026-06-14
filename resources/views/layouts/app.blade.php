<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Dashboard - Sistem Rental Biliar</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    
    <style>
        /* PALET WARNA MODERN SPORTY */
        :root {
            --sporty-navy: #0f172a;
            --sporty-cyan: #0ea5e9;
            --sporty-amber: #f59e0b;
            --sporty-bg: #f8fafc;
        }

        body {
            background-color: var(--sporty-bg) !important;
            font-family: 'Inter', sans-serif;
        }

        /* KUSTOMISASI SIDEBAR */
        .sidebar-sporty {
            background-color: var(--sporty-navy) !important;
            border-right: none !important;
        }

        /* DESAIN CARD MEJA BILIAR */
        .card-meja {
            border-radius: 16px !important;
            border: none !important;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
        }
        
        .card-meja:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        }

        /* INDIKATOR STATUS MEJA KIRI */
        .status-tersedia {
            border-left: 6px solid var(--sporty-cyan) !important;
        }
        
        .status-terpakai {
            border-left: 6px solid var(--sporty-amber) !important;
        }

        /* ANIMASI DENYUT (PULSE) UNTUK MEJA YANG SEDANG JALAN */
        @keyframes pulse-amber {
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }
        .indikator-jalan {
            display: inline-block;
            width: 12px;
            height: 12px;
            background-color: var(--sporty-amber);
            border-radius: 50%;
            animation: pulse-amber 2s infinite;
            margin-right: 8px;
        }
        
        .indikator-kosong {
            display: inline-block;
            width: 12px;
            height: 12px;
            background-color: var(--sporty-cyan);
            border-radius: 50%;
            margin-right: 8px;
        }
        .sidebar-sporty .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
            font-weight: 500;
            padding: 0.65rem 1rem !important;
            border-left: 4px solid transparent;
            transition: all 0.2s ease;
        }

        .sidebar-sporty .nav-link:hover, 
        .sidebar-sporty .nav-item.active .nav-link {
            color: #fff !important;
            background-color: rgba(14, 165, 233, 0.15) !important; /* Cyan transparan */
            border-left-color: var(--sporty-cyan) !important; /* Garis vertikal menyala */
        }

        .sidebar-sporty .nav-link-icon {
            font-size: 1.1rem;
            margin-right: 0.5rem;
        }
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
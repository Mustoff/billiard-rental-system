<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
  <div class="container-fluid">
    <div class="navbar-brand text-center py-3">
        <a href="{{ route('dashboard') }}" class="text-decoration-none">
            @if($webSetting && $webSetting->logo)
                <img src="{{ asset('storage/' . $webSetting->logo) }}" alt="Logo" class="navbar-brand-image mb-2" style="height: 80px; object-fit: contain;">
            @else
                <span class="fs-2">🎱</span>
            @endif
            
            <h3 class="mb-0 mt-1 text-white font-weight-bold">
                {{ $webSetting->nama_billiard ?? 'Billiard Rental' }}
            </h3>
            <p class="small text-muted mb-0" style="font-size: 11px;">
                {{ $webSetting->alamat ?? 'Alamat Belum Diatur' }}
            </p>
        </a>
    </div>
    <hr class="my-2 border-secondary opacity-25">
    <div class="collapse navbar-collapse" id="sidebar-menu">
        <ul class="navbar-nav pt-lg-3">
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">📊</span>
                    <span class="nav-link-title">Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('transaksi.index') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">🎱</span>
                    <span class="nav-link-title">Billing Transaksi</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pelanggan.index') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">👥</span>
                    <span class="nav-link-title">Data Pelanggan</span>
                </a>
            </li>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <hr class="my-2 border-secondary opacity-25">
                <div class="px-3 mb-2 small text-uppercase text-muted font-weight-bold" style="letter-spacing: 0.5px;">
                    Admin Area
                </div>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('meja.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">🛠️</span>
                        <span class="nav-link-title">Kelola Meja Billiard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('laporan.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">💵</span>
                        <span class="nav-link-title">Laporan Laba/Omzet</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-warning" href="{{ route('activity.log') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">📜</span>
                        <span class="nav-link-title font-weight-bold">Log Aktivitas Kasir</span>
                    </a>
                </li>
            @endif
            
        </ul>
    </div>
  </div>
</aside>
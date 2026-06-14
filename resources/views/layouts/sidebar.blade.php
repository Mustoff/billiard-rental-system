<aside class="navbar navbar-vertical navbar-expand-lg sidebar-sporty text-white">
    <div class="container-fluid">
        
        <div class="navbar-brand text-center py-4 w-100">
            <a href="{{ route('dashboard') }}" class="text-decoration-none d-block">
                @if($webSetting && $webSetting->logo)
                    <img src="{{ asset('storage/' . $webSetting->logo) }}" alt="Logo" class="navbar-brand-image mb-2" style="height: 75px; object-fit: contain; filter: drop-shadow(0px 4px 8px rgba(14, 165, 233, 0.3));">
                @else
                    <div class="avatar avatar-lg rounded-circle mb-2" style="background-color: var(--sporty-cyan); color: white; font-size: 2rem;">🎱</div>
                @endif
                
                <h3 class="mb-0 mt-2 text-white font-weight-bold" style="letter-spacing: 0.5px; font-size: 1.2rem;">
                    {{ $webSetting->nama_billiard ?? 'Billiard Rental' }}
                </h3>
                <p class="mb-0 mt-1 px-2 text-white-50" style="font-size: 11px; line-height: 1.4; opacity: 0.6;">
                    📍 {{ $webSetting->alamat ?? 'Alamat Belum Diatur' }}
                </p>
            </a>
        </div>

        <hr class="my-2 w-100" style="border-color: rgba(255, 255, 255, 0.1);">

        <div class="collapse navbar-collapse w-100" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-2 w-100">
                
                <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('dashboard') }}">
                        <span class="nav-link-icon">📊</span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item {{ Request::is('transaksi*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('transaksi.index') }}">
                        <span class="nav-link-icon">🎱</span>
                        <span class="nav-link-title">Billing Transaksi</span>
                    </a>
                </li>
                
                <li class="nav-item {{ Request::is('pelanggan*') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('pelanggan.index') }}">
                        <span class="nav-link-icon">👥</span>
                        <span class="nav-link-title">Data Pelanggan</span>
                    </a>
                </li>

                @if(auth()->check() && auth()->user()->role === 'admin')
                    <div class="px-3 mt-4 mb-2 small text-uppercase font-weight-bold" style="letter-spacing: 1px; color: var(--sporty-cyan); opacity: 0.8; font-size: 10px;">
                        Admin Systems
                    </div>
                    
                    <li class="nav-item {{ Request::is('meja*') ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center" href="{{ route('meja.index') }}">
                            <span class="nav-link-icon">🛠️</span>
                            <span class="nav-link-title">Kelola Meja Billiard</span>
                        </a>
                    </li>
                    
                    <li class="nav-item {{ Request::is('laporan*') ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center" href="{{ route('laporan.index') }}">
                            <span class="nav-link-icon">💵</span>
                            <span class="nav-link-title">Laporan Laba/Omzet</span>
                        </a>
                    </li>
                    
                    <li class="nav-item {{ Request::is('activity*') ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center" href="{{ route('activity.log') }}">
                            <span class="nav-link-icon">📜</span>
                            <span class="nav-link-title font-weight-bold" style="color: var(--sporty-amber);">Log Aktivitas Kasir</span>
                        </a>
                    </li>
                @endif
                
            </ul>
        </div>

    </div>
</aside>
<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
  <div class="container-xl">
    <div class="navbar-nav flex-row order-md-last">
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          <span class="avatar avatar-sm rounded-circle bg-blue-lt font-weight-bold">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
          </span>
          
          <div class="d-none d-xl-block ps-2 text-start">
            <div class="font-weight-bold text-dark">{{ Auth::user()->name }}</div>
            <div class="mt-1 small text-muted text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">
              {{ Auth::user()->role ?? 'Staff' }}
            </div>
          </div>
        </a>
        
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
  
          @if(Auth::user()->role === 'admin')
            <a href="{{ route('setting.edit') }}" class="dropdown-item">⚙️ Pengaturan Sistem</a>
            <div class="dropdown-divider"></div>
          @endif
          
          <a href="#" class="dropdown-item text-danger" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ❌ Keluar / Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </div>
      </div>
    </div>
    
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div>
        <span class="font-weight-medium text-secondary">
          🎱 Selamat Datang di Sistem Manajemen {{ $webSetting->nama_billiard ?? 'Persewaan Biliar' }}
        </span>
      </div>
    </div>
  </div>
</header>
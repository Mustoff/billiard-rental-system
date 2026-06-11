<x-guest-layout>
    <div class="page page-center py-5" style="background-color: #f4f6fa; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="container container-tight py-4" style="max-width: 450px; width: 100%;">
            
            <div class="text-center mb-4">
                <a href="#" class="navbar-brand navbar-brand-autodark">
                    @if($webSetting && $webSetting->logo)
                        <img src="{{ asset('storage/' . $webSetting->logo) }}" alt="Logo" class="mb-2" style="max-height: 80px; object-fit: contain;">
                    @else
                        <div style="font-size: 3.5rem; line-height: 1;" class="mb-2">🎱</div>
                    @endif
                </a>
                <h2 class="mt-2 font-weight-bold text-dark" style="letter-spacing: -0.5px;">
                    {{ $webSetting->nama_billiard ?? 'Billiard Rental' }}
                </h2>
                <p class="text-muted small px-3">
                    📍 {{ $webSetting->alamat ?? 'Silakan masuk untuk mengelola billing harian.' }}
                </p>
            </div>

            <div class="card card-md shadow-sm border-0" style="border-radius: 12px; overflow: hidden; background: #ffffff;">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 text-center font-weight-bold text-secondary" style="font-size: 1.25rem;">
                        Sistem Informasi Manajemen Billing
                    </h3>

                    <x-auth-session-status class="mb-3 alert alert-info py-2" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" autocomplete="off" id="form-transaksi">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-muted small text-uppercase">Alamat Email</label>
                            <input type="email" name="email" id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="masukan@email.com" 
                                   value="{{ old('email') }}" 
                                   required autofocus autocomplete="username"
                                   style="padding: 10px 12px; border-radius: 6px;">
                            
                            @error('email')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-muted small text-uppercase">
                                Password
                            </label>
                            <input type="password" name="password" id="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="••••••••" 
                                   required autocomplete="current-password"
                                   style="padding: 10px 12px; border-radius: 6px;">
                            
                            @error('password')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 d-flex align-items-center justify-content-between">
                            <label class="form-check mb-0">
                                <input type="checkbox" name="remember" id="remember_me" class="form-check-input rounded border-gray-300">
                                <span class="form-check-label text-muted small">Ingat saya di perangkat ini</span>
                            </label>
                            
                            @if (Route::has('password.request'))
                                <a class="small text-primary text-decoration-none" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <div class="form-footer">
                            <button type="submit" id="btn-simpan" class="btn btn-primary w-full py-2 font-weight-bold" 
                                    style="background: linear-gradient(135deg, #206bc4 0%, #1a569d 100%); border: none; border-radius: 6px; font-size: 1rem;">
                                <span id="btn-text">🔐 Masuk ke Sistem</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center text-muted small mt-4">
                &copy; {{ date('Y') }} {{ $webSetting->nama_billiard ?? 'Billiard Rental' }}. All Rights Reserved.
            </div>

        </div>
    </div>

    <script>
        const form = document.getElementById('form-transaksi');
        const btnSimpan = document.getElementById('btn-simpan');
        const btnText = document.getElementById('btn-text');

        if(form && btnSimpan && btnText) {
            form.addEventListener('submit', function () {
                btnSimpan.disabled = true;
                btnSimpan.classList.add('disabled');
                btnText.innerHTML = '⏳ Menghubungkan ke Server...';
            });
        }
    </script>
</x-guest-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Billiard Rental System') }}</title>

        @fonts

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            :root {
                --navy:       #0f172a;
                --navy-mid:   #1e293b;
                --navy-light: #334155;
                --cyan:       #0ea5e9;
                --cyan-light: #38bdf8;
                --cyan-dim:   rgba(14,165,233,0.12);
                --amber:      #f59e0b;
                --amber-light:#fbbf24;
                --amber-dim:  rgba(245,158,11,0.12);
                --white:      #ffffff;
                --gray-100:   #f1f5f9;
                --gray-200:   #e2e8f0;
                --gray-400:   #94a3b8;
                --gray-500:   #64748b;
                --green:      #10b981;
            }

            html, body {
                min-height: 100vh;
                font-family: 'Inter', ui-sans-serif, system-serif, sans-serif;
                background: var(--navy);
                color: var(--white);
                -webkit-font-smoothing: antialiased;
            }

            /* ── ACCENT TOP BAR ── */
            .top-accent {
                position: fixed;
                top: 0; left: 0; right: 0;
                height: 3px;
                background: linear-gradient(90deg, var(--cyan) 0%, var(--amber) 100%);
                z-index: 999;
            }

            /* ── BACKGROUND DECORATION ── */
            .bg-deco {
                position: fixed;
                inset: 0;
                pointer-events: none;
                overflow: hidden;
                z-index: 0;
            }
            .bg-circle {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                opacity: 0.18;
            }
            .bg-circle-1 {
                width: 600px; height: 600px;
                background: var(--cyan);
                top: -200px; right: -100px;
            }
            .bg-circle-2 {
                width: 400px; height: 400px;
                background: var(--amber);
                bottom: -100px; left: -80px;
            }
            .bg-grid {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(14,165,233,0.04) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(14,165,233,0.04) 1px, transparent 1px);
                background-size: 40px 40px;
            }

            /* ── PAGE WRAPPER ── */
            .page {
                position: relative;
                z-index: 1;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            /* ── HEADER ── */
            .header {
                padding: 20px 40px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid rgba(255,255,255,0.06);
                backdrop-filter: blur(8px);
                background: rgba(15,23,42,0.6);
                position: sticky;
                top: 3px;
                z-index: 50;
            }
            .logo-wrap {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .logo-icon {
                width: 38px; height: 38px;
                background: var(--cyan);
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                font-size: 20px;
                flex-shrink: 0;
            }
            .logo-text {
                font-family: 'Rajdhani', sans-serif;
                font-size: 20px;
                font-weight: 700;
                color: var(--white);
                letter-spacing: 0.5px;
                line-height: 1.1;
            }
            .logo-sub {
                font-size: 9px;
                font-weight: 600;
                color: var(--cyan);
                letter-spacing: 2px;
                text-transform: uppercase;
            }
            .nav-links {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .nav-btn {
                display: inline-flex;
                align-items: center;
                padding: 8px 18px;
                border-radius: 9px;
                font-size: 13.5px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.15s;
                letter-spacing: 0.2px;
            }
            .nav-btn-ghost {
                color: var(--gray-400);
                background: transparent;
                border: 1.5px solid transparent;
            }
            .nav-btn-ghost:hover {
                color: var(--white);
                border-color: rgba(255,255,255,0.15);
                background: rgba(255,255,255,0.05);
            }
            .nav-btn-outline {
                color: var(--cyan);
                border: 1.5px solid rgba(14,165,233,0.4);
                background: var(--cyan-dim);
            }
            .nav-btn-outline:hover {
                background: rgba(14,165,233,0.2);
                border-color: var(--cyan);
                color: var(--white);
            }
            .nav-btn-solid {
                color: var(--navy);
                background: var(--cyan);
                border: 1.5px solid var(--cyan);
            }
            .nav-btn-solid:hover {
                background: var(--cyan-light);
                border-color: var(--cyan-light);
            }

            /* ── HERO ── */
            .hero {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 80px 40px 60px;
                text-align: center;
            }
            .hero-inner {
                max-width: 680px;
            }
            .hero-eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: var(--cyan-dim);
                border: 1px solid rgba(14,165,233,0.3);
                border-radius: 20px;
                padding: 5px 14px;
                font-size: 11.5px;
                font-weight: 700;
                color: var(--cyan);
                letter-spacing: 1.5px;
                text-transform: uppercase;
                margin-bottom: 24px;
            }
            .hero-eyebrow-dot {
                width: 6px; height: 6px;
                border-radius: 50%;
                background: var(--cyan);
                animation: blink 1.4s ease-in-out infinite;
            }
            @keyframes blink {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.3; }
            }
            .hero-title {
                font-family: 'Rajdhani', sans-serif;
                font-size: clamp(42px, 8vw, 72px);
                font-weight: 700;
                line-height: 1;
                color: var(--white);
                letter-spacing: -0.5px;
                margin-bottom: 8px;
            }
            .hero-title-accent {
                color: var(--cyan);
                display: block;
            }
            .hero-title-sub {
                color: var(--amber);
            }
            .hero-desc {
                font-size: 16px;
                line-height: 1.7;
                color: var(--gray-400);
                max-width: 480px;
                margin: 20px auto 36px;
            }
            .hero-cta {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                flex-wrap: wrap;
            }
            .cta-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 13px 28px;
                border-radius: 12px;
                font-size: 14px;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.15s;
                letter-spacing: 0.3px;
            }
            .cta-primary {
                background: var(--cyan);
                color: var(--navy);
                box-shadow: 0 0 0 0 rgba(14,165,233,0.4);
            }
            .cta-primary:hover {
                background: var(--cyan-light);
                transform: translateY(-1px);
                box-shadow: 0 8px 24px rgba(14,165,233,0.3);
            }
            .cta-secondary {
                background: rgba(255,255,255,0.07);
                color: var(--white);
                border: 1.5px solid rgba(255,255,255,0.15);
            }
            .cta-secondary:hover {
                background: rgba(255,255,255,0.12);
                border-color: rgba(255,255,255,0.3);
            }

            /* ── STATS ROW ── */
            .stats-row {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0;
                margin-top: 48px;
                border-top: 1px solid rgba(255,255,255,0.07);
                padding-top: 32px;
            }
            .stat-item {
                flex: 1;
                text-align: center;
                padding: 0 28px;
                border-right: 1px solid rgba(255,255,255,0.07);
                max-width: 180px;
            }
            .stat-item:last-child { border-right: none; }
            .stat-num {
                font-family: 'Rajdhani', sans-serif;
                font-size: 32px;
                font-weight: 700;
                line-height: 1;
                margin-bottom: 4px;
            }
            .stat-num.cyan { color: var(--cyan); }
            .stat-num.amber { color: var(--amber); }
            .stat-num.green { color: var(--green); }
            .stat-lbl {
                font-size: 11px;
                color: var(--gray-500);
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.8px;
            }

            /* ── FEATURES ── */
            .features {
                padding: 0 40px 60px;
                display: flex;
                justify-content: center;
            }
            .features-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 14px;
                max-width: 860px;
                width: 100%;
            }
            .feat-card {
                background: rgba(255,255,255,0.04);
                border: 1px solid rgba(255,255,255,0.08);
                border-radius: 14px;
                padding: 20px;
                transition: border-color 0.2s, background 0.2s, transform 0.15s;
            }
            .feat-card:hover {
                border-color: rgba(14,165,233,0.35);
                background: rgba(14,165,233,0.06);
                transform: translateY(-2px);
            }
            .feat-icon {
                width: 38px; height: 38px;
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                font-size: 18px;
                margin-bottom: 12px;
            }
            .feat-icon.cyan { background: var(--cyan-dim); }
            .feat-icon.amber { background: var(--amber-dim); }
            .feat-icon.green { background: rgba(16,185,129,0.12); }
            .feat-title {
                font-size: 14px;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 5px;
                font-family: 'Rajdhani', sans-serif;
                letter-spacing: 0.3px;
            }
            .feat-desc {
                font-size: 12.5px;
                color: var(--gray-500);
                line-height: 1.6;
            }

            /* ── FOOTER ── */
            .footer {
                border-top: 1px solid rgba(255,255,255,0.06);
                padding: 16px 40px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: rgba(15,23,42,0.4);
            }
            .footer-left {
                font-size: 12px;
                color: var(--gray-500);
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .footer-ver {
                background: rgba(255,255,255,0.06);
                border: 1px solid rgba(255,255,255,0.1);
                border-radius: 6px;
                padding: 2px 8px;
                font-size: 11px;
                font-weight: 600;
                color: var(--gray-400);
                font-family: ui-monospace, monospace;
            }
            .footer-right {
                font-size: 12px;
                color: var(--gray-500);
            }
            .footer-link {
                color: var(--cyan);
                text-decoration: none;
                font-weight: 600;
            }
            .footer-link:hover { text-decoration: underline; }

            /* ── RESPONSIVE ── */
            @media (max-width: 640px) {
                .header { padding: 14px 20px; }
                .hero { padding: 48px 24px 40px; }
                .features { padding: 0 24px 40px; }
                .features-grid { grid-template-columns: 1fr; }
                .stats-row { gap: 0; flex-wrap: wrap; }
                .stat-item { max-width: 50%; border-right: none; padding: 12px 0; }
                .footer { padding: 14px 20px; flex-direction: column; gap: 8px; text-align: center; }
            }
        </style>
    </head>

    <body>
        <div class="top-accent"></div>

        <!-- Background decoration -->
        <div class="bg-deco" aria-hidden="true">
            <div class="bg-grid"></div>
            <div class="bg-circle bg-circle-1"></div>
            <div class="bg-circle bg-circle-2"></div>
        </div>

        <div class="page">

            <!-- HEADER -->
            <header class="header">
                <div class="logo-wrap">
                    <div class="logo-icon" aria-hidden="true">🎱</div>
                    <div>
                        <div class="logo-text">{{ config('app.name', 'Billiard Pro') }}</div>
                        <div class="logo-sub">Rental System</div>
                    </div>
                </div>

                @if (Route::has('login'))
                    <nav class="nav-links">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-btn nav-btn-solid">
                                Go to Dashboard →
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="nav-btn nav-btn-ghost">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-btn nav-btn-outline">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <!-- HERO -->
            <main class="hero">
                <div class="hero-inner">
                    <div class="hero-eyebrow">
                        <span class="hero-eyebrow-dot"></span>
                        Management System
                    </div>

                    <h1 class="hero-title">
                        <span class="hero-title-accent">Billiard</span>
                        <span class="hero-title-sub">Rental</span>
                        Pro
                    </h1>

                    <p class="hero-desc">
                        Kelola meja, sesi, dan pendapatan billiard Anda dengan cepat dan akurat.
                        Sistem kasir modern yang intuitif untuk operasional yang lebih efisien.
                    </p>

                    <div class="hero-cta">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="cta-btn cta-primary">
                                🚀 Buka Dashboard
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="cta-btn cta-primary">
                                    🚀 Mulai Sekarang
                                </a>
                            @endif
                            <a href="{{ route('login') }}" class="cta-btn cta-secondary">
                                🔐 Masuk ke Sistem
                            </a>
                        @endauth
                    </div>

                    <!-- STATS -->
                    <div class="stats-row">
                        <div class="stat-item">
                            <div class="stat-num cyan">8</div>
                            <div class="stat-lbl">Total Meja</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num amber">24/7</div>
                            <div class="stat-lbl">Operasional</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num green">Real-time</div>
                            <div class="stat-lbl">Live Monitoring</div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- FEATURES -->
            <section class="features" aria-label="Fitur sistem">
                <div class="features-grid">
                    <div class="feat-card">
                        <div class="feat-icon cyan">⏱️</div>
                        <div class="feat-title">Sesi Real-Time</div>
                        <div class="feat-desc">Timer otomatis dan kalkulasi biaya langsung saat sesi berjalan.</div>
                    </div>
                    <div class="feat-card">
                        <div class="feat-icon amber">📅</div>
                        <div class="feat-title">Reservasi Meja</div>
                        <div class="feat-desc">Kelola reservasi dan jadwal meja agar tidak terjadi konflik booking.</div>
                    </div>
                    <div class="feat-card">
                        <div class="feat-icon green">📊</div>
                        <div class="feat-title">Laporan Pendapatan</div>
                        <div class="feat-desc">Laporan harian, mingguan, dan bulanan otomatis untuk analisis bisnis.</div>
                    </div>
                </div>
            </section>

            <!-- FOOTER -->
            <footer class="footer">
                <div class="footer-left">
                    <span>Laravel</span>
                    <span class="footer-ver">v{{ app()->version() }}</span>
                    <span>·</span>
                    <span>{{ config('app.name', 'Billiard Rental System') }}</span>
                </div>
                <div class="footer-right">
                    Built with ❤️ using
                    <a href="https://laravel.com" target="_blank" class="footer-link">Laravel</a>
                </div>
            </footer>

        </div>
    </body>
</html>
@extends('layouts.app')

@section('content')
<style>
    .card-meja {
        border: none !important;
        border-radius: 16px !important;
        transition: all 0.25s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    }
    .card-meja:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
    .status-tersedia {
        background-color: #ffffff !important;
        border-left: 5px solid var(--sporty-cyan) !important;
    }
    .status-terpakai {
        background-color: #ffffff !important;
        border-left: 5px solid var(--sporty-amber) !important;
    }
    .status-maintenance {
        background-color: #f8f9fa !important;
        border-left: 5px solid #6c757d !important;
        opacity: 0.8;
    }
    .indikator-kosong {
        width: 10px; height: 10px; background-color: var(--sporty-cyan);
        border-radius: 50%; display: inline-block; margin-right: 8px;
        box-shadow: 0 0 8px var(--sporty-cyan);
    }
    .indikator-jalan {
        width: 10px; height: 10px; background-color: var(--sporty-amber);
        border-radius: 50%; display: inline-block; margin-right: 8px;
        box-shadow: 0 0 8px var(--sporty-amber);
        animation: pulseBilling 1.8s infinite;
    }
    @keyframes pulseBilling {
        0% { opacity: 0.4; }
        50% { opacity: 1; }
        100% { opacity: 0.4; }
    }
</style>

<div class="container-xl mt-4">
    
    <div class="mb-4">
        <h2 class="page-title text-dark font-weight-bold" style="letter-spacing: -0.5px;">📊 Dashboard Real-Time</h2>
        <p class="text-muted small">Status operasional meja biliar dan ringkasan transaksi hari ini.</p>
    </div>

    <div class="row row-cards mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm border-0 shadow-sm" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; border-radius: 16px;">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="h1 mb-0 font-weight-bold me-3" style="color: var(--sporty-cyan); font-size: 2rem;">{{ $totalMejaKosong }}</div>
                    <div>
                        <div class="font-weight-bold small">Meja Kosong</div>
                        <div class="text-white-50" style="font-size: 11px;">Siap diisi pelanggan</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm border-0 shadow-sm" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; border-radius: 16px;">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="h1 mb-0 font-weight-bold me-3" style="color: var(--sporty-amber); font-size: 2rem;">{{ $totalMejaDipakai }}</div>
                    <div>
                        <div class="font-weight-bold small">Sedang Dipakai</div>
                        <div class="text-white-50" style="font-size: 11px;">Billing sedang jalan</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm border-0 shadow-sm" style="background-color: white; border-radius: 16px;">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="h1 mb-0 font-weight-bold me-3 text-dark" style="font-size: 2rem;">{{ $totalPelanggan }}</div>
                    <div>
                        <div class="font-weight-bold text-dark small">Total Pelanggan</div>
                        <div class="text-muted" style="font-size: 11px;">Member terdaftar</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm border-0 shadow-sm" style="background-color: white; border-radius: 16px;">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="h1 mb-0 font-weight-bold me-3 text-dark" style="font-size: 1.6rem;"><span class="text-muted font-weight-medium" style="font-size: 13px;">Rp</span> {{ number_format($omzetHariIni, 0, ',', '.') }}</div>
                    <div>
                        <div class="font-weight-bold text-dark small">Omzet Hari Ini</div>
                        <div class="text-muted" style="font-size: 11px;">Pendapatan kas masuk</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header bg-white py-3 border-bottom">
            <h3 class="card-title font-weight-bold mb-0 text-dark">🎱 Status Denah Meja Biliar</h3>
        </div>
        <div class="card-body py-4 bg-light">
            <div class="row row-cards">
                @foreach($daftarMeja as $meja)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                        
                        <div class="card card-meja {{ $meja->status === 'kosong' ? 'status-tersedia' : ($meja->status === 'dipakai' ? 'status-terpakai' : 'status-maintenance') }}">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    @if($meja->status === 'kosong')
                                        <span class="indikator-kosong"></span>
                                        <span class="fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">Tersedia</span>
                                    @elseif($meja->status === 'dipakai')
                                        <span class="indikator-jalan"></span>
                                        <span class="fw-bold text-warning text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">Main</span>
                                    @else
                                        <span class="avatar avatar-xs rounded-circle bg-secondary me-2" style="width: 8px; height: 8px;"></span>
                                        <span class="fw-bold text-secondary text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">OFF / REPAIR</span>
                                    @endif
                                </div>

                                <h2 class="mb-1 fw-bold text-dark display-6" style="font-size: 1.8rem;">{{ $meja->nomor_meja }}</h2>
                                
                                <div class="mt-2 text-dark mb-3">
                                    <div class="font-weight-bold" style="font-size: 13px;">Rp {{ number_format($meja->harga_per_jam, 0, ',', '.') }}<span class="small font-weight-normal text-muted">/jam</span></div>
                                </div>
                                
                                @if($meja->status === 'kosong')
                                    <a href="{{ route('transaksi.create') }}?meja={{ $meja->id }}" class="btn w-100 fw-bold text-white shadow-sm" style="background-color: var(--sporty-cyan); border-radius: 8px; font-size: 13px;">
                                        Mulai Main
                                    </a>
                                @elseif($meja->status === 'dipakai')
                                    <a href="{{ route('transaksi.index') }}" class="btn w-100 fw-bold btn-outline-warning" style="border-radius: 8px; font-size: 13px;">
                                        ⚡ Cek Billing
                                    </a>
                                @else
                                    <button class="btn w-100 fw-bold btn-secondary" disabled style="border-radius: 8px; font-size: 13px;">🛠️ Diperbaiki</button>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
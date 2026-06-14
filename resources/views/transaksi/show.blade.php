@extends('layouts.app')
@section('content')
<div class="container-xl mt-4">
    <div class="mb-4 d-print-none">
        <h2 class="page-title text-dark font-weight-bold">📄 Detail Billing #TRX-{{ $transaksi->id }}</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px; overflow: hidden;">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-1" style="color: var(--sporty-navy);">{{ $webSetting->nama_billiard ?? 'Billiard Rental' }}</h2>
                        <p class="text-muted small mb-0">📍 {{ $webSetting->alamat ?? 'Alamat' }}</p>
                        <p class="text-muted small">📞 {{ $webSetting->no_hp ?? '-' }}</p>
                        <div style="border-top: 2px dashed #e2e8f0;" class="my-3"></div>
                    </div>

                    <div class="row mb-3 small">
                        <div class="col-6 text-muted">Pelanggan:</div>
                        <div class="col-6 text-end fw-bold text-dark">{{ $transaksi->pelanggan->nama }}</div>
                    </div>
                    <div class="row mb-3 small">
                        <div class="col-6 text-muted">Meja Biliar:</div>
                        <div class="col-6 text-end fw-bold text-info fs-3">🎱 {{ $transaksi->meja->nomor_meja }}</div>
                    </div>
                    <div class="row mb-3 small">
                        <div class="col-6 text-muted">Waktu Main:</div>
                        <div class="col-6 text-end text-dark">
                            {{ \Carbon\Carbon::parse($transaksi->jam_mulai)->format('H:i') }} - 
                            {{ \Carbon\Carbon::parse($transaksi->jam_selesai)->format('H:i') }} WIB
                        </div>
                    </div>
                    <div class="row mb-3 small">
                        <div class="col-6 text-muted">Durasi Paket:</div>
                        <div class="col-6 text-end fw-bold text-dark">{{ $transaksi->durasi_menit }} Menit</div>
                    </div>

                    <div style="border-top: 2px dashed #e2e8f0;" class="my-3"></div>

                    <div class="d-flex justify-content-between align-items-center py-2">
                        <span class="fw-bold text-uppercase" style="letter-spacing: 0.5px;">Total Bayar (Lunas)</span>
                        <h2 class="fw-bold mb-0" style="color: var(--sporty-amber);">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</h2>
                    </div>

                    <div style="border-top: 2px dashed #e2e8f0;" class="my-3"></div>
                    
                    <div class="text-center mt-4 text-muted small">
                        <p class="mb-0">✨ Terima Kasih Atas Kunjungan Anda ✨</p>
                        <p style="font-size: 10px;">Powered by Umar Explains Billing System</p>
                    </div>

                </div>
                
                <div class="card-footer bg-light text-center d-print-none py-3">
                    <button onclick="window.print();" class="btn btn-dark fw-bold px-4" style="border-radius: 8px;">
                        🖨️ Cetak Struk Nota
                    </button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary ms-2" style="border-radius: 8px;">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
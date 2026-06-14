@extends('layouts.app')

@section('content')
<div class="container-xl mt-4">
    
    <div class="page-header mb-4 d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle text-uppercase font-weight-bold tracking-wider text-muted" style="font-size: 10px;">Modul Finansial</div>
                <h2 class="page-title text-dark font-weight-bold">Laporan Pendapatan Billing</h2>
                <p class="text-muted small mb-0">Pantau omzet real-time, cetak pembukuan kasir, dan filter performa rental.</p>
            </div>
            <div class="col-auto ms-auto">
                <button onclick="window.print()" class="btn btn-dark fw-bold d-flex align-items-center px-3" style="gap: 8px; border-radius: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a1 1 0 0 0 1 -1v-4a1 1 0 0 0 -1 -1h-14a1 1 0 0 0 -1 1v4a1 1 0 0 0 1 1h2" /><path d="M17 9v-4a1 1 0 0 0 -1 -1h-8a1 1 0 0 0 -1 1v4" /><rect x="7" y="13" width="10" height="8" rx="1" /></svg>
                    Cetak Laporan
                </button>
            </div>
        </div>
    </div>

    <div class="card card-sm mb-4 border-0 shadow-sm text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 16px;">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-uppercase font-weight-bold tracking-wider opacity-75 small" style="font-size: 11px; letter-spacing: 1px;">💰 Total Pendapatan (Sesuai Filter)</div>
                    <div class="h1 font-weight-black mb-0 mt-1" style="font-size: 2.3rem; color: var(--sporty-amber); letter-spacing: -0.5px;">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-auto">
                    <span class="avatar avatar-lg rounded bg-dark-lt text-white font-weight-bold fs-2" style="border: 1px solid rgba(255,255,255,0.15);">
                        📈
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 d-print-none shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body p-4">
            <form action="{{ route('laporan.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small font-weight-bold text-dark">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ $tanggalMulai }}" style="border-radius: 8px;">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small font-weight-bold text-dark">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ $tanggalSelesai }}" style="border-radius: 8px;">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small font-weight-bold text-dark">Cari Pelanggan / Meja</label>
                        <input type="text" name="keyword" class="form-control" placeholder="Masukkan nama atau nomor meja..." value="{{ $keyword }}" style="border-radius: 8px;">
                    </div>
                    <div class="col-md-2 d-flex align-items-end" style="gap: 6px;">
                        <button type="submit" class="btn text-white fw-bold w-100" style="background-color: var(--sporty-cyan); border-radius: 8px;">Filter</button>
                        <a href="{{ route('laporan.index') }}" class="btn btn-light fw-bold" title="Reset Filter" style="border-radius: 8px;">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
        <div class="card-header bg-light py-3">
            <h3 class="card-title font-weight-bold text-dark mb-0">Rincian Transaksi Selesai</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap mb-0">
                <thead class="bg-light text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                    <tr>
                        <th class="w-1 py-3 text-dark font-weight-bold">No</th>
                        <th class="py-3 text-dark font-weight-bold">Tanggal & Jam Selesai</th>
                        <th class="py-3 text-dark font-weight-bold">Meja</th>
                        <th class="py-3 text-dark font-weight-bold">Nama Pelanggan</th>
                        <th class="py-3 text-dark font-weight-bold">Durasi Sewa</th>
                        <th class="text-end py-3 text-dark font-weight-bold">Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporanTransaksi as $key => $l)
                        <tr>
                            <td class="py-3"><span class="text-muted small">{{ $laporanTransaksi->firstItem() + $key }}</span></td>
                            <td class="py-3 text-secondary" style="font-size: 13px;">{{ \Carbon\Carbon::parse($l->jam_selesai)->format('d M Y, H:i') }} WIB</td>
                            <td class="py-3"><span class="badge bg-blue-lt text-blue font-weight-bold px-2 py-1">{{ $l->meja->nomor_meja }}</span></td>
                            <td class="py-3 text-dark font-weight-bold">{{ $l->pelanggan->nama }}</td>
                            <td class="py-3 text-secondary font-weight-medium">{{ $l->durasi_menit }} Menit</td>
                            <td class="text-end py-3 font-weight-black" style="color: var(--sporty-cyan); font-size: 15px;">
                                Rp {{ number_format($l->total_bayar, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="fs-1 mb-2">🍃</div>
                                <div>Tidak ada data transaksi selesai yang memenuhi kriteria filter.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($laporanTransaksi->hasPages())
            <div class="card-footer d-flex align-items-center d-print-none bg-white border-top py-3">
                <div class="text-muted small">
                    Menampilkan <strong>{{ $laporanTransaksi->firstItem() }}</strong> - <strong>{{ $laporanTransaksi->lastItem() }}</strong> dari <strong>{{ $laporanTransaksi->total() }}</strong> baris laporan
                </div>
                <div class="ms-auto">
                    {{ $laporanTransaksi->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
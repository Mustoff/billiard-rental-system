@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            
            <div class="page-header mb-4 d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Modul Finansial</div>
                        <h2 class="page-title">Laporan Pendapatan Billing</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <button onclick="window.print()" class="btn btn-primary d-flex align-items-center" style="gap: 4px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a1 1 0 0 0 1 -1v-4a1 1 0 0 0 -1 -1h-14a1 1 0 0 0 -1 1v4a1 1 0 0 0 1 1h2" /><path d="M17 9v-4a1 1 0 0 0 -1 -1h-8a1 1 0 0 0 -1 1v4" /><rect x="7" y="13" width="10" height="8" rx="1" /></svg>
                            Print Laporan
                        </button>
                    </div>
                </div>
            </div>

            <div class="card card-sm mb-4 border-0 shadow-sm bg-success text-white">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-uppercase font-weight-bold tracking-wider opacity-75 small">Total Pendapatan (Sesuai Filter)</div>
                            <div class="h1 font-weight-black mb-0 mt-1" style="font-size: 2rem;">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <span class="avatar avatar-lg bg-white-lt text-white font-weight-bold" style="font-size: 1.5rem;">
                                Rp
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 d-print-none shadow-sm">
                <div class="card-body">
                    <form action="{{ route('laporan.index') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small font-weight-bold text-secondary">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" value="{{ $tanggalMulai }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small font-weight-bold text-secondary">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control" value="{{ $tanggalSelesai }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small font-weight-bold text-secondary">Cari Pelanggan / Meja</label>
                                <input type="text" name="keyword" class="form-control" placeholder="Masukkan nama atau nomor meja..." value="{{ $keyword }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end" style="gap: 8px;">
                                <button type="submit" class="btn btn-primary w-100 font-weight-bold">Filter</button>
                                <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h3 class="card-title font-weight-bold">Rincian Transaksi Selesai</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th class="w-1">No</th>
                                <th>Tanggal & Jam Selesai</th>
                                <th>Meja</th>
                                <th>Nama Pelanggan</th>
                                <th>Durasi Sewa</th>
                                <th class="text-end">Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporanTransaksi as $key => $l)
                                <tr>
                                    <td><span class="text-muted">{{ $laporanTransaksi->firstItem() + $key }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($l->jam_selesai)->format('d M Y, H:i') }} WIB</td>
                                    <td><strong class="text-primary">{{ $l->meja->nomor_meja }}</strong></td>
                                    <td><strong>{{ $l->pelanggan->nama }}</strong></td>
                                    <td>{{ $l->durasi_menit }} Menit</td>
                                    <td class="text-end font-weight-bold text-success">
                                        Rp {{ number_format($l->total_bayar, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Tidak ada data transaksi selesai yang memenuhi kriteria filter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($laporanTransaksi->hasPages())
                    <div class="card-footer d-flex align-items-center d-print-none bg-light border-top-0">
                        <div class="ms-auto">
                            {{ $laporanTransaksi->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
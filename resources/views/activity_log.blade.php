@extends('layouts.app') @section('content')
<div class="container-xl mt-4">
    <div class="page-header d-print-none mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title text-dark">
                    📜 Log Aktivitas Kasir (CCTV Sistem)
                </h2>
                <p class="text-muted small">Memantau seluruh jejak digital, pembukaan meja, dan manipulasi transaksi secara Real-Time.</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 15%">Waktu</th>
                        <th style="width: 15%">Nama Kasir</th>
                        <th style="width: 15%">Aktivitas</th>
                        <th>Detail Deskripsi</th>
                        <th style="width: 15%">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $key => $log)
                        <tr>
                            <td>{{ $logs->firstItem() + $key }}</td>
                            <td class="text-secondary small">
                                {{ $log->created_at->format('d M Y, H:i') }} WIB
                            </td>
                            <td>
                                <span class="badge bg-blue-lite text-blue font-weight-bold">
                                    {{ $log->user->name ?? 'Sistem / Guest' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $log->aktivitas == 'Buka Meja' ? 'bg-success' : 'bg-warning' }} text-white">
                                    {{ $log->aktivitas }}
                                </span>
                            </td>
                            <td class="text-muted text-wrap">
                                {{ $log->deskripsi }}
                            </td>
                            <td class="text-monospace text-muted small">
                                <code>{{ $log->ip_address }}</code>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                📭 Belum ada rekaman aktivitas kasir hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($logs->hasPages())
            <div class="card-footer d-flex align-items-center justify-content-end bg-transparent border-top-0">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
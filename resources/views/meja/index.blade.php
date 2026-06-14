@extends('layouts.app')

@section('content')
<div class="container-xl mt-4">
    <div class="page-header d-print-none mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title text-dark font-weight-bold">Manajemen Meja Biliar</h2>
                <p class="text-muted small mb-0">Kelola ketersediaan, tarif, jenis, dan hapus master meja biliar.</p>
            </div>
            <div class="col-auto ms-auto">
                <a href="{{ route('meja.create') }}" class="btn fw-bold px-3 text-white" style="background-color: var(--sporty-cyan); border-radius: 8px;">
                    ➕ Tambah Meja Baru
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable mb-0">
                <thead class="bg-light text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                    <tr>
                        <th class="py-3 text-dark font-weight-bold">No. Meja</th>
                        <th class="py-3 text-dark font-weight-bold">Jenis Meja</th>
                        <th class="py-3 text-dark font-weight-bold">Harga / Jam</th>
                        <th class="py-3 text-dark font-weight-bold">Status</th>
                        <th class="py-3 text-dark font-weight-bold text-center" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($meja as $m)
                        <tr>
                            <td class="py-3">
                                <strong>{{ $m->nomor_meja }}</strong>
                            </td>
                            <td class="py-3 text-secondary font-weight-medium">
                                {{ $m->jenis_meja }}
                            </td>
                            <td class="py-3 text-dark font-weight-bold">
                                Rp {{ number_format($m->harga_per_jam, 0, ',', '.') }}<span class="text-muted font-weight-normal" style="font-size: 11px;">/jam</span>
                            </td>
                            <td class="py-3">
                                @if($m->status == 'kosong')
                                    <span class="badge bg-cyan-lt text-cyan rounded-pill px-3 py-1 font-weight-bold">🟢 TERSEDIA</span>
                                @elseif($m->status == 'dipakai')
                                    <span class="badge bg-warning-lt text-warning rounded-pill px-3 py-1 font-weight-bold">🔴 SEDANG MAIN</span>
                                @else
                                    <span class="badge bg-secondary-lt text-secondary rounded-pill px-3 py-1 font-weight-bold">🛠️ MAINTENANCE</span>
                                @endif
                            </td>
                            <td class="py-3">
                                <form action="{{ route('meja.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus meja ini?')" class="d-flex justify-content-center" style="gap: 6px;">
                                    <a href="{{ route('meja.edit', $m->id) }}" class="btn btn-sm btn-light fw-bold px-3" style="border-radius: 6px;">
                                        Edit
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger fw-bold px-2" style="border-radius: 6px;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <div class="fs-2 mb-2">📥</div>
                                <div>Belum ada data meja biliar yang terdaftar. Silakan tambah baru!</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> 
        
        @if(method_exists($meja, 'hasPages') && $meja->hasPages())
            <div class="card-footer d-flex align-items-center bg-white border-top py-3">
                <div class="text-muted small">
                    Menampilkan <strong>{{ $meja->firstItem() }}</strong> sampai <strong>{{ $meja->lastItem() }}</strong> dari <strong>{{ $meja->total() }}</strong> data meja
                </div>
                <div class="ms-auto">
                    {{ $meja->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
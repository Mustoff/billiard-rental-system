@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="page-header d-print-none mb-3">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">Modul Admin</div>
                <h2 class="page-title">Manajemen Data Pelanggan</h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="{{ route('pelanggan.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5v14" /><path d="M5 12h14" /></svg>
                    Tambah Pelanggan
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('pelanggan.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan nama atau nomor HP..." value="{{ request('keyword') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary d-flex align-items-center" style="gap: 4px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                            <span>Cari</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th class="w-1 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $key => $p)
                        <tr>
                            <td><span class="text-secondary">{{ $pelanggans->firstItem() + $key }}</span></td>
                            <td><strong class="text-dark">{{ $p->nama }}</strong></td>
                            <td>
                                @if($p->nomor_hp)
                                    <span class="text-monospace">{{ $p->nomor_hp }}</span>
                                @else
                                    <span class="text-muted italic">-</span>
                                @endif
                            </td>
                            <td class="text-wrap" style="max-width: 300px;">
                                {{ $p->alamat ?? '-' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-list flex-nowrap justify-content-center">
                                    <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-sm btn-yellow text-white">
                                        Edit
                                    </a>
                                    <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-off mb-2 text-secondary" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.983 8.978c3.955 -.182 7.017 -1.446 7.017 -2.978c0 -1.657 -3.582 -3 -8 -3c-1.661 0 -3.204 .19 -4.454 .515m-2.837 1.186c-.458 .38 -.709 .832 -.709 1.3c0 1.657 3.582 3 8 3" /><path d="M4 6v6c0 1.657 3.582 3 8 3c1.119 0 2.19 -.093 3.16 -.263m3.84 -1.186c.64 -.411 1 -.905 1 -1.551v-6" /><path d="M4 12v6c0 1.657 3.582 3 8 3c3.23 0 6.014 -.715 7.257 -1.713m.743 -3.287v-1" /><path d="M3 3l18 18" /></svg>
                                <div>Data pelanggan tidak ditemukan atau masih kosong.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($pelanggans->hasPages())
            <div class="card-footer d-flex align-items-center border-top-0">
                <p class="m-0 text-secondary">
                    Menampilkan <span>{{ $pelanggans->firstItem() }}</span> hingga <span>{{ $pelanggans->lastItem() }}</span> dari <span>{{ $pelanggans->total() }}</span> entri
                </p>
                <div class="ms-auto">
                    {{ $pelanggans->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
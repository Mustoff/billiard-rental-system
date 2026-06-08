@extends('layouts.app')

@section('content')
<div class="page-header d-print-none mb-3">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">Manajemen Meja Biliar</h2>
        </div>
        <div class="col-auto ms-auto">
            <a href="{{ route('meja.create') }}" class="btn btn-primary">
                + Tambah Meja Baru
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>No. Meja</th>
                    <th>Jenis Meja</th>
                    <th>Harga / Jam</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
           <tbody>
                @forelse ($mejas as $m)
                    <tr>
                        <td>{{ $m->nomor_meja }}</td>
                        <td>{{ $m->jenis_meja }}</td>
                        <td>Rp {{ number_format($m->harga_per_jam, 0, ',', '.') }}</td>
                        <td>
                            @if($m->status == 'kosong')
                                <span class="badge bg-success text-white">Kosong</span>
                            @elseif($m->status == 'dipakai')
                                <span class="badge bg-danger text-white">Dipakai</span>
                            @else
                                <span class="badge bg-warning text-white">Maintenance</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('meja.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus meja ini?')">
                                <a href="{{ route('meja.edit', $m->id) }}" class="btn btn-sm btn-yellow text-white">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-secondary">Belum ada data meja. Silakan tambah baru!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
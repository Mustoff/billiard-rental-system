@extends('layouts.app')

@section('content')
<div class="page-header mb-3">
    <h2 class="page-title">Edit Data Meja Biliar</h2>
</div>

<div class="row row-cards">
    <div class="col-12">
        <form action="{{ route('meja.update', $meja->id) }}" method="POST" class="card">
            @csrf
            @method('PUT')
            
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label required">Nomor Meja</label>
                    <input type="text" name="nomor_meja" class="form-control" value="{{ old('nomor_meja', $meja->nomor_meja) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Jenis Meja</label>
                    <input type="text" name="jenis_meja" class="form-control" value="{{ old('jenis_meja', $meja->jenis_meja) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Harga Per Jam (Rp)</label>
                    <input type="number" name="harga_per_jam" class="form-control" value="{{ old('harga_per_jam', $meja->harga_per_jam) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Meja</label>
                    <select name="status" class="form-select">
                        <option value="kosong" {{ old('status', $meja->status) == 'kosong' ? 'selected' : '' }}>Kosong</option>
                        <option value="dipakai" {{ old('status', $meja->status) == 'dipakai' ? 'selected' : '' }}>Dipakai</option>
                        <option value="maintenance" {{ old('status', $meja->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('meja.index') }}" class="btn btn-link link-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="page-header mb-3">
    <h2 class="page-title">Tambah Meja Biliar</h2>
</div>

<div class="row row-cards">
    <div class="col-12">
        <form action="{{ route('meja.store') }}" method="POST" class="card">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label required">Nomor Meja</label>
                    <input type="text" name="nomor_meja" class="form-control" placeholder="Contoh: Meja 01" required>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Jenis Meja</label>
                    <input type="text" name="jenis_meja" class="form-control" placeholder="Contoh: Sembilan Kaki / Biasa" required>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Harga Per Jam (Rp)</label>
                    <input type="number" name="harga_per_jam" class="form-control" placeholder="Contoh: 50000" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Awal</label>
                    <select name="status" class="form-select">
                        <option value="kosong">Kosong</option>
                        <option value="dipakai">Dipakai</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('meja.index') }}" class="btn btn-link link-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Meja</button>
            </div>
        </form>
    </div>
</div>
@endsection
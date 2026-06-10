@extends('layouts.app')

@section('content')
<div class="page-header mb-3">
    <h2 class="page-title">Tambah Pelanggan Baru</h2>
</div>

<form action="{{ route('pelanggan.store') }}" method="POST" class="card">
    @csrf
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label required">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama pelanggan">
        </div>
        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control" placeholder="Contoh: 08123456789">
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap pelanggan"></textarea>
        </div>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('pelanggan.index') }}" class="btn btn-link link-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Pelanggan</button>
    </div>
</form>
@endsection
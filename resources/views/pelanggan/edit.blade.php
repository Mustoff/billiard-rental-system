@extends('layouts.app')

@section('content')
<div class="page-header mb-3">
    <h2 class="page-title">Edit Data Pelanggan</h2>
</div>

<form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" class="card">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label required">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $pelanggan->nama) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $pelanggan->nomor_hp) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $pelanggan->alamat) }}</textarea>
        </div>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('pelanggan.index') }}" class="btn btn-link link-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-xl mt-4">
    <div class="mb-4">
        <a href="{{ route('meja.index') }}" class="btn btn-sm btn-outline-secondary mb-2" style="border-radius: 6px;">
            ⬅️ Kembali ke List Meja
        </a>
        <h2 class="page-title text-dark font-weight-bold mt-2">🎱 Tambah Master Meja Biliar Baru</h2>
        <p class="text-muted small">Masukkan nomor, spesifikasi tipe/jenis meja, dan tarif per jam secara akurat.</p>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
                <form action="{{ route('meja.store') }}" method="POST">
                    @csrf
                    <div class="card-body p-4">
                        
                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Nomor / Identitas Meja</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">#</span>
                                <input type="text" name="nomor_meja" class="form-control form-control-lg @error('nomor_meja') is-invalid @enderror" placeholder="Contoh: Meja 01, Meja VIP-A" value="{{ old('nomor_meja') }}" required style="border-radius: 0 8px 8px 0;">
                            </div>
                            @error('nomor_meja')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Jenis / Tipe Meja</label>
                            <input type="text" name="jenis_meja" class="form-control form-control-lg @error('jenis_meja') is-invalid @enderror" placeholder="Contoh: Standard 9-Feet, Minion Table, Brunswik VIP" value="{{ old('jenis_meja') }}" required style="border-radius: 8px;">
                            @error('jenis_meja')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Tarif Sewa (Per Jam)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark fw-bold" style="border-radius: 8px 0 0 8px;">Rp</span>
                                <input type="number" name="harga_per_jam" class="form-control form-control-lg @error('harga_per_jam') is-invalid @enderror" placeholder="Contoh: 30000, 50000" value="{{ old('harga_per_jam') }}" min="0" required style="border-radius: 0 8px 8px 0;">
                            </div>
                            @error('harga_per_jam')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="form-label font-weight-bold text-dark">Status Awal Meja</label>
                            <select name="status" class="form-select form-control-lg" style="border-radius: 8px;" required>
                                <option value="kosong" selected>🟢 Kosong / Tersedia (Default)</option>
                                <option value="dipakai">🔴 Sedang Dipakai</option>
                                <option value="maintenance">🛠️ Sedang Maintenance / Rusak</option>
                            </select>
                        </div>

                    </div>
                    
                    <div class="card-footer bg-light border-top-0 p-4 text-end">
                        <button type="submit" class="btn fw-bold px-4 text-white" style="background-color: var(--sporty-cyan); border-radius: 8px;">
                            💾 Simpan Master Meja
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
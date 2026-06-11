@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="page-header mb-3">
        <h2 class="page-title">Buka Meja Baru (Billing di Muka)</h2>
    </div>

    <form action="{{ route('transaksi.store') }}" method="POST" class="card" onsubmit="document.getElementById('btn-submit-create').disabled = true; return true;">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label required">Pilih Pelanggan</label>
                <select name="pelanggan_id" class="form-select" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggans as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->nomor_hp ?? '-' }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label required">Pilih Meja Biliar (Hanya Meja Ready)</label>
                <select name="meja_id" class="form-select" required>
                    <option value="">-- Pilih Meja --</option>
                    @foreach($mejas as $m)
                        <option value="{{ $m->id }}">{{ $m->nomor_meja }} - Rp {{ number_format($m->harga_per_jam, 0, ',', '.') }}/Jam</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label required">Durasi Bermain (Dalam Satuan Jam)</label>
                <input type="number" name="durasi_jam" class="form-control" step="0.5" min="0.5" required placeholder="Contoh: 1 atau 1.5 atau 2">
                <small class="form-hint">Gunakan kelipatan 0.5 jika pelanggan ingin menyewa setengah jam (misal 1.5 jam).</small>
            </div>
        </div>
        
        <div class="card-footer text-end">
            <a href="{{ route('transaksi.index') }}" class="btn btn-link link-secondary">Batal</a>
           <button type="submit" id="btn-simpan" class="btn btn-primary">
                <span id="btn-text">💾 Simpan Billing</span>
            </button>
        </div>
    </form>
</div>
<script>
    const form = document.getElementById('form-transaksi');
    const btnSimpan = document.getElementById('btn-simpan');
    const btnText = document.getElementById('btn-text');

    form.addEventListener('submit', function () {
        // 1. Kunci tombol agar tidak bisa diklik lagi (Anti Double-Click)
        btnSimpan.disabled = true;
        btnSimpan.classList.add('disabled');

        // 2. Ubah teks tombol menjadi indikator memproses
        btnText.innerHTML = '⏳ Memproses Billing...';
    });
</script>
@endsection
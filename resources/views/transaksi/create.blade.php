@extends('layouts.app')

@section('content')
<div class="container-xl mt-4">
    <div class="mb-4">
        <h2 class="page-title text-dark font-weight-bold">⚡ Buka Billing Transaksi Baru</h2>
        <p class="text-muted small">Silakan pilih meja dan masukkan data pelanggan prabayar.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <div class="d-flex">
                <div>
                    <strong class="d-block mb-1">❌ Gagal mengaktifkan meja:</strong>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksiUtama">
                @csrf
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px;">
                    <div class="card-body p-4">
                        
                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Pilih Meja Biliar</label>
                            <select name="meja_id" class="form-select form-control-lg" required style="border-radius: 8px;">
                                <option value="">-- Pilih Meja Biliar --</option>
                                @foreach($mejas as $m)
                                    <option value="{{ $m->id }}" {{ request('meja') == $m->id ? 'selected' : '' }}>
                                        🎱 {{ $m->nomor_meja }} (Rp {{ number_format($m->harga_per_jam, 0, ',', '.') }}/jam)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Pilih Pelanggan / Member</label>
                            <div class="input-group">
                                <select name="pelanggan_id" id="pelanggan_select" class="form-select form-control-lg" required style="border-radius: 8px 0 0 8px;">
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($pelanggans as $p)
                                        <option value="{{ $p->id }}" {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>
                                            👤 {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-dark fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan" style="border-radius: 0 8px 8px 0;" title="Tambah Pelanggan Baru">
                                    ➕ Pelanggan Baru
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold text-dark">Durasi Bermain (Jam)</label>
                            <div class="input-group">
                                <input type="number" name="durasi_jam" class="form-control form-control-lg" placeholder="Contoh: 1 atau 1.5 atau 2" style="border-radius: 8px 0 0 8px;" step="0.5" min="0.5" required>
                                <span class="input-group-text bg-light text-dark fw-bold" style="border-radius: 0 8px 8px 0;">Jam</span>
                            </div>
                            <small class="text-muted small mt-1 d-block">Gunakan kelipatan 0.5 jika ingin menyewa setengah jam (misal 1.5 jam).</small>
                        </div>

                    </div>
                    <div class="card-footer text-end bg-white border-top-0 p-4">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-link link-secondary me-3">Batal</a>
                        <button type="submit" id="btnAktifkanMeja" class="btn fw-bold px-4" style="background-color: var(--sporty-cyan); color: white; border-radius: 8px;">
                            🚀 Aktifkan Meja Sekarang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahPelanggan" tabindex="-1" aria-labelledby="modalTambahPelangganLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header border-bottom-0 bg-light" style="border-radius: 16px 16px 0 0;">
                <h5 class="modal-title font-weight-bold text-dark" id="modalTambahPelangganLabel">👤 Pendaftaran Pelanggan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPelangganInstan">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-dark">Nama Lengkap Pelanggan</label>
                        <input type="text" id="input_nama_pelanggan" class="form-control form-control-lg" placeholder="Contoh: Muhammad Umar" required style="border-radius: 8px;">
                    </div>
                    <div class="mb-2">
                        <label class="form-label font-weight-bold text-dark">Nomor Telepon / WA (Opsional)</label>
                        <input type="number" id="input_telepon_pelanggan" class="form-control form-control-lg" placeholder="Contoh: 08123456xxx" style="border-radius: 8px;">
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 p-3" style="border-radius: 0 0 16px 16px;">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" id="btnSimpanPelanggan" class="btn text-white fw-bold" style="background-color: var(--sporty-cyan); border-radius: 8px;">💾 Daftarkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const formTransaksi = document.getElementById('formTransaksiUtama');
    const formPelanggan = document.getElementById('formPelangganInstan');
    const btnAktifkanMeja = document.getElementById('btnAktifkanMeja');

    // 1. Amankan Handler Form Utama Transaksi
    if (formTransaksi && btnAktifkanMeja) {
        formTransaksi.addEventListener('submit', function() {
            btnAktifkanMeja.disabled = true;
            btnAktifkanMeja.innerText = '⏳ Memproses Billing...';
        });
    }
    
    // 2. Amankan Handler Simpan Pelanggan Instan via AJAX
    if (formPelanggan) {
        formPelanggan.addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah form utama ikut tersubmit

            const namaInput = document.getElementById('input_nama_pelanggan').value;
            const teleponInput = document.getElementById('input_telepon_pelanggan').value;
            const btnSimpan = document.getElementById('btnSimpanPelanggan');

            if (!namaInput.trim()) {
                alert('Nama pelanggan wajib diisi!');
                return;
            }

            btnSimpan.disabled = true;
            btnSimpan.innerText = '⌛ Memproses...';

            fetch("{{ route('pelanggan.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    nama: namaInput,
                    telepon: teleponInput
                })
            })
            .then(response => {
                if (!response.ok) throw new Error('Status server: ' + response.status);
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    const selectPelanggan = document.getElementById('pelanggan_select');
                    if (selectPelanggan) {
                        const opsiBaru = document.createElement('option');
                        opsiBaru.value = data.id;
                        opsiBaru.text = "👤 " + data.nama;
                        opsiBaru.selected = true; 
                        selectPelanggan.add(opsiBaru);
                    }

                    formPelanggan.reset();
                    
                    const btnCloseModal = document.querySelector('#modalTambahPelanggan .btn-close');
                    if (btnCloseModal) {
                        btnCloseModal.click();
                    }
                } else {
                    alert('⚠️ Gagal menyimpan data pelanggan.');
                }
            })
            .catch(error => {
                console.error(error);
                alert('❌ Terjadi kendala: ' + error.message);
            })
            .finally(() => {
                btnSimpan.disabled = false;
                btnSimpan.innerText = '💾 Daftarkan';
            });
        });
    }
});
</script>
@endsection
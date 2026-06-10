@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="page-header mb-3 d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">Modul Transaksi</div>
                <h2 class="page-title">Billing Meja Aktif (Prabayar)</h2>
            </div>
            <div class="col-auto ms-auto">
                <a href="{{ route('transaksi.create') }}" class="btn btn-success d-flex align-items-center" style="gap: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5v14" /><path d="M5 12h14" /></svg>
                    <span>Buka Meja Baru</span>
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <div class="d-flex">
                <div>{{ session('success') }}</div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Daftar Meja Sedang Digunakan</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap">
                <thead>
                    <tr>
                        <th>Meja</th>
                        <th>Pelanggan</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Sisa Waktu (Timer)</th>
                        <th>Total Bayar</th>
                        <th class="text-center w-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiAktif as $t)
                        <tr id="row-transaksi-{{ $t->id }}">
                            <td><strong class="text-primary">{{ $t->meja->nomor_meja }}</strong></td>
                            <td><strong>{{ $t->pelanggan->nama }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($t->jam_mulai)->format('H:i') }} WIB</td>
                            <td>{{ \Carbon\Carbon::parse($t->jam_selesai)->format('H:i') }} WIB</td>
                            <td>
                                <span class="badge bg-md bg-info-lt countdown-timer" 
                                      data-id="{{ $t->id }}" 
                                      data-meja="{{ $t->meja->nomor_meja }}"
                                      data-target="{{ \Carbon\Carbon::parse($t->jam_selesai)->toISOString() }}">
                                      Menghitung...
                                </span>
                            </td>
                            <td>Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="btn-list flex-nowrap justify-content-center">
                                    <button class="btn btn-sm btn-yellow text-white d-flex align-items-center" style="gap: 2px;" data-bs-toggle="modal" data-bs-target="#modal-tambah-waktu-{{ $t->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5v14" /><path d="M5 12h14" /></svg>
                                        <span>Waktu</span>
                                    </button>
                                    
                                    <form id="form-stop-{{ $t->id }}" action="{{ route('transaksi.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Stop permainan di meja ini sekarang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Stop</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Semua meja kosong. Belum ada transaksi aktif saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Riwayat Transaksi Selesai</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap text-secondary">
                <thead>
                    <tr>
                        <th>Meja</th>
                        <th>Pelanggan</th>
                        <th>Jam Bermain</th>
                        <th>Durasi</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatTransaksi as $r)
                        <tr>
                            <td>{{ $r->meja->nomor_meja }}</td>
                            <td>{{ $r->pelanggan->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($r->jam_mulai)->format('d M, H:i') }} - {{ \Carbon\Carbon::parse($r->jam_selesai)->format('H:i') }}</td>
                            <td>{{ $r->durasi_menit }} Menit</td>
                            <td>Rp {{ number_format($r->total_bayar, 0, ',', '.') }}</td>
                            <td><span class="badge bg-success-lt">Selesai</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">Belum ada riwayat transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($riwayatTransaksi->hasPages())
            <div class="card-footer d-flex align-items-center border-top-0">
                <div class="ms-auto">
                    {{ $riwayatTransaksi->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

@foreach($transaksiAktif as $t)
<div class="modal modal-blur fade" id="modal-tambah-waktu-{{ $t->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('transaksi.update', $t->id) }}" method="POST" class="modal-content shadow-lg border-0">
            @csrf
            @method('PUT')
            <div class="modal-header bg-yellow-lt">
                <h5 class="modal-title text-dark d-flex align-items-center" style="gap: 6px;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5v14" /><path d="M5 12h14" /></svg>
                    Perpanjang Waktu Billing - Meja {{ $t->meja->nomor_meja }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="bg-muted-lt p-3 rounded mb-3">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <span class="text-muted d-block small">Nama Pelanggan</span>
                            <span class="font-weight-bold text-dark h4 mb-0">{{ $t->pelanggan->nama }}</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block small">Tarif per Jam</span>
                            <span class="font-weight-bold text-dark h4 mb-0">Rp {{ number_format($t->meja->harga_per_jam, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Durasi Tambahan (Dalam Satuan Jam)</label>
                    <input type="number" name="tambahan_jam" class="form-control form-control-lg text-center" step="0.5" min="0.5" required placeholder="Contoh: 1 atau 1.5 atau 2">
                    <small class="form-hint text-center mt-2">Gunakan kelipatan 0.5 jam (Contoh: ketik 0.5 jika ingin tambah 30 menit).</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning text-white font-weight-bold px-4">Konfirmasi & Bayar</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const timers = document.querySelectorAll('.countdown-timer');

        function updateTimers() {
            const sekarang = new Date().getTime();

            timers.forEach(timer => {
                const idTransaksi = timer.getAttribute('data-id');
                const targetWaktu = new Date(timer.getAttribute('data-target')).getTime();
                const nomorMeja = timer.getAttribute('data-meja');
                const sisaWaktu = targetWaktu - sekarang;

                if (sisaWaktu <= 0) {
                    // 1. Ubah tampilan teks secara langsung
                    timer.innerHTML = "WAKTU HABIS";
                    timer.className = "badge bg-md bg-danger text-white";
                    
                    // 2. Cegah looping: periksa apakah form ini sudah dalam proses submit?
                    if (!timer.classList.contains('is-submitting')) {
                        timer.classList.add('is-submitting'); // Kunci agar tidak submit berkali-kali
                        
                        // 3. Cari form stop berdasarkan ID transaksi, lalu submit otomatis ke database
                        const formStop = document.getElementById(`form-stop-${idTransaksi}`);
                        if (formStop) {
                            // bypass fungsi confirm() bawaan karena waktu memang sudah habis secara sistem
                            formStop.onsubmit = null; 
                            formStop.submit();
                        }
                    }
                } else {
                    // Matematika konversi milidetik ke Jam, Menit, dan Detik
                    const jam = Math.floor((sisaWaktu % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const menit = Math.floor((sisaWaktu % (1000 * 60 * 60)) / (1000 * 60));
                    const detik = Math.floor((sisaWaktu % (1000 * 60)) / 1000);

                    const displayJam = jam < 10 ? "0" + jam : jam;
                    const displayMenit = menit < 10 ? "0" + menit : menit;
                    const displayDetik = detik < 10 ? "0" + detik : detik;

                    timer.innerHTML = `${displayJam}:${displayMenit}:${displayDetik}`;

                    // Efek visual warna kuning jika waktu di bawah 5 menit
                    if (sisaWaktu < (5 * 60 * 1000)) {
                        timer.className = "badge bg-md bg-warning text-white countdown-timer";
                    }
                }
            });
        }

        // Jalankan mesin timer setiap 1 detik
        setInterval(updateTimers, 1000);
        updateTimers();
    });
</script>
@endsection
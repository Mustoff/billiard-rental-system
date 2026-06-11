@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-body">
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

            <div class="card mb-4 shadow-sm border-0">
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
                                        <div class="d-flex" style="gap: 4px;">
                                            <a href="{{ route('transaksi.show', $t->id) }}" class="btn btn-sm btn-outline-info">Detail</a>

                                            <form id="form-stop-{{ $t->id }}" action="{{ route('transaksi.destroy', $t->id) }}" method="POST">
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

            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h3 class="card-title text-secondary">Riwayat Transaksi Selesai</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
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
                                    <td><strong>{{ $r->meja->nomor_meja }}</strong></td>
                                    <td>{{ $r->pelanggan->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->jam_mulai)->format('d M, H:i') }} - {{ \Carbon\Carbon::parse($r->jam_selesai)->format('H:i') }}</td>
                                    <td>{{ $r->durasi_menit }} Menit</td>
                                    <td class="font-weight-bold text-success">Rp {{ number_format($r->total_bayar, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center" style="gap: 6px;">
                                            <a href="{{ route('transaksi.show', $r->id) }}" class="btn btn-sm btn-outline-info">
                                                Detail
                                            </a>
                                            <span class="badge bg-success-lt">Selesai</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3 text-muted">Belum ada riwayat transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($riwayatTransaksi->hasPages())
                    <div class="card-footer d-flex align-items-center border-top-0 bg-light">
                        <div class="ms-auto">
                            {{ $riwayatTransaksi->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const timers = document.querySelectorAll('.countdown-timer');

        function updateTimers() {
            // Ambil waktu lokal browser kasir saat ini
            const sekarang = new Date().getTime();

            timers.forEach(timer => {
                const idTransaksi = timer.getAttribute('data-id');
                const nomorMeja = timer.getAttribute('data-meja');
                const targetWaktu = new Date(timer.getAttribute('data-target')).getTime();
                
                // HITUNG SISA WAKTU (Sudah bersih dari kode pengganggu)
                const sisaWaktu = targetWaktu - sekarang;

                if (sisaWaktu <= 0) {
                    timer.innerHTML = "WAKTU HABIS";
                    timer.className = "badge bg-md bg-danger text-white";
                    
                    if (!timer.classList.contains('is-submitting')) {
                        timer.classList.add('is-submitting');
                        
                        const formStop = document.getElementById(`form-stop-${idTransaksi}`);
                        if (formStop) {
                            formStop.onsubmit = null; 

                            // Tampilkan SweetAlert
                            Swal.fire({
                                title: `WAKTU MEJA ${nomorMeja} HABIS!`,
                                text: "Segera matikan lampu meja billiard dan tertibkan peralatan.",
                                icon: "warning",
                                confirmButtonText: "OK, Selesaikan Transaksi",
                                confirmButtonColor: "#d33",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    formStop.submit();
                                }
                            });
                        }
                    }
                } else {
                    // Konversi milidetik ke Jam, Menit, dan Detik
                    const jam = Math.floor((sisaWaktu % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const menit = Math.floor((sisaWaktu % (1000 * 60 * 60)) / (1000 * 60));
                    const detik = Math.floor((sisaWaktu % (1000 * 60)) / 1000);

                    const displayJam = jam < 10 ? "0" + jam : jam;
                    const displayMenit = menit < 10 ? "0" + menit : menit;
                    const displayDetik = detik < 10 ? "0" + detik : detik;

                    // Tampilkan angka timer yang berjalan mundur
                    timer.innerHTML = `${displayJam}:${displayMenit}:${displayDetik}`;

                    // Jika sisa waktu kurang dari 5 menit, ubah warna badge jadi kuning (Peringatan)
                    if (sisaWaktu < (5 * 60 * 1000)) {
                        timer.className = "badge bg-md bg-warning text-white countdown-timer";
                    }
                }
            });
        }

        // Jalankan fungsi setiap 1 detik sekali
        setInterval(updateTimers, 1000);
        updateTimers();
    });
</script>
@endsection
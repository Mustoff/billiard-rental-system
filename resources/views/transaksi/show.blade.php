@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl" style="max-width: 600px;"> <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-4">
                        <h1 class="mb-1 font-weight-black tracking-tight text-primary">BILLIARD CENTER</h1>
                        <p class="text-secondary small mb-0">Nota Pembayaran Sewa Meja Prabayar</p>
                        <div class="hr-text my-3">====================</div>
                    </div>

                    <table class="table table-transparent table-vcenter small font-weight-medium">
                        <tbody>
                            <tr>
                                <td class="text-secondary ps-0 py-2">Nama Pelanggan</td>
                                <td class="text-end font-weight-bold pe-0 py-2">{{ $transaksi->pelanggan->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary ps-0 py-2">Nomor Meja</td>
                                <td class="text-end font-weight-bold text-indigo pe-0 py-2">Meja {{ $transaksi->meja->nomor_meja }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary ps-0 py-2">Harga / Jam</td>
                                <td class="text-end text-muted pe-0 py-2">Rp {{ number_format($transaksi->meja->harga_per_jam, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary ps-0 py-2">Durasi Sewa</td>
                                <td class="text-end font-weight-bold pe-0 py-2">{{ $transaksi->durasi_menit }} Menit</td>
                            </tr>
                            <tr>
                                <td class="text-secondary ps-0 py-2">Jam Mulai</td>
                                <td class="text-end pe-0 py-2">{{ \Carbon\Carbon::parse($transaksi->jam_mulai)->format('H:i') }} WIB</td>
                            </tr>
                            <tr>
                                <td class="text-secondary ps-0 py-2">Jam Selesai</td>
                                <td class="text-end pe-0 py-2">{{ \Carbon\Carbon::parse($transaksi->jam_selesai)->format('H:i') }} WIB</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="hr-text my-3">====================</div>

                    <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded mb-4">
                        <span class="font-weight-bold text-secondary">TOTAL BAYAR :</span>
                        <span class="h2 font-weight-black text-success mb-0">
                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="text-center text-secondary small mb-4">
                        <p class="mb-1 font-weight-bold">Terima Kasih Atas Kunjungan Anda</p>
                        <p class="small opacity-75">Harap patuhi batas waktu bermain demi kenyamanan bersama.</p>
                    </div>

                    <div class="row g-2 d-print-none">
                        <div class="col-6">
                            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary w-100">
                                Kembali
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('transaksi.cetak', $transaksi->id) }}" target="_blank" class="btn btn-primary w-100 d-flex align-items-center justify-content-center" style="gap: 4px;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a1 1 0 0 0 1 -1v-4a1 1 0 0 0 -1 -1h-14a1 1 0 0 0 -1 1v4a1 1 0 0 0 1 1h2" /><path d="M17 9v-4a1 1 0 0 0 -1 -1h-8a1 1 0 0 0 -1 1v4" /><rect x="7" y="13" width="10" height="8" rx="1" /></svg>
                                Cetak PDF
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
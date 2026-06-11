@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="page-header mb-4 d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">Ikhtisar Sistem</div>
                <h2 class="page-title">Dashboard Analisis Billiard</h2>
            </div>
        </div>
    </div>

    <div class="row row-cards mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-green text-white avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium text-muted">Total Pendapatan</div>
                            <div class="h2 font-weight-bold text-dark mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-primary text-white avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M5 20h14" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium text-muted">Meja Digunakan</div>
                            <div class="h2 font-weight-bold text-dark mb-0">{{ $mejaTerisi }} / {{ $totalMeja }} Meja</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-yellow text-white avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 7a4 4 0 1 0 0 8a4 4 0 0 0 0 -8z" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium text-muted">Data Pelanggan</div>
                            <div class="h2 font-weight-bold text-dark mb-0">{{ $totalPelanggan }} Jiwa</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-info text-white avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 14 14" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium text-muted">Persentase Ramai</div>
                            <div class="h2 font-weight-bold text-dark mb-0">
                                {{ $totalMeja > 0 ? round(($mejaTerisi / $totalMeja) * 100) : 0 }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h3 class="card-title font-weight-bold text-secondary">Grafik Pemasukan Kasir (7 Hari Terakhir)</h3>
                </div>
                <div class="card-body">
                    <div style="position: relative; height:320px; width:100%">
                        <canvas id="grafikPendapatanBilliard"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tangkap konteks element kanvas
        const ctx = document.getElementById('grafikPendapatanBilliard').getContext('2d');
        
        // Buat objek Chart.js baru
        new Chart(ctx, {
            type: 'bar', // Jenis grafik: Bar (Batang)
            data: {
                labels: {!! json_encode($labelGrafik) !!}, // Mengambil array tanggal dari PHP
                datasets: [{
                    label: 'Pendapatan Kasir (Rupiah)',
                    data: {!! json_encode($dataPendapatan) !!}, // Mengambil array angka nominal dari PHP
                    backgroundColor: 'rgba(32, 107, 196, 0.2)', // Warna isi batang (Biru Tabler)
                    borderColor: 'rgba(32, 107, 196, 1)',      // Warna garis tepi batang
                    borderWidth: 2,
                    borderRadius: 6, // Sudut batang agak melengkung biar modern
                    hoverBackgroundColor: 'rgba(32, 107, 196, 0.4)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Format angka sumbu Y agar menampilkan rupiah ringkas di grafik
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
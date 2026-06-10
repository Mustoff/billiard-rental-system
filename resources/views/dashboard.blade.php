@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="page-header mb-4">
        <h2 class="page-title">Dashboard Analitik</h2>
    </div>

    <div class="row row-cards">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-blue text-white avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><circle cx="6" cy="12" r="1" /><circle cx="18" cy="12" r="1" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">{{ $totalMeja }} Meja</div>
                            <div class="text-secondary small">Total Meja</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-danger text-white avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" fill="currentColor" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">{{ $mejaDipakai }} Meja</div>
                            <div class="text-secondary small">Meja Dipakai</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-yellow text-white avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10s-10-4.477-10-10s4.477-10 10-10zm0 5a5 5 0 1 0 0 10a5 5 0 0 0 0-10z" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">{{ $transaksiAktif }} User</div>
                            <div class="text-secondary small">Transaksi Aktif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-success text-white avatar">
                                <strong>Rp</strong>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                            <div class="text-secondary small">Pendapatan Hari Ini</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
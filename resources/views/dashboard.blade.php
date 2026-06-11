@extends('layouts.app')
@section('content')
<div class="container-xl mt-4">
    
    <div class="mb-4">
        <h2 class="page-title text-dark">📊 Dashboard Real-Time</h2>
        <p class="text-muted small">Status operasional meja biliar dan ringkasan transaksi hari ini.</p>
    </div>

    <div class="row row-cards mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm border-0 shadow-sm bg-success text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="h1 mb-0 font-weight-bold me-3">{{ $totalMejaKosong }}</div>
                    <div>
                        <div class="font-weight-bold">Meja Kosong</div>
                        <div class="small opacity-75">Siap digunakan pelanggan</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm border-0 shadow-sm bg-danger text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="h1 mb-0 font-weight-bold me-3">{{ $totalMejaDipakai }}</div>
                    <div>
                        <div class="font-weight-bold">Sedang Dipakai</div>
                        <div class="small opacity-75">Billing timer sedang berjalan</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm border-0 shadow-sm bg-blue text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="h1 mb-0 font-weight-bold me-3">{{ $totalPelanggan }}</div>
                    <div>
                        <div class="font-weight-bold">Total Pelanggan</div>
                        <div class="small opacity-75">Member terdaftar di sistem</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm border-0 shadow-sm bg-purple text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="h3 mb-0 font-weight-bold me-2">Rp</div>
                    <div class="h1 mb-0 font-weight-bold me-3">{{ number_format($omzetHariIni, 0, ',', '.') }}</div>
                    <div>
                        <div class="font-weight-bold">Omzet Hari Ini</div>
                        <div class="small opacity-75">Pendapatan masuk</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h3 class="card-title font-weight-bold mb-0">🎱 Status Denah Meja Biliar</h3>
        </div>
        <div class="card-body py-4">
            <div class="row row-cards">
                @foreach($daftarMeja as $meja)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card card-sm text-center p-3 border shadow-none align-items-center justify-content-center">
                            @if($meja->status === 'kosong')
                                <span class="avatar avatar-md rounded-circle bg-success-lt text-success mb-2" style="font-size: 1.5rem;">🟢</span>
                                <div class="font-weight-bold text-dark">{{ $meja->nomor_meja }}</div>
                                <span class="badge bg-success-lt text-success mt-1 small">Tersedia</span>
                            @elseif($meja->status === 'dipakai')
                                <span class="avatar avatar-md rounded-circle bg-danger-lt text-danger mb-2" style="font-size: 1.5rem;">🔴</span>
                                <div class="font-weight-bold text-dark">{{ $meja->nomor_meja }}</div>
                                <span class="badge bg-danger-lt text-danger mt-1 small">Main</span>
                            @else
                                <span class="avatar avatar-md rounded-circle bg-secondary-lt text-secondary mb-2" style="font-size: 1.5rem;">⚫</span>
                                <div class="font-weight-bold text-dark">{{ $meja->nomor_meja }}</div>
                                <span class="badge bg-secondary-lt text-secondary mt-1 small">Maintenance</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
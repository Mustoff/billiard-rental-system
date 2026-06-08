@extends('layouts.app')

@section('content')
<div class="page-header mb-3">
    <h2 class="page-title">Ringkasan Sistem</h2>
</div>

<div class="row row-cards">
    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">M</span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Total Meja</div>
                        <div class="text-secondary">{{ $totalMeja }} Meja</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-success text-white avatar">K</span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Meja Ready / Kosong</div>
                        <div class="text-secondary">{{ $mejaKosong }} Meja</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-danger text-white avatar">D</span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Meja Sedang Dipakai</div>
                        <div class="text-secondary">{{ $mejaDipakai }} Meja</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
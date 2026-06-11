@extends('layouts.app')

@section('content')
<div class="container-xl mt-4">
    <div class="mb-4">
        <h2 class="page-title text-dark">⚙️ Pengaturan Identitas Usaha</h2>
        <p class="text-muted small">Update data nama biliar, alamat, dan logo untuk digunakan pada struk cetak.</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Nama Tempat Biliar</label>
                            <input type="text" name="nama_billiard" class="form-control" value="{{ old('nama_billiard', $setting->nama_billiard ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Nomor HP / WhatsApp</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $setting->no_hp ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $setting->alamat ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Ganti Logo (PNG/JPG)</label>
                            <input type="file" name="logo" class="form-control">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo.</small>
                            
                            @if(isset($setting) && $setting->logo)
                                <div class="mt-3">
                                    <p class="small text-muted">Logo saat ini:</p>
                                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" style="max-height: 100px;" class="img-thumbnail">
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert('{{ session('success') }}');
    });
</script>
@endif
@endsection
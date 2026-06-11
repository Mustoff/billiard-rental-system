<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Transaksi;
use App\Models\Pelanggan;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung data untuk Ringkasan Widget Dashboard
        $totalMejaKosong  = Meja::where('status', 'kosong')->count();
        $totalMejaDipakai = Meja::where('status', 'dipakai')->count();
        $totalPelanggan   = Pelanggan::count();
        
        // Hitung omzet hari ini dari transaksi yang sudah selesai/lunas
        $omzetHariIni     = Transaksi::whereDate('created_at', now()->today())
                                    ->sum('total_bayar');

        // 2. Ambil SEMUA meja untuk visualisasi indikator real-time (Urut Alami)
        $daftarMeja = Meja::orderByRaw('LENGTH(nomor_meja) ASC')
                            ->orderBy('nomor_meja', 'asc')
                            ->get();

        // 3. Lempar semua data ke view dashboard
        return view('dashboard', compact(
            'totalMejaKosong', 
            'totalMejaDipakai', 
            'totalPelanggan', 
            'omzetHariIni',
            'daftarMeja'
        ));
    }

    // Fungsi Log Aktivitas yang kemarin sudah kita buat tetap di bawah sini...
    public function activityLog()
    {
        $logs = \App\Models\ActivityLog::with('user')->latest()->paginate(10);
        return view('activity_log', compact('logs'));
    }
}
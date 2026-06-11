<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Meja;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Angka Ringkasan Statistik
        $totalPendapatan = Transaksi::where('status', 'selesai')->sum('total_bayar');
        $mejaTerisi = Transaksi::where('status', 'bermain')->count();
        $totalMeja = Meja::count();
        $totalPelanggan = Pelanggan::count();

        // 2. Olah Data Grafik Pendapatan 7 Hari Terakhir (Chart.js)
        $labelGrafik = [];
        $dataPendapatan = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);
            
            // Format label untuk sumbu X grafik (Contoh: "11 Jun")
            $labelGrafik[] = $tanggal->translatedFormat('d M');
            
            // Hitung total uang masuk pada tanggal tersebut
            $pemasukanHarian = Transaksi::where('status', 'selesai')
                ->whereDate('created_at', $tanggal)
                ->sum('total_bayar');
                
            $dataPendapatan[] = $pemasukanHarian;
        }

        return view('dashboard', compact(
            'totalPendapatan',
            'mejaTerisi',
            'totalMeja',
            'totalPelanggan',
            'labelGrafik',
            'dataPendapatan'
        ));
    }
}
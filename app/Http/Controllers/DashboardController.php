<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total semua meja biliar yang terdaftar
        $totalMeja = Meja::count();

        // 2. Hitung meja yang statusnya saat ini 'dipakai'
        $mejaDipakai = Meja::where('status', 'dipakai')->count();

        // 3. Hitung jumlah transaksi yang statusnya masih 'bermain'
        $transaksiAktif = Transaksi::where('status', 'bermain')->count();

        // 4. Hitung total pendapatan dari billing prabayar khusus hari ini saja
        $pendapatanHariIni = Transaksi::whereDate('created_at', Carbon::today())->sum('total_bayar');

        return view('dashboard', compact('totalMeja', 'mejaDipakai', 'transaksiAktif', 'pendapatanHariIni'));
    }
}
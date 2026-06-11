<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tangkap parameter filter dari form pencarian di view
        $tanggalMulai   = $request->get('tanggal_mulai');
        $tanggalSelesai = $request->get('tanggal_selesai');
        $keyword        = $request->get('keyword');

        // 2. Gunakan query builder dasar yang hanya mengambil transaksi berstatus 'selesai'
        $query = Transaksi::where('status', 'selesai')
            ->with(['pelanggan', 'meja']) // Eager loading agar aplikasi cepat & hemat database
            ->latest('jam_selesai');

        // 3. Logika Filter Tanggal (Jika kasir memilih rentang tanggal)
        if ($tanggalMulai && $tanggalSelesai) {
            $query->whereBetween('created_at', [
                Carbon::parse($tanggalMulai)->startOfDay(),
                Carbon::parse($tanggalSelesai)->endOfDay()
            ]);
        }

        // 4. Logika Pencarian Nama Pelanggan atau Nomor Meja
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->whereHas('pelanggan', function($p) use ($keyword) {
                    $p->where('nama', 'LIKE', "%{$keyword}%");
                })->orWhereHas('meja', function($m) use ($keyword) {
                    $m->where('nomor_meja', 'LIKE', "%{$keyword}%");
                });
            });
        }

        // 5. Hitung Total Pendapatan dari hasil data yang sudah difilter
        $totalPendapatan = $query->sum('total_bayar');

        // 6. Jalankan Pagination (Tampilkan 10 data per halaman agar rapi)
        $laporanTransaksi = $query->paginate(10)->withQueryString();

        return view('laporan.index', compact('laporanTransaksi', 'totalPendapatan', 'tanggalMulai', 'tanggalSelesai', 'keyword'));
    }
}
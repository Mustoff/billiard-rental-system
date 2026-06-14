<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaksi; // Sesuaikan dengan nama model transaksi kamu
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
    // 1. Ambal data input filter dari view
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalSelesai = $request->input('tanggal_selesai');
    $keyword = $request->input('keyword');

    // 2. Inisialisasi query utama (pastikan statusnya sudah selesai/lunas)
    // Sesuaikan kondisi status sesuai struktur database biliar kamu (misal: 'selesai' atau 'lunas')
    $query = Transaksi::with(['meja', 'pelanggan'])->where('status', 'selesai');

    // 3. FIX LOGIKA FILTER TANGGAL: Cek jika input tanggal diisi oleh kasir
    if ($tanggalMulai && $tanggalSelesai) {
        // Ambil dari awal hari tanggal mulai (00:00:00) sampai akhir hari tanggal selesai (23:59:59)
        $start = Carbon::parse($tanggalMulai)->startOfDay();
        $end = Carbon::parse($tanggalSelesai)->endOfDay();

        $query->whereBetween('jam_selesai', [$start, $end]);
    } elseif ($tanggalMulai) {
        $query->where('jam_selesai', '>=', Carbon::parse($tanggalMulai)->startOfDay());
    } elseif ($tanggalSelesai) {
        $query->where('jam_selesai', '<=', Carbon::parse($tanggalSelesai)->endOfDay());
    }

    // 4. Filter berdasarkan keyword pencarian (Nama Pelanggan atau Nomor Meja)
    if ($keyword) {
        $query->where(function($q) use ($keyword) {
            $q->whereHas('pelanggan', function($qp) use ($keyword) {
                $qp->where('nama', 'like', '%' . $keyword . '%');
            })->orWhereHas('meja', function($qm) use ($keyword) {
                $qm->where('nomor_meja', 'like', '%' . $keyword . '%');
            });
        });
    }

    // 5. Eksekusi kalkulasi total pendapatan sesuai filter yang aktif
    $totalPendapatan = $query->sum('total_bayar');

    // 6. Ambil data dengan pagination untuk tabel rincian
    $laporanTransaksi = $query->orderBy('jam_selesai', 'desc')->paginate(10);

    // 7. Kembalikan data ke view laporan
    return view('laporan.index', compact(
        'laporanTransaksi', 
        'totalPendapatan', 
        'tanggalMulai', 
        'tanggalSelesai', 
        'keyword'
    ));
    }
}
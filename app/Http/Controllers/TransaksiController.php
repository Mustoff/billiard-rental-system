<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Meja;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ActivityLog;

class TransaksiController extends Controller
{
    /**
     * Tampilkan Riwayat & Transaksi yang Sedang Aktif
     */
    public function index()
    {
        // Ambil transaksi yang statusnya masih 'bermain' untuk dipasang Timer
        $transaksiAktif = Transaksi::with(['pelanggan', 'meja'])
            ->where('status', 'bermain')
            ->orderBy('jam_selesai', 'asc')
            ->get();

        // Ambil riwayat transaksi yang sudah selesai
        $riwayatTransaksi = Transaksi::with(['pelanggan', 'meja'])
            ->where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('transaksi.index', compact('transaksiAktif', 'riwayatTransaksi'));
    }

    /**
     * Form Buka Meja Baru (Transaksi Baru)
     */
    public function create()
    {
        // 1. Ambil SEMUA pelanggan untuk pilihan form
        $pelanggans = \App\Models\Pelanggan::orderBy('nama', 'asc')->get();

        // 2. Ambil SEMUA meja yang statusnya 'kosong'
        // Menggunakan orderByRaw LENGTH agar Meja 10 & 11 tidak menyodok ke atas setelah Meja 1
        $mejas = \App\Models\Meja::where('status', 'kosong')
            ->orderByRaw('LENGTH(nomor_meja) ASC')
            ->orderBy('nomor_meja', 'asc')
            ->get(); // <-- Pastikan pakai get(), jangan pakai paginate() atau take() di sini

        // 3. Lempar data ke halaman form transaksi
        return view('transaksi.create', compact('pelanggans', 'mejas'));
    }

   /**
     * Proses Klik "Mulai Bermain" (Simpan Billing di Muka)
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id', // Pastikan ID-nya benar ada di tabel pelanggan
            'meja_id'       => 'required|exists:mejas,id',      // Pastikan ID-nya benar ada di tabel meja
            'durasi_jam'    => 'required|integer|min:1',       // Minimal sewa 1 jam
        ], [
            'pelanggan_id.required' => 'Silakan pilih pelanggan terlebih dahulu!',
            'meja_id.required'      => 'Silakan tentukan meja billiard yang akan digunakan!',
            'durasi_jam.required'   => 'Durasi bermain wajib ditentukan!',
        ]);

        // 1. Ambil data meja berdasarkan ID yang dipilih kasir
        $meja = Meja::findOrFail($request->meja_id);

        // 2. Ambil Waktu Mulai Sekarang (WIB sesuai config)
        $jamMulai = \Carbon\Carbon::now();

        // 3. Hitung Durasi Menit & Jam Selesai
        $durasiMenit = $request->durasi_jam * 60;
        $jamSelesai = $jamMulai->copy()->addMinutes($durasiMenit);

        // 4. Hitung Total Bayar di Muka
        $totalBayar = $request->durasi_jam * $meja->harga_per_jam;

        // 5. Buat Data Transaksi Baru
        $transaksi = Transaksi::create([
            'pelanggan_id' => $request->pelanggan_id,
            'meja_id'      => $request->meja_id,
            'jam_mulai'    => $jamMulai,
            'jam_selesai'  => $jamSelesai,
            'durasi_menit' => $durasiMenit,
            'total_bayar'  => $totalBayar,
            'status'       => 'bermain',
        ]);

        // 6. PAKSA UPDATE STATUS MEJA DI DATABASE SEKARANG JUGA
        // Menggunakan metode update langsung agar MySQL segera mengunci status meja menjadi 'dipakai'
        $meja->update([
            'status' => 'dipakai'
        ]);
        ActivityLog::create([
            'user_id'    => auth()->id(),
            'aktivitas'  => 'Buka Meja',
            'deskripsi'  => auth()->user()->name . ' berhasil membuka ' . $transaksi->meja->nomor_meja . ' untuk pelanggan ' . $transaksi->pelanggan->nama,
            'ip_address' => request()->ip()
        ]);
        return redirect()->route('transaksi.index')->with('success', 'Meja berhasil dibuka! Status meja otomatis berubah menjadi DIPAKAI.');
    }

    /**
     * Fitur Tambah Waktu Bermain (Perpanjang Billing)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tambahan_jam' => 'required|numeric|min:0.5',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $meja = $transaksi->meja;

        // 1. Hitung biaya tambahan
        $biayaTambahan = $request->tambahan_jam * $meja->harga_per_jam;

        // 2. Kalkulasi Jam Selesai Baru
        // Jika waktu saat ini sudah melewati jam_selesai lama (artinya waktu sempat habis),
        // maka waktu baru dihitung dari Jam Sekarang. Jika belum habis, akumulasikan dari jam_selesai lama.
        $jamSelesaiLama = \Carbon\Carbon::parse($transaksi->jam_selesai);
        
        if ($jamSelesaiLama->isPast()) {
            $jamSelesaiBaru = \Carbon\Carbon::now()->addMinutes($request->tambahan_jam * 60);
        } else {
            $jamSelesaiBaru = $jamSelesaiLama->addMinutes($request->tambahan_jam * 60);
        }

        // 3. Update data transaksi
        $transaksi->update([
            'jam_selesai' => $jamSelesaiBaru,
            'durasi_menit' => $transaksi->durasi_menit + ($request->tambahan_jam * 60),
            'total_bayar' => $transaksi->total_bayar + $biayaTambahan,
            'status' => 'bermain' // Pastikan statusnya tetap/kembali 'bermain'
        ]);

        // 4. Pastikan status meja tetap 'dipakai'
        $meja->update(['status' => 'dipakai']);

        return redirect()->route('transaksi.index')->with('success', 'Durasi bermain berhasil diperpanjang!');
    }
    /**
     * Fitur Stop Paksa / Selesai Manual Sebelum Waktu Habis
     */
    public function destroy($id)
    {
        // 1. Cari data transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // 2. Kembalikan status meja menjadi kosong agar bisa disewa lagi
        if ($transaksi->meja) {
            $transaksi->meja->update(['status' => 'kosong']);
        }

        // 3. Paksa ubah status transaksi langsung menggunakan properti objek (Bypass Fillable)
        $transaksi->status = 'selesai';
        $transaksi->jam_selesai = \Carbon\Carbon::now(); // Catat waktu asli saat permainan dihentikan
        $transaksi->save(); // Perintah ini memaksa MySQL untuk langsung menyimpan data
      
        ActivityLog::create([
            'user_id'    => auth()->id(),
            'aktivitas'  => 'Stop Billing',
            'deskripsi'  => auth()->user()->name . ' menghentikan paksa/menyelesaikan billing pada ' . $transaksi->meja->nomor_meja,
            'ip_address' => request()->ip()
        ]);
        return redirect()->route('transaksi.index')->with('success', 'Meja telah dikosongkan dan transaksi berhasil diselesaikan.');
    }
    /**
     * Menampilkan Detail Nota Transaksi Kasir
     */
    public function show($id)
    {
        // Cari data transaksi yang sudah selesai atau sedang bermain beserta relasinya
        $transaksi = Transaksi::with(['pelanggan', 'meja'])->findOrFail($id);
        
        return view('transaksi.show', compact('transaksi'));
    }
    /**
     * Memproses Cetak Struk Nota Format Thermal PDF
     */
    public function cetakStruk($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'meja'])->findOrFail($id);

        // Load halaman blade khusus template struk kasir
        $pdf = Pdf::loadView('pdf.struk', compact('transaksi'));

        // Atur ukuran kertas agar pas dengan printer thermal struk kasir (lebar 80mm / 58mm)
        // Panjang kertas disesuaikan dinamis agar tidak boros kertas
        $pdf->setPaper([0, 0, 226, 400], 'portrait'); 

        // Alirkan langsung ke browser (stream) agar kasir bisa langsung cetak tanpa download paksa
        return $pdf->stream('struk-billiard-' . $transaksi->id . '.pdf');
    }
}
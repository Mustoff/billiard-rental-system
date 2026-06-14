<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Tampilkan List Pelanggan & Fitur Cari
     */
    public function index(Request $request)
    {
        // Fitur Cari Pelanggan
        $cari = $request->get('keyword');
        if ($cari) {
            $pelanggans = Pelanggan::where('nama', 'LIKE', "%$cari%")
                ->orWhere('nomor_hp', 'LIKE', "%$cari%")
                ->paginate(10);
        } else {
            $pelanggans = Pelanggan::paginate(10);
        }

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        // 1. Ambil data secara fleksibel (bisa membaca Form biasa ataupun Request JSON AJAX)
        $nama = $request->input('nama');
        $nomor_hp = $request->input('nomor_hp');

        // 2. Validasi manual sederhana agar tidak memicu eror redirect 422 bawaan Laravel
        if (!$nama) {
            return response()->json([
                'success' => false,
                'message' => 'Nama pelanggan wajib diisi!'
            ], 400);
        }

        // 3. Simpan data ke dalam database
        $pelanggan = \App\Models\Pelanggan::create([
            'nama' => $nama,
            'nomor_hp' => $nomor_hp,
            // Jika tabel kamu membutuhkan kolom default lain seperti kode_member, tambahkan di sini
        ]);

        // 4. Kirim balik respon sukses dalam format JSON agar ditangkap oleh JavaScript Pop-up
        return response()->json([
            'success' => true,
            'id' => $pelanggan->id,
            'nama' => $pelanggan->nama
        ]);
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'nullable|numeric',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
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
        $validatedData = $request->validate([
            'nama'      => 'required|string|max:255',
            'nomor_hp'  => 'required|numeric|digits_between:10,14',
        ], [
            'nama.required'     => 'Nama pelanggan wajib diisi!',
            'nomor_hp.required' => 'Nomor HP wajib diisi!',
            'nomor_hp.numeric'  => 'Nomor HP harus berupa angka!',
        ]);

        // Simpan data menggunakan hasil data yang sudah tervalidasi
        Pelanggan::create($validatedData);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan baru berhasil didaftarkan!');
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
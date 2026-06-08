<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Tampilkan List Meja
     */
    public function index()
    {
        // Mengambil semua data meja dari database
        $mejas = Meja::all();
        
        // Mengirim data meja ke halaman views/meja/index.blade.php
        return view('meja.index', compact('mejas'));
    }

    /**
     * Tampilkan Formulir Tambah Meja
     */
    public function create()
    {
        return view('meja.create');
    }

    /**
     * Simpan Data Meja Baru ke Database
     */
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nomor_meja' => 'required|unique:mejas,nomor_meja',
            'jenis_meja' => 'required',
            'harga_per_jam' => 'required|numeric',
            'status' => 'required|in:kosong,dipakai,maintenance',
        ]);

        // Simpan ke database
        Meja::create($request->all());

        // Kembali ke halaman utama meja dengan pesan sukses
        return redirect()->route('meja.index')->with('success', 'Meja baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan Detail Meja (Lewati dulu jika belum butuh)
     */
    public function show(Meja $meja)
    {
        //
    }

    /**
     * Tampilkan Formulir Edit Meja
     */
    public function edit(Meja $meja)
    {
        // Mengirim data meja yang dipilih ke halaman views/meja/edit.blade.php
        return view('meja.edit', compact('meja'));
    }

    /**
     * Simpan Perubahan Data Meja
     */
    public function update(Request $request, Meja $meja)
    {
        // Validasi inputan form edit
        $request->validate([
            'nomor_meja' => 'required|unique:mejas,nomor_meja,' . $meja->id,
            'jenis_meja' => 'required',
            'harga_per_jam' => 'required|numeric',
            'status' => 'required|in:kosong,dipakai,maintenance',
        ]);

        // Update data di database
        $meja->update($request->all());

        return redirect()->route('meja.index')->with('success', 'Data meja berhasil diperbarui!');
    }

    /**
     * Hapus Meja dari Database
     */
    public function destroy(Meja $meja)
    {
        $meja->delete();

        return redirect()->route('meja.index')->with('success', 'Meja berhasil dihapus!');
    }
}
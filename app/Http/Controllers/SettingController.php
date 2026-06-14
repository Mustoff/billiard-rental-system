<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // 1. Menampilkan halaman form pengaturan
    public function edit()
    {
        $setting = Setting::first();
        return view('setting_edit', compact('setting'));
    }

    // 2. Memproses perubahan data & upload logo
    public function update(Request $request)
    {
        $request->validate([
            'nama_billiard' => 'required|string|max:255',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $setting = Setting::first() ?? new Setting();
        
        $setting->nama_billiard = $request->nama_billiard;
        $setting->alamat = $request->alamat;
        $setting->no_hp = $request->no_hp;

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }
            // Simpan logo baru
            $path = $request->file('logo')->store('logos', 'public');
            $setting->logo = $path;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Identitas biliar berhasil diperbarui!');
    }
}
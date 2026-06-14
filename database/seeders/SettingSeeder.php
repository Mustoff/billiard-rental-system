<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            'nama_billiard' => 'Bricks Billiard & Cafe', // Silakan sesuaikan nama biliar kamu
            'alamat'        => 'Jl. Raya Yogyakarta, Sleman, DIY',
            'no_hp'         => '081234567890',
            'logo'          => null, // Awalnya kosong sebelum diupload
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }
}
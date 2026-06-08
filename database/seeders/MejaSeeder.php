<?php

namespace Database\Seeders;

use App\Models\Meja; // Pastikan baris impor model ini ada
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Perulangan dari 1 sampai 10
        for ($i = 1; $i <= 10; $i++) {
            Meja::create([
                'nomor_meja' => 'Meja ' . $i,
                'jenis_meja' => '9 Feet Standard',
                'harga_per_jam' => 50000,
                'status' => 'kosong'
            ]);
        }
    }
}
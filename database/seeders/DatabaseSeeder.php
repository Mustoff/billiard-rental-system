<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pastikan baris di bawah ini ada dan TIDAK diberi tanda komentar (//)
        $this->call([
            MejaSeeder::class,
        ]);
    }
}
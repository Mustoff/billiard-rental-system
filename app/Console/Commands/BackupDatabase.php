<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    /**
     * Nama perintah yang akan diketik di terminal
     */
    protected $signature = 'db:backup';

    /**
     * Deskripsi perintah saat dicek di list artisan
     */
    protected $description = 'Melakukan backup database rental biliar menjadi file .sql secara otomatis';

    /**
     * Eksekusi logika backup
     */
    public function handle()
    {
        // 1. Ambil nama file unik berdasarkan tanggal hari ini
        $filename = "backup-billiard-" . now()->format('Y-m-d_H-i-s') . ".sql";
        
        // 2. Tentukan jalur penyimpanan di dalam folder proyek (storage/app/backups/)
        $storagePath = storage_path("app/backups");
        
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $filePath = $storagePath . DIRECTORY_SEPARATOR . $filename;

        // 3. Ambil konfigurasi database dari file .env secara otomatis
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host     = env('DB_HOST', '127.0.0.1');

        // 4. Susun perintah command line mysqldump bawaan MySQL/Laragon
        // Jika password ada raises pasang flag -p, jika kosong jangan dipasang
        $passwordParam = $password ? "-p" . escapeshellarg($password) : "";
        
        $command = sprintf(
            'mysqldump -h %s -u %s %s %s > %s',
            escapeshellarg($host),
            escapeshellarg($username),
            $passwordParam,
            escapeshellarg($database),
            escapeshellarg($filePath)
        );

        // 5. Jalankan perintah di sistem latar belakang Windows
        $output = NULL;
        $resultCode = NULL;
        exec($command, $output, $resultCode);

        // 6. Beri laporan status sukses/gagal di terminal
        if ($resultCode === 0) {
            $this->info("⚡ Sukses! Database berhasil dicadangkan dengan nama: {$filename}");
            $this->info("📂 Lokasi: storage/app/backups/");
        } else {
            $this->error("❌ Gagal melakukan backup! Pastikan path 'mysqldump' terdaftar di Environment Variables Windows / Laragon kamu.");
        }
    }
}
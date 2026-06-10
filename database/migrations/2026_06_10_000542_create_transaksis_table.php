<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            // Menghubungkan ke tabel pelanggans
            $table->foreignId('pelanggan_id')->constrained()->cascadeOnDelete();

            // Menghubungkan ke tabel mejas
            $table->foreignId('meja_id')->constrained()->cascadeOnDelete();

            $table->datetime('jam_mulai');
            
            // Diubah menjadi NOT NULL (wajib diisi di awal karena waktu selesai sudah dihitung saat bayar di muka)
            $table->datetime('jam_selesai'); 

            // Diubah menjadi NOT NULL (durasi sewa ditentukan di awal, misal: 60 menit atau 120 menit)
            $table->integer('durasi_menit'); 

            // Diubah menjadi NOT NULL (tarif per jam meja x durasi, langsung dibayar di muka)
            $table->integer('total_bayar'); 

            // Status bermain atau selesai
            $table->enum('status', ['bermain', 'selesai'])->default('bermain');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

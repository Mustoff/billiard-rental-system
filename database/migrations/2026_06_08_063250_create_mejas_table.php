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
            Schema::create('mejas', function (Blueprint $table) {
                $table->id(); // id
                $table->string('nomor_meja')->unique(); // nomor_meja (unik agar tidak kembar, misal: Meja 01)
                $table->string('jenis_meja'); // jenis_meja (misal: Sembilan Kaki / Biasa)
                $table->integer('harga_per_jam'); // harga_per_jam (menggunakan angka bulat)
                
                // status dengan pilihan: kosong, dipakai, maintenance. Defaultnya adalah 'kosong'
                $table->enum('status', ['kosong', 'dipakai', 'maintenance'])->default('kosong'); 
                
                $table->timestamps(); // created_at dan updated_at
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mejas');
    }
};

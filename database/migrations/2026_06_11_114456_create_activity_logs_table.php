<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Siapa kasir yang bertindak
            $table->string('aktivitas'); // Judul aksi, misal: "Buka Meja", "Stop Billing"
            $table->text('deskripsi'); // Detail pesan, misal: "Kasir Umar membuka Meja 03 untuk Pelanggan Andi"
            $table->string('ip_address')->nullable(); // Melacak komputer kasir mana yang akses
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
};

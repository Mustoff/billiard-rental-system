<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Pastikan semua kolom di bawah ini diizinkan untuk di-update massal
    protected $fillable = [
        'pelanggan_id', 
        'meja_id', 
        'jam_mulai', 
        'jam_selesai', 
        'durasi_menit', 
        'total_bayar', 
        'status' // <-- PASTIKAN BARIS INI ADA
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }
}
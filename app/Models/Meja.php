<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    // Daftarkan kolom yang boleh diisi lewat form
    protected $fillable = ['nomor_meja', 'jenis_meja', 'harga_per_jam', 'status'];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'aktivitas',
        'deskripsi',
        'ip_address'
    ];

    // Relasi untuk mengetahui siapa User yang melakukan aktivitas ini
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
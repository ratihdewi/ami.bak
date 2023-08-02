<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarHadir extends Model
{
    use HasFactory;

    protected $fillable = [
        'beritaacara_id',
        'posisi',
        'namapeserta',
        'eSign',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function beritaacara()
    {
        return $this->belongsTo(BeritaAcara::class);
    }
}

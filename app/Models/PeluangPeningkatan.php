<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeluangPeningkatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'beritaacara_id',
        'aspek',
        'kelebihan',
        'peningkatan',
    ];

    public function beritaacara()
    {
        return $this->belongsTo(BeritaAcara::class);
    }
}

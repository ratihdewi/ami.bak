<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokSahih extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokSahih',
        'pertanyaan_id',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class); 
    }
}



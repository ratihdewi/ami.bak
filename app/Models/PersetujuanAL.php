<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanAL extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan_id',
        'posisi',
        'nama',
        'eSign',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeadlineTindakanKoreksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tindakankoreksi_id',
        'penandatangan',
        'tgl_mulaipenandatangan',
        'batas_penandatanganan',
        'peruntukan',
    ];

    protected $dates = ['tgl_mulaipenandatangan', 'batas_penandatanganan'];

    public function tindakankoreksi()
    {
        return $this->belongsTo(TindakanKoreksi::class);
    }
}

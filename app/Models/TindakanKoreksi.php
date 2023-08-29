<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanKoreksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan_id',
        'noPTK',
        'akarPenyebab',
        'batasPengisian0',
        'batasPengisian1',
        'auditor',
    ];

    protected $dates = [
        'batasPengisian0',
        'batasPengisian1'
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}

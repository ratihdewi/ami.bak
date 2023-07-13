<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokSahih extends Model
{
    use HasFactory;

    protected $table = 'dok_sahihs';
    // protected $fillable = '_token';

    protected $fillable = [
        'dokSahih',
        'pertanyaan_id',
        'namaFile',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class); 
    }
}



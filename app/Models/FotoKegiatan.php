<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'auditee_id',
        'namaFile'
    ];


    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class); 
    }
}

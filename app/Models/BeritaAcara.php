<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $fillable = [ 'auditee_id' ];

    // public function pertanyaan()
    // {
    //     return $this->hasMany(Pertanyaan::class);
    // }

    public function auditee()
    {
        return $this->belongsTo(Auditee::class);
    }

    public function daftarhadir()
    {
        return $this->hasMany(DaftarHadir::class);
    }

    public function peluangpeningkatan()
    {
        return $this->hasMany(PeluangPeningkatan::class);
    }

    public function dokumenBA_AMI()
    {
        return $this->hasMany(DokBA_AMI::class);
    }
}

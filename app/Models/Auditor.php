<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Auditor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'user_id',
        'nip',
        'program_studi',
        'fakultas',
        'noTelepon',
        'tgl_mulai',
        'tgl_berakhir',
        'tahunperiode0',
        'tahunperiode',
    ];
    // protected $guarded = [];

    public function daftartilik()
    {
        return $this->hasMany(DaftarTilik::class);
    }

    public function jadwalaudit()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function daftarhadir()
    {
        return $this->hasMany(DaftarHadir::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

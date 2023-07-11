<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'program_studi',
        'fakultas',
        'noTelepon',
        'tgl_mulai',
        'tgl_berakhir',
    ];
    // protected $guarded = [];

    public function dartartilik()
    {
        return $this->hasMany(DaftarTilik::class);
    }

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function daftarhadir()
    {
        return $this->hasMany(DaftarHadir::class);
    }
}

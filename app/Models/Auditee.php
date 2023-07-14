<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditee extends Model
{
    protected $fillable = [
        'unit_kerja',
        'ketua_auditee',
        'jabatan_ketua_auditee',
        'ketua_auditor',
        'anggota_auditor',
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

    public function beritaacara()
    {
        return $this->hasOne(BeritaAcara::class);
    }

    public function daftarhadir()
    {
        return $this->hasOne(DaftarHadir::class);
    }
}

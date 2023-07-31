<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditee extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'unit_kerja',
        'ketua_auditee',
        'jabatan_ketua_auditee',
        'ketua_auditor',
        'anggota_auditor',
        'anggota_auditor2',
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

    public function beritaacara()
    {
        return $this->hasOne(BeritaAcara::class);
    }

    public function daftarhadir()
    {
        return $this->hasOne(DaftarHadir::class);
    }

    public function doklampiran()
    {
        return $this->hasMany(DokLampiran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

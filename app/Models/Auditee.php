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
}

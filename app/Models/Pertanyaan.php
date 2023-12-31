<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'daftartilik_id',
        'auditee_id',
        'auditor_id',
        'butirStandar',
        'nomorButir',
        'targetStandar',
        'indikatormutu',
        'referensi',
        'keterangan',
        'pertanyaan',
        'responAuditee',
        'responAuditor',
        'inisialAuditor',
        'skorAuditor',
        'Kategori',
        'narasiPLOR',
        'approvalAuditee',
        'approvalAuditor',
    ];

    public function daftartilik()
    {
        return $this->belongsTo(DaftarTilik::class); 
    }

    public function auditee()
    {
        return $this->belongsTo(Auditee::class); 
    }

    public function t_auditor()
    {
        return $this->belongsTo(Auditor::class); 
    }

    public function dokSahih()
    {
        return $this->hasMany(DokSahih::class); 
    }

    public function fotoKegiatan()
    {
        return $this->hasMany(FotoKegiatan::class); 
    }

    public function persetujuanal()
    {
        return $this->hasMany(PersetujuanAL::class);
    }

    public function tindakankoreksi()
    {
        return $this->belongsTo(TindakanKoreksi::class);
    }
}

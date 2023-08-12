<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokBA_AMI extends Model
{
    use HasFactory;

    protected $fillable = [
        'beritaacara_id',
        'auditee_id',
        'judulDokumen',
        'kodeDokumen',
        'tgl_revisi',
        'tgl_berlaku',
        'revisiKe',
    ];

    protected $dates = ['tgl_revisi', 'tgl_berlaku'];

    public function beritaacara()
    {
        return $this->belongsTo(BeritaAcara::class);
    }

    public function doklampiran()
    {
        return $this->belongsTo(DokLampiran::class);
    }

    public function auditee()
    {
        return $this->belongsTo(Auditee::class);
    }
}

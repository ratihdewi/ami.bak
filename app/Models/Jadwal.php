<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'auditee',
        'auditor',
        'th_ajaran1',
        'th_ajaran2',
        'tempat',
        'hari_tgl',
        'waktu',
        'kegiatan',
    ];

    protected $dates = ['hari_tgl'];
}

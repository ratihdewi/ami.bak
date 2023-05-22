<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'auditee',
        'auditor',
        'tempat',
        'hari_tgl',
        'waktu',
        'kegiatan',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAMI extends Model
{
    use HasFactory;

    protected $fillable = [
        'th_ajaran1',
        'th_ajaran2',
        'kegiatan',
        'subkegiatan',
        'tgl_mulai',
        'tgl_berakhir',
    ];

    protected $dates = ['tgl_mulai', 'tgl_berakhir'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunPeriode extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tahunperiode1',
        'tahunperiode2',
        'tgl_mulai',
        'tgl_berakhir',
        'keterangan',
    ];

    protected $dates = ['tgl_mulai', 'tgl_berakhir'];
}

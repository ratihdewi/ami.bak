<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanBA extends Model
{
    use HasFactory;

    protected $fillable = [
        'beritaacara_id',
        'posisi',
        'nama',
        'eSign'
    ];
}

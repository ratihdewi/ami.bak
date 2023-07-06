<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'program_studi',
        'fakultas',
        'noTelepon',
        'tgl_mulai',
        'tgl_berakhir',
    ];
    // protected $guarded = [];

    public function dartarTilik()
    {
        return $this->hasMany(DartarTilik::class);
    }

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }
}

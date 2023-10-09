<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanKoreksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan_id',
        'noPTK',
        'akarPenyebab',
        'statusakarpenyebab',
        'rencanaTindakan',
        'statusrencanatindakan',
        'tinjauanEfektivitas',
        'statustinjauan',
        'persentaseSelesai',
        'statusPenyelesaian',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    public function deadlineptk()
    {
        return $this->hasMany(DeadlineTindakanKoreksi::class);
    }
}

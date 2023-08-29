<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinjauEfektivitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'tindakankoreksi_id',
        'tinjauEfektivitas',
        'status',
        'persentaseSelesai',
        'batasPengisian0',
        'batasPengisian1',
    ];

    protected $dates = ['batasPengisian0', 'batasPengisian1'];

    public function tindakankoreksi()
    {
        return $this->belongsTo(TindakanKoreksi::class);
    }
}

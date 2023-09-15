<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Auditor extends Model
{
    use HasFactory;

    protected $table = 'auditors';

    protected $fillable = [
        'nama',
        'user_id',
        'nip',
        'program_studi',
        'fakultas',
        'noTelepon',
        'tgl_mulai',
        'tgl_berakhir',
        'tahunperiode0',
        'tahunperiode',
    ];
    // protected $guarded = [];

    protected $dates = ['tgl_mulai', 'tgl_berakhir'];

    public function setTglMulaiAttribute($value)
    {
        $this->attributes['tgl_mulai'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getTglMulaiAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['tgl_mulai'])->format('l, d M Y');
    }

    public function setTglBerakhirAttribute($value)
    {
        $this->attributes['tgl_berakhir'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getTglBerakhirAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['tgl_berakhir'])->format('l, d M Y');
    }

    public function daftartilik()
    {
        return $this->hasMany(DaftarTilik::class);
    }

    public function jadwalaudit()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function daftarhadir()
    {
        return $this->hasMany(DaftarHadir::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

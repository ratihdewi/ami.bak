<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'sesiKe',
        'waktuMulai',
        'waktuSelesai',
    ];

    protected $dates = ['waktuMulai', 'waktuSelesai'];

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}

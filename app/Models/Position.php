<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'unitkerja_id',
        'position',
    ];

    public function unitkerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }
}

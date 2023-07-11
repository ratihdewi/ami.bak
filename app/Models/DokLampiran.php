<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokLampiran extends Model
{
    use HasFactory;

    public function dokBA_AMI()
    {
        return $this->hasMany(DokBA_AMI::class);
    }
}

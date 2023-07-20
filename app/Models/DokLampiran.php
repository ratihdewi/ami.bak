<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokLampiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'auditee_id',
        'namaDokumen',
        'kodeDokumen',
        'dokumen',
    ];

    public function auditee()
    {
        return $this->belongsTo(Auditee::class);
    }

    public function dokBA_AMI()
    {
        return $this->hasMany(DokBA_AMI::class);
    }
}

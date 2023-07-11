<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarHadir extends Model
{
    use HasFactory;

    public function auditee()
    {
        return $this->belongTo(Auditee::class);
    }

    public function auditor()
    {
        return $this->belongTo(Auditor::class);
    }

    public function beritaacara()
    {
        return $this->belongTo(BeritaAcara::class);
    }
}

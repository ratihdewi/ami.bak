<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaAuditee extends Model
{
    use HasFactory;

    protected $fillable = [
        "auditee_id",
        "user_id",
        "anggota_auditee",
        "editor",
        "posisi",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function auditee()
    {
        return $this->hasMany(Auditee::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarTilik extends Model
{
    use HasFactory;

    protected $fillable = [
        'auditee_id',
        'auditor',
        'area',
        'tempat',
        'tgl_pelaksanaan',
        'bataspengisianRespon'
    ];

    protected $dates = ['tgl_pelaksanaan', 'bataspengisianRespon'];

     public function auditee()
    {
        return $this->belongsTo(Auditee::class); } }

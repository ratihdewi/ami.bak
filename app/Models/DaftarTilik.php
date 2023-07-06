<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarTilik extends Model
{
    use HasFactory;

    protected $fillable = [
        'auditee_id',
        'auditor_id',
        'area',
        'tempat',
        'tgl_pelaksanaan',
        'bataspengisianRespon'
    ];

    protected $dates = ['tgl_pelaksanaan', 'bataspengisianRespon'];

    public function auditee()
    {
        return $this->belongsTo(Auditee::class); 
    }
    public function auditor()
    {
        return $this->belongsTo(Auditor::class); 
    }
    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class); 
    }  
}

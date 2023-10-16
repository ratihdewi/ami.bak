<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenResmi extends Model
{
    use HasFactory;

    protected $fillable = [
        'folderdokresmi_id',
        'fileName',
        'file',
        'owner',
    ];

    public function folderdokresmi()
    {
        return $this->belongsTo(FolderDokumenResmi::class);
    }
}

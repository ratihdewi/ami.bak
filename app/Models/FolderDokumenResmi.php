<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolderDokumenResmi extends Model
{
    use HasFactory;

    protected $fillable = [
        'folderName',
        'owner',
    ];

    public function filedokresmi()
    {
        return $this->hasMany(DokumenResmi::class);
    }
}

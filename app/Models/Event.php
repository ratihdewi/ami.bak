<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
      'title', 'start', 'end', 'penginput', 'session', 'peran',
    ]; 
    
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}

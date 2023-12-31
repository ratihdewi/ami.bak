<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'name',
        'email',
        'password',
        'unitkerja_id',
        'unitkerja_id2',
        'unitkerja_id3',
        'username',
        'role_id',
        'jabatan',
        'jabatan2',
        'jabatan3',
        'peran',
        'noTelepon',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function daftarhadir()
    {
        return $this->hasMany(DaftarHadir::class);
    }

    public function auditor()
    {
        return $this->hasMany(Auditor::class);
    }

    public function auditee()
    {
        return $this->hasMany(Auditee::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function unitkerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function anggotaauditee()
    {
        return $this->hasMany(AnggotaAuditee::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'nip',
        'jabatan',
        'pangkat_id',
        'bidang_id',
        'no_hp',
        'email_verified_at',
        'password',
        'role',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
}

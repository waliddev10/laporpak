<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPenugasan extends Model
{

    protected $table = 'user_penugasan';

    protected $fillable = [
        'penugasan_id',
        'user_id'
    ];
}

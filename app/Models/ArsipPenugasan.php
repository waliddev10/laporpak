<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipPenugasan extends Model
{

    protected $table = 'arsip_penugasan';

    protected $fillable = [
        'nama',
        'keterangan',
        'penugasan_id',
        'file'
    ];
}

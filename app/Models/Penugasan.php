<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{

    protected $table = 'penugasan';

    protected $fillable = [
        'nama',
        'tgl_mulai',
        'tgl_selesai',
        'keterangan',
        'lokasi',
        'jenis_penugasan_id',
        'kategori_penugasan_id',
        'skpd_id'
    ];
}

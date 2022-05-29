<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Esamsat extends Model
{
    protected $table = 'esamsat';

    protected $fillable = [
        'jenis_pkb_id',
        'tgl_cetak',
        'tgl_bayar',
        'no_skpd',
        'awalan_no_pol',
        'no_pol',
        'akhiran_no_pol',
        'nilai_pokok',
        'nilai_denda',
        'payment_point_id',
        'wilayah_id',
        'kasir_id'
    ];
}

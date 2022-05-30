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
        'kasir_id',
        'status_esamsat',
        'kasir_pembayaran_id',
    ];

    public function jenis_pkb()
    {
        return $this->belongsTo(JenisPkb::class);
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function kasir()
    {
        return $this->belongsTo(Kasir::class);
    }

    public function kasir_pembayaran()
    {
        return $this->belongsTo(KasirPembayaran::class);
    }
}

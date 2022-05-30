<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasirPembayaran extends Model
{
    protected $table = 'kasir_pembayaran';

    protected $fillable = [
        'nama'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentPoint extends Model
{
    protected $table = 'payment_point';

    protected $fillable = [
        'nama',
        'alamat'
    ];
}

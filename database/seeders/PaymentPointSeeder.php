<?php

namespace Database\Seeders;

use App\Models\PaymentPoint;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return PaymentPoint::create([
            'nama' => 'Payment Point Waru',
            'alamat' => 'Jalan Provinsi KM. 4,5 Penajam',
            'created_at' => Carbon::now()->format('Y-m-d'),
            'updated_at' => Carbon::now()->format('Y-m-d')
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\JenisPenugasan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JenisPenugasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return JenisPenugasan::insert([
            [
                'nama' => 'DL - Dinas Luar',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'DK - Dalam Kota',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}

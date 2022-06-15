<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SkpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Bidang::insert([
            [
                'nama' => 'Dinas Lingkungan Hidup',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Dinas Kehutanan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}

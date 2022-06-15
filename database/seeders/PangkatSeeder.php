<?php

namespace Database\Seeders;

use App\Models\Pangkat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Pangkat::insert([
            [
                'nama' => 'PPNPN',
                'golongan' => '-',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pengatur',
                'golongan' => 'II/c',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pengatur Tingkat I',
                'golongan' => 'II/d',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}

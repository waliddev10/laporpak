<?php

namespace Database\Seeders;

use App\Models\KotaPenandatangan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KotaPenandatanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return KotaPenandatangan::insert([
            [
                'nama' => 'Penajam',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
        ]);
    }
}

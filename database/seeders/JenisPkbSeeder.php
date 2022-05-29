<?php

namespace Database\Seeders;

use App\Models\JenisPkb;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JenisPkbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return JenisPkb::insert([
            [
                'nama' => 'Roda 2',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
            [
                'nama' => 'Roda 4',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
        ]);
    }
}

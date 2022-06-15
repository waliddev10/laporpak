<?php

namespace Database\Seeders;

use App\Models\JabatanTim;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JabatanTimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return JabatanTim::insert([
            [
                'nama' => 'Penanggungjawab',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pengendali Teknis',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Ketua Tim',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Anggota Tim',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}

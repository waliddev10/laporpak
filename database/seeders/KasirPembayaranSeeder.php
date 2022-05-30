<?php

namespace Database\Seeders;

use App\Models\KasirPembayaran;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KasirPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return KasirPembayaran::insert([
            [
                'nama' => 'Pos',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
            [
                'nama' => 'Mandiri',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
            [
                'nama' => 'Tokopedia',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
            [
                'nama' => 'Indomaret',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\TanggalLibur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TanggalLiburSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return TanggalLibur::insert([
            [
                'tgl' => '2022-01-01',
                'nama' => 'Tahun Baru 2022 Masehi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-02-01',
                'nama' => 'Tahun Baru Imlek 2573',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-02-28',
                'nama' => 'Isra Mi\'raj Nabi Muhammad SAW',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-03-03',
                'nama' => 'Hari Suci Nyepi Tahun Baru Saka 1944',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-04-15',
                'nama' => 'Wafat Isa Al Masih',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-05-01',
                'nama' => 'Hari Buruh Internasional',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-05-02',
                'nama' => 'Hari Raya Idul Fitri 1443 Hijriah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-05-03',
                'nama' => 'Hari Raya Idul Fitri 1443 Hijriah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-05-16',
                'nama' => 'Hari Raya Waisak 2566 BE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-05-26',
                'nama' => 'Kenaikan Isa Al Masih',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-06-01',
                'nama' => 'Hari Lahir Pancasila',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-07-09',
                'nama' => 'Hari Raya Idul Adha 1443 Hijriah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-07-30',
                'nama' => 'Tahun Baru Islam 1444 Hijriah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-08-17',
                'nama' => 'Hari Kemerdekaan Republik Indonesia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-10-08',
                'nama' => 'Maulid Nabi Muhammad SAW',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'tgl' => '2022-12-25',
                'nama' => 'Hari Raya Natal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Penandatangan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PenandatanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Penandatangan::insert([
            [
                'nama' => 'Muhammad Donny Dermawan, A.Md.Pnl.',
                'jabatan' => 'Pengelola Layanan Operasional',
                'golongan' => 'II/c',
                'pangkat' => 'Pengatur',
                'nip' => '19991105 202201 1 002',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
            [
                'nama' => 'Donny Marisya, S.E.',
                'jabatan' => 'Kasi. Pendataan & Penetapan',
                'golongan' => 'IV/a',
                'pangkat' => 'Pembina',
                'nip' => '19760201 200212 1 009',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
            [
                'nama' => 'H. Arifin, S.Sos.',
                'jabatan' => 'Kepala UPTD',
                'golongan' => 'IV/a',
                'pangkat' => 'Pembina',
                'nip' => '19661104 199002 1 002',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d')
            ],
        ]);
    }
}

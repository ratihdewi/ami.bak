<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwals')->insert([
            'auditee' => 'Direktorat IT',
            'auditor' => 'Karsyn Stevenson',
            'tempat' => 'Ketua Program Studi Ilmu Komputer',
            'hari_tgl' => 'Teknik Perminyakan',
            'waktu' =>'Thalia Collier',
            'kegiatan' =>'Thalia Collier',
        ]);
    }
}

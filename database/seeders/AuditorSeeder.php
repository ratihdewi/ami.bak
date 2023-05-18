<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auditors')->insert([
            'nama' => 'Centurion Sherman',
            'nip' => '119234',
            'program_studi' => 'Teknik Perminyakan',
            'fakultas' => 'Teknologi Eksplorasi dan Produksi',
            'noTelepon' => '0856781234',
            'tgl_mulai' => '2023-05-19',
            'tgl_berakhir' => '2023-05-31'
        ]);
    }
}

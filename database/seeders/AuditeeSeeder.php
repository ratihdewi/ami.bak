<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auditees')->insert([
            'unit_kerja' => 'Direktorat IT',
            'ketua_auditee' => 'Karsyn Stevenson',
            'jabatan_ketua_auditee' => 'Ketua Program Studi Ilmu Komputer',
            'ketua_auditor' => 'Chintya Collier',
            'anggota_auditor' =>'Thalia Collier'
        ]);
    }
}

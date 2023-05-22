<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spm = User::create([
            'name' => 'SPM Role',
            'email' => 'spm@role.test',
            'password' => bcrypt('SPM12345'),
            'unit_kerja' => 'Program Studi Ilmu Komputer',
            'username' => 'r.spm',
            'role' => 'spm',
            'jabatan' => 'kaprodi',
        ]);
         
        $spm->assignRole('spm');

        $auditor = User::create([
            'name' => 'Auditor Role',
            'email' => 'auditor@role.test',
            'password' => bcrypt('Auditor123'),
            'unit_kerja' => 'Fakultas Sains dan Ilmu Komputer',
            'username' => 'r.auditor',
            'role' => 'auditor',
            'jabatan' => 'dekan',
        ]);

        $auditor->assignRole('auditor');

        $auditee = User::create([
            'name' => 'Auditee Role',
            'email' => 'auditee@role.test',
            'password' => bcrypt('Auditee123'),
            'unit_kerja' => 'Direktorat IT',
            'username' => 'r.auditee',
            'role' => 'auditee',
            'jabatan' => 'dekan',
        ]);

        $auditee->assignRole('auditee');
    }
}

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
            'nip' => '119012',
            'name' => 'Ayu Jelita',
            'email' => 'spm@role.test',
            'password' => bcrypt('SPM12345'),
            'unit_kerja' => 'Program Studi Ilmu Komputer',
            'username' => 'r.spm',
            'role' => 'SPM',
            'jabatan' => 'Manager SPM',
            'noTelepon' => '081234567810',
        ]);
         
        $spm->assignRole('SPM');

        $auditor = User::create([
            'nip' => '119022',
            'name' => 'Arif Putra S',
            'email' => 'auditor@role.test',
            'password' => bcrypt('Auditor123'),
            'unit_kerja' => 'Fakultas Sains dan Ilmu Komputer',
            'username' => 'r.auditor',
            'role' => 'User',
            'jabatan' => 'Ketua FSIK',
            'noTelepon' => '082345678901',
        ]);

        $auditor->assignRole('User');

        $auditee = User::create([
            'nip' => '119032',
            'name' => 'Alif Jauhary',
            'email' => 'auditee@role.test',
            'password' => bcrypt('Auditee123'),
            'unit_kerja' => 'Direktorat IT',
            'username' => 'r.auditee',
            'role' => 'User',
            'jabatan' => 'Ketua Prodi',
            'noTelepon' => '089712345634',
        ]);

        $auditee->assignRole('User');
    }
}

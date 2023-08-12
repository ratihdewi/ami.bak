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
            'unitkerja_id' => '1',
            'username' => 'r.spm',
            'role_id' => '1',
            'jabatan' => 'Manager SPM',
            'noTelepon' => '081234567810',
        ]);
         
        $spm->assignRole('SPM');

        $auditor = User::create([
            'nip' => '119022',
            'name' => 'Arif Putra S',
            'email' => 'auditor@role.test',
            'password' => bcrypt('Auditor123'),
            'unitkerja_id' => '16',
            'username' => 'r.auditor',
            'role_id' => '2',
            'jabatan' => 'Ketua FSIK',
            'noTelepon' => '082345678901',
        ]);

        $auditor->assignRole('User');

        $auditee = User::create([
            'nip' => '119032',
            'name' => 'Alif Jauhary',
            'email' => 'auditee@role.test',
            'password' => bcrypt('Auditee123'),
            'unitkerja_id' => '20',
            'username' => 'r.auditee',
            'role_id' => '2',
            'jabatan' => 'Ketua Prodi',
            'noTelepon' => '089712345634',
        ]);

        $auditee->assignRole('User');
    }
}

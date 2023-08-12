<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unitkerjas = [
            ['name' => 'Program Studi Ilmu Komputer'],
            ['name' => 'Program Studi Teknik Kimia'],
            ['name' => 'Program Studi Teknik Mesin'],
            ['name' => 'Program Studi Teknik Logistik'],
            ['name' => 'Program Studi Teknik Elektro'],
            ['name' => 'Program Studi Kimia'],
            ['name' => 'Program Studi Teknik Sipil'],
            ['name' => 'Program Studi Teknik Lingkungan'],
            ['name' => 'Program Studi Komunikasi'],
            ['name' => 'Program Studi Hubungan Internasional'],
            ['name' => 'Program Studi Teknik Geofisika'],
            ['name' => 'Program Studi Teknik Perminyakan'],
            ['name' => 'Program Studi Teknik Geologi'],
            ['name' => 'Program Studi Manajemen'],
            ['name' => 'Program Studi Ekonomi'],
            ['name' => 'Fakultas Sains dan Ilmu Komputer'],
            ['name' => 'Fakultas Teknologi Industri'],
            ['name' => 'Fakultas Perencanaan Infrastruktur'],
            ['name' => 'Fakultas Komunikasi dan Diplomasi'],
            ['name' => 'Fakultas Teknologi Eksplorasi dan Produksi'],
            ['name' => 'Fakultas Ekonomi dan Bisnis'],
            ['name' => 'Direktorat Penelitian dan Pengabdian kepada Masyarakat'],
            ['name' => 'Direktorat Pendidikan'],
            ['name' => 'Direktorat Kemahasiswaan dan Alumni'],
            ['name' => 'Direktorat Sumber Daya Manusia dan Teknologi Informasi'],
        ];

        foreach ($unitkerjas as $unitkerja) {
            UnitKerja::create($unitkerja);
        }
    }
}

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
            ['name' => 'Program Studi Ilmu Komputer', 'fakultas' => 'Fakultas Sains dan Ilmu Komputer'],
            ['name' => 'Program Studi Teknik Kimia', 'fakultas' => 'Fakultas Teknologi Industri'],
            ['name' => 'Program Studi Teknik Mesin', 'fakultas' => 'Fakultas Teknologi Industri'],
            ['name' => 'Program Studi Teknik Logistik', 'fakultas' => 'Fakultas Teknologi Industri'],
            ['name' => 'Program Studi Teknik Elektro', 'fakultas' => 'Fakultas Teknologi Industri'],
            ['name' => 'Program Studi Kimia', 'fakultas' => 'Fakultas Sains dan Ilmu Komputer'],
            ['name' => 'Program Studi Teknik Sipil', 'fakultas' => 'Fakultas Perencanaan Infrastruktur'],
            ['name' => 'Program Studi Teknik Lingkungan', 'fakultas' => 'Fakultas Perencanaan Infrastruktur'],
            ['name' => 'Program Studi Komunikasi', 'fakultas' => 'Fakultas Komunikasi dan Diplomasi'],
            ['name' => 'Program Studi Hubungan Internasional', 'fakultas' => 'Fakultas Komunikasi dan Diplomasi'],
            ['name' => 'Program Studi Teknik Geofisika', 'fakultas' => 'Fakultas Eksplorasi dan Produksi'],
            ['name' => 'Program Studi Teknik Perminyakan', 'fakultas' => 'Fakultas Eksplorasi dan Produksi'],
            ['name' => 'Program Studi Teknik Geologi', 'fakultas' => 'Fakultas Eksplorasi dan Produksi'],
            ['name' => 'Program Studi Manajemen', 'fakultas' => 'Fakultas Ekonomi dan Bisnis'],
            ['name' => 'Program Studi Ekonomi', 'fakultas' => 'Fakultas Ekonomi dan Bisnis'],
            ['name' => 'Fakultas Sains dan Ilmu Komputer', 'fakultas' => 'Fakultas Sains dan Ilmu Komputer'],
            ['name' => 'Fakultas Teknologi Industri', 'fakultas' => 'Fakultas Teknologi Industri'],
            ['name' => 'Fakultas Perencanaan Infrastruktur', 'fakultas' => 'Fakultas Perencanaan Infrastruktur'],
            ['name' => 'Fakultas Komunikasi dan Diplomasi', 'fakultas' => 'Fakultas Komunikasi dan Diplomasi'],
            ['name' => 'Fakultas Teknologi Eksplorasi dan Produksi', 'fakultas' => 'Fakultas Teknologi Eksplorasi dan Produksi'],
            ['name' => 'Fakultas Ekonomi dan Bisnis', 'fakultas' => 'Fakultas Ekonomi dan Bisnis'],
            ['name' => 'Direktorat Penelitian dan Pengabdian kepada Masyarakat', 'fakultas' => 'Direktorat Penelitian dan Pengabdian kepada Masyarakat'],
            ['name' => 'Direktorat Pendidikan', 'fakultas' => 'Direktorat Pendidikan'],
            ['name' => 'Direktorat Kemahasiswaan dan Alumni', 'fakultas' => 'Direktorat Kemahasiswaan dan Alumni'],
            ['name' => 'Direktorat Sumber Daya Manusia dan Teknologi Informasi', 'fakultas' => 'Direktorat Sumber Daya Manusia dan Teknologi Informasi'],
        ];

        foreach ($unitkerjas as $unitkerja) {
            UnitKerja::create($unitkerja);
        }
    }
}

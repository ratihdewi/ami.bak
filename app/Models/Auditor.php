<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Auditor
{
    private static $data_auditor = [
        [
            "no" => "1",
            "nama" => "Alfiana Permata Sari, M.Sc",
            "nip" => "119123",
            "prodi" => "Teknik Perminyakan",
            "fakultas" => "Teknologi Eksplorasi dan Produksi",
            "nomor_telepon" => "082312345678"
        ],
        [
            "no" => "2",
            "nama" => "Nona Merry Merpati Mitan, Ph.D",
            "nip" => "119124",
            "prodi" => "Hubungan Internasional",
            "fakultas" => "Komunikasi dan Diplomasi",
            "nomor_telepon" => "082356781234"
        ]
        ];

        public static function all()
        {
            return self::$data_auditor;
        }
};
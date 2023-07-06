<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use App\Models\Pertanyaan;
use App\Models\DaftarTilik;
use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        $auditee_ = Auditee::all();
        $daftartilik_ = DaftarTilik::all();

        // foreach ($auditee_ as $key => $value) {
        //     dd($value->id);
        // }

        return view('spm/beritaAcara', compact('auditee_', 'daftartilik_'));
    }
    public function tampiltemuanBA()
    {
        $auditee_ = Auditee::all();
        // $pertanyaan_ = Pertanyaan::all();
        $pertanyaan_ = Pertanyaan::where('Kategori', 'OB')->orWhere('Kategori', 'KTS')->get();

        return view('spm/auditeeBA', compact('auditee_', 'pertanyaan_'));
    }

    public function tampilBA_AMI()
    {
        return view('spm/beritaAcaraAMI');
    }

    public function ubahdata()
    {
        return view('spm/ubahDataBA');
    }
}

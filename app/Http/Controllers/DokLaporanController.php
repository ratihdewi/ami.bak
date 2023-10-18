<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use App\Models\TahunPeriode;
use Illuminate\Http\Request;

class DokLaporanController extends Controller
{
    public function index()
    {
        $tahunPeriode = TahunPeriode::where('keterangan', 'Periode Auditee')->get();
        $auditees = Auditee::all();

        return view('spm/laporan-index', compact('tahunPeriode', 'auditees'));
    }

    public function bodyindex()
    {
        return view('spm/laporan-index-home');
    }

    public function showlaporanami()
    {
        return view('spm/laporan-laporanAMI');
    }

    public function showlaporanamidaftarisi()
    {
        return view('spm/laporan-laporanAMI-daftarisi');
    }
}

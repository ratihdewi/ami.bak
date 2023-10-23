<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use App\Models\Pertanyaan;
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

    public function editlaporanamidaftarisi()
    {
        return view('spm/laporan-editlaporan-daftarisi');
    }

    public function showlaporanamikatapengantar()
    {
        return view('spm/laporan-laporanAMI-katapengantar');
    }

    public function editlaporanamikatapengantar()
    {
        return view('spm/laporan-editlaporan-katapengantar');
    }

    public function showlaporanamipendahuluan()
    {
        return view('spm/laporan-laporanAMI-pendahuluan');
    }

    public function editlaporanamipendahuluan()
    {
        return view('spm/laporan-editlaporan-pendahuluan');
    }

    public function showlaporanamitujuanaudit()
    {
        return view('spm/laporan-laporanAMI-tujuanaudit');
    }

    public function editlaporanamitujuanaudit()
    {
        return view('spm/laporan-editlaporan-tujuanaudit');
    }

    public function showlaporanamilingkupaudit()
    {
        return view('spm/laporan-laporanAMI-lingkupaudit');
    }

    public function editlaporanamilingkupaudit()
    {
        return view('spm/laporan-editlaporan-lingkupaudit');
    }

    public function showlaporanamijadwalaudit()
    {
        return view('spm/laporan-laporanAMI-jadwalaudit');
    }

    public function showlaporanamitemuanpositif()
    {
        return view('spm/laporan-laporanAMI-temuanpositif');
    }

    public function editlaporanamitemuanpositif()
    {
        return view('spm/laporan-editlaporan-temuanpositif');
    }

    public function showlaporanamirta()
    {
        return view('spm/laporan-laporanAMI-rta');
    }

    public function editlaporanamirta($auditee_id)
    {
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->where('approvalAuditee', 'Disetujui Auditee')->where('approvalAuditor', 'Disetujui Auditor')->get();
        
        return view('spm/laporan-editlaporan-rta', compact('pertanyaan_'));
    }

    public function showlaporanamipeluangpeningkatan()
    {
        return view('spm/laporan-laporanAMI-peluangpeningkatan');
    }

}

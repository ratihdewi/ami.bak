<?php

namespace App\Http\Controllers;

use PDF;
use Mpdf\Mpdf;
use App\Models\Auditee;
use App\Models\Pertanyaan;
use App\Models\TahunPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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

    public function laporanamipdfcover()
    {
        $data = [
            'coverData' => 'Data Cover',
            'daftarIsiData' => 'Data Daftar Isi',
        ];

        $coverContent = View::make('laporanAMI.cover', $data)->render();
        $daftarIsiContent = View::make('laporanAMI.daftarisi', $data)->render();

        // $pdfCover = PDF::loadHTML($coverContent);
        // $pdfCover->setPaper('A4');
        // $pdfCover->setOption('page-size', 'A4');
        // $pdfCover->setOption('margin-top', 0);
        // $pdfCover->setOption('margin-right', 0);
        // $pdfCover->setOption('margin-bottom', 0);
        // $pdfCover->setOption('margin-left', 0);
        // $pdfCover->setOption('page-width', '210mm');
        // $pdfCover->setOption('page-height', '297mm');
        

        $combinedContent = $coverContent . $daftarIsiContent;

        $pdf = PDF::loadHTML($combinedContent);

        return $pdf->stream('laporanAMI-cover-daftarisi.pdf');
    }
    

}

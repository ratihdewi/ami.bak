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

        return view('spm/laporanAMI/laporan-index', compact('tahunPeriode', 'auditees'));
    }

    public function bodyindex()
    {
        return view('spm/laporanAMI/laporan-index-home');
    }

    public function showlaporanami()
    {
        return view('spm/laporanAMI/laporan-laporanAMI');
    }

    public function showlaporanamidaftarisi()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-daftarisi');
    }

    public function editlaporanamidaftarisi()
    {
        return view('spm/laporanAMI/laporan-editlaporan-daftarisi');
    }

    public function showlaporanamikatapengantar()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-katapengantar');
    }

    public function editlaporanamikatapengantar()
    {
        return view('spm/laporanAMI/laporan-editlaporan-katapengantar');
    }

    public function showlaporanamipendahuluan()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-pendahuluan');
    }

    public function editlaporanamipendahuluan()
    {
        return view('spm/laporanAMI/laporan-editlaporan-pendahuluan');
    }

    public function showlaporanamitujuanaudit()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-tujuanaudit');
    }

    public function editlaporanamitujuanaudit()
    {
        return view('spm/laporanAMI/laporan-editlaporan-tujuanaudit');
    }

    public function showlaporanamilingkupaudit()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-lingkupaudit');
    }

    public function editlaporanamilingkupaudit()
    {
        return view('spm/laporanAMI/laporan-editlaporan-lingkupaudit');
    }

    public function showlaporanamijadwalaudit()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-jadwalaudit');
    }

    public function showlaporanamitemuanpositif()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-temuanpositif');
    }

    public function editlaporanamitemuanpositif()
    {
        return view('spm/laporanAMI/laporan-editlaporan-temuanpositif');
    }

    public function showlaporanamirta()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-rta');
    }

    public function editlaporanamirta($auditee_id)
    {
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->where('approvalAuditee', 'Disetujui Auditee')->where('approvalAuditor', 'Disetujui Auditor')->get();
        
        return view('spm/laporanAMI/laporan-editlaporan-rta', compact('pertanyaan_'));
    }

    public function showlaporanamipeluangpeningkatan()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-peluangpeningkatan');
    }

    public function showlaporanamirekapitulasi()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-rekapitulasi');
    }

    public function editlaporanamirekapitulasi()
    {
        return view('spm/laporanAMI/laporan-editlaporan-rekapitulasi');
    }

    public function showlaporanamikesimpulanaudit()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-kesimpulanaudit');
    }

    public function editlaporanamikesimpulanaudit()
    {
        return view('spm/laporanAMI/laporan-editlaporan-kesimpulanaudit');
    }

    public function showlaporanamilampiran()
    {
        return view('spm/laporanAMI/laporan-laporanAMI-lampiran');
    }

    public function editlaporanamilampiran()
    {
        return view('spm/laporanAMI/laporan-editlaporan-lampiran');
    }

    public function laporanamipdfcover()
    {
        $data = [
            'coverData' => 'Data Cover',
            'daftarIsiData' => 'Data Daftar Isi',
        ];

        $coverContent = View::make('laporanAMI.cover', $data)->render();
        $daftarIsiContent = View::make('laporanAMI.daftarisi', $data)->render();
        $katPengantarContent = View::make('laporanAMI.katapengantar', $data)->render();
        $pendahuluanContent = View::make('laporanAMI.pendahuluan', $data)->render();
        $tujuanAuditContent = View::make('laporanAMI.tujuanaudit', $data)->render();
        $lingkupAuditContent = View::make('laporanAMI.lingkupaudit', $data)->render();
        $jadwalAuditContent = View::make('laporanAMI.jadwalaudit', $data)->render();

        // $pdfCover = PDF::loadHTML($coverContent);
        // $pdfCover->setPaper('A4');
        // $pdfCover->setOption('page-size', 'A4');
        // $pdfCover->setOption('margin-top', 0);
        // $pdfCover->setOption('margin-right', 0);
        // $pdfCover->setOption('margin-bottom', 0);
        // $pdfCover->setOption('margin-left', 0);
        // $pdfCover->setOption('page-width', '210mm');
        // $pdfCover->setOption('page-height', '297mm');
        

        $combinedContent = $coverContent . $daftarIsiContent . $katPengantarContent . $pendahuluanContent . $tujuanAuditContent . $lingkupAuditContent . $jadwalAuditContent;

        $pdf = PDF::loadHTML($combinedContent);
        $pdf->setPaper('A4');
        $pdf->setOption('page-size', 'A4');
        // $pdf->setOption('margin-top', 3);
        // $pdf->setOption('margin-right', 3);
        // $pdf->setOption('margin-bottom', 3);
        // $pdf->setOption('margin-left', 4);
        $pdf->setOption('page-width', '210mm');
        $pdf->setOption('page-height', '297mm');

        return $pdf->stream('laporanAMI-cover-daftarisi.pdf');
    }
    

}

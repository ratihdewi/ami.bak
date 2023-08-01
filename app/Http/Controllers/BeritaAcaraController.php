<?php

namespace App\Http\Controllers;

use QrCode;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Pertanyaan;
use App\Models\BeritaAcara;
use App\Models\DaftarTilik;
use App\Models\DokBA_AMI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        $auditee_ = Auditee::all();
        $daftartilik_ = DaftarTilik::all();
        // $beritaacaras_ = BeritaAcara::where
        

        foreach ($auditee_ as $key => $auditee) {
            
            $beritaacara_ = BeritaAcara::where('auditee_id', $auditee->id)->where('tahunperiode', $auditee->tahunperiode)->get();
            $notExist = BeritaAcara::where('auditee_id', $auditee->id)->where('tahunperiode', $auditee->tahunperiode)->doesntExist();
            
            if ($notExist) {
                BeritaAcara::create([
                    'auditee_id' => $auditee->id,
                    'tahunperiode' =>$auditee->tahunperiode,
                ]);
            }
        }
        // dd($auditee_->beritaacara()->get());
        return view('spm/beritaAcara', compact('auditee_', 'daftartilik_'));
    }

    public function tampiltemuanBA($auditee_id, $tahunperiode)
    {
        $auditee_ = Auditee::all();
        $auditee = Auditee::find($auditee_id);
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee->id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        
        $urlAuditee = url('/auditee-esign/'.$auditee->id);
        $urlAuditor = url('/auditor-esign/'.$auditee->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee); 

        return view('spm/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_', 'qrCodeAuditor', 'qrCodeAuditee'));
    }

    public function auditor_tampiltemuanBA($auditee_id, $tahunperiode)
    {
        $auditee_ = Auditee::all();
        $auditee = Auditee::find($auditee_id);
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();

        $urlAuditee = url('/auditee-esign/'.$auditee->id);
        $urlAuditor = url('/auditor-esign/'.$auditee->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee); 

        return view('auditor/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_', 'qrCodeAuditor', 'qrCodeAuditee'));
    }

    public function auditee_tampiltemuanBA($auditee_id, $tahunperiode)
    {
        $auditee_ = Auditee::all();
        $auditee = Auditee::find($auditee_id);
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();

        $urlAuditee = url('/auditee-esign/'.$auditee->id);
        $urlAuditor = url('/auditor-esign/'.$auditee->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee); 

        return view('auditee/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_', 'qrCodeAuditor', 'qrCodeAuditee'));
    }

    // DOkumen BA AMI
    public function ubahdata()
    {
        return view('spm/ubahDataBA');
    }

    public function indexAuditor()
    {
        $auditor_ = Auditor::where('nama', Auth::user()->name)->get();
        //$daftartilik_ = DaftarTilik::where('auditor_id', $auditor_->id)->get();
        $beritaacara_ = BeritaAcara::all();

        return view('auditor/beritaAcara', compact('auditor_', 'beritaacara_'));
    }

    public function indexAuditee()
    {
        $user_unitkerja = Auth::user()->unit_kerja;
        $auditee_ = Auditee::where('unit_kerja', $user_unitkerja)->get();
        
        $daftartilik_ = DaftarTilik::all();

        return view('auditee/beritaAcara', compact('auditee_', 'daftartilik_'));
    }

    public function generateqrcode()
    {
        return view('spm/BA_qrcode');
    }
}

<?php

namespace App\Http\Controllers;

use QrCode;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\DokBA_AMI;
use App\Models\UnitKerja;
use App\Models\Pertanyaan;
use App\Models\BeritaAcara;
use App\Models\DaftarTilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        $auditee_ = Auditee::all();
        $daftartilik_ = DaftarTilik::all();

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

        return view('spm/beritaAcara', compact('auditee_', 'daftartilik_'));
    }

    public function tampiltemuanBA($auditee_id, $tahunperiode)
    {
        $auditee_ = Auditee::all();
        $auditee = Auditee::find($auditee_id);
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee->id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->where('approvalAuditee', 'Disetujui Auditee')->where('approvalAuditor', 'Disetujui Auditor')->get();
        $pertanyaanall = Pertanyaan::where('auditee_id', $auditee_id)->where('approvalAuditee', 'Disetujui Auditee')->where('approvalAuditor', 'Disetujui Auditor')->get();

        $qrCodeAuditor = [];
        $qrCodeAuditee = [];
        
        foreach ($pertanyaan_ as $key => $pertanyaan) {
            $urlAuditee = url('/auditee-esign/'.$auditee_id.'/'.$pertanyaan->id);
            $urlAuditor = url('/auditor-esign/'.$auditee_id.'/'.$pertanyaan->id);

            array_push($qrCodeAuditor, QrCode::generate($urlAuditor));
            array_push($qrCodeAuditee, QrCode::generate($urlAuditee));
        } 

        return view('spm/auditeeBA', compact('auditee', 'auditee_', 'daftartilik_', 'pertanyaan_', 'qrCodeAuditor', 'qrCodeAuditee', 'pertanyaanall'));
    }

    public function auditor_tampiltemuanBA($auditee_id, $tahunperiode)
    {
        $auditee_ = Auditee::all();
        $auditee = Auditee::find($auditee_id);
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->where('approvalAuditee', 'Disetujui Auditee')->where('approvalAuditor', 'Disetujui Auditor')->get();
        $pertanyaanall = Pertanyaan::where('auditee_id', $auditee_id)->where('approvalAuditee', 'Disetujui Auditee')->where('approvalAuditor', 'Disetujui Auditor')->get();

        $qrCodeAuditor = [];
        $qrCodeAuditee = [];
        
        foreach ($pertanyaan_ as $key => $pertanyaan) {
            $urlAuditee = url('/auditee-esign/'.$auditee->id.'/'.$pertanyaan->id);
            $urlAuditor = url('/auditor-esign/'.$auditee->id.'/'.$pertanyaan->id);

            array_push($qrCodeAuditor, QrCode::generate($urlAuditor));
            array_push($qrCodeAuditee, QrCode::generate($urlAuditee));
        } 

        return view('auditor/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_', 'qrCodeAuditor', 'qrCodeAuditee', 'pertanyaanall'));
    }

    public function auditee_tampiltemuanBA($auditee_id, $tahunperiode)
    {
        $auditee_ = Auditee::all();
        $auditee = Auditee::find($auditee_id);
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->where('approvalAuditee', 'Disetujui Auditee')->where('approvalAuditor', 'Disetujui Auditor')->get();
        $pertanyaanall = Pertanyaan::where('auditee_id', $auditee_id)->where('approvalAuditee', 'Disetujui Auditee')->where('approvalAuditor', 'Disetujui Auditor')->get();

        $qrCodeAuditor = [];
        $qrCodeAuditee = [];
        
        foreach ($pertanyaan_ as $key => $pertanyaan) {
            $urlAuditee = url('/auditee-esign/'.$auditee->id.'/'.$pertanyaan->id);
            $urlAuditor = url('/auditor-esign/'.$auditee->id.'/'.$pertanyaan->id);

            array_push($qrCodeAuditor, QrCode::generate($urlAuditor));
            array_push($qrCodeAuditee, QrCode::generate($urlAuditee));
        } 

        return view('auditee/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_', 'qrCodeAuditor', 'qrCodeAuditee', 'pertanyaanall'));
    }

    // DOkumen BA AMI
    public function ubahdata()
    {
        return view('spm/ubahDataBA');
    }

    public function indexAuditor()
    {
        $auditees = Auditee::where('ketua_auditor', Auth::user()->name)->orWhere('anggota_auditor', Auth::user()->name)->orWhere('anggota_auditor2', Auth::user()->name)->get();
        $beritaacara_ = BeritaAcara::all();

        $auditee_ = Auditee::all();

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

        return view('auditor/beritaAcara', compact('auditees', 'beritaacara_'));
    }

    public function indexAuditee()
    {
        $auditees_ = Auditee::all();

        foreach ($auditees_ as $key => $auditee) {
            
            $beritaacara_ = BeritaAcara::where('auditee_id', $auditee->id)->where('tahunperiode', $auditee->tahunperiode)->get();
            $notExist = BeritaAcara::where('auditee_id', $auditee->id)->where('tahunperiode', $auditee->tahunperiode)->doesntExist();
            
            if ($notExist) {
                BeritaAcara::create([
                    'auditee_id' => $auditee->id,
                    'tahunperiode' =>$auditee->tahunperiode,
                ]);
            }

        }
        $userUnitKerjaIds = [
            Auth::user()->unitkerja_id,
            Auth::user()->unitkerja_id2,
            Auth::user()->unitkerja_id3,
        ];
        
        $userUnitKerjaNames = UnitKerja::whereIn('id', $userUnitKerjaIds)->pluck('name')->toArray();
        
        $isAnggotaAuditee = Auth::user()->anggotaauditee->unique('auditee_id');
        if ($isAnggotaAuditee->isNotEmpty()) {
            $auditee_ = Auditee::whereIn('unit_kerja', $userUnitKerjaNames)
                ->orWhereIn('id', $isAnggotaAuditee->pluck('auditee_id'))
                ->get();
        } else {
            $auditee_ = Auditee::whereIn('unit_kerja', $userUnitKerjaNames)->get();
        }
        
        $daftartilik_ = DaftarTilik::all();

        return view('auditee/beritaAcara', compact('auditee_', 'daftartilik_'));
    }

    public function generateqrcode()
    {
        return view('spm/BA_qrcode');
    }

    public function changePenyetujuBA($id)
    {
        $data = Auditee::find($id);

        return response()->json($data);
    }
}

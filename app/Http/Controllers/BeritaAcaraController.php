<?php

namespace App\Http\Controllers;

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
        

        foreach ($auditee_ as $key => $auditee) {
            
            $beritaacara_ = BeritaAcara::where('auditee_id', $auditee->id)->get();
            $notExist = BeritaAcara::where('auditee_id', $auditee->id)->doesntExist();
            
            if ($notExist) {
                BeritaAcara::create([
                    'auditee_id' => $auditee->id,
                ]);
            } 
        }
        return view('spm/beritaAcara', compact('auditee_', 'daftartilik_'));
    }

    public function tampiltemuanBA($auditee_id)
    {
        $auditee_ = Auditee::all();
        $role_ = Auth::user()->role;
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();

        // dd($pertanyaan_);
        if ($role_ == "SPM") {
            return view('spm/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_'));
        } elseif ($role_ == "Auditor") {
            return view('auditor/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_'));
        } elseif ($role_ == "Auditee") {
            return view('auditee/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_'));
        }
        
        
    }

    // DOkumen BA AMI

    public function ubahDaftarHadir()
    {
        // $ba_ = BeritaAcara::where('auditee_id', $auditee_id)->get();
        return view('spm/formDaftarHadir');
    }

    public function ubahdata()
    {
        return view('spm/ubahDataBA');
    }

    public function indexAuditor()
    {
        $auditee_ = Auditee::all();
        $daftartilik_ = DaftarTilik::all();
        $beritaacara_ = BeritaAcara::all();
        
        foreach ($auditee_ as $key => $auditee) {
            $auditee_id = $auditee->id;
            $beritaacara = new BeritaAcara([
                'auditee_id' => $auditee_id,
            ]);
            $beritaacara->save();
        }

        return view('auditor/beritaAcara', compact('auditee_', 'daftartilik_', 'beritaacara_'));
    }

    public function indexAuditee()
    {
        $user_unitkerja = Auth::user()->unit_kerja;
        $auditee_ = Auditee::where('unit_kerja', $user_unitkerja)->get();
        
        $daftartilik_ = DaftarTilik::all();

        return view('auditee/beritaAcara', compact('auditee_', 'daftartilik_'));
    }
}

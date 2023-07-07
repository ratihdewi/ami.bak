<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Pertanyaan;
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

        return view('spm/beritaAcara', compact('auditee_', 'daftartilik_'));
    }
    public function tampiltemuanBA($auditee_id)
    {
        $auditee_ = Auditee::all();
        $role_ = Auth::user()->role;
        // $pertanyaan_ = Pertanyaan::all();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();

        //dd($pertanyaan_);
        if ($role_ == "SPM") {
            return view('spm/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_'));
        } elseif ($role_ == "Auditor") {
            return view('auditor/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_'));
        } elseif ($role_ == "Auditee") {
            return view('auditee/auditeeBA', compact('auditee_', 'daftartilik_', 'pertanyaan_'));
        }
        
        
    }

    public function tampilBA_AMI()
    {
        return view('spm/beritaAcaraAMI');
    }

    public function ubahdata()
    {
        return view('spm/ubahDataBA');
    }

    public function indexAuditor()
    {
        $user_nama = Auth::user()->name;
        $auditor_ = Auditor::where('nama', $user_nama)->get();
        
        $daftartilik_ = DaftarTilik::all();

        return view('auditor/beritaAcara', compact('auditor_', 'daftartilik_'));
    }

    public function indexAuditee()
    {
        $user_unitkerja = Auth::user()->unit_kerja;
        $auditee_ = Auditee::where('unit_kerja', $user_unitkerja)->get();
        
        $daftartilik_ = DaftarTilik::all();

        return view('auditee/beritaAcara', compact('auditee_', 'daftartilik_'));
    }
}

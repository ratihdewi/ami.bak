<?php

namespace App\Http\Controllers;

use QrCode;
use App\Models\Auditee;
use App\Models\Pertanyaan;
use App\Models\BeritaAcara;
use App\Models\DaftarTilik;
use Illuminate\Http\Request;
use App\Models\TindakanKoreksi;

class TindakanKoreksiController extends Controller
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

        return view('spm/tindakanKoreksi', compact('auditee_', 'daftartilik_'));
    }

    public function daftarTemuan($auditee_id, $tahunperiode)
    {
        $auditee_ = Auditee::all();
        $auditee = Auditee::find($auditee_id);
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee->id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();

        $qrCodeAuditor = [];
        $qrCodeAuditee = [];
        $noPTK = [];
        $no = 1;
        
        foreach ($pertanyaan_ as $key => $pertanyaan) {
            $urlAuditee = url('/auditee-esign/'.$auditee->id.'/'.$pertanyaan->id);
            $urlAuditor = url('/auditor-esign/'.$auditee->id.'/'.$pertanyaan->id);

            array_push($noPTK, $no++);

            array_push($qrCodeAuditor, QrCode::generate($urlAuditor));
            array_push($qrCodeAuditee, QrCode::generate($urlAuditee));
        }

        return view('spm/temuanTindakanKoreksi', compact('auditee', 'auditee_', 'daftartilik_', 'pertanyaan_', 'qrCodeAuditor', 'qrCodeAuditee', 'noPTK'));
    }

    public function tampilForm($pertanyaan_id, $noPTK)
    {
        $auditee_ = Auditee::all();
        $pertanyaans = Pertanyaan::find($pertanyaan_id);

        return view('spm/formTindakanKoreksi', compact('auditee_', 'pertanyaans', 'noPTK'));
    }

    public function store(Request $request, $noPTK)
    {
        $isAlreadyExist = TindakanKoreksi::where('noPTK', $request->noPTK)->where('pertanyaan_id', $request->pertanyaan_id)->exists();
        $tindakanKoreksi = TindakanKoreksi::find($noPTK);
        // dd($isAlreadyExist);
        
        // update tindakan koreksi
        if ($isAlreadyExist) {
            // dd($request->all());
            $tindakanKoreksi->update([
                'akarPenyebab' => $request->akarPenyebab,
                'auditor' => $request->auditor,
            ]);
            $tindakanKoreksi->save();
        } else {
            $tindakanKoreksi = new TindakanKoreksi;
            $tindakanKoreksi->pertanyaan_id = $request->pertanyaan_id;
            $tindakanKoreksi->noPTK = $noPTK;
            $tindakanKoreksi->auditor = $request->auditor;
            $tindakanKoreksi->batasPengisian0 = $request->batasPengisian0;
            $tindakanKoreksi->batasPengisian1 = $request->batasPengisian1;
            $tindakanKoreksi->akarPenyebab = $request->akarPenyebab;
            $tindakanKoreksi->save();
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}

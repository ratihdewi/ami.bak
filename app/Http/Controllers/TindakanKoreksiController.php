<?php

namespace App\Http\Controllers;

use QrCode;
use Carbon\Carbon;
use App\Models\Auditee;
use App\Models\Pertanyaan;
use App\Models\BeritaAcara;
use App\Models\DaftarTilik;
use Illuminate\Http\Request;
use App\Models\TindakanKoreksi;
use App\Models\DeadlineTindakanKoreksi;

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
        $isAlreadyPTK = TindakanKoreksi::where('pertanyaan_id', $pertanyaan_id)->exists();
        $batasPenandatanganan = Carbon::parse($pertanyaans->daftartilik->tgl_pelaksanaan)->addDays(14);
        $tindakanKoreksi = TindakanKoreksi::where('pertanyaan_id', $pertanyaan_id)->where('noPTK', $noPTK)->first();
        $deadline = DeadlineTindakanKoreksi::where('tindakankoreksi_id', $tindakanKoreksi->id);

        if (!$isAlreadyPTK) {

            $tindakanKoreksi = new TindakanKoreksi;
            $tindakanKoreksi->pertanyaan_id = $pertanyaan_id;
            $tindakanKoreksi->noPTK = $noPTK;
            $tindakanKoreksi->save();

            $DLakarpenyebab = DeadlineTindakanKoreksi::where('tindakankoreksi_id', $tindakanKoreksi->id)->where('peruntukan', '0')->exists();
            $DLrencanaTindakan = DeadlineTindakanKoreksi::where('tindakankoreksi_id', $tindakanKoreksi->id)->where('peruntukan', '1')->exists();
            $DLtinjauanEfektivitas = DeadlineTindakanKoreksi::where('tindakankoreksi_id', $tindakanKoreksi->id)->where('peruntukan', '2')->exists();

            if (!$DLakarpenyebab && !$DLrencanaTindakan && !$DLtinjauanEfektivitas) {

                $deadlineTTD = new DeadlineTindakanKoreksi;
                $deadlineTTD->tindakankoreksi_id = $tindakanKoreksi->id;
                $deadlineTTD->penandatangan = $pertanyaans->daftartilik->auditee->ketua_auditor;
                $deadlineTTD->tgl_mulaipenandatangan = $pertanyaans->daftartilik->tgl_pelaksanaan;
                $deadlineTTD->batas_penandatanganan = $batasPenandatanganan;
                $deadlineTTD->peruntukan = '0';
                $deadlineTTD->save();

                $deadlineTTD = new DeadlineTindakanKoreksi;
                $deadlineTTD->tindakankoreksi_id = $tindakanKoreksi->id;
                $deadlineTTD->penandatangan = $pertanyaans->daftartilik->auditee->ketua_auditee;
                $deadlineTTD->tgl_mulaipenandatangan = $pertanyaans->daftartilik->tgl_pelaksanaan;
                $deadlineTTD->batas_penandatanganan = $batasPenandatanganan;
                $deadlineTTD->peruntukan = '1';
                $deadlineTTD->save();

                $deadlineTTD = new DeadlineTindakanKoreksi;
                $deadlineTTD->tindakankoreksi_id = $tindakanKoreksi->id;
                $deadlineTTD->penandatangan = $pertanyaans->daftartilik->auditee->ketua_auditor;
                $deadlineTTD->tgl_mulaipenandatangan = $pertanyaans->daftartilik->tgl_pelaksanaan;
                $deadlineTTD->batas_penandatanganan = $batasPenandatanganan;
                $deadlineTTD->peruntukan = '2';
                $deadlineTTD->save();

            } 

        } else {
            $tindakanKoreksi = TindakanKoreksi::where('pertanyaan_id', $pertanyaan_id)->first();

            $DLakarpenyebab = DeadlineTindakanKoreksi::where('tindakankoreksi_id', $tindakanKoreksi->id)->where('peruntukan', '0')->exists();
            $DLrencanaTindakan = DeadlineTindakanKoreksi::where('tindakankoreksi_id', $tindakanKoreksi->id)->where('peruntukan', '1')->exists();
            $DLtinjauanEfektivitas = DeadlineTindakanKoreksi::where('tindakankoreksi_id', $tindakanKoreksi->id)->where('peruntukan', '2')->exists();

            // dd($pertanyaans->daftartilik->auditee);

            if (!$DLakarpenyebab && !$DLrencanaTindakan && !$DLtinjauanEfektivitas) {

                $deadlineTTD = new DeadlineTindakanKoreksi;
                $deadlineTTD->tindakankoreksi_id = $tindakanKoreksi->id;
                $deadlineTTD->penandatangan = $pertanyaans->daftartilik->auditor->nama;
                $deadlineTTD->tgl_mulaipenandatangan = $pertanyaans->daftartilik->tgl_pelaksanaan;
                $deadlineTTD->batas_penandatanganan = $batasPenandatanganan;
                $deadlineTTD->peruntukan = '0';
                $deadlineTTD->save();

                $deadlineTTD = new DeadlineTindakanKoreksi;
                $deadlineTTD->tindakankoreksi_id = $tindakanKoreksi->id;
                $deadlineTTD->penandatangan = $pertanyaans->daftartilik->auditee->ketua_auditee;
                $deadlineTTD->tgl_mulaipenandatangan = $pertanyaans->daftartilik->tgl_pelaksanaan;
                $deadlineTTD->batas_penandatanganan = $batasPenandatanganan;
                $deadlineTTD->peruntukan = '1';
                $deadlineTTD->save();

                $deadlineTTD = new DeadlineTindakanKoreksi;
                $deadlineTTD->tindakankoreksi_id = $tindakanKoreksi->id;
                $deadlineTTD->penandatangan = $pertanyaans->daftartilik->auditor->nama;
                $deadlineTTD->tgl_mulaipenandatangan = $pertanyaans->daftartilik->tgl_pelaksanaan;
                $deadlineTTD->batas_penandatanganan = $batasPenandatanganan;
                $deadlineTTD->peruntukan = '2';
                $deadlineTTD->save();

            } 
        }

        return view('spm/formTindakanKoreksi', compact('auditee_', 'pertanyaans', 'noPTK', 'tindakanKoreksi'));
    }

    public function store(Request $request, $noPTK)
    {
        dd($request->all());

        $tindakanKoreksi = TindakanKoreksi::where('noPTK', $noPTK)->first();

        // $isAlreadyExist = TindakanKoreksi::where('noPTK', $request->noPTK)->where('pertanyaan_id', $request->pertanyaan_id)->exists();
        // $tindakanKoreksi = TindakanKoreksi::find($noPTK);
        // // dd($isAlreadyExist);
        
        // // update tindakan koreksi
        // if ($isAlreadyExist) {
        //     // dd($request->all());
        //     $tindakanKoreksi->update([
        //         'akarPenyebab' => $request->akarPenyebab,
        //         'auditor' => $request->auditor,
        //     ]);
        //     $tindakanKoreksi->save();
        // } else {
        //     $tindakanKoreksi = new TindakanKoreksi;
        //     $tindakanKoreksi->pertanyaan_id = $request->pertanyaan_id;
        //     $tindakanKoreksi->noPTK = $noPTK;
        //     $tindakanKoreksi->auditor = $request->auditor;
        //     $tindakanKoreksi->batasPengisian0 = $request->batasPengisian0;
        //     $tindakanKoreksi->batasPengisian1 = $request->batasPengisian1;
        //     $tindakanKoreksi->akarPenyebab = $request->akarPenyebab;
        //     $tindakanKoreksi->save();
        // }

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}

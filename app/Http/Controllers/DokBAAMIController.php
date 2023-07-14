<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Auditee;
use App\Models\DokBA_AMI;
use App\Models\Pertanyaan;
use App\Models\BeritaAcara;
use App\Models\DaftarTilik;
use Illuminate\Http\Request;

class DokBAAMIController extends Controller
{
    public function tampilBA_AMI($auditee_id)
    {
        // dd($auditee_id);
        $auditee_ = Auditee::where('id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        // $get_auditee = $pertanyaan_->first();
        // $auditeeid_find = $get_auditee->auditee_id;
        // $unitKerja = Auditee::where('id', $auditeeid_find)->first();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->get();
        $ba_ami = DokBA_AMI::where('auditee_id', $auditee_id)->get();
        $jadwalAudit_ = Jadwal::where('auditee_id', $auditee_id)->get();

        
        return view('spm/beritaAcaraAMI', compact('daftartilik_', 'pertanyaan_', 'ba_ami', 'beritaacara_', 'auditee_', 'jadwalAudit_'));
    }

    public function ubahdataDokumenBA($auditee_id)
    {
        $ba_ = BeritaAcara::all()->unique('auditee_id');
        $dokBA_ = DokBA_AMI::where('auditee_id', $auditee_id)->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->get();
        
        return view('spm/BAAMI_ubahDataDokumenBA', compact('ba_','dokBA_', 'beritaacara_'));
    }

    public function insertdataDokumenBA(Request $request, $auditee_id)
    {
        $dataDokumen_ = DokBA_AMI::find($auditee_id);
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->get()->first();
        //dd($beritaacara_->id);

        if ($dataDokumen_ != null) {

            $dataDokumen_->update([
                'beritaacara_id' => $beritaacara_->id,
                'beritaacara_id' => $beritaacara_->id,
                'judulDokumen' => $request->judulDokumen,
                'kodeDokumen' => $request->kodeDokumen,
                'revisiKe' => $request->revisiKe,
                'tgl_revisi' => $request->tgl_revisi,
                'tgl_berlaku' => $request->tgl_berlaku,
            ]);
            $dataDokumen_->save();

        } else {
            $dataDokumen = new DokBA_AMI;
            $dataDokumen->beritaacara_id = $beritaacara_->id;
            $dataDokumen->auditee_id = $auditee_id;
            $dataDokumen->judulDokumen = $request->judulDokumen;
            $dataDokumen->kodeDokumen = $request->kodeDokumen;
            $dataDokumen->revisiKe = $request->revisiKe;
            $dataDokumen->revisiKe = $request->revisiKe;
            $dataDokumen->tgl_berlaku = $request->tgl_berlaku;
            $dataDokumen->save();
        };

        return redirect()->route('BA-AMI', ['auditee_id' => $auditee_id])->with(compact('beritaacara_'));
    }

    public function ubahdataBAAMI($auditee_id)
    {
        $ba_ = BeritaAcara::all()->unique('auditee_id');
        $dokBA_ = DokBA_AMI::where('auditee_id', $auditee_id)->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->get();
        $jadwalAudit_ = Jadwal::all();
        
        return view('spm/BAAMI_ubahBAAMI', compact('ba_','dokBA_', 'beritaacara_'));
    }

    public function updatedataBAAMI(Request $request, $auditee_id)
    {
        $dataDokumen_ = DokBA_AMI::find($auditee_id);
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->get()->first();
        //dd($beritaacara_->id);

        if ($dataDokumen_ != null) {

            $dataDokumen_->update([
                'beritaacara_id' => $beritaacara_->id,
                'beritaacara_id' => $beritaacara_->id,
                'judulDokumen' => $request->judulDokumen,
                'kodeDokumen' => $request->kodeDokumen,
                'revisiKe' => $request->revisiKe,
                'tgl_revisi' => $request->tgl_revisi,
                'tgl_berlaku' => $request->tgl_berlaku,
            ]);
            $dataDokumen_->save();

        } else {
            $dataDokumen = new DokBA_AMI;
            $dataDokumen->beritaacara_id = $beritaacara_->id;
            $dataDokumen->auditee_id = $auditee_id;
            $dataDokumen->judulDokumen = $request->judulDokumen;
            $dataDokumen->kodeDokumen = $request->kodeDokumen;
            $dataDokumen->revisiKe = $request->revisiKe;
            $dataDokumen->revisiKe = $request->revisiKe;
            $dataDokumen->tgl_berlaku = $request->tgl_berlaku;
            $dataDokumen->save();
        };

        return redirect()->route('BA-AMI', ['auditee_id' => $auditee_id])->with(compact('beritaacara_'));
    }
}

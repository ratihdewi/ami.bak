<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\DokLampiran;
use Illuminate\Http\Request;

class DokLampiranController extends Controller
{
    public function adddokumenpendukung($auditee_id)
    {
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get(); 

        return view('spm/BA_dokumenpendukung', compact('dokumenpendukung_', 'beritaacara_'));
    }

    public function storedokumenpendukung(Request $request, $auditee_id)
    {
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        $isAlreadyExist = DokLampiran::where('namaDokumen', $request->namaDokumen)->where('kodeDokumen', $request->kodeDokumen)->exists();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->get()->first();

        if ( count($dokumenpendukung_) == 0 || !$isAlreadyExist ) {

            $dokpendukung_ = new DokLampiran;
            $dokpendukung_->auditee_id = $beritaacara_->auditee_id;
            $dokpendukung_->kodeDokumen = $request->kodeDokumen;
            $dokpendukung_->namaDokumen = $request->namaDokumen;
            $dokpendukung_->dokumen = $request->dokumen;
            $dokpendukung_->save();

            if ($request->hasFile('dokumen')) {
                $fileFoto = time().$request->file('dokumen')->getClientOriginalName();
                $pathFoto = $request->file('dokumen')->storeAs('DokumenLampiran', $fileFoto, 'public');
                $request->dokumen = '/storage/'.$pathFoto;
                $dokpendukung_->update([
                    'dokumen' => $request->dokumen,
                ]);
                $dokpendukung_->save();
            }
            $return = redirect()->route('BA-AMI', ['auditee_id' => $auditee_id])->with('success', 'Dokumen pendukung berhasil ditambah')->with(compact('dokumenpendukung_')); 
        } elseif ($isAlreadyExist) {
            $return = redirect()->route('BA-AMI', ['auditee_id' => $auditee_id])->with('error', 'Dokumen pendukung sudah tersedia!');
        }
        
        return $return;
    }

    public function lihatdokumenpendukung()
    {
        return response()->file(public_path('dokumen/example.pdf'),['content-type'=>'application/pdf']);
    }

    public function deletedokumenpendukung($id)
    {
        $dokpendukung_ = DokLampiran::find($id);
        $dokpendukung_->delete();

        return redirect()->route('BA-dokumenpendukung', ['auditee_id' => $dokpendukung_->auditee_id])->with('success', 'Dokumen pendukung berhasil dihapus!');
    }
}

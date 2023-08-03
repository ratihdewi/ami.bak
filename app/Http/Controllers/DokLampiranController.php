<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\DokLampiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokLampiranController extends Controller
{
    public function adddokumenpendukung($auditee_id)
    {
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get(); 

        return view('spm/BA_dokumenpendukung', compact('dokumenpendukung_', 'beritaacara_'));
    }

    public function auditor_adddokumenpendukung($auditee_id)
    {
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get(); 

        return view('auditor/BA_dokumenpendukung', compact('dokumenpendukung_', 'beritaacara_'));
    }

    public function auditee_adddokumenpendukung($auditee_id)
    {
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get(); 

        return view('auditee/BA_dokumenpendukung', compact('dokumenpendukung_', 'beritaacara_'));
    }

    public function storedokumenpendukung(Request $request, $auditee_id)
    {
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        $isAlreadyExist = DokLampiran::where('namaDokumen', $request->namaDokumen)->where('kodeDokumen', $request->kodeDokumen)->exists();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->get()->first();

        if ( count($dokumenpendukung_) == 0 || !$isAlreadyExist ) {

            $validated = $request->validate([
                'dokumen' => 'required|mimes:csv,xlsx,xls,pdf,docx|max:10240',
            ]);

            $dokpendukung_ = new DokLampiran;
            $dokpendukung_->auditee_id = $beritaacara_->auditee_id;
            $dokpendukung_->kodeDokumen = $request->kodeDokumen;
            $dokpendukung_->namaDokumen = $request->namaDokumen;
            $dokpendukung_->dokumen = $request->dokumen;
            $dokpendukung_->save();

            if ($request->hasFile('dokumen')) {
                $filepdf = time().$request->file('dokumen')->getClientOriginalName();
                $pathfile = $request->file('dokumen')->storeAs('DokumenLampiran', $filepdf, 'public');
                $request->dokumen = '/storage/'.$pathfile;
                $dokpendukung_->update([
                    'dokumen' => $request->dokumen,
                ]);
                $dokpendukung_->save();
            }
            $return = redirect()->back()->with('success', 'Dokumen pendukung berhasil ditambah')->with(compact('dokumenpendukung_')); 
        } elseif ($isAlreadyExist) {
            $return = redirect()->back()->with('error', 'Dokumen pendukung sudah tersedia!');
        }
        
        return $return;
    }

    public function lihatdokumenpendukung($id)
    {
        $dokpendukung_ = DokLampiran::find($id);

        return response()->file(public_path($dokpendukung_->dokumen));
    }

    public function deletedokumenpendukung($id)
    {
        $dokpendukung_ = DokLampiran::find($id);
        $dokpendukung_->delete();

        return redirect()->back()->with('success', 'Dokumen pendukung berhasil dihapus!');
    }
}

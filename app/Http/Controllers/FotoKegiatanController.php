<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use App\Models\Pertanyaan;
use App\Models\FotoKegiatan;
use Illuminate\Http\Request;

class FotoKegiatanController extends Controller
{
    public function index()
    {
        return view('spm/dt_fotoKegiatan');
    }

    public function spm_index($auditee_id, $tahunperiode)
    {
        $auditees = Auditee::where('id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();

        return view('spm/dt_fotoKegiatan', compact('auditees', 'fotokegiatans'));
    }

    public function auditor_index($auditee_id, $tahunperiode)
    {
        $auditees = Auditee::where('id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();

        return view('auditor/dt_fotoKegiatan', compact('auditees', 'fotokegiatans'));
    }

    public function auditee_index($auditee_id, $tahunperiode)
    {
        $auditees = Auditee::where('id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();
        
        return view('auditee/dt_fotoKegiatan', compact('auditees', 'fotokegiatans'));
    }

    public function storefotokegiatan(Request $request)
    {

        $request->validate([
            'foto' => 'mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . $file->getClientOriginalName();
            $pathFile = $file->storeAs('DokumenFoto', $fileName, 'public');
            $request->foto = '/storage/' . $pathFile;
        }
        
        $fotokegiatan = new FotoKegiatan([
            "auditee_id" => $request->auditee_id,
            "namaFile" => $request->namaFile,
            "foto" => $request->foto,
        ]);
        $fotokegiatan->save();

        return redirect()->back()->with('success', 'Foto kegiatan berhasil ditambah!');
    }

    public function deletefotokegiatan($id)
    {
        $fotokegiatan = FotoKegiatan::find($id);

        $fotokegiatan->delete();
        return redirect()->back()->with('success', 'Foto '.$fotokegiatan->namaFile.' berhasil dihapus!');
    }

    public function lihatfotokegiatan($id)
    {
        $fotokegiatan = FotoKegiatan::find($id);

        return response()->file(public_path($fotokegiatan->foto));
    }
}

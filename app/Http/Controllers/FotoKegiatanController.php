<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use App\Models\Pertanyaan;
use App\Models\DaftarTilik;
use App\Models\FotoKegiatan;
use Illuminate\Http\Request;

class FotoKegiatanController extends Controller
{
    public function index($auditee_id)
    {
        // dd($request->all());
        $auditees = Auditee::where('id', $auditee_id)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();
        $pertanyaan_id = null;
        $data = DaftarTilik::where('auditee_id', $auditees->id)->first();
        // dd($data);

        return view('spm/dt_fotoKegiatan', compact('auditees', 'fotokegiatans', 'pertanyaan_id', 'data'));
    }

    public function spm_index($auditee_id, $tahunperiode, $pertanyaan_id)
    {
        $auditees = Auditee::where('id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();

        return view('spm/dt_fotoKegiatan', compact('auditees', 'fotokegiatans', 'pertanyaan_id'));
    }

    public function auditor_index($auditee_id, $tahunperiode, $pertanyaan_id)
    {
        $auditees = Auditee::where('id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();

        return view('auditor/dt_fotoKegiatan', compact('auditees', 'fotokegiatans', 'pertanyaan_id'));
    }

    public function auditee_index($auditee_id, $tahunperiode, $pertanyaan_id)
    {
        $auditees = Auditee::where('id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();
        
        return view('auditee/dt_fotoKegiatan', compact('auditees', 'fotokegiatans', 'pertanyaan_id'));
    }

    public function spm_indexBA($auditee_id, $tahunperiode)
    {
        $auditees = Auditee::where('id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();

        return view('spm/BA_fotokegiatan', compact('auditees', 'fotokegiatans'));
    }

    public function auditor_indexBA($auditee_id, $tahunperiode)
    {
        $auditees = Auditee::where('id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();

        return view('auditor/BA_fotokegiatan', compact('auditees', 'fotokegiatans'));
    }

    public function auditee_indexBA($auditee_id, $tahunperiode)
    {
        $auditees = Auditee::where('id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $fotokegiatans = FotoKegiatan::where('auditee_id', $auditees->id)->get();
        
        return view('auditee/BA_fotokegiatan', compact('auditees', 'fotokegiatans'));
    }

    public function storefotokegiatan(Request $request)
    {
        $isExists = FotoKegiatan::where('namaFile', $request->namaFile)->exists();

        if ($isExists) {
            return redirect()->back()->with('error', 'Nama atau file foto sudah tersedia!');
        } else {
            $request->validate([
                'foto' => 'mimes:jpeg,png,jpg|max:2048',
            ], [
                'foto.required' => 'File foto harus diunggah.',
                'foto.mimes' => 'File foto harus memiliki ekstensi JPG atau PNG.',
                'foto.max' => 'File foto tidak boleh lebih dari 5 MB.',
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

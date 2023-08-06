<?php

namespace App\Http\Controllers;

use App\Models\DokSahih;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class DokSahihController extends Controller
{
    public function index()
    {
        return redirect()->back()->with('warning', 'Dokumen Bukti Sahih diisi oleh Auditee atau saat tindak lanjut daftar tilik!');
    }

    public function auditor_index($pertanyaan_id)
    {
        $pertanyaan = Pertanyaan::find($pertanyaan_id);
        $doksahihs = DokSahih::where('pertanyaan_id', $pertanyaan_id)->get();

        return view('auditor/dokumenSahih', compact('doksahihs', 'pertanyaan'));
    }

    public function auditee_index($pertanyaan_id)
    {
        $pertanyaan = Pertanyaan::find($pertanyaan_id);
        $doksahihs = DokSahih::where('pertanyaan_id', $pertanyaan_id)->get();

        return view('auditee/dokumenSahih', compact('doksahihs', 'pertanyaan'));
    }

    public function spm_index($pertanyaan_id)
    {
        $pertanyaan = Pertanyaan::find($pertanyaan_id);
        $doksahihs = DokSahih::where('pertanyaan_id', $pertanyaan_id)->get();

        return view('spm/dokumenSahih', compact('doksahihs', 'pertanyaan'));
    }

    public function storedoksahih(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'dokSahih' => 'required|mimes:csv,xlsx,xls,pdf,docx|max:10240',
        ]);

        if ($request->hasFile('dokSahih')) {
            $file = $request->file('dokSahih');
            $fileName = time() . $file->getClientOriginalName();
            $pathFile = $file->storeAs('dokumenSahih', $fileName, 'public');
            $request->dokSahih = '/storage/' . $pathFile;
        }
        
        $doksahih =new DokSahih([
            "pertanyaan_id" => $request->pertanyaan_id,
            "namaFile" => $request->namaFile,
            "dokSahih" => $request->dokSahih,
        ]);
        $doksahih->save();

        return redirect()->back()->with('success', 'Dokumen Bukti Sahih berhasil ditambah!');
    }

    public function deletedoksahih($id)
    {
        $doksahih = DokSahih::find($id);

        $doksahih->delete();
        return redirect()->back()->with('success', 'Dokumen Bukti Sahih '.$doksahih->namaFile.' berhasil dihapus!');
    }

    public function lihatdoksahih($id)
    {
        $doksahih = DokSahih::find($id);

        return response()->file(public_path($doksahih->dokSahih));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $currentDate = Carbon::now()->format('Y-m-d');
        $pertanyaan = Pertanyaan::find($pertanyaan_id);
        // dd($currentDate < $batas);

        $doksahihs = DokSahih::where('pertanyaan_id', $pertanyaan_id)->get();

        return view('auditee/dokumenSahih', compact('doksahihs', 'pertanyaan', 'currentDate'));
    }

    public function spm_index($pertanyaan_id)
    {
        $pertanyaan = Pertanyaan::find($pertanyaan_id);
        $doksahihs = DokSahih::where('pertanyaan_id', $pertanyaan_id)->get();

        return view('spm/dokumenSahih', compact('doksahihs', 'pertanyaan'));
    }

    public function storedoksahih(Request $request)
    {
        // dd($request->hasFile('dokSahih'));
        
        if ($request->hasFile('dokSahih')) {

            $request->validate([
                'dokSahih' => 'mimes:csv,xlsx,xls,pdf,docx|max:10240',
            ]);    

            $file = $request->file('dokSahih');
            $fileName = time() . $file->getClientOriginalName();
            $pathFile = $file->storeAs('dokumenSahih', $fileName, 'public');
            $request->dokSahih = '/storage/' . $pathFile;

            $doksahih =new DokSahih([
                "pertanyaan_id" => $request->pertanyaan_id,
                "namaFile" => $request->namaFile,
                "dokSahih" => $request->dokSahih,
                "link" => $request->link,
            ]);
            $doksahih->save();
        } else {
            $doksahih =new DokSahih([
                "pertanyaan_id" => $request->pertanyaan_id,
                "namaFile" => $request->namaFile,
                "dokSahih" => null,
                "link" => $request->link,
            ]);
            $doksahih->save();
        }
        
        

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

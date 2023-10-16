<?php

namespace App\Http\Controllers;

use App\Models\DokumenResmi;
use Illuminate\Http\Request;
use App\Models\FolderDokumenResmi;
use Illuminate\Support\Facades\Auth;

class DokumenResmiController extends Controller
{
    public function index($id)
    {
        $folders = FolderDokumenResmi::find($id);
        $files = DokumenResmi::where('folderdokresmi_id', $folders->id)->get();

        return view('spm/dokResmi-detailfolder', compact('folders', 'files'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $dokumenresmi = new DokumenResmi;
        $dokumenresmi->folderdokresmi_id = $request->folderdokresmi_id;
        $dokumenresmi->fileName = $request->fileName;
        $dokumenresmi->owner = Auth::user()->name;
        $dokumenresmi->save();

        if ($request->hasFile('file')) {
            $file = time().$request->file('file')->getClientOriginalName();
            $pathfile = $request->file('file')->storeAs('DokumenResmi', $file, 'public');
            $request->file = '/storage/'.$pathfile;
            $dokumenresmi->update([
                'file' => $request->file,
            ]);
            $dokumenresmi->save();
        }

        return redirect()->back()->with('success', 'File berhasil diupload!');
    }

    public function read($id)
    {
        $file = DokumenResmi::find($id);

        return response()->file(public_path($file->file));
    }

    public function getdatamodal($id)
    {
        $data = DokumenResmi::find($id);

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $files = DokumenResmi::find($id);

        $files->update([
            'fileName' =>$request->fileName,
        ]);
        $files->save();

        if ($request->hasFile('file')) {
            $file = time().$request->file('file')->getClientOriginalName();
            $pathfile = $request->file('file')->storeAs('DokumenResmi', $file, 'public');
            $request->file = '/storage/'.$pathfile;
            $files->update([
                'file' => $request->file,
            ]);
            $files->save();
        }

        return redirect()->back()->with('success', 'File berhasil diupdate.');
    }

    public function delete($id)
    {
        $file = DokumenResmi::find($id);
        $file->delete();

        return redirect()->back()->with('success', 'File berhasil dihapus.');
    }
}

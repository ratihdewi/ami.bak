<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FolderDokumenResmi;
use Illuminate\Support\Facades\Auth;

class FolderDokumenResmiController extends Controller
{
    public function index()
    {
        $dokFolder = FolderDokumenResmi::all();

        if (Auth::user()->peran == 'spm') {
            return view('spm/dokResmi', compact('dokFolder'));
        } elseif (Auth::user()->peran == 'auditor') {
            return view('auditor/dokResmi', compact('dokFolder'));
        } elseif (Auth::user()->peran == 'auditee') {
            return view('auditee/dokResmi', compact('dokFolder'));
        } else {
            return view('auditee/dokResmi', compact('dokFolder'));
        }

    }

    public function store(Request $request)
    {
        $newFolder = new FolderDokumenResmi;
        $newFolder->folderName = $request->folderName;
        $newFolder->owner = Auth::user()->name;
        $newFolder->save();

        return redirect()->back()->with('success', 'Folder berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        $folder = FolderDokumenResmi::find($id);
        
        $folder->update([
            'folderName' => $request->folderName,

        ]);
        $folder->save();

        return redirect()->back()->with('success', 'Folder berhasil diupdate.');
    }

    public function delete($id)
    {
        $folderdokresmi = FolderDokumenResmi::find($id);

        $folderdokresmi->delete();

        return redirect()->back()->with('success', 'Folder '.$folderdokresmi->folderName.' berhasil dihapus.');
    }

    public function getdatamodal($id)
    {
        $data = FolderDokumenResmi::find($id);

        return response()->json($data);
    }
}

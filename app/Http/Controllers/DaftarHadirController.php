<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use App\Models\User;
use App\Models\BeritaAcara;
use App\Models\DaftarHadir;
use Illuminate\Http\Request;

class DaftarHadirController extends Controller
{

    public function editdaftarhadir($auditee_id)
    {
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $users = User::where('role', 'Auditor')->orWhere('role', 'Auditee')->get();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->get();

        if (count($daftarhadir_) == 0) {
            return view('spm/BAAMI_formDaftarHadir', compact('beritaacara_', 'users', 'daftarhadir_'));
        } else {
            return view('spm/BAAMI_editDaftarHadir', compact('beritaacara_', 'users', 'daftarhadir_'));   
        }
    }

    public function storedaftarhadir(Request $request, $auditee_id)
    {
        $users_ = User::where('role', 'Auditor')->orWhere('role', 'Auditee')->get();

        $request->validate([
            'addmore.*.beritaacara_id' => 'required',
            'addmore.*.posisi' => 'required',
            'addmore.*.namapeserta' => 'required',
        ]);

        // ddd($request->addmore);
        foreach ($users_ as $key => $user) {
            foreach ($request->addmore as $key => $value) {
                
                $notExist = DaftarHadir::where('namapeserta', $value['namapeserta'])->doesntExist();
                $daftarhadir_ = DaftarHadir::all();

                if ($value['namapeserta'] == $user->name && $value['posisi'] == $user->role && $notExist) {
                    // DaftarHadir::create($value);
                    $daftarhadir = new DaftarHadir;
                    $daftarhadir->beritaacara_id = $value['beritaacara_id'];
                    $daftarhadir->posisi = $value['posisi'];
                    $daftarhadir->namapeserta = $value['namapeserta'];
                    $daftarhadir->save();
                    $return = redirect()->route('BA-AMI', ['auditee_id' => $auditee_id])->with('success', 'Data peserta berhasil ditambah!');
                } elseif (!$notExist) {
                    $return = redirect()->route('BA-AMI', ['auditee_id' => $auditee_id])->with('error', 'Data peserta sudah tersedia!');
                } elseif ($value['namapeserta'] != $user->name && $value['posisi'] != $user->role) {
                    $return = redirect()->route('BA-AMI', ['auditee_id' => $auditee_id])->with('error', 'Data peserta tidak terdaftar!');
                }
            }
        }
        //die;
        return $return;
    }

    public function deletedaftarhadir($id)
    {
        $daftarhadir_ = DaftarHadir::find($id);
        $auditee_ = BeritaAcara::where('id', $daftarhadir_->beritaacara_id)->first();
        
        $daftarhadir_->delete();
        return redirect()->route('BA-AMI', ['auditee_id' => $auditee_->auditee_id])->with('success', 'Data peserta berhasil dihapus!');
    }

    public function esignpeserta($id)
    {
        $approve_ = DaftarHadir::find($id);
        
        $approve_->eSign = 'Hadir';
 
        $approve_->save();

        // dd($approve_);
        return redirect()->back()->with('success', 'Terima kasih, Anda telah mengisi daftar hadir!');
    }

}

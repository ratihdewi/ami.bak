<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        // dd($data);
        return view('spm/daftarUser', compact('data'));
    }

    public function tambahuser()
    {
        return view('spm/addUser');
    }

    public function insertdata(Request $request)
    {
        //dd($request->all());
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($input('role'));
        return redirect()->route('daftaruser')->with('success', 'Data berhasil ditambahkan');
    }

    public function tampildata($id){
        $data = User::find($id);
        // dd($data);
        return view('spm/updateUser', compact('data'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = User::find($id);
        $data->update($request->all());
        $auditor_ = Auditor::where('nama', $request->name)->first();
        
        if ($auditor_) {
            $auditor_->update([
                'noTelepon' => $request->noTelepon
            ]);
            $auditor_->save();
        }
        return redirect()->route('daftaruser')->with('success', 'Data berhasil diupdate');
    }

    public function deletedata($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('daftaruser')->with('success', 'Data berhasil dihapus');
    }

    public function changerole($id)
    {
        if (Auditee::where('user_id', $id)->exists()) {
            return redirect()->route('auditee-daftarauditor-periode');
        } elseif (Auditor::where('user_id', $id)->exists()) {
            return redirect()->route('auditor-daftarauditor-periode');
        } else {
            return redirect()->route('auditor-periode');
        }
    }

    //add auditor
    public function viewuser()
    {
        return view('addAuditor');
    }

    public function getuser()
    {
        $p = User::all();

        return response()->json($p);
    }
}

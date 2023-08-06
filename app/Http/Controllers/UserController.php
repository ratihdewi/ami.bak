<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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
        $roles = Role::all();

        return view('spm/addUser', compact('roles'));
    }

    public function insertdata(Request $request)
    {
        //dd($request->all());
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $isExist = User::where('nip', $request->nip)->orWhere('name', $request->name)->orWhere('username', $request->username)->exists();
        
        if ($isExist) {
            return redirect()->route('daftaruser')->with('error', 'Data pengguna sudah terdaftar!');
        } else {
            $user = User::create($input);
            $user->assignRole($input['role']);
            return redirect()->route('daftaruser')->with('success', 'Data berhasil ditambahkan');
        }
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

    public function changeroleauditor($id)
    {
        $auditor_ = Auditor::where('user_id', $id)->exists();

        if ($auditor_) {
            return redirect()->route('auditor-daftarauditor-periode')->with('success', 'Selamat datang di halaman Auditor!');
        } else {
            return redirect()->back();
        }
    }

    public function changeroleauditee($id)
    {
        $auditee_ = Auditee::where('user_id', $id)->exists();

        if ($auditee_) {
            return redirect()->route('auditee-daftarauditor-periode')->with('success', 'Selamat datang di halaman Auditee!');
        } else {
            return redirect()->back();
        }
    }

    public function changerolespm($id)
    {
        $user_ = User::where('id', $id)->where('role', 'SPM')->exists();
        if ($user_) {
            return redirect()->route('auditor-periode')->with('success', 'Selamat datang di halaman SPM!');
        } else {
            return redirect()->back();
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

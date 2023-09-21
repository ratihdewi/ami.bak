<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::where('status', 'aktif')->get();
        $unitkerja = UnitKerja::all();
        // dd($data);
        return view('spm/daftarUser', compact('data', 'unitkerja'));
    }

    public function tambahuser()
    {
        $roles = Role::all();
        $unitkerjas = UnitKerja::all();

        return view('spm/addUser', compact('roles', 'unitkerjas'));
    }

    public function insertdata(Request $request)
    {
        // dd($request->all());
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $isExist = User::where('nip', $request->nip)->orWhere('name', $request->name)->orWhere('username', $request->username)->exists();
        
        if ($isExist) {
            return redirect()->route('daftaruser')->with('error', 'Data pengguna sudah terdaftar!');
        } else {
            $user = User::create($input);
            $user->assignRole($input['role_id']);
            return redirect()->route('daftaruser')->with('success', 'Data berhasil ditambahkan');
        }
    }

    public function tampildata($id){
        $data = User::find($id);
        $unitkerjas = UnitKerja::all();
        $roles = Role::all();

        $unitkerja2 = UnitKerja::find($data->unitkerja_id2);
        $unitkerja3 = UnitKerja::find($data->unitkerja_id3);

        return view('spm/updateUser', compact('data', 'unitkerjas', 'roles', 'unitkerja2', 'unitkerja3'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = User::find($id);
        $data->password = Hash::make($request->password);
        $data->update([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $data->password,
            'unitkerja_id' => $request->unitkerja_id,
            'unitkerja_id2' => $request->unitkerja_id2,
            'unitkerja_id3' => $request->unitkerja_id3,
            'username' => $request->username,
            'role_id' => $request->role_id,
            'jabatan' => $request->jabatan,
            'jabatan2' => $request->jabatan2,
            'jabatan3' => $request->jabatan3,
            'noTelepon' => $request->noTelepon,
        ]);
        $data->save();
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
        $data->status = 'tidak aktif';
        $data->save();
        // dd($data);
        return redirect()->route('daftaruser')->with('success', 'Data berhasil dihapus');
    }

    public function changeroleauditor($id)
    {
        $auditor_ = Auditor::where('user_id', $id)->exists();
        $user = User::find($id);

        $user->update([
            'peran' => 'auditor',
        ]);
        $user->save();

        if ($auditor_) {
            return redirect()->route('auditor-daftarauditor-periode')->with('success', 'Selamat datang di halaman Auditor!');
        } else {
            return redirect()->back();
        }
    }

    public function changeroleauditee($id)
    {
        $auditee_ = Auditee::where('user_id', $id)->exists();
        $user = User::find($id);

        $user->update([
            'peran' => 'auditee',
        ]);
        $user->save();

        if ($auditee_) {
            return redirect()->route('auditee-daftarauditor-periode')->with('success', 'Selamat datang di halaman Auditee!');
        } else {
            return redirect()->back();
        }
    }

    public function changerolespm($id)
    {
        $user_ = User::where('id', $id)->where('role_id', '1')->exists();
        $user = User::find($id);

        $user->update([
            'peran' => 'spm',
        ]);
        $user->save();

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

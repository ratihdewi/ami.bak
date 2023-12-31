<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Position;
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
        $roles = Role::where('name', '!=', 'Super Admin')->get();
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
        $roles = Role::where('name', '!=', 'Super Admin')->get();

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
        if ($auditor_) 
        {
            $auditor_->update([
                'noTelepon' => $request->noTelepon
            ]);
        }
        // $auditors = Auditor::where('user_id', $data->id)->get();
        // foreach ($auditors as $key => $auditor) {
        //     $auditor->update([
        //         'nama' => $data->name,
        //         'nip' => $data->nip,
        //         'program_studi' => $data->unitkerja->name,
        //         'fakultas' => $data->unitkerja->fakultas,
        //         'noTelepon' => $data->noTelepon,
        //     ]);
        //     $auditor->save();

        //     $timAuditors = Auditee::where('id_ketuaauditor', $auditor->id)->orWhere('id_anggotaauditor1', $auditor->id)->orWhere('id_anggotaauditor2', $auditor->id)->get();
        //     foreach ($timAuditors as $key => $timAuditor) {
        //         if ($timAuditor->id_ketuaauditor == $auditor->id) {
        //             $timAuditor->update([
        //                 'ketua_auditor' => $data->name,
        //             ]);
        //             $timAuditor->save();
        //         } elseif ($timAuditor->id_anggotaauditor1 == $auditor->id) {
        //             $timAuditor->update([
        //                 'anggota_auditor' => $data->name,
        //             ]);
        //             $timAuditor->save();
        //         } elseif ($timAuditor->id_anggotaauditor2 == $auditor->id) {
        //             $timAuditor->update([
        //                 'anggota_auditor2' => $data->name,
        //             ]);
        //             $timAuditor->save();
        //         }
                
        //     }
        // }
        
        // $auditees = Auditee::where('user_id', $data->id)->orWhere('id_wakilketua', $data->id)->get();
        // foreach ($auditees as $key => $auditee) {
        //     if ($auditee->user_id == $data->id) {
        //         $auditee->update([
        //             'ketua_auditee' => $data->name,
        //         ]);
        //         $auditee->save();
        //     } elseif ($auditee->id_wakilketua == $data->id) {
        //         $auditee->update([
        //             'wakil_ketua_auditee' => $data->name,
        //         ]);
        //         $auditee->save();
        //     }
            
        // }
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
            return redirect()->route('home.auditor')->with('success', 'Selamat datang di halaman Auditor!');
        } else {
            return redirect()->back();
        }
    }

    public function changeroleauditee($id)
    {
        $auditee_ = Auditee::where('user_id', $id)->orWhere('wakil_ketua_auditee', Auth::user()->name)->exists();
        // $auditee_ = Auditee::where('user_id', $id)->orWhere('id_wakilketua', $id)->exists();
        $user = User::find($id);

        $user->update([
            'peran' => 'auditee',
        ]);
        $user->save();

        if ($auditee_ || $user) {
            return redirect()->route('home.auditee')->with('success', 'Selamat datang di halaman Auditee!');
        } else {
            return redirect()->back();
        }
    }

    public function changeroleuser($id)
    {
        $user = User::find($id);

        $user->update([
            'peran' => 'user',
        ]);
        $user->save();
        
        return redirect()->route('home.auditee')->with('success', 'Selamat datang di halaman User!');
        
    }

    public function changerolespm($id)
    {
        $user_ = User::where('id', $id)->where('role_id', '1')->exists();
        $admin_ = User::where('id', $id)->where('role_id', '3')->exists();

        if ($user_) {
            $user = User::find($id);

            $user->update([
                'peran' => 'spm',
            ]);
            $user->save();
        } elseif ($admin_) {
            $admin = User::find($id);

            $admin->update([
                'peran' => 'superadmin',
            ]);
            $admin->save();
        }

        if ($user_) {
            return redirect()->route('home.spm')->with('success', 'Selamat datang di halaman SPM!');
        } elseif ($admin_) {
            return redirect()->route('home.spm')->with('success', 'Selamat datang di halaman Super Admin!');
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

<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return redirect()->route('daftaruser')->with('success', 'Data berhasil diupdate');
    }

    public function deletedata($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('daftaruser')->with('success', 'Data berhasil dihapus');
    }
}

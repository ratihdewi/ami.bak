<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use Illuminate\Http\Request;

class AuditeeController extends Controller
{
    public function index()
    {
        $data = Auditee::all();
        //dd($data);
        return view('daftarAuditee', compact('data'));
    }

    public function tambahauditee()
    {
        return view('addAuditee');
    }

    public function insertdata(Request $request)
    {
        // dd($request->all());
        Auditee::create($request->all());
        return redirect()->route('auditee');
    }

    public function tampildata($id){
        $data = Auditee::find($id);
        //dd($data);
        return view('updateAuditee', compact('data'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = Auditee::find($id);
        $data->update($request->all());
        return redirect()->route('auditee')->with('success', 'Data berhasil diupdate');
    }

    public function deletedata($id)
    {
        $data = Auditee::find($id);
        $data->delete();
        return redirect()->route('auditee')->with('success', 'Data berhasil dihapus');
    }
};

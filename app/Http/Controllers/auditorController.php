<?php

namespace App\Http\Controllers;

use App\Models\Auditor;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    public function index()
    {
        $dataAuditor = Auditor::all();
        // dd($data);
        return view('daftarAuditor', compact('dataAuditor'));
    }

    public function tambahauditor()
    {
        return view('addAuditor');
    }

    public function insertdata(Request $request)
    {
        // dd($request->all());
        Auditor::create($request->all());
        return redirect()->route('auditor');
    }

    public function tampildata($id){
        $data = Auditor::find($id);
        //dd($data);
        return view('updateAuditor', compact('data'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = Auditor::find($id);
        $data->update($request->all());
        return redirect()->route('auditor')->with('success', 'Data berhasil diupdate');
    }

    public function deletedata($id)
    {
        $data = Auditor::find($id);
        $data->delete();
        return redirect()->route('auditor')->with('success', 'Data berhasil dihapus');
    }
}

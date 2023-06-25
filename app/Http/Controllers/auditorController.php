<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditor;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    //role spm start
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
    //role spm end

    //role auditor start
    public function indexauditor()
    {
        $dataAuditor = Auditor::all();
        // dd($data);
        return view('auditor/daftarAuditor', compact('dataAuditor'));
    }

    public function profil()
    {
        return view('spm/detailAuditor');
    }
    //role auditor end

    //role auditee start
    public function indexauditee()
    {
        $dataAuditor = Auditor::all();
        // dd($data);
        return view('auditee/daftarAuditor', compact('dataAuditor'));
    }
    //role auditee end

    public function testPDF()
    {
        return response()->file(public_path('dokumen/example.pdf'),['content-type'=>'application/pdf']);
    }

    public function autocomplete(Request $request)
    {
        $datas = User::select("nip", "name")->where('role','LIKE','%'.'Auditor'.'%')
                ->where("nip","LIKE","%{$request->input('query')}%")
                ->get();
        $dataModified = array();
        foreach ($datas as $data)
        {
        $dataModified[] = $data->nip;
        }
        // dd($datas);
        return response()->json($dataModified);
    }
}

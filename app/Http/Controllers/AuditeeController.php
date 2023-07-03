<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use Illuminate\Http\Request;

class AuditeeController extends Controller
{
    public function index()
    {
        $data = Auditee::all();
        // dd($data);
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
        return redirect()->route('auditee')->with('success', 'Data berhasil ditambah');
    }

    public function tampildata($id){
        $data = Auditee::find($id);
        //dd($data);
        return view('spm/updateAuditee', compact('data'));
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

    public function autocomplete(Request $request)
    {
        $datas = User::select("name")->where('role','LIKE','%'.'Auditee'.'%')
                ->where("name","LIKE","%{$request->input('query')}%")
                ->get();
        $dataModified = array();
        foreach ($datas as $data)
        {
        $dataModified[] = $data->name;
        }
        // dd($datas);
        return response()->json($dataModified);
    }

    //role auditor start
    public function indexauditor()
    {
        $data = Auditee::all();
        // dd($data);
        return view('auditor/daftarAuditee', compact('data'));
    }
    //role auditor end

    //role auditee start
    public function indexauditee()
    {
        $data = Auditee::all();
        // dd($data);
        return view('auditee/daftarAuditee', compact('data'));
    }
    //role auditee end
};

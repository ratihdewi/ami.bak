<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\DaftarTilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DaftarTilikController extends Controller
{
    public function index() {
        $data = DaftarTilik::all();
        $data_ = Auditee::all();
        // dd($data_);
        return view('spm/daftarTilik', compact('data','data_'));
    }

    public function tambahDT()
    {
        $listAuditor = Auditor::all();
        $listAuditee = Auditee::all();
        // dd([[$listAuditee, $listAuditor]]);
        return view('spm/addAreaDaftarTilik', compact('listAuditor', 'listAuditee'));
    }

    public function insertdataArea(Request $request)
    {
        
        $isAlreadyExist = DaftarTilik::where('auditee_id', $request->auditee_id)->where('area', $request->area)->exists();

        if ($isAlreadyExist) {
            return redirect()->route('daftartilik')->with('error', 'Data sudah tersedia!');
        } else {
            DaftarTilik::create($request->all());
            return redirect()->route('daftartilik')->with('success', 'Data berhasil ditambah!');
        }
        
    }

    public function insertdaftartilik(Request $request)
    {
        //dd($request->all());
        DaftarTilik::create($request->all());
        return redirect()->route('daftartilik');
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
        //dd($datas);
        return response()->json($dataModified);
    }

    public function tampildata($id){
        $data = DaftarTilik::find($id);
        $listAuditee = Auditee::all();
        $listAuditor = Auditor::all();
        //dd($data->auditee->unit_kerja);
        return view('spm/updateAreaDaftarTilik', compact('data','listAuditee','listAuditor'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = DaftarTilik::find($id);
        $data->update($request->all());
        return redirect()->route('daftartilik')->with('success', 'Data berhasil diupdate');
    }

    public function deletedata($id)
    {
        $data = DaftarTilik::find($id);
        $data->delete();
        return redirect()->route('daftartilik')->with('success', 'Data berhasil dihapus');
    }
}

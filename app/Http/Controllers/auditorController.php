<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
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

    public function getAuditor()
    {
        $users_ = User::where('role', '!=', 'Auditee')->get();

        return response()->json($users_);
    }

    public function tambahauditor(Request $request)
    {
        $users_ = User::where('role', '!=', 'Auditee')->get();
        
        return view('addAuditor', compact('users_'));
    }

    public function insertdata(Request $request)
    {
    
        $isAlreadyExist = Auditor::where('nip', $request->nip)->exists();
        //dd($isAlreadyExist);
        if ($isAlreadyExist) {
            return redirect()->route('auditor')->with('error', 'Data sudah tersedia!');
        } else {
            Auditor::create($request->all());
            return redirect()->route('auditor')->with('success', 'Data berhasil ditambah');
        }

    }

    public function tampildata($id){
        $data = Auditor::find($id);
        //dd($data);
        return view('updateAuditor', compact('data'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = Auditor::find($id);
        $dataAuditorUsers = User::where('nip', $data->nip)->get();
        
        foreach ($dataAuditorUsers as $key => $dataAuditorUser) {
            if ( $dataAuditorUser->nip == $request->nip && $dataAuditorUser->name == $request->nama && $dataAuditorUser->unit_kerja == $request->program_studi && $dataAuditorUser->unit_kerja == $request->fakultas ) {
                
                $data->update($request->all());
                $dataAuditorUser->update([
                    'noTelepon' => $request->noTelepon,
                ]);
                
            } else {
                return redirect()->route('auditor')->with('error', 'Data tidak terdaftar sebagai user!');
            }
        }
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
    public function indexauditee()
    {
        $dataAuditee = Auditee::all();
        // dd($data);
        return view('auditor/daftarAuditee', compact('dataAuditee'));
    }

    public function profil()
    {
        return view('spm/detailAuditor');
    }
    //role auditor end

    //role auditee start
    public function indexauditor_()
    {
        $dataAuditor = Auditor::all();
        // dd($data);
        return view('auditee/daftarAuditor', compact('dataAuditor'));
    }
    public function indexauditee_()
    {
        $dataAuditee = Auditee::all();
        // dd($data);
        return view('auditee/daftarAuditee', compact('dataAuditee'));
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
        //dd($datas);
        return response()->json($dataModified);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use Illuminate\Http\Request;

class AuditeeController extends Controller
{
    public function index($tahunperiode)
    {
        $data = Auditee::where('tahunperiode', $tahunperiode)->get();
        // dd($data);
        return view('daftarAuditee', compact('data'));
    }

    public function indexpertahun()
    {
        $dataAuditee = Auditee::all();
        // dd($data);
        return view('spm/daftarauditee-tahun', compact('dataAuditee'));
    }

    public function tambahauditee()
    {
        $users_ = User::all();
        $auditor_ = Auditor::all();

        return view('addAuditee', compact('users_', 'auditor_'));
    }

    public function getAuditee()
    {
        $users_ = User::all();

        return response()->json($users_);
    }

    public function getAuditor()
    {
        $auditor_ = Auditor::all();

        return response()->json($auditor_);
    }


    public function insertdata(Request $request)
    {
        $isAlreadyExistAuditee = Auditee::where('nip', $request->nip)->where('tahunperiode', $request->tahunperiode)->exists();
        // $isAlreadyExistAuditor = Auditor::where('nip', $request->nip)->where('tahunperiode', $request->tahunperiode)->exists();
        //dd($isSimilarAuditor_);

        if ($request->ketua_auditor == $request->anggota_auditor) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Ketua Auditor tidak dapat menjadi anggota Auditor secara bersamaan!');
        } elseif ($isAlreadyExistAuditee) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Data Auditee sudah tersedia!');
        } else {
            Auditee::create($request->all());
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('success', 'Data berhasil ditambah');
        }
        
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
        return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('success', 'Data berhasil diupdate');
    }

    public function deletedata($id)
    {
        $data = Auditee::find($id);
        $data->delete();
        return redirect()->route('auditee', ['tahunperiode' => $data->tahunperiode])->with('success', 'Data berhasil dihapus');
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
    public function indexauditor($tahunperiode)
    {
        $data = Auditee::where('tahunperiode', $tahunperiode)->get();
        // dd($data);
        return view('auditor/daftarAuditee', compact('data'));
    }

    public function indexauditorpertahun()
    {
        $dataAuditee = Auditee::all();
        // dd($data);
        return view('auditor/daftarauditee-tahun', compact('dataAuditee'));
    }
    //role auditor end

    //role auditee start
    public function indexauditee($tahunperiode)
    {
        $data = Auditee::where('tahunperiode', $tahunperiode)->get();
        // dd($data);
        return view('auditee/daftarAuditee', compact('data'));
    }

    public function indexauditeepertahun()
    {
        $dataAuditee = Auditee::all();
        // dd($data);
        return view('auditee/daftarauditee-tahun', compact('dataAuditee'));
    }
    //role auditee end
};

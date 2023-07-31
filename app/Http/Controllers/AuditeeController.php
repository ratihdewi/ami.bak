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

    public function getAuditee($nip)
    {
        $data = User::where('nip', $nip)->where('nip', 'LIKE', '%'.request('q').'%')->get();

        return response()->json($data);
    }

    public function getAuditor()
    {
        $auditor_ = Auditor::all();

        return response()->json($auditor_);
    }

    public function getnipuser($tahun)
    {
        $auditees = Auditee::where('tahunperiode', $tahun)->pluck('user_id');
        $auditors = Auditor::where('tahunperiode', $tahun)->pluck('user_id');

        $data = User::whereNotIn('id', $auditees)
                    ->whereNotIn('id', $auditors)->where('nip', 'LIKE', '%'.request('q').'%')
                    ->get();

        return response()->json($data);
    }

    public function insertdata(Request $request)
    {
        $isAlreadyExistAuditee = Auditee::where('nip', $request->nip)->where('tahunperiode', $request->tahunperiode)->exists();

        if ($request->ketua_auditor == $request->anggota_auditor || $request->ketua_auditor == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Ketua Auditor tidak dapat menjadi anggota Auditor secara bersamaan!');
        } elseif ($isAlreadyExistAuditee) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Data Auditee sudah tersedia!');
        } elseif ($request->anggota_auditor == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Tim Auditor tidak dapat memiliki anggota auditor yang sama!');
        } elseif ($request->ketua_auditee == $request->ketua_auditor || $request->ketua_auditee == $request->anggota_auditor || $request->ketua_auditee == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Ketua Auditee dan Tim Auditor tidak dapat memilik data yang sama!');
        } else {
            Auditee::create($request->all());
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('success', 'Data berhasil ditambah pada periode '.$request->tahunperiode);
        }
        
    }

    public function tampildata($id){
        $data = Auditee::find($id);
        $users_ = User::all();
        $auditee = Auditee::all();
        //dd($data);
        return view('spm/updateAuditee', compact('data', 'auditee'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = Auditee::find($id);
        $existAuditor = Auditor::where('user_id', $data->user_id)->where('tahunperiode', $data->tahunperiode)->exists();
        // dd($existAuditor);

        if ($existAuditor) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Data sudah terdaftar sebagai Auditor di tahun yang sama!');
        } elseif ($request->ketua_auditee == $request->ketua_auditor || $request->ketua_auditee == $request->anggota_auditor || $request->ketua_auditee == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Ketua Auditee dan Tim Auditor tidak dapat memiliki data yang sama!');
        } elseif ($request->ketua_auditor == $request->anggota_auditor || $request->ketua_auditor == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Ketua Auditor tidak dapat menjadi anggota Auditor secara bersamaan!');
        } elseif ($request->anggota_auditor == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Tim Auditor tidak dapat memiliki anggota auditor yang sama!');
        } else {
            $data->update($request->all());
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('success', 'Data berhasil diupdate');
        }
    }

    public function deletedata($id)
    {
        $data = Auditee::find($id);
        $data->delete();
        return redirect()->route('auditee', ['tahunperiode' => $data->tahunperiode])->with('success', 'Data berhasil dihapus');
    }

    // public function autocomplete(Request $request)
    // {
    //     $datas = User::select("name")->where('role','LIKE','%'.'Auditee'.'%')
    //             ->where("name","LIKE","%{$request->input('query')}%")
    //             ->get();
    //     $dataModified = array();
    //     foreach ($datas as $data)
    //     {
    //     $dataModified[] = $data->name;
    //     }
    //     // dd($datas);
    //     return response()->json($dataModified);
    // }

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

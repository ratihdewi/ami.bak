<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\UnitKerja;
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
        $dataAuditee = Auditee::orderBy('tahunperiode0', 'ASC')->get();
        // dd($data);
        return view('spm/daftarauditee-tahun', compact('dataAuditee'));
    }

    public function tambahauditee()
    {
        $unitkerjas = UnitKerja::all();
        $currentYear = Carbon::now()->year;

        return view('addAuditee', compact('unitkerjas', 'currentYear'));
    }

    public function getAuditee()
    {
        $data = User::with('unitkerja')->get();

        return response()->json($data);
    }

    public function getAuditor($tahun)
    {
        $auditor_ = Auditor::where('tahunperiode', $tahun)->get();

        return response()->json($auditor_);
    }

    public function getnipuser($tahunperiode0, $tahunperiode)
    {
        $auditees = Auditee::where('tahunperiode0', $tahunperiode0)->where('tahunperiode', $tahunperiode)->pluck('user_id');
        $auditors = Auditor::where('tahunperiode0', $tahunperiode0)->where('tahunperiode', $tahunperiode)->pluck('user_id');

        $data = User::whereNotIn('id', $auditees)
                    ->whereNotIn('id', $auditors)->where('nip', 'LIKE', '%'.request('q').'%')
                    ->where('status', 'aktif')
                    ->get();

        return response()->json($data);
    }

    public function insertdata(Request $request)
    {
        $isAlreadyExistAuditee = Auditee::where('tahunperiode', $request->tahunperiode)->where('unit_kerja', $request->unit_kerja)->exists();

        // dd($isAlreadyExistAuditee);

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
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('success', 'Data berhasil ditambah pada periode '.$request->tahunperiode0.'/'.$request->tahunperiode);
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
        $unitkerja = UnitKerja::where('name', $request->unit_kerja)->first();
        $existKetuaAuditee = User::where('nip', $request->nip)->where('unitkerja_id', $unitkerja->id)->doesntExist();
        // dd($existKetuaAuditee);

        if ($existAuditor) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Data sudah terdaftar sebagai Auditor di tahun yang sama!');
        } elseif ($request->ketua_auditee == $request->ketua_auditor || $request->ketua_auditee == $request->anggota_auditor || $request->ketua_auditee == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Ketua Auditee dan Tim Auditor tidak dapat memiliki data yang sama!');
        } elseif ($request->ketua_auditor == $request->anggota_auditor || $request->ketua_auditor == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Ketua Auditor tidak dapat menjadi anggota Auditor secara bersamaan!');
        } elseif ($request->anggota_auditor == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Tim Auditor tidak dapat memiliki anggota auditor yang sama!');
        } elseif ($existKetuaAuditee) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'User '.$request->ketua_auditee.' tidak terdaftar pada unit kerja '.$data->unit_kerja.' !');
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
        $dataAuditee = Auditee::orderBy('tahunperiode0', 'ASC')->get();
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
        $dataAuditee = Auditee::orderBy('tahunperiode0', 'ASC')->get();
        // dd($data);
        return view('auditee/daftarauditee-tahun', compact('dataAuditee'));
    }
    //role auditee end
};

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    //role spm start
    public function index($tahunperiode)
    {
        $dataAuditor = Auditor::where('tahunperiode', $tahunperiode)->get();
        // dd($data);
        return view('daftarAuditor', compact('dataAuditor'));
    }

    public function indexpertahun()
    {
        $dataAuditor = Auditor::orderBy('tahunperiode0', 'ASC')->get();
        // dd($data);
        return view('spm/daftarauditor-tahun', compact('dataAuditor'));
    }

    public function getAuditor()
    {
        $users_ = User::with('unitkerja')->get();

        return response()->json($users_);
    }

    public function tambahauditor()
    {
        // $tahunAuditor = Auditor::where('tahunperiode', $tahunperiode);

        // $auditees = Auditee::where('tahunperiode', $tahunperiode)->pluck('user_id');
        // $auditors = Auditor::where('tahunperiode', $tahunperiode)->pluck('user_id');

        // $users_ = User::whereNotIn('id', $auditees)
        //             ->whereNotIn('id', $auditors)->where('nip', 'LIKE', '%'.request('q').'%')
        //             ->get();
        
        // return view('addAuditor', compact('users_', 'tahunAuditor', 'auditees', 'auditors'));
        return view('addAuditor');
    }

    public function getnipuser($tahunperiode0, $tahunperiode)
    {
        $auditees = Auditee::where('tahunperiode0', $tahunperiode0)->where('tahunperiode', $tahunperiode)->pluck('user_id');
        $auditors = Auditor::where('tahunperiode0', $tahunperiode0)->where('tahunperiode', $tahunperiode)->pluck('user_id');

        $data = User::whereNotIn('id', $auditees)
                    ->whereNotIn('id', $auditors)->where('nip', 'LIKE', '%'.request('q').'%')
                    ->get();
        
        return response()->json($data);
    }

    public function insertdata(Request $request)
    {
        $isAuditorExist = Auditor::where('nip', $request->nip)->where('tahunperiode', $request->tahunperiode)->exists();
        $isAuditeeExist = Auditee::where('nip', $request->nip)->where('tahunperiode', $request->tahunperiode)->exists();
        
        if ($isAuditorExist && $isAuditeeExist) {
            return redirect()->route('auditor', ['tahunperiode' => $request->tahunperiode])->with('error', 'Data sudah tersedia!');
        } else {
            Auditor::create($request->all());
            return redirect()->route('auditor', ['tahunperiode' => $request->tahunperiode])->with('success', 'Data berhasil ditambah');
        }

    }

    public function tampildata($id){
        $data = Auditor::find($id);
        
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
                return redirect()->route('auditor', ['tahunperiode' => $request->tahunperiode])->with('error', 'Data tidak terdaftar sebagai user!');
            }
        }
        return redirect()->route('auditor', ['tahunperiode' => $request->tahunperiode])->with('success', 'Data berhasil diupdate');
    }

    public function deletedata($id, $tahunperiode)
    {
        $data = Auditor::find($id);
        $data->delete();

        return redirect()->route('auditor', ['tahunperiode' => $tahunperiode])->with('success', 'Data berhasil dihapus');
    }
    //role spm end

    //role auditor start
    public function indexauditor($tahunperiode)
    {
        $dataAuditor = Auditor::where('tahunperiode', $tahunperiode)->get();
        
        return view('auditor/daftarAuditor', compact('dataAuditor'));
    }

    public function indexauditorpertahun()
    {
        $dataAuditor = Auditor::orderBy('tahunperiode0', 'ASC')->get();
        // dd($data);
        return view('auditor/daftarauditor-tahun', compact('dataAuditor'));
    }

    public function indexauditee()
    {
        $dataAuditee = Auditee::all();
        // dd($data);
        return view('auditor/daftarAuditee', compact('dataAuditee'));
    }

    public function profil()
    {
        $dataAuditor = Auditor::all();
        $dataAuditee = Auditee::all();

        return view('spm/detailAuditor', compact('dataAuditor', 'dataAuditee'));
    }
    //role auditor end

    //role auditee start
    public function indexauditor_($tahunperiode)
    {
        $dataAuditor = Auditor::where('tahunperiode', $tahunperiode)->get();
        // dd($data);
        return view('auditee/daftarAuditor', compact('dataAuditor'));
    }

    public function indexauditorpertahun_()
    {
        $dataAuditor = Auditor::orderBy('tahunperiode0', 'ASC')->get();
        // dd($data);
        return view('auditee/daftarauditor-tahun', compact('dataAuditor'));
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

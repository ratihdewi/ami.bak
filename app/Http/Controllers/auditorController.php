<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\TahunPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditorController extends Controller
{
    //role spm start
    public function index($tahunperiode)
    {
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode)->get();
        $dataAuditor = Auditor::where('tahunperiode', $tahunperiode)->get();
        // dd($data);
        return view('daftarAuditor', compact('dataAuditor', 'periodes'));
    }

    public function indexpertahun()
    {
        $currentYear = Carbon::now()->format('Y');
        $currentDate = Carbon::now()->format('l, d M Y');
        $dataAuditor = TahunPeriode::orderBy('tahunperiode1', 'ASC')->where('keterangan', 'Periode Auditor')->get();
        // dd($data);
        return view('spm/daftarauditor-tahun', compact('dataAuditor', 'currentYear', 'currentDate'));
    }

    public function getdatamodal($id)
    {
        $data = TahunPeriode::find($id);

        return response()->json($data);
    }

    public function updatedatamodal(Request $request, $id)
    {
        $tahunperiode = TahunPeriode::find($id);

        $tahunperiode->update($request->all());

        return redirect()->route('auditor-periode');
    }

    public function getAuditor()
    {
        $users_ = User::with('unitkerja')->get();

        return response()->json($users_);
    }

    public function tambahauditor($tahunperiode)
    {
        $currentYear = Carbon::now()->year;
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode);

        return view('addAuditor', compact('currentYear', 'periodes'));
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
        // dd($request->all());
        $isAuditorExist = Auditor::where('nip', $request->nip)->where('tahunperiode', $request->tahunperiode)->exists();
        $isAuditeeExist = Auditee::where('nip', $request->nip)->where('tahunperiode', $request->tahunperiode)->exists();

        $tahunmulai = $request->tgl_mulai;
        $tahunakhir = $request->tgl_berakhir;
        $tahun = Carbon::parse($tahunmulai)->year;
        $tahun_ = Carbon::parse($tahunakhir)->year;
        
        if ($isAuditorExist && $isAuditeeExist) {
            return redirect()->route('auditor', ['tahunperiode' => $request->tahunperiode])->with('error', 'Data sudah tersedia!');
        } elseif (($tahun < $request->tahunperiode0 || $tahun > $request->tahunperiode) && ($tahun_ < $request->tahunperiode0 || $tahun > $request->tahunperiode)) {
            return redirect()->route('auditor', ['tahunperiode' => $request->tahunperiode])->with('error', 'Tanggal tidak sesuai dengan periode pelaksanaan!');
        } else {
            Auditor::create($request->all());
            return redirect()->route('auditor', ['tahunperiode' => $request->tahunperiode])->with('success', 'Data berhasil ditambah');
        }

    }

    public function tampildata($id){
        $data = Auditor::find($id);
        $currentYear = Carbon::now()->year;
        
        return view('updateAuditor', compact('data', 'currentYear'));
    }

    public function updatedata(Request $request, $id)
    {
        // dd($request->all());
        $data = Auditor::find($id);
        $dataAuditorUsers = User::where('id', $request->user_id)->first();

        if ( $dataAuditorUsers->nip == $request->nip && $dataAuditorUsers->name == $request->nama && $dataAuditorUsers->unitkerja->name == $request->program_studi && $dataAuditorUsers->unitkerja->fakultas == $request->fakultas ) {
            // dd($request->all());
            $data->update($request->all());
            $dataAuditorUsers->update([
                'noTelepon' => $request->noTelepon,
            ]);
            
        } else {
            return redirect()->route('auditor', ['tahunperiode' => $request->tahunperiode])->with('error', 'Data tidak terdaftar sebagai user!');
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
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode)->where('keterangan', 'Periode Auditor')->get();
        
        return view('auditor/daftarAuditor', compact('dataAuditor', 'periodes'));
    }

    public function indexauditorpertahun()
    {
        $dataAuditor = TahunPeriode::orderBy('tahunperiode1', 'ASC')->where('keterangan', 'Periode Auditor')->get();
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

        if (Auth::user()->peran == "spm") {
            return view('spm/profile', compact('dataAuditor', 'dataAuditee'));
        } elseif (Auth::user()->peran == "auditor") {
            return view('auditor/profile', compact('dataAuditor', 'dataAuditee'));
        } else {
            return view('auditee/profile', compact('dataAuditor', 'dataAuditee'));
        }
        
    }
    //role auditor end

    //role auditee start
    public function indexauditor_($tahunperiode)
    {
        $dataAuditor = Auditor::where('tahunperiode', $tahunperiode)->get();
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode)->where('keterangan', 'Periode Auditor')->get();
        // dd($data);
        return view('auditee/daftarAuditor', compact('dataAuditor', 'periodes'));
    }

    public function indexauditorpertahun_()
    {
        $dataAuditor = TahunPeriode::orderBy('tahunperiode1', 'ASC')->where('keterangan', 'Periode Auditor')->get();
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

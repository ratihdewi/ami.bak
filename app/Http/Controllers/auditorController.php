<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\UnitKerja;
use App\Models\DaftarTilik;
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
        $unitkerja = UnitKerja::all();
        // dd($data);
        return view('daftarAuditor', compact('dataAuditor', 'periodes', 'unitkerja'));
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
        // dd($request->all());
        $tanggalmulai = Carbon::parse($request->tgl_mulai);
        $tanggalselesai = Carbon::parse($request->tgl_berakhir);
        $tahunmulai = $tanggalmulai->year;
        $tahunselesai = $tanggalselesai->year;
        $pengurangantahun = $tahunselesai - $tahunmulai;
        $tahunperiode = TahunPeriode::find($id);

        if ((($tahunmulai == $request->tahunperiode1 || $tahunmulai == $request->tahunperiode2) && ($tahunselesai == $request->tahunperiode1 || $tahunselesai == $request->tahunperiode2)) && ($pengurangantahun == 1 || $pengurangantahun == 0)) {
            $tahunperiode->update($request->all());

            return redirect()->route('auditor-periode')->with('success', 'Tahun periode berhasil ditambahkan!');
        } else {
            return redirect()->route('auditor-periode')->with('error', 'Tanggal tidak sesuai dengan tahun periode. Silahkan masukkan data kembali!');
        }
    }

    public function getAuditor()
    {
        $users = User::with('unitkerja')->get();
        $unitkerja = UnitKerja::all();

        $data = [
            "users" => $users,
            "unitkerja" => $unitkerja,
        ];

        return response()->json($data);
    }

    public function tambahauditor($tahunperiode)
    {
        $currentYear = Carbon::now()->year;
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode);

        return view('addAuditor', compact('currentYear', 'periodes'));
    }

    public function getnipuser($tahunperiode0, $tahunperiode)
    {
        $data = User::where('status', 'aktif')->get();
        
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
        $user = User::find($data->user_id);

        $unitkerja2 = UnitKerja::find($user->unitkerja_id2);
        $unitkerja3 = UnitKerja::find($user->unitkerja_id3);
        
        return view('updateAuditor', compact('data', 'currentYear', 'unitkerja2', 'unitkerja3', 'user'));
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
        $auditeeExist = Auditee::where('id_ketuaauditor', $id)->orWhere('id_anggotaauditor1', $id)->orWhere('id_anggotaauditor2', $id)->exists();
        $daftartilikExist = DaftarTilik::where('auditor_id', $id)->exists();
        if ($auditeeExist || $daftartilikExist) {
            return redirect()->route('auditor', ['tahunperiode' => $tahunperiode])->with('error', 'Data tidak dapat dihapus karena telah terdaftar pada Auditee dan Daftar Tilik.');
        } else {
            $data->delete();
            return redirect()->route('auditor', ['tahunperiode' => $tahunperiode])->with('success', 'Data berhasil dihapus');
        }
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

        $unitkerja1 = UnitKerja::where('id', Auth::user()->unitkerja_id)->first();
        $unitkerja2 = UnitKerja::where('id', Auth::user()->unitkerja_id2)->first();
        $unitkerja3 = UnitKerja::where('id', Auth::user()->unitkerja_id3)->first();

        // dd($unitkerja1);

        if (Auth::user()->peran == "spm") {
            return view('spm/profile', compact('dataAuditor', 'dataAuditee', 'unitkerja1', 'unitkerja2', 'unitkerja3'));
        } elseif (Auth::user()->peran == "auditor") {
            return view('auditor/profile', compact('dataAuditor', 'dataAuditee', 'unitkerja1', 'unitkerja2', 'unitkerja3'));
        } else {
            return view('auditee/profile', compact('dataAuditor', 'dataAuditee', 'unitkerja1', 'unitkerja2', 'unitkerja3'));
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

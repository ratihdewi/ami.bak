<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\UnitKerja;
use App\Models\TahunPeriode;
use Illuminate\Http\Request;

class AuditeeController extends Controller
{
    public function index($tahunperiode)
    {
        $data = Auditee::where('tahunperiode', $tahunperiode)->get();
        $periode = TahunPeriode::where('tahunperiode2', $tahunperiode)->where('keterangan', 'Periode Auditee')->first();
        // dd($data);
        return view('daftarAuditee', compact('data', 'periode'));
    }

    public function indexpertahun()
    {
        $currentYear = Carbon::now()->format('Y');
        $currentDate = Carbon::now()->format('l, d M Y');
        $dataAuditee = TahunPeriode::orderBy('tahunperiode1', 'ASC')->where('keterangan', 'Periode Auditee')->where('keterangan', 'Periode Auditee')->get();
        // dd($data);
        return view('spm/daftarauditee-tahun', compact('dataAuditee', 'currentYear', 'currentDate'));
    }

    public function getdatamodal($id)
    {
        $data = TahunPeriode::find($id);

        return response()->json($data);
    }

    public function updatedatamodal(Request $request, $id)
    {
        $tanggalmulai = Carbon::parse($request->tgl_mulai);
        $tanggalselesai = Carbon::parse($request->tgl_berakhir);
        $tahunmulai = $tanggalmulai->year;
        $tahunselesai = $tanggalselesai->year;
        $pengurangantahun = $tahunselesai - $tahunmulai;
        $tahunperiode = TahunPeriode::find($id);

        if ((($tahunmulai == $request->tahunperiode1 || $tahunmulai == $request->tahunperiode2) && ($tahunselesai == $request->tahunperiode1 || $tahunselesai == $request->tahunperiode2)) && ($pengurangantahun == 1 || $pengurangantahun == 0)) {
            $tahunperiode->update($request->all());

            return redirect()->route('auditee-periode')->with('success', 'Tahun periode berhasil ditambahkan!');
        } else {
            return redirect()->route('auditee-periode')->with('error', 'Tanggal tidak sesuai dengan tahun periode. Silahkan masukkan data kembali!');
        }
    }

    public function tambahauditee($thperiode1, $thperiode2)
    {
        $unitkerjas = UnitKerja::all();
        $currentYear = Carbon::now()->year;
        $periode = TahunPeriode::where('tahunperiode1', $thperiode1)->where('tahunperiode2', $thperiode2)->where('keterangan', 'Periode Auditee')->first();

        // dd($periode);

        return view('addAuditee', compact('unitkerjas', 'currentYear', 'periode'));
    }

    public function getAuditee()
    {
        $data = User::with('unitkerja')->get();

        return response()->json($data);
    }

    public function exGetAuditee()
    {
        $users = User::with('unitkerja')->get();
        $unitkerjas = UnitKerja::all();

        $data = [
            'users' => $users,
            'unitkerjas' => $unitkerjas
        ];

        return response()->json($data);
    }

    public function getAuditor($tahun)
    {
        $auditor_ = Auditor::where('tahunperiode', $tahun)->get();

        return response()->json($auditor_);
    }

    public function getnipuser($tahunperiode0, $tahunperiode)
    {
        $data = User::where('status', 'aktif')->get();

        return response()->json($data);
    }

    public function insertdata(Request $request)
    {
        $isAlreadyExistAuditee = Auditee::where('tahunperiode', $request->tahunperiode)->where('unit_kerja', $request->unit_kerja)->exists();


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
        if ($unitkerja != null) {
            $existKetuaAuditee = User::where('nip', $request->nip)->where('unitkerja_id', $unitkerja->id)->where('name', $request->ketua_auditee)->where('jabatan', $request->jabatan_ketua_auditee)->doesntExist();
        } else {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Unit kerja tidak terdaftar!');
        }
        
        if ($existAuditor) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Data sudah terdaftar sebagai Auditor di tahun yang sama!');
        } elseif ($request->ketua_auditee == $request->ketua_auditor || $request->ketua_auditee == $request->anggota_auditor || $request->ketua_auditee == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Ketua Auditee dan Tim Auditor tidak dapat memiliki data yang sama!');
        } elseif ($request->ketua_auditor == $request->anggota_auditor || $request->ketua_auditor == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Ketua Auditor tidak dapat menjadi anggota Auditor secara bersamaan!');
        } elseif ($request->anggota_auditor == $request->anggota_auditor2) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Tim Auditor tidak dapat memiliki anggota auditor yang sama!');
        } elseif ($existKetuaAuditee) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'User ('.$request->ketua_auditee.') tidak terdaftar pada unit kerja ('.$data->unit_kerja.') !');
        } elseif ($unitkerja == null) {
            return redirect()->route('auditee', ['tahunperiode' => $request->tahunperiode])->with('error', 'Unit kerja tidak terdaftar!');
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

    //role auditor start
    public function indexauditor($tahunperiode)
    {
        $data = Auditee::where('tahunperiode', $tahunperiode)->get();
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode)->where('keterangan', 'Periode Auditee')->get();
        
        return view('auditor/daftarAuditee', compact('data', 'periodes'));
    }

    public function indexauditorpertahun()
    {
        $dataAuditee = TahunPeriode::orderBy('tahunperiode1', 'ASC')->where('keterangan', 'Periode Auditee')->get();
        
        return view('auditor/daftarauditee-tahun', compact('dataAuditee'));
    }
    //role auditor end

    //role auditee start
    public function indexauditee($tahunperiode)
    {
        $data = Auditee::where('tahunperiode', $tahunperiode)->get();
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode)->where('keterangan', 'Periode Auditee')->get();
        
        return view('auditee/daftarAuditee', compact('data', 'periodes'));
    }

    public function indexauditeepertahun()
    {
        $dataAuditee = TahunPeriode::orderBy('tahunperiode1', 'ASC')->where('keterangan', 'Periode Auditee')->get();
        
        return view('auditee/daftarauditee-tahun', compact('dataAuditee'));
    }
    //role auditee end
};

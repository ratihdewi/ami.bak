<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Pertanyaan;
use App\Models\DaftarTilik;
use Illuminate\Http\Request;
use App\Exports\DaftarTilikExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class DaftarTilikController extends Controller
{
    public function index($tahunperiode) {
        $data_ = Auditee::where('tahunperiode', $tahunperiode)->get();
        // dd($data_);
        return view('spm/daftarTilik', compact('data_'));
    }

    public function indexpertahun() {
        $data_ = Auditee::all();

        // dd($data_);
        return view('spm/daftarTilik-tahun', compact('data_'));
    }

    public function tambahDT($tahunperiode)
    {   
        $listAuditee = Auditee::where('tahunperiode', $tahunperiode)->get();
        $listAuditor = Auditor::where('tahunperiode', $tahunperiode)->get();
        
        return view('spm/addAreaDaftarTilik', compact('listAuditee', 'listAuditor'));
    }

    public function insertdataArea(Request $request)
    {
        $isAlreadyExist = DaftarTilik::where('auditee_id', $request->auditee_id)->where('area', $request->area)->exists();
        $auditee_ = Auditee::where('id', $request->auditee_id)->first();
        $auditor_ = Auditor::all();
        $tahunperiode = $request->tgl_pelasksanaan;
        $years = new Carbon($tahunperiode);
        $years->year;

        if ($isAlreadyExist) {
            return redirect()->route('daftartilik', ['tahunperiode' => $years])->with('error', 'Data sudah tersedia!');
        } else {
            foreach ($auditor_ as $key => $auditor) {
                // dd($auditee_->ketua_auditor);
                if ($request->auditor_id == $auditor->id) {
                   if ($auditor->nama == $auditee_->ketua_auditor || $auditor->nama == $auditee_->anggota_auditor) {
                    DaftarTilik::create($request->all());
                    return redirect()->route('daftartilik', ['tahunperiode' => $years])->with('success', 'Data berhasil ditambah!');
                   } else {
                    return redirect()->route('daftartilik', ['tahunperiode' => $years])->with('error', 'Data Auditor tidak terdaftar sebagai Ketua maupun Anggota Auditor!');
                   }
                }
            }
        }
    }

    public function insertdaftartilik(Request $request)
    {
        //dd($request->all());
        $tahunperiode = $request->tgl_pelasksanaan;
        $years = new Carbon($tahunperiode);
        $years->year;
        DaftarTilik::create($request->all());
        return redirect()->route('daftartilik', ['tahunperiode' => $years]);
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

    public function tampildata($tahunperiode, $id){
        $data = DaftarTilik::find($id);
        $listAuditee = Auditee::where('tahunperiode', $tahunperiode)->get();
        $listAuditor = Auditor::where('tahunperiode', $tahunperiode)->get();
        //dd($data->auditee->unit_kerja);
        
        return view('spm/updateAreaDaftarTilik', compact('data','listAuditee','listAuditor'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = DaftarTilik::find($id);
        $data->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function deletedata($id)
    {
        $data = DaftarTilik::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function pratinjaudt($auditee_id, $area)
    {
        $daftartilik = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->first();
        $pertanyaan_ = Pertanyaan::where('daftartilik_id', $daftartilik->id)->where('auditee_id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->get();
        $jadwal_ = Jadwal::where('auditee_id', $auditee_id)->where('auditor_id', $daftartilik->auditor_id)->get();
        // dd($jadwal_);

        return view('spm/dt_pratinjau', compact('daftartilik_', 'pertanyaan_', 'jadwal_'));
    }

    public function auditor_pratinjaudt($auditee_id, $area)
    {
        $daftartilik = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->first();
        $pertanyaan_ = Pertanyaan::where('daftartilik_id', $daftartilik->id)->where('auditee_id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->get();
        $jadwal_ = Jadwal::where('auditee_id', $auditee_id)->where('auditor_id', $daftartilik->auditor_id)->get();
        // dd($jadwal_);

        return view('auditor/dt_pratinjau', compact('daftartilik_', 'pertanyaan_', 'jadwal_'));
    }

    public function auditee_pratinjaudt($auditee_id, $area)
    {
        $daftartilik = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->first();
        $pertanyaan_ = Pertanyaan::where('daftartilik_id', $daftartilik->id)->where('auditee_id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->get();
        $jadwal_ = Jadwal::where('auditee_id', $auditee_id)->where('auditor_id', $daftartilik->auditor_id)->get();
        // dd($jadwal_);
        
        return view('auditee/dt_pratinjau', compact('daftartilik_', 'pertanyaan_', 'jadwal_'));
    }

    public function exportexcel($id, $auditee_id)
    {
        $data = new DaftarTilikExport($id, $auditee_id); 
        $auditee_ = Auditee::where('id', $auditee_id)->first();
        $filename = 'Rancangan Daftar Tilik - '.$auditee_->unit_kerja.'.xlsx';
        

        return Excel::download($data, $filename);
    }

    // Role AUDITOR
    public function indexAuditor($tahunperiode) {
        $namaUser = Auth::user()->name;
        $dataAuditor_ = Auditor::where('nama', $namaUser)->where('tahunperiode', $tahunperiode)->get();
        // $data_ = DaftarTilik::where('auditor_id', $dataAuditor_->id)->get();
        // $dataAuditee_ = Auditee::all();
        //dd($dataAuditor_);
        
        return view('auditor/daftarTilik', compact('dataAuditor_'));
    }

    public function indexpertahunauditor()
    {
        $data_ = Auditee::all();

        if (count(Auth::user()->auditor()->get('user_id')) != 0 || (Auth::user()->role == 'SPM' && count(Auth::user()->auditor()->get('user_id')) != 0)) {
            return view('auditor/daftarTilik-tahun', compact('data_'));
        }
    }

    //Role AUDITEE
    public function indexAuditee($tahunperiode) {
        $unitkerja = Auth::User()->unit_kerja;
        $data_ = Auditee::where('unit_kerja', $unitkerja)->where('tahunperiode', $tahunperiode)->get();
        
        //dd($datas);
        return view('auditee/daftarTilik', compact('data_'));
    }

    public function indexpertahunauditee()
    {
        $data_ = Auditee::all();

        if (count(Auth::user()->auditee()->get('user_id')) != 0 || (Auth::user()->role == 'SPM' && count(Auth::user()->auditee()->get('user_id')) != 0)) {
            return view('auditee/daftarTilik-tahun', compact('data_'));
        }
    }
}

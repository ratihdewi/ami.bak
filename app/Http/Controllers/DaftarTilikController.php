<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\UnitKerja;
use App\Models\Pertanyaan;
use App\Models\DaftarTilik;
use App\Models\TahunPeriode;
use Illuminate\Http\Request;
use App\Models\AnggotaAuditee;
use App\Models\MasterPertanyaan;
use App\Models\kategoriUnitKerja;
use App\Exports\DaftarTilikExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class DaftarTilikController extends Controller
{
    public function index($tahunperiode) {
        $data_ = Auditee::where('tahunperiode', $tahunperiode)->get();
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode)->where('keterangan', 'Periode Auditee')->get();
        
        return view('spm/daftarTilik', compact('data_', 'periodes'));
    }

    public function indexpertahun() {
        $data_ = TahunPeriode::orderBy('tahunperiode1', 'ASC')->where('keterangan', 'Periode Auditee')->get();

        return view('spm/daftarTilik-tahun', compact('data_'));
    }

    public function tambahDT($tahunperiode)
    {   
        $locale = Config::get('app.locale');
        $timeZone = Config::get('app.timezone');
        $listAuditee = Auditee::where('tahunperiode', $tahunperiode)->get();
        $listAuditor = Auditor::where('tahunperiode', $tahunperiode)->get();
        $periode = TahunPeriode::where('tahunperiode2', $tahunperiode)->where('keterangan', 'Periode Auditee')->first();
        // $areas = Area::all();
        // $categories = kategoriUnitKerja::all();
        
        return view('spm/addAreaDaftarTilik', compact('listAuditee', 'listAuditor', 'locale', 'timeZone', 'periode'));
        // return view('spm/addAreaDaftarTilik', compact('listAuditee', 'listAuditor', 'locale', 'timeZone', 'periode', 'areas', 'categories'));
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
                if ($request->auditor_id == $auditor->nama) {
                   if ($auditor->nama == $auditee_->ketua_auditor || $auditor->nama == $auditee_->anggota_auditor || $auditor->nama == $auditee_->anggota_auditor2) {
                    
                    $areadt = new DaftarTilik;
                    $areadt->auditee_id = $request->auditee_id;
                    $areadt->auditor_id = $auditor->id;
                    $areadt->tgl_pelaksanaan = $request->tgl_pelaksanaan;
                    $areadt->tempat = $request->tempat;
                    $areadt->area = $request->area;
                    // $areadt->sasaran = $request->sasaran;
                    $areadt->bataspengisianRespon = $request->bataspengisianRespon;
                    $areadt->save();

                    $masterdata = MasterPertanyaan::where('sasaran_id', $areadt->sasaran)->where('area', $areadt->area)->where('status', 1)->get();
                    foreach ($masterdata as $key => $value) {
                        $pertanyaan =new Pertanyaan([
                            "daftartilik_id" => $areadt->id,
                            "auditee_id"=> $areadt->auditee_id,
                            "auditor_id"=> $areadt->auditor_id,
                            "butirStandar" => $value->butirStandar,
                            "nomorButir"=> $value->nomorButir,
                            "indikatormutu"=> $value->indikatormutu,
                            "targetStandar"=> $value->targetStandar,
                            "referensi"=> $value->referensi,
                            "keterangan"=> $value->keterangan,
                            "pertanyaan"=> $value->pertanyaan,
                        ]);
                        $pertanyaan->save();
                    }
                    
                    return redirect()->route('daftartilik', ['tahunperiode' => $auditee_->tahunperiode])->with('success', 'Data berhasil ditambah!');
                   } else {
                    return redirect()->route('daftartilik', ['tahunperiode' => $auditee_->tahunperiode])->with('error', 'Data Auditor tidak terdaftar sebagai Ketua maupun Anggota Auditor!');
                   }
                }
            }
        }
    }

    public function insertdaftartilik(Request $request)
    {
        $tahunperiode = $request->tgl_pelasksanaan;
        $years = new Carbon($tahunperiode);
        $years->year;
        DaftarTilik::create($request->all());
        return redirect()->route('daftartilik', ['tahunperiode' => $years]);
    }

    public function tampildata($tahunperiode, $id){
        $locale = Config::get('app.locale');
        $timeZone = Config::get('app.timezone');
        $data = DaftarTilik::find($id);
        $listAuditee = Auditee::where('tahunperiode', $tahunperiode)->get();
        $listAuditor = Auditor::where('tahunperiode', $tahunperiode)->get();
        // $areas = Area::all();
        // $categories = kategoriUnitKerja::all();
        
        return view('spm/updateAreaDaftarTilik', compact('data','listAuditee','listAuditor', 'locale', 'timeZone'));
        // return view('spm/updateAreaDaftarTilik', compact('data','listAuditee','listAuditor', 'locale', 'timeZone', 'areas', 'categories'));
    }

    public function getAuditee($id)
    {
        $data = Auditee::find($id);

        return response()->json($data);
    }

    public function updatedata(Request $request, $id)
    {
        $data = DaftarTilik::find($id);
        $tahunpelaksanaan = $data->tgl_pelaksanaan;
        $tahunpelaksanaan = Carbon::parse($tahunpelaksanaan)->year;
        $auditor = Auditor::where('nama', $request->auditor_id)
                            ->where(function ($query) use ($tahunpelaksanaan) {
                                $query->where('tahunperiode0', $tahunpelaksanaan)
                                    ->orWhere('tahunperiode', $tahunpelaksanaan);
                            })
                            ->first();

        $data->update([
            'auditor_id' => $auditor->id,
            'tgl_pelaksanaan' => $request->tgl_pelaksanaan,
            'tempat' => $request->tempat,
            'area' => $request->area,
            'sasaran' => $request->sasaran,
            'bataspengisianRespon' => $request->bataspengisianRespon,
        ]);
        $data->save();

        $pertanyaans = Pertanyaan::where('daftartilik_id', $data->id)->get();
        foreach ($pertanyaans as $key => $pertanyaan) {
            $pertanyaan->delete();
        }

        $masterdata = MasterPertanyaan::where('sasaran_id', $data->sasaran)->where('area', $data->area)->where('status', 1)->get();
        foreach ($masterdata as $key => $value) {
            $pertanyaan =new Pertanyaan([
                "daftartilik_id" => $data->id,
                "auditee_id"=> $data->auditee_id,
                "auditor_id"=> $data->auditor_id,
                "butirStandar" => $value->butirStandar,
                "nomorButir"=> $value->nomorButir,
                "indikatormutu"=> $value->indikatormutu,
                "targetStandar"=> $value->targetStandar,
                "referensi"=> $value->referensi,
                "keterangan"=> $value->keterangan,
                "pertanyaan"=> $value->pertanyaan,
            ]);
            $pertanyaan->save();
        }

        return redirect()->route('daftartilik', ['tahunperiode' => $data->auditee->tahunperiode])->with('success', 'Data berhasil diupdate');
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
        $pertanyaan_ = Pertanyaan::where('daftartilik_id', $daftartilik->id)->where('auditee_id', $auditee_id)->orderBy('nomorButir')->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->get();
        $jadwal_ = Jadwal::where('auditee_id', $auditee_id)->where('auditor_id', $daftartilik->auditor_id)->get();

        return view('spm/dt_pratinjau', compact('daftartilik_', 'pertanyaan_', 'jadwal_'));
    }

    public function auditor_pratinjaudt($auditee_id, $area)
    {
        $daftartilik = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->first();
        $pertanyaan_ = Pertanyaan::where('daftartilik_id', $daftartilik->id)->where('auditee_id', $auditee_id)->orderBy('nomorButir')->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->get();
        $jadwal_ = Jadwal::where('auditee_id', $auditee_id)->where('auditor_id', $daftartilik->auditor_id)->get();

        return view('auditor/dt_pratinjau', compact('daftartilik_', 'pertanyaan_', 'jadwal_'));
    }

    public function auditee_pratinjaudt($auditee_id, $area)
    {
        $daftartilik = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->first();
        $pertanyaan_ = Pertanyaan::where('daftartilik_id', $daftartilik->id)->where('auditee_id', $auditee_id)->orderBy('nomorButir')->get();
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
        $auditees = Auditee::where('ketua_auditor', Auth::user()->name)->where('tahunperiode', $tahunperiode)->orWhere('anggota_auditor', Auth::user()->name)->orWhere('anggota_auditor2', Auth::user()->name)->get();
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode)->where('keterangan', 'Periode Auditee')->get();

        return view('auditor/daftarTilik', compact('auditees', 'periodes'));
    }

    public function indexpertahunauditor()
    {
        $data_ = TahunPeriode::orderBy('tahunperiode1', 'ASC')->where('keterangan', 'Periode Auditee')->get();

        if (Auth::user()->peran == "auditor") {
            return view('auditor/daftarTilik-tahun', compact('data_'));
        }
    }

    //Role AUDITEE
    public function indexAuditee($tahunperiode) {
        $unitkerja = UnitKerja::where('id', Auth::user()->unitkerja_id)->first();
        $unitkerja2 = UnitKerja::where('id', Auth::user()->unitkerja_id2)->first();
        $unitkerja3 = UnitKerja::where('id', Auth::user()->unitkerja_id3)->first();
        $anggotaAuditees = AnggotaAuditee::all();
        $userSession = Auth::user()->name;
        
        if ($unitkerja2 != null && $unitkerja3 == null) {
            foreach ($anggotaAuditees as $key => $anggotaAuditee) {
                $data_ = Auditee::where('tahunperiode', $tahunperiode)
                        ->where(function($query) use ($unitkerja, $unitkerja2, $anggotaAuditee, $userSession) {
                            $query->where('id', $anggotaAuditee->auditee_id)
                                ->orWhere('unit_kerja', $unitkerja->name)
                                ->orWhere('unit_kerja', $unitkerja2->name)
                                ->orWhere('wakil_ketua_auditee', $userSession);
                        })
                        ->get();
            }
        } elseif ($unitkerja3 != null && $unitkerja2 == null) {
            foreach ($anggotaAuditees as $key => $anggotaAuditee) {
                $data_ = Auditee::where('tahunperiode', $tahunperiode)
                                ->where(function($query) use ($unitkerja, $unitkerja3, $anggotaAuditee, $userSession) {
                                    $query->where('id', $anggotaAuditee->auditee_id)
                                        ->orWhere('unit_kerja', $unitkerja->name)
                                        ->orWhere('unit_kerja', $unitkerja3->name)
                                        ->orWhere('wakil_ketua_auditee', $userSession);
                                })
                                ->get();    
            }
        } elseif ($unitkerja2 != null && $unitkerja3 != null) {
            foreach ($anggotaAuditees as $key => $anggotaAuditee) {
                $data_ = Auditee::where('tahunperiode', $tahunperiode)
                            ->where(function($query) use ($unitkerja, $unitkerja2, $unitkerja3, $anggotaAuditee, $userSession) {
                                $query->where('id', $anggotaAuditee->auditee_id)
                                    ->orWhere('unit_kerja', $unitkerja->name)
                                    ->orWhere('unit_kerja', $unitkerja2->name)
                                    ->orWhere('unit_kerja', $unitkerja3->name)
                                    ->orWhere('wakil_ketua_auditee', $userSession);
                            })
                            ->get();  
            }
        } else {
            foreach ($anggotaAuditees as $key => $anggotaAuditee) {
                $data_ = Auditee::where('tahunperiode', $tahunperiode)
                            ->where(function($query) use ($unitkerja, $unitkerja2, $unitkerja3, $anggotaAuditee, $userSession) {
                                $query->where('id', $anggotaAuditee->auditee_id)
                                    ->orWhere('unit_kerja', $unitkerja->name)
                                    ->orWhere('wakil_ketua_auditee', $userSession);
                            })
                            ->get();  
            }
        }
        
        $periodes = TahunPeriode::where('tahunperiode2', $tahunperiode)->where('keterangan', 'Periode Auditee')->get();
        
        return view('auditee/daftarTilik', compact('data_', 'periodes'));
    }

    public function indexpertahunauditee()
    {
        $data_ = TahunPeriode::orderBy('tahunperiode1', 'ASC')->where('keterangan', 'Periode Auditee')->get();
        $unitkerja = UnitKerja::where('id', Auth::user()->unitkerja_id)->first();
        $dataUser = Auditee::where('unit_kerja', $unitkerja->name)->orderBy('tahunperiode0', 'ASC')->get();

        return view('auditee/daftarTilik-tahun', compact('data_'));
    }

    public function getAuditor($auditee_id)
    {
        $data = Auditee::select('ketua_auditor', 'anggota_auditor', 'anggota_auditor2')->where('id', $auditee_id)->get();

        return response()->json($data);
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

    public function generateqrcode($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $htmlData = '<h1>Ini adalah judul</h1><p>Ini adalah paragraf</p>';
        $combinedData = $htmlData . '<p>Data dari database:</p>' . $formattedDataFromDatabase;
        $textData = strip_tags($combinedData);
        $qrCode = QrCode::generate($textData);
        return view('qrcode', compact('qrCode'));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Session;
use App\Models\JadwalAMI;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $filterTahun = $request->select_tahun;
        $filterUnitKerja = $request->select_auditee;

        $searches = Auditee::all();
        $unitkerjas = UnitKerja::all();
        $sessions = Session::all();
        $currentYear = Carbon::now()->format('Y');
        $currentTime = Carbon::now()->format('H:m');

        if ($filterTahun && $filterUnitKerja) {
            $auditee_ = Auditee::where('unit_kerja', 'LIKE', "%$filterUnitKerja%")
                                ->where('tahunperiode0', 'LIKE', "%$filterTahun%")
                                ->get();
            $jadwalami = JadwalAMI::orderBy('tgl_mulai', 'ASC')->whereYear('tgl_mulai', $currentYear)->get();
        } elseif ($filterTahun) {
            $auditee_ = Auditee::where('tahunperiode0', 'LIKE', "%$filterTahun%")->get();
            $jadwalami = JadwalAMI::orderBy('tgl_mulai', 'ASC')->whereYear('tgl_mulai', 'LIKE', "%$filterTahun%")->orWhereYear('tgl_berakhir', 'LIKE', "%$filterTahun%")->orWhereYear('tgl_berakhir', 'LIKE', '%' . ($filterTahun + 1) . '%')->orWhereYear('tgl_berakhir', 'LIKE', '%' . ($filterTahun + 1) . '%')->get();
        } elseif ($filterUnitKerja) {
            $auditee_ = Auditee::where('unit_kerja', 'LIKE', "%$filterUnitKerja%")->get();
            $jadwalami = JadwalAMI::orderBy('tgl_mulai', 'ASC')->whereYear('tgl_mulai', $currentYear)->get();
        } else {
            $auditee_ = Auditee::all();
            $jadwalami = JadwalAMI::orderBy('tgl_mulai', 'ASC')->whereYear('tgl_mulai', $currentYear)->get();
        }

        return view('spm/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions', 'currentTime', 'searches'));
    }

    // public function search(Request $request)
    // {
    //     // dd($request->all());
    //     $currentYear = Carbon::now()->format('Y');

    //     if ($request->select_auditee && $request->select_tahun) {
            
    //         $auditee_ = Auditee::where('unit_kerja', $request->select_auditee)->where(function ($query) use ($request) {
    //             $query->orWhere('tahunperiode0', $request->select_tahun)
    //                 ->orWhere('tahunperiode', $request->select_tahun);
    //         })->get();
    //         $jadwalami = JadwalAMI::whereYear('tgl_mulai', $currentYear)->get();
    //         $unitkerjas = UnitKerja::all();
    //         $sessions = Session::all();

    //         return view('spm/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));

    //     } elseif ($request->select_tahun) {
    //         $auditee_ = Auditee::where('tahunperiode0', $request->select_tahun)->orWhere('tahunperiode', $request->select_tahun)->get();
    //         $jadwalami = JadwalAMI::whereYear('tgl_mulai', $request->select_tahun)->orWhereYear('tgl_berakhir', $request->select_tahun)->orWhereYear('tgl_berakhir', $request->select_tahun+1)->orWhereYear('tgl_berakhir', $request->select_tahun+1)->get();
    //         $unitkerjas = UnitKerja::all();
    //         $sessions = Session::all();

    //         return view('spm/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));

    //     } elseif ($request->select_auditee) {
    //         $auditee_ = Auditee::where('unit_kerja', $request->select_auditee)->get();
    //         $jadwalami = JadwalAMI::whereYear('tgl_mulai', $currentYear)->get();
    //         $unitkerjas = UnitKerja::all();
    //         $sessions = Session::all();

    //         return view('spm/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));
    //     }
        
    // }

    public function auditor_search(Request $request)
    {
        // dd($request->all());
        $currentYear = Carbon::now()->format('Y');

        if ($request->select_auditee && $request->select_tahun) {
            
            $auditee_ = Auditee::where('unit_kerja', $request->select_auditee)->where(function ($query) use ($request) {
                $query->orWhere('tahunperiode0', $request->select_tahun)
                    ->orWhere('tahunperiode', $request->select_tahun);
            })->get();
            $jadwalami = JadwalAMI::whereYear('tgl_mulai', $currentYear)->get();
            $unitkerjas = UnitKerja::all();
            $sessions = Session::all();

            return view('auditor/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));

        } elseif ($request->select_tahun) {
            $auditee_ = Auditee::where('tahunperiode0', $request->select_tahun)->orWhere('tahunperiode', $request->select_tahun)->get();
            $jadwalami = JadwalAMI::whereYear('tgl_mulai', $request->select_tahun)->orWhereYear('tgl_berakhir', $request->select_tahun)->orWhereYear('tgl_berakhir', $request->select_tahun+1)->orWhereYear('tgl_berakhir', $request->select_tahun+1)->get();
            $unitkerjas = UnitKerja::all();
            $sessions = Session::all();

            return view('auditor/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));

        } elseif ($request->select_auditee) {
            $auditee_ = Auditee::where('unit_kerja', $request->select_auditee)->get();
            $jadwalami = JadwalAMI::whereYear('tgl_mulai', $currentYear)->get();
            $unitkerjas = UnitKerja::all();
            $sessions = Session::all();

            return view('auditor/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));
        }
    }

    public function auditee_search(Request $request)
    {
        // dd($request->all());
        $currentYear = Carbon::now()->format('Y');

        if ($request->select_auditee && $request->select_tahun) {
            
            $auditee_ = Auditee::where('unit_kerja', $request->select_auditee)->where(function ($query) use ($request) {
                $query->orWhere('tahunperiode0', $request->select_tahun)
                    ->orWhere('tahunperiode', $request->select_tahun);
            })->get();
            $jadwalami = JadwalAMI::whereYear('tgl_mulai', $currentYear)->get();
            $unitkerjas = UnitKerja::all();
            $sessions = Session::all();

            return view('auditee/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));

        } elseif ($request->select_tahun) {
            $auditee_ = Auditee::where('tahunperiode0', $request->select_tahun)->orWhere('tahunperiode', $request->select_tahun)->get();
            $jadwalami = JadwalAMI::whereYear('tgl_mulai', $request->select_tahun)->orWhereYear('tgl_berakhir', $request->select_tahun)->orWhereYear('tgl_berakhir', $request->select_tahun+1)->orWhereYear('tgl_berakhir', $request->select_tahun+1)->get();
            $unitkerjas = UnitKerja::all();
            $sessions = Session::all();

            return view('auditee/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));

        } elseif ($request->select_auditee) {
            $auditee_ = Auditee::where('unit_kerja', $request->select_auditee)->get();
            $jadwalami = JadwalAMI::whereYear('tgl_mulai', $currentYear)->get();
            $unitkerjas = UnitKerja::all();
            $sessions = Session::all();

            return view('auditee/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));
        }
        
    }

    public function auditor_index()
    {
        $currentYear = Carbon::now()->format('Y');

        $auditee_ = Auditee::all();
        $jadwalami = JadwalAMI::orderBy('tgl_mulai', 'ASC')->whereYear('tgl_mulai', $currentYear)->get();
        $unitkerjas = UnitKerja::all();
        $sessions = Session::all();

        return view('auditor/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));
    }

    public function auditee_index()
    {
        $currentYear = Carbon::now()->format('Y');

        $unitkerja = UnitKerja::where('id', Auth::user()->unitkerja_id)->first();
        $auditee_ = Auditee::where('unit_kerja', $unitkerja->name)->get();
        $jadwalami = JadwalAMI::orderBy('tgl_mulai', 'ASC')->whereYear('tgl_mulai', $currentYear)->get();
        $unitkerjas = UnitKerja::all();
        $sessions = Session::all();

        return view('auditee/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));
    }

    public function getAuditor($auditee_id)
    {
        $data = Auditee::where('id', $auditee_id)->get();

        return response()->json($data);
    }

    public function getUnitKerja($tahunperiode0, $tahunperiode)
    {
        $data = Auditee::where('tahunperiode0', $tahunperiode0)->where('tahunperiode', $tahunperiode)->get();

        return response()->json($data);
    }

    public function tambahjadwalaudit()
    {
        $auditee_ = Auditee::all();
        $thperiodeawal = $auditee_->min('tahunperiode0');
        $thperiodeakhir = $auditee_->max('tahunperiode');
        $auditor_ = Auditor::all();
        $currentYear = Carbon::now()->format('Y');

        return view ('spm/addJadwalAudit', compact('auditee_', 'auditor_', 'currentYear', 'thperiodeawal', 'thperiodeakhir'));
    }

    public function insertdata(Request $request)
    {
        // dd($request->addmore);
        $returns = null;
        foreach ($request->addmore as $key => $value) {
            // dd($value);
            $dateString = $value['hari_tgl'];
            $dateArray = date_parse($dateString);
            $date = date("Y-m-d", mktime(0, 0, 0, $dateArray["month"], $dateArray["day"], $dateArray["year"]));
            
            $auditorname = Auditor::where('nama', $value['auditor_id'])->first();
            $year = Carbon::parse($date)->year;
            
            $isExistAuditee = Auditee::where('id', $value['auditee_id'])->where('tahunperiode', $value['th_ajaran2'])->where(function ($query) use ($value) {
                $query->where('ketua_auditor', $value['auditor_id'])->orwhere('anggota_auditor', $value['auditor_id'])->orwhere('anggota_auditor2', $value['auditor_id']);
            })->exists();
            
            if ($isExistAuditee && ($value['th_ajaran1'] == $year || $value['th_ajaran2'] == $year)) {
                $jadwalaudit = new Jadwal;
                $jadwalaudit->auditee_id = $value['auditee_id'];
                $jadwalaudit->auditor_id = $auditorname->id;
                $jadwalaudit->th_ajaran1 = $value['th_ajaran1'];
                $jadwalaudit->th_ajaran2 = $value['th_ajaran2'];
                $jadwalaudit->hari_tgl = $date;
                $jadwalaudit->tempat = $value['tempat'];
                $jadwalaudit->waktu = $value['waktu'];
                $jadwalaudit->kegiatan = $value['kegiatan'];
                $jadwalaudit->save();
                
                $returns = redirect()->route('jadwalaudit')->with('success', 'Jadwal audit berhasil ditambah');
            } elseif (!$isExistAuditee) {
                $returns = redirect()->route('jadwalaudit')->with('error', 'Maaf, data tidak terdaftar sebagai Auditee. Silahkan input kembali data dengan benar!');
                // return $return;
            } elseif ($value['th_ajaran1'] != $year || $value['th_ajaran2'] != $year) {
                $returns = redirect()->route('jadwalaudit')->with('error', 'Maaf, tahun ajaran dan tanggal pelaksanaan tidak sesuai. Silahkan input kembali data dengan benar!');
                // return $return;
            }
            // $returns = $return;
        }
        
        return $returns;
    }

    public function tampildata($id){
        $data = Jadwal::find($id);
        $auditee_ = Auditee::all();
        $auditor_ = Auditor::find($data->auditor_id);
        //dd($data);
        return view('spm/updateJadwalAudit', compact('data', 'auditor_', 'auditee_'));
    }

    public function updatedata(Request $request, $id)
    {
        // dd($request->all());
        $data = Jadwal::find($id);

        foreach ($request->addmore as $key => $value) {
            $dateString = $value['hari_tgl'];
            $dateArray = date_parse($dateString);
            $date = date("Y-m-d", mktime(0, 0, 0, $dateArray["month"], $dateArray["day"], $dateArray["year"]));
            
            $auditorname = Auditor::where('nama', $value['auditor_id'])->first();
            $auditee = Auditee::where('unit_kerja', $value['auditee_id'])->where('tahunperiode0', $value['th_ajaran1'])->where('tahunperiode', $value['th_ajaran2'])->first();
            $year = Carbon::parse($date)->year;

            if ($year != $value['th_ajaran1'] || $year != $value['th_ajaran2']) {
                $data->update([
                    'th_ajaran1' => $value['th_ajaran1'],
                    'th_ajaran2' => $value['th_ajaran2'],
                    'auditee_id' => $auditee->id,
                    'auditor_id' => $auditorname->id,
                    'hari_tgl' => $date,
                    'tempat' => $value['tempat'],
                    'waktu' => $value['waktu'],
                    'kegiatan' => $value['kegiatan'],
                ]);
                $data->save();
                return redirect()->route('jadwalaudit')->with('success', 'Data berhasil diupdate!');
            } else {
                return redirect()->route('jadwalaudit')->with('error', 'Gagal melakukan perubahan jadwal audit.');
            }
        }
    }

    public function deletedata($id)
    {
        $data = Jadwal::find($id);
        $data->delete();
        return redirect()->route('jadwalaudit')->with('success', 'Data berhasil dihapus');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c)
    {
        //
    }
}

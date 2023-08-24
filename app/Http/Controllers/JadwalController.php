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

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentYear = Carbon::now()->format('Y');

        $auditee_ = Auditee::all();
        $jadwalami = JadwalAMI::orderBy('tgl_mulai', 'ASC')->whereYear('tgl_mulai', $currentYear)->get();
        $unitkerjas = UnitKerja::all();
        $sessions = Session::all();

        return view('spm/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));
    }

    public function search(Request $request)
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

            return view('spm/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));

        } elseif ($request->select_tahun) {
            $auditee_ = Auditee::where('tahunperiode0', $request->select_tahun)->orWhere('tahunperiode', $request->select_tahun)->get();
            $jadwalami = JadwalAMI::whereYear('tgl_mulai', $request->select_tahun)->orWhereYear('tgl_berakhir', $request->select_tahun)->orWhereYear('tgl_berakhir', $request->select_tahun+1)->orWhereYear('tgl_berakhir', $request->select_tahun+1)->get();
            $unitkerjas = UnitKerja::all();
            $sessions = Session::all();

            return view('spm/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));

        } elseif ($request->select_auditee) {
            $auditee_ = Auditee::where('unit_kerja', $request->select_auditee)->get();
            $jadwalami = JadwalAMI::whereYear('tgl_mulai', $currentYear)->get();
            $unitkerjas = UnitKerja::all();
            $sessions = Session::all();

            return view('spm/jadwalAudit', compact('auditee_', 'jadwalami', 'unitkerjas', 'sessions'));
        }
        
    }

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

    public function tambahjadwal()
    {
        return view('spm/addJadwal');
    }

    public function tambahjadwalaudit()
    {
        $auditee_ = Auditee::all();
        $auditor_ = Auditor::all();

        return view ('spm/addJadwalAudit', compact('auditee_', 'auditor_'));
    }

    public function insertdata(Request $request)
    {
        
        $returns = null;
        foreach ($request->addmore as $key => $value) {
            
            $auditorname = Auditor::where('nama', $value['auditor_id'])->first();
            $year = Carbon::parse($value['hari_tgl'])->year;
            
            $isExistAuditee = Auditee::where('id', $value['auditee_id'])->where('tahunperiode', $value['th_ajaran2'])->where(function ($query) use ($value) {
                $query->where('ketua_auditor', $value['auditor_id'])->orwhere('anggota_auditor', $value['auditor_id'])->orwhere('anggota_auditor2', $value['auditor_id']);
            })->exists();
            
            if ($isExistAuditee && ($value['th_ajaran1'] == $year || $value['th_ajaran2'] == $year)) {
                $jadwalaudit = new Jadwal;
                $jadwalaudit->auditee_id = $value['auditee_id'];
                $jadwalaudit->auditor_id = $auditorname->id;
                $jadwalaudit->th_ajaran1 = $value['th_ajaran1'];
                $jadwalaudit->th_ajaran2 = $value['th_ajaran2'];
                $jadwalaudit->hari_tgl = $value['hari_tgl'];
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
        $auditor_ = Auditor::all();
        //dd($data);
        return view('spm/updateJadwalAudit', compact('data', 'auditor_', 'auditee_'));
    }

    public function updatedata(Request $request, $id)
    {
        // dd($request->addmore);
        $data = Jadwal::find($id);
        
        if ($data->exists()) {
            $data->update($request->all());

            $returns = redirect()->route('jadwalaudit')->with('success', 'Data berhasil diupdate');
        } else {
            $returns = null;
            foreach ($request->addmore as $key => $value) {
                
                $auditorname = Auditor::find($value['auditor_id']);
                $year = Carbon::parse($value['hari_tgl'])->year;
                
                $isExistAuditee = Auditee::where('id', $value['auditee_id'])->where('tahunperiode', $value['th_ajaran2'])->where(function ($query) use ($auditorname) {
                    $query->where('ketua_auditor', $auditorname->nama)->orwhere('anggota_auditor', $auditorname->nama)->orwhere('anggota_auditor2', $auditorname->nama);
                })->exists();
                // $returns = null;
                if ($isExistAuditee && ($value['th_ajaran1'] == $year || $value['th_ajaran2'] == $year)) {
                    // dd($value);
                    $jadwalaudit = new Jadwal;
                    $jadwalaudit->auditee_id = $value['auditee_id'];
                    $jadwalaudit->auditor_id = $value['auditor_id'];
                    $jadwalaudit->th_ajaran1 = $value['th_ajaran1'];
                    $jadwalaudit->th_ajaran2 = $value['th_ajaran2'];
                    $jadwalaudit->hari_tgl = $value['hari_tgl'];
                    $jadwalaudit->tempat = $value['tempat'];
                    $jadwalaudit->waktu = $value['waktu'];
                    $jadwalaudit->kegiatan = $value['kegiatan'];
                    $jadwalaudit->save();
                    
                    $returns = redirect()->route('jadwalaudit')->with('success', 'Jadwal audit berhasil ditambah');
                    // return $return;
                } elseif (!$isExistAuditee) {
                    $returns = redirect()->route('jadwalaudit')->with('error', 'Maaf, data tidak terdaftar sebagai Auditee. Silahkan input kembali data dengan benar!');
                    // return $return;
                } elseif ($value['th_ajaran1'] != $year || $value['th_ajaran2'] != $year) {
                    $returns = redirect()->route('jadwalaudit')->with('error', 'Maaf, tahun ajaran dan tanggal pelaksanaan tidak sesuai. Silahkan input kembali data dengan benar!');
                    // return $return;
                }
                // $returns = $return;
            }
        }
        
        return $returns;
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

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jadwal::all();
        //dd($data);
        return view('spm/jadwalAudit', compact('data'));
    }

    public function filter(Request $request)
    {
        $jadwal = Jadwal::query();

        $jadwal->when($request->auditee, function($query) use ($request) {
            return $query->where('auditee', 'like', '%'.$request->name.'%');
        });

        // $tahun = ($request->hari_tgl)->format('Y');

        // $jadwal->when($tahun, function($query) use ($request) {
        //     return $query->where($tahun, 'like', '%'.($request->hari_tgl)->format('Y').'%');
        // });

        // dd($jadwal);

        return view('spm/jadwalAudit'); 
    }

    public function tambahjadwal()
    {
        return view('spm/addJadwal');
    }

    public function tambahjadwalaudit()
    {
        return view ('spm/addJadwalAudit');
    }

    public function insertdata(Request $request)
    {
        //dd($request->all());
        Jadwal::create($request->all());
        return redirect()->route('jadwalaudit');
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

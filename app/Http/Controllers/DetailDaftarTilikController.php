<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Pertanyaan;
use App\Models\DaftarTilik;
use Illuminate\Http\Request;

class DetailDaftarTilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($auditee_id, $area)
    {
        $data = DaftarTilik::all()->where('auditee_id', $auditee_id)->where('area', $area)->first();
        $daftartilik_id = $data->id;
        $data_ = Pertanyaan::all()->where('daftartilik_id', $daftartilik_id);
        //dd($data_);
        return view('spm/areaDaftarTilik', compact('data', 'data_'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($auditee_id, $area)
    {
        $data = DaftarTilik::all()->where('auditee_id', $auditee_id)->where('area', $area);
        $data_ = Pertanyaan::all();
        $listAuditee = Auditee::all();
        $listAuditor = Auditor::all();

        // dd($data->auditee_id);
        return view('spm/addDaftarTilik', compact('data', 'data_', 'listAuditee', 'listAuditor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auditee_id = $request->get('auditee_id');
        $daftartilik_id = $request->get('daftartilik_id');
        $_area = DaftarTilik::all()->where('auditee_id', $auditee_id)->where('id', $daftartilik_id)->first();

        $requestData = $request->all();
        $fileName = time().$request->file('dokSahih')->getClientOriginalName();
        $fileFoto = time().$request->file('fotoKegiatan')->getClientOriginalName();
        $pathFile = $request->file('dokSahih')->storeAs('dokumenSahih', $fileName, 'public');
        $pathFoto = $request->file('fotoKegiatan')->storeAs('DokumenFoto', $fileFoto, 'public');
        $requestData["dokSahih"] = '/storage/'.$pathFile;
        $requestData["fotoKegiatan"] = '/storage/'.$pathFoto;
        Pertanyaan::create($requestData);
        // return redirect('employee')->with('flash_message', 'Employee Addedd!');
        return redirect()->route('areadaftartilik', ['auditee_id' => $auditee_id, 'area' => $_area->area])->with('success', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

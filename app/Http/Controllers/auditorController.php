<?php

namespace App\Http\Controllers;

use App\Models\Auditor;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    public function index()
    {
        $dataAuditor = Auditor::all();
        // dd($data);
        return view('daftarAuditor', compact('dataAuditor'));
    }

    public function tambahauditor()
    {
        return view('addAuditor');
    }

    public function insertdata(Request $request)
    {
        // dd($request->all());
        Auditor::create($request->all());
        return redirect()->route('auditor');
    }
}

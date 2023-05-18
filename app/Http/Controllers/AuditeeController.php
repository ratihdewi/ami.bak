<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use Illuminate\Http\Request;

class AuditeeController extends Controller
{
    public function index()
    {
        $data = Auditee::all();
        //dd($data);
        return view('daftarAuditee', compact('data'));
    }

    public function tambahauditee()
    {
        return view('addAuditee');
    }

     public function insertdata(Request $request)
    {
        // dd($request->all());
        Auditee::create($request->all());
        return redirect()->route('auditee');
    }
};

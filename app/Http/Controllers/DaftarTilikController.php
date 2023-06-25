<?php

namespace App\Http\Controllers;

use App\Models\Auditor;
use App\Models\DaftarTilik;
use Illuminate\Http\Request;

class DaftarTilikController extends Controller
{
    public function index() {
        $data = DaftarTilik::all();
        //dd($data);
        return view('spm/daftarTilik', compact('data'));
    }

    public function tambahDT()
    {
        $listAuditor = Auditor::all();
        // dd($listAuditor);
        return view('spm/addDaftarTilik', compact('listAuditor'));
    }

    // public function readDataAuditor()
    // {
    //     $listAuditor = Auditor::all();
    //     dd($data);
    // }
}

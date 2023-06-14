<?php

namespace App\Http\Controllers;

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
        return view('spm/addDaftarTilik');
    }
}

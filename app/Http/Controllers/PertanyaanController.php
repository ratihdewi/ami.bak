<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        $data = Pertanyaan::all();
        //dd($data);
        return view('spm/areaDaftarTilik', compact('data'));
    }
}

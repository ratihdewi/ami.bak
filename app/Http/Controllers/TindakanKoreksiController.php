<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TindakanKoreksiController extends Controller
{
    public function index()
    {
        return view('spm/tindakanKoreksi');
    }

    public function daftarTemuan()
    {
        return view('spm/temuanTindakanKoreksi');
    }
}

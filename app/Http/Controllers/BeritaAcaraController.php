<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        return view('spm/beritaAcara');
    }
    public function tampiltemuanBA()
    {
        return view('spm/auditeeBA');
    }
}

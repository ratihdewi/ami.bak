<?php

use Illuminate\Support\Facades\Route;
use App\Models\Auditor;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('daftarAuditor', [
        "title" => "Daftar Auditor",
        "dataAuditor" => Auditor::all()
    ]);
});

Route::get('/addAuditor', function() {
    return view('addAuditor');
});

Route::get('/daftarAuditee', function() {
    return view('daftarAuditee');
});

Route::get('/daftarAuditor', function() {
    return view('daftarAuditor', [
        "title" => "Daftar Auditor",
        "dataAuditor" => Auditor::all()
    ]);
});
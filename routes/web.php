<?php

use App\Models\Auditor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditeeController;
use App\Http\Controllers\AuditorController;

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

Route::get('/addAuditor', [AuditorController::class, 'tambahauditor'])->name('tambahauditor');
Route::post('/insertAuditor', [AuditorController::class, 'insertdata'])->name('insertauditor');

Route::get('/addAuditee', [AuditeeController::class, 'tambahauditee'])->name('tambahauditee');
Route::post('/insertAuditee', [AuditeeController::class, 'insertdata'])->name('insertauditee');

Route::get('/daftarAuditee', [AuditeeController::class, 'index'])->name('auditee');

Route::get('/daftarAuditor', [AuditorController::class, 'index'])->name('auditor');
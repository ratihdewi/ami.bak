<?php

use App\Models\Auditor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuditeeController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('daftarAuditor', [
//         "title" => "Daftar Auditor",
//         "dataAuditor" => Auditor::all()
//     ]);
// });

// Route::get('/', function(){
//     return redirect()->route('login');
// });

Route::get('/', function(){
    return view('welcome');
});

Route::get('/addAuditor', [AuditorController::class, 'tambahauditor'])->name('tambahauditor');
Route::post('/insertAuditor', [AuditorController::class, 'insertdata'])->name('insertauditor');

Route::get('/addAuditee', [AuditeeController::class, 'tambahauditee'])->name('tambahauditee');
Route::post('/insertAuditee', [AuditeeController::class, 'insertdata'])->name('insertauditee');

Route::get('/tampilAuditee/{id}', [AuditeeController::class, 'tampildata'])->name('tampilauditee');
Route::post('/updateAuditee/{id}', [AuditeeController::class, 'updatedata'])->name('updateauditee');
Route::get('/deleteAuditee/{id}', [AuditeeController::class, 'deletedata'])->name('deleteauditee');

Route::get('/tampilAuditor/{id}', [AuditorController::class, 'tampildata'])->name('tampilauditor');
Route::post('/updateAuditor/{id}', [AuditorController::class, 'updatedata'])->name('updateauditor');
Route::get('/deleteAuditor/{id}', [AuditorController::class, 'deletedata'])->name('deleteauditor');

Route::get('/daftarAuditee', [AuditeeController::class, 'index'])->name('auditee');

Route::get('/daftarAuditor', [AuditorController::class, 'index'])->name('auditor');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

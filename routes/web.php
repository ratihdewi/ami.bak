<?php

use App\Models\Auditor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AuditeeController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\DaftarTilikController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\TindakanKoreksiController;

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
Route::get('/', function(){
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Role SPM
Route::get('/usercontrol', [UserController::class, 'index'])->name('daftaruser');
Route::get('/addUser', [UserController::class, 'tambahuser'])->name('tambahuser');
Route::post('/insertUser', [UserController::class, 'insertdata'])->name('insertuser');
Route::get('/tampilUser/{id}', [UserController::class, 'tampildata'])->name('tampiluser');
Route::post('/updateUser/{id}', [UserController::class, 'updatedata'])->name('updateuser');
Route::get('/deleteUser/{id}', [UserController::class, 'deletedata'])->name('deleteuser');
Route::get('/searchuser-addauditor', [UserController::class, 'viewuser'])->name('searchnipauditor');
Route::get('/findusers', [UserController::class, 'getuser'])->name('finduserauditor');
Route::get('/jadwalaudit', [JadwalController::class, 'index'])->name('jadwalaudit');
Route::get('/jadwalaudit-filter', [JadwalController::class, 'filter'])->name('jadwalauditfilter');
Route::get('/jadwalauditAMI-tambahjadwal', [JadwalController::class, 'tambahjadwal'])->name('tambahjadwal');
Route::get('/jadwalaudit-tambahjadwal', [JadwalController::class, 'tambahjadwalaudit'])->name('tambahjadwalaudit');
Route::post('/insertjadwal', [JadwalController::class, 'insertdata'])->name('insertjadwal');
// Route::get('/insertjadwal', [JadwalController::class, 'index'])->name('insertjadwal');
Route::get('/jadwalaudit-tampiljadwalaudit/{id}', [JadwalController::class, 'tampildata'])->name('tampiljadwalaudit');
Route::post('/jadwalaudit-updatejadwalaudit/{id}', [JadwalController::class, 'updatedata'])->name('updatejadwalaudit');
Route::get('/jadwalaudit-deletejadwalaudit/{id}', [JadwalController::class, 'deletedata'])->name('deletejadwalaudit');
Route::get('/dokresmi', function(){
    return view('spm/dokResmi');
});
Route::get('/daftartilik', [DaftarTilikController::class, 'index'])->name('daftartilik');
Route::get('/DaftarTilik-adddaftartilik', [DaftarTilikController::class, 'tambahDT'])->name('addDT');
Route::get('/beritaacara', [BeritaAcaraController::class, 'index'])->name('beritaacara');
Route::get('/auditeeBA', [BeritaAcaraController::class, 'tampiltemuanBA'])->name('auditeeBA');
Route::get('/BA-AMI', [BeritaAcaraController::class, 'tampilBA_AMI'])->name('BA-AMI');
Route::get('/ubahdataBA', [BeritaAcaraController::class, 'ubahdata'])->name('ubahdataBA');
Route::get('/tindakankoreksi', [TindakanKoreksiController::class, 'index'])->name('tindakankoreksi');
Route::get('/tindakankoreksi-temuan', [TindakanKoreksiController::class, 'daftarTemuan'])->name('tindakankoreksi-temuan');
Route::get('/tindakankoreksi-formtemuan', [TindakanKoreksiController::class, 'tampilForm'])->name('tindakankoreksi-formtemuan');

// Role Auditor
Route::get('/auditor-daftarauditee', [AuditeeController::class, 'indexauditor'])->name('auditor-auditee');
Route::get('/auditor-daftarauditor', [AuditorController::class, 'indexauditor'])->name('auditor-auditor');
Route::get('/auditor-detailauditor', [AuditorController::class, 'profil'])->name('auditor-detailauditor');
Route::get('/auditor-dokresmi', [AuditorController::class, 'testPDF'])->name('auditor-dokresmi');
Route::get('/auditor-searchAuditor', [AuditorController::class, 'autocompleteSearch'])->name('auditor-searchAuditor');

//Role Auditee
Route::get('/auditee-daftarauditee', [AuditeeController::class, 'indexauditee'])->name('auditee-auditee');
Route::get('/auditee-daftarauditor', [AuditorController::class, 'indexauditee'])->name('auditee-auditor');

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

Route::get('/ketersediaan-jadwal', [FullCalenderController::class, 'index']);

Route::post('/ketersediaan-jadwal/action', [FullCalenderController::class, 'action']);


<?php

use App\Models\Auditor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AuditeeController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\DokBAAMIController;
use App\Http\Controllers\DokSahihController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\DaftarHadirController;
use App\Http\Controllers\DaftarTilikController;
use App\Http\Controllers\DokLampiranController;
use App\Http\Controllers\FotoKegiatanController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\TindakanKoreksiController;
use App\Http\Controllers\PeluangPeningkatanController;

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
Route::get('/changeroleauditor/{id}', [UserController::class, 'changeroleauditor'])->name('changeroleauditor');
Route::get('/changeroleauditee/{id}', [UserController::class, 'changeroleauditee'])->name('changeroleauditee');
Route::get('/changerolespm/{id}', [UserController::class, 'changerolespm'])->name('changerolespm');

//Route Role SPM
Route::get('/daftarAuditor-periode', [AuditorController::class, 'indexpertahun'])->name('auditor-periode');
Route::get('/daftarAuditee-periode', [AuditeeController::class, 'indexpertahun'])->name('auditee-periode');
Route::get('/daftartilik-periode', [DaftarTilikController::class, 'indexpertahun'])->name('daftartilik-periode');
Route::get('/auditor-searchAuditor', [AuditorController::class, 'getAuditor'])->name('auditor-searchAuditor');
Route::get('/tambahauditee-searchAuditee/{nip}', [AuditeeController::class, 'getAuditee'])->name('searchAuditee');
Route::get('/tambahauditee-searchAuditor/{tahun}', [AuditeeController::class, 'getAuditor'])->name('searchAuditor');
Route::get('tambahauditee-searchnipuser/{tahun}', [AuditeeController::class, 'getnipuser'])->name('searchnipuser');
Route::get('/tambahauditor-searchnipuser/{tahun}', [AuditorController::class, 'getnipuser'])->name('auditor-searchnipuser');
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
Route::get('/daftartilik/{tahunperiode}', [DaftarTilikController::class, 'index'])->name('daftartilik');
Route::get('/daftartilik-searchAuditeeAuditor', [DaftarTilikController::class, 'getAuditor'])->name('daftartilik-searchAuditeeAuditor');
Route::get('/daftarTilik-addareadaftartilik/{tahunperiode}', [DaftarTilikController::class, 'tambahDT'])->name('addDT');
Route::get('/daftartilik-tampildaftartilik/{tahunperiode}/{id}', [DaftarTilikController::class, 'tampildata'])->name('daftartilik-tampildaftartilik');
Route::post('/daftartilik-updatedataareadaftartilik/{id}', [DaftarTilikController::class, 'updatedata'])->name('daftartilik-updatedataareadaftartilik');
Route::get('/daftartilik-deletedataareadaftartilik/{id}', [DaftarTilikController::class, 'deletedata'])->name('daftartilik-deletedataareadaftartilik');
Route::get('/daftarTilik-areadaftartilik/{auditee_id}/{area}', [PertanyaanController::class, 'index'])->name('areadaftartilik');
Route::get('/daftartilik-pratinjaudaftartilik/{auditee_id}/{area}', [DaftarTilikController::class, 'pratinjaudt'])->name('daftartilik-pratinjaudaftartilik');
Route::get('/daftartilik-exportdaftartilik/{id}/{auditee_id}', [DaftarTilikController::class, 'exportexcel'])->name('daftartilik-exportdaftartilik');
Route::get('/daftartilik-adddaftartilik/{auditee_id}/{area}', [PertanyaanController::class, 'tambahdata'])->name('daftartilik-adddaftartilik');
Route::post('/daftartilik-insertpertanyaan', [PertanyaanController::class, 'insertpertanyaan'])->name('daftartilik-insertpertanyaan');
Route::get('/daftartilik-tampilpertanyaandaftartilik/{id}', [PertanyaanController::class, 'tampildata'])->name('daftartilik-tampilpertanyaandaftartilik');
Route::post('/daftartilik-updatedatapertanyaandaftartilik/{id}', [PertanyaanController::class, 'updatedata'])->name('daftartilik-updatedatapertanyaandaftartilik');
Route::get('/daftartilik-deletedatapertanyaandaftartilik/{id}', [PertanyaanController::class, 'deletedata'])->name('daftartilik-deletedatapertanyaandaftartilik');
Route::post('/insertareaDT', [DaftarTilikController::class, 'insertdataArea'])->name('insertareaDT');
Route::get('/beritaacara', [BeritaAcaraController::class, 'index'])->name('beritaacara');
Route::get('/auditeeBA/{auditee_id}/{tahunperiode}', [BeritaAcaraController::class, 'tampiltemuanBA'])->name('auditeeBA');
Route::get('/BA-AMI/{auditee_id}', [DokBAAMIController::class, 'tampilBA_AMI'])->name('BA-AMI');
Route::get('/BA-ubahdataDokumenBAAMI/{auditee_id}', [DokBAAMIController::class, 'ubahdataDokumenBA'])->name('BA-ubahdataDokumenBAAMI');
Route::get('/BA-ubahdataberitaacaraAMI/{auditee_id}', [DokBAAMIController::class, 'ubahdataBAAMI'])->name('BA-ubahdataberitaacaraAMI');
Route::post('/BA-AMI-insertdatadokumen/{auditee_id}', [DokBAAMIController::class, 'insertdataDokumenBA'])->name('BA-AMI-insertdatasokumen');
Route::post('/BA-AMI-updatedataBAAMI/{auditee_id}', [DokBAAMIController::class, 'updatedataBAAMI'])->name('BA-AMI-updatedataBAAMI');
Route::get('/BAAMI-approvalKetuaAuditor/{id}', [DokBAAMIController::class, 'approvalAuditor'])->name('BAAMI-approvalKetuaAuditor');
Route::get('/BAAMI-approvalKetuaAuditee/{id}', [DokBAAMIController::class, 'approvalAuditee'])->name('aBAAMI-approvalKetuaAuditee');
Route::get('/BAAMI-pratinjauBA/{auditee_id}', [DokBAAMIController::class, 'pratinjauba'])->name('BAAMI-pratinjauBA');
Route::get('/BAAMI-downloadBA/{id}', [DokBAAMIController::class, 'downloadba'])->name('BAAMI-downloadBA');
Route::get('/view-doksahih', [PertanyaanController::class, 'testPDF'])->name('auditor-doksahih');
Route::get('/BA-daftarhadir/{auditee_id}', [DaftarHadirController::class, 'editdaftarhadir'])->name('BA-daftarhadir');
Route::post('/BA-savedaftarhadir/{auditee_id}', [DaftarHadirController::class, 'storedaftarhadir'])->name('BA-savedaftarhadir');
Route::get('/BA-deletedaftarhadir/{id}', [DaftarHadirController::class, 'deletedaftarhadir'])->name('BA-deletedaftarhadir');
Route::get('/BA-esignpeserta/{id}', [DaftarHadirController::class, 'esignpeserta'])->name('BA-esignpeserta');
Route::get('/BA-daftarhadir-searchAuditor', [DaftarHadirController::class, 'getAuditor'])->name('BA-daftarhadir-searchAuditor');
Route::get('/BA-daftarhadir-searchAuditee', [DaftarHadirController::class, 'getAuditee'])->name('BA-daftarhadir-searchAuditee');
Route::get('/BA-peluangpeningkatan/{auditee_id}', [PeluangPeningkatanController::class, 'ubahpeluangpeningkatan'])->name('BA-peluangpeningkatan');
Route::post('/BA-addpeluangpeningkatan/{auditee_id}', [PeluangPeningkatanController::class, 'storePeluangPeningkatan'])->name('BA-addpeluangpeningkatan');
Route::post('/BA-updatepeluangpeningkatan/{id}', [PeluangPeningkatanController::class, 'updatepeluangpeningkatan'])->name('BA-updatepeluangpeningkatan');
Route::get('/BA-editpeluangpeningkatan/{id}', [PeluangPeningkatanController::class, 'editpeluangpeningkatan'])->name('BA-editpeluangpeningkatan');
Route::get('/BA-deletepeluangpeningkatan/{id}', [PeluangPeningkatanController::class, 'deletepeluangpeningkatan'])->name('BA-deletepeluangpeningkatan');
Route::get('/BA-dokumenpendukung/{auditee_id}', [DokLampiranController::class, 'adddokumenpendukung'])->name('BA-dokumenpendukung');
Route::post('/BA-storedokumenpendukung/{auditee_id}', [DokLampiranController::class, 'storedokumenpendukung'])->name('BA-storedokumenpendukung');
Route::get('/BA-lihatdokumenpendukung/{id}', [DokLampiranController::class, 'lihatdokumenpendukung'])->name('BA-lihatdokumenpendukung');
Route::get('/BA-deletedokumenpendukung/{id}', [DokLampiranController::class, 'deletedokumenpendukung'])->name('BA-deletedokumenpendukung');
Route::get('/tindakankoreksi', [TindakanKoreksiController::class, 'index'])->name('tindakankoreksi');
Route::get('/tindakankoreksi-temuan', [TindakanKoreksiController::class, 'daftarTemuan'])->name('tindakankoreksi-temuan');
Route::get('/tindakankoreksi-formtemuan', [TindakanKoreksiController::class, 'tampilForm'])->name('tindakankoreksi-formtemuan');
Route::get('/dokumensahih', [DokSahihController::class, 'index'])->name('dokumensahih');
Route::get('/editdokumensahih/{pertanyaan_id}', [DokSahihController::class, 'spm_index'])->name('spm-dokumensahih');
Route::post('/storedokumensahih', [DokSahihController::class, 'storedoksahih'])->name('storedokumensahih');
Route::get('/deletedokumensahih/{id}', [DokSahihController::class, 'deletedoksahih'])->name('deletedokumensahih');
Route::get('/lihatdokumensahih/{id}', [DokSahihController::class, 'lihatdoksahih'])->name('lihatdokumensahih');
Route::get('/fotokegiatan', [FotoKegiatanController::class, 'index'])->name('fotokegiatan');
Route::get('/spm-editfotokegiatan/{auditee_id}/{tahunperiode}', [FotoKegiatanController::class, 'spm_index'])->name('spm-fotokegiatan');
Route::post('/storefotokegiatan', [FotoKegiatanController::class, 'storefotokegiatan'])->name('storefotokegiatan');
Route::get('/deletefotokegiatan/{id}', [FotoKegiatanController::class, 'deletefotokegiatan'])->name('deletefotokegiatan');
Route::get('/lihatfotokegiatan/{id}', [FotoKegiatanController::class, 'lihatfotokegiatan'])->name('lihatfotokegiatan');

// Role Auditor
Route::get('/auditor-daftarauditee/{tahunperiode}', [AuditeeController::class, 'indexauditor'])->name('auditor-daftarauditee');
Route::get('/auditor-daftarauditor/{tahunperiode}', [AuditorController::class, 'indexauditor'])->name('auditor-daftarauditor');
Route::get('/auditor-daftarauditor-periode', [AuditorController::class, 'indexauditorpertahun'])->name('auditor-daftarauditor-periode');
Route::get('/auditor-daftarauditee-periode', [AuditeeController::class, 'indexauditorpertahun'])->name('auditor-daftarauditee-periode');
Route::get('/auditor-detailauditor', [AuditorController::class, 'profil'])->name('auditor-detailauditor');
Route::get('/auditor-daftartilik/{tahunperiode}', [DaftarTilikController::class, 'indexAuditor'])->name('auditor-daftartilik');
Route::get('/auditor-daftarTilik-areadaftartilik/{auditee_id}/{area}', [PertanyaanController::class, 'indexAuditor'])->name('auditor-daftarTilik-areadaftartilik');
Route::get('/auditor-beritaacara', [BeritaAcaraController::class, 'indexAuditor'])->name('auditor-beritaacara');
Route::get('/approvalAuditee-daftartilik/{id}', [PertanyaanController::class, 'approvalAuditee'])->name('approvalauditee-daftartilik');
Route::get('/approvalAuditor-daftartilik/{id}', [PertanyaanController::class, 'approvalAuditor'])->name('approvalauditor-daftartilik');
Route::get('/auditor-dokresmi', [AuditorController::class, 'testPDF'])->name('auditor-dokresmi');
Route::get('/auditor-daftartilik-periode', [DaftarTilikController::class, 'indexpertahunauditor'])->name('auditor-daftartilik-periode');
Route::get('/auditor-daftartilik-tampilpertanyaandaftartilik/{id}', [PertanyaanController::class, 'auditor_tampildata'])->name('auditor-daftartilik-tampilpertanyaandaftartilik');
Route::get('/auditor-auditeeBA/{auditee_id}/{tahunperiode}', [BeritaAcaraController::class, 'auditor_tampiltemuanBA'])->name('auditor-auditeeBA');
Route::get('/auditor-BA-AMI/{auditee_id}', [DokBAAMIController::class, 'auditor_tampilBA_AMI'])->name('auditor-BA-AMI');
Route::get('/auditor-BAAMI-pratinjauBA/{auditee_id}', [DokBAAMIController::class, 'auditor_pratinjauba'])->name('auditor-BAAMI-pratinjauBA');
Route::get('/auditor-BA-dokumenpendukung/{auditee_id}', [DokLampiranController::class, 'auditor_adddokumenpendukung'])->name('auditor-BA-dokumenpendukung');
Route::get('/auditor-daftartilik-pratinjaudaftartilik/{auditee_id}/{area}', [DaftarTilikController::class, 'auditor_pratinjaudt'])->name('auditor-daftartilik-pratinjaudaftartilik');
Route::get('/auditor-jadwalaudit', [JadwalController::class, 'auditor_index'])->name('auditor-jadwalaudit');
Route::get('/auditor-editdokumensahih/{pertanyaan_id}', [DokSahihController::class, 'auditor_index'])->name('auditor-dokumensahih');
Route::get('/auditor-editfotokegiatan/{auditee_id}/{tahunperiode}', [FotoKegiatanController::class, 'auditor_index'])->name('auditor-fotokegiatan');

//Role Auditor
Route::get('/auditee-daftarauditee/{tahunperiode}', [AuditeeController::class, 'indexauditee'])->name('auditee-daftarauditee');
Route::get('/auditee-daftarauditee-periode', [AuditeeController::class, 'indexauditeepertahun'])->name('auditee-daftarauditee-periode');
Route::get('/auditee-daftarauditor-periode', [AuditorController::class, 'indexauditorpertahun_'])->name('auditee-daftarauditor-periode');
Route::get('/auditee-daftartilik-periode', [DaftarTilikController::class, 'indexpertahunauditee'])->name('auditee-daftartilik-periode');
Route::get('/auditee-daftarauditor/{tahunperiode}', [AuditorController::class, 'indexauditor_'])->name('auditee-daftarauditor');
Route::get('/auditee-daftartilik/{tahunperiode}', [DaftarTilikController::class, 'indexAuditee'])->name('auditee-daftartilik');
Route::get('/auditee-daftarTilik-areadaftartilik/{auditee_id}/{area}', [PertanyaanController::class, 'indexAuditee'])->name('auditee-daftarTilik-areadaftartilik');
Route::get('/auditee-beritaacara', [BeritaAcaraController::class, 'indexAuditee'])->name('auditee-beritaacara');
Route::get('/auditee-daftartilik-tampilpertanyaandaftartilik/{id}', [PertanyaanController::class, 'auditee_tampildata'])->name('auditee-daftartilik-tampilpertanyaandaftartilik');
Route::get('/auditee-auditeeBA/{auditee_id}/{tahunperiode}', [BeritaAcaraController::class, 'auditee_tampiltemuanBA'])->name('auditee-auditeeBA');
Route::get('/auditee-BA-AMI/{auditee_id}', [DokBAAMIController::class, 'auditee_tampilBA_AMI'])->name('auditee-BA-AMI');
Route::get('/auditee-BAAMI-pratinjauBA/{auditee_id}', [DokBAAMIController::class, 'auditee_pratinjauba'])->name('auditee-BAAMI-pratinjauBA');
Route::get('/auditee-BA-dokumenpendukung/{auditee_id}', [DokLampiranController::class, 'auditee_adddokumenpendukung'])->name('auditee-BA-dokumenpendukung');
Route::get('/auditee-daftartilik-pratinjaudaftartilik/{auditee_id}/{area}', [DaftarTilikController::class, 'auditee_pratinjaudt'])->name('auditee-daftartilik-pratinjaudaftartilik');
Route::get('/auditee-jadwalaudit', [JadwalController::class, 'auditee_index'])->name('auditee-jadwalaudit');
Route::get('/auditee-editdokumensahih/{pertanyaan_id}', [DokSahihController::class, 'auditee_index'])->name('auditee-dokumensahih');
Route::get('/auditee-editfotokegiatan/{auditee_id}/{tahunperiode}', [FotoKegiatanController::class, 'auditee_index'])->name('auditee-fotokegiatan');


Route::get('/addAuditor/{tahunperiode}', [AuditorController::class, 'tambahauditor'])->name('tambahauditor');
Route::get('/addAuditor', [AuditorController::class, 'tambahauditor_'])->name('tambahauditor_');
Route::post('/insertAuditor', [AuditorController::class, 'insertdata'])->name('insertauditor');

Route::get('/addAuditee', [AuditeeController::class, 'tambahauditee'])->name('tambahauditee');
Route::post('/insertAuditee', [AuditeeController::class, 'insertdata'])->name('insertauditee');

Route::get('/tampilAuditee/{id}', [AuditeeController::class, 'tampildata'])->name('tampilauditee');
Route::post('/updateAuditee/{id}', [AuditeeController::class, 'updatedata'])->name('updateauditee');
Route::get('/deleteAuditee/{id}', [AuditeeController::class, 'deletedata'])->name('deleteauditee');

Route::get('/tampilAuditor/{id}', [AuditorController::class, 'tampildata'])->name('tampilauditor');
Route::post('/updateAuditor/{id}', [AuditorController::class, 'updatedata'])->name('updateauditor');
Route::get('/deleteAuditor/{id}/{tahunperiode}', [AuditorController::class, 'deletedata'])->name('deleteauditor');

Route::get('/daftarAuditee/{tahunperiode}', [AuditeeController::class, 'index'])->name('auditee');

Route::get('/daftarAuditor/{tahunperiode}', [AuditorController::class, 'index'])->name('auditor');

Route::get('/ketersediaan-jadwal', [FullCalenderController::class, 'index']);

Route::post('/ketersediaan-jadwal/action', [FullCalenderController::class, 'action']);


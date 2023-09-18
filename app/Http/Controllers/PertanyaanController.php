<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\DokSahih;
use App\Models\Pertanyaan;
use App\Models\DaftarTilik;
use App\Models\FotoKegiatan;
use Illuminate\Http\Request;
use App\Models\PersetujuanAL;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;

class PertanyaanController extends Controller
{
    public function index($auditee_id, $area)
    {
        $data = DaftarTilik::all()->where('auditee_id', $auditee_id)->where('area', $area)->first();
        $daftartilik_id = $data->id;
        $data_ = Pertanyaan::all()->where('daftartilik_id', $daftartilik_id);
        //dd($data_);
        return view('spm/areaDaftarTilik', compact('data', 'data_'));
    }

    public function tambahdata($auditee_id, $area){
        
        $data = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->get();
        $data_ = Pertanyaan::all();
        $listAuditee = Auditee::all();
        $listAuditor = Auditor::all();
        $pertanyaan_id = DaftarTilik::where('auditee_id', $auditee_id)->where('area', $area)->first();;

        // dd($pertanyaan_id);

        return view('spm/addDaftarTilik', compact('data', 'data_', 'listAuditee', 'listAuditor', 'pertanyaan_id'));
    }

    public function insertpertanyaan(Request $request)
    {
        
        $auditee_id = $request->get('auditee_id');
        $daftartilik_id = $request->get('daftartilik_id');
        $_area = DaftarTilik::all()->where('auditee_id', $auditee_id)->where('id', $daftartilik_id)->first();

        // $requestData = $request->all();
        $pertanyaan =new Pertanyaan([
            "daftartilik_id" => $request->daftartilik_id,
            "auditee_id"=> $request->auditee_id,
            "auditor_id"=> $request->auditor_id,
            "butirStandar" => $request->butirStandar,
            "nomorButir"=> $request->nomorButir,
            "indikatormutu"=> $request->indikatormutu,
            "targetStandar"=> $request->targetStandar,
            "referensi"=> $request->referensi,
            "keterangan"=> $request->keterangan,
            "pertanyaan"=> $request->pertanyaan,
            "responAuditee"=> $request->responAuditee,
            "responAuditor"=> $request->responAuditor,
            "inisialAuditor"=> $request->inisialAuditor,
            "skorAuditor"=> $request->skorAuditor,
            "Kategori"=> $request->Kategori,
            // "approvalAuditee"=> $request->approvalAuditee,
            // "approvalAuditor"=> $request->approvalAuditor,
            "narasiPLOR"=> $request->narasiPLOR,
        ]);
        
        $pertanyaan->save();

        if ($request->hasFile('dok_sahihs')) {

            //upload new image
            $files = $request->file('dok_sahihs');
            foreach ($files as $file) {
                $fileName = time().$file->getClientOriginalName();
                $pathFile = $file->storeAs('dokumenSahih', $fileName, 'public');
                $request["pertanyaan_id"] = $pertanyaan->id;
                $request["dokSahih"] = '/storage/'.$pathFile;
                $request["namaFile"] = $fileName;
                
                DokSahih::create($request->all());
            }
        } 

        if ($request->hasFile('foto_kegiatans')) {
            $photos = $request->file('foto_kegiatans');
            foreach ($photos as $key => $photo) {
                $fileFoto = time().$photo->getClientOriginalName();
                $pathFoto = $photo->storeAs('DokumenFoto', $fileFoto, 'public');
                $request["pertanyaan_id"] = $pertanyaan->id;
                $request["foto"] = '/storage/'.$pathFoto;
                $request["namaFile"] = $fileFoto;
                FotoKegiatan::create($request->all());
            }
        }

        return redirect()->route('areadaftartilik', ['auditee_id' => $auditee_id, 'area' => $_area->area])->with('success', 'Data berhasil ditambah!');
    }

    public function saveFormData(Request $request)
    {
        // Validasi data form jika diperlukan

        // Simpan data ke database
        $newData = Pertanyaan::create($request->all());

        // Mengirimkan data yang baru dibuat sebagai respons JSON
        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $newData]);
    }

    public function tampildata(Request $request, $id){
        $datas = Pertanyaan::find($id);
        $daftartilik_id = $datas->daftartilik_id;
        $_daftartiliks = DaftarTilik::where('id', $daftartilik_id)->get();
        $listAuditee = Auditee::all();
        $listAuditor = Auditor::all();
        $role_ = Auth::user()->role;

        $tgl_pelaksanaan = DaftarTilik::find($datas->daftartilik_id);
        $tglpelaksanaan = Carbon::parse($tgl_pelaksanaan->tgl_pelaksanaan);
        $tglpelaksanaan->addDays(7);
        $currentDate = Carbon::now()->format('Y-m-d');

        return view('spm/updatePertanyaanDaftarTilik', compact('datas','_daftartiliks','listAuditee','listAuditor', 'tglpelaksanaan', 'currentDate'));
    }

    public function auditee_tampildata(Request $request, $id){
        $currentDate = Carbon::now()->format('Y-m-d');

        $datas = Pertanyaan::find($id);
        $_daftartiliks = DaftarTilik::where('id', $datas->daftartilik_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $datas->auditee_id)->get();
        $auditor_ = Auditor::where('id', $datas->auditor_id)->get();
        $auditee_ = Auditee::where('id', $datas->auditee_id)->get();

        $tgl_pelaksanaan = DaftarTilik::find($datas->daftartilik_id);
        $tglpelaksanaan = Carbon::parse($tgl_pelaksanaan->tgl_pelaksanaan);
        $tglpelaksanaan->addDays(7);

        return view('auditee/updatePertanyaanDaftarTilik', compact('datas', 'auditor_', 'auditee_', 'daftartilik_', '_daftartiliks', 'currentDate', 'tglpelaksanaan'));
    }

    public function auditor_tampildata(Request $request, $id){
        $currentDate = Carbon::now()->format('Y-m-d');
        $datas = Pertanyaan::find($id);
        $daftartilik_ = DaftarTilik::where('auditee_id', $datas->auditee_id)->get();
        $auditor_ = Auditor::where('id', $datas->auditor_id)->get();
        $auditee_ = Auditee::where('id', $datas->auditee_id)->get();
        $_daftartiliks = DaftarTilik::where('id', $datas->daftartilik_id)->get();

        $tgl_pelaksanaan = DaftarTilik::find($datas->daftartilik_id);
        $tglpelaksanaan = Carbon::parse($tgl_pelaksanaan->tgl_pelaksanaan);
        $tglpelaksanaan->addDays(7);
        
        return view('auditor/updatePertanyaanDaftarTilik', compact('datas', 'auditor_', 'auditee_', 'daftartilik_', '_daftartiliks', 'currentDate', 'tglpelaksanaan'));
    }

    public function updatedata(Request $request, $id)
    {
        // dd($request->all());
        $data = Pertanyaan::find($id);
        $auditee_id = $data->auditee_id;
        $_area = DaftarTilik::all()->where('id', $data->daftartilik_id)->where('auditee_id', $auditee_id)->first();
        $role_ = Auth::user()->role;

        if ($request->Kategori == "Sesuai") {
            $request->narasiPLOR = NULL;
        }

        
        $data->update([
            "butirStandar" => $request->butirStandar,
            "nomorButir"=> $request->nomorButir,
            "indikatormutu"=> $request->indikatormutu,
            "targetStandar"=> $request->targetStandar,
            "referensi"=> $request->referensi,
            "keterangan"=> $request->keterangan,
            "pertanyaan"=> $request->pertanyaan,
            "responAuditee"=> $request->responAuditee,
            "responAuditor"=> $request->responAuditor,
            "inisialAuditor"=> $request->inisialAuditor,
            "skorAuditor"=> $request->skorAuditor,
            "Kategori"=> $request->Kategori,
            "approvalAuditee"=> $data->approvalAuditee,
            "approvalAuditor"=> $data->approvalAuditor,
            "narasiPLOR"=> $request->narasiPLOR,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function testPDF()
    {
        return response()->file(public_path('dokumen/example.pdf'),['content-type'=>'application/pdf']);
    }

    public function deletedata($id)
    {
        $data = Pertanyaan::find($id);
        $fotoKegiatan_ = FotoKegiatan::all();
        $dokSahih_ = DokSahih::all();
        $auditee_id = $data->auditee_id;
        $_area = DaftarTilik::all()->where('auditee_id', $auditee_id)->first();


        $data->delete();
        return redirect()->route('areadaftartilik', ['auditee_id' => $auditee_id, 'area' => $_area->area])->with('success', 'Data berhasil dihapus');
    }

    // Role Auditor
    public function indexAuditor($auditee_id, $area)
    {
        $data = DaftarTilik::all()->where('auditee_id', $auditee_id)->where('area', $area)->first();
        $daftartilik_id = $data->id;
        $data_ = Pertanyaan::all()->where('daftartilik_id', $daftartilik_id);

        // dd(Auth::user()->role);

        //dd($data_);
        return view('/auditor/areaDaftarTilik', compact('data', 'data_'));
    }

    public function indexAuditee($auditee_id, $area)
    {
        $data = DaftarTilik::all()->where('auditee_id', $auditee_id)->where('area', $area)->first();
        $daftartilik_id = $data->id;
        $data_ = Pertanyaan::all()->where('daftartilik_id', $daftartilik_id);
        // $data_ = Pertanyaan::where('daftartilik_id', $daftartilik_id)->where('butirStandar', '!=', null)->where('nomorButir', '!=', null)->where('indikatormutu', '!=', null)->where('butirStandar', '!=', null)->where('targetStandar', '!=', null)->where('pertanyaan', '!=', null)->get();

        // dd(Auth::user()->role);

        //dd($data_);
        return view('/auditee/areaDaftarTilik', compact('data', 'data_'));
    }

    public function approvalAuditee(Request $request, $id)
    {
        $approve_ = Pertanyaan::find($id);
        $doksahihs = DokSahih::where('pertanyaan_id', $approve_->id)->get();
        $auditee_ = Auditee::where('id', $approve_->auditee_id)->first();

        if (($approve_->responAuditee != null && count($doksahihs) > 0) && $approve_->approvalAuditor == 'Belum disetujui Auditor') {
            $request->session()->flash('error', 'Mohon maaf, Auditor belum mengisi AL atau mengajukan persetujuan! Silahkan tunggu!');
        } elseif (($approve_->responAuditee != null && count($doksahihs) > 0) && $approve_->approvalAuditee != 'Disetujui Auditee' && $auditee_->ketua_auditee == Auth::user()->name) {

            $approve_->approvalAuditee = 'Disetujui Auditee';

            $persetujuanAL = new PersetujuanAL;
            $persetujuanAL->pertanyaan_id = $approve_->id;
            $persetujuanAL->posisi = 'Ketua Auditee';
            $persetujuanAL->nama = $approve_->auditee->ketua_auditee;
            $persetujuanAL->eSign = $approve_->approvalAuditee;
            $persetujuanAL->save();

            $request->session()->flash('success', 'Audit Lapangan sudah berhasil disetujui oleh Ketua Auditee ('.$auditee_->ketua_auditee.')');
    
            $approve_->save();
        } elseif ($approve_->responAuditee == null || count($doksahihs) == 0) {
            $request->session()->flash('error', 'Mohon isikan respon Auditee beserta Dokumen Bukti Sahih terlebih dahulu!');
        } elseif ($approve_->approvalAuditee == 'Disetujui Auditee') {
            $request->session()->flash('success', 'Anda sudah menyetujui Audit Lapangan!');
        } elseif ($auditee_->ketua_auditee != Auth::user()->name) {
            $request->session()->flash('error', 'Persetujuan AL hanya dilakukan oleh Ketua Auditee ('.$auditee_->ketua_auditee.')');
        }
        // dd($approve_);
        return redirect()->back();
    }

     public function approvalAuditor(Request $request, $id)
    {
        $approve_ = Pertanyaan::find($id);
        $auditor_ = Auditor::where('id', $approve_->auditor_id)->first();
        
        if (Auth::user()->name == $approve_->auditee->ketua_auditor) {
            if ($approve_->approvalAuditor == 'Belum disetujui Auditor' && ($approve_->Kategori != null && $approve_->inisialAuditor != null)) {

                $approve_->approvalAuditor = 'Menunggu persetujuan Auditee';
                $request->session()->flash('success', 'Persetujuan Audit Lapangan berhasil diajukan oleh '.$approve_->auditee->ketua_auditor.' kepada Auditee');
    
            } elseif ($approve_->approvalAuditor == 'Menunggu persetujuan Auditee' && $approve_->approvalAuditee == 'Belum disetujui Auditee') {

                $request->session()->flash('error', 'Mohon tunggu, AL belum disetujui oleh Auditee!');

            } elseif ($approve_->approvalAuditor == 'Menunggu persetujuan Auditee' && ($approve_->Kategori != null && $approve_->inisialAuditor != null)) {
    
                $approve_->approvalAuditor = 'Disetujui Auditor';

                $persetujuanAL = new PersetujuanAL;
                $persetujuanAL->pertanyaan_id = $approve_->id;
                $persetujuanAL->posisi = 'Ketua Auditor';
                $persetujuanAL->nama = $approve_->auditee->ketua_auditor;
                $persetujuanAL->eSign = $approve_->approvalAuditor;
                $persetujuanAL->save();

                $request->session()->flash('success', 'Audit Lapangan berhasil disetujui oleh Ketua Auditor '.$approve_->auditee->ketua_auditor);
            } elseif ($approve_->Kategori == null || $approve_->inisialAuditor == null) {
                $request->session()->flash('error', 'Mohon mengisi kategori temuan dan inisial Auditor terlebih dahulu');
            } elseif ($approve_->approvalAuditor == 'Disetujui Auditor' && $approve_->approvalAuditee == 'Disetujui Auditee') {
                $request->session()->flash('success', 'Anda sudah menyetujui Audit Lapangan!');
            }
        } else {
            $request->session()->flash('error', 'Audit Lapangan ini harus disetujui oleh ketua Auditor! ('.$approve_->auditee->ketua_auditor.')');
        }

        $approve_->save();

        return redirect()->back();
    }

    public function autoapprove(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::find($id);

        if ($pertanyaan->butirStandar != null && $pertanyaan->nomorButir != null && $pertanyaan->indikatormutu != null && $pertanyaan->targetStandar != null && $pertanyaan->pertanyaan != null && $pertanyaan->responAuditee != null && $pertanyaan->responAuditor != null && $pertanyaan->inisialAuditor != null && $pertanyaan->Kategori != null ) {
            
            if ($pertanyaan->approvalAuditee == "Belum disetujui Auditee" && $pertanyaan->approvalAuditor == "Belum disetujui Auditor") {
                $pertanyaan->update([
                    "approvalAuditee" => "Disetujui Auditee",
                    "approvalAuditor" => "Disetujui Auditor",
                ]);
                $pertanyaan->save();

                $request->session()->flash('success', 'Audit Lapangan telah disetujui secara otomatis oleh Ketua Auditee dan Ketua Auditor!');

            } elseif ($pertanyaan->approvalAuditee == "Disetujui Auditee" && ($pertanyaan->approvalAuditor == "Belum disetujui Auditor" || $pertanyaan->approvalAuditor == "Menunggu persetujuan Auditee")) {
                $pertanyaan->update([
                    "approvalAuditor" => "Disetujui Auditor",
                ]);
                $pertanyaan->save();

                $request->session()->flash('success', 'Audit Lapangan telah disetujui secara otomatis oleh Ketua Auditor!');
            } elseif ($pertanyaan->approvalAuditee == "Belum disetujui Auditee" && $pertanyaan->approvalAuditor == "Disetujui Auditor") {
                $pertanyaan->update([
                    "approvalAuditee" => "Disetujui Auditee",
                ]);
                $pertanyaan->save();

                $request->session()->flash('success', 'Audit Lapangan telah disetujui secara otomatis oleh Ketua Auditee!');
            }
        }

        $pertanyaan->save();

        return redirect()->back();
    }
}

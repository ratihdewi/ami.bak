<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\DokSahih;
use App\Models\Pertanyaan;
use App\Models\DaftarTilik;
use App\Models\FotoKegiatan;
use Illuminate\Http\Request;
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
        
        $data = DaftarTilik::all()->where('auditee_id', $auditee_id)->where('area', $area);
        $data_ = Pertanyaan::all();
        $listAuditee = Auditee::all();
        $listAuditor = Auditor::all();

        // dd($data->auditee_id);
        return view('spm/addDaftarTilik', compact('data', 'data_', 'listAuditee', 'listAuditor'));
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
            "approvalAuditee"=> $request->approvalAuditee,
            "approvalAuditor"=> $request->approvalAuditor,
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

    public function tampildata(Request $request, $id){
        $datas = Pertanyaan::find($id);
        $daftartilik_id = $datas->daftartilik_id;
        $_daftartiliks = DaftarTilik::where('id', $daftartilik_id)->get();
        $listAuditee = Auditee::all();
        $listAuditor = Auditor::all();
        $role_ = Auth::user()->role;

        return view('spm/updatePertanyaanDaftarTilik', compact('datas','_daftartiliks','listAuditee','listAuditor'));
    }

    public function auditee_tampildata(Request $request, $id){
        $datas = Pertanyaan::find($id);
        $_daftartiliks = DaftarTilik::where('id', $datas->daftartilik_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $datas->auditee_id)->get();
        $auditor_ = Auditor::where('id', $datas->auditor_id)->get();
        $auditee_ = Auditee::where('id', $datas->auditee_id)->get();

        return view('auditee/updatePertanyaanDaftarTilik', compact('datas', 'auditor_', 'auditee_', 'daftartilik_', '_daftartiliks'));
    }

    public function auditor_tampildata(Request $request, $id){
        $datas = Pertanyaan::find($id);
        $daftartilik_ = DaftarTilik::where('auditee_id', $datas->auditee_id)->get();
        $auditor_ = Auditor::where('id', $datas->auditor_id)->get();
        $auditee_ = Auditee::where('id', $datas->auditee_id)->get();
        $_daftartiliks = DaftarTilik::where('id', $datas->daftartilik_id)->get();
        
        return view('auditor/updatePertanyaanDaftarTilik', compact('datas', 'auditor_', 'auditee_', 'daftartilik_', '_daftartiliks'));
    }

    public function updatedata(Request $request, $id)
    {
        
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
            "approvalAuditee"=> $request->approvalAuditee,
            "approvalAuditor"=> $request->approvalAuditor,
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

        // dd(Auth::user()->role);

        //dd($data_);
        return view('/auditee/areaDaftarTilik', compact('data', 'data_'));
    }

    public function approvalAuditee(Request $request, $id)
    {
        $approve_ = Pertanyaan::find($id);
        $doksahihs = DokSahih::where('pertanyaan_id', $approve_->id)->get();
        $auditee_ = Auditee::where('id', $approve_->auditee_id)->first();

        if (($approve_->responAuditee != null && count($doksahihs) > 0) && $approve_->approvalAuditee != 'Disetujui Auditee') {
            $approve_->approvalAuditee = 'Disetujui Auditee';

            $request->session()->flash('success', 'Audit Lapangan sudah berhasil disetujui oleh Ketua Auditee ('.$auditee_->ketua_auditee.')');
    
            $approve_->save();
        } elseif ($approve_->responAuditee == null || count($doksahihs) == 0) {
            $request->session()->flash('error', 'Mohon isikan respon Auditee beserta Dokumen Bukti Sahih terlebih dahulu!');
        } elseif ($approve_->approvalAuditee == 'Disetujui Auditee') {
            $request->session()->flash('success', 'Anda sudah menyetujui Audit Lapangan!');
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
                $request->session()->flash('success', 'Persetujuan Audit Lapangan berhasil berhasil diajukan oleh '.$auditor_->nama.' kepada Auditee');
    
            } elseif ($approve_->approvalAuditor == 'Menunggu persetujuan Auditee' && ($approve_->Kategori != null && $approve_->inisialAuditor != null)) {
    
                $approve_->approvalAuditor = 'Disetujui Auditor';
                $request->session()->flash('success', 'Audit Lapangan berhasil disetujui oleh Auditor '.$auditor_->nama);
            } elseif ($approve_->Kategori == null || $approve_->inisialAuditor == null) {
                $request->session()->flash('error', 'Mohon mengisi kategori temuan dan inisial Auditor terlebih dahulu');
            } elseif ($approve_->approvalAuditor == 'Disetujui Auditor' && $approve_->approvalAuditee == 'Disetujui Auditee') {
                $request->session()->flash('success', 'Anda sudah menyetujui Audit Lapangan!');
            }
        } else {
            $request->session()->flash('error', 'Audit Lapangan ini harus disetujui oleh Auditor yang terdaftar pada rencana daftar tilik! ('.$auditor_->nama.')');
        }

        $approve_->save();

        return redirect()->back();
    }
}

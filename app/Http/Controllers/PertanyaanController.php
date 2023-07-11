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

        //dd($pertanyaan);
        // Pertanyaan::create($requestData);

        if ($request->hasFile('dok_sahihs')) {

            //upload new image
            $files = $request->file('dok_sahihs');
            foreach ($files as $file) {
                $fileName = time().$file->getClientOriginalName();
                $pathFile = $file->storeAs('dokumenSahih', $fileName, 'public');
                $request["pertanyaan_id"] = $pertanyaan->id;
                $request["dokSahih"] = '/storage/'.$pathFile;
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
                FotoKegiatan::create($request->all());
            }
        }

        return redirect()->route('areadaftartilik', ['auditee_id' => $auditee_id, 'area' => $_area->area])->with('success', 'Data berhasil ditambah!');
    }

    public function tampildata($id){
        $datas = Pertanyaan::find($id);
        $daftartilik_id = $datas->daftartilik_id;
        $_daftartiliks = DaftarTilik::all()->where('id', $daftartilik_id);
        //dd($datas->pertanyaan);
        $listAuditee = Auditee::all();
        $listAuditor = Auditor::all();
        $role_ = Auth::user()->role;
        $fotoKegiatan = FotoKegiatan::where('pertanyaan_id', $id)->get();
        $dokSahih = DokSahih::where('pertanyaan_id', $id)->get();
        
        if ($role_ == "SPM") {
            return view('spm/updatePertanyaanDaftarTilik', compact('datas','_daftartiliks','listAuditee','listAuditor', 'fotoKegiatan', 'dokSahih'));
        } elseif ($role_ == "Auditor") {
            return view('auditor/updatePertanyaanDaftarTilik', compact('datas','_daftartiliks','listAuditee','listAuditor', 'fotoKegiatan', 'dokSahih'));
        } elseif ($role_ == "Auditee") {
            return view('auditee/updatePertanyaanDaftarTilik', compact('datas','_daftartiliks','listAuditee','listAuditor', 'fotoKegiatan', 'dokSahih'));
        }
    }

    public function updatedata(Request $request, $id)
    {
        $data = Pertanyaan::find($id);
        $auditee_id = $data->auditee_id;
        $_area = DaftarTilik::all()->where('auditee_id', $auditee_id)->first();
        
        if ($request->Kategori == "Sesuai") {
            $request->narasiPLOR = NULL;
        }

        $data->update([
            "butirStandar" => $request->butirStandar,
            "nomorButir"=> $request->nomorButir,
            "indikatorMutu"=> $request->indikatorMutu,
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

        if ($request->hasFile('foto_kegiatans')) {
            $photos = $request->file('foto_kegiatans');
            foreach ($photos as $key => $photo) {
                $fileFoto = time().$photo->getClientOriginalName();
                $pathFoto = $photo->storeAs('DokumenFoto', $fileFoto, 'public');
                $request["pertanyaan_id"] = $data->id;
                $request["foto"] = '/storage/'.$pathFoto;
                FotoKegiatan::create($request->all());
            }
        }

        if ($request->hasFile('dok_sahihs')) {

            //upload new image
            $files = $request->file('dok_sahihs');
            foreach ($files as $key => $file) {
                $fileName = time().$file->getClientOriginalName();
                $pathFile = $file->storeAs('dokumenSahih', $fileName, 'public');
                $request["pertanyaan_id"] = $data->id;
                $request["dokSahih"] = '/storage/'.$pathFile;
                DokSahih::create($request->all());
            }
        } 

        //dd($data);
        $role_ = Auth::user()->role;
        if ($role_ == "SPM") {
            return redirect()->route('areadaftartilik', ['auditee_id' => $auditee_id, 'area' => $_area->area])->with('success', 'Data berhasil diupdate');
        } elseif ($role_ == "Auditor") {
            return redirect()->route('auditor-daftarTilik-areadaftartilik', ['auditee_id' => $auditee_id, 'area' => $_area->area])->with('success', 'Data berhasil diupdate');
        } elseif ($role_ == "Auditee") {
            return redirect()->route('auditee-daftarTilik-areadaftartilik', ['auditee_id' => $auditee_id, 'area' => $_area->area])->with('success', 'Data berhasil diupdate');
        }
        
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

    public function approvalAuditee($id)
    {
        $approve_ = Pertanyaan::find($id);
        
        $approve_->approvalAuditee = 'Disetujui Auditee';
 
        $approve_->save();

        // dd($approve_);
        return redirect()->back()->with('message', 'Audit Lapangan sudah berhasil disetujui');
    }

     public function approvalAuditor($id)
    {
        $approve_ = Pertanyaan::find($id);
        
        $approve_->approvalAuditor = 'Disetujui Auditor';
 
        $approve_->save();

        // dd($approve_);
        return redirect()->back()->with('message', 'Audit Lapangan sudah berhasil disetujui');
    }
}

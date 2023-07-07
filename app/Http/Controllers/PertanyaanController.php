<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\Pertanyaan;
use App\Models\DaftarTilik;
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

        $requestData = $request->all();
        $fileName = time().$request->file('dokSahih')->getClientOriginalName();
        $fileFoto = time().$request->file('fotoKegiatan')->getClientOriginalName();
        $pathFile = $request->file('dokSahih')->storeAs('dokumenSahih', $fileName, 'public');
        $pathFoto = $request->file('fotoKegiatan')->storeAs('DokumenFoto', $fileFoto, 'public');
        $requestData["dokSahih"] = '/storage/'.$pathFile;
        $requestData["fotoKegiatan"] = '/storage/'.$pathFoto;
        Pertanyaan::create($requestData);

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
        
        if ($role_ == "SPM") {
            return view('spm/updatePertanyaanDaftarTilik', compact('datas','_daftartiliks','listAuditee','listAuditor'));
        } elseif ($role_ == "Auditor") {
            return view('auditor/updatePertanyaanDaftarTilik', compact('datas','_daftartiliks','listAuditee','listAuditor'));
        } elseif ($role_ == "Auditee") {
            return view('auditee/updatePertanyaanDaftarTilik', compact('datas','_daftartiliks','listAuditee','listAuditor'));
        }
    }

    public function updatedata(Request $request, $id)
    {
        $data = Pertanyaan::find($id);
        $auditee_id = $data->auditee_id;
        $_area = DaftarTilik::all()->where('auditee_id', $auditee_id)->first();
        
        // dd($request->get('narasiPLOR'));

        $data->update($request->all());
        $role_ = Auth::user()->role;

        $requestNarasi = $request->get('narasiPLOR');

        if ($data->Kategori == "Sesuai") {
           $data->narasiPLOR = NULL;
        }

        //dd($data);

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
        $auditee_id = $data->auditee_id;
        $_area = DaftarTilik::all()->where('auditee_id', $auditee_id)->first();

        $data->delete();
        return redirect()->route('areadaftartilik', ['auditee_id' => $auditee_id, 'area' => $_area->area])->with('success', 'Data berhasil dihapus');
    }

    // public function proses_upload(Request $request){
	// 	$this->validate($request, [
	// 		'dokSahih' => 'required|file|image|mimes:pdf,docx,xlsx,xls|max:2048',
	// 		'fotoKegiatan' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
	// 	]);
 
	// 	// menyimpan data file yang diupload ke variabel $file
	// 	$file = $request->file('dokSahih');
    //     $foto = $request->file('fotoKegiatan');
 
	// 	$nama_file = time()."_".$file->getClientOriginalName();
    //     $nama_foto = time()."_".$file->getClientOriginalName();
 
    //   	        // isi dengan nama folder tempat kemana file diupload
	// 	$tujuan_uploadFile = 'dokumen_sahih';
    //     $tujuan_uploadFoto = 'foto_kegiatan';
	// 	$nama_file->move($tujuan_uploadFile,$nama_file);
    //     $nama_foto->move($tujuan_uploadFoto,$nama_fot);
 
	// 	// Gambar::create([
	// 	// 	'file' => $nama_file,
	// 	// 	'keterangan' => $request->keterangan,
	// 	// ]);
 
	// 	return redirect()->back();
	// }

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

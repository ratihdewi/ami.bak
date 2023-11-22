<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use App\Models\User;
use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\UnitKerja;
use App\Models\BeritaAcara;
use App\Models\DaftarHadir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarHadirController extends Controller
{

    public function editdaftarhadir($auditee_id)
    {
        $auditee_ = Auditee::where('id', $auditee_id)->get();

        foreach ($auditee_ as $key => $auditee) {
            $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $auditee->tahunperiode)->first();
        }

        $users = User::all();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $auditor = Auditor::where('user_id', Auth::user()->id);
        $auditee = Auditee::where('user_id', Auth::user()->id);
        $unit_kerja = Auditee::where('id', $beritaacara_->auditee_id)->first();

        if (count($daftarhadir_) == 0) {
            return view('spm/BAAMI_formDaftarHadir', compact('auditee_', 'beritaacara_', 'users', 'daftarhadir_', 'auditor', 'auditee', 'unit_kerja'));
        } else {
            return view('spm/BAAMI_editDaftarHadir', compact('auditee_', 'beritaacara_', 'users', 'daftarhadir_', 'auditor', 'auditee', 'unit_kerja'));   
        }
    }

    public function auditor_editdaftarhadir($auditee_id)
    {
        $auditee_ = Auditee::where('id', $auditee_id)->get();

        foreach ($auditee_ as $key => $auditee) {
            $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $auditee->tahunperiode)->first();
        }

        $users = User::all();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $auditor = Auditor::where('user_id', Auth::user()->id);
        $auditee = Auditee::where('user_id', Auth::user()->id);
        $unit_kerja = Auditee::where('id', $beritaacara_->auditee_id)->first();

        if (count($daftarhadir_) == 0) {
            return view('auditor/BAAMI_formDaftarHadir', compact('auditee_', 'beritaacara_', 'users', 'daftarhadir_', 'auditor', 'auditee', 'unit_kerja'));
        } else {
            return view('auditor/BAAMI_editDaftarHadir', compact('auditee_', 'beritaacara_', 'users', 'daftarhadir_', 'auditor', 'auditee', 'unit_kerja'));   
        }
    }

    public function auditee_editdaftarhadir($auditee_id)
    {
        $auditee_ = Auditee::where('id', $auditee_id)->get();

        foreach ($auditee_ as $key => $auditee) {
            $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $auditee->tahunperiode)->first();
        }

        $users = User::all();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $auditor = Auditor::where('user_id', Auth::user()->id);
        $auditee = Auditee::where('user_id', Auth::user()->id);
        $unit_kerja = Auditee::where('id', $beritaacara_->auditee_id)->first();

        if (count($daftarhadir_) == 0) {
            return view('auditee/BAAMI_formDaftarHadir', compact('auditee_', 'beritaacara_', 'users', 'daftarhadir_', 'auditor', 'auditee', 'unit_kerja'));
        } else {
            return view('auditee/BAAMI_editDaftarHadir', compact('auditee_', 'beritaacara_', 'users', 'daftarhadir_', 'auditor', 'auditee', 'unit_kerja'));   
        }
    }

    public function getAuditee($auditee_id)
    {
        $auditee = Auditee::find($auditee_id);
        $unitkerja = UnitKerja::where('name', $auditee->unit_kerja)->first();

        $users = User::where('unitkerja_id', $unitkerja->id)->orWhere('unitkerja_id2', $unitkerja->id)->orWhere('unitkerja_id3', $unitkerja->id)->get();
        // $unit_kerja1 = UnitKerja::where('id', Auth::user()->unitkerja_id)->first();
        // $unit_kerja2 = UnitKerja::where('id', Auth::user()->unitkerja_id2)->first();
        // $unit_kerja3 = UnitKerja::where('id', Auth::user()->unitkerja_id3)->first();

        // if ($unit_kerja2 != null && $unit_kerja3 != null) {

        //     $user = User::where('unitkerja_id', $unit_kerja1->id)->orWhere('unitkerja_id2', $unit_kerja2->id)->orWhere('unitkerja_id3', $unit_kerja3->id)->get();

        //     $users = [
        //         'user' => $user,
        //         'unit_kerja1' => $unit_kerja1,
        //         'unit_kerja2' => $unit_kerja2,
        //         'unit_kerja3' => $unit_kerja3,
        //     ];
        
        //     return response()->json($users);

        // } elseif ($unit_kerja2 != null && $unit_kerja3 == null) {

        //     $user = User::where('unitkerja_id', $unit_kerja1->id)->orWhere('unitkerja_id2', $unit_kerja2->id)->get();

        //     $users = [
        //         'user' => $user,
        //         'unit_kerja1' => $unit_kerja1,
        //         'unit_kerja2' => $unit_kerja2,
        //     ];
        
        //     return response()->json($users);

        // } elseif ($unit_kerja2 == null && $unit_kerja3 != null) {
            
        //     $user = User::where('unitkerja_id', $unit_kerja1->id)->orWhere('unitkerja_id3', $unit_kerja3->id)->get();

        //     $users = [
        //         'user' => $user,
        //         'unit_kerja1' => $unit_kerja1,
        //         'unit_kerja3' => $unit_kerja3,
        //     ];
        
        //     return response()->json($users);

        // } else {
        //     $users = [
        //         'user' => $user,
        //         'unit_kerja1' => $unit_kerja1
        //     ];
        
        //     return response()->json($users);
        // }

        return response()->json($users);
    }

    public function getAuditor()
    {
        // $auditor_ = Auditor::all();

        // return response()->json($auditor_);
        $data = Auditee::select('id', 'ketua_auditor', 'anggota_auditor', 'anggota_auditor2')->get();

        return response()->json($data);
    }

    public function storedaftarhadir(Request $request, $auditee_id)
    {
        
        if ($request->addmore == null) {
            return redirect()->back()->with('error', 'Tidak ada data yang ditambahkan!');
        } else {
            // dd($request->addmore);
            $users_ = User::all();

            $request->validate([
                'addmore.*.beritaacara_id' => 'required',
                'addmore.*.posisi' => 'required',
                'addmore.*.namapeserta' => 'required',
                'addmore.*.namapenginput' => 'required',
            ]);
            
            foreach ($users_ as $key => $user) {
                foreach ($request->addmore as $key => $value) {

                    $user_ = User::where('name', $value['namapeserta'])->first();
                    $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
                    $notExist = DaftarHadir::where('namapeserta', $value['namapeserta'])->where('beritaacara_id', $beritaacara_->id)->doesntExist();
                    $existAuditor_ = Auditor::where('user_id', $user_->id);
                    $existAuditee_ = Auditee::where('user_id', $user_->id);
                    $auditee = Auditee::find($auditee_id);

                    if ($value['namapeserta'] == $auditee->ketua_auditee) {
                        $value['posisi'] = "Ketua Auditee";
                    } elseif ($value['namapeserta'] == $auditee->ketua_auditor) {
                        $value['posisi'] = "Ketua Auditor";
                    } elseif ($value['namapeserta'] == $auditee->anggota_auditor || $value['namapeserta'] == $auditee->anggota_auditor2) {
                        $value['posisi'] = "Anggota Auditor";
                    } else {
                        $value['posisi'] = "Anggota Auditee";
                    }

                    if ($notExist) {
                        $daftarhadir = new DaftarHadir;
                        $daftarhadir->beritaacara_id = $value['beritaacara_id'];
                        $daftarhadir->posisi = $value['posisi'];
                        $daftarhadir->namapeserta = $value['namapeserta'];
                        $daftarhadir->namapenginput = $value['namapenginput'];
                        $daftarhadir->save();
                        $return = redirect()->back()->with('success', 'Data peserta berhasil ditambah!');
                    } elseif (!$notExist) {
                        $daftarhadirexist = DaftarHadir::where('namapeserta', $value['namapeserta'])->first();
                        
                        if ($daftarhadirexist) {
                            $daftarhadirexist->update([
                                'deletedBy' => null,
                            ]);

                            dd($daftarhadirexist);

                            $return = redirect()->back()->with('success', 'Data peserta berhasil ditambah!');
                        } else {
                            $return = redirect()->back()->with('error', 'Data peserta sudah tersedia!');
                        }
                        
                    } elseif ($value['namapeserta'] != $user->name) {
                        $return = redirect()->back()->with('error', 'Data peserta tidak terdaftar!');
                    }
                }
            }
        
            return $return;
        }
    }

    public function deletedaftarhadir($id)
    {
        $daftarhadir_ = DaftarHadir::find($id);
        $auditee_ = BeritaAcara::where('id', $daftarhadir_->beritaacara_id)->first();
        
        // $daftarhadir_->delete();
        $daftarhadir_->update([
            'deletedBy' => Auth::user()->name,
        ]);
        $daftarhadir_->save();
        return redirect()->back()->with('success', 'Data peserta berhasil dihapus!');
    }

    public function esignpeserta($id)
    {
        $approve_ = DaftarHadir::find($id);
        
        $approve_->eSign = 'Hadir';
 
        $approve_->save();

        // dd($approve_);
        return redirect()->back()->with('success', 'Terima kasih, Anda telah mengisi daftar hadir!');
    }

}

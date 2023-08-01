<?php

namespace App\Http\Controllers;

use App\Models\Auditee;
use App\Models\Auditor;
use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use App\Models\PeluangPeningkatan;
use Illuminate\Support\Facades\Auth;

class PeluangPeningkatanController extends Controller
{
    public function ubahpeluangpeningkatan($auditee_id, $tahunperiode)
    {
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $peningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();

        return view('spm/BA_ubahPeluangPeningkatan', compact('beritaacara_', 'peningkatan_'));
    }

    public function auditor_ubahpeluangpeningkatan($auditee_id, $tahunperiode)
    {
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $peningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();

        return view('auditor/BA_ubahPeluangPeningkatan', compact('beritaacara_', 'peningkatan_'));
    }

    public function storePeluangPeningkatan(Request $request, $auditee_id, $tahunperiode)
    {
        foreach ($request->addmore as $key => $value) {
            PeluangPeningkatan::create($value);
        }

        return redirect()->route('BA-AMI', ['auditee_id' => $auditee_id, 'tahunperiode' => $tahunperiode])->with('success', 'Data peluang peningkatan berhasil ditambah!');
    }

    public function auditor_storePeluangPeningkatan(Request $request, $auditee_id, $tahunperiode)
    {
        foreach ($request->addmore as $key => $value) {
            PeluangPeningkatan::create($value);
        }

        return redirect()->route('auditor-BA-AMI', ['auditee_id' => $auditee_id, 'tahunperiode' => $tahunperiode])->with('success', 'Data peluang peningkatan berhasil ditambah!');
    }

    public function editpeluangpeningkatan($id)
    {
        $beritaacara_ = BeritaAcara::where('id', $id)->first();
        // dd($beritaacara_->id);
        $peningkatan_ = PeluangPeningkatan::find($id);
        
        return view('spm/BA_editPeluangPeningkatan', compact('beritaacara_', 'peningkatan_'));
    }

    public function auditor_editpeluangpeningkatan($id)
    {
        $beritaacara_ = BeritaAcara::where('id', $id)->first();
        // dd($beritaacara_->id);
        $peningkatan_ = PeluangPeningkatan::find($id);
        
        return view('auditor/BA_editPeluangPeningkatan', compact('beritaacara_', 'peningkatan_'));
    }

    public function updatepeluangpeningkatan(Request $request, $id)
    {
        $peningkatan_ = PeluangPeningkatan::find($id);
        $beritaacara_ = BeritaAcara::where('id', $peningkatan_->beritaacara_id)->first();

        foreach ($request->addmore as $key => $value) {
            $peningkatan_->update($value);
        }

        return redirect()->route('BA-AMI', ['auditee_id' => $beritaacara_->auditee_id, 'tahunperiode' => $beritaacara_->tahunperiode])->with('success', 'Data peluang peningkatan berhasil diedit!');
    }

    public function auditor_updatepeluangpeningkatan(Request $request, $id)
    {
        $peningkatan_ = PeluangPeningkatan::find($id);
        $beritaacara_ = BeritaAcara::where('id', $peningkatan_->beritaacara_id)->first();

        foreach ($request->addmore as $key => $value) {
            $peningkatan_->update($value);
        }

        return redirect()->route('auditor-BA-AMI', ['auditee_id' => $beritaacara_->auditee_id, 'tahunperiode' => $beritaacara_->tahunperiode])->with('success', 'Data peluang peningkatan berhasil diedit!');
    }

    public function deletepeluangpeningkatan($id)
    {
        $peningkatan_ = PeluangPeningkatan::find($id);
        // dd($peningkatan_);
        $beritaacara_ = BeritaAcara::where('id', $peningkatan_->beritaacara_id)->first();

        $peningkatan_->delete();

        return redirect()->back()->with('success', 'Data peluang peningkatan berhasil dihapus!');
    }
}

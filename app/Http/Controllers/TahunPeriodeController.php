<?php

namespace App\Http\Controllers;

use App\Models\TahunPeriode;
use Illuminate\Http\Request;

class TahunPeriodeController extends Controller
{
    //
    public function store(Request $request)
    {
        $exist = TahunPeriode::where('tahunperiode1', $request->tahunperiode1)->where('tahunperiode2', $request->tahunperiode2)->where('keterangan', 'Periode Auditor')->exists();

        if ($exist) {
            return redirect()->route('auditor-periode')->with('error', 'Tahun periode sudah tersedia!');
        } else {
            $data = new TahunPeriode;
            $data->tahunperiode1 = $request->tahunperiode1;
            $data->tahunperiode2 = $request->tahunperiode2;
            $data->tgl_mulai = $request->tgl_mulai;
            $data->tgl_berakhir = $request->tgl_berakhir;
            $data->keterangan = "Periode Auditor";
            $data->save();

            return redirect()->route('auditor-periode')->with('success', 'Tahun periode berhasil ditambahkan!');
        }
        
    }

    public function storeauditee(Request $request)
    {
        $exist = TahunPeriode::where('tahunperiode1', $request->tahunperiode1)->where('tahunperiode2', $request->tahunperiode2)->where('keterangan', 'Periode Auditee')->exists();

        if ($exist) {
            return redirect()->route('auditor-periode')->with('error', 'Tahun periode sudah tersedia!');
        } else {
            $data = new TahunPeriode;
            $data->tahunperiode1 = $request->tahunperiode1;
            $data->tahunperiode2 = $request->tahunperiode2;
            $data->tgl_mulai = $request->tgl_mulai;
            $data->tgl_berakhir = $request->tgl_berakhir;
            $data->keterangan = "Periode Auditee";
            $data->save();

            return redirect()->route('auditee-periode')->with('success', 'Tahun periode berhasil ditambahkan!');
        }
        
    }

    public function delete($id)
    {
        $data = TahunPeriode::find($id);

        $data->delete();
        return redirect()->route('auditor-periode')->with('success', 'Tahun periode berhasil dihapus!');
    }
}

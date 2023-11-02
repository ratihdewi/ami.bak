<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TahunPeriode;
use Illuminate\Http\Request;

class TahunPeriodeController extends Controller
{
    //
    public function store(Request $request)
    {
        $tanggalmulai = Carbon::parse($request->tgl_mulai);
        $tanggalselesai = Carbon::parse($request->tgl_berakhir);
        $tahunmulai = $tanggalmulai->year;
        $tahunselesai = $tanggalselesai->year;
        $pengurangantahun = $tahunselesai - $tahunmulai;

        // dd($pengurangantahun);
        // dd($request->all());
        $exist = TahunPeriode::where('tahunperiode1', $request->tahunperiode1)->where('tahunperiode2', $request->tahunperiode2)->where('keterangan', 'Periode Auditor')->exists();

        if (!$exist) {
            if ((($tahunmulai == $request->tahunperiode1 || $tahunmulai == $request->tahunperiode2) && ($tahunselesai == $request->tahunperiode1 || $tahunselesai == $request->tahunperiode2)) && ($pengurangantahun == 1 || $pengurangantahun == 0)) {
                $data = new TahunPeriode;
                $data->tahunperiode1 = $request->tahunperiode1;
                $data->tahunperiode2 = $request->tahunperiode2;
                $data->tgl_mulai = $request->tgl_mulai;
                $data->tgl_berakhir = $request->tgl_berakhir;
                $data->keterangan = "Periode Auditor";
                $data->save();

                $data = new TahunPeriode;
                $data->tahunperiode1 = $request->tahunperiode1;
                $data->tahunperiode2 = $request->tahunperiode2;
                $data->tgl_mulai = $request->tgl_mulai;
                $data->tgl_berakhir = $request->tgl_berakhir;
                $data->keterangan = "Periode Auditee";
                $data->save();

                return redirect()->route('auditor-periode')->with('success', 'Tahun periode berhasil ditambahkan!');
            } else {
                return redirect()->route('auditor-periode')->with('error', 'Tanggal tidak sesuai dengan tahun periode. Silahkan masukkan data kembali!');
            }
        } else {
            return redirect()->route('auditor-periode')->with('error', 'Tahun periode sudah tersedia!');
        }
        
    }

    public function storeauditee(Request $request)
    {
        $tanggalmulai = Carbon::parse($request->tgl_mulai);
        $tanggalselesai = Carbon::parse($request->tgl_berakhir);
        $tahunmulai = $tanggalmulai->year;
        $tahunselesai = $tanggalselesai->year;
        $pengurangantahun = $tahunselesai - $tahunmulai;

        $exist = TahunPeriode::where('tahunperiode1', $request->tahunperiode1)->where('tahunperiode2', $request->tahunperiode2)->where('keterangan', 'Periode Auditee')->exists();

        if (!$exist) {
            if ((($tahunmulai == $request->tahunperiode1 || $tahunmulai == $request->tahunperiode2) && ($tahunselesai == $request->tahunperiode1 || $tahunselesai == $request->tahunperiode2)) && ($pengurangantahun == 1 || $pengurangantahun == 0)) {
                $data = new TahunPeriode;
                $data->tahunperiode1 = $request->tahunperiode1;
                $data->tahunperiode2 = $request->tahunperiode2;
                $data->tgl_mulai = $request->tgl_mulai;
                $data->tgl_berakhir = $request->tgl_berakhir;
                $data->keterangan = "Periode Auditee";
                $data->save();

                return redirect()->route('auditee-periode')->with('success', 'Tahun periode berhasil ditambahkan!');
            } else {
                return redirect()->route('auditee-periode')->with('error', 'Tanggal tidak sesuai dengan tahun periode. Silahkan masukkan data kembali!');
            }
        } else {
            return redirect()->route('auditee-periode')->with('error', 'Tahun periode sudah tersedia!');
        }
        
    }

    public function delete($id)
    {
        $data = TahunPeriode::find($id);

        $data->delete();
        return redirect()->route('auditor-periode')->with('success', 'Tahun periode berhasil dihapus!');
    }

    public function deleteperiodeauditee($id)
    {
        $data = TahunPeriode::find($id);

        $data->delete();
        return redirect()->route('auditee-periode')->with('success', 'Tahun periode berhasil dihapus!');
    }
}

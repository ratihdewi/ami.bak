<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\JadwalAMI;

class JadwalAMIController extends Controller
{
    public function index()
    {
        $jadwalami = JadwalAMI::all();

        return view('');
    }

    public function storejadwalami(Request $request)
    {
        $periodeami = new Carbon($request->tgl_mulai);
        $periode = $periodeami->year;
        // dd($request->addmore);
        foreach ($request->addmore as $key => $value) {
            $jadwalami = new JadwalAMI([
                "kegiatan" => $value['kegiatan'],
                "tgl_mulai" => $value['tgl_mulai'],
                "tgl_berakhir" => $value['tgl_berakhir'],
            ]);
            $jadwalami->save();
        }

        return redirect()->route('jadwalaudit')->with('addsuccess', 'Jadwal Keseluruhan AMI periode '.$periode.' berhasil ditambahkan!');
    }

    public function editjadwalami($id)
    {
        $jadwalami = JadwalAMI::find($id);

        return view('spm/editjadwalami', compact('jadwalami'));
    }

    public function updatejadwalami(Request $request, $id)
    {
        $data = JadwalAMI::find($id);
        $periodeami = new Carbon($data->tgl_mulai);
        $periode = $periodeami->year;
        $data->update($request->all());
        return redirect()->route('jadwalaudit')->with('addsuccess', 'Jadwal Keseluruhan AMI periode '.$periode.' berhasil diupdate!');
    }

    // public function updatejadwalami(Request $request, $id)
    // {

    //     $periodeami = new Carbon($request->tgl_mulai);
    //     $periode = $periodeami->year;

    //     $jadwalami = JadwalAMI::find($id);

    //     $jadwalami->update();

    //     return redirect()->route('jadwalaudit')->with('success', 'Jadwal Keseluruhan AMI periode '.$periode.' berhasil diupdate!');
    // }

    public function deletejadwalami($id)
    {
        $jadwalami = JadwalAMI::find($id);

        $periodeami = new Carbon($jadwalami->tgl_mulai);
        $periode = $periodeami->year;

        $jadwalami->delete();

        return redirect()->back()->with('addsuccess', 'Jadwal Keseluruhan AMI periode '.$periode.' berhasil dihapus!');
    }
}

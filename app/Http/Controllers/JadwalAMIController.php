<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\JadwalAMI;
use App\Models\TahunPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class JadwalAMIController extends Controller
{
    public function index()
    {
        $jadwalami = JadwalAMI::all();

        return view('');
    }

    public function tambahjadwal()
    {
        $locale = Config::get('app.locale');
        $timeZone = Config::get('app.timezone');
        
        return view('spm/addJadwal', compact('locale', 'timeZone'));
    }

    public function storejadwalami(Request $request)
    {

        foreach ($request->addmore as $key => $value) {

            $thperiode = TahunPeriode::where('tahunperiode1', $value['th_ajaran1'])->where('tahunperiode2', $value['th_ajaran2'])->where('keterangan', 'Periode Auditee');

            // dd($value['tgl_mulai']);
            
            if ($thperiode->exists()) {
                if (($value['tgl_mulai'] >= $thperiode->first()->tgl_mulai) || ($value['tgl_berakhir'] <= $thperiode->first()->tgl_berakhir)) {

                    $dateStart = $value['tgl_mulai'];
                    $dateFinish = $value['tgl_berakhir'];

                    $jadwalami = new JadwalAMI([
                        "th_ajaran1" => $value['th_ajaran1'],
                        "th_ajaran2" => $value['th_ajaran2'],
                        "kegiatan" => $value['kegiatan'],
                        "tgl_mulai" =>$dateStart,
                        "tgl_berakhir" => $dateFinish,
                    ]);
                    $jadwalami->save();
    
                    $return = redirect()->route('jadwalaudit')->with('addsuccess', 'Jadwal Keseluruhan AMI berhasil ditambahkan!');
                } else {
                    $return = redirect()->route('jadwalaudit')->with('adderror', 'Tanggal yang dimasukkan tidak sesuai dengan tahun periode!');
                }
            }

            // $tanggalmulai = Carbon::parse($value['tgl_mulai'])->year;
            // $tanggalselesai = Carbon::parse($value['tgl_berakhir'])->year;

            // if (($value['th_ajaran1'] == $tanggalmulai || $value['th_ajaran2'] == $tanggalmulai) && ($value['th_ajaran1'] == $tanggalselesai || $value['th_ajaran2'] == $tanggalselesai)) {
            //     $dateStart = $value['tgl_mulai'];
            //     $dateFinish = $value['tgl_berakhir'];

            //     $jadwalami = new JadwalAMI([
            //         "th_ajaran1" => $value['th_ajaran1'],
            //         "th_ajaran2" => $value['th_ajaran2'],
            //         "kegiatan" => $value['kegiatan'],
            //         "tgl_mulai" =>$dateStart,
            //         "tgl_berakhir" => $dateFinish,
            //     ]);
            //     $jadwalami->save();

            //     $return = redirect()->route('jadwalaudit')->with('addsuccess', 'Jadwal Keseluruhan AMI berhasil ditambahkan!');
            // } else {
            //     $return = redirect()->route('jadwalaudit')->with('adderror', 'Tahun periode dengan tanggal yang diinputkan tidak sesuai. Silahkan masukkan kembali data dengan benar!');
            // }
        }
        return $return;
    }

    public function editjadwalami($id)
    {
        $locale = Config::get('app.locale');
        $timeZone = Config::get('app.timezone');
        $jadwalami = JadwalAMI::find($id);

        return view('spm/editjadwalami', compact('jadwalami', 'locale', 'timeZone'));
    }

    public function updatejadwalami(Request $request, $id)
    {
        // dd($request->all());
        $data = JadwalAMI::find($id);

        $dateStart = $request->tgl_mulai;
        $dateFinish = $request->tgl_berakhir;
        
        // // $locale = Config::get('app.locale');
        // $dateStart = Carbon::createFromFormat('DD-MM-YYYY', $dateStart)->format('Y-m-d');
        // $dateFinish = Carbon::createFromFormat('l, d M Y', $dateFinish)->format('Y-m-d');
        // // $cekLocale = new Date($dateStart);

        // dd($carbonDate);
        // dump($dateStart);

        // dd($request->all());
        // $startArray = date_parse($dateStart);
        // $finishArray = date_parse($dateFinish);
        // $startdate = date("Y-m-d", mktime(0, 0, 0, $startArray["month"], $startArray["day"], $startArray["year"]));
        // $finishdate = date("Y-m-d", mktime(0, 0, 0, $finishArray["month"], $finishArray["day"], $finishArray["year"]));

        // dd($dateFinish);

        if ($dateStart && $dateFinish) {
            $data->update([
                'kegiatan' => $request->kegiatan,
                'tgl_mulai' => $dateStart,
                'tgl_berakhir' => $dateFinish,
            ]);
            $data->save();
    
            return redirect()->route('jadwalaudit')->with('addsuccess', 'Jadwal Keseluruhan AMI berhasil diupdate!');
        } else {
            return redirect()->route('jadwalaudit')->with('adderror', 'Jadwal Keseluruhan AMI gagal diupdate. Silahkan masukkan data dengan benar!');
        }
        
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

<?php

namespace App\Http\Controllers;

use PDF;
use QrCode;
use App\Models\Jadwal;
use App\Models\Auditee;
// use Barryvdh\DomPDF\PDF;
use App\Models\DokBA_AMI;
use App\Models\Pertanyaan;
use App\Models\BeritaAcara;
use App\Models\DaftarHadir;
use App\Models\DaftarTilik;
use App\Models\DokLampiran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PersetujuanBA;
use App\Models\PeluangPeningkatan;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class DokBAAMIController extends Controller
{
    public function tampilBA_AMI($auditee_id, $tahunperiode)
    {   
        $beritaacaras = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $daftarhadirs = DaftarHadir::where('beritaacara_id', $beritaacaras->id)->get();

        $eSign = [];

        foreach ($daftarhadirs as $key => $daftarhadir) {
            $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

            $esignKehadiran = QrCode::generate($url);

            array_push($eSign, QrCode::generate($url));
        }

        $auditee = Auditee::find($auditee_id);
        
        $urlAuditee = url('/auditee-esignba/'.$beritaacaras->id);
        $urlAuditor = url('/auditor-esignba/'.$beritaacaras->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee);
        
        $auditee_ = Auditee::where('id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $ba_ami = DokBA_AMI::where('auditee_id', $auditee_id);
        $jadwalAudit_ = Jadwal::where('auditee_id', $auditee_id)->get();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $pelpeningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        $dokumenpendukung__ = DokLampiran::where('auditee_id', $auditee_id);

        return view('spm/beritaAcaraAMI', compact('auditee', 'daftartilik_', 'pertanyaan_', 'ba_ami', 'beritaacara_', 'auditee_', 'jadwalAudit_', 'daftarhadir_', 'pelpeningkatan_', 'dokumenpendukung_', 'dokumenpendukung__', 'eSign', 'qrCodeAuditor', 'qrCodeAuditee'));
    }

    public function auditor_tampilBA_AMI($auditee_id, $tahunperiode)
    {
        $beritaacaras = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $daftarhadirs = DaftarHadir::where('beritaacara_id', $beritaacaras->id)->get();
        
        $eSign = [];

        foreach ($daftarhadirs as $key => $daftarhadir) {
            $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

            $esignKehadiran = QrCode::generate($url);

            array_push($eSign, QrCode::generate($url));
        } 

        $auditee = Auditee::find($auditee_id);
        
        $urlAuditee = url('/auditee-esignba/'.$beritaacaras->id);
        $urlAuditor = url('/auditor-esignba/'.$beritaacaras->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee);

        $auditee_ = Auditee::where('id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $ba_ami = DokBA_AMI::where('auditee_id', $auditee_id);
        $jadwalAudit_ = Jadwal::where('auditee_id', $auditee_id)->get();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $pelpeningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        $dokumenpendukung__ = DokLampiran::where('auditee_id', $auditee_id);

        return view('auditor/beritaAcaraAMI', compact('daftartilik_', 'pertanyaan_', 'ba_ami', 'beritaacara_', 'auditee_', 'jadwalAudit_', 'daftarhadir_', 'pelpeningkatan_', 'dokumenpendukung_', 'dokumenpendukung__', 'eSign', 'qrCodeAuditor', 'qrCodeAuditee'));
    }

    public function auditee_tampilBA_AMI($auditee_id, $tahunperiode)
    {
        $beritaacaras = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $daftarhadirs = DaftarHadir::where('beritaacara_id', $beritaacaras->id)->get();
        
        $eSign = [];

        foreach ($daftarhadirs as $key => $daftarhadir) {
            $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

            $esignKehadiran = QrCode::generate($url);

            array_push($eSign, QrCode::generate($url));
        } 

        $auditee = Auditee::find($auditee_id);
        
        $urlAuditee = url('/auditee-esignba/'.$beritaacaras->id);
        $urlAuditor = url('/auditor-esignba/'.$beritaacaras->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee);

        $auditee_ = Auditee::where('id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $ba_ami = DokBA_AMI::where('auditee_id', $auditee_id);
        $jadwalAudit_ = Jadwal::where('auditee_id', $auditee_id)->get();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $pelpeningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        $dokumenpendukung__ = DokLampiran::where('auditee_id', $auditee_id);

        return view('auditee/beritaAcaraAMI', compact('daftartilik_', 'pertanyaan_', 'ba_ami', 'beritaacara_', 'auditee_', 'jadwalAudit_', 'daftarhadir_', 'pelpeningkatan_', 'dokumenpendukung_', 'dokumenpendukung__', 'eSign', 'qrCodeAuditor', 'qrCodeAuditee'));
    }

    public function ubahdataDokumenBA($auditee_id, $tahunperiode)
    {
        $ba_ = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $dokBA_ = DokBA_AMI::where('beritaacara_id', $ba_->id)->where('auditee_id', $auditee_id)->first();
        
        if ($dokBA_ != null) {
            return view('spm/BAAMI_ubahDataDokumenBA', compact('ba_','dokBA_'));
        } else {
            return view('spm/BAAMI_addDataDokumenBA', compact('ba_','dokBA_'));
        }
        
    }

    public function auditor_ubahdataDokumenBA($auditee_id, $tahunperiode)
    {
        $ba_ = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $dokBA_ = DokBA_AMI::where('beritaacara_id', $ba_->id)->where('auditee_id', $auditee_id)->first();

        if ($dokBA_ != null) {
            return view('auditor/BAAMI_ubahDataDokumenBA', compact('ba_','dokBA_'));
        } else {
            return view('auditor/BAAMI_addDataDokumenBA', compact('ba_','dokBA_'));
        }
    }

    public function insertdataDokumenBA(Request $request, $auditee_id)
    {
        $dataDokumen_ = DokBA_AMI::find($auditee_id);
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->get()->first();

        // if ($dataDokumen_ != null) {

        //     $dataDokumen_->update([
        //         'beritaacara_id' => $beritaacara_->id,
        //         'beritaacara_id' => $beritaacara_->id,
        //         'judulDokumen' => $request->judulDokumen,
        //         'kodeDokumen' => $request->kodeDokumen,
        //         'revisiKe' => $request->revisiKe,
        //         'tgl_revisi' => $request->tgl_revisi,
        //         'tgl_berlaku' => $request->tgl_berlaku,
        //     ]);
        //     $dataDokumen_->save();

        // } else {
            $dataDokumen = new DokBA_AMI;
            $dataDokumen->beritaacara_id = $beritaacara_->id;
            $dataDokumen->auditee_id = $auditee_id;
            $dataDokumen->judulDokumen = $request->judulDokumen;
            $dataDokumen->kodeDokumen = $request->kodeDokumen;
            $dataDokumen->revisiKe = $request->revisiKe;
            $dataDokumen->tgl_revisi = $request->tgl_revisi;
            $dataDokumen->tgl_berlaku = $request->tgl_berlaku;
            $dataDokumen->save();
        // };

        return redirect()->back()->with('success', 'Data Dokumen BA AMI berhasil ditambah!');
    }

    public function ubahdataBAAMI($auditee_id)
    {
        $ba_ = BeritaAcara::all()->unique('auditee_id');
        $dokBA_ = DokBA_AMI::where('auditee_id', $auditee_id)->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->get();
        $jadwalAudit_ = Jadwal::all();
        
        return view('spm/BAAMI_ubahBAAMI', compact('ba_','dokBA_', 'beritaacara_'));
    }

    public function updatedataBAAMI(Request $request, $id)
    {
        $dataDokumen_ = DokBA_AMI::find($id);
        // $beritaacara_ = BeritaAcara::where('auditee_id', $dataDokumen_->auditee_id)->get()->first();
        

        if ($dataDokumen_->exists()) {

            $upperjudul = Str::upper($request->judulDokumen);

            $dataDokumen_->update([
                'beritaacara_id' => $dataDokumen_->beritaacara_id,
                'auditee_id' => $dataDokumen_->auditee_id,
                'judulDokumen' => $upperjudul,
                'kodeDokumen' => $request->kodeDokumen,
                'revisiKe' => $request->revisiKe,
                'tgl_revisi' => $request->tgl_revisi,
                'tgl_berlaku' => $request->tgl_berlaku,
            ]);
            $dataDokumen_->save();

        } else {

            $upperjudul = Str::upper($request->judulDokumen);

            $dataDokumen = new DokBA_AMI;
            $dataDokumen->beritaacara_id = $dataDokumen_->beritaacara_id;
            $dataDokumen->auditee_id = $dataDokumen_->auditee_id;
            $dataDokumen->judulDokumen = $upperjudul;
            $dataDokumen->kodeDokumen = $request->kodeDokumen;
            $dataDokumen->revisiKe = $request->revisiKe;
            $dataDokumen->revisiKe = $request->revisiKe;
            $dataDokumen->tgl_berlaku = $request->tgl_berlaku;
            $dataDokumen->save();
        };

        return redirect()->back()->with('success', 'Data Dokumen AMI berhasil diupdate!');
    }

    public function approvalAuditee($id)
    {
        $approve_ = DokBA_AMI::find($id);
        
        $approve_->eSignAuditee = 'Disetujui';

        $persetujuan = new PersetujuanBA;
        $persetujuan->beritaacara_id = $approve_->beritaacara_id;
        $persetujuan->posisi = 'Ketua Auditee';
        $persetujuan->nama = $approve_->auditee->ketua_auditee;
        $persetujuan->eSign = $approve_->eSignAuditee;
        $persetujuan->save();
 
        $approve_->save();

        // dd($approve_);
        return redirect()->back()->with('message', 'Dokumen BA-AMI sudah berhasil disetujui oleh Ketua Auditee');
    }

    public function approvalAuditor($id)
    {
        $approve_ = DokBA_AMI::find($id);
        
        $approve_->eSignAuditor = 'Disetujui';

        $persetujuan = new PersetujuanBA;
        $persetujuan->beritaacara_id = $approve_->beritaacara_id;
        $persetujuan->posisi = 'Ketua Auditor';
        $persetujuan->nama = $approve_->auditee->ketua_auditor;
        $persetujuan->eSign = $approve_->eSignAuditor;
        $persetujuan->save();
 
        $approve_->save();

        // dd($approve_);
        return redirect()->back()->with('message', 'Dokumen BA-AMI sudah berhasil disetujui oleh Ketua Auditor');
    }

    public function pratinjauba($auditee_id, $tahunperiode)
    {
        $beritaacaras = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $daftarhadirs = DaftarHadir::where('beritaacara_id', $beritaacaras->id)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();

        $eSignAuditor = [];
        $eSignAuditee = [];

        foreach ($daftarhadirs as $key => $daftarhadir) {
            if ($daftarhadir->posisi == "Ketua Auditor" || $daftarhadir->posisi == "Anggota Auditor") {
                $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

                $esignKehadiran = QrCode::generate($url);

                array_push($eSignAuditor, QrCode::generate($url));
            } elseif ($daftarhadir->posisi == "Ketua Auditee" || $daftarhadir->posisi == "Anggota Auditee") {
                $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

                $esignKehadirane = QrCode::generate($url);

                array_push($eSignAuditee, QrCode::generate($url));
            }
            
        } 

        $auditee = Auditee::find($auditee_id);
        
        $urlAuditee = url('/auditee-esignba/'.$beritaacaras->id);
        $urlAuditor = url('/auditor-esignba/'.$beritaacaras->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee);

        $auditee_ = Auditee::where('id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $ba_ami = DokBA_AMI::where('auditee_id', $auditee_id);
        $jadwalAudit_ = Jadwal::where('auditee_id', $auditee_id)->get();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $pelpeningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        $dokumenpendukung__ = DokLampiran::where('auditee_id', $auditee_id);

        return view('spm/BAAMI_pratinjau', compact('daftartilik_', 'pertanyaan_', 'ba_ami', 'beritaacara_', 'auditee_', 'jadwalAudit_', 'daftarhadir_', 'pelpeningkatan_', 'dokumenpendukung_', 'dokumenpendukung__', 'eSignAuditor', 'eSignAuditee', 'qrCodeAuditor', 'qrCodeAuditee', 'auditee'));
    }

    public function auditor_pratinjauba($auditee_id, $tahunperiode)
    {
        $beritaacaras = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $daftarhadirs = DaftarHadir::where('beritaacara_id', $beritaacaras->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();

        $eSignAuditor = [];
        $eSignAuditee = [];

        foreach ($daftarhadirs as $key => $daftarhadir) {
            if ($daftarhadir->posisi == "Ketua Auditor" || $daftarhadir->posisi == "Anggota Auditor") {
                $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

                $esignKehadiran = QrCode::generate($url);

                array_push($eSignAuditor, QrCode::generate($url));
            } elseif ($daftarhadir->posisi == "Ketua Auditee" || $daftarhadir->posisi == "Anggota Auditee") {
                $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

                $esignKehadiran = QrCode::generate($url);

                array_push($eSignAuditee, QrCode::generate($url));
            }
            
        } 

        $auditee = Auditee::find($auditee_id);
        
        $urlAuditee = url('/auditee-esignba/'.$beritaacaras->id);
        $urlAuditor = url('/auditor-esignba/'.$beritaacaras->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee);

        $auditee_ = Auditee::where('id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $ba_ami = DokBA_AMI::where('auditee_id', $auditee_id);
        $jadwalAudit_ = Jadwal::where('auditee_id', $auditee_id)->get();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $pelpeningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        $dokumenpendukung__ = DokLampiran::where('auditee_id', $auditee_id);

        return view('auditor/BAAMI_pratinjau', compact('daftartilik_', 'pertanyaan_', 'ba_ami', 'beritaacara_', 'auditee_', 'jadwalAudit_', 'daftarhadir_', 'pelpeningkatan_', 'dokumenpendukung_', 'dokumenpendukung__', 'eSignAuditor', 'eSignAuditee', 'qrCodeAuditor', 'qrCodeAuditee'));
    }

    public function auditee_pratinjauba($auditee_id, $tahunperiode)
    {
        $beritaacaras = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $daftarhadirs = DaftarHadir::where('beritaacara_id', $beritaacaras->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();

        $eSignAuditor = [];
        $eSignAuditee = [];

        foreach ($daftarhadirs as $key => $daftarhadir) {
            if ($daftarhadir->posisi == "Ketua Auditor" || $daftarhadir->posisi == "Anggota Auditor") {
                $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

                $esignKehadiran = QrCode::generate($url);

                array_push($eSignAuditor, QrCode::generate($url));
            } elseif ($daftarhadir->posisi == "Ketua Auditee" || $daftarhadir->posisi == "Anggota Auditee") {
                $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

                $esignKehadiran = QrCode::generate($url);

                array_push($eSignAuditee, QrCode::generate($url));
            }
            
        } 

        $auditee = Auditee::find($auditee_id);
        
        $urlAuditee = url('/auditee-esignba/'.$beritaacaras->id);
        $urlAuditor = url('/auditor-esignba/'.$beritaacaras->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee);

        $auditee_ = Auditee::where('id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $ba_ami = DokBA_AMI::where('auditee_id', $auditee_id);
        $jadwalAudit_ = Jadwal::where('auditee_id', $auditee_id)->get();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $pelpeningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        $dokumenpendukung__ = DokLampiran::where('auditee_id', $auditee_id);

        return view('auditee/BAAMI_pratinjau', compact('daftartilik_', 'pertanyaan_', 'ba_ami', 'beritaacara_', 'auditee_', 'jadwalAudit_', 'daftarhadir_', 'pelpeningkatan_', 'dokumenpendukung_', 'dokumenpendukung__', 'eSignAuditor', 'eSignAuditee', 'qrCodeAuditor', 'qrCodeAuditee'));
    }

    public function downloadba(Request $request, $auditee_id, $tahunperiode)
    {
        $beritaacaras = BeritaAcara::where('auditee_id', $auditee_id)->where('tahunperiode', $tahunperiode)->first();
        $daftarhadirs = DaftarHadir::where('beritaacara_id', $beritaacaras->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();

        $eSignAuditor = [];
        $eSignAuditee = [];

        foreach ($daftarhadirs as $key => $daftarhadir) {
            if ($daftarhadir->posisi == "Ketua Auditor" || $daftarhadir->posisi == "Anggota Auditor") {
                $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

                $esignKehadiran = QrCode::generate($url);

                array_push($eSignAuditor, QrCode::generate($url));
            } elseif ($daftarhadir->posisi == "Ketua Auditee" || $daftarhadir->posisi == "Anggota Auditee") {
                $url = url('/auditor-esignhadir/'.$auditee_id.'/'.$daftarhadir->id.'/'.$daftarhadir->namapeserta);

                $esignKehadiran = QrCode::generate($url);

                array_push($eSignAuditee, QrCode::generate($url));
            }
            
        } 

        $auditee = Auditee::find($auditee_id);
        
        $urlAuditee = url('/auditee-esignba/'.$beritaacaras->id);
        $urlAuditor = url('/auditor-esignba/'.$beritaacaras->id);

        $qrCodeAuditor = QrCode::generate($urlAuditor);
        $qrCodeAuditee = QrCode::generate($urlAuditee);

        // dd($id);
        $auditee_ = Auditee::where('id', $auditee_id)->get();
        $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        $beritaacara_ = BeritaAcara::where('auditee_id', $auditee_id)->first();
        $ba_ami = DokBA_AMI::where('auditee_id', $auditee_id);
        $jadwalAudit_ = Jadwal::where('auditee_id', $auditee_id)->get();
        $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->where('deletedBy', null)->orderByRaw("FIELD(posisi, 'Ketua Auditor', 'Anggota Auditor', 'Ketua Auditee', 'Anggota Auditee')")->get();
        $pelpeningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();
        $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        $dokumenpendukung__ = DokLampiran::where('auditee_id', $auditee_id);
        
        // $beritaacara_ = BeritaAcara::where('id', $id)->get();
        // dd($beritaacara_);
        // $ba_auditee = DokBA_AMI::where('beritaacara_id', $beritaacara_->id)->first();
        // $auditees = Auditee::where('id', $beritaacara_->auditee_id)->first();
        // $auditee_id = $auditees->id;
        // $auditee_ = Auditee::where('id', $auditee_id)->get();
        // $daftartilik_ = DaftarTilik::where('auditee_id', $auditee_id)->get();
        // $pertanyaan_ = Pertanyaan::where('auditee_id', $auditee_id)->where('Kategori', '!=', 'Sesuai')->get();
        // $ba_ami = DokBA_AMI::where('auditee_id', $auditee_id);
        // $jadwalAudit_ = Jadwal::where('auditee_id', $auditee_id)->get();
        // $daftarhadir_ = DaftarHadir::where('beritaacara_id', $beritaacara_->id)->get();
        // $pelpeningkatan_ = PeluangPeningkatan::where('beritaacara_id', $beritaacara_->id)->get();
        // $dokumenpendukung_ = DokLampiran::where('auditee_id', $auditee_id)->get();
        // $dokumenpendukung__ = DokLampiran::where('auditee_id', $auditee_id);

        
        if (count($ba_ami->get()) == 0) {
            return redirect()->back()->with('warning', 'Harap lengkapi data terlebih pada BA AMI');
        } else {
            $baami = DokBA_AMI::where('auditee_id', $auditee_id)->first();
            $auditee = Auditee::where('id', $baami->auditee_id)->first();
        }

        $data = [
            'daftartilik_' => $daftartilik_,
            'pertanyaan_' => $pertanyaan_,
            'ba_ami' => $ba_ami,
            'beritaacara_' => $beritaacara_,
            'auditee_' => $auditee_,
            'jadwalAudit_' => $jadwalAudit_,
            'daftarhadir_' => $daftarhadir_,
            'pelpeningkatan_' => $pelpeningkatan_,
            'dokumenpendukung_' => $dokumenpendukung_,
            'dokumenpendukung__' => $dokumenpendukung__,
            'eSignAuditor' => $eSignAuditor,
            'eSignAuditee' => $eSignAuditee,
            'qrCodeAuditor' => $qrCodeAuditor,
            'qrCodeAuditee' => $qrCodeAuditee,
        ];

        $pdf = PDF::loadView('spm/BAAMI_exportpdf', $data);
        $pdf->setPaper('A4', 'portrait');
        $options = [
            'margin-top' => '20mm',
            'margin-bottom' => '20mm',
        ];
        $pdf->setOptions($options);
        
        $namaFile = $auditee->unit_kerja.'-'.$baami->judulDokumen.'.pdf';
     
        return $pdf->download($namaFile);
    }
}

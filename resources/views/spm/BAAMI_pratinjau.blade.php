@extends('layout.main') 
@section('title') AMI - Temuan Berita Acara @endsection

@section('container')
<div class="container-pratinjau mx-4 my-5">
    <div id="dokheader" class="dokheader my-3 mx-4 py-2">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="d-flex justify-content-center px-2 py-5">
                        <img src="/asset/Logo-Up.png" alt="logo-uper" width="120">
                        {{-- <img src="{{ public_path('asset/Logo-Up.png') }}" alt="logo-uper" width="120"> --}}
                    </td>
                    <td colspan="4" class="infouper px-4 py-3">
                        <h4 class="my-3"><b>UNIVERSITAS PERTAMINA</b></h4>
                        <p class="my-3">
                            Jalan Teuku Nyak Arief, Simprug, <br>
                            Kebayoran Lama, Jakarta Selatan, 12220 <br>
                            Telp. (021) 29044308
                        </p>
                    </td>
                </tr>
                @foreach ($ba_ami->get() as $ba)
                <tr class="fw-bold">
                    <td rowspan="2" class="text-center align-middle">FORMULIR</td>
                    <td>KODE</td>
                    <td>{{ $ba->kodeDokumen }}</td>
                    <td>TGL. BERLAKU</td>
                    <td>{{ $ba->tgl_berlaku }}</td>
                </tr>
                <tr class="fw-bold">
                    <td>REVISI KE-</td>
                    <td>{{ $ba->revisiKe }}</td>
                    <td>TGL. REVISI</td>
                    <td>{{ $ba->tgl_revisi }}</td>
                </tr>
                <tr class="fw-bold">
                    <td colspan="5" class="text-center">{{ $ba->judulDokumen }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="row">
            <div class="col-2 d-flex justify-content-center px-4 py-5 border border-dark">
                <img src="/asset/Logo-UP.png" alt="logo-uper" width="120">
            </div>
            <div class="col-10 px-4 py-3 border border-dark border-start-0">
                <div class="infouper my-4">
                    <h4><b>UNIVERSITAS PERTAMINA</b></h4>
                    <p>
                        Jalan Teuku Nyak Arief, Simprug, <br>
                        Kebayoran Lama, Jakarta Selatan, 12220 <br>
                        Telp. (021) 29044308
                    </p>
                </div>
            </div>
        </div>
        @foreach ($ba_ami->get() as $ba)
        <div class="row fw-bold">
            <div class="col-2 border border-dark border-top-0 text-center py-3 ">
                <h4 class="my-2"><b>FORMULIR</b></h4>
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-2 py-2 border-dark border-bottom">KODE</div>
                    <div class="col-4 py-2 border border-dark border-top-0">{{ $ba->kodeDokumen }}</div>
                    <div class="col-2 py-2 border border-dark border-top-0 border-start-0">TGL. BERLAKU</div>
                    <div class="col-4 py-2 border border-dark border-top-0 border-start-0">{{ $ba->tgl_berlaku }}</div>
                </div>
                <div class="row">
                    <div class="col-2 py-2 border-dark border-bottom">REVISI KE-</div>
                    <div class="col-4 py-2 border border-dark border-top-0">{{ $ba->revisiKe }}</div>
                    <div class="col-2 py-2 border border-dark border-top-0 border-start-0">TGL. REVISI</div>
                    <div class="col-4 py-2 border border-dark border-top-0 border-start-0">{{ $ba->tgl_revisi }}</div>
                </div>
            </div>
        </div>
        <div class="row fw-bold">
            <div class="col py-2 border border-dark border-top-0 text-center">{{ $ba->judulDokumen }}</div>
        </div>
        @endforeach --}}
    </div>
    <div id="infoBA" class="infoBA my-3 mx-4 py-2">
        <table class="table px-5">
            <tbody>
                <tr>
                    <td rowspan="3" class="w-50">Fungsi : 
                        @foreach ($jadwalAudit_->unique('auditee_id') as $jadwal)
                        {{ $jadwal->auditee->unit_kerja }}
                        @endforeach
                    </td>
                    <td class="w-50">Hari/Tanggal : 
                        @foreach ($jadwalAudit_ as $jadwal)
                        {{ $jadwal->hari_tgl->isoFormat('dddd/ d MMMM Y') }}, 
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="w-50">Waktu : 
                        @foreach ($jadwalAudit_ as $jadwal)
                        {{ $jadwal->waktu->isoFormat('HH:mm') }}, 
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="w-50">Media : 
                        @foreach ($jadwalAudit_ as $jadwal)
                        {{ $jadwal->tempat }}, 
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- <div class="row d-flex justify-content-between mb-2">
            <div class="col-5">Fungsi: 
                @foreach ($jadwalAudit_->unique('auditee_id') as $jadwal)
                {{ $jadwal->auditee->unit_kerja }}
                @endforeach
            </div>
            <div class="col-5">Hari/Tanggal :
                @foreach ($jadwalAudit_ as $jadwal)
                {{ $jadwal->hari_tgl->isoFormat('dddd/ d MMMM Y') }}, 
                @endforeach
            </div>
        </div>
        <div class="row d-flex justify-content-between mb-2">
            <div class="col-5"></div>
            <div class="col-5">Waktu :
                @foreach ($jadwalAudit_ as $jadwal)
                {{ $jadwal->waktu->isoFormat('HH:mm') }} WIB, 
                @endforeach
            </div>
        </div>
        <div class="row d-flex justify-content-between mb-2">
            <div class="col-5"></div>
            <div class="col-5">Media :
                @foreach ($jadwalAudit_ as $jadwal)
                {{ $jadwal->tempat }}, 
                @endforeach
            </div>
        </div> --}}
    </div>
    <div id="bodydoc" class="bodydoc my-3 mx-4 py-2">
        <p>1. Pada hari ini telah dilaksanakan Audit Mutu Internal Tahun Ajaran 
            @foreach ($jadwalAudit_->unique('th_ajaran1', 'th_ajaran2') as $jadwal)
                @if ($jadwal->th_ajaran1 == $jadwal->hari_tgl->isoFormat('Y') || $jadwal->th_ajaran2 == $jadwal->hari_tgl->isoFormat('Y'))
                {{ $jadwal->th_ajaran1 }}/{{ $jadwal->th_ajaran2 }} 
                @endif
            @endforeach
            oleh:
        </p>
        <div class="tabledaftarhadir mb-5 px-3">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th colspan="2">Nama</th>
                        <th>Tanda Tangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarhadir_ as $daftarhadir)
                    @if ($daftarhadir->posisi == 'Auditor')
                    <tr>
                        <td rowspan>Auditor</td>
                        <td>{{ $daftarhadir->namapeserta }}</td>
                        <td>{{ $daftarhadir->eSign }}</td>
                        
                    </tr>
                    @endif
                    @endforeach
                    <tr>
                        <td rowspan>Auditee</td>
                        @foreach ($daftarhadir_ as $daftarhadir)
                        @if ($daftarhadir->posisi == 'Auditee')
                        <td>{{ $daftarhadir->namapeserta }}</td>
                        <td>{{ $daftarhadir->eSign }}</td>
                        @endif
                        @endforeach
                    </tr>
                </tbody>
            </table>
            {{-- <div class="row">
                <div class="col-7 py-2 text-center border border-dark">
                    <b>Nama</b>
                </div>
                <div class="col-3 py-2 text-center border border-start-0 border-dark">
                    <b>Tanda Tangan</b>
                </div>
            </div>
            
            <div class="row">
                <div class="col-3 py-2 text-center border border-dark border-top-0">Auditor</div>
                <div class="col-4 border border-dark border-start-0 border-top-0 border-bottom-0">
                    @foreach ($daftarhadir_ as $daftarhadir)
                    @if ($daftarhadir->posisi == "Auditor")
                    <div class="row namapeserta border-bottom border-dark py-2 ps-3">
                    {{ $daftarhadir->namapeserta }}
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="col-3 text-center border border-start-0 border-dark border-top-0 border-bottom-0">
                    @foreach ($daftarhadir_ as $daftarhadir)
                    @if ($daftarhadir->posisi == "Auditor")
                    <div class="row esignpeserta border-bottom border-dark py-2 ps-3">{{ $daftarhadir->eSign }}</div>
                    @endif
                    @endforeach
                </div>
                
                
            </div>
            <div class="row">
                <div class="col-3 py-2 text-center border border-dark border-top-0">Auditee</div>
                <div class="col-4 border border-dark border-start-0 border-top-0 border-bottom-0">
                    @foreach ($daftarhadir_ as $daftarhadir)
                    @if ($daftarhadir->posisi == "Auditee")
                    <div class="row namapeserta border-bottom border-dark py-2 ps-3">
                    {{ $daftarhadir->namapeserta }}
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="col-3 text-center border border-start-0 border-dark border-top-0 border-bottom-0">
                    @foreach ($daftarhadir_ as $daftarhadir)
                    @if ($daftarhadir->posisi == "Auditee")
                    <div class="row esignpeserta border-bottom border-dark py-2 ps-3">{{ $daftarhadir->eSign }}</div>
                    @endif
                    @endforeach
                </div>
                
                
            </div> --}}
        </div>
        <p>2. Temuan dan Ketidaksesuaian:</p>
        <div class="tabletemuan mb-4">
            <p><b>A. Temuan Audit</b></p>
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>KTS/OB<br>(Inisial Auditor)</th>
                        <th>Referensi<br>(Butir Mutu)</th>
                        <th>Temuan Audit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($pertanyaan_ as $temuan)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ $temuan->Kategori }}<br>({{ $temuan->inisialAuditor }})</td>
                        <td class="text-center">{{ $temuan->nomorButir }}</td>
                        <td>{{ $temuan->narasiPLOR }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tablekesesuaian mb-5">
            <p><b>B. Peluang Peningkatan</b></p>
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Aspek/Bidang</th>
                        <th>Kelebihan</th>
                        <th>Peluang untuk Peningkatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($pelpeningkatan_ as $pelpeningkatan)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $pelpeningkatan->aspek }}</td>
                        <td>{{ $pelpeningkatan->kelebihan }}</td>
                        <td>{{ $pelpeningkatan->peningkatan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p>3. Auditee menyetujui hasil evaluasi efektivitas tinjad lanjut AMI 
            @foreach ($jadwalAudit_->unique('th_ajaran1', 'th_ajaran2') as $jadwal)
                @if ($jadwal->th_ajaran1 == $jadwal->hari_tgl->isoFormat('Y') || $jadwal->th_ajaran2 == $jadwal->hari_tgl->isoFormat('Y'))
                {{ $jadwal->th_ajaran1 }}
                @endif
            @endforeach
            yang dilaporkan dalam
            @foreach ($dokumenpendukung_ as $dokumenpendukung)
                {{ $dokumenpendukung->namaDokumen }} {{ '('.$dokumenpendukung->kodeDokumen.')' }}, 
            @endforeach
            .
        </p>
    </div>
    <div id="ttdpersetujuan" class="ttdpersetujuan my-3 mx-4 py-2">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td colspan="2" class="text-center">Menyetujui,</td>
                </tr>
                <tr>
                    <td class="w-50 text-center">Auditee,</td>
                    <td class="w-50 text-center">Auditor,</td>
                </tr>
                <tr>
                    <td class="w-50 text-center">eSignAuditee</td>
                    <td class="w-50 text-center">eSignAuditor</td>
                </tr>
                <tr>
                    <td class="w-50 text-center"> 
                    @foreach ($auditee_ as $auditee)
                        {{ '('.$auditee->ketua_auditee.')' }}
                    @endforeach
                    </td>
                    <td class="w-50 text-center"> 
                        @foreach ($auditee_ as $auditee)
                            {{ '('.$auditee->ketua_auditor.')' }}
                        @endforeach
                        </td>
                </tr>
            </tbody>
        </table>
        {{-- <div class="row d-flex justify-content-around text-center">
            <div class="col-5">Menyetujui,</div>
            <div class="col-5"></div>
        </div>
        <div class="row d-flex justify-content-around text-center">
            <div class="col-5 auditee">Auditee,</div>
            <div class="col-5 auditor">Auditor,</div>
        </div>
        <div class="row d-flex justify-content-around text-center">
            <div class="col-5 eSignAuditee"></div>
            <div class="col-5 eSignAuditor"></div>
        </div>
        <div class="row d-flex justify-content-around text-center">
            <div class="col-5 namaAuditee">
                @foreach ($auditee_ as $auditee)
                    {{ '('.$auditee->ketua_auditee.')' }}
                @endforeach
            </div>
            <div class="col-5 namaAuditor">
                @foreach ($auditee_ as $auditee)
                    {{ '('.$auditee->ketua_auditor.')' }}
                @endforeach
            </div>
        </div> --}}
    </div>
</div>
@endsection

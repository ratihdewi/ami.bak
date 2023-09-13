<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('bootstrap.min.css') }}">
    <title>Table</title>
    <style>
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 18px;
            letter-spacing: 0.5px;
        }

        table {
            display: table;
        }

        /* tfoot {
            display: table-row-group;
        }

        tr {
            page-break-inside: auto;
        } */
    </style>
</head>
<body>
    <div class="container-pratinjau mx-4 my-5">
        <div id="dokheader" class="dokheader my-3 mx-4 py-2">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="d-flex justify-content-center py-4 text-center">
                            <img src="{{ public_path('asset/Logo-Up.png') }}" alt="logo-uper" width="120">
                        </td>
                        <td colspan="4" class="infouper px-4 py-2">
                            <h4 class="my-3"><b>UNIVERSITAS PERTAMINA</b></h4>
                            <p class="my-3">
                                Jalan Teuku Nyak Arief, Simprug, <br>
                                Kebayoran Lama, Jakarta Selatan, 12220 <br>
                                Telp. (021) 29044308
                            </p>
                        </td>
                    </tr>
                    @if (count($ba_ami->get()) > 0)
                        @foreach ($ba_ami->get() as $ba)
                        <tr class="fw-bold">
                            <td rowspan="2" class="text-center align-middle">FORMULIR</td>
                            <td>KODE</td>
                            <td>{{ $ba->kodeDokumen }}</td>
                            <td>TGL. BERLAKU</td>
                            @if ($ba->tgl_berlaku != null)
                                <td>{{ $ba->tgl_berlaku->isoFormat('D MMMM YYYY') }}</td>
                            @else
                                <td>{{ $ba->tgl_berlaku }}</td>
                            @endif
                            
                        </tr>
                        <tr class="fw-bold">
                            <td>REVISI KE-</td>
                            <td>{{ $ba->revisiKe }}</td>
                            <td>TGL. REVISI</td>
                            @if ($ba->tgl_revisi != null)
                                <td>{{ $ba->tgl_revisi->isoFormat('D MMMM YYYY') }}</td>
                            @else
                                <td>{{ $ba->tgl_revisi }}</td>
                            @endif
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="5" class="text-center">{{ $ba->judulDokumen }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="fw-bold">
                            <td rowspan="2" class="text-center align-middle col-2">FORMULIR</td>
                            <td class="col-md-2">KODE</td>
                            <td class="col-md-2"></td>
                            <td class="col-md-2">TGL. BERLAKU</td>
                            <td class="col-md-2"></td>
                        </tr>
                        <tr class="fw-bold">
                            <td>REVISI KE-</td>
                            <td></td>
                            <td>TGL. REVISI</td>
                            <td></td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="5" class="text-center opacity-50">(Judul Dokumen)</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div id="infoBA" class="infoBA mx-4">
            <table class="table table-borderless px-5" style="border-color: white;">
                <tbody>
                    <tr>
                        <td rowspan="3" class="w-50">Fungsi : 
                            @foreach ($jadwalAudit_->unique('auditee_id') as $jadwal)
                            {{ $jadwal->auditee->unit_kerja }}
                            @endforeach
                        </td>
                        <td class="w-50">Hari/Tanggal : 
                            <?php $i=1; ?>
                            @foreach ($jadwalAudit_ as $jadwal)
                                @if (count($jadwalAudit_) == 1)
                                    {{ $jadwal->hari_tgl->isoFormat('dddd/ D MMMM YYYY') }}
                                @elseif (count($jadwalAudit_) > 1 && count($jadwalAudit_) != 1)
                                    @if ($i < count($jadwalAudit_) && $i != count($jadwalAudit_))
                                        {{ $jadwal->hari_tgl->isoFormat('dddd/ D MMMM YYYY') }},
                                    @elseif ($i == count($jadwalAudit_))
                                        {{ $jadwal->hari_tgl->isoFormat('dddd/ D MMMM YYYY') }}
                                    @endif
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Waktu : 
                            <?php $i=1; ?>
                            @foreach ($jadwalAudit_ as $jadwal)
                                @if (count($jadwalAudit_) == 1)
                                    {{ $jadwal->waktu->isoFormat('HH:mm') }} WIB
                                @elseif (count($jadwalAudit_) > 1 && count($jadwalAudit_) != 1)
                                    @if ($i < count($jadwalAudit_) && $i != count($jadwalAudit_))
                                        {{ $jadwal->waktu->isoFormat('HH:mm') }} WIB,
                                    @elseif ($i == count($jadwalAudit_))
                                    {{ $jadwal->waktu->isoFormat('HH:mm') }} WIB
                                    @endif
                                @endif
                                <?php $i++; ?>
                            @endforeach 
                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">Media : 
                            <?php $i=1; ?>
                            @foreach ($jadwalAudit_ as $jadwal)
                                @if (count($jadwalAudit_) == 1)
                                    {{ $jadwal->tempat }}
                                @elseif (count($jadwalAudit_) > 1 && count($jadwalAudit_) != 1)
                                    @if ($i < count($jadwalAudit_) && $i != count($jadwalAudit_))
                                        {{ $jadwal->tempat }},
                                    @elseif ($i == count($jadwalAudit_))
                                        {{ $jadwal->tempat }}
                                    @endif
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
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
                <table class="table table-bordered w-75">
                    <thead>
                        <tr class="text-center">
                            <th colspan="2">Nama</th>
                            <th>Tanda Tangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; $j=0 ?>
                        @foreach ($daftarhadir_ as $daftarhadir)
                        @if ($daftarhadir->posisi == 'Ketua Auditor' || $daftarhadir->posisi == 'Anggota Auditor')
                        <tr>
                            <td rowspan>{{ $daftarhadir->posisi }}</td>
                            <td>{{ $daftarhadir->namapeserta }}</td>
                            <td class="text-center">{{ $eSignAuditor[$i] }}</td>
                            
                        </tr>
                        <?php $i++; ?>
                        @elseif ($daftarhadir->posisi == 'Ketua Auditee' || $daftarhadir->posisi == 'Anggota Auditee')
                        <tr>
                            <td rowspan>{{ $daftarhadir->posisi }}</td>
                            <td>{{ $daftarhadir->namapeserta }}</td>
                            <td class="text-center">{{ $eSignAuditee[$j] }}</td>
                        </tr>
                        <?php $j++; ?>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p>2. Temuan dan Ketidaksesuaian:</p>
            <div class="tabletemuan mb-4">
                <p class="ms-3"><b>A. Temuan Audit</b></p>
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
                            <td>{{ $temuan->nomorButir }}</td>
                            <td>{{ $temuan->narasiPLOR }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tablekesesuaian mb-5">
                <p class="ms-3"><b>B. Peluang Peningkatan</b></p>
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
                            <td>{!! $pelpeningkatan->kelebihan !!}</td>
                            <td>{!! $pelpeningkatan->peningkatan !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="lh-base">3. Auditee menyetujui hasil evaluasi efektivitas tindak lanjut AMI 
                @foreach ($jadwalAudit_->unique('th_ajaran1', 'th_ajaran2') as $jadwal)
                    @if ($jadwal->th_ajaran1 == $jadwal->hari_tgl->isoFormat('Y') || $jadwal->th_ajaran2 == $jadwal->hari_tgl->isoFormat('Y'))
                    {{ $jadwal->th_ajaran1 }}
                    @endif
                @endforeach
                yang dilaporkan dalam
                <?php $i=1; ?>
                @foreach ($dokumenpendukung_ as $dokumenpendukung)
                    @if (count($dokumenpendukung_) == 1)
                        {{ $dokumenpendukung->namaDokumen }} {{ '('.$dokumenpendukung->kodeDokumen.')' }}.
                    @elseif (count($dokumenpendukung_) > 1 && count($dokumenpendukung_) != 1)
                        @if ($i < count($dokumenpendukung_) && $i != count($dokumenpendukung_))
                            {{ $dokumenpendukung->namaDokumen }} {{ '('.$dokumenpendukung->kodeDokumen.')' }},
                        @elseif ($i == count($dokumenpendukung_))
                            {{ $dokumenpendukung->namaDokumen }} {{ '('.$dokumenpendukung->kodeDokumen.')' }}.
                        @endif
                    @endif
                    <?php $i++; ?>
                @endforeach
                
            </p>
        </div>

        <div id="ttdpersetujuan" class="ttdpersetujuan my-3 mx-4 py-2">
            <table class="table table-borderless" style="border-color: white;">
                <tbody>
                    <tr>
                        <td class="text-center border-0">Menyetujui,</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="w-50 text-center">Auditee,</td>
                        <td class="w-50 text-center">Auditor,</td>
                    </tr>
                    <tr>
                        <td class="w-50 text-center">
                            @foreach ($ba_ami->get() as $ba)
                            @if ($ba->eSignAuditee == "Disetujui")
                            {{ $qrCodeAuditee }}
                            @endif
                            @endforeach
                        </td>
                        <td class="w-50 text-center">
                            @foreach ($ba_ami->get() as $ba)
                            @if ($ba->eSignAuditor == "Disetujui")
                            {{ $qrCodeAuditor }}
                            @endif
                            @endforeach
                        </td>
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
        </div>
    </div>
</body>
</html>
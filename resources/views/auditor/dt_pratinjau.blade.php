@extends('auditor.main_') 
@section('title') AMI - Temuan Berita Acara @endsection

@section('linking')
    <a href="/auditor-daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    @foreach ($daftartilik_ as $daftartilik)
    <a href="/auditor-daftartilik/{{ $daftartilik->auditee->tahunperiode }}" class="mx-1">
    @endforeach
    @foreach ($daftartilik_ as $daftartilik)
    {{ $daftartilik->auditee->tahunperiode0 }}/{{ $daftartilik->auditee->tahunperiode }}
    </a>/
    @endforeach
    
    @foreach ($daftartilik_ as $daftartilik)
    <a href="/auditor-daftarTilik-areadaftartilik/{{ $daftartilik->auditee_id }}/{{ $daftartilik->area }}" class="mx-1">
    @endforeach
    @foreach ($daftartilik_ as $daftartilik)
    {{ $daftartilik->area }}
    </a>/
    @endforeach

    @foreach ($daftartilik_ as $daftartilik)
    <a href="/auditor-daftartilik-pratinjaudaftartilik/{{ $daftartilik->auditee_id }}/{{ $daftartilik->area }}" class="mx-1">
    @endforeach
    Pratinjau
    </a>/  

@endsection

@section('container')
  <div class="container vh-100 mb-4">
      <div id="headerPratinjau" class="headerpratinjau my-4 mx-2">
        <div class="row">
            <div class="col-3 label py-2 fw-semibold text-start">Auditee</div>
            <div class="col-9 py-2 text-start">:
                @foreach ($daftartilik_ as $daftartilik)
                {{ $daftartilik->auditee->unit_kerja }}
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-3 label py-2 fw-semibold text-start">Auditor</div>
            <div class="col-9 py-2 text-start">:
                @foreach ($daftartilik_ as $daftartilik)
                {{ $daftartilik->auditor->nama }}
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-3 label py-2 fw-semibold text-start">Hari/Tanggal</div>
            <div class="col-9 py-2 text-start">:
                @foreach ($daftartilik_ as $daftartilik)
                {{ $daftartilik->tgl_pelaksanaan->translatedFormat('l, d M Y') }}
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-3 label py-2 fw-semibold text-start">Waktu</div>
            <div class="col-9 py-2 text-start">:
                @foreach ($jadwal_ as $jadwal)
                {{ $jadwal->waktu->format('H:i') }} WIB, 
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-3 label py-2 fw-semibold text-start">Area</div>
            <div class="col-9 py-2 text-start">:
                @foreach ($daftartilik_ as $daftartilik)
                {{ $daftartilik->area }}
                @endforeach
            </div>
        </div>
      </div>
      <div class="buttongrup d-flex justify-content-end">
        <div class="btn-group btn-group-sm my-3" role="group" aria-label="Basic outlined example">
            <button type="button" class="btn btn-outline-success">.xlsx</button>
            @foreach ($daftartilik_ as $daftartilik)
            <a href="/daftartilik-exportdaftartilik/{{ $daftartilik->id }}/{{ $daftartilik->auditee_id }}">
            @endforeach
            <button type="button" class="btn btn-success px-3" style="border-top-left-radius: 0; border-bottom-left-radius: 0">Unduh</button>
            </a>
          </div>
      </div>
      <div class="table-container" style="overflow-x:auto">
        <table class="table table-bordered" style="width: 150%; ">
            <thead class="table-secondary">
                <tr>
                    <th rowspan="2" class="text-center">No</th>
                    <th rowspan="2" class="text-center">Butir Standar</th>
                    <th rowspan="2" class="text-center" style="width: 20%;">Pertanyaan</th>
                    <th rowspan="2" class="text-center" style="width: 20%;">Indikator Mutu</th>
                    <th rowspan="2" class="text-center">Target Standar</th>
                    <th rowspan="2" class="text-center">Referensi</th>
                    <th rowspan="2" class="text-center">Inisial Auditor</th>
                    <th colspan="2" class="text-center">Respon</th>
                    <th rowspan="2" class="text-center">Skor Auditor</th>
                </tr>
                <tr>
                    <th class="text-center" style="width: 10%;">Auditee</th>
                    <th class="text-center" style="width: 10%;">Auditor</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($pertanyaan_ as $pertanyaan)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $pertanyaan->butirStandar }}</td>
                    <td class="text-start" style="width: 20%;">{!! $pertanyaan->pertanyaan !!}</td>
                    <td class="text-start" style="width: 20%;">{!! $pertanyaan->indikatormutu !!}</td>
                    <td class="text-center">{{ $pertanyaan->targetStandar }}</td>
                    <td class="text-center">{{ $pertanyaan->referensi }}</td>
                    <td class="text-center">{{ $pertanyaan->inisialAuditor }}</td>
                    <td class="text-start" style="width: 10%;">{{ $pertanyaan->responAuditee }}</td>
                    <td class="text-start" style="width: 10%;">{{ $pertanyaan->responAuditor }}</td>
                    <td class="text-center">{{ $pertanyaan->skorAuditor }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div class="button d-flex justify-content-end">
        @foreach ($daftartilik_ as $daftartilik)
        <a href="/auditor-daftarTilik-areadaftartilik/{{ $daftartilik->auditee_id }}/{{ $daftartilik->area }}" class="mx-1">
        @endforeach
        <button type="button" class="btn btn-outline-secondary">Kembali</button>
        </a>
      </div>
  </div>
@endsection
@extends('layout.main') @section('title') AMI - Temuan Berita Acara @endsection
@section('container')
  <div class="container mb-4">
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
            <button type="button" class="btn btn-success px-3">Unduh</button>
          </div>
      </div>
      <div class="table-container" style="overflow-x:auto">
        <table class="table table-bordered" style="width: 200%; ">
            <thead class="table-secondary">
                <tr>
                    <th rowspan="2" class="text-center">No</th>
                    <th rowspan="2" class="text-center">Butir Standar</th>
                    <th rowspan="2" class="text-center">Pertanyaan</th>
                    <th rowspan="2" class="text-center">Indikator Mutu</th>
                    <th rowspan="2" class="text-center">Target Standar</th>
                    <th rowspan="2" class="text-center">Referensi</th>
                    <th rowspan="2" class="text-center">Inisial Auditor</th>
                    <th colspan="2" class="text-center">Respon</th>
                    <th rowspan="2" class="text-center">Skor Auditor</th>
                </tr>
                <tr>
                    <th class="text-center">Auditee</th>
                    <th class="text-center">Auditor</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($pertanyaan_ as $pertanyaan)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $pertanyaan->butirStandar }}</td>
                    <td class="text-start">{{ $pertanyaan->pertanyaan }}</td>
                    <td class="text-center">{{ $pertanyaan->indikatormutu }}</td>
                    <td class="text-center">{{ $pertanyaan->targetStandar }}</td>
                    <td class="text-center">{{ $pertanyaan->referensi }}</td>
                    <td class="text-center">{{ $pertanyaan->inisialAuditor }}</td>
                    <td class="text-start">{{ $pertanyaan->responAuditee }}</td>
                    <td class="text-start">{{ $pertanyaan->responAuditor }}</td>
                    <td class="text-center">{{ $pertanyaan->skorAuditor }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
  </div>
@endsection
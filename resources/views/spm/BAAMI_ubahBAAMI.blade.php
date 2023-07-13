@extends('layout.main') 
@section('title') AMI - Temuan Berita Acara @endsection

@section('container')

    <div class="container my-5">
        @foreach ($beritaacara_ as $ba)
        <form action="/BA-AMI-updatedataberitaacaraAMI/{{ $ba->auditee_id }}" method="post">
        @endforeach
            @csrf
        {{-- Berita Acara AMI --}}
            <div class="row sectionName mx-0 mb-5 mt-5">
                <div class="col border rounded-top text-center py-2 fw-semibold">Berita Acara AMI</div>  
            </div>
            <div class="row inputBA my-4 mx-5">
                <div class="col-12 mb-4">
                <label for="inputUnitKerja" class="form-label fw-semibold">Unit Kerja</label>
                <input type="text" class="form-control" id="inputUnitKerja" placeholder="Masukkan unit kerja yang akan dibuat">
                </div>
                <div class="col-6 mb-4">
                <label for="inputHariTgl" class="form-label fw-semibold">Hari/Tanggal Pelaksanaan</label>
                <input type="date" class="form-control" id="inputHariTgl" placeholder="Masukkan Hari/Tanggal Pelaksanaan yang akan dibuat">
                </div>
                <div class="col-6 mb-4">
                <label for="inputWaktu" class="form-label fw-semibold">Waktu</label>
                <input type="time" class="form-control" id="inputWaktu" placeholder="Masukkan waktu pelaksanaan">
                </div>
                <div class="col-6 mb-4">
                <label for="inputThnAjaran" class="form-label fw-semibold">Tahun Ajaran</label>
                <input type="text" class="form-control" id="inputThnAjaran" placeholder="Masukkan Tahun Ajaran dokumen">
                </div>
                <div class="col-6 mb-4">
                <label for="inputMedia" class="form-label fw-semibold">Media</label>
                <input type="text" class="form-control" id="inputMedia" placeholder="Masukkan Media dokumen">
                </div>
            </div>
            {{-- Simpan Perubahan --}}
            <div class="simpanBA d-grid gap-2">
                <button class="btn btn-success" type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

@endsection
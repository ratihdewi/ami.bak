@extends('layout.main') 
@section('title') AMI - Temuan Berita Acara @endsection

@section('container')
    <div class="row my-3 mx-4">
        <a href="/BA-AMI/{{ $ba_->auditee_id }}/{{ $ba_->tahunperiode }}"><button class="btn btn-primary btn-sm" type="button">Kembali</button></a>
    </div>
        
    <div class="container mt-3 mb-5">
        @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3 mx-4" role="alert">
            {{ $message }}
        </div>
        @endif
        <form action="/BA-AMI-updatedataBAAMI/{{ $dokBA_->id }}" method="post">
            @csrf
            <div class="row sectionName mx-4 mb-5">
                <div class="col border rounded-top text-center py-2 fw-semibold">Data Dokumen AMI</div>  
            </div>
            
            <div class="row inputDataBA my-4 mx-5">
                    <div class="col-6 mb-4" hidden>
                        <label for="beritaacara_id" class="form-label fw-semibold">ID Berita Acara</label>
                        <input type="text" class="form-control" id="beritaacara_id" placeholder="Masukkan kode dokumen yang akan dibuat" name="beritaacara_id" value="{{ $dokBA_->beritaacara_id }}">
                    </div>
                    <div class="col-6 mb-4" hidden>
                        <label for="auditee_id" class="form-label fw-semibold">ID Auditee</label>
                        <input type="text" class="form-control" id="auditee_id" placeholder="Masukkan kode dokumen yang akan dibuat" name="auditee_id" value="{{ $dokBA_->auditee_id }}">
                    </div>
                <div class="col-12 mb-4">
                    <label for="inputJudul" class="form-label fw-semibold">Judul Dokumen</label>
                    <input type="text" class="form-control" id="inputJudul" placeholder="Masukkan judul dokumen yang akan dibuat" name="judulDokumen" value="{{ $dokBA_->judulDokumen }}">
                </div>
                <div class="col-6 mb-4">
                    <label for="inputKode" class="form-label fw-semibold">Kode Dokumen</label>
                    <input type="text" class="form-control" id="inputKode" placeholder="Masukkan kode dokumen yang akan dibuat" name="kodeDokumen" value="{{ $dokBA_->kodeDokumen }}">
                </div>
                <div class="col-6 mb-4">
                    <label for="inputInfoRevisi" class="form-label fw-semibold">Revisi Ke-</label>
                    <input type="text" class="form-control" id="inputInfoRevisi" placeholder="Masukkan revisi ke berapa" name="revisiKe" value="{{ $dokBA_->revisiKe }}">
                </div>
                <div class="col-6 mb-4">
                    <label for="inputTglRevisi" class="form-label fw-semibold">Tanggal Revisi</label>
                    <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" aria-label="Masukkan tanggal revisi" class="form-control" id="inputTglRevisi" placeholder="Masukkan tanggal revisi dokumen" name="tgl_revisi" value="{{ $dokBA_->tgl_revisi->translatedFormat('Y-m-d') }}">
                </div>
                <div class="col-6 mb-4">
                    <label for="inputTglBerlaku" class="form-label fw-semibold">Tanggal Berlaku</label>
                    <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" id="inputTglBerlaku" placeholder="Masukkan tanggal berlaku dokumen" name="tgl_berlaku" value="{{ $dokBA_->tgl_berlaku->translatedFormat('Y-m-d') }}">
                </div>
            </div>
            {{-- Simpan Perubahan --}}
            <div class="simpanBA d-grid gap-2">
                <button class="btn btn-success" type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

@endsection
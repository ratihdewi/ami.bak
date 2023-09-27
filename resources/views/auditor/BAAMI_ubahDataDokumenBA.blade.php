@extends('auditor.main_') 

@section('title') AMI - Data Dokumen Berita Acara @endsection

@section('linking')
    <a href="auditor-beritaacara" class="mx-1">
        Berita Acara
    </a>/

    <a href="/auditor-auditeeBA/{{ $ba_->auditee_id }}/{{ $ba_->tahunperiode }}" class="mx-1">
    {{ $ba_->auditee->unit_kerja }}
    </a>/

    <a href="/auditor-BA-AMI/{{ $ba_->auditee_id }}/{{ $ba_->tahunperiode }}" class="mx-1">
    BA - AMI
    </a>/

    <a href="/auditor-BA-ubahdataDokumenBAAMI/{{ $ba_->auditee_id }}/{{ $ba_->tahunperiode }}" class="mx-1">
    Data Dokumen AMI
    </a>/
    
@endsection

@section('container')
    <div class="container vh-100 my-5">
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
                    <label for="inputJudul" class="form-label fw-semibold">Judul Dokumen <span class="text-danger fw-bold">*</span></label>
                    <input type="text" class="form-control" id="inputJudul" placeholder="Masukkan judul dokumen yang akan dibuat" name="judulDokumen" value="{{ $dokBA_->judulDokumen }}">
                </div>
                <div class="col-6 mb-4">
                    <label for="inputKode" class="form-label fw-semibold">Kode Dokumen <span class="text-danger fw-bold">*</span></label>
                    <input type="text" class="form-control" id="inputKode" placeholder="Masukkan kode dokumen yang akan dibuat" name="kodeDokumen" value="{{ $dokBA_->kodeDokumen }}">
                </div>
                <div class="col-6 mb-4">
                    <label for="inputInfoRevisi" class="form-label fw-semibold">Revisi Ke- <span class="text-danger fw-bold">*</span></label>
                    <input type="text" class="form-control" id="inputInfoRevisi" placeholder="Masukkan revisi ke berapa" name="revisiKe" value="{{ $dokBA_->revisiKe }}">
                </div>
                <div class="col-6 mb-4">
                    <label for="inputTglRevisi" class="form-label fw-semibold">Tanggal Revisi <span class="text-danger fw-bold">*</span></label>
                    <input type="text" 
                    {{-- onfocus="(this.type='date')" onblur="(this.type='text')"  --}}
                    aria-label="Masukkan Hari/Tanggal Pelaksanaan" class="form-control" id="inputTglRevisi" placeholder="Masukkan tanggal revisi dokumen" name="tgl_revisi" value="{{ $dokBA_->tgl_revisi->translatedFormat('Y-m-d') }}">
                </div>
                <div class="col-6 mb-4">
                    <label for="inputTglBerlaku" class="form-label fw-semibold">Tanggal Berlaku <span class="text-danger fw-bold">*</span></label>
                    <input type="text" 
                    {{-- onfocus="(this.type='date')" onblur="(this.type='text')"  --}}
                    class="form-control" id="inputTglBerlaku" placeholder="Masukkan tanggal berlaku dokumen" name="tgl_berlaku" value="{{ $dokBA_->tgl_berlaku->translatedFormat('Y-m-d') }}">
                </div>
            </div>
            {{-- Simpan Perubahan --}}
            <div class="simpanBA d-flex justify-content-end mx-5">
                <a href="/auditor-BA-AMI/{{ $ba_->auditee_id }}/{{ $ba_->tahunperiode }}"><button class="btn btn-secondary me-md-2" type="button">Kembali</button></a>
                <button class="btn btn-success" type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.id.min.js" integrity="sha512-5dCXH+uVhgMJkIOoV1tEejq2voWTEqqh2Q2+Caz6//+6i9dLpfyDmAzKcdbogrXjPLanlDO5pTsBDKzmaJcWFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/id.js"></script>
    <script>
        $(document).ready(function() {
            flatpickr("#inputTglRevisi", {
                dateFormat: "d-m-Y", // Sesuaikan dengan format yang Anda inginkan
                locale: "id",
                enableTime: false, // Jangan aktifkan waktu
                // time_24hr: true, // Gunakan format 24 jam
                timeZone: "Asia/Jakarta",
            });

            flatpickr("#inputTglBerlaku", {
                dateFormat: "d-m-Y", // Sesuaikan dengan format yang Anda inginkan
                locale: "id",
                enableTime: false, // Jangan aktifkan waktu
                // time_24hr: true, // Gunakan format 24 jam
                timeZone: "Asia/Jakarta",
            });
        })
    </script>
@endpush
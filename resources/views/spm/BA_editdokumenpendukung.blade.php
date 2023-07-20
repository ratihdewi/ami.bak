@extends('layout.main') @section('title') AMI - Temuan Berita Acara @endsection
@section('container')
  <div class="container mb-4">
      <div class="topSection d-flex justify-content-around mx-2 mt-4">
          @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
              {{ $message }}
          </div>
          @endif
      </div>

      {{-- Start Form BA AMI --}}
      <form action="/BA-storedokumenpendukung/{{ $beritaacara_->auditee_id }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Dokumen Pendukung --}}
        <div class="row sectionName mx-0 m-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Dokumen Pendukung</div>  
        </div>
        <div class="row inputDokPendukung my-4 mx-5">
          <div class="col mb-4" hidden>
            {{-- @foreach ($dokumenpendukung_ as $dokumen) --}}
            <label for="auditee_id" class="form-label fw-semibold">ID Auditee</label>
            <input type="text" class="form-control" id="auditee_id" placeholder="ID Auditee" name="auditee_id" value="{{ $dokumenpendukung_->auditee_id }}">
            {{-- @endforeach --}}
          </div>
          <div class="col mb-4">
            {{-- @foreach ($dokumenpendukung_ as $dokumen) --}}
            <label for="inputKodeDokumen" class="form-label fw-semibold">Kode Dokumen</label>
            <input type="text" class="form-control" id="inputKodeDokumen" placeholder="Masukkan Kode Dokumen Pendukung" name="kodeDokumen" value="{{ $dokumenpendukung_->kodeDokumen }}">
            {{-- @endforeach --}}
          </div>
          <div class="col mb-4">
            {{-- @foreach ($dokumenpendukung_ as $dokumen) --}}
            <label for="inputNamaDokumen" class="form-label fw-semibold">Nama Dokumen</label>
            <input type="text" class="form-control" id="inputNamaDokumen" placeholder="Masukkan Nama Dokumen Pendukung" name="namaDokumen" value="{{ $dokumenpendukung_->namaDokumen }}">
            {{-- @endforeach --}}
          </div>
          <div class="col mb-4">
            {{-- @foreach ($dokumenpendukung_ as $dokumen) --}}
            <label for="dokumen" class="form-label fw-semibold">Upload Dokumen</label>
            <input class="form-control" type="file" id="dokumen" placeholder="Opsional" multiple name="dokumen" value="{{ $dokumenpendukung_->kodeDokumen }}">
            {{-- @endforeach --}}
          </div>
        </div>

        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-grid gap-2">
          <button class="btn btn-success" type="submit">Simpan Perubahan</button>
        </div>
      </form>
  </div>
@endsection

{{-- @push('script')
  <script>
    $(document).ready(function(){
      var max_fields = 50;
      var wrapper = $(".inputAbsen");
      var add_btn = $(".moreItems_add");
      var i = 1;
      $(add_btn).click(function(e){
        e.preventDefault();
        if (i < max_fields) {
          i++;

          $(wrapper).append('<div class="row inputAbsen my-4"><div class="col-4 mb-4 me-2"><label for="inputPosisi" class="form-label">Auditor/Auditee:</label><select id="inputPosisi" class="form-select"><option selected disabled>Pilih Auditor/Auditee</option><option value="Auditor">Auditor</option><option value="Auditee">Auditee</option></select></div><div class="col-7 mb-4"><label for="inputAbsenNama" class="form-label fw-semibold">Nama</label><input type="text" class="form-control" id="inputAbsenNama" placeholder="Masukkan nama peserta BA"></div></div>')
        }
      });
    });
  </script>
@endpush --}}
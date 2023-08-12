@extends('auditor.main_') @section('title') AMI - BA-AMI - Dokumen Pendukung @endsection

@section('linking')
    <a href="/auditor-beritaacara" class="mx-1">
        Berita Acara
    </a>/

    <a href="/auditor-auditeeBA/{{ $beritaacara_->auditee_id }}/{{ $beritaacara_->tahunperiode }}" class="mx-1">
    {{ $beritaacara_->auditee->unit_kerja }}
    </a>/

    <a href="/auditor-BA-AMI/{{ $beritaacara_->auditee_id }}/{{ $beritaacara_->tahunperiode }}" class="mx-1">
    BA - AMI
    </a>/

    <a href="/auditor-BA-dokumenpendukung/{{ $beritaacara_->auditee_id }}" class="mx-1">
    Dokumen Pendukung
    </a>/
    
@endsection

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
            <label for="auditee_id" class="form-label fw-semibold">ID Auditee</label>
            <input type="text" class="form-control" id="auditee_id" placeholder="ID Auditee" name="auditee_id" value="{{ $beritaacara_->auditee_id }}">
          </div>
          <div class="col mb-4">
            <label for="inputKodeDokumen" class="form-label fw-semibold">Kode Dokumen</label>
            <input type="text" class="form-control" id="inputKodeDokumen" placeholder="Masukkan Kode Dokumen Pendukung" name="kodeDokumen">
          </div>
          <div class="col mb-4">
            <label for="inputNamaDokumen" class="form-label fw-semibold">Nama Dokumen</label>
            <input type="text" class="form-control" id="inputNamaDokumen" placeholder="Masukkan Nama Dokumen Pendukung" name="namaDokumen">
          </div>
          <div class="col mb-4">
            <label for="dokumen" class="form-label fw-semibold">Upload Dokumen</label>
            <input class="form-control" type="file" id="dokumen" placeholder="Opsional" multiple name="dokumen">
          </div>
        </div>

        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-flex justify-content-end mx-5">
          <a href="/auditor-BA-AMI/{{ $beritaacara_->auditee_id }}/{{ $beritaacara_->tahunperiode }}">
            <button class="btn btn-secondary me-md-2" type="button">Kembali</button></a>
          <button class="btn btn-success" type="submit">Simpan Perubahan</button>
        </div>
      </form>
      <div class="listDokPendukung px-3 my-5">
        <table class="table table-hover">
          <thead style="background-color: #bfe9df; border: 2px solid #75c8be;">
              <tr class="">
                  <th class="col-1 text-center">No</th>
                  <th class="col-2 text-center">Kode Dokumen</th>
                  <th class="col-3 text-center">Nama Dokumen</th>
                  <th class="col-2 text-center">Aksi</th>
              </tr>
          </thead>
          <tbody>
              @php $no = 1; @endphp
              @foreach ($dokumenpendukung_ as $dokumenpendukung)
              <tr>
                <td scope="row" class="text-center">{{ $no++ }}</td>
                <td class="col-2 text-center">{{ $dokumenpendukung->kodeDokumen }}</td>
                <td class="col-3 text-center">{{ $dokumenpendukung->namaDokumen }}</td>
                <td class="col-2 text-center">
                  <a href="/BA-deletedokumenpendukung/{{ $dokumenpendukung->id }}" class="mx-2" onclick="return confirm('Apakah Anda yakin akan menghapus dokumen {{ $dokumenpendukung->namaDokumen }} ?')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white"></i></button></a>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
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
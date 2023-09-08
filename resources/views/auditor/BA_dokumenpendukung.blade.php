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
  <div class="container vh-100 mb-4">
      <div class="topSection d-flex justify-content-around mx-2 mt-4 mb-4"></div>
      
      {{-- Start Form BA AMI --}}
      <form id="myForm" action="/BA-storedokumenpendukung/{{ $beritaacara_->auditee_id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
              {{ $message }}
          </div>
        @elseif ($message = Session::get('error'))
          <div class="alert alert-success" role="alert">
              {{ $message }}
          </div>
        @endif
        {{-- Dokumen Pendukung --}}
        <div class="row sectionName mx-2 m-2">
          <div class="col border rounded-top text-center py-2 fw-semibold">Dokumen Pendukung</div>  
        </div>
        <div class="row inputDokPendukung my-4 mx-5">
          <div class="col mb-4" hidden>
            <label for="auditee_id" class="form-label fw-semibold">ID Auditee</label>
            <input type="text" class="form-control" id="auditee_id" placeholder="ID Auditee" name="auditee_id" value="{{ $beritaacara_->auditee_id }}">
          </div>
          <div class="col mb-4">
            <label for="inputKodeDokumen" class="form-label fw-semibold">Kode Dokumen</label>
            <input type="text" class="form-control" id="inputKodeDokumen" placeholder="Masukkan Kode Dokumen Pendukung" name="kodeDokumen" required>
          </div>
          <div class="col mb-4">
            <label for="inputNamaDokumen" class="form-label fw-semibold">Nama Dokumen</label>
            <input type="text" class="form-control" id="inputNamaDokumen" placeholder="Masukkan Nama Dokumen Pendukung" name="namaDokumen" required>
          </div>
          <div class="col mb-4">
            <label for="dokumen" class="form-label fw-semibold">Upload Dokumen</label>
            <input class="form-control" type="file" id="dokumen" placeholder="Opsional" multiple name="dokumen" accept=".csv, .xlsx, .xls, .pdf, .docx" required>
            <p class="fw-light fst-italic">*.csv, .xlsx, .xls, .pdf, .docx (maks. 10MB)   <span id="error" style="color: red; font-weight: bold"></span></p>
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
                <td class="col-2">{{ $dokumenpendukung->kodeDokumen }}</td>
                <td class="col-3">{{ $dokumenpendukung->namaDokumen }}</td>
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

@push('script')
    <script>
      $('#myForm').on('submit', function(e) {
          var files = $('#dokumen')[0].files;

          for (let i = 0; i < files.length; i++) {
              var file = files[i];
              var fileSizeInMB = file.size / (1024 * 1024); // Konversi ke MB
              console.log("Dokumen sahih "  + i + " : " + fileSizeInMB);

              // Validasi ukuran file (misalnya, tidak lebih dari 5 MB)
              if (fileSizeInMB > 10) {
                  $('#error').text('Ukuran file terlalu besar.');
                  e.preventDefault(); // Mencegah submit formulir
                  return;
              }
          }
      });
    </script>
@endpush
@extends('layout.main') 

@section('title') AMI - Daftar Tilik - Foto Kegiatan @endsection

@section('linking')
    <a href="" class="mx-1">
        Foto Kegiatan
    </a>/

    <a href="/spm-editfotokegiatan/{{ $auditees->id }}/{{ $auditees->tahunperiode }}/{{ $pertanyaan_id }}" class="mx-1">
    {{ $auditees->unit_kerja }}
    </a>/
@endsection

@section('container')
  <div class="container vh-100 mb-4">
    <div class="topSection d-flex justify-content-around mx-2 mt-4 mb-4"></div>

      {{-- Start Form BA AMI --}}
      <form id="myForm" action="/storefotokegiatan" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @elseif ($message = Session::get('error'))
          <div class="alert alert-danger" role="alert">
              {{ $message }}
          </div>
        @endif
        {{-- Foto --}}
        <div class="row sectionName mx-0 m-2">
          <div class="col border rounded-top text-center py-2 fw-semibold">Foto Kegiatan Audit Lapangan - {{ $auditees->unit_kerja }} ({{ $auditees->tahunperiode0 }}/{{ $auditees->tahunperiode }})</div>  
        </div>
        <div class="row inputDokDokSahih my-4 mx-5">
            {{-- @foreach ($doksahihs as $doksahih) --}}
                <div class="col mb-4" hidden>
                    <label for="auditee_id" class="form-label fw-semibold">ID Auditee</label>
                    <input type="text" class="form-control" id="auditee_id" placeholder="ID Auditee" name="auditee_id" value="{{ $auditees->id }}">
                </div>
            {{-- @endforeach --}}
          <div class="col mb-4">
            <label for="inputnamaphoto" class="form-label fw-semibold">Nama File Foto</label>
            <input type="text" class="form-control" id="inputnamaphoto" placeholder="contoh: [nama foto] *tanpa tanda kurung siku" name="namaFile" required>
          </div>
          <div class="col mb-4">
            <label for="foto" class="form-label fw-semibold">Unggah Foto Kegiatan</label>
            <input class="form-control" type="file" id="foto" placeholder="Unggah Foto Kegiatan" multiple name="foto" accept=".jpg, .png, .jpeg" required>
            <p class="fw-light fst-italic">*.jpeg, .png, .jpg (maks. 2MB)   <span id="error" style="color: red; font-weight: bold"></span></p>
          </div>
        </div>

        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-flex justify-content-end">
          @if ($pertanyaan_id != null)
            <a href="/daftartilik-tampilpertanyaandaftartilik/{{ $pertanyaan_id }}"><button type="button" class="btn btn-secondary me-md-2">Kembali</button></a>
          @else
            <a href="/daftartilik-adddaftartilik/{{ $data->auditee_id }}/{{ $data->area }}"><button type="button" class="btn btn-secondary me-md-2">Kembali</button></a>
          @endif
          
          <button class="btn btn-success" type="submit">Simpan Perubahan</button>
        </div>
      </form>
      <div class="listDokPendukung px-3 my-5">
        <table class="table table-hover">
          <thead style="background-color: #bfe9df;">
              <tr class="">
                  <th class="col text-center">No</th>
                  <th class="col text-center">Nama Foto</th>
                  <th class="col text-center">Updated</th>
                  <th class="col text-center">Aksi</th>
              </tr>
          </thead>
          <tbody>
              @php $no = 1; @endphp
              @foreach ($fotokegiatans as $fotokegiatan)
              <tr>
                <td scope="row" class="text-center">{{ $no++ }}</td>
                <td class="col">{{ $fotokegiatan->namaFile }}</td>
                <td class="col text-center">{{ $fotokegiatan->updated_at }}</td>
                <td class="col text-center">
                  <a href="/lihatfotokegiatan/{{ $fotokegiatan->id }}" target="_blank"><button class="bg-warning border-0 rounded-1 me-3"><i class="bi bi-eye-fill" title="Buka"></i></button></i></a>
                  <a href="/deletefotokegiatan/{{ $fotokegiatan->id }}" onclick="return confirm('Apakah Anda yakin akan menghapus dokumen {{ $fotokegiatan->namaFile }} ?')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white" title="Hapus"></i></button></a>
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
      $(document).ready(function() {
        var pertanyaan = "{{ $pertanyaan_id }}"
        console.log(pertanyaan);
      });
    </script>
    <script>
      $('#myForm').on('submit', function(e) {
          var files = $('#foto')[0].files;

          for (let i = 0; i < files.length; i++) {
              var file = files[i];
              var fileSizeInMB = file.size / (1024 * 1024); // Konversi ke MB
              console.log("Photo "  + i + " : " + fileSizeInMB);

              // Validasi ukuran file (misalnya, tidak lebih dari 5 MB)
              if (fileSizeInMB > 2) {
                  $('#error').text('Ukuran file terlalu besar.');
                  e.preventDefault(); // Mencegah submit formulir
                  return;
              }
          }

          // Jika semua file sesuai, formulir akan disubmit
      });
    </script>
@endpush
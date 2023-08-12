@extends('layout.main') 

@section('title') AMI - Daftar Tilik - Foto Kegiatan @endsection

@section('linking')
    <a href="/beritaacara" class="mx-1">
        Berita Acara
    </a>/

    <a href="/auditeeBA/{{ $auditees->id }}/{{ $auditees->tahunperiode }}" class="mx-1">
    {{ $auditees->unit_kerja }}
    </a>/

    <a href="/spm-editfotokegiatan/{{ $auditees->id }}/{{ $auditees->tahunperiode }}" class="mx-1">
    Foto Kegiatan
    </a>/
    
@endsection

@section('container')
  <div class="container vh-100 mb-4">
      <div class="topSection d-flex justify-content-around mx-2 mt-4">
          @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
              {{ $message }}
          </div>
          @elseif ($message = Session::get('error'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
          @endif
      </div>

      {{-- Start Form BA AMI --}}
      <form action="/storefotokegiatan" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Dokumen Pendukung --}}
        <div class="row sectionName mx-0 m-5">
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
            <input type="text" class="form-control" id="inputnamaphoto" placeholder="contoh: [nama foto] *tanpa tanda kurung siku" name="namaFile">
          </div>
          <div class="col mb-4">
            <label for="foto" class="form-label fw-semibold">Unggah Foto Kegiatan</label>
            <input class="form-control" type="file" id="foto" placeholder="Unggah Foto Kegiatan" multiple name="foto">
            <p class="fw-light fst-italic">*.jpeg, .png, .jpg (maks. 2MB)</p>
          </div>
        </div>

        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-flex justify-content-end">
          <a href="/auditeeBA/{{ $auditees->id }}/{{ $auditees->tahunperiode }}"><button type="button" class="btn btn-secondary me-md-2">Kembali</button></a>
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
                  <a href="/lihatfotokegiatan/{{ $fotokegiatan->id }}" target="_blank"><button class="bg-warning border-0 rounded-1 me-3"><i class="bi bi-eye-fill"></i></button></i></a>
                  <a href="/deletefotokegiatan/{{ $fotokegiatan->id }}" onclick="return confirm('Apakah Anda yakin akan menghapus dokumen {{ $fotokegiatan->namaFile }} ?')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white"></i></button></a>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
  </div>
@endsection
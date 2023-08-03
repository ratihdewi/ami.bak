@extends('auditee.main_') 

@section('title') AMI - Daftar Tilik - DOkumen Bukti Sahih @endsection

@section('container')
  <div class="container mb-4">
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
      <form action="/storedokumensahih" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Dokumen Pendukung --}}
        <div class="row sectionName mx-0 m-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Dokumen Bukti Sahih</div>  
        </div>
        <div class="row inputDokDokSahih my-4 mx-5">
            {{-- @foreach ($doksahihs as $doksahih) --}}
                <div class="col mb-4" hidden>
                    <label for="pertanyaan_id" class="form-label fw-semibold">ID Pertanyaan</label>
                    <input type="text" class="form-control" id="pertanyaan_id" placeholder="ID Auditee" name="pertanyaan_id" value="{{ $pertanyaan->id }}">
                </div>
            {{-- @endforeach --}}
          <div class="col mb-4">
            <label for="inputNamaDokumen" class="form-label fw-semibold">Nama Dokumen</label>
            <input type="text" class="form-control" id="inputNamaDokumen" placeholder="contoh: [nama dokumen]_[Revisi 1] *tanpa tanda kurung siku" name="namaFile">
          </div>
          <div class="col mb-4">
            <label for="dokSahih" class="form-label fw-semibold">Unggah Dokumen Bukti Sahih</label>
            <input class="form-control" type="file" id="dokSahih" placeholder="Unggah Dokumen Bukti Sahih" multiple name="dokSahih">
            <p class="fw-light fst-italic">*.csv, .xlsx, .xls, .pdf, .docx (maks. 10MB)</p>
          </div>
        </div>

        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-grid gap-2">
          <button class="btn btn-success" type="submit">Simpan Perubahan</button>
        </div>
      </form>
      <div class="listDokPendukung px-3 my-5">
        <table class="table table-hover">
          <thead>
              <tr class="">
                  <th class="col text-center">No</th>
                  <th class="col text-center">Nama Dokumen</th>
                  <th class="col text-center">Updated</th>
                  <th class="col text-center">Aksi</th>
              </tr>
          </thead>
          <tbody>
              @php $no = 1; @endphp
              @foreach ($doksahihs as $doksahih)
              <tr>
                <td scope="row" class="text-center">{{ $no++ }}</td>
                <td class="col">{{ $doksahih->namaFile }}</td>
                <td class="col text-center">{{ $doksahih->updated_at }}</td>
                <td class="col text-center">
                  <a href="/lihatdokumensahih/{{ $doksahih->id }}" class="mx-2" target="_blank"><i class="bi bi-eye"></i></a>
                  <a href="/deletedokumensahih/{{ $doksahih->id }}" class="mx-2" onclick="return confirm('Apakah Anda yakin akan menghapus dokumen {{ $doksahih->namaFile }} ?')"><i class="bi bi-trash"></i></a>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
  </div>
@endsection
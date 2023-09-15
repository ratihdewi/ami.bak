@extends('auditor.main_') 

@section('title') AMI - Daftar Tilik - DOkumen Bukti Sahih @endsection

@section('linking')
    <a href="/auditor-daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    <a href="/auditor-daftartilik/{{ $pertanyaan->auditee->tahunperiode }}" class="mx-1">
    {{ $pertanyaan->auditee->tahunperiode0 }}/{{ $pertanyaan->auditee->tahunperiode }}
    </a>/
    
    <a href="/auditor-daftarTilik-areadaftartilik/{{ $pertanyaan->auditee_id }}/{{ $pertanyaan->daftartilik->area }}" class="mx-1">
    {{ $pertanyaan->daftartilik->area }}
    </a>/

    <a href="/auditor-daftartilik-tampilpertanyaandaftartilik/{{ $pertanyaan->id }}" class="mx-1">
    Pertanyaan
    </a>/  

    <a href="/auditor-editdokumensahih/{{ $pertanyaan->id }}" class="mx-1">
      Bukti Sahih
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
      <div id="errorUpload"></div>
      {{-- Start Form BA AMI --}}
      <form action="/storedokumensahih" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Dokumen Pendukung --}}
        <div class="row sectionName mx-0 m-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Dokumen Bukti Sahih</div>  
        </div>
        <div class="row inputDokPendukung my-4 mx-5">
          <p id="errorDokumen" class="text-center py-2" style="color: red; font-weight: bold"></p>
          <div class="col mb-4" hidden>
              <label for="pertanyaan_id" class="form-label fw-semibold">ID Pertanyaan</label>
              <input type="text" class="form-control" id="pertanyaan_id" placeholder="ID Auditee" name="pertanyaan_id" value="{{ $pertanyaan->id }}" disabled>
          </div>
          <div class="col mb-4">
            <label for="inputNamaDokumen" class="form-label fw-semibold">Nama Dokumen</label>
            <input type="text" class="form-control" id="inputNamaDokumen" placeholder="contoh: [nama dokumen]_[Revisi 1] *tanpa tanda kurung siku" name="namaFile" disabled>
          </div>
          <div class="col mb-4">
            <label for="linkDocument" class="form-label fw-semibold">Link Dokumen <span class="text-danger"><b>**</b></span></label>
            <input type="text" class="form-control" id="linkDocument" placeholder="Sertakan url dokumen bukti sahih" name="link" disabled>
          </div>
          <div class="col mb-2">
            <label for="dokSahih" class="form-label fw-semibold">Unggah Dokumen Bukti Sahih</label>
            <input class="form-control" type="file" id="dokSahih" placeholder="Unggah Dokumen Bukti Sahih" multiple name="dokSahih" accept=".csv, .xlsx, .xls, .pdf, .docx" disabled>
            <p class="fw-light fst-italic">*.csv, .xlsx, .xls, .pdf, .docx (maks. 10MB)</p>
          </div>
        </div>

        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-flex justify-content-end">
          <a href="/auditor-daftartilik-tampilpertanyaandaftartilik/{{ $pertanyaan->id }}"><button type="button" class="btn btn-secondary me-md-2">Kembali</button></a>
          <button onclick="submitdisabled()" class="btn btn-success" type="button">Simpan Perubahan</button>
        </div>
      </form>
      <div class="listDokPendukung px-3 my-5">
        <div id="liveAlertPlaceholder"></div>
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
                  <a 
                    @if ($doksahih->link != null)
                      href="{{ $doksahih->link }}"
                    @else
                      onclick="alertlinknull()"
                    @endif 
                  id="byLink" class="me-md-2" target="_blank"><button class="bg-primary border-0 rounded-1" title="URL Dokumen"><i class="bi bi-link text-white"></i></button></a>
                  <a 
                    @if ($doksahih->dokSahih != null)
                      href="/lihatdokumensahih/{{ $doksahih->id }}"
                    @else
                      onclick="alertdoknull()"
                    @endif 
                  id="byDoc" class="me-md-2" target="_blank"><button class="bg-warning border-0 rounded-1" title="File Dokumen"><i class="bi bi-file-earmark text-white"></i></button></a>
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
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

      const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
      const alertUpload = document.getElementById('errorUpload');
      let data = {!! json_encode($doksahihs) !!};

      const alert = (message, type) => {
        const wrapper = document.createElement('div')
        wrapper.innerHTML = [
          `<div class="alert alert-${type} alert-dismissible" role="alert">`,
          `   <div>${message}</div>`,
          '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
        ].join('')

        alertPlaceholder.append(wrapper)
      }

      const alertupload = (message, type) => {
        const wrapper = document.createElement('div')
        wrapper.innerHTML = [
          `<div class="alert alert-${type} alert-dismissible" role="alert">`,
          `   <div>${message}</div>`,
          '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
        ].join('')

        alertUpload.append(wrapper)
      }

      function alertlinknull() {
        alert('Dokumen ini tidak tersedia dalam bentuk link!', 'warning');
      }
      function alertdoknull() {
        alert('Dokumen ini tidak tersedia dalam bentuk file!', 'warning');
      }

      function submitdisabled() {
        alertupload('Maaf, Auditor hanya dapat melihat dokumen bukti sahih!', 'danger');
      }
    </script>
@endpush
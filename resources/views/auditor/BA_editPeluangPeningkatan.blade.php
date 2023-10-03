@extends('auditor.main_') @section('title') AMI - Temuan Berita Acara @endsection

@section('linking')
    <a href="/auditor-beritaacara" class="mx-1">
        Berita Acara
    </a>/

    <a href="/auditor-auditeeBA/{{ $peningkatan_->beritaacara->auditee_id }}/{{ $peningkatan_->beritaacara->tahunperiode }}" class="mx-1">
    {{ $peningkatan_->beritaacara->unit_kerja }}
    </a>/

    <a href="/auditor-BA-AMI/{{ $peningkatan_->beritaacara->auditee_id }}/{{ $peningkatan_->beritaacara->tahunperiode }}" class="mx-1">
    BA - AMI
    </a>/

    <a href="/auditor-BA-editpeluangpeningkatan/{{ $peningkatan_->beritaacara->auditee_id }}/{{ $peningkatan_->beritaacara->tahunperiode }}" class="mx-1">
    Peluang Peningkatan
    </a>/
    
@endsection

@section('container')
  <div class="container vh-100 mb-4">
      <div class="topSection d-flex justify-content-around mx-2 mt-4">
          @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
              {{ $message }}
          </div>
          @endif
      </div>

      <form id="myForm" action="/auditor-BA-updatepeluangpeningkatan/{{ $peningkatan_->id}}" method="POST">
        @csrf
        {{-- Peluang Peningkatan --}}
        <div class="row sectionName mx-0 m-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Peluang Peningkatan</div>  
        </div>
        <div class="pelpeningkatan">
            <div class="row inputPeluangPeningkatan my-4 mx-5">
                <div class="col-12 mb-4" hidden>
                    <label for="getBeritaAcaraID" class="form-label fw-semibold">ID Berita Acara</label>
                    <input type="text" class="form-control" id="getBeritaAcaraID" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore[0][beritaacara_id]" value="{{ $peningkatan_->beritaacara_id }}">
                </div>
                <div class="col-12 mb-4">
                    
                    <label for="inputBidang" class="form-label fw-semibold">Aspek/Bidang <span class="text-danger fw-bold">*</span></label>
                    <input type="text" class="form-control" id="inputBidang" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore[0][aspek]" value="{{ $peningkatan_->aspek }}" required>
                    
                </div>
                <div class="col-12 form-floating">
                  <p for="inputKelebihan" class="form-label fw-semibold">Kelebihan <span class="text-danger fw-bold">*</span></p>
                </div>
                <div class="col-12 form-floating mb-4">
                  <textarea class="form-control" placeholder="Tuliskan hal yang menjadi kelebihan" id="inputKelebihan" style="height: 100px" name="addmore[0][kelebihan]" value="{{ $peningkatan_->kelebihan }}">{{ $peningkatan_->kelebihan }}</textarea>
                  <div id="error-message" style="color: red;"></div>
                </div>
                <div class="col-12 form-floating">
                  <p for="inputPeluang" class="form-label fw-semibold">Peluang untuk Peningkatan <span class="text-danger fw-bold">*</span></p>
                </div>
                <div class="col-12 form-floating mb-4">
                  <textarea class="form-control" placeholder="Tuliskan hal yang menjadi peluang untuk peningkatan" id="inputPeluang" style="height: 100px" name="addmore[0][peningkatan]" value="{{ $peningkatan_->peningkatan }}">{{ $peningkatan_->peningkatan }}</textarea>
                  <div id="error-message-peluang" style="color: red;"></div>
                </div>
            </div>
        </div>

        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-flex justify-content-end mx-5">
          <a href="/auditor-BA-AMI/{{ $peningkatan_->beritaacara->auditee_id }}/{{ $peningkatan_->beritaacara->tahunperiode }}">
            <button class="btn btn-secondary me-md-2" type="button">Kembali</button></a>
          <button class="btn btn-success" type="submit">Simpan Perubahan</button>
        </div>
      </form>
  </div>
@endsection

@push('script')
  {{-- ck editor --}}
  <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/giukfcgxmwoga5mpve1dcvfwuwqcbliwn88cqrd4ffjc17h1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    // ClassicEditor
    //     .create( document.querySelector( '#inputKelebihan' ) )
    //     .catch( error => {
    //         console.error( error );
    //     } );

    // ClassicEditor
    //     .create( document.querySelector( '#inputPeluang' ) )
    //     .catch( error => {
    //         console.error( error );
    //     } );
    tinymce.init({
      selector: 'textarea#inputKelebihan',
      toolbar: false,
      menubar: false,
      height: 150,
    });
    
    tinymce.init({
      selector: 'textarea#inputPeluang',
      toolbar: false,
      menubar: false,
      height: 100,
    });
  </script>
  <script>
    document.getElementById("myForm").addEventListener("submit", function(event) {
      var kelebihanTextarea = document.getElementById("inputKelebihan");
      var peluangTextarea = document.getElementById("inputPeluang");
      var errorMessage = document.getElementById("error-message");
      var errorMessagePeluang = document.getElementById("error-message-peluang");

      if (kelebihanTextarea.value === "") {
        errorMessage.textContent = "Kolom kelebihan harus diisi!";
        event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan.
      } else {
        errorMessage.textContent = ""; // Menghapus pesan kesalahan jika bidang diisi dengan benar.
      }

      if (peluangTextarea.value === "") {
        errorMessagePeluang.textContent = "Kolom peluang untuk peningkatan harus diisi!";
        event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan.
      } else {
        errorMessagePeluang.textContent = ""; // Menghapus pesan kesalahan jika bidang diisi dengan benar.
      }
    });
  </script>
@endpush
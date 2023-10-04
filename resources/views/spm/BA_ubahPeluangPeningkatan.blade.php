@extends('layout.main') @section('title') AMI - Temuan Berita Acara @endsection

@section('linking')
    <a href="/beritaacara" class="mx-1">
        Berita Acara
    </a>/

    <a href="/auditeeBA/{{ $beritaacara_->auditee_id }}/{{ $beritaacara_->tahunperiode }}" class="mx-1">
    {{ $beritaacara_->auditee->unit_kerja }}
    </a>/

    <a href="/BA-AMI/{{ $beritaacara_->auditee_id }}/{{ $beritaacara_->tahunperiode }}" class="mx-1">
    BA - AMI
    </a>/

    <a href="/BA-peluangpeningkatan/{{ $beritaacara_->auditee_id }}/{{ $beritaacara_->tahunperiode }}" class="mx-1">
    Peluang Peningkatan
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

      <form id="myForm" action="/BA-addpeluangpeningkatan/{{ $beritaacara_->auditee_id }}/{{ $beritaacara_->tahunperiode }}" method="post">
        @csrf
        {{-- Peluang Peningkatan --}}
        <div class="row sectionName mx-0 my-2">
          <div class="col border rounded-top text-center py-2 fw-semibold">Peluang Peningkatan</div>  
        </div>
        <div class="pelpeningkatan">
            <div class="row inputPeluangPeningkatan my-4 mx-5">
                <div class="col-12 mb-4" hidden>
                    <label for="getBeritaAcaraID" class="form-label fw-semibold">ID Berita Acara</label>
                    <input type="text" class="form-control" id="getBeritaAcaraID" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore[0][beritaacara_id]" value="{{ $beritaacara_->id }}">
                </div>
                <div class="col-12 mb-4">
                    
                    <label for="inputBidang" class="form-label fw-semibold">Aspek/Bidang <span class="text-danger fw-bold">*</span></label>
                    <input type="text" class="form-control" id="inputBidang" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore[0][aspek]" required>
                    
                </div>
                <div class="col-12 form-floating">
                  <p for="inputKelebihan" class="form-label fw-semibold">Kelebihan <span class="text-danger fw-bold">*</span></p>
                </div>
                <div class="col-12 form-floating mb-4">
                  <textarea class="form-control" placeholder="Tuliskan hal yang menjadi kelebihan" id="inputKelebihan" style="height: 100px" name="addmore[0][kelebihan]"></textarea>
                  <div id="error-message" style="color: red;"></div>
                </div>
                <div class="col-12 form-floating">
                  <p for="inputPeluang" class="form-label fw-semibold">Peluang untuk Peningkatan <span class="text-danger fw-bold">*</span></p>
                </div>
                <div class="col-12 form-floating mb-4">
                  <textarea class="form-control" placeholder="Tuliskan hal yang menjadi peluang untuk peningkatan" id="inputPeluang" style="height: 100px" name="addmore[0][peningkatan]"></textarea>
                  <div id="error-message-peluang" style="color: red;"></div>
                </div>
            </div>
            <div class="row inputPeluangPeningkatan my-4 mx-5">
                <div class="col mb-4 d-flex justify-content-end">
                  <a href="/BA-AMI/{{ $beritaacara_->auditee_id }}/{{ $beritaacara_->tahunperiode }}">
                  <button class="btn btn-secondary me-md-2" type="button">Kembali</button></a>
                  <button class="moreItems_add btn btn-primary" type="button">Tambah Peluang Peningkatan</button>
                </div>
            </div>
        </div>

        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-grid gap-2">
          <button class="btn btn-success" type="submit">Simpan Perubahan</button>
        </div>
      </form>
  </div>
@endsection

@push('script')
  <script>
    $(document).ready(function(){
      var max_fields = 100;
      var wrapper = $(".pelpeningkatan");
      var add_btn = $(".moreItems_add");
      var i = 1;

      $(add_btn).click(function(e){
        e.preventDefault();
        if (i < max_fields) {
          i++;
          $(wrapper).append('<div class="row inputPeluangPeningkatan add-new my-4 mx-5"><div class="col-12 mb-4" hidden><label for="getBeritaAcaraID" class="form-label fw-semibold">ID Berita Acara</label><input type="text" class="form-control" id="getBeritaAcaraID'+i+'" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore['+i+'][beritaacara_id]" value="{{ $beritaacara_->id }}"></div><div class="col-12 mb-4"><label for="inputBidang" class="form-label fw-semibold">Aspek/Bidang <span class="text-danger fw-bold">*</span></label><input type="text" class="form-control" id="inputBidang'+i+'" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore['+i+'][aspek]" required></div><div class="col-12 form-floating"><p for="inputKelebihan" class="form-label fw-semibold">Kelebihan <span class="text-danger fw-bold">*</span></p></div><div class="col-12 form-floating mb-4"><textarea class="form-control" placeholder="Tuliskan hal yang menjadi kelebihan" id="inputKelebihan'+i+'" style="height: 100px" name="addmore['+i+'][kelebihan]"></textarea>\<div id="error-message'+i+'" style="color: red;"></div></div>\<div class="col-12 form-floating"><p for="inputPeluang" class="form-label fw-semibold">Peluang untuk Peningkatan <span class="text-danger fw-bold">*</span></p></div><div class="col-12 form-floating mb-4">\<textarea class="form-control" placeholder="Tuliskan hal yang menjadi peluang untuk peningkatan" id="inputPeluang'+i+'" style="height: 100px" name="addmore['+i+'][peningkatan]"></textarea><div id="error-message-peluang'+i+'" style="color: red;"></div></div><div class="row justify-content-end px-0"><div class="col-4 my-4 px-0"><button class="btn btn-danger float-end my-1 px-3 remove-tr" type="button">Urungkan</button></div></div></div>')
          tinymce.init({
            selector: 'textarea#inputKelebihan'+i,
            toolbar: false,
            menubar: false,
            height: 150,
          });
          
          tinymce.init({
            selector: 'textarea#inputPeluang'+i,
            toolbar: false,
            menubar: false,
            height: 100,
          });
        }
      });

      document.getElementById("myForm").addEventListener("submit", function(event) {
        var kelebihanTextarea = tinyMCE.get('inputKelebihan').getContent();
        var peluangTextarea = tinyMCE.get('inputPeluang').getContent();

        document.getElementById("inputKelebihan").value = kelebihanTextarea;
        document.getElementById("inputPeluang").value = peluangTextarea;

        var errorMessage = document.getElementById("error-message");
        var errorMessagePeluang = document.getElementById("error-message-peluang");

        if (kelebihanTextarea === "") {
          errorMessage.textContent = "Kolom kelebihan harus diisi!";
          event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan.
        } else {
          errorMessage.textContent = ""; // Menghapus pesan kesalahan jika bidang diisi dengan benar.
        }

        if (peluangTextarea === "") {
          errorMessagePeluang.textContent = "Kolom peluang untuk peningkatan harus diisi!";
          event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan.
        } else {
          errorMessagePeluang.textContent = ""; // Menghapus pesan kesalahan jika bidang diisi dengan benar.
        }

        for (let index = 2; index <= i; index++) {

          var kelebihanTextareaindex = [];
          var peluangTextareaindex = [];

          kelebihanTextareaindex[index] = tinyMCE.get('inputKelebihan'+index).getContent();
          peluangTextareaindex[index] = tinyMCE.get('inputPeluang'+index).getContent();

          document.getElementById("inputKelebihan"+index).value = kelebihanTextareaindex[index];
          document.getElementById("inputPeluang"+index).value = peluangTextareaindex[index];

          var errorMessageindex = document.getElementById("error-message"+index);
          var errorMessagePeluangindex = document.getElementById("error-message-peluang"+index);

          if (kelebihanTextareaindex[index] === "") {
            errorMessageindex.textContent = "Kolom kelebihan harus diisi!";
            event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan.
          } else {
            errorMessageindex.textContent = ""; // Menghapus pesan kesalahan jika bidang diisi dengan benar.
          }

          if (peluangTextareaindex[index] === "") {
            errorMessagePeluangindex.textContent = "Kolom peluang untuk peningkatan harus diisi!";
            event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan.
          } else {
            errorMessagePeluangindex.textContent = ""; // Menghapus pesan kesalahan jika bidang diisi dengan benar.
          }

        }
      });

      $(document).on('click', '.remove-tr', function(){  
        $(this).parents('.add-new').remove();
      });  
    });
  </script>

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
  {{-- <script>
    document.getElementById("myForm").addEventListener("submit", function(event) {
      var kelebihanTextarea = tinyMCE.get('inputKelebihan').getContent();
      var peluangTextarea = tinyMCE.get('inputPeluang').getContent();

      document.getElementById("inputKelebihan").value = kelebihanTextarea;
      document.getElementById("inputPeluang").value = peluangTextarea;

      var kelebihanTextarea2 = tinyMCE.get('inputKelebihan2').getContent();
      var peluangTextarea2 = tinyMCE.get('inputPeluang2').getContent();

      document.getElementById("inputKelebihan2").value = kelebihanTextarea2;
      document.getElementById("inputPeluang2").value = peluangTextarea2;

      console.log(kelebihanTextarea);
      console.log(peluangTextarea);
      console.log("=============");
      console.log(kelebihanTextarea2);
      console.log(peluangTextarea2);

      event.preventDefault();

      var errorMessage = document.getElementById("error-message");
      var errorMessagePeluang = document.getElementById("error-message-peluang");

      if (kelebihanTextarea === "") {
        errorMessage.textContent = "Kolom kelebihan harus diisi!";
        event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan.
      } else {
        errorMessage.textContent = ""; // Menghapus pesan kesalahan jika bidang diisi dengan benar.
      }

      if (peluangTextarea === "") {
        errorMessagePeluang.textContent = "Kolom peluang untuk peningkatan harus diisi!";
        event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan.
      } else {
        errorMessagePeluang.textContent = ""; // Menghapus pesan kesalahan jika bidang diisi dengan benar.
      }
    });
  </script> --}}
@endpush
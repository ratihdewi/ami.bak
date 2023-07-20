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

      <form action="/BA-addpeluangpeningkatan/{{ $beritaacara_->auditee_id }}" method="post">
        @csrf
        {{-- Peluang Peningkatan --}}
        <div class="row sectionName mx-0 m-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Peluang Peningkatan</div>  
        </div>
        <div class="pelpeningkatan">
            <div class="row inputPeluangPeningkatan my-4 mx-5">
                <div class="col-12 mb-4" hidden>
                    <label for="getBeritaAcaraID" class="form-label fw-semibold">ID Berita Acara</label>
                    <input type="text" class="form-control" id="getBeritaAcaraID" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore[0][beritaacara_id]" value="{{ $beritaacara_->id }}">
                </div>
                <div class="col-12 mb-4">
                    
                    <label for="inputBidang" class="form-label fw-semibold">Aspek/Bidang</label>
                    <input type="text" class="form-control" id="inputBidang" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore[0][aspek]">
                    
                </div>
                <div class="col-12 form-floating mb-4">
                    
                    <textarea class="form-control" placeholder="Tuliskan hal yang menjadi kelebihan" id="inputKelebihan" style="height: 100px" name="addmore[0][kelebihan]"></textarea>
                    <label for="inputKelebihan" class="ms-3">Kelebihan</label>
                   
                </div>
                <div class="col-12 form-floating mb-4">
                    
                    <textarea class="form-control" placeholder="Tuliskan hal yang menjadi peluang untuk peningkatan" id="inputPeluang" style="height: 100px" name="addmore[0][peningkatan]"></textarea>
                    <label for="inputPeluang" class="ms-3">Peluang untuk Peningkatan</label>
                   
                </div>
            </div>
            <div class="row inputPeluangPeningkatan my-4 mx-5">
                <div class="col-12 mb-4">
                    <button class="moreItems_add btn btn-primary float-end" type="button">Tambah Peluang Peningkatan</button>
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
      var max_fields = 50;
      var wrapper = $(".pelpeningkatan");
      var add_btn = $(".moreItems_add");
      var i = 1;
      $(add_btn).click(function(e){
        e.preventDefault();
        if (i < max_fields) {
          i++;

          $(wrapper).append('<div class="row inputPeluangPeningkatan add-new my-4 mx-5"><div class="col-12 mb-4" hidden><label for="getBeritaAcaraID" class="form-label fw-semibold">ID Berita Acara</label><input type="text" class="form-control" id="getBeritaAcaraID" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore['+i+'][beritaacara_id]" value="{{ $beritaacara_->id }}"></div><div class="col-12 mb-4"><label for="inputBidang" class="form-label fw-semibold">Aspek/Bidang</label><input type="text" class="form-control" id="inputBidang" placeholder="Masukkan aspek/bidang atau nomor butir mutu" name="addmore['+i+'][aspek]"></div><div class="col-12 form-floating mb-4"><textarea class="form-control" placeholder="Tuliskan hal yang menjadi kelebihan" id="inputKelebihan" style="height: 100px" name="addmore['+i+'][kelebihan]"></textarea><label for="inputKelebihan" class="ms-3">Kelebihan</label>\</div>\<div class="col-12 form-floating mb-4">\<textarea class="form-control" placeholder="Tuliskan hal yang menjadi peluang untuk peningkatan" id="inputPeluang" style="height: 100px" name="addmore['+i+'][peningkatan]"></textarea><label for="inputPeluang" class="ms-3">Peluang untuk Peningkatan</label></div><div class="row justify-content-end px-0"><div class="col-4 my-4 px-0"><button class="btn btn-danger float-end my-1 px-3 remove-tr" type="button">Urungkan</button></div></div></div>')
        }
      });

      $(document).on('click', '.remove-tr', function(){  
        $(this).parents('.add-new').remove();
      });  
    });
  </script>
@endpush
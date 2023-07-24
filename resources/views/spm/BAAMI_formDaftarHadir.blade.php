@extends('layout.main') 
@section('title') AMI - Temuan Berita Acara @endsection

@section('container')

    <div class="container my-5">
        <form action="/BA-savedaftarhadir/{{ $beritaacara_->auditee_id }}" method="post">
            @csrf
            {{-- Berita Acara AMI - Daftar Hadir --}}
            <div class="row sectionName mx-0 mb-5 mt-5">
                <div class="col border rounded-top text-center py-2 fw-semibold">Berita Acara AMI - Daftar Hadir</div>  
            </div>
            <div class="inputAbsen mx-4">
              <div class="row inputabsen my-4 mx-5" hidden>
                <div class="col">
                    <label for="beritaacara_id" class="form-label fw-semibold">ID Berita Acara</label>
                    <input type="text" class="form-control" id="beritaacara_id" placeholder="Masukkan id berita acara" name="addmore[0][beritaacara_id]" value="{{ $beritaacara_->id }}">
                </div>
              </div>
              
              <div class="row inputabsen my-4 mx-5">
                <div class="col-4 mb-4">
                  <label for="inputPosisi" class="form-label fw-semibold">Auditor/Auditee:</label>
                  <select id="inputPosisi" class="form-select mb-4" name="addmore[0][posisi]">
                      <option selected disabled>Posisi (Auditor/Auditee)</option>
                      <option value="Auditor" 
                      @if (Auth::user()->role == 'Auditee')
                          disabled
                      @endif>Auditor</option>
                      <option value="Auditee"
                      @if (Auth::user()->role == 'Auditor')
                          disabled
                      @endif
                      >Auditee</option>
                  </select>
                </div>
                <div class="col-7 mb-4">
                    <label for="inputAbsenNama" class="form-label fw-semibold">Nama</label>
                    <input type="text" class="form-control mb-4" id="inputAbsenNama" placeholder="Masukkan nama peserta BA" name="addmore[0][namapeserta]">
                </div> 
                <div class="col-1 mb-4">
                    <button class="moreItems_add btn btn-primary float-end" type="button"><i class="bi bi-plus h5" style="color: #ffff"></i></button>
                </div>
              </div> 
            
            </div>
            
            {{-- Simpan Perubahan --}}
            <div class="simpanBA d-grid gap-2 mt-5">
                <button class="btn btn-success" type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

@endsection

@push('script')
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

          $(wrapper).append('<div class="row inputAbsen add-new mx-5"><div class="row inputabsen mx-5" hidden><div class="col"><label for="beritaacara_id" class="form-label fw-semibold">ID Berita Acara</label><input type="text" class="form-control" id="beritaacara_id" placeholder="Masukkan id berita acara" name="addmore['+i+'][beritaacara_id]" value="{{ $beritaacara_->id }}"></div></div><div class="row inputabsen"><div class="col-4 mb-4"><label for="inputPosisi" class="form-label">Auditor/Auditee:</label><select id="inputPosisi" class="form-select" name="addmore['+i+'][posisi]"><option selected disabled>Pilih Auditor/Auditee</option><option value="Auditor" @if (Auth::user()->role == "Auditee") {{ "disabled" }} @endif>Auditor</option><option value="Auditee" @if (Auth::user()->role == "Auditor") {{ "disabled" }} @endif>Auditee</option></select></div><div class="col-7 mb-4"><label for="inputAbsenNama" class="form-label fw-semibold">Nama</label><input type="text" class="form-control" id="inputAbsenNama" placeholder="Masukkan nama peserta BA" name="addmore['+i+'][namapeserta]"></div><div class="col-1 my-4"><button class="btn btn-danger float-end my-1 remove-tr" type="button"><i class="bi bi-x p-0" style="color: #ffff"></i></button></div></div></div>')
          
        }
      });

      $(document).on('click', '.remove-tr', function(){  
        $(this).parents('.add-new').remove();
      });  
    });
  </script>
@endpush
@extends('layout.main') 
@section('title') AMI - Temuan Berita Acara @endsection

@section('container')

    <div class="container my-5">
        {{-- @foreach ($ba_ as $ba) --}}
        <form action="" method="post">
        {{-- @endforeach --}}
            @csrf
            {{-- Berita Acara AMI - Daftar Hadir --}}
            <div class="row sectionName mx-0 mb-5 mt-5">
                <div class="col border rounded-top text-center py-2 fw-semibold">Berita Acara AMI - Daftar Hadir</div>  
            </div>
            <div class="row inputAbsen my-4 mx-5">
                <div class="col-4 mb-4">
                    <label for="inputPosisi" class="form-label fw-semibold">Auditor/Auditee:</label>
                    <select id="inputPosisi" class="form-select">
                        <option selected disabled>Pilih Auditor/Auditee</option>
                        <option value="Auditor">Auditor</option>
                        <option value="Auditee">Auditee</option>
                    </select>
                </div>
                <div class="col-7 mb-4">
                    <label for="inputAbsenNama" class="form-label fw-semibold">Nama</label>
                    <input type="text" class="form-control" id="inputAbsenNama" placeholder="Masukkan nama peserta BA">
                </div>
                <div class="col-1 mb-4">
                    <button class="moreItems_add btn btn-primary float-end" type="button"><i class="bi bi-plus h5" style="color: #ffff"></i></button>
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
@endpush
@extends('auditor.main_') 
@section('title') AMI - Temuan Berita Acara @endsection

@section('linking')
    <a href="/auditor-beritaacara" class="mx-1">
        Berita Acara
    </a>/

    @foreach ($auditee_ as $auditee)
    <a href="/auditor-auditeeBA/{{ $auditee->id }}/{{ $auditee->tahunperiode }}" class="mx-1">
    @endforeach
    @foreach ($auditee_ as $auditee)
    {{ $auditee->unit_kerja }}
    @endforeach
    </a>/

    @foreach ($auditee_ as $auditee)
    <a href="/auditor-BA-AMI/{{ $auditee->id }}/{{ $auditee->tahunperiode }}" class="mx-1">
    @endforeach
    BA - AMI
    </a>/

    @foreach ($auditee_ as $auditee)
    <a href="/auditor-BA-daftarhadir/{{ $auditee->id }}" class="mx-1">
    @endforeach
    Daftar Hadir
    </a>/
    
@endsection

@section('container')
    <div class="topSection d-flex justify-content-around mx-2 mt-4">
      @if ($message = Session::get('success'))
      <div class="alert alert-success" role="alert">
          {{ $message }}
      </div>
      @elseif ($message = Session::get('error'))
      <div class="alert alert-danger" role="alert">
          {{ $message }}
      </div>
      @endif
    </div>
    <div class="container my-5">
      <form action="/BA-savedaftarhadir/{{ $beritaacara_->auditee_id }}" method="post">
        @csrf
        {{-- Berita Acara AMI - Daftar Hadir --}}
        <div class="row sectionName mx-0 mb-5 mt-5">
            <div class="col border rounded-top text-center py-2 fw-semibold">Berita Acara AMI - Daftar Hadir</div>  
        </div>
        
        <div class="luar">
          <div class="inputAbsen mx-4">
            <div class="row inputabsen my-4 mx-5" hidden>
              <div class="col">
                  <label for="beritaacara_id" class="form-label fw-semibold">ID Berita Acara</label>
                  <input type="text" class="form-control" id="beritaacara_id" placeholder="Masukkan id berita acara" name="addmore[0][beritaacara_id]" value="{{ $beritaacara_->id }}">
              </div>
            </div>
            <div class="row inputabsen my-4 mx-5" hidden>
              <div class="col">
                  <label for="deletedBy" class="form-label fw-semibold">Deleted By</label>
                  <input type="text" class="form-control" id="deletedBy" placeholder="Masukkan nama penghapus" name="addmore[0][deletedBy]">
              </div>
            </div>
            <div class="row inputabsen my-4 mx-5">
              <div class="col" hidden>
                <label for="namapenginput" class="form-label fw-semibold">Penginput</label>
                <input type="text" class="form-control" id="namapenginput" placeholder="Masukkan nama penginput" name="addmore[0][namapenginput]" value="{{ Auth::user()->name }}">
              </div>
              <div class="col-4 mb-4">
                <label for="inputPosisi1" class="form-label fw-semibold">Auditor/Auditee:</label>
                <select id="inputPosisi1" class="form-select mb-4" name="addmore[0][posisi]">
                    <option selected disabled>Posisi (Auditor/Auditee)</option>
                    <option value="Auditor">Auditor</option>
                    <option value="Auditee" disabled>Auditee</option>
                </select>
              </div>
              <div class="col-7 mb-4">
                  <label for="inputAbsenNama1" class="form-label fw-semibold">Nama</label>
                  <select id="inputAbsenNama1" class="form-select" name="addmore[0][namapeserta]" required>
                    <option></option>
                  </select>
              </div> 
              <div class="col-1 mb-4">
                  <button id="moreItems_add" class="moreItems_add btn btn-primary float-end" type="button"><i class="bi bi-plus h5" style="color: #ffff"></i></button>
              </div>

            </div>
         
          </div>
        </div>
        
        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-flex justify-content-end mx-5">
          @foreach ($auditee_ as $auditee)
          <a href="/auditor-BA-AMI/{{ $auditee->id }}/{{ $auditee->tahunperiode }}">
          @endforeach
          <button class="btn btn-secondary me-md-2" type="button">Kembali</button></a>
            <button id="btnSimpan" class="btn btn-success" type="submit">Simpan Perubahan</button>
        </div>
    </form>
    </div>

@endsection

@push('script')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    var i = 1;
    var max_fields = 50;
    var wrapper = $(".luar");
    var add_btn = $(".moreItems_add");
    var unit_kerja = "{{ $beritaacara_->auditee->unit_kerja }}";

    $('#inputPosisi1').change(function(){
      var posisi = $(this).val();
      var auditee_id = "{{ $beritaacara_->auditee_id }}"
      var urlAuditor = '{{ route("BA-daftarhadir-searchAuditor") }}';
      
      if(posisi == "Auditor"){
        $.ajax({
            url: urlAuditor,
            type: 'GET',
            dataType: 'json',
            data: { q: '' },
            success: function(data) {
                $('#inputAbsenNama1').empty();
                $('#inputAbsenNama1').append('<option value="" selected disabled>Pilih Auditor</option>');
                if (Array.isArray(data)) {
                    var filteredData = data.filter(function(item) {
                        return item.id == auditee_id;
                    });
                    var mappedData = filteredData.map(function(item) {
                      return {
                          id: item.ketua_auditor,
                          text: item.ketua_auditor,
                      };
                    });

                    filteredData.forEach(function(item) {
                      mappedData.push({
                          id: item.anggota_auditor,
                          text: item.anggota_auditor,
                      });
                    });

                    filteredData.forEach(function(item) {
                      mappedData.push({
                          id: item.anggota_auditor2,
                          text: item.anggota_auditor2,
                      });
                    });

                    $('#inputAbsenNama1').select2({
                        data: mappedData,
                    });
                } else {
                    console.error('Data yang diterima dari server bukan array yang valid.');
                }
            },
            error: function() {
            console.error('Terjadi kesalahan saat memuat data users.');
            }
        });
      } 
      
    });

    $(add_btn).click(function(e){
      e.preventDefault();
      if (i < max_fields) {
        console.log('#inputPosisi'+i);
        i++;
        $(wrapper).append('<div class="inputAbsen add-new mx-4"><div class="row inputabsen my-4 mx-5" hidden><div class="col"><label for="beritaacara_id'+i+'" class="form-label fw-semibold">ID Berita Acara</label><input type="text" class="form-control" id="beritaacara_id'+i+'" placeholder="Masukkan id berita acara" name="addmore['+i+'][beritaacara_id]" value="{{ $beritaacara_->id }}"></div></div><div class="row inputabsen my-4 mx-5" hidden><div class="col"><label for="namapenginput'+i+'" class="form-label fw-semibold">Penginput</label><input type="text" class="form-control" id="namapenginput'+i+'" placeholder="Masukkan nama penginput" name="addmore['+i+'][namapenginput]" value="{{ Auth::user()->name }}"></div><div class="col"><label for="deletedBy'+i+'" class="form-label fw-semibold">Deleted By</label><input type="text" class="form-control" id="deletedBy'+i+'" placeholder="Masukkan nama penghapus" name="addmore['+i+'][deletedBy]"></div></div><div class="row inputabsen my-4 mx-5"><div class="col-4 mb-4"><label for="inputPosisi'+i+'" class="form-label fw-semibold">Auditor/Auditee:</label><select id="inputPosisi'+i+'" class="form-select mb-4" name="addmore['+i+'][posisi]"><option selected disabled>Posisi (Auditor/Auditee)</option><option value="Auditor">Auditor</option><option value="Auditee" disabled>Auditee</option></select></div><div class="col-7 mb-4"><label for="inputAbsenNama'+i+'" class="form-label fw-semibold">Nama</label><select id="inputAbsenNama'+i+'" class="form-select" name="addmore['+i+'][namapeserta]" required><option></option></select></div><div class="col-1 my-4"><button id="remove-tr" class="btn btn-danger float-end my-1 remove-tr" type="button"><i class="bi bi-x p-0" style="color: #ffff"></i></button></div></div></div>');
      }
    });
    
    $(document).on('click', '#moreItems_add', function() {
      var deletedBy = $('#deletedBy').val("null");
      $('#inputPosisi'+i).change(function(){
            var posisi = $(this).val();
            var auditee_id = "{{ $beritaacara_->auditee_id }}"
            var urlAuditor = '{{ route("BA-daftarhadir-searchAuditor") }}';
            if(posisi == "Auditor"){
              $.ajax({
                  url: urlAuditor,
                  type: 'GET',
                  dataType: 'json',
                  data: { q: '' },
                  success: function(data) {
                      $('#inputAbsenNama'+i).empty();
                      $('#inputAbsenNama'+i).append('<option value="" selected disabled>Pilih Auditor</option>');
                      if (Array.isArray(data)) {
                        var filteredData = data.filter(function(item) {
                            return item.id == auditee_id;
                        });

                        var mappedData = filteredData.map(function(item) {
                          return {
                              id: item.ketua_auditor,
                              text: item.ketua_auditor,
                          };
                        });

                        filteredData.forEach(function(item) {
                          mappedData.push({
                              id: item.anggota_auditor,
                              text: item.anggota_auditor,
                          });
                        });

                        filteredData.forEach(function(item) {
                          mappedData.push({
                              id: item.anggota_auditor2,
                              text: item.anggota_auditor2,
                          });
                        });

                        $('#inputAbsenNama'+i).select2({
                            data: mappedData,
                        });
                      } else {
                          console.error('Data yang diterima dari server bukan array yang valid.');
                      }
                  },
                  error: function() {
                  console.error('Terjadi kesalahan saat memuat data users.');
                  }
              });
            } 
            
          });
    });

    $(document).on('click', '#remove-tr', function(){  
      $(this).parents('.add-new').remove();
    });

  </script>
@endpush
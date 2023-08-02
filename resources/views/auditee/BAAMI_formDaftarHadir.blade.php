@extends('auditee.main_') 
@section('title') AMI - Temuan Berita Acara @endsection

@section('container')
    <div class="row my-3 mx-2">
      @foreach ($auditee_ as $auditee)
      <a href="/auditee-BA-AMI/{{ $auditee->id }}/{{ $auditee->tahunperiode }}">
      @endforeach
      <button class="btn btn-primary btn-sm" type="button">Kembali</button></a>
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
                
                <div class="row inputabsen my-4 mx-5">
                  <div class="col-4 mb-4">
                    <label for="inputPosisi1" class="form-label fw-semibold">Auditor/Auditee:</label>
                    <select id="inputPosisi1" class="form-select mb-4" name="addmore[0][posisi]">
                        <option selected disabled>Posisi (Auditor/Auditee)</option>
                        <option value="Auditor" disabled>Auditor</option>
                        <option value="Auditee">Auditee</option>
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
            <div class="simpanBA d-grid gap-2 mt-5">
                <button class="btn btn-success" type="submit">Simpan Perubahan</button>
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
      var urlAuditee = '{{ route("BA-daftarhadir-searchAuditee") }}';
      
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
                  console.log(data);
                    var mappedData = data.map(function(item) {
                      if (item.id == auditee_id) {
                        return {
                            id: item.ketua_auditor,
                            text: item.ketua_auditor,
                        };
                      }
                    });

                    data.forEach(function(item) {
                      if (item.id == auditee_id) {
                        mappedData.push({
                            id: item.anggota_auditor,
                            text: item.anggota_auditor,
                        });
                      }
                    });

                    data.forEach(function(item) {
                      if (item.id == auditee_id) {
                        mappedData.push({
                            id: item.anggota_auditor2,
                            text: item.anggota_auditor2,
                        });
                      }
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
        // $.ajax({
        //   url: urlAuditor,
        //   type: 'get',
        //   dataType: 'json',
        //   success: function(response){
        //       $("#inputAbsenNama1").empty();
        //       if(response != null){
        //           response.forEach(respon => {
        //               $('#inputAbsenNama1').append($('<option>', { 
        //                   value: respon.nama,
        //                   text : respon.nama, 
        //               }));
                      
        //           });
                  
        //       }
        //   }
        // });
      } 
      else {
        $.ajax({
          url: urlAuditee,
          type: 'get',
          dataType: 'json',
          success: function(response){
              $("#inputAbsenNama1").empty();
              if(response != null){
                  response.forEach(respon => {
                    if (respon.unit_kerja == unit_kerja) {
                      $('#inputAbsenNama1').append($('<option>', { 
                          value: respon.name,
                          text : respon.name, 
                      }));
                    }
                  });
                  
              }
          }
        });
      }
      
    });

    $(add_btn).click(function(e){
      e.preventDefault();
      if (i < max_fields) {
        console.log('#inputPosisi'+i);
        i++;
        $(wrapper).append('<div class="inputAbsen add-new mx-4"><div class="row inputabsen my-4 mx-5" hidden><div class="col"><label for="beritaacara_id'+i+'" class="form-label fw-semibold">ID Berita Acara</label><input type="text" class="form-control" id="beritaacara_id'+i+'" placeholder="Masukkan id berita acara" name="addmore['+i+'][beritaacara_id]" value="{{ $beritaacara_->id }}"></div></div><div class="row inputabsen my-4 mx-5"><div class="col-4 mb-4"><label for="inputPosisi'+i+'" class="form-label fw-semibold">Auditor/Auditee:</label><select id="inputPosisi'+i+'" class="form-select mb-4" name="addmore['+i+'][posisi]"><option selected disabled>Posisi (Auditor/Auditee)</option><option value="Auditor" disabled>Auditor</option><option value="Auditee">Auditee</option></select></div><div class="col-7 mb-4"><label for="inputAbsenNama'+i+'" class="form-label fw-semibold">Nama</label><select id="inputAbsenNama'+i+'" class="form-select" name="addmore['+i+'][namapeserta]" required><option></option></select></div><div class="col-1 my-4"><button id="remove-tr" class="btn btn-danger float-end my-1 remove-tr" type="button"><i class="bi bi-x p-0" style="color: #ffff"></i></button></div></div></div>')
      }
    });
    
    $(document).on('click', '#moreItems_add', function() {
      console.log("berhasil", i);
      $('#inputPosisi'+i).change(function(){
            var posisi = $(this).val();
            var auditee_id = "{{ $beritaacara_->auditee_id }}"
            var urlAuditor = '{{ route("BA-daftarhadir-searchAuditor") }}';
            var urlAuditee = '{{ route("BA-daftarhadir-searchAuditee") }}';
            
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
                        console.log(data);
                          var mappedData = data.map(function(item) {
                            if (item.id == auditee_id) {
                              return {
                                  id: item.ketua_auditor,
                                  text: item.ketua_auditor,
                              };
                            }
                          });

                          data.forEach(function(item) {
                            if (item.id == auditee_id) {
                              mappedData.push({
                                  id: item.anggota_auditor,
                                  text: item.anggota_auditor,
                              });
                            }
                          });

                          data.forEach(function(item) {
                            if (item.id == auditee_id) {
                              mappedData.push({
                                  id: item.anggota_auditor2,
                                  text: item.anggota_auditor2,
                              });
                            }
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
            else {
              $.ajax({
                url: urlAuditee,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $("#inputAbsenNama"+i).empty();
                    if(response != null){
                        response.forEach(respon => {
                            $('#inputAbsenNama'+i).append($('<option>', { 
                                value: respon.name,
                                text : respon.name, 
                            }));
                            
                        });
                        
                    }
                }
              });
            }
            
          });
    });

    $(document).on('click', '#remove-tr', function(){  
      $(this).parents('.add-new').remove();
    });

    function alifa(params) {
      var urlAuditor = '{{ route("BA-daftarhadir-searchAuditor") }}';
      var test;
      if (params = 'Auditor') {
        $.ajax({
          url: urlAuditor,
          type: 'get',
          async: false,
          dataType: 'json',
          success: function(response){
              $("#inputAbsenNama").empty();
      
              if(response != null){
                  response.forEach(respon => {
                      $('#inputAbsenNama').append($('<option>', { 
                          value: respon.nama,
                          text : respon.nama, 
                      }));
                      
                  });
                  
              }
          }
        });
      }
      return test;
    }

  </script>
@endpush
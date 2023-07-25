@extends('layout.main') @section('title') AMI - Tambah Auditee @endsection
@section('container')
<div class="row justify-content-center mb-5">
    <div class="col-8">
        <div class="card mt-5">
            <div class="card-body p-4">
                <form action="/insertAuditee" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tahunperiode" class="form-label"
                                >Tahun Periode</label
                            >
                            <input
                                type="number"
                                name="tahunperiode"
                                class="form-control"
                                id="tahunperiode"
                                placeholder="Tahun Periode"
                                aria-label="Tahun Periode"
                                min="2016" max="3000"
                                required
                            />
                        </div> 
                        <div class="col">
                            <label for="nipAuditee" class="form-label"
                                >NIP</label
                            >
                            <select
                                id="nipAuditee"
                                class="form-select"
                                name="nip"
                                required
                            >
                                <option selected disabled>Pilih NIP Auditee</option>
                                @foreach ($users_ as $user)
                                <option value="{{ $user->nip }}">{{ $user->nip }}</option>
                                @endforeach
                            </select>
                        </div>           
                    </div>
                    <div class="row mb-3" hidden>
                        <div class="col">
                            <label for="user_id" class="form-label"
                                >ID User</label
                            >
                            <input
                                type="text"
                                name="user_id"
                                class="form-control"
                                id="user_id"
                                placeholder="ID User"
                                aria-label="ID User"
                            />
                        </div>         
                    </div>
                    <div class="mb-3">
                        <label for="selectUnitKerja" class="form-label"
                            >Unit Kerja</label
                        >
                        <select
                            id="selectUnitKerja"
                            class="form-select"
                            name="unit_kerja"
                            required
                        >
                            <option selected disabled>Pilih unit kerja yang akan diaudit</option>
                            @foreach ($users_ as $user)
                                <option value="{{ $user->unit_kerja }}">{{ $user->unit_kerja }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ketuaAuditee" class="form-label"
                            >Ketua Auditee</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="ketuaAuditee"
                            placeholder="Masukkan nama Ketua Auditee"
                            name="ketua_auditee"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="jabatanKetuaAuditee" class="form-label"
                            >Jabatan Ketua Auditee</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="jabatanKetuaAuditee"
                            placeholder="Masukkan jabatan Ketua Auditee"
                            name="jabatan_ketua_auditee"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="ketuaAuditor" class="form-label"
                            >Ketua Auditor</label
                        >
                        <select
                            class="form-control"
                            id="ketuaAuditor"
                            placeholder="Masukkan nama Ketua Auditor"
                            name="ketua_auditor"
                            required
                        >
                            <option selected disabled>Pilih ketua Auditor yang akan mengaudit</option>
                        </select>
                    </div>
                    <div id="anggotaauditor" class="row mb-3">
                        <div class="col-11">
                            <label for="anggotaAuditor" class="form-label"
                                >Anggota Auditor</label
                            >
                            <select
                                class="form-control"
                                id="anggotaAuditor"
                                placeholder="Masukkan nama Anggota Auditor"
                                name="anggota_auditor"
                                required
                            >
                                <option selected disabled>Pilih Auditor yang akan mengaudit</option>
                            </select>
                        </div>
                        <div class="col-1 py-4 my-1">
                            <button class="moreItems_add btn btn-primary float-end" type="button"><i class="bi bi-plus h5" style="color: #ffff"></i></button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script>
    $('#nipAuditee').change(function(){
        var nip = $(this).val();
        var tahun = $('#tahunperiode').val();
        var url = '{{ route("searchAuditee") }}';
        var url2 = '{{ route("searchAuditor") }}'
        console.log(tahun);

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response){
                
                if(response != null){
                    response.forEach(respon => {
                        if (respon.nip== nip) {
                            $('#user_id').val(respon.id);
                            $('#selectUnitKerja').val(respon.unit_kerja);
                            $('#ketuaAuditee').val(respon.name);
                            $('#jabatanKetuaAuditee').val(respon.jabatan);
                            
                        }
                    });
                    
                }
            }
        });
    });
</script>
<script>
    $('#tahunperiode').change(function(){
        var tahun = $(this).val();
        var url = '{{ route("searchAuditor") }}'
        console.log(tahun);

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response){
                
                if(response != null){
                    response.forEach(respon => {
                        if (respon.tahunperiode== tahun) {
                            $('#ketuaAuditor').append($('<option>', { 
                                value: respon.nama,
                                text : respon.nama, 
                            }));
                            $('#anggotaAuditor').append($('<option>', { 
                                value: respon.nama,
                                text : respon.nama, 
                            }));
                        }
                    });
                    
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
      var max_fields = 50;
      var wrapper = $("#anggotaauditor");
      var add_btn = $(".moreItems_add");
      var i = 1;
      $(add_btn).click(function(e){
        e.preventDefault();
        if (i < max_fields) {
          i++;
          $(wrapper).append('<div id="anggotaauditor" class="row mb-3 add-new"><div class="col-11"><label for="anggotaAuditor1" class="form-label">Anggota Auditor</label ><select class="form-control" id="anggotaAuditor1" placeholder="Masukkan nama Anggota Auditor" name="anggota_auditor" required ><option selected disabled>Pilih Auditor yang akan mengaudit</option></select></div><div class="col-1 my-4"><button class="btn btn-danger float-end my-1 remove-tr" type="button"><i class="bi bi-x p-0" style="color: #ffff"></i></button></div></div>')
        }
      });

      $(document).on('click', '.remove-tr', function(){  
        $(this).parents('.add-new').remove();
      });  
    });
  </script>
    
@endpush

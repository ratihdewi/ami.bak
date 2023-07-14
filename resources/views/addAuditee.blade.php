@extends('layout.main') @section('title') AMI - Tambah Auditee @endsection
@section('container')
<div class="row justify-content-center mb-5">
    <div class="col-8">
        <div class="card mt-5">
            <div class="card-body p-4">
                <form action="/insertAuditee" method="POST">
                    @csrf
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
                            @foreach ($auditor_ as $auditor)
                                <option value="{{ $auditor->nama }}">{{ $auditor->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
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
                            @foreach ($auditor_ as $auditor)
                                <option value="{{ $auditor->nama }}">{{ $auditor->nama }}</option>
                            @endforeach
                        </select>
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
    $('#selectUnitKerja').change(function(){
    var unitKerja = $(this).val();
    var url = '{{ route("searchAuditee") }}';
    
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function(response){
            
            if(response != null){
                response.forEach(respon => {
                    if (respon.unit_kerja == unitKerja) {
                        $('#ketuaAuditee').val(respon.name);
                        $('#jabatanKetuaAuditee').val(respon.jabatan);
                    }
                });
                
            }
        }
    });
});
</script>
    
@endpush

@extends('layout.main') @section('title') AMI - Tambah Auditee @endsection
@section('container')
<div class="row justify-content-center mb-5">
    <div class="col-8">
        <div class="card mt-5">
            <div class="card-body p-4">
                <form action="/updateAuditee/{{ $data->id }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tahunperiode" class="form-label">Tahun Periode</label>
                            <input type="number" name="tahunperiode" class="form-control" id="tahunperiode" placeholder="Tahun Periode" aria-label="Tahun Periode" min="2016" max="3000" value="{{ $data->tahunperiode }}"/>
                        </div> 
                        <div class="col">
                            <label for="nipAuditee" class="form-label">NIP</label> <br>
                            <select id="nipAuditee" class="form-select" name="nip" aria-label="Default select example" placeholder="Pilih NIP Ketua Auditee" required>
                                <option value="{{ $data->nip }}" selected>{{ $data->nip }}</option>
                            </select>
                        </div>           
                    </div>
                    <div class="row mb-3" hidden>
                        <div class="col">
                            <label for="user_id" class="form-label">ID User</label>
                            <input type="text" name="user_id" class="form-control" id="user_id" placeholder="ID User" aria-label="ID User" value="{{ $data->user_id }}"/>
                        </div>         
                    </div>
                    <div class="mb-3">
                        <label for="selectUnitKerja" class="form-label">Unit Kerja</label>
                        <select id="selectUnitKerja" class="form-select" name="unit_kerja" required>
                            <option selected value="{{ $data->unit_kerja }}">{{ $data->unit_kerja }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ketuaAuditee" class="form-label">Ketua Auditee</label>
                        <input type="text" class="form-control" id="ketuaAuditee" placeholder="Masukkan nama Ketua Auditee" name="ketua_auditee" value="{{ $data->ketua_auditee }}"/>
                    </div>
                    <div class="mb-3">
                        <label for="jabatanKetuaAuditee" class="form-label">Jabatan Ketua Auditee</label>
                        <input type="text" class="form-control" id="jabatanKetuaAuditee" placeholder="Masukkan jabatan Ketua Auditee" name="jabatan_ketua_auditee" value="{{ $data->jabatan_ketua_auditee }}"/>
                    </div>
                    <div class="mb-3">
                        <label for="ketuaAuditor" class="form-label">Ketua Auditor</label> <br>
                        <select class="form-select" aria-label="Default select example" id="ketuaAuditor" placeholder="Pilih ketua Auditor yang akan mengaudit" name="ketua_auditor" value="{{ $data->ketua_auditor }}">
                        <option value="{{ $data->ketua_auditor }}" selected>{{ $data->ketua_auditor }}</option> 
                        </select>
                    </div>
                    <div id="anggotaauditor" class="row mb-3">
                        <div class="col">
                            <label for="anggotaAuditor" class="form-label">Anggota Auditor 1</label> <br>
                            <select class="form-select" aria-label="Default select example" id="anggotaAuditor" placeholder="Masukkan nama Anggota Auditor" name="anggota_auditor" value="{{ $data->anggota_auditor }}">
                                <option value="{{ $data->anggota_auditor }}" selected>{{ $data->anggota_auditor }}</option> 
                            </select>
                        </div>
                    </div>
                    <div id="anggotaauditor2" class="row mb-3">
                        <div class="col">
                            <label for="anggotaAuditor2" class="form-label">Anggota Auditor 2 (Opsional)</label> <br>
                            <select class="form-select" aria-label="Default select example" id="anggotaAuditor2" placeholder="Masukkan nama Anggota Auditor" name="anggota_auditor2" value="{{ $data->anggota_auditor2 }}">
                                <option value="{{ $data->anggota_auditor2 }}" selected>{{ $data->anggota_auditor2 }}</option> 
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">
                        Simpan
                    </button>
                    <a href="{{ route('auditee', ['tahunperiode' => $data->tahunperiode]) }}">
                        <button type="button" class="btn btn-secondary me-3 float-start">Kembali</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        let tahun = $('#tahunperiode').val();
        let anggotaAuditor = $('#anggotaAuditor').val();
        let ketuaAuditor = $('#ketuaAuditor').val();
        console.log(anggotaAuditor);
        console.log(tahun);

        $.ajax({
            url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
            type: 'GET',
            dataType: 'json',
            data: { q: '' },
            success: function(data) {
                console.log(data);
                // $('#ketuaAuditor').empty();
                if (Array.isArray(data)) {
                    var mappedData = data.map(function(item) {
                        return {
                            id: item.nama,
                            text: item.nama,
                        };
                    });
                    var mappedData1 = data.map(function(item) {
                        if (item.nama != ketuaAuditor) {
                            return {
                                id: item.nama,
                                text: item.nama,
                            };
                        }
                    });
                    var mappedData2 = data.map(function(item) {
                        if (item.nama != ketuaAuditor && item.nama != anggotaAuditor) {
                            return {
                                id: item.nama,
                                text: item.nama,
                            };
                        }
                    });

                    $('#ketuaAuditor').select2({
                        data: mappedData,
                    });
                    $('#anggotaAuditor').select2({
                        data: mappedData1,
                    });
                    $('#anggotaAuditor2').select2({
                        data: mappedData2,
                    });
                } else {
                    console.error('Data yang diterima dari server bukan array yang valid.');
                }
            },
            error: function() {
            console.error('Terjadi kesalahan saat memuat data users.');
            }
        });

        $('#tahunperiode').change(function(){
            let tahun = $('#tahunperiode').val();
            console.log(tahun);

            $.ajax({
                url: "{{url('tambahauditee-searchnipuser')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    console.log(data);
                    // $('#nipAuditee').empty();
                    // $('#nipAuditee').append('<option value="" selected disabled>Pilih NIP Ketua Auditee</option>');
                    if (Array.isArray(data)) {
                        var mappedData = data.map(function(item) {
                            return {
                                id: item.nip,
                                text: item.nip,
                            };
                        });

                        $('#nipAuditee').select2({
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
        });

        $('#nipAuditee').change(function(){
            let nip = $('#nipAuditee').val();
            var url = "{{url('/tambahauditee-searchAuditee')}}/"+nip;

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    console.log(nip);
                    if(response != null){
                        response.forEach(respon => {
                            if (respon.nip == nip) {
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

        $('#tahunperiode').change(function(){
            let tahun = $('#tahunperiode').val();
            console.log(tahun);

            $.ajax({
                url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    console.log(data);
                    $('#ketuaAuditor').empty();
                    $('#ketuaAuditor').append('<option value="" selected disabled>Pilih NIP Ketua Auditee</option>');
                    if (Array.isArray(data)) {
                        var mappedData = data.map(function(item) {
                            return {
                                id: item.nama,
                                text: item.nama,
                            };
                        });

                        $('#ketuaAuditor').select2({
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
        });

        $('#ketuaAuditor').change(function(){
            let ketuaAuditor = $(this).val();
            let tahun = $('#tahunperiode').val();
            console.log(ketuaAuditor);
            console.log(tahun);

            $.ajax({
                url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    console.log(data);
                    $('#anggotaAuditor').empty();
                    $('#anggotaAuditor').append('<option value="" selected disabled>Pilih NIP Ketua Auditee</option>');
                    if (Array.isArray(data)) {
                        var mappedData = data.map(function(item) {
                            if (item.nama != ketuaAuditor ) {
                                return {
                                id: item.nama,
                                text: item.nama,
                                };
                            }
                        });
                        console.log(mappedData);
                        $('#anggotaAuditor').select2({
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
        })

        $('#anggotaAuditor').change(function(){
            let anggotaAuditor = $(this).val();
            let ketuaAuditor = $('#ketuaAuditor').val();
            let tahun = $('#tahunperiode').val();
            console.log(anggotaAuditor);
            console.log(tahun);

            $.ajax({
                url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    console.log(data);
                    $('#anggotaAuditor2').empty();
                    $('#anggotaAuditor2').append('<option value="" selected disabled>Pilih NIP Ketua Auditee</option>');
                    if (Array.isArray(data)) {
                        var mappedData = data.map(function(item) {
                            if (item.nama != anggotaAuditor && item.nama != ketuaAuditor ) {
                                return {
                                id: item.nama,
                                text: item.nama,
                                };
                            }
                        });
                        console.log(mappedData);
                        $('#anggotaAuditor2').select2({
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
        })
        
    });

    $(document).ready(function(){
        let tahun = $('#tahunperiode').val();

        $.ajax({
            url: "{{url('tambahauditee-searchnipuser')}}/"+ tahun,
            type: 'GET',
            dataType: 'json',
            data: { q: '' },
            success: function(data) {
                if (Array.isArray(data)) {
                    var mappedData = data.map(function(item) {
                        return {
                            id: item.nip,
                            text: item.nip,
                        };
                    });

                    $('#nipAuditee').select2({
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
    })
</script>
    
@endpush
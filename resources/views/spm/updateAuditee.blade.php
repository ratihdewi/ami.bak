@extends('layout.main') @section('title') AMI - Edit Auditee @endsection

@section('linking')
    <a href="/daftarAuditee-periode" class="mx-1">
        Periode Auditee
    </a>/

    <a href="/daftarAuditee/{{ $data->tahunperiode }}" class="mx-1">
        {{ $data->tahunperiode0 }}/{{ $data->tahunperiode }}
    </a>/

    <a href="/tampilAuditee/{{ $data->id }}" class="mx-1">
        Edit Auditee
    </a>/

@endsection

@section('container')
<div class="row justify-content-center mb-5">
    <div class="col-8 mt-3">
        <h5 class="text-center">Ubah Data Auditee</h5>
        <form action="/updateAuditee/{{ $data->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengubah data Auditee?')">
            @csrf
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="row">
                                <label for="tahunperiode" class="form-label"
                                        >Tahun Periode <span class="text-danger fw-bold">*</span></label
                                    >
                                <div class="col-sm-5">
                                    <input
                                        id="tahunperiode0"
                                        type="number"
                                        name="tahunperiode0"
                                        class="form-control"
                                        placeholder="Tahun Awal"
                                        aria-label="Tahun Awal"
                                        min="2016" max="3000"
                                        value="{{ $data->tahunperiode0 }}"
                                        readonly
                                        required
                                    />
                                </div>
                                <div class="col-sm-2 text-center">
                                    <h3 class="">/</h3>
                                </div>
                                <div class="col-sm-5">
                                    <input
                                        type="number"
                                        name="tahunperiode"
                                        class="form-control"
                                        id="tahunperiode"
                                        placeholder="Tahun Akhir"
                                        aria-label="Tahun Akhir"
                                        min="2016" max="3000"
                                        value="{{ $data->tahunperiode }}"
                                        readonly
                                        required
                                    />
                                </div>
                            </div>
                        </div> 
                        <div class="col">
                            <label for="nipAuditee" class="form-label">NIP <span class="text-danger fw-bold">*</span></label> <br>
                            <select id="nipAuditee" class="form-select" name="nip" aria-label="Default select example" placeholder="Pilih NIP Ketua Auditee" readonly required>
                                <option selected>{{ $data->nip }}</option>
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
                                value="{{ $data->user_id }}"
                            />
                        </div>         
                    </div>
                    <div class="mb-3">
                        <label for="ketuaAuditee" class="form-label"
                            >Ketua Auditee <span class="text-danger fw-bold">*</span></label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="ketuaAuditee"
                            placeholder="Masukkan nama Ketua Auditee"
                            name="ketua_auditee"
                            value="{{ $data->ketua_auditee }}"
                            readonly
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="selectUnitKerja" class="form-label"
                            >Unit Kerja <span class="text-danger fw-bold">*</span></label
                        >
                        <select
                            id="selectUnitKerja"
                            class="form-select"
                            name="unit_kerja"
                            required
                        >
                            <option value="{{ $data->unit_kerja }}" selected>{{ $data->unit_kerja }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jabatanKetuaAuditee" class="form-label"
                            >Jabatan Ketua Auditee <span class="text-danger fw-bold">*</span></label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="jabatanKetuaAuditee"
                            placeholder="Masukkan jabatan Ketua Auditee"
                            name="jabatan_ketua_auditee"
                            value="{{ $data->jabatan_ketua_auditee }}"
                            readonly
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" for="wakilKetuaAuditee" class="form-label"
                            >Wakil Ketua Auditee <span class="text-danger fw-bold">*</span></label
                        >
                        <select
                            id="wakilKetuaAuditee"
                            class="form-select"
                            name="wakil_ketua_auditee"
                        >
                        <option value="{{ $data->wakil_ketua_auditee }}" selected>{{ $data->wakil_ketua_auditee }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" for="anggota_auditeee" class="form-label"
                            >Anggota Auditee <span class="text-danger fw-bold">*</span></label
                        >
                        <select
                            id="anggota_auditeee"
                            class="form-select"
                            name="anggota_auditee[]"
                            multiple
                        >
                        @if (count($anggotaAuditees) > 0)
                            @foreach ($anggotaAuditees as $anggotaAuditee)
                                <option value="{{ $anggotaAuditee->anggota_auditee }}" selected>{{ $anggotaAuditee->anggota_auditee }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="ketuaAuditor" class="form-label">Ketua Auditor <span class="text-danger fw-bold">*</span></label> <br>
                                <select
                                    class="form-select" aria-label="Default select example"
                                    id="ketuaAuditor"
                                    placeholder="Pilih ketua Auditor yang akan mengaudit"
                                    name="ketua_auditor"
                                    value="{{ $data->ketua_auditor }}"
                                    required
                                >
                                <option selected>{{ $data->ketua_auditor }}</option> 
                                </select>
                            </div>
                            <div id="anggotaauditor" class="row mb-3">
                                <div class="col">
                                    <label for="anggotaAuditor" class="form-label">Anggota Auditor 1 <span class="text-danger fw-bold">*</span></label> <br>
                                    <select
                                        class="form-select" aria-label="Default select example"
                                        id="anggotaAuditor"
                                        placeholder="Masukkan nama Anggota Auditor"
                                        name="anggota_auditor"
                                        required
                                    >
                                    <option value="{{ $data->anggota_auditor }}" selected>{{ $data->anggota_auditor }}</option>
                                    </select>
                                </div>
                            </div>
                            <div id="anggotaauditor2" class="row mb-3">
                                <div class="col">
                                    <label for="anggotaAuditor2" class="form-label">Anggota Auditor 2 (Opsional)</label> <br>
                                    <select
                                        class="form-select" aria-label="Default select example"
                                        id="anggotaAuditor2"
                                        placeholder="Masukkan nama Anggota Auditor"
                                        name="anggota_auditor2"
                                    >
                                    @if ($data->anggota_auditor2 != NULL)
                                    <option value="{{ $data->anggota_auditor2 }}" selected>{{ $data->anggota_auditor2 }}</option>
                                    @else
                                    <option value="" selected>Pilih Anggota Auditor</option>
                                    @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button mt-3">
                <button type="submit" class="btn btn-primary float-end">
                    Simpan
                </button>
                <a href="{{ route('auditee', ['tahunperiode' => $data->tahunperiode]) }}">
                    <button type="button" class="btn btn-secondary me-3 float-end">Kembali</button>
                </a>
            </div>
        </form>
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
        let tahunAwal = $('#tahunperiode0').val();
        let anggotaAuditor = $('#anggotaAuditor').val();
        let ketuaAuditor = $('#ketuaAuditor').val();
        let nip = $('#nipAuditee').val();
        var url = "{{url('/tambahauditee-exsearchAuditee')}}";
        var wakilKetuaAuditee = $('#wakilKetuaAuditee').val();
        var ketuaAuditee = $('#ketuaAuditee').val();

        $('#wakil_ketua_auditee').select2({
            placeholder: 'Pilih Wakil Ketua Auditee',
            allowClear: true
        });

        $('#anggota_auditeee').select2({
            placeholder: 'Pilih Anggota Auditee',
            allowClear: true
        });
        $('#anggotaAuditor').select2({
            placeholder: 'Pilih Anggota Auditor',
            allowClear: true
        });
        $('#anggotaAuditor2').select2({
            placeholder: 'Pilih Anggota Auditor',
            allowClear: true
        });

        // $.ajax({
        //     url: url,
        //     type: 'get',
        //     dataType: 'json',
        //     success: function(response){
        //         if(response != null){
        //             response.users.forEach(respon => {
        //                 if (respon.nip == nip) {
        //                     $('#user_id').val(respon.id);
        //                     $('#ketuaAuditee').val(respon.name);

        //                     if (Array.isArray(response.unitkerjas)) {
        //                         var mappedData = [];

        //                         response.unitkerjas.forEach(function(item) {
        //                             if (item.id == respon.unitkerja_id) {
        //                                 mappedData.push({
        //                                     id: item.name,
        //                                     text: item.name,
        //                                 });
        //                             }
        //                             if (item.id == respon.unitkerja_id2) {
        //                                 mappedData.push({
        //                                     id: item.name,
        //                                     text: item.name,
        //                                 });
        //                             }
        //                             if (item.id == respon.unitkerja_id3) {
        //                                 mappedData.push({
        //                                     id: item.name,
        //                                     text: item.name,
        //                                 });
        //                             }
        //                         });

        //                         $('#selectUnitKerja').select2({
        //                             data: mappedData,
        //                         });
        //                     } else {
        //                         console.error('Data yang diterima dari server bukan array yang valid.');
        //                     }
        //                 }
        //             });
                    
        //         }
        //     }
        // });

        $.ajax({
            url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
            type: 'GET',
            dataType: 'json',
            data: { q: '' },
            success: function(data) {
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
                                text: item.nip + " - " + item.name,
                            };
                        });

                        $('#nipAuditee').select2({
                            data: mappedData,
                            templateSelection: function (selectedData) {
                                if (selectedData.id != '') {
                                    return selectedData.id;
                                } else {
                                    return "Pilih NIP Auditee";
                                }
                            },
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
            var url = "{{url('/tambahauditee-exsearchAuditee')}}";

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    if(response != null){
                        response.users.forEach(respon => {
                            if (respon.nip == nip) {
                                $('#user_id').val(respon.id);
                                $('#ketuaAuditee').val(respon.name);

                                $('#selectUnitKerja').empty();
                                $('#selectUnitKerja').append('<option value="" selected disabled>Pilih Unit Kerja</option>');
                                if (Array.isArray(response.unitkerjas)) {
                                    var mappedData = [];

                                    response.unitkerjas.forEach(function(item) {
                                        if (item.id == respon.unitkerja_id) {
                                            mappedData.push({
                                                id: item.name,
                                                text: item.name,
                                            });
                                        }
                                        if (item.id == respon.unitkerja_id2) {
                                            mappedData.push({
                                                id: item.name,
                                                text: item.name,
                                            });
                                        }
                                        if (item.id == respon.unitkerja_id3) {
                                            mappedData.push({
                                                id: item.name,
                                                text: item.name,
                                            });
                                        }
                                    });

                                    $('#selectUnitKerja').select2({
                                        data: mappedData,
                                    });
                                } else {
                                    console.error('Data yang diterima dari server bukan array yang valid.');
                                }
                            }
                        });
                        
                    }
                }
            });
        });

        $.ajax({
            url: "{{url('tambahauditee-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
            type: 'GET',
            dataType: 'json',
            data: { q: '' },
            success: function(data) {
                $('#wakilKetuaAuditee').append('<option value="">---Pilih Auditor---</option>');
                if (Array.isArray(data)) {
                    var filteredData = data.filter(function(item) {
                        return item.nip != nip;
                    });

                    var mappedData = filteredData.map(function(item) {
                        return {
                            id: item.name,
                            text: item.name,
                        };
                    });

                    $('#wakilKetuaAuditee').select2({
                        data: mappedData,
                        placeholder: 'Pilih Wakil Ketua Auditee',
                    });
                } else {
                    console.error('Data yang diterima dari server bukan array yang valid.');
                }
            },
            error: function() {
            console.error('Terjadi kesalahan saat memuat data users.');
            }
        });

        $.ajax({
            url: "{{url('tambahauditee-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
            type: 'GET',
            dataType: 'json',
            data: { q: '' },
            success: function(data) {
                if (Array.isArray(data)) {
                    var filteredData = data.filter(function(item) {
                        return item.name !== ketuaAuditee && item.name !== wakilKetuaAuditee;
                    });

                    var mappedData = filteredData.map(function(item) {
                        return {
                            id: item.name,
                            text: item.name,
                        };
                    });

                    $('#anggota_auditeee').select2({
                        data: mappedData,
                        placeholder: 'Pilih Anggota Auditee',
                    });
                } else {
                    console.error('Data yang diterima dari server bukan array yang valid.');
                }
            },
            error: function() {
            console.error('Terjadi kesalahan saat memuat data users.');
            }
        });

        $('#selectUnitKerja').change(function () {
            selectedIndex = $(this)[0].selectedIndex;
            var nip = $('#nipAuditee').val();
            var selectedUnitKerja = $(this).val();
            selectedUnitKerja = selectedUnitKerja.split(".");
            var selectedUser = $('#ketuaAuditee').val();
            var url = "{{url('/tambahauditee-exgetjabatan')}}/" + nip;

            console.log(selectedUnitKerja[0]);

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    if (Array.isArray(response.unitkerjas)) {
                        response.unitkerjas.forEach(function(item) {
                            if (item.name == selectedUnitKerja[0]) {
                                if (response.users.unitkerja_id == response.users.unitkerja_id2 || response.users.unitkerja_id == response.users.unitkerja_id3 || response.users.unitkerja_id2 == response.users.unitkerja_id3) {
                                    if (item.id == response.users.unitkerja_id && selectedIndex == 1) {
                                        $('#jabatanKetuaAuditee').val(response.users.jabatan);
                                    } else if (item.id == response.users.unitkerja_id2 && selectedIndex == 2) {
                                        $('#jabatanKetuaAuditee').val(response.users.jabatan2);
                                    } else if (item.id == response.users.unitkerja_id3 && selectedIndex == 3) {
                                        $('#jabatanKetuaAuditee').val(response.users.jabatan3);
                                    }
                                } else {
                                    if (item.id == response.users.unitkerja_id) {
                                        $('#jabatanKetuaAuditee').val(response.users.jabatan);
                                    } else if (item.id == response.users.unitkerja_id2) {
                                        $('#jabatanKetuaAuditee').val(response.users.jabatan2);
                                    } else if (item.id == response.users.unitkerja_id3) {
                                        $('#jabatanKetuaAuditee').val(response.users.jabatan3);
                                    }
                                }
                            }
                        });
                    } else {
                        console.error('Data yang diterima dari server bukan array yang valid.');
                    }
                }
            });
        });

        $('#wakilKetuaAuditee').change(function () {
            var wakilKetuaAuditee = $('#wakilKetuaAuditee').val();
            var ketuaAuditee = $('#ketuaAuditee').val();

            $.ajax({
                url: "{{url('tambahauditee-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    $('#anggota_auditeee').empty();
                    if (Array.isArray(data)) {
                        var filteredData = data.filter(function(item) {
                            return item.name != ketuaAuditee && item.name != wakilKetuaAuditee;
                        });
                        
                        var mappedData = filteredData.map(function(item) {
                            return {
                                id: item.name,
                                text: item.name,
                            };
                        });

                        $('#anggota_auditeee').select2({
                            data: mappedData,
                            placeholder: 'Pilih Anggota Auditee',
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

        $('#tahunperiode').change(function(){
            let tahun = $('#tahunperiode').val();

            $.ajax({
                url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    $('#ketuaAuditor').empty();
                    $('#ketuaAuditor').append('<option value="" selected>Pilih Ketua Auditor</option>');
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

            $.ajax({
                url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    $('#anggotaAuditor').empty();
                    $('#anggotaAuditor').append('<option value="" selected>Pilih NIP Ketua Auditee</option>');
                    if (Array.isArray(data)) {
                        var filteredData = data.filter(function(item) {
                            return item.nama != ketuaAuditor;
                        });

                        var mappedData = filteredData.map(function(item) {
                            return {
                                id: item.nama,
                                text: item.nama,
                            };
                        });
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

            $.ajax({
                url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    $('#anggotaAuditor2').empty();
                    $('#anggotaAuditor2').append('<option value="" selected>Pilih NIP Ketua Auditee</option>');
                    if (Array.isArray(data)) {
                        var filteredData = data.filter(function(item) {
                            return item.nama != anggotaAuditor && item.nama != ketuaAuditor;
                        });

                        var mappedData = filteredData.map(function(item) {
                            return {
                                id: item.nama,
                                text: item.nama,
                            };
                        });
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
        let tahunAwal = $('#tahunperiode0').val();
        let tahun = $('#tahunperiode').val();
        let nip = $('#nipAuditee').val();

        $.ajax({
            url: "{{url('tambahauditee-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
            type: 'GET',
            dataType: 'json',
            data: { q: '' },
            success: function(data) {
                if (Array.isArray(data)) {
                    var mappedData = data.map(function(item) {
                        return {
                            id: item.nip,
                            text: item.nip + " - " + item.name,
                        };
                    });

                    $('#nipAuditee').select2({
                        data: mappedData,
                        templateSelection: function (selectedData) {
                            if (selectedData.id != '') {
                                return selectedData.id;
                            } else {
                                return "Pilih NIP Auditee";
                            }
                        },
                    });
                } else {
                    console.error('Data yang diterima dari server bukan array yang valid.');
                }
            },
            error: function() {
            console.error('Terjadi kesalahan saat memuat data users.');
            }
        });

        $.ajax({
            url: '/tambahauditee-exsearchAuditee',
            type: 'get',
            dataType: 'json',
            success: function(response){
                if(response != null){
                    response.users.forEach(respon => {
                        if (respon.nip == nip) {
                            $('#user_id').val(respon.id);
                            $('#ketuaAuditee').val(respon.name);

                            if (Array.isArray(response.unitkerjas)) {
                                var mappedData = [];
                                response.unitkerjas.forEach(function(item) {
                                    if (item.id == respon.unitkerja_id) {
                                        mappedData.push({
                                            id: item.name,
                                            text: item.name,
                                        });
                                    }
                                    if (item.id == respon.unitkerja_id2) {
                                        mappedData.push({
                                            id: item.name,
                                            text: item.name,
                                        });
                                    }
                                    if (item.id == respon.unitkerja_id3) {
                                        mappedData.push({
                                            id: item.name,
                                            text: item.name,
                                        });
                                    }
                                });

                                console.log(mappedData);
                                if (mappedData.length == 3) {
                                    if (mappedData[0].text == mappedData[1].text || mappedData[0].text == mappedData[2].text || mappedData[1].text == mappedData[2].text) {
                                        $('#selectUnitKerja').select2({
                                            data: [
                                                mappedData[0].text + ".",
                                                mappedData[1].text + ".",
                                                mappedData[2].text + ".",
                                            ],
                                            templateSelection: function (selectedData) {
                                                console.log(selectedData);
                                                if (selectedData.id != '') {
                                                    return selectedData.id;
                                                } else {
                                                    return "Pilih NIP Auditee";
                                                }
                                            },
                                        });
                                    } else {
                                        $('#selectUnitKerja').select2({
                                            data: mappedData,
                                        });
                                    }
                                } else if (mappedData.length == 2) {
                                    if (mappedData[0].text == mappedData[1].text) {
                                        $('#selectUnitKerja').select2({
                                            data: [
                                                mappedData[0].text + ".",
                                                mappedData[1].text + ".",
                                            ],
                                            templateSelection: function (selectedData) {
                                                selectedData = selectedData.id;
                                                selectedData = selectedData.split(".");
                                                return selectedData[0];
                                            },
                                        });
                                    } else {
                                        $('#selectUnitKerja').select2({
                                            data: mappedData,
                                        });
                                    }
                                } else {
                                    $('#selectUnitKerja').select2({
                                        data: mappedData,
                                    });
                                }
                            } else {
                                console.error('Data yang diterima dari server bukan array yang valid.');
                            }
                        }
                    });
                    
                }
            }
        });
    })
</script>
    
@endpush
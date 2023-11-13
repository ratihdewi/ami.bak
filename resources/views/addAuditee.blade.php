@extends('layout.main') @section('title') AMI - Tambah Auditee @endsection

@section('linking')
    <a href="/daftarAuditee-periode" class="mx-1">
        Periode Auditee
    </a>/
{{-- 
    <a href="/daftarAuditee/{{ $tahunperiode->tahunperiode }}" class="mx-1">
        {{ $tahunperiode->tahunperiode0 }}/{{ $tahunperiode->tahunperiode }}
    </a>/ --}}

    <a href="/addAuditee/{{ $periode->tahunperiode1 }}/{{ $periode->tahunperiode2 }}" class="mx-1">
        Tambah Auditee
    </a>/

@endsection

@section('container')
<div class="row justify-content-center mb-5">
    <div class="col-8 mt-3">
        <h5 class="text-center">Tambah Auditee</h5>
        <form action="/insertAuditee" method="POST">
            @csrf
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="row">
                                <label class="fw-semibold" for="tahunperiode" class="form-label"
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
                                        min="2016"
                                        value="{{ $periode->tahunperiode1 }}"
                                        oninput="validateInput()"
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
                                        min="2017"
                                        value="{{ $periode->tahunperiode2 }}"
                                        onchange="validateChange()"
                                        readonly
                                        required
                                    />
                                </div>
                            </div>
                            <p id="validationMessage" style="color: red; font-size: 10px;"></p>
                        </div> 
                        <div class="col">
                            <label class="fw-semibold" for="nipAuditee" class="form-label">NIP <span class="text-danger fw-bold">*</span></label> <br>
                            <select id="nipAuditee" class="form-select" name="nip" aria-label="Default select example" placeholder="Pilih NIP Ketua Auditee" required>
                                <option value="" selected disabled>Pilih NIP Ketua Auditee</option>
                            </select>
                        </div>           
                    </div>
                    <div class="row mb-3" hidden>
                        <div class="col">
                            <label class="fw-semibold" for="user_id" class="form-label"
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
                        <label class="fw-semibold" for="ketuaAuditee" class="form-label"
                            >Ketua Auditee <span class="text-danger fw-bold">*</span></label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="ketuaAuditee"
                            placeholder="Masukkan nama Ketua Auditee"
                            name="ketua_auditee"
                            required
                            readonly
                        />
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" for="selectUnitKerja" class="form-label"
                            >Unit Kerja <span class="text-danger fw-bold">*</span></label
                        >
                        <select
                            id="selectUnitKerja"
                            class="form-select"
                            name="unit_kerja"
                            required
                        >
                            <option selected disabled>Pilih unit kerja yang akan diaudit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" for="jabatanKetuaAuditee" class="form-label"
                            >Jabatan Ketua Auditee <span class="text-danger fw-bold">*</span></label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="jabatanKetuaAuditee"
                            placeholder="Masukkan jabatan Ketua Auditee"
                            name="jabatan_ketua_auditee"
                            required
                            readonly
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
                        <option value="" selected disabled>Pilih Wakil Ketua Auditee</option>
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
                        </select>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="fw-semibold" for="ketuaAuditor" class="form-label">Ketua Auditor <span class="text-danger fw-bold">*</span></label> <br>
                                <select
                                    class="form-select" aria-label="Default select example"
                                    id="ketuaAuditor"
                                    placeholder="Pilih ketua Auditor yang akan mengaudit"
                                    name="ketua_auditor"
                                    required
                                >
                                <option selected disabled>Pilih Ketua Auditor</option> 
                                </select>
                            </div>
                            <div id="anggotaauditor" class="row mb-3">
                                <div class="col">
                                    <label class="fw-semibold" for="anggotaAuditor" class="form-label">Anggota Auditor 1 <span class="text-danger fw-bold">*</span></label> <br>
                                    <select
                                        class="form-select" aria-label="Default select example"
                                        id="anggotaAuditor"
                                        placeholder="Masukkan nama Anggota Auditor"
                                        name="anggota_auditor"
                                        required
                                    >
                                    </select>
                                </div>
                            </div>
                            <div id="anggotaauditor2" class="row mb-3">
                                <div class="col">
                                    <label class="fw-semibold" for="anggotaAuditor2" class="form-label">Anggota Auditor 2 (Opsional)</label> <br>
                                    <select
                                        class="form-select" aria-label="Default select example"
                                        id="anggotaAuditor2"
                                        placeholder="Masukkan nama Anggota Auditor"
                                        name="anggota_auditor2"
                                    >
                                        
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
                <a href="/daftarAuditee/{{$periode->tahunperiode2}}">
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
        var i = 1;
        var tahunAwal = $('#tahunperiode0').val();
        var tahunAkhir = $('#tahunperiode').val();
        var wrapper = $('#anggotaAuditeeParent');
        var max_fields = 400;
        $('#anggota_auditeee').select2({
            placeholder: 'Pilih Anggota Auditor',
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

        fillNipAuditorOptions(tahunAkhir);

        $('#tahunperiode0').change(function () {
            let tahunAwal = parseInt($('#tahunperiode0').val());
            $('#tahunperiode').val(tahunAwal + 1);
            
            fillNipAuditorOptions(tahunAwal + 1);
        });

        $('#tahunperiode').change(function () {
            let tahun = $(this).val();
            $('#tahunperiode0').val(tahun - 1);
            
            fillNipAuditorOptions(tahun);
        });

        var mappedUnitKerja;
        var selectedIndex;

        $('#nipAuditee').change(function(){
            let nip = $('#nipAuditee').val();
            var url = "{{url('/tambahauditee-exsearchAuditee')}}";

            console.log(ketuaAuditee);

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
                                    mappedUnitKerja = [];

                                    response.unitkerjas.forEach(function(item) {
                                        if (item.id == respon.unitkerja_id) {
                                            mappedUnitKerja.push({
                                                id: item.name,
                                                text: item.name,
                                            });
                                        }
                                        if (item.id == respon.unitkerja_id2) {
                                            mappedUnitKerja.push({
                                                id: item.name,
                                                text: item.name,
                                            });
                                        }
                                        if (item.id == respon.unitkerja_id3) {
                                            mappedUnitKerja.push({
                                                id: item.name,
                                                text: item.name,
                                            });
                                        }
                                    });
                                    console.log(mappedUnitKerja);

                                    $('#selectUnitKerja').select2({
                                        data: mappedUnitKerja,
                                    });
                                } else {
                                    console.error('Data yang diterima dari server bukan array yang valid.');
                                }

                                timauditor(tahunAkhir);
                            }
                        });
                        
                    }
                }
            });
            
            $.ajax({
                url: "{{url('tambahauditee-searchnipuser')}}/"+ tahunAwal + "/" + tahunAkhir,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    $('#wakilKetuaAuditee').empty();
                    $('#wakilKetuaAuditee').append('<option value="" selected>Pilih Wakil Ketua Auditee</option>');
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

        $('#selectUnitKerja').change(function () {
            selectedIndex = $(this)[0].selectedIndex;
            var nip = $('#nipAuditee').val();
            var selectedUnitKerja = $(this).val();
            var selectedUser = $('#ketuaAuditee').val();
            var url = "{{url('/tambahauditee-exgetjabatan')}}/" + nip;

            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    if (Array.isArray(response.unitkerjas)) {
                        response.unitkerjas.forEach(function(item) {
                            if (item.name == selectedUnitKerja) {
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
                url: "{{url('tambahauditee-searchnipuser')}}/"+ tahunAwal + "/" + tahunAkhir,
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
                            placeholder: "-- Pilih Anggota Auditee --"
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

        function timauditor(tahun)
        {
            var namaauditee = $('#ketuaAuditee').val();

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
                            if (item.nama != namaauditee) {
                                return {
                                    id: item.nama,
                                    text: item.nama,
                                };
                            }  else {
                                return {
                                    hidden: true,
                                };
                            }
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
        }

        function fillNipAuditorOptions(tahun) {
            let tahunAwal = $('#tahunperiode0').val();
            let maxValue = parseInt($('#tahunperiode0').attr('max'));
            let minValue = parseInt($('#tahunperiode0').attr('min'));
            tahunAwal = parseInt(tahunAwal);

            let minvalue = $('#tahunperiode').attr('min', tahunAwal+1);

            minvalue = parseInt($('#tahunperiode').attr('min'));
            maxvalue = parseInt($('#tahunperiode').attr('max'));

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

            if ((tahun > minValue)) {
                $.ajax({
                    url: "{{url('tambahauditee-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
                    type: 'GET',
                    dataType: 'json',
                    data: { q: '' },
                    success: function(data) {
                        $('#nipAuditee').empty();
                        $('#nipAuditee').append('<option value="" selected disabled>Pilih NIP Auditee</option>');
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
                
            } else {
                $.ajax({
                    url: "{{url('/tambahauditee-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
                    type: 'GET',
                    dataType: 'json',
                    data: { q: '' },
                    success: function(data) {
                        console.log(tahunAwal);
                        console.log(tahun);
                        $('#nipAuditee').empty();
                        $('#nipAuditee').append('<option value="" selected disabled>Pilih NIP Ketua Auditee</option>');
                        if (Array.isArray(data)) {
                            $('#nipAuditee').select2();
                        } else {
                            console.error('Data yang diterima dari server bukan array yang valid.');
                        }
                    },
                    error: function() {
                    console.error('Terjadi kesalahan saat memuat data users.');
                    }
                });
            }
        }

        $('#ketuaAuditor').change(function(){
            let ketuaAuditor = $(this).val();
            let tahun = $('#tahunperiode').val();
            var namaauditee = $('#ketuaAuditee').val();

            $.ajax({
                url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    console.log(data);
                    $('#anggotaAuditor').empty();
                    $('#anggotaAuditor').append('<option value="" selected disabled>Pilih Anggota Auditor</option>');
                    if (Array.isArray(data)) {
                        var filteredData = data.filter(function(item) {
                            return item.nama != ketuaAuditor && item.nama != namaauditee;
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
            var namaauditee = $('#ketuaAuditee').val();
            let tahun = $('#tahunperiode').val();
            console.log(anggotaAuditor);
            console.log(tahun);

            $.ajax({
                url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    $('#anggotaAuditor2').empty();
                    $('#anggotaAuditor2').append('<option value="" selected disabled>Pilih Anggota Auditor</option>');
                    if (Array.isArray(data)) {
                        var filteredData = data.filter(function(item) {
                            return item.nama != anggotaAuditor && item.nama != ketuaAuditor && item.nama != namaauditee;
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

    function validateInput() {
        minValue = parseInt($('#tahunperiode0').attr('min'));
        maxValue = parseInt($('#tahunperiode0').attr('max'));
        // console.log(maxValue);

        let inputElement = document.getElementById('tahunperiode0');
        let validationMessageElement = document.getElementById('validationMessage');

        // Dapatkan nilai input
        let inputValue = parseInt(inputElement.value);

        console.log('0 : ' + inputValue);

        // Validasi input
        if (isNaN(inputValue)) {
            validationMessageElement.textContent = "Input bukan angka. Silakan masukkan angka.";
        } else if ((inputValue < minValue)) {
            validationMessageElement.textContent = "Harap masukkan tahun periode dengan benar!";
            validationMessageElement.style.marginTop = '5px';
        } else {
            validationMessageElement.textContent = ""; // Hapus pesan validasi jika input valid
        }
    }

    function validateChange() {
        let inputElement = document.getElementById('tahunperiode');
        let validationMessageElement = document.getElementById('validationMessage');

        // Dapatkan nilai input
        let inputValue = parseInt(inputElement.value);
        
        let currentYear = {{ $currentYear; }};
        console.log(currentYear);

        let minValue = $('#tahunperiode').attr('min', 2016);
        let maxValue = $('#tahunperiode').attr('max', currentYear);

        minValue = parseInt($('#tahunperiode').attr('min'));
        maxValue = parseInt($('#tahunperiode').attr('max'));

        console.log('0 : ' + inputValue);

        // Validasi input
        if (isNaN(inputValue)) {
            validationMessageElement.textContent = "Input bukan angka. Silakan masukkan angka.";
        } else if ((inputValue < minValue)) {
            console.log('gagal');
            validationMessageElement.textContent = "Harap masukkan tahun periode dengan benar!";
            validationMessageElement.style.marginTop = '5px';
        } else {
            validationMessageElement.textContent = "";
        }
    }
</script>
    
@endpush

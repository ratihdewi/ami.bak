@extends('layout.main') @section('title') AMI - Tambah Auditee @endsection

@section('linking')
    <a href="/daftarAuditee-periode" class="mx-1">
        Periode Auditee
    </a>/
{{-- 
    <a href="/daftarAuditee/{{ $tahunperiode->tahunperiode }}" class="mx-1">
        {{ $tahunperiode->tahunperiode0 }}/{{ $tahunperiode->tahunperiode }}
    </a>/ --}}

    <a href="/addAuditee" class="mx-1">
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
                                        min="2016" max="{{ $currentYear-1 }}"
                                        oninput="validateInput()"
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
                                        min="2016" max="{{ $currentYear }}"
                                        onchange="validateChange()"
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
                        <label class="fw-semibold" for="selectUnitKerja" class="form-label"
                            >Unit Kerja <span class="text-danger fw-bold">*</span></label
                        >
                        <input type="text" class="form-control" id="selectUnitKerja" placeholder="Unit Kerja" name="unit_kerja" required readonly>
                        {{-- <select
                            id="selectUnitKerja"
                            class="form-select"
                            name="unit_kerja"
                            required
                        >
                            <option selected disabled>Pilih unit kerja yang akan diaudit</option>
                            @foreach ($unitkerjas as $unitkerja)
                                <option value="{{ $unitkerja->id }}">{{ $unitkerja->name }}</option>
                            @endforeach
                        </select> --}}
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
            <div class="button mt-3">
                <button type="submit" class="btn btn-primary float-end">
                    Simpan
                </button>
                <a href="{{ route('auditee-periode') }}">
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

        // $('#tahunperiode').change(function(){
        //     let tahun = $('#tahunperiode').val();
        //     console.log(tahun);

        //     $.ajax({
        //         url: "{{url('tambahauditee-searchnipuser')}}/"+ tahun,
        //         type: 'GET',
        //         dataType: 'json',
        //         data: { q: '' },
        //         success: function(data) {
        //             console.log(data);
        //             $('#nipAuditee').empty();
        //             $('#nipAuditee').append('<option value="" selected disabled>Pilih NIP Ketua Auditee</option>');
        //             if (Array.isArray(data)) {
        //                 var mappedData = data.map(function(item) {
        //                     return {
        //                         id: item.nip,
        //                         text: item.nip,
        //                     };
        //                 });

        //                 $('#nipAuditee').select2({
        //                     data: mappedData,
        //                 });
        //             } else {
        //                 console.error('Data yang diterima dari server bukan array yang valid.');
        //             }
        //         },
        //         error: function() {
        //         console.error('Terjadi kesalahan saat memuat data users.');
        //         }
        //     });
        // });

        $('#tahunperiode0').change(function () {
            let tahunAwal = parseInt($('#tahunperiode0').val());
            $('#tahunperiode').val(tahunAwal + 1);
            
            // Memanggil fungsi untuk mengisi opsi NIP auditor
            fillNipAuditorOptions(tahunAwal + 1);
        });

        $('#tahunperiode').change(function () {
            let tahun = $(this).val();
            $('#tahunperiode0').val(tahun - 1);
            
            fillNipAuditorOptions(tahun);
        });

        function fillNipAuditorOptions(tahun) {
            console.log('Berhasil');
            let tahunAwal = $('#tahunperiode0').val();
            let maxValue = parseInt($('#tahunperiode0').attr('max'));
            let minValue = parseInt($('#tahunperiode0').attr('min'));
            tahunAwal = parseInt(tahunAwal);

            let minvalue = $('#tahunperiode').attr('min', tahunAwal+1);
            let maxvalue = $('#tahunperiode').attr('max', tahunAwal+1);

            minvalue = parseInt($('#tahunperiode').attr('min'));
            maxvalue = parseInt($('#tahunperiode').attr('max'));

            // let tahun = $('#tahunperiode').val();
            console.log('max th 0 :' + maxvalue);
            console.log(tahunAwal);
            console.log(tahun);

            $.ajax({
                url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    console.log(data);
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

            if ((tahun > minValue && tahun <= maxvalue)) {
                console.log('Gagal');
                $.ajax({
                    url: "{{url('tambahauditee-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
                    type: 'GET',
                    dataType: 'json',
                    data: { q: '' },
                    success: function(data) {
                        console.log(data);
                        $('#nipAuditee').empty();
                        $('#nipAuditee').append('<option value="" selected disabled>Pilih NIP Ketua Auditee</option>');
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

        // $('#tahunperiode').change(function () {
        //     console.log('Berhasil');
        //     let tahunAwal = $('#tahunperiode0').val();
        //     tahunAwal = parseInt(tahunAwal);

        //     let minvalue = $('#tahunperiode').attr('min', tahunAwal+1);
        //     let maxvalue = $('#tahunperiode').attr('max', tahunAwal+1);

        //     minvalue = parseInt($('#tahunperiode').attr('min'));
        //     maxvalue = parseInt($('#tahunperiode').attr('max'));

        //     let tahun = $('#tahunperiode').val();
        //     console.log(tahunAwal);
        //     console.log(tahun);

        //     if (tahun < minvalue || tahun > maxvalue) {
        //         console.log('Gagal');
        //         $.ajax({
        //             url: "{{url('tambahauditee-searchnipuser')}}/"+ tahun,
        //             type: 'GET',
        //             dataType: 'json',
        //             data: { q: '' },
        //             success: function(data) {
        //                 $('#nipAuditee').empty();
        //                 $('#nipAuditee').append('<option value="" selected disabled>Pilih NIP Ketua Auditee</option>');
        //                 if (Array.isArray(data)) {
        //                     $('#nipAuditee').select2();
        //                 } else {
        //                     console.error('Data yang diterima dari server bukan array yang valid.');
        //                 }
        //             },
        //             error: function() {
        //             console.error('Terjadi kesalahan saat memuat data users.');
        //             }
        //         });
        //     } else {
        //         $.ajax({
        //             url: "{{url('tambahauditee-searchnipuser')}}/"+ tahun,
        //             type: 'GET',
        //             dataType: 'json',
        //             data: { q: '' },
        //             success: function(data) {
        //                 console.log(data);
        //                 $('#nipAuditee').empty();
        //                 $('#nipAuditee').append('<option value="" selected disabled>Pilih NIP Ketua Auditee</option>');
        //                 if (Array.isArray(data)) {
        //                     var mappedData = data.map(function(item) {
        //                         return {
        //                             id: item.nip,
        //                             text: item.nip,
        //                         };
        //                     });

        //                     $('#nipAuditee').select2({
        //                         data: mappedData,
        //                     });
        //                 } else {
        //                     console.error('Data yang diterima dari server bukan array yang valid.');
        //                 }
        //             },
        //             error: function() {
        //             console.error('Terjadi kesalahan saat memuat data users.');
        //             }
        //         });
        //     }
        // });

        $('#nipAuditee').change(function(){
            let nip = $('#nipAuditee').val();
            var url = "{{url('/tambahauditee-searchAuditee')}}";

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

                                var unitKerja = respon.unitkerja;

                                $('#selectUnitKerja').val(unitKerja.name);
                                $('#ketuaAuditee').val(respon.name);
                                $('#jabatanKetuaAuditee').val(respon.jabatan);
                            }
                        });
                        
                    }
                }
            });
        });

        // $('#tahunperiode').change(function(){
        //     let tahun = $('#tahunperiode').val();
        //     console.log(tahun);

        //     $.ajax({
        //         url: "{{url('/tambahauditee-searchAuditor')}}/"+ tahun,
        //         type: 'GET',
        //         dataType: 'json',
        //         data: { q: '' },
        //         success: function(data) {
        //             console.log(data);
        //             $('#ketuaAuditor').empty();
        //             $('#ketuaAuditor').append('<option value="" selected>Pilih Ketua Auditor</option>');
        //             if (Array.isArray(data)) {
        //                 var mappedData = data.map(function(item) {
        //                     return {
        //                         id: item.nama,
        //                         text: item.nama,
        //                     };
        //                 });

        //                 $('#ketuaAuditor').select2({
        //                     data: mappedData,
        //                 });
        //             } else {
        //                 console.error('Data yang diterima dari server bukan array yang valid.');
        //             }
        //         },
        //         error: function() {
        //         console.error('Terjadi kesalahan saat memuat data users.');
        //         }
        //     });
        // });

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
                    $('#anggotaAuditor').append('<option value="" selected disabled>Pilih Anggota Auditor</option>');
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
                    $('#anggotaAuditor2').append('<option value="" selected disabled>Pilih Anggota Auditor</option>');
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
        } else if ((inputValue < minValue || inputValue > maxValue)) {
            validationMessageElement.textContent = "Harap masukkan tahun periode antara " + minValue + " dan " + 2023 + ".";
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
        } else if ((inputValue < minValue || inputValue > maxValue)) {
            console.log('gagal');
            validationMessageElement.textContent = "Harap masukkan tahun periode antara " + minValue + " dan " + maxValue + ".";
            validationMessageElement.style.marginTop = '5px';
        } else {
            validationMessageElement.textContent = ""; // Hapus pesan validasi jika input valid
        }
    }
</script>

{{-- <script>
    $('#nipAuditee').change(function(){
        var nip = $(this).val();
        var tahun = $('#tahunperiode').val();
        var url = '{{ route("searchAuditee") }}';
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
    var selectpickernip = $('#nipAuditee');
    
    $('#tahunperiode').on("change", function(){
        var tahun = $(this).val();
        getnip(tahun);
        console.log(tahun);
        var url = '{{ route("searchAuditor") }}';
        
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response){
                
                if(response != null){
                    var daftarauditors = [];
                    var selectpicker1 = $('#ketuaAuditor');
                    var selectpicker2 = $('#anggotaAuditor');
                    var selectpicker3 = $('#anggotaAuditor2');

                    selectpicker1.html('');
                    selectpicker2.html('');
                    selectpicker3.html('');

                    response.forEach(respon => {
                        if (respon.tahunperiode == tahun) {
                            // var options = [
                            //     { value: respon.nama, text: respon.nama },
                            // ];
                            selectpicker1.append($('<option>', { 
                                value: respon.nama,
                                text : respon.nama, 
                            }));
                            selectpicker2.append($('<option>', { 
                                value: respon.nama,
                                text : respon.nama, 
                            }));
                            selectpicker3.append($('<option>', { 
                                value: respon.nama,
                                text : respon.nama, 
                            }));

                            // daftarauditors = daftarauditors.concat(options);
                        }
                    });
                    console.log(daftarauditors);
                    // var selectpicker1 = $('#ketuaAuditor');
                    // var selectpicker2 = $('#anggotaAuditor');
                    // var selectpicker3 = $('#anggotaAuditor2');

                    // selectpicker1.empty();
                    // selectpicker2.empty();
                    // selectpicker3.empty();

                    // $.each(daftarauditors, function(index, daftarauditor) {
                    //     daftarauditors = daftarauditors.filter(daftarauditor => !daftarauditors.some(existingOption => existingOption.value === daftarauditor.value));
                    //     selectpicker1.append('<option value="' + daftarauditor.value + '">' + daftarauditor.text + '</option>');
                    //     selectpicker2.append('<option value="' + daftarauditor.value + '">' + daftarauditor.text + '</option>');
                    //     selectpicker3.append('<option value="' + daftarauditor.value + '">' + daftarauditor.text + '</option>');
                    // });

                    selectpicker1.selectpicker('refresh');
                    selectpicker2.selectpicker('refresh');
                    selectpicker3.selectpicker('refresh');
                }
            }
        });   
    });

    function getnip(tahun) {
        var urlnip = '{{ route("searchnipuser") }}';
        $.ajax({
            url: urlnip,
            type: 'get',
            dataType: 'json',
            success: function(response){
                if(response != null){
                    var nipusers = [];

                    console.log(nipusers.length, 'ganti');

                    response.users.forEach(user =>  {
                        var isDifferentAuditor = true;

                        response.auditors.forEach(auditor => {
                            if (auditor.tahunperiode == tahun && auditor.user_id == user.id) {
                                isDifferentAuditor = false;
                            }
                        });

                        if (isDifferentAuditor) {
                            var isDifferentAuditee = true;

                            response.auditees.forEach(auditee => {
                                if (auditee.tahunperiode == tahun && auditee.user_id == user.id) {
                                    isDifferentAuditee = false;
                                }
                            });

                            if (isDifferentAuditee) {
                                var availableuser = [
                                    { value: user.nip, text: user.nip },
                                ];

                                nipusers = nipusers.concat(availableuser);
                            }
                        }
                    });
                    console.log(nipusers);
                    $('#nipAuditee').empty();
                    var list = '';

                    for (var i = 0; i < nipusers.length; i++) {
                        nipusers = nipusers.filter(daftarauditor => !nipusers.some(existingOption => existingOption.value === nipusers.value));
                        $('#nipAuditee').append('<option value="' + nipusers[i].value + '">' + nipusers[i].text + '</option>');
                        console.log(i);
                    };
                    $('#nipAuditee').selectpicker('refresh');
                }
            }
        });
    }
</script> --}}
    
@endpush

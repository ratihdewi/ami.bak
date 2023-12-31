@extends('layout.main') 

@section('title') AMI - Update Auditor @endsection

@section('linking')
<a href="/daftarAuditor-periode" class="mx-1">
    Periode Auditor
</a>/

<a href="/daftarAuditor/{{ $data->tahunperiode }}" class="mx-1">
    {{ $data->tahunperiode0 }}/{{ $data->tahunperiode }}
</a>/

<a href="/tampilAuditor/{{ $data->id }}" class="mx-1">
    Edit Auditor
</a>/

@endsection

@section('container')
    <div class="container mt-3 mb-3 vh-100">
        <div class="row justify-content-center">
            <div class="col-8">
                <h5 class="text-center mb-3">Ubah Data Auditor</h5>
                <form id="addForm" action="/updateAuditor/{{ $data->id }}" method="POST">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-body p-4">
                            <div class="addauditor">
                                <div class="row mb-3">
                                    <div class="col" hidden>
                                        <label for="user_id" class="form-label">ID User</label>
                                        <input type="text" name="user_id" class="form-control" id="user_id" placeholder="ID User" aria-label="ID User" value="{{ $data->user_id }}"/>
                                    </div>         
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <label for="tahunperiode" class="form-label fw-semibold">Tahun Periode <span class="text-danger fw-bold">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="number" id="tahunperiode0" name="tahunperiode0" class="form-control" placeholder="Tahun Awal" min="2016" max="{{ $currentYear }}" aria-label="Tahun Akhir" value="{{ $data->tahunperiode0 }}" oninput="validateInput()" required readonly/>
                                            </div>
                                            <div class="col-sm-2 text-center">
                                                <h3 class="">/</h3>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="number" name="tahunperiode" class="form-control" id="tahunperiode" placeholder="Tahun Akhir" aria-label="Tahun Akhir" value="{{ $data->tahunperiode }}" onchange="validateChange()" required readonly/>
                                            </div>
                                        </div>
                                        <p id="validationMessage" style="color: red; font-size: 10px;"></p>
                                    </div> 
                                    <div class="col">
                                        <label for="nipAuditor" class="form-label fw-semibold">NIP <span class="text-danger fw-bold">*</span></label>
                                        <select id="nipAuditor" class="form-select" aria-label="Default select example" name="nip" required>
                                            <option selected>{{ $data->nip }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="namaAuditor" class="form-label fw-semibold">Nama <span class="text-danger fw-bold">*</span></label>
                                        <input type="text" name="nama" class="form-control" id="namaAuditor" placeholder="Nama Auditor" aria-label="Nama Auditor" value="{{ $data->nama }}" readonly/>
                                    </div>
                                    <div class="col">
                                        <label for="nomorTelepon" class="form-label fw-semibold">Nomor Telepon</label>
                                        <input type="tel" name="noTelepon" class="form-control" id="nomorTelepon" placeholder="Nomor Telepon" aria-label="Nomor Telepon" value="{{ $data->noTelepon }}"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="fakultas" class="form-label fw-semibold"
                                            >Fakultas/Direktorat/Rektorat <span class="text-danger fw-bold">*</span></label
                                        >
                                        <input
                                            type="text"
                                            name="fakultas"
                                            class="form-control"
                                            id="fakultas"
                                            placeholder="Fakultas"
                                            aria-label="Fakultas"
                                            value="{{ $data->fakultas }}"
                                            readonly
                                        />
                                    </div>
                                    <div class="col">
                                        <label for="programstudi" class="form-label fw-semibold"
                                            >Program Studi/Fungsi <span class="text-danger fw-bold">*</span></label
                                        >
                                        <input
                                            type="text"
                                            name="program_studi"
                                            class="form-control"
                                            id="programstudi"
                                            placeholder="Program Studi"
                                            aria-label="Program Studi"
                                            value="{{ $data->program_studi }}"
                                            readonly
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3" id="fakultasprodi2">
                                    <div class="col">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="fakultas2"
                                            placeholder="Fakultas"
                                            aria-label="Fakultas"
                                            @if ($user->unitkerja_id2 != null)
                                                value="{{ $unitkerja2->fakultas }}"
                                            @endif
                                            readonly
                                        />
                                    </div>
                                    <div class="col">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="programstudi2"
                                            placeholder="Program Studi"
                                            aria-label="Program Studi"
                                            @if ($user->unitkerja_id2 != null)
                                                value="{{ $unitkerja2->name }}"
                                            @endif
                                            readonly
                                        />
                                    </div>
                                </div>
                                <div class="row mb-3" id="fakultasprodi3">
                                    <div class="col">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="fakultas3"
                                            placeholder="Fakultas"
                                            aria-label="Fakultas"
                                            @if ($user->unitkerja_id3 != null)
                                                value="{{ $unitkerja3->fakultas }}"
                                            @endif
                                            readonly
                                        />
                                    </div>
                                    <div class="col">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="programstudi3"
                                            placeholder="Program Studi"
                                            aria-label="Program Studi"
                                            @if ($user->unitkerja_id3 != null)
                                                value="{{ $unitkerja3->name }}"
                                            @endif
                                            readonly
                                        />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="tanggalmulai" class="form-label fw-semibold"
                                            >Tanggal Mulai <span class="text-danger fw-bold">*</span></label
                                        >
                                        <input
                                            type="text"
                                            name="tgl_mulai"
                                            class="form-control"
                                            id="tanggalmulai"
                                            placeholder="{{ $data->tgl_mulai }}"
                                            aria-label="Tanggal Mulai Tugas"
                                            value="{{ date('d-m-Y', strtotime($data->tgl_mulai)) }}"
                                            readonly
                                        />
                                    </div>
                                    <div class="col">
                                        <label for="tanggalberakhir" class="form-label fw-semibold"
                                            >Tanggal Berakhir <span class="text-danger fw-bold">*</span></label
                                        >
                                        <input
                                            type="text"
                                            name="tgl_berakhir"
                                            class="form-control"
                                            id="tanggalberakhir"
                                            placeholder="{{ $data->tgl_berakhir }}"
                                            aria-label="Tanggal Berakhir Tugas"
                                            value="{{ date('d-m-Y', strtotime($data->tgl_berakhir)) }}"
                                            readonly
                                        />
                                    </div>
                                </div>
                                <p id="validationDateMessage" style="color: red; font-size: 10px;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="button">
                        <button type="submit" class="btn btn-primary float-end">
                            Simpan
                        </button>
                        <a href="{{ route('auditor', ['tahunperiode' => $data->tahunperiode]) }}">
                            <button type="button" class="btn btn-secondary me-3 float-end">
                                Kembali
                            </button>
                        </a>
                    </div> 
                </form>
            </div>
            
        </div>
    </div>
@endsection

@push('script') 
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/id.js"></script>

    <script>
        $(document).ready(function(){

            var user_unitkerja2 = "{{ $user->unitkerja_id2 }}";
            var user_unitkerja3 = "{{ $user->unitkerja_id3 }}";

            if (user_unitkerja2 == '') {
                $('#fakultasprodi2').hide();
                $('#fakultasprodi2').css('margin-bottom', '0');
            } 

            if (user_unitkerja3 == '') {
                $('#fakultasprodi3').hide();
                $('#fakultasprodi3').css('margin-bottom', '0');
            }

            let tglMulai = document.getElementById('tanggalmulai');
            let tglberakhir = document.getElementById('tanggalberakhir');
            let tahunAwal = $('#tahunperiode0').val();
            let tahun = $('#tahunperiode').val();

            $.ajax({
                url: "{{url('/tambahauditor-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    if (Array.isArray(data)) {
                        var mappedData = data.map(function(item) {
                            return {
                                id: item.nip,
                                text: item.nip + ' - ' + item.name,
                            };
                        });

                        $('#nipAuditor').select2({
                            data: mappedData,
                            templateSelection: function (selectedData) {
                                if (selectedData.id != '') {
                                    return selectedData.id;
                                } else {
                                    return "Pilih NIP Auditor";
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

            $('#tahunperiode0').change(function () {
                let tahunAwal = parseInt($('#tahunperiode0').val());
                console.log("berhasil " + tahunAwal);
                $('#tahunperiode').val(tahunAwal + 1);

                let tahunAkhir = tahunAwal + 1;

                let firstDate = new Date(tahunAwal, 0, 1);
                let lastDate = new Date(tahunAkhir, 11, 31);

                let minfirstDate = firstDate.toISOString().slice(0, 10);
                let maxlastDate = lastDate.toISOString().slice(0, 10);

                if (tahunAwal) {
                    console.log("berhasil tgl mulai  " + tahunAwal);
                    let tglMulai = document.getElementById('tanggalmulai');
                    tglMulai = new Date(tglMulai.value);
                    tglMulai = tglMulai.getFullYear();
                    console.log(tglMulai);

                    // Mengatur atribut 'min' dan 'max' pada elemen input dengan ID 'tanggalmulai'
                    $('#tanggalmulai').attr('min', minfirstDate);
                    $('#tanggalmulai').attr('max', maxlastDate);

                    let validationDateMessageElement = document.getElementById('validationDateMessage');

                    if (tglMulai < tahunAwal || tglMulai > tahunAkhir ) {
                        validationDateMessageElement.textContent = "Tanggal mulai penugasan tidak sesuai dengan periode pelaksanaan AMI (" + tahunAwal + "/" + tahunAkhir + ")";
                    } else if (tglMulai == tahunAwal || tglMulai == tahunAkhir) {
                        validationDateMessageElement.textContent = "";
                    }
                } if (tglberakhir) {
                    tglberakhir = new Date(tglberakhir.value);
                    tglberakhir = tglberakhir.getFullYear();

                    // Mengatur atribut 'min' dan 'max' pada elemen input dengan ID 'tanggaberakhir'
                    $('#tanggalberakhir').attr('min', minfirstDate);
                    $('#tanggalberakhir').attr('max', maxlastDate);

                    validateDate(tglberakhir);
                }
            });

            $('#tahunperiode').change(function () {
                let tahun = $(this).val();
                $('#tahunperiode0').val(tahun - 1);
                
                fillNipAuditorOptions(tahun);
            });

            $('#nipAuditor').change(function(){
                var id = $(this).val();
                var url = '{{ route("auditor-searchAuditor") }}';
                
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        if(response != null){
                            response.users.forEach(respon => {
                                if (respon.nip == id) {
                                    $('#user_id').val(respon.id);
                                    $('#namaAuditor').val(respon.name);

                                    var unitKerja = respon.unitkerja;

                                    $('#fakultas').val(unitKerja.fakultas);
                                    $('#programstudi').val(unitKerja.name);
                                    $('#nomorTelepon').val(respon.noTelepon);
                                    $('#fakultasprodi2').css('margin-bottom', '0');

                                    if (respon.unitkerja_id2 != null) {
                                        response.unitkerja.forEach(unitkerja => {
                                            if (respon.unitkerja_id2 == unitkerja.id) {
                                                console.log($('#programstudi2').val());
                                                $('#fakultas2').val(unitkerja.fakultas);
                                                $('#programstudi2').val(unitkerja.name);
                                            }
                                        });
                                        $('#fakultasprodi2').show();
                                        $('#fakultasprodi3').css('margin-bottom', '0');
                                        $('#fakultas2').show();
                                        $('#programstudi2').show();
                                    } else {
                                        $('#fakultasprodi2').hide();
                                        $('#fakultasprodi3').hide();
                                    }

                                    if (respon.unitkerja_id3 != null) {
                                        response.unitkerja.forEach(unitkerja => {
                                            console.log("Not null" + respon.unitkerja_id3);
                                            if (respon.unitkerja_id3 == unitkerja.id) {
                                                $('#fakultas3').val(unitkerja.fakultas);
                                                $('#programstudi3').val(unitkerja.name);
                                            }
                                        });
                                        $('#fakultasprodi3').show();
                                        $('#fakultas3').show();
                                        $('#programstudi3').show();
                                    } else {
                                        $('#fakultasprodi3').hide();
                                    }
                                }
                            });
                            
                        }
                    }
                });
            });

            $('#tanggalmulai').change(function() {
                let tglMulai = document.getElementById('tanggalmulai');
                let tglberakhir = document.getElementById('tanggalberakhir');

                let thPeriode0 =  document.getElementById('tahunperiode0').value;
                let thPeriode1 =  document.getElementById('tahunperiode').value;

                thPeriode0 = parseInt(thPeriode0);
                thPeriode1 = parseInt(thPeriode1);

                let firstDate = new Date(thPeriode0, 0, 1);
                let lastDate = new Date(thPeriode1, 11, 31);

                let minfirstDate = firstDate.toISOString().slice(0, 10);
                let maxlastDate = lastDate.toISOString().slice(0, 10);

                if (tglMulai) {
                    tglMulai = new Date(tglMulai.value);
                    tglMulai = tglMulai.getFullYear();

                    // Mengatur atribut 'min' dan 'max' pada elemen input dengan ID 'tanggalmulai'
                    $('#tanggalmulai').attr('min', minfirstDate);
                    $('#tanggalmulai').attr('max', maxlastDate);

                    validateDate(tglMulai);
                } if (tglberakhir) {
                    tglberakhir = new Date(tglberakhir.value);
                    tglberakhir = tglberakhir.getFullYear();

                    // Mengatur atribut 'min' dan 'max' pada elemen input dengan ID 'tanggaberakhir'
                    $('#tanggalberakhir').attr('min', minfirstDate);
                    $('#tanggalberakhir').attr('max', maxlastDate);

                    validateDate(tglberakhir);
                }

            })

            $('#nipAuditor').select2();

            $('#addForm').on('submit', function() {
                var firstest = $('#tanggalmulai').val();
                var lasttest = $('#tanggalberakhir').val();

                tglMulai = moment(tglMulai, "YYYY-MM-DD HH:mm:ss").format('yyyy-MM-DD');
                tglAkhir = moment(tglAkhir, "YYYY-MM-DD HH:mm:ss").format('yyyy-MM-DD');

                if ((firstest == '' || firstest == null) && (lasttest == '' || lasttest == null)) {

                    $('#tanggalmulai').val(tglMulai);
                    $('#tanggalberakhir').val(tglAkhir);

                    var cek = $('#tanggalmulai').val();
                    var cek2 = $('#tanggalberakhir').val();
                    console.log("Tanggal mulai mulai : " + cek);
                    console.log("Tanggal mulai berakhir : " + cek2);

                } else if ((lasttest == '' || lasttest == null) &&  (firstest != '' || firstest != null)) {

                    $('#tanggalmulai').val(valueawal);
                    $('#tanggalberakhir').val(tglAkhir);

                    var cek = $('#tanggalmulai').val();
                    var cek2 = $('#tanggalberakhir').val();
                    console.log("Tanggal mulai mulai : " + cek);
                    console.log("Tanggal mulai berakhir : " + cek2);

                } else if ((lasttest != '' || lasttest != null) &&  (firstest == '' || firstest == null)) {

                    $('#tanggalmulai').val(tglMulai);
                    $('#tanggalberakhir').val(valueawal_);

                    var cek = $('#tanggalmulai').val();
                    var cek2 = $('#tanggalberakhir').val();
                    console.log("Tanggal mulai mulai : " + cek);
                    console.log("Tanggal mulai berakhir : " + cek2);

                } else if ((firstest != '' || firstest != null) && (lasttest != '' || lasttest != null)) {

                    $('#tanggalmulai').val(valueawal);
                    $('#tanggalberakhir').val(valueawal_);

                    var cek = $('#tanggalmulai').val();
                    var cek2 = $('#tanggalberakhir').val();
                    console.log("Tanggal mulai mulai : " + cek);
                    console.log("Tanggal mulai berakhir : " + cek2); 

                } 
                // e.preventDefault();
            });

        });

        function validateInput() {
            minValue = parseInt($('#tahunperiode0').attr('min'));
            maxValue = parseInt($('#tahunperiode0').attr('max'));

            let inputElement = document.getElementById('tahunperiode0');
            let validationMessageElement = document.getElementById('validationMessage');

            // Dapatkan nilai input
            let inputValue = parseInt(inputElement.value);
            let currentYear = {{ $currentYear; }}

            // Validasi input
            if (isNaN(inputValue)) {
                validationMessageElement.textContent = "Input bukan angka. Silakan masukkan angka.";
            } else if ((inputValue < minValue || inputValue > maxValue)) {
                validationMessageElement.textContent = "Harap masukkan tahun periode antara " + minValue + " dan " + currentYear + ".";
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

            let minValue = $('#tahunperiode').attr('min', 2016);
            let maxValue = $('#tahunperiode').attr('max', currentYear);

            minValue = parseInt($('#tahunperiode').attr('min'));
            maxValue = parseInt($('#tahunperiode').attr('max'));

            // Validasi input
            if (isNaN(inputValue)) {
                validationMessageElement.textContent = "Input bukan angka. Silakan masukkan angka.";
            } else if ((inputValue < minValue || inputValue > maxValue)) {
                validationMessageElement.textContent = "Harap masukkan tahun periode antara " + minValue + " dan " + maxValue + ".";
                validationMessageElement.style.marginTop = '5px';
            } else {
                validationMessageElement.textContent = ""; // Hapus pesan validasi jika input valid
            }
        }

        function validateDate(tanggal) {
            let thPeriode0 =  document.getElementById('tahunperiode0').value;
            let thPeriode1 =  document.getElementById('tahunperiode').value;
            let validationDateMessageElement = document.getElementById('validationDateMessage');

            if (tanggal < thPeriode0 || tanggal > thPeriode1 ) {
                validationDateMessageElement.textContent = "Tanggal mulai penugasan tidak sesuai dengan periode pelaksanaan AMI (" + thPeriode0 + "/" + thPeriode1 + ")";
            } else if (tanggal == thPeriode0 || tanggal == thPeriode1) {
                validationDateMessageElement.textContent = "";
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            let tglMulai = document.getElementById('tanggalmulai');
            let tglberakhir = document.getElementById('tanggalberakhir');

            let thPeriode0 =  document.getElementById('tahunperiode0').value;
            let thPeriode1 =  document.getElementById('tahunperiode').value;

            thPeriode0 = parseInt(thPeriode0);
            thPeriode1 = parseInt(thPeriode1);

            let firstDate = new Date(thPeriode0, 1, 1);
            let lastDate = new Date(thPeriode1, 11, 31);

            let minfirstDate = firstDate.toISOString().slice(0, 10);
            let maxlastDate = lastDate.toISOString().slice(0, 10);

            if (tglMulai) {
                tglMulai = new Date(tglMulai.value);
                tglMulai = tglMulai.getFullYear();

                $('#tanggalmulai').attr('min', minfirstDate);
                $('#tanggalmulai').attr('max', maxlastDate);

                validateDate(tglMulai);
            } if (tglberakhir) {
                tglberakhir = new Date(tglberakhir.value);
                tglberakhir = tglberakhir.getFullYear();

                $('#tanggalberakhir').attr('min', minfirstDate);
                $('#tanggalberakhir').attr('max', maxlastDate);

                validateDate(tglberakhir);
            }
        })
    </script>
@endpush
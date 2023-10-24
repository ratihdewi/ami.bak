@extends('layout.main') @section('title') AMI - Tambah Auditor @endsection

@section('linking')
    <a href="/daftarAuditor-periode" class="mx-1">
        Periode Auditor
    </a>
@endsection

@section('container')

<div class="container mt-3 mb-3 vh-100">
    <div class="row justify-content-center">
        <div class="col-8">
            <h5 class="text-center mb-3">Tambah Auditor
            </h5>
            <form id="addForm" action="/insertAuditor" method="POST">
                @csrf
                <div class="card mb-3">
                    <div class="card-body p-4">
                        <div class="addauditor">
                            <div class="row mb-3">
                                <div class="col" hidden>
                                    <label class="fw-semibold" for="user_id" class="form-label">ID User</label>
                                    <input type="text" name="user_id" class="form-control" id="user_id" placeholder="ID User" aria-label="ID User"/>
                                </div>         
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="row">
                                        <label class="fw-semibold" for="tahunperiode" class="form-label">Tahun Periode <span class="text-danger fw-bold">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="number" id="tahunperiode0" name="tahunperiode0" class="form-control" placeholder="Tahun Awal" min="2016" aria-label="Tahun Akhir" oninput="validateInput()" 
                                            @foreach ($periodes->get() as $periode)
                                                value="{{ $periode->tahunperiode1 }}"
                                            @endforeach
                                            readonly required/>    
                                        </div>
                                        <div class="col-sm-2 text-center">
                                            <h3 class="">/</h3>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="number" name="tahunperiode" class="form-control" id="tahunperiode" placeholder="Tahun Akhir" aria-label="Tahun Akhir" onchange="validateChange()" 
                                            @foreach ($periodes->get() as $periode)
                                                value="{{ $periode->tahunperiode2 }}"
                                            @endforeach
                                            readonly required/>
                                        </div>
                                    </div>
                                    <p id="validationMessage" style="color: red; font-size: 10px;"></p>
                                </div> 
                                <div class="col">
                                    <label class="fw-semibold" for="nipAuditor" class="form-label">NIP <span class="text-danger fw-bold">*</span></label>
                                    <select id="nipAuditor" class="form-select" aria-label="Default select example" name="nip" required>
                                        <option selected disabled>Pilih NIP Auditor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="fw-semibold" for="namaAuditor" class="form-label">Nama <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" name="nama" class="form-control" id="namaAuditor" placeholder="Nama Auditor" aria-label="Nama Auditor" readonly/>
                                </div>
                                <div class="col">
                                    <label class="fw-semibold" for="nomorTelepon" class="form-label">Nomor Telepon</label>
                                    <input type="tel" name="noTelepon" class="form-control" id="nomorTelepon"
                                        placeholder="Nomor Telepon"
                                        aria-label="Nomor Telepon"
                                        readonly
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="fw-semibold" for="fakultas" class="form-label"
                                        >Fakultas/Direktorat <span class="text-danger fw-bold">*</span></label
                                    >
                                    <input
                                        type="text"
                                        name="fakultas"
                                        class="form-control"
                                        id="fakultas"
                                        placeholder="Fakultas"
                                        aria-label="Fakultas"
                                        readonly
                                    />
                                </div>
                                <div class="col">
                                    <label class="fw-semibold" for="programstudi" class="form-label"
                                        >Program Studi/Fungsi <span class="text-danger fw-bold">*</span></label
                                    >
                                    <input
                                        type="text"
                                        name="program_studi"
                                        class="form-control"
                                        id="programstudi"
                                        placeholder="Program Studi"
                                        aria-label="Program Studi"
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
                                        readonly
                                    />
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <label class="fw-semibold" for="tanggalmulai" class="form-label">Tanggal Mulai</label>
                                    {{-- <div class="col">
                                        <div class="input-group date" id="tglmulai">
                                            <input type="text" class="form-control" id="tanggalmulai" name="tgl_mulai" placeholder="{{ $periode->tgl_mulai->translatedFormat('l, d M Y') }}">
                                            <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                                <i class="bi bi-calendar"></i>
                                            </span>
                                            </span>
                                        </div>
                                    </div> --}}
                                    <input
                                        type="text"
                                        name="tgl_mulai"
                                        class="form-control"
                                        id="tanggalmulai"
                                        {{-- onfocus="(this.type='date')"
                                        onblur="(this.type='text')" --}}
                                        placeholder="{{ $periode->tgl_mulai->translatedFormat('l, d M Y') }}"
                                        aria-label="Tanggal Mulai Tugas"
                                        value="{{ date('d-m-Y', strtotime($periode->tgl_mulai)) }}"
                                        readonly
                                        required
                                    />
                                </div>
                                <div class="col">
                                    <label class="fw-semibold" for="tanggalberakhir" class="form-label"
                                        >Tanggal Berakhir</label
                                    >
                                    <input
                                        type="text"
                                        name="tgl_berakhir"
                                        class="form-control"
                                        id="tanggalberakhir"
                                        placeholder="{{ $periode->tgl_berakhir->translatedFormat('l, d M Y') }}"
                                        aria-label="Tanggal Berakhir Tugas"
                                        value="{{ date('d-m-Y', strtotime($periode->tgl_berakhir)); }}"
                                        readonly
                                        required
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
                    @foreach ($periodes->get() as $periode)
                    <a href="/daftarAuditor/{{ $periode->tahunperiode2 }}">
                    @endforeach
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.id.min.js" integrity="sha512-5dCXH+uVhgMJkIOoV1tEejq2voWTEqqh2Q2+Caz6//+6i9dLpfyDmAzKcdbogrXjPLanlDO5pTsBDKzmaJcWFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/id.js"></script>

    <script>
        $(document).ready(function(){

            // flatpickr("#tanggalmulai", {
            //     dateFormat: "d-m-Y", // Sesuaikan dengan format yang Anda inginkan
            //     locale: "id",
            //     enableTime: false, // Jangan aktifkan waktu
            //     // time_24hr: true, // Gunakan format 24 jam
            //     timeZone: "Asia/Jakarta",
            // });

            // flatpickr("#tanggalberakhir", {
            //     dateFormat: "d-m-Y", // Sesuaikan dengan format yang Anda inginkan
            //     locale: "id",
            //     enableTime: false, // Jangan aktifkan waktu
            //     // time_24hr: true, // Gunakan format 24 jam
            //     timeZone: "Asia/Jakarta",
            // });

            var tahunAwal = $('#tahunperiode0').val();
            var tahunAkhir = $('#tahunperiode').val();

            fillNipAuditorOptions(tahunAkhir);

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

            $('#fakultasprodi2').hide();
            $('#fakultasprodi3').hide();

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
                                                console.log($('#fakultas2').val());
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
                                            if (respon.unitkerja_id3 == unitkerja.id) {
                                                console.log($('#fakultas2').val());
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

            function isValidDate(value) {
                var date = new Date(value);
                return !isNaN(date.getTime());
            }

            $('#addForm').on('submit', function(e) {
                var firstest = $('#tanggalmulai').val();
                var lasttest = $('#tanggalberakhir').val();

                tglMulai = moment(tglMulai, "YYYY-MM-DD HH:mm:ss").format('yyyy-MM-DD');
                tglAkhir = moment(tglAkhir, "YYYY-MM-DD HH:mm:ss").format('yyyy-MM-DD');

                if ((firstest == '' || firstest == null) && (lasttest == '' || lasttest == null)) {

                    $('#tanggalmulai').val(tglMulai);
                    $('#tanggalberakhir').val(tglAkhir);

                    var cek = $('#tanggalmulai').val();
                    console.log("Tanggal mulai 1 " + cek);

                } else if ((lasttest == '' || lasttest == null) &&  (firstest != '' || firstest != null)) {

                    $('#tanggalmulai').val(valueawal);
                    $('#tanggalberakhir').val(tglAkhir);

                    var cek = $('#tanggalberakhir').val();
                    console.log("Tanggal berakhir 2 " + cek);

                } else if ((lasttest != '' || lasttest != null) &&  (firstest == '' || firstest == null)) {

                    $('#tanggalmulai').val(tglMulai);
                    $('#tanggalberakhir').val(valueawal_);

                    var cek = $('#tanggalmulai').val();
                    console.log("Tanggal mulai 3 " + cek);

                } else if ((firstest != '' || firstest != null) && (lasttest != '' || lasttest != null)) {

                    $('#tanggalmulai').val(valueawal);
                    $('#tanggalberakhir').val(valueawal_);

                    var cek = $('#tanggalmulai').val();
                    console.log("Tanggal mulai 4 " + cek);  

                } 
            });

        });

        function validateInput() {
            minValue = parseInt($('#tahunperiode0').attr('min'));
            maxValue = parseInt($('#tahunperiode0').attr('max'));
            // console.log(maxValue);

            let inputElement = document.getElementById('tahunperiode0');
            let validationMessageElement = document.getElementById('validationMessage');

            // Dapatkan nilai input
            let inputValue = parseInt(inputElement.value);
            let maxvalue = maxValue + 1;

            // Validasi input
            if (isNaN(inputValue)) {
                validationMessageElement.textContent = "Input bukan angka. Silakan masukkan angka.";
            } else if ((inputValue < minValue || inputValue > maxValue)) {
                validationMessageElement.textContent = "Harap masukkan tahun periode antara " + minValue + " dan " + maxvalue + ".";
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

        function fillNipAuditorOptions(tahun) {
            let tahunAwal = parseInt($('#tahunperiode0').val());
            let maxValue = parseInt($('#tahunperiode0').attr('max'));
            let minValue = parseInt($('#tahunperiode0').attr('min'));
            let maxvalue = parseInt($('#tahunperiode').attr('max'));
            let minvalue = parseInt($('#tahunperiode').attr('min'));

            if (tahun == tahunAwal+1 && (tahunAwal >= minValue)) {
                // console.log('berhasil');
                $.ajax({
                    url: "{{url('/tambahauditor-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
                    type: 'GET',
                    dataType: 'json',
                    data: { q: '' },
                    success: function(data) {
                        console.log(data);
                        $('#nipAuditor').empty();
                        $('#nipAuditor').append('<option value="" selected disabled>Pilih NIP Auditor</option>');
                        if (Array.isArray(data)) {
                            var mappedData = data.map(function(item) {
                                return {
                                    id: item.nip,
                                    text: item.nip,
                                };
                            });

                            $('#nipAuditor').select2({
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
                    url: "{{url('/tambahauditor-searchnipuser')}}/"+ tahunAwal + "/" + tahun,
                    type: 'GET',
                    dataType: 'json',
                    data: { q: '' },
                    success: function(data) {
                        console.log(data);
                        $('#nipAuditor').empty();
                        $('#nipAuditor').append('<option value="" selected disabled>Pilih NIP Ketua Auditor</option>');
                        if (Array.isArray(data)) {
                            $('#nipAuditor').select2();
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

        function validateDate(tanggal) {
            let thPeriode0 =  document.getElementById('tahunperiode0').value;
            let thPeriode1 =  document.getElementById('tahunperiode').value;
            let validationDateMessageElement = document.getElementById('validationDateMessage');

            // console.log('tgl mulai : ' + tglMulai);
            console.log('thPeriode0 : ' + thPeriode0);
            console.log('thPeriode : ' + thPeriode1);

            if (tanggal < thPeriode0 || tanggal > thPeriode1 ) {
                validationDateMessageElement.textContent = "Tanggal mulai penugasan tidak sesuai dengan periode pelaksanaan AMI (" + thPeriode0 + "/" + thPeriode1 + ")";
            } else if (tanggal == thPeriode0 || tanggal == thPeriode1) {
                validationDateMessageElement.textContent = "";
            }
        }
    </script>
@endpush
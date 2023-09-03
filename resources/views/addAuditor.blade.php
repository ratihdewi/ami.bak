@extends('layout.main') @section('title') AMI - Daftar Auditor @endsection

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
            <form action="/insertAuditor" method="POST">
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
                                        <label class="fw-semibold" for="tahunperiode" class="form-label">Tahun Periode</label>
                                        <div class="col-sm-5">
                                            <input type="number" id="tahunperiode0" name="tahunperiode0" class="form-control" placeholder="Tahun Awal" min="2016" max="{{ $currentYear - 1 }}" aria-label="Tahun Akhir" oninput="validateInput()" required/>    
                                        </div>
                                        <div class="col-sm-2 text-center">
                                            <h3 class="">/</h3>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="number" name="tahunperiode" class="form-control" id="tahunperiode" placeholder="Tahun Akhir" aria-label="Tahun Akhir" onchange="validateChange()" required/>
                                        </div>
                                    </div>
                                    <p id="validationMessage" style="color: red; font-size: 10px;"></p>
                                </div> 
                                <div class="col">
                                    <label class="fw-semibold" for="nipAuditor" class="form-label">NIP</label>
                                    <select id="nipAuditor" class="form-select" aria-label="Default select example" name="nip" required>
                                        <option selected disabled>Pilih NIP Auditor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="fw-semibold" for="namaAuditor" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="namaAuditor" placeholder="Nama Auditor" aria-label="Nama Auditor"/>
                                </div>
                                <div class="col">
                                    <label class="fw-semibold" for="nomorTelepon" class="form-label">Nomor Telepon</label>
                                    <input type="tel" name="noTelepon" class="form-control" id="nomorTelepon"
                                        placeholder="Nomor Telepon"
                                        aria-label="Nomor Telepon"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="fw-semibold" for="fakultas" class="form-label"
                                        >Fakultas</label
                                    >
                                    <input
                                        type="text"
                                        name="fakultas"
                                        class="form-control"
                                        id="fakultas"
                                        placeholder="Fakultas"
                                        aria-label="Fakultas"
                                    />
                                </div>
                                <div class="col">
                                    <label class="fw-semibold" for="programstudi" class="form-label"
                                        >Program Studi</label
                                    >
                                    <input
                                        type="text"
                                        name="program_studi"
                                        class="form-control"
                                        id="programstudi"
                                        placeholder="Program Studi"
                                        aria-label="Program Studi"
                                    />
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <label class="fw-semibold" for="tanggalmulai" class="form-label"
                                        >Tanggal Mulai</label
                                    >
                                    <input
                                        type="date"
                                        name="tgl_mulai"
                                        class="form-control"
                                        id="tanggalmulai"
                                        placeholder="Tanggal Mulai Tugas"
                                        aria-label="Tanggal Mulai Tugas"
                                        required
                                    />
                                </div>
                                <div class="col">
                                    <label class="fw-semibold" for="tanggalberakhir" class="form-label"
                                        >Tanggal Berakhir</label
                                    >
                                    <input
                                        type="date"
                                        name="tgl_berakhir"
                                        class="form-control"
                                        id="tanggalberakhir"
                                        placeholder="Tanggal Berakhir Tugas"
                                        aria-label="Tanggal Berakhir Tugas"
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
                    <a href="/daftarAuditor-periode">
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

    <script>
        $(document).ready(function(){

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

            $('#nipAuditor').change(function(){
                var id = $(this).val();
                var url = '{{ route("auditor-searchAuditor") }}';
                
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        
                        if(response != null){
                            response.forEach(respon => {
                                if (respon.nip == id) {
                                    $('#user_id').val(respon.id);
                                    $('#namaAuditor').val(respon.name);

                                    var unitKerja = respon.unitkerja;

                                    $('#fakultas').val(unitKerja.fakultas);
                                    $('#programstudi').val(unitKerja.name);
                                    $('#nomorTelepon').val(respon.noTelepon);
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

                let firstDate = new Date(thPeriode0, 1, 1);
                let lastDate = new Date(thPeriode1, 11, 31);

                let minfirstDate = firstDate.toISOString().slice(0, 10);
                let maxlastDate = lastDate.toISOString().slice(0, 10);

                if (tglMulai) {
                    tglMulai = new Date(tglMulai.value);
                    tglMulai = tglMulai.getFullYear();

                    // Mengatur atribut 'min' dan 'max' pada elemen input dengan ID 'tanggalmulai'
                    $('#tanggalmulai').attr('min', minfirstDate);
                    $('#tanggalmulai').attr('max', maxlastDate);

                    console.log('min date : ' + minfirstDate);
                    console.log('max date : ' + maxlastDate);

                    validateDate(tglMulai);
                } if (tglberakhir) {
                    tglberakhir = new Date(tglberakhir.value);
                    tglberakhir = tglberakhir.getFullYear();

                    // Mengatur atribut 'min' dan 'max' pada elemen input dengan ID 'tanggaberakhir'
                    $('#tanggalberakhir').attr('min', minfirstDate);
                    $('#tanggalberakhir').attr('max', maxlastDate);

                    console.log('min date : ' + minfirstDate);
                    console.log('max date : ' + maxlastDate);

                    validateDate(tglberakhir);
                }

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

        function fillNipAuditorOptions(tahun) {
            let tahunAwal = parseInt($('#tahunperiode0').val());
            let maxValue = parseInt($('#tahunperiode0').attr('max'));
            let minValue = parseInt($('#tahunperiode0').attr('min'));

            let minvalue = $('#tahunperiode').attr('min', tahunAwal+1);
            let maxvalue = $('#tahunperiode').attr('max', tahunAwal+1);

            console.log('min value ' + minValue);
            console.log('max value ' + maxValue);

            if (tahun == tahunAwal+1 && (tahunAwal >= minValue && tahunAwal <= maxValue)) {
                // console.log('berhasil');
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

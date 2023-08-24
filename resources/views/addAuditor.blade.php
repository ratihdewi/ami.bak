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
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="row">
                                        <label class="fw-semibold" for="tahunperiode" class="form-label">Tahun Periode</label>
                                        <div class="col-sm-5">
                                            <input type="number" id="tahunperiode0" name="tahunperiode0" class="form-control" placeholder="Tahun Awal" min="2016" max="3000" aria-label="Tahun Akhir" required/>
                                        </div>
                                        <div class="col-sm-2 text-center">
                                            <h3 class="">/</h3>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="number" name="tahunperiode" class="form-control" id="tahunperiode" placeholder="Tahun Akhir" aria-label="Tahun Akhir" required/>
                                        </div>
                                    </div>
                                    
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
                            <div class="row mb-3">
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

@endsection @push('script') 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>

<script>
    $(document).ready(function(){

        $('#tahunperiode').change(function () {
            let tahunAwal = $('#tahunperiode0').val();
            tahunAwal = parseInt(tahunAwal);

            let minvalue = $('#tahunperiode').attr('min', tahunAwal+1);
            let maxvalue = $('#tahunperiode').attr('max', tahunAwal+1);

            minvalue = parseInt($('#tahunperiode').attr('min'));
            maxvalue = parseInt($('#tahunperiode').attr('max'));

            let tahun = $('#tahunperiode').val();
            console.log(tahunAwal);
            console.log(tahun);

            if (tahun < minvalue || tahun > maxvalue) {
                console.log('Gagal');
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
            }
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
    });
</script>
@endpush

@extends('layout.main') @section('title') AMI - Daftar Auditor @endsection
@section('container')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form action="/insertAuditor" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col" hidden>
                                <label for="user_id" class="form-label"
                                    >ID User</label
                                >
                                {{-- @foreach ($users_ as $user) --}}
                                <input
                                    type="text"
                                    name="user_id"
                                    class="form-control"
                                    id="user_id"
                                    placeholder="ID User"
                                    aria-label="ID User"
                                    {{-- value="{{ $user->id }}" --}}
                                />
                                {{-- @endforeach      --}}
                            </div>         
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nipAuditor" class="form-label"
                                    >NIP</label
                                >
                                <select
                                    id="nipAuditor"
                                    class="form-select"
                                    name="nip"
                                    required
                                >
                                    <option selected disabled>Pilih NIP Auditor</option>
                                    @foreach ($users_ as $user)
                                    <option value="{{ $user->nip }}">{{ $user->nip }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- @foreach ($datas as $data) --}}
                            <div class="col">
                                <label for="namaAuditor" class="form-label"
                                    >Nama</label
                                >
                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    id="namaAuditor"
                                    placeholder="Nama Auditor"
                                    aria-label="Nama Auditor"
                                    {{-- value="{{ $data->name }}" --}}
                                />
                            </div>
                            {{-- @endforeach --}}
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="fakultas" class="form-label"
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
                                <label for="programstudi" class="form-label"
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
                                <label for="tanggalmulai" class="form-label"
                                    >Tanggal Mulai</label
                                >
                                <input
                                    type="date"
                                    name="tgl_mulai"
                                    class="form-control"
                                    id="tanggalmulai"
                                    placeholder="Tanggal Mulai Tugas"
                                    aria-label="Tanggal Mulai Tugas"
                                />
                            </div>
                            <div class="col">
                                <label for="tanggalberakhir" class="form-label"
                                    >Tanggal Berakhir</label
                                >
                                <input
                                    type="date"
                                    name="tgl_berakhir"
                                    class="form-control"
                                    id="tanggalberakhir"
                                    placeholder="Tanggal Berakhir Tugas"
                                    aria-label="Tanggal Berakhir Tugas"
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nomorTelepon" class="form-label"
                                    >Nomor Telepon</label
                                >
                                <input
                                    type="tel"
                                    name="noTelepon"
                                    class="form-control"
                                    id="nomorTelepon"
                                    placeholder="Nomor Telepon"
                                    aria-label="Nomor Telepon"
                                />
                            </div>
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
                        </div>
                        {{-- {{ json_encode($json_) }} --}}
                        <button type="submit" class="btn btn-primary float-end">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @push('script') 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script>
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
                            $('#fakultas').val(respon.unit_kerja);
                            $('#programstudi').val(respon.unit_kerja);
                            $('#nomorTelepon').val(respon.noTelepon);
                        }
                    });
                    
                }
            }
        });
    });
</script>
@endpush

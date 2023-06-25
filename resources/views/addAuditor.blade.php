@extends('layout.main') @section('title') AMI - Daftar Auditor @endsection
@section('container')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body p-4">
                    <form action="/insertAuditor" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nipAuditor" class="form-label"
                                    >NIP</label
                                >
                                <input
                                    type="text"
                                    name="nip"
                                    class="form-control"
                                    id="nipAuditor"
                                    placeholder="NIP Auditor"
                                    aria-label="NIP"
                                    
                                    {{-- oninput="myFunction()" --}}
                                />
                            </div>
                            {{-- @foreach ($dataModified as $data) --}}
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
                                <label for="esignAuditor" class="form-label"
                                    >eSign</label
                                >
                                <input
                                    class="form-control"
                                    type="file"
                                    id="esignAuditor"
                                />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @push('script') {{--
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@master/dist/latest/bootstrap-autocomplete.min.js"></script>
--}}
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
{{--
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
--}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
    var path = "{{ route('auditor-searchAuditor') }}";
    $(function () {
        $.ajaxSetup({
            headers:{
                'C-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })
    })
    

    $('#nipAuditor').typeahead({
        minlength: 1,
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>
{{-- <script>
    function myFunction() {
        var nip = document.getElementById("nipAuditor");
        var nama = document.getElementById("namaAuditor");
        var fakultas = document.getElementById("fakultas");
        var programstudi = document.getElementById("programstudi");
        var nomorTelepon = document.getElementById("nomorTelepon");
        console.log(nip.value);

        if (nip.value == "119012") {
            nama.value = "SPM Role";
            document.getElementById("nama").innerHTML = nama.value;
            fakultas.value = "Program Studi Ilmu Komputer";
            programstudi.value = "Program Studi Ilmu Komputer";
            nomorTelepon.value = "082344556326";
        }
        if (nip.value == "119022") {
            nama.value = "Auditor Role";
            fakultas.value = "Fakultas Sains dan Ilmu Komputer";
            programstudi.value = "Fakultas Sains dan Ilmu Komputer";
            nomorTelepon.value = "082344553626";
        }
        if (nip.value == "119032") {
            nama.value = "Auditee Role";
            fakultas.value = "Direktorat IT";
            programstudi.value = "Direktorat IT";
            nomorTelepon.value = "082343553626";
        } else {
            window.print("Data Tidak Ditemukan");
        }
    }
</script> --}}
{{--
<script type="text/javascript">
    // $(document).ready(function() {
    //     console.log('test');
    //     $.ajax({
    //         type:'get',
    //         url:'{!!URL::to('findusers')!!}',
    //         success:function(response){
    //             console.log(response);

    //             var userArray = response;
    //             var dataUser = [];
    //             var dataUser2 = [];
    //             var dataUser3 = [];
    //             var dataUser4 = [];
    //             for (var i=0; i<userArray.length; i++){
    //                 dataUser[i] = userArray[i].nip;
    //                 dataUser2[i] = userArray[i].name;
    //                 dataUser3[i] = userArray[i].unit_kerja;
    //                 dataUser4[i] = userArray[i].unit_kerja;
    //             }
    //             console.log(dataUser2);
    //             $('input#nipAuditor').autocomplete({
    //                 source : dataUser,
    //                 onSelect:function(reqdata){
    //                     console.log(reqdata);

    //                 }
    //             });
    //         }
    //     })
    // })
</script>
--}} @endpush

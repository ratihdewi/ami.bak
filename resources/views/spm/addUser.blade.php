@extends('layout.main') 

@section('title') AMI - Tambah User @endsection

@section('linking')
    <a href="/usercontrol" class="mx-1">
        Daftar User
    </a>/

    <a href="/addUser" class="mx-1">
        Tambah User
    </a>/
@endsection

@section('container')
    <div class="container vh-100 mt-5">
              <div class="row justify-content-center">
                  <div class="col-8 mb-3">
                    <h5 class="text-center mb-3"> Tambah User</h5>
                    <form action="/insertUser" method="POST">
                        @csrf
                        <div class="card mb-3">
                            <div class="card-body p-4">
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="nip" class="form-label fw-semibold">NIP <span class="text-danger fw-bold">*</span></label>
                                        <input type="string" name="nip" class="form-control" id="nip" placeholder="nip" aria-label="nip" required>
                                    </div>
                                    <div class="col">
                                        <label for="nama" class="form-label fw-semibold">Nama <span class="text-danger fw-bold">*</span></label>
                                        <input type="text" name="name" class="form-control" id="nama" placeholder="Nama Auditor" aria-label="Nama" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="email" class="form-label fw-semibold">Email <span class="text-danger fw-bold">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" aria-label="Email" required>
                                    </div>
                                    <div class="col">
                                        <label for="selectRole" class="form-label fw-semibold"
                                            >Role <span class="text-danger fw-bold">*</span></label
                                        >
                                        <select
                                            id="selectRole"
                                            class="form-select"
                                            name="role_id"
                                            required
                                        >
                                            <option value="">
                                                Pilih Role
                                            </option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="username" class="form-label fw-semibold">Username <span class="text-danger fw-bold">*</span></label>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" aria-label="Username" required>
                                    </div>
                                    <div class="col">
                                        <label for="pwd" class="form-label fw-semibold">Password <span class="text-danger fw-bold">*</span></label>
                                        <input type="password" name="password" class="form-control bg-secondary bg-opacity-50" id="pwd" placeholder="Password" aria-label="Password" value="user123" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="selectUnitKerja" class="form-label fw-semibold"
                                            >Unit Kerja <span class="text-danger fw-bold">*</span></label
                                        >
                                        <select
                                            id="selectUnitKerja"
                                            class="form-select"
                                            name="unitkerja_id"
                                            required
                                        >
                                            <option value="">
                                                Pilih unit kerja
                                            </option>
                                            @foreach ($unitkerjas as $unitkerja)
                                            <option value="{{ $unitkerja->id }}">
                                                {{ $unitkerja->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <div class="col">
                                            <label for="jabatan" class="form-label fw-semibold">Jabatan <span class="text-danger fw-bold">*</span></label>
                                            <select
                                                id="jabatan"
                                                class="form-select"
                                                name="jabatan"
                                                required
                                            >
                                                <option value="">
                                                    Pilih Jabatan
                                                </option>
                                            </select>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="selectUnitKerja2" class="form-label fw-semibold"
                                            >Unit Kerja (Opsional)</label
                                        >
                                        <select
                                            id="selectUnitKerja2"
                                            class="form-select"
                                            name="unitkerja_id2"
                                        >
                                            <option value="">
                                                Pilih unit kerja
                                            </option>
                                            @foreach ($unitkerjas as $unitkerja)
                                            <option value="{{ $unitkerja->id }}">
                                                {{ $unitkerja->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <div class="col">
                                            <label for="jabatan2" class="form-label fw-semibold">Jabatan (Opsional)</label>
                                            <select
                                                id="jabatan2"
                                                class="form-select"
                                                name="jabatan2"
                                            >
                                                <option value="">
                                                    Pilih Jabatan
                                                </option>
                                            </select>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="selectUnitKerja3" class="form-label fw-semibold"
                                            >Unit Kerja (Opsional)</label
                                        >
                                        <select
                                            id="selectUnitKerja3"
                                            class="form-select"
                                            name="unitkerja_id3"
                                        >
                                            <option value="">
                                                Pilih unit kerja
                                            </option>
                                            @foreach ($unitkerjas as $unitkerja)
                                            <option value="{{ $unitkerja->id }}">
                                                {{ $unitkerja->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <div class="col">
                                            <label for="jabatan3" class="form-label fw-semibold">Jabatan (Opsional)</label>
                                            <select
                                                id="jabatan3"
                                                class="form-select"
                                                name="jabatan3"
                                            >
                                                <option value="">
                                                    Pilih Jabatan
                                                </option>
                                            </select>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="noTelepon" class="form-label fw-semibold">Nomor Telepon</label>
                                        <input type="tel" placeholder="08XXXXXXXXXX" name="noTelepon" class="form-control" id="noTelepon" aria-label="noTelepon">  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button d-flex justify-content-end">
                            <a href="/usercontrol">
                                <button type="button" class="btn btn-secondary me-md-2">
                                    Kembali
                                </button>
                            </a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        </form>
                  </div>
              </div>
          </div>
@endsection


@push('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function(){

            $('#selectUnitKerja').change(function() {
                var unitkerja_id = $('#selectUnitKerja').val();
                
                $.ajax({
                    url: "{{url('/tambahuser-getposition')}}/"+ unitkerja_id,
                    type: 'GET',
                    dataType: 'json',
                    data: { q: '' },
                    success: function(data) {
                        console.log(data);
                        $('#jabatan').empty();
                        $('#jabatan').append('<option value="" selected disabled>Pilih Jabatan</option>');
                        if (Array.isArray(data)) {
                            var mappedData = data.map(function(item) {
                                return {
                                    id: item.position,
                                    text: item.position,
                                };
                            });

                            $('#jabatan').select2({
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

            $('#selectUnitKerja2').change(function() {
                var unitkerja_id2 = $('#selectUnitKerja2').val();
                
                $.ajax({
                    url: "{{url('/tambahuser-getposition')}}/"+ unitkerja_id2,
                    type: 'GET',
                    dataType: 'json',
                    data: { q: '' },
                    success: function(data) {
                        console.log(data);
                        $('#jabatan2').empty();
                        $('#jabatan2').append('<option value="" selected disabled>Pilih Jabatan</option>');
                        if (Array.isArray(data)) {
                            var mappedData = data.map(function(item) {
                                return {
                                    id: item.position,
                                    text: item.position,
                                };
                            });

                            $('#jabatan2').select2({
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

            $('#selectUnitKerja3').change(function() {
                var unitkerja_id3 = $('#selectUnitKerja3').val();
                
                $.ajax({
                    url: "{{url('/tambahuser-getposition')}}/"+ unitkerja_id3,
                    type: 'GET',
                    dataType: 'json',
                    data: { q: '' },
                    success: function(data) {
                        console.log(data);
                        $('#jabatan3').empty();
                        $('#jabatan3').append('<option value="" selected disabled>Pilih Jabatan</option>');
                        if (Array.isArray(data)) {
                            var mappedData = data.map(function(item) {
                                return {
                                    id: item.position,
                                    text: item.position,
                                };
                            });

                            $('#jabatan3').select2({
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

            $('#selectUnitKerja').select2();
            $('#selectRole').select2();
            $('#selectUnitKerja2').select2();
            $('#selectUnitKerja3').select2();
            $('#jabatan').select2();
            $('#jabatan2').select2();
            $('#jabatan3').select2();
        })
    </script>
@endpush
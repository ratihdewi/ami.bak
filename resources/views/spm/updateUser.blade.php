@extends('layout.main') 

@section('title') AMI - Tambah Auditee @endsection

@section('linking')
    <a href="/usercontrol" class="mx-1">
        Daftar User
    </a>/

    <a href="/tampilUser/{{ $data->id }}" class="mx-1">
        Ubah User
    </a>/
@endsection

@section('container')
    <div class="container vh-100 mt-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <h5 class="text-center mb-3"> Ubah User</h5>
                <form action="/updateUser/{{ $data->id }}" method="POST">
                    <div class="card mb-3">
                        <div class="card-body p-4">
                            @csrf
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="nip" class="form-label fw-semibold">NIP</label>
                                    <input type="number" name="nip" class="form-control" id="nip" placeholder="nip" aria-label="nip" value="{{ $data->nip }}">
                                </div>
                                <div class="col">
                                    <label for="nama" class="form-label fw-semibold">Nama</label>
                                    <input type="text" name="name" class="form-control" id="nama" placeholder="Nama Auditor" aria-label="Nama" value="{{ $data->name }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" aria-label="Email" value="{{ $data->email }}">
                                </div>
                                <div class="col">
                                    <label for="selectRole" class="form-label fw-semibold"
                                        >Role</label
                                    >
                                    <select
                                        id="selectRole"
                                        class="form-select"
                                        name="role_id"
                                        required
                                    >
                                        <option value="{{ $data->role_id }}" selected>
                                            {{ $data->role->name }}
                                        </option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="username" class="form-label fw-semibold">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" aria-label="Username" value="{{ $data->username }}">
                                </div>
                                <div class="col">
                                    <label for="pwd" class="form-label fw-semibold">Password</label>
                                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Password" aria-label="Password" value="{{ $data->password }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="selectUnitKerja" class="form-label fw-semibold"
                                        >Unit Kerja</label
                                    >
                                    <select
                                        id="selectUnitKerja"
                                        class="form-select"
                                        name="unitkerja_id"
                                        required
                                    >
                                        <option value="{{ $data->unitkerja_id }}" selected>
                                            {{ $data->unitkerja->name }}
                                        </option>
                                        @foreach ($unitkerjas as $unitkerja)
                                        <option value="{{ $unitkerja->id }}">
                                            {{ $unitkerja->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="jabatan" class="form-label fw-semibold">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Jabatan" aria-label="Jabatan" value="{{ $data->jabatan }}">
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
                                    @if ($data->unitkerja_id2 != null)
                                        <option value="{{ $data->unitkerja_id2 }}" selected>
                                            {{ $unitkerja2->name }}
                                        </option>
                                    @else
                                        <option value="">
                                            Pilih unit kerja
                                        </option>
                                    @endif
                                        @foreach ($unitkerjas as $unitkerja)
                                        <option value="{{ $unitkerja->id }}">
                                            {{ $unitkerja->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="jabatan2" class="form-label fw-semibold">Jabatan (Opsional)</label>
                                    <input type="text" name="jabatan2" class="form-control" id="jabatan2" placeholder="Jabatan" aria-label="Jabatan" value="{{ $data->jabatan2 }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="selectUnitKerja3" class="form-label fw-semibold">Unit Kerja (Opsional)</label>
                                    <select
                                        id="selectUnitKerja3"
                                        class="form-select"
                                        name="unitkerja_id3"
                                    >
                                        @if ($data->unitkerja_id3 != null)
                                            <option value="{{ $data->unitkerja_id3 }}" selected>
                                                {{ $unitkerja3->name }}
                                            </option>
                                        @else
                                            <option value="">
                                                Pilih unit kerja
                                            </option>
                                        @endif
                                        
                                        @foreach ($unitkerjas as $unitkerja)
                                        <option value="{{ $unitkerja->id }}">
                                            {{ $unitkerja->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="jabatan3" class="form-label fw-semibold">Jabatan (Opsional)</label>
                                    <input type="text" name="jabatan3" class="form-control" id="jabatan3" placeholder="Jabatan" aria-label="Jabatan" value="{{ $data->jabatan3 }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="col">
                                    <label for="noTelepon" class="form-label">Nomor Telepon</label>
                                    <input type="tel" placeholder="08XXXXXXXXXX" name="noTelepon" class="form-control" id="noTelepon" aria-label="noTelepon" value="{{ $data->noTelepon }}">
                                </div>    
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
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
@endsection

@push('script')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        $('#selectUnitKerja').select2();
        $('#selectUnitKerja2').select2();
        $('#selectUnitKerja3').select2();
        $('#selectRole').select2();
    })
</script>

@endpush

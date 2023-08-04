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
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="number" name="nip" class="form-control" id="nip" placeholder="nip" aria-label="nip" value="{{ $data->nip }}">
                                </div>
                                <div class="col">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" id="nama" placeholder="Nama Auditor" aria-label="Nama" value="{{ $data->name }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" aria-label="Email" value="{{ $data->email }}">
                                </div>
                                <div class="col">
                                    <label for="selectRole" class="form-label"
                                        >Role</label
                                    >
                                    <select
                                        id="selectRole"
                                        class="form-select"
                                        name="role"
                                        required
                                    >
                                        <option selected>
                                            {{ $data->role }}
                                        </option>
                                        <option value="SPM">
                                            Satuan Penjaminan Mutu
                                        </option>
                                        <option value="User">
                                            User
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" aria-label="Username" value="{{ $data->username }}">
                                </div>
                                <div class="col">
                                    <label for="pwd" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Password" aria-label="Password" value="{{ $data->password }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="selectUnitKerja" class="form-label"
                                        >Unit Kerja</label
                                    >
                                    <select
                                        id="selectUnitKerja"
                                        class="form-select"
                                        name="unit_kerja"
                                        required
                                    >
                                        <option selected>
                                            {{ $data->unit_kerja }}
                                        </option>
                                        @include('inc.listAuditee')
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Jabatan" aria-label="Jabatan" value="{{ $data->jabatan }}">
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
    })
</script>

@endpush

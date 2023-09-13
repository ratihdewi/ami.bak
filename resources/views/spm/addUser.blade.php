@extends('layout.main') 

@section('title') AMI - Tambah Auditee @endsection

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
                                        <label for="nip" class="form-label">NIP <span class="text-danger fw-bold">*</span></label>
                                        <input type="string" name="nip" class="form-control" id="nip" placeholder="nip" aria-label="nip" required>
                                    </div>
                                    <div class="col">
                                        <label for="nama" class="form-label">Nama <span class="text-danger fw-bold">*</span></label>
                                        <input type="text" name="name" class="form-control" id="nama" placeholder="Nama Auditor" aria-label="Nama" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="email" class="form-label">Email <span class="text-danger fw-bold">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" aria-label="Email" required>
                                    </div>
                                    <div class="col">
                                        <label for="selectRole" class="form-label"
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
                                        <label for="username" class="form-label">Username <span class="text-danger fw-bold">*</span></label>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" aria-label="Username" required>
                                    </div>
                                    <div class="col">
                                        <label for="pwd" class="form-label">Password <span class="text-danger fw-bold">*</span></label>
                                        <input type="password" name="password" class="form-control" id="pwd" placeholder="Password" aria-label="Password" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="selectUnitKerja" class="form-label"
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
                                            <label for="jabatan" class="form-label">Jabatan <span class="text-danger fw-bold">*</span></label>
                                            <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Jabatan" aria-label="Jabatan" required>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="noTelepon" class="form-label">Nomor Telepon</label>
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
            $('#selectUnitKerja').select2();
            $('#selectRole').select2();
        })
    </script>
@endpush
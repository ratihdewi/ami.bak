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
                                <label for="nipAuditor" class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control" id="nipAuditor" placeholder="NIP Auditor" aria-label="NIP">
                            </div>
                            <div class="col">
                                <label for="namaAuditor" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="namaAuditor" placeholder="Nama Auditor" aria-label="Nama Auditor">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="fakultas" class="form-label">Fakultas</label>
                                <input type="text" name="fakultas" class="form-control" id="fakultas" placeholder="Fakultas" aria-label="Fakultas">
                            </div>
                            <div class="col">
                                <label for="programstudi" class="form-label">Program Studi</label>
                                <input type="text" name="program_studi" class="form-control" id="programstudi" placeholder="Program Studi" aria-label="Program Studi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="tanggalmulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" class="form-control" id="tanggalmulai" placeholder="Tanggal Mulai Tugas" aria-label="Tanggal Mulai Tugas">
                            </div>
                            <div class="col">
                                <label for="tanggalberakhir" class="form-label">Tanggal Berakhir</label>
                                <input type="date" name="tgl_berakhir" class="form-control" id="tanggalberakhir" placeholder="Tanggal Berakhir Tugas" aria-label="Tanggal Berakhir Tugas">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                                <input type="tel" name="noTelepon" class="form-control" id="nomorTelepon" placeholder="Nomor Telepon" aria-label="Nomor Telepon">
                            </div>
                            <div class="col">
                                <label for="esignAuditor" class="form-label">eSign</label>
                                <input class="form-control" type="file" id="esignAuditor">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection

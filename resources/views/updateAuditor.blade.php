@extends('layout.main') 

@section('title') AMI - Update Auditor @endsection

@section('container')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body p-4">
                        <form action="/updateAuditor/{{ $data->id }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col" hidden>
                                    <label for="user_id" class="form-label">ID User</label>
                                    <input type="text" name="user_id" class="form-control" id="user_id" placeholder="ID User" aria-label="ID User" value="{{ $data->user_id }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="nipAuditor" class="form-label">NIP</label>
                                    <input type="text" name="nip" class="form-control" id="nipAuditor" placeholder="NIP Auditor" aria-label="NIP" value="{{ $data->nip }}">
                                </div>
                                <div class="col">
                                    <label for="namaAuditor" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="namaAuditor" placeholder="Nama Auditor" aria-label="Nama Auditor" value="{{ $data->nama }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="fakultas" class="form-label">Fakultas</label>
                                    <input type="text" name="fakultas" class="form-control" id="fakultas" placeholder="Fakultas" aria-label="Fakultas" value="{{ $data->fakultas }}">
                                </div>
                                <div class="col">
                                    <label for="programstudi" class="form-label">Program Studi</label>
                                    <input type="text" name="program_studi" class="form-control" id="programstudi" placeholder="Program Studi" aria-label="Program Studi" value="{{ $data->program_studi }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="tanggalmulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="tgl_mulai" class="form-control" id="tanggalmulai" placeholder="Tanggal Mulai Tugas" aria-label="Tanggal Mulai Tugas" value="{{ $data->tgl_mulai }}">
                                </div>
                                <div class="col">
                                    <label for="tanggalberakhir" class="form-label">Tanggal Berakhir</label>
                                    <input type="date" name="tgl_berakhir" class="form-control" id="tanggalberakhir" placeholder="Tanggal Berakhir Tugas" aria-label="Tanggal Berakhir Tugas" value="{{ $data->tgl_berakhir }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                                    <input type="number" name="noTelepon" class="form-control" id="nomorTelepon" placeholder="Nomor Telepon" aria-label="Nomor Telepon" value="{{ $data->noTelepon }}">
                                </div>
                                <div class="col">
                                    <label for="tahunperiode" class="form-label">Tahun Periode</label>
                                    <input type="text" name="tahunperiode" class="form-control" id="tahunperiode" placeholder="Tahun Periode" aria-label="Tahun Periode" value="{{ $data->tahunperiode }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end" onclick="return confirm('Mengubah data Auditor akan mempengaruhi data User. Apakah Anda yakin ingin mengubah data?')">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

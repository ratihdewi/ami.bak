@extends('layout.main') 

@section('title') AMI - Jadwal Audit @endsection

@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form action="/insertJadwal" method="POST">
                        @csrf
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditee" class="col-sm-3 col-form-label">Auditee</label>
                            <div class="col-sm-9">
                                <select
                                id="auditee"
                                class="form-select"
                                name="auditee"
                                required
                                >
                                    <option selected disabled>
                                        Auditee
                                    </option>
                                    <option value="1">
                                        Program Studi Ilmu Komputer
                                    </option>
                                    <option value="2">
                                        Fakultas Sains dan Ilmu Komputer
                                    </option>
                                    <option value="3">Direktorat IT</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 px-5 py-3">
                            <label
                                for="auditor"
                                class="col-sm-3 col-form-label"
                                >Auditor</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="auditor"
                                    placeholder="Auditor"
                                />
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="body-card px-5 pt-5 pb-4">
                                {{-- <div class="row mb-4">
                                    <label
                                        for="subKegiatan"
                                        class="col-sm-3 col-form-label"
                                        >Subkegiatan</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="subKegiatan"
                                        />
                                    </div>
                                </div> --}}
                                <div class="row mb-4">
                                    <label
                                        for="hari_tgl"
                                        class="col-sm-3 col-form-label"
                                        >Hari/Tanggal</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="date"
                                            class="form-control"
                                            id="hari_tgl"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label
                                        for="tempat"
                                        class="col-sm-3 col-form-label"
                                        >Tempat</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="tempat"
                                            placeholder="Tempat Pelaksanaan"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label
                                        for="waktu"
                                        class="col-sm-3 col-form-label"
                                        >Waktu</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="time"
                                            class="form-control"
                                            id="waktu"
                                            placeholder="Tempat Pelaksanaan"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label
                                        for="kegiatan"
                                        class="col-sm-3 col-form-label"
                                        >Kegiatan</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="kegiatan"
                                            placeholder="Kegiatan"
                                        />
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm float-end">Tambah</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-end">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

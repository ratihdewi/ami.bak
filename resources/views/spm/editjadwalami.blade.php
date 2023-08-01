@extends('layout.main') @section('title') AMI - Jadwal Audit Mutu Internal @endsection
@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form action="/updatejadwalami-keseluruhan/{{ $jadwalami->id }}" method="POST">
                        @csrf
                        <div class="row mb-3 px-5 py-3">
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
                                    name="kegiatan"
                                    value="{{ $jadwalami->kegiatan }}"
                                />
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="body-card px-5 pt-5 pb-4">
                                <div class="row mb-4">
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
                                            name="subkegiatan"
                                            value="{{ $jadwalami->subkegiatan }}"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label
                                        for="tgl_mulai"
                                        class="col-sm-3 col-form-label"
                                        >Tanggal Mulai</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            onfocus="(this.type='date')"
                                            onblur="(this.type='text')"
                                            id="tgl_mulai"
                                            name="tgl_mulai"
                                            value="{{ $jadwalami->tgl_mulai->translatedFormat('Y-m-d') }}"
                                        />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label
                                        for="tgl_berakhir"
                                        class="col-sm-3 col-form-label"
                                        >Tanggal Berakhir</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                        type="text"
                                        class="form-control"
                                        onfocus="(this.type='date')"
                                        onblur="(this.type='text')"
                                            id="tgl_berakhir"
                                            name="tgl_berakhir"
                                            value="{{ $jadwalami->tgl_mulai->translatedFormat('Y-m-d') }}"
                                        />
                                    </div>
                                </div>
                                <button
                                    type="button"
                                    class="btn btn-primary btn-sm float-end"
                                >
                                    Tambah
                                </button>
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

@extends('layout.main') @section('title') AMI - Jadwal Audit @endsection
@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form action="/insertjadwal" method="POST">
                        @csrf
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditee" class="col-sm-3 col-form-label"
                                >Auditee</label
                            >
                            <div class="col-sm-9">
                                @include('inc.listAuditee')
                            </div>
                        </div>
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditor" class="col-sm-3 col-form-label"
                                >Auditor</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="auditor"
                                    placeholder="Auditor"
                                    name="auditor"
                                    required
                                />
                            </div>
                        </div>
                        <div class="card mb-4" id="firstJadwal">
                            <div class="body-card px-5 pt-5 pb-4">
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
                                            name="hari_tgl"
                                            required
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
                                            name="tempat"
                                            required
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
                                            name="waktu"
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
                                            name="kegiatan"
                                        />
                                    </div>
                                </div>
                                <button
                                    type="button"
                                    class="moreItems_add btn btn-primary btn-sm float-end"
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

@push('script')
    <script>
        $(document).ready(function(){
            var max_fields = 50;
            var wrapper = $("#firstJadwal");
            var add_btn = $(".moreItems_add");
            var i = 1;
            $(add_btn).click(function(e){
            e.preventDefault();
            if (i < max_fields) {
                i++;

                $(wrapper).append('<div class="card mb-4" id="otherJadwal"><div class="body-card px-5 pt-5 pb-4"><div class="row mb-4"><label for="hari_tgl"class="col-sm-3 col-form-label">Hari/Tanggal</label><div class="col-sm-9"><input type="date"class="form-control"id="hari_tgl"name="hari_tgl"required/></div></div><div class="row mb-4"><label for="tempat" class="col-sm-3 col-form-label">Tempat</label><div class="col-sm-9"><input type="text"class="form-control"id="tempat"placeholder="Tempat Pelaksanaan"name="tempat"required /></div></div><div class="row mb-4"><label for="waktu"class="col-sm-3 col-form-label">Waktu</label><div class="col-sm-9"><input type="time"class="form-control"id="waktu"placeholder="Tempat Pelaksanaan"name="waktu"/></div></div><div class="row mb-4"><label for="kegiatan"class="col-sm-3 col-form-label">Kegiatan</label><div class="col-sm-9"><input type="text"class="form-control"id="kegiatan"placeholder="Kegiatan"name="kegiatan"/></div></div><buttontype="button"class="moreItems_add btn btn-primary btn-sm float-end">Tambah</buttontype=></div></div>')
            }
            });
        });
    </script>
@endpush

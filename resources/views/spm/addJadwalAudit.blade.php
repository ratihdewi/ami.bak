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
                                <select
                                    id="auditee"
                                    class="form-select"
                                    name="auditee"
                                    required
                                >
                                    <option selected disabled>Auditee</option>
                                    <option value="Program Studi Ilmu Komputer">
                                        Program Studi Ilmu Komputer
                                    </option>
                                    <option value="Program Studi Teknik Kimia">Program Studi Teknik Kimia</option>
                                    <option value="Program Studi Teknik Mesin">Program Studi Teknik Mesin</option>
                                    <option value="Program Studi Teknik Logistik">Program Studi Teknik Logistik</option>
                                    <option value="Program Studi Teknik Elektro ">Program Studi Teknik Elektro </option>
                                    <option value="Program Studi Kimia ">Program Studi Kimia </option>
                                    <option value="Program Studi Teknik Sipil ">Program Studi Teknik Sipil </option>
                                    <option value="Program Studi Teknik Lingkungan ">Program Studi Teknik Lingkungan </option>
                                    <option value="Program Studi Komunikasi ">Program Studi Komunikasi </option>
                                    <option value="Program Studi Hubungan Internasional ">Program Studi Hubungan Internasional </option>
                                    <option value="Program Studi Teknik Geofisika ">Program Studi Teknik Geofisika </option>
                                    <option value="Program Studi Teknik Perminyakan ">Program Studi Teknik Perminyakan </option>
                                    <option value="Program Studi Teknik Geologi ">Program Studi Teknik Geologi </option>
                                    <option value="Program Studi Manajemen">Program Studi Manajemen</option>
                                    <option value="Program Studi Ekonomi">Program Studi Ekonomi</option>
                                    <option value="Fakultas Sains dan Ilmu Komputer">
                                        Fakultas Sains dan Ilmu Komputer
                                    </option>
                                    <option value="Fakultas Teknologi Industri">Fakultas Teknologi Industri</option>
                                    <option value="Fakultas Perencanaan Infrastruktur">Fakultas Perencanaan Infrastruktur</option>
                                    <option value="Fakultas Komunikasi dan Diplomasi">Fakultas Komunikasi dan Diplomasi</option>
                                    <option value="Fakultas Teknologi Eksplorasi dan Produksi">Fakultas Teknologi Eksplorasi dan Produksi</option>
                                    <option value="Fakultas Ekonomi dan Bisnis">Fakultas Ekonomi dan Bisnis</option>
                                    <option value="Direktorat IT">Direktorat IT</option>
                                </select>
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

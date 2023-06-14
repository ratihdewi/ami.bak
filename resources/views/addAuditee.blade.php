@extends('layout.main') @section('title') AMI - Tambah Auditee @endsection
@section('container')
<div class="row justify-content-center mb-5">
    <div class="col-8">
        <div class="card mt-5">
            <div class="card-body p-4">
                <form action="/insertAuditee" method="POST">
                    @csrf
                    <div class="mb-3">
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
                                Pilih unit yang akan diaudit
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
                    <div class="mb-3">
                        <label for="ketuaAuditee" class="form-label"
                            >Ketua Auditee</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="ketuaAuditee"
                            placeholder="Masukkan nama Ketua Auditee"
                            name="ketua_auditee"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="jabatanKetuaAuditee" class="form-label"
                            >Jabatan Ketua Auditee</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="jabatanKetuaAuditee"
                            placeholder="Masukkan jabatan Ketua Auditee"
                            name="jabatan_ketua_auditee"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="ketuaAuditor" class="form-label"
                            >Ketua Auditor</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="ketuaAuditor"
                            placeholder="Masukkan nama Ketua Auditor"
                            name="ketua_auditor"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="anggotaAuditor" class="form-label"
                            >Anggota Auditor</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="anggotaAuditor"
                            placeholder="Masukkan nama Anggota Auditor"
                            name="anggota_auditor"
                            required
                        />
                    </div>
                    <button type="submit" class="btn btn-primary float-end">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

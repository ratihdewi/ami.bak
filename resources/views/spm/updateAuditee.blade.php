@extends('layout.main') 

@section('title') AMI - Update Auditee @endsection

@section('container')
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body p-4">
                                <form action="/updateAuditee/{{ $data->id }}" method="POST">
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
                                                {{ $data->unit_kerja }}
                                            </option>
                                            <option value="Program Studi Ilmu Komputer">
                                                Program Studi Ilmu Komputer
                                            </option>
                                            <option value="Fakultas Sains dan Ilmu Komputer">
                                                Fakultas Sains dan Ilmu Komputer
                                            </option>
                                            <option value="Direktorat IT">Direktorat IT</option>
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
                                            value="{{ $data->ketua_auditee }}"
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
                                            value="{{ $data->jabatan_ketua_auditee }}"
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
                                            value="{{ $data->ketua_auditor }}"
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
                                            value="{{ $data->anggota_auditor }}"
                                            required
                                        />
                                    </div>
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
@endsection

@push('script')
{{-- Script form add Auditee --}}
        <script>
            const addAuditee = document.getElementById("addAuditee");
            const unitKerja = document.getElementById("selectUnitKerja");
            const ketuaAuditee = document.getElementById("ketuaAuditee");
            const jabatanAuditee = document.getElementById("jabatanKetuaAuditee");
            const ketuaAuditor = document.getElementById("ketuaAuditor");
            const anggotaAuditor = document.getElementById("anggotaAuditor");

            addAuditee.addEventListener("submit", (e) => {
                e.preventDefault();

                const unitKerjaValue = unitKerja.value;
                const ketuaAuditeeValue = ketuaAuditee.value;
                const jabatanAuditeeValue = jabatanAuditee.value;
                const ketuaAuditorValue = ketuaAuditor.value;
                const anggotaAuditorValue = anggotaAuditor.value;

                // localStorage.setItem('unit-kerja', unitKerjaValue);
                // localStorage.setItem('ketua-auditee', ketuaAuditeeValue);
                // localStorage.setItem('jabatan', jabatanAuditeeValue);
                // localStorage.setItem('ketua-auditor', ketuaAuditorValue);
                // localStorage.setItem('anggota-auditor', anggotaAuditorValue);
            })
        </script>   
@endpush



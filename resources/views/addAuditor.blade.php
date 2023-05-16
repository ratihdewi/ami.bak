<!DOCTYPE html>
<html lang="en">
    <head>
        @include('inc.head')
        <title>AMI - Tambah Auditor</title>
    </head>
    <body id="body-pd">
        @include('inc.nav_auditor')
        <div
            id="main-container"
            class="container height-100 border rounded mb-4"
        >
            <div
                class="main-form d-flex justify-content-center"
                style="max-height: 100%"
            >
                <div
                    class="form-container border w-75 py-4 px-5 mb-4"
                    style="margin-top: 80px"
                >
                    <form action="daftarAuditee" method="POST">
                        <div class="mb-3">
                            <label for="selectUnitKerja" class="form-label"
                                >Unit Kerja</label
                            >
                            <select
                                id="selectUnitKerja"
                                class="form-select"
                                name="unitKerja"
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
                                name="ketuaAuditee"
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
                                name="jabatanKetuaAuditee"
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
                                name="ketuaAuditor"
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
                                name="anggotaAuditor"
                                required
                            />
                        </div>
                    </form>
                </div>
            </div>
            <input
                class="saveAddAuditee"
                type="submit"
                name="simpan"
                value="Simpan"
            />
        </div>
        <div></div>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        @include('inc.head')
        <title>AMI - Update Auditee</title>
    </head>
    <body id="body-pd">
        @include('inc.header')
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav_logo">
                        <img src="asset/Logo-Up.png" alt="Logo-UPer" width="28" />
                        <span class="nav_logo-name"> AMI </span>
                    </a>
                    <div class="nav_list">
                        <a href="/daftarAuditor" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/auditor.png"
                                    alt="Logo-Auditor"
                                    width="25"
                            /></i>
                            <span class="nav_name"> Daftar Auditor </span>
                        </a>
                        <a href="/daftarAuditee" class="nav_link active">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/auditee.png"
                                    alt="Logo-Auditee"
                                    width="25"
                            /></i>
                            <span class="nav_name">Daftar Auditee</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/daftarTilik.png"
                                    alt="Logo-DaftarTilik"
                                    width="25"
                            /></i>
                            <span class="nav_name"> DaftarTilik </span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/jadwalAudit.png"
                                    alt="Logo-JadwalAudit"
                                    width="25"
                            /></i>
                            <span class="nav_name"> Jadwal Audit </span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/beritaAcara.png"
                                    alt="Logo-BA"
                                    width="25"
                            /></i>
                            <span class="nav_name"> Berita Acara </span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/tindakanKoreksi.png"
                                    alt="Logo-TK"
                                    width="25"
                            /></i>
                            <span class="nav_name"> Tindakan Koreksi </span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/laporan.png"
                                    alt="Logo-Laporan"
                                    width="25"
                            /></i>
                            <span class="nav_name"> Laporan </span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/RTM.png"
                                    alt="Logo-RTM"
                                    width="25"
                            /></i>
                            <span class="nav_name"> RTM </span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/dokumenResmiAMI.png"
                                    alt="Logo-Docs"
                                    width="25"
                            /></i>
                            <span class="nav_name"> Dokumen Resmi AMI </span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/tindakanKoreksi.png"
                                    alt="Logo-Role"
                                    width="25"
                            /></i>
                            <span class="nav_name"> Users </span>
                        </a>
                    </div>
                </div>
                <a href="#" class="nav_link">
                    <i class="bx bx-log-out nav_icon"></i>
                    <span class="nav_name"> SignOut </span>
                </a>
            </nav>
        </div>
        <div id="main-container" class="container height-100 border rounded">
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
        </div>
        </div>
        {{-- <div
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
                    <form id="addAuditee" action="/daftarAuditee" method="POST">
                        @csrf
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
        </div> --}}
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

                console.log("Happy");
            })
        </script>
    </body>
</html>

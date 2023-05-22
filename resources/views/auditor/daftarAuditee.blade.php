<!DOCTYPE html>
<html lang="en">
    <head>
        @include('inc.head')
        <title>AMI - Daftar Auditee</title>
    </head>
    <body id="body-pd">
        @include('inc.header')
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav_logo">
                        <img
                            src="asset/Logo-Up.png"
                            alt="Logo-UPer"
                            width="28"
                        />
                        <span class="nav_logo-name"> AMI </span>
                    </a>
                    <div class="nav_list">
                        <a href="{{ url('auditor-auditor') }}" class="nav_link">
                            <i class="bx nav_icon"
                                ><img
                                    src="asset/sideBar/auditor.png"
                                    alt="Logo-Auditor"
                                    width="25"
                            /></i>
                            <span class="nav_name"> Daftar Auditor </span>
                        </a>
                        <a href="{{ url('auditor-auditee') }}" class="nav_link active">
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
                    </div>
                </div>
                <a href="#" class="nav_link">
                    <i class="bx bx-log-out nav_icon"></i>
                    <span class="nav_name"> SignOut </span>
                </a>
            </nav>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col w-100">
                    <div
                        class="card mb-5"
                        style="margin-top: 50px; height: 100vh"
                    >
                        <div class="card-body p-4">
                            <div class="row">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="">
                                            <th class="col-1 text-center">
                                                No
                                            </th>
                                            <th class="col-2 text-center">
                                                Ketua Auditee
                                            </th>
                                            <th class="col-3 text-center">
                                                Jabatan Ketua Auditee
                                            </th>
                                            <th class="col-2 text-center">
                                                Ketua Auditor
                                            </th>
                                            <th class="col-2 text-center">
                                                Anggota Auditor
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp @foreach ($data as
                                        $item)
                                        <tr>
                                            <th scope="row" class="text-center">
                                                {{ $no++ }}
                                            </th>
                                            <td>{{ $item->ketua_auditee }}</td>
                                            <td class="text-center">
                                                {{ $item->jabatan_ketua_auditee }}
                                            </td>
                                            <td>{{ $item->ketua_auditor }}</td>
                                            <td>
                                                {{ $item->anggota_auditor }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

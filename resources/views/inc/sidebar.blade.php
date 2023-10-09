<nav class="nav mt-5">
    <div id="sidebarspm mt-5">
        <a href="/landingpage-home" class="nav_logo my-4">
            {{-- <img src="/asset/Logo-Up.png" alt="Logo-UPer" width="50" /> --}}
            {{-- <span class="nav_logo-name"> SRIKANDI </span> --}}
            <img src="/asset/SRIKANDI.png" alt="logo_aplikasi">
        </a>
        <div class="nav_list mt-3">
            <a
                href="/landingpage-home"
                class="nav_link py-1 {{ Request::routeIs('home.spm') ? 'active' : '' }}"
            >
                <i class="bi bi-house h4"></i>
                <span class="nav_name"> Home </span>
            </a>
            <a
                href="/daftarAuditor-periode"
                class="nav_link py-1 {{ Request::routeIs('auditor') ? 'active' : '' || Request::routeIs('tambahauditor') ? 'active' : '' || Request::routeIs('tampilauditor') ? 'active' : '' || Request::routeIs('auditor-periode') ? 'active' : '' || Request::routeIs('tambahauditor_') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/auditor.png"
                        alt="Logo-Auditor"
                        width="25"
                /></i> --}}
                <i class="bi bi-person h4"></i>
                <span class="nav_name"> Daftar Auditor </span>
            </a>
            <a
                href="/daftarAuditee-periode"
                class="nav_link py-1 {{ Request::routeIs('auditee') ? 'active' : '' || Request::routeIs('tambahauditee') ? 'active' : '' || Request::routeIs('tampilauditee') ? 'active' : '' || Request::routeIs('auditee-periode') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/auditee.png"
                        alt="Logo-Auditee"
                        width="25"
                /></i> --}}
                <i class="bi bi-people h4"></i>
                <span class="nav_name">Daftar Auditee</span>
            </a>
            <a
                href="/jadwalaudit"
                class="nav_link py-1 {{ Request::routeIs('jadwalaudit') ? 'active' : '' || Request::routeIs('tambahjadwal') ? 'active' : '' || Request::routeIs('tambahjadwalaudit') ? 'active' : '' || Request::routeIs('tampiljadwalaudit') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/jadwalAudit.png"
                        alt="Logo-JadwalAudit"
                        width="25"
                /></i> --}}
                <i class="bi bi-calendar h4"></i>
                <span class="nav_name"> Jadwal Audit </span>
            </a>
            <a
                href="/daftartilik-periode"
                class="nav_link py-1 {{ Request::routeIs('daftartilik-periode') ? 'active' : '' || Request::routeIs('daftartilik') ? 'active' : '' || Request::routeIs('addDT') ? 'active' : '' || Request::routeIs('daftartilik-tampildaftartilik') ? 'active' : '' || Request::routeIs('daftartilik-updatedataareadaftartilik') ? 'active' : '' || Request::routeIs('areadaftartilik') ? 'active' : '' || Request::routeIs('daftartilik-tampildaftartilik') ? 'active' : '' || Request::routeIs('daftartilik-adddaftartilik') ? 'active' : '' || Request::routeIs('daftartilik-tampilpertanyaandaftartilik') ? 'active' : '' || Request::routeIs('daftartilik-pratinjaudaftartilik') ? 'active' : '' || Request::routeIs('spm-dokumensahih') ? 'active' : '' || Request::routeIs('spm-fotokegiatan') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/daftarTilik.png"
                        alt="Logo-DaftarTilik"
                        width="25"
                /></i> --}}
                <i class="bi bi-card-checklist h4"></i>
                <span class="nav_name"> Daftar Tilik </span>
            </a>
            <a
                href="/beritaacara"
                class="nav_link py-1 {{ Request::routeIs('beritaacara') ? 'active' : '' || Request::routeIs('auditeeBA') ? 'active' : '' || Request::routeIs('BA-AMI') ? 'active' : '' || Request::routeIs('ubahdataBA') ? 'active' : '' || Request::routeIs('BA-ubahdataDokumenBAAMI') ? 'active' : '' || Request::routeIs('BA-daftarhadir') ? 'active' : '' || Request::routeIs('BA-peluangpeningkatan') ? 'active' : '' || Request::routeIs('BA-dokumenpendukung') ? 'active' : '' || Request::routeIs('BAAMI-pratinjauBA') ? 'active' : '' || Request::routeIs('spm-fotokegiatanBA') ? 'active' : '' || Request::routeIs('BA-editpeluangpeningkatan') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/beritaAcara.png"
                        alt="Logo-BA"
                        width="25"
                /></i> --}}
                <i class="bi bi-journal-bookmark h4"></i>
                <span class="nav_name"> Berita Acara </span>
            </a>
            <a
                {{-- href="" --}}
                href="/tindakankoreksi"
                class="nav_link py-1 {{ Request::routeIs('tindakankoreksi') ? 'active' : '' || Request::routeIs('tindakankoreksi-temuan') ? 'active' : '' || Request::routeIs('tindakankoreksi-formtemuan') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/tindakanKoreksi.png"
                        alt="Logo-TK"
                        width="25"
                /></i> --}}
                <i class="bi bi-files h4"></i>
                <span class="nav_name"> Tindakan Koreksi </span>
            </a>
            <a href="#" class="nav_link py-1">
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/laporan.png"
                        alt="Logo-Laporan"
                        width="25"
                /></i> --}}
                <i class="bi bi-journals h4"></i>
                <span class="nav_name"> Laporan </span>
            </a>
            <a href="#" class="nav_link py-1">
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/RTM.png"
                        alt="Logo-RTM"
                        width="25"
                /></i> --}}
                <i class="bi bi-file-bar-graph h4"></i>
                <span class="nav_name"> RTM </span>
            </a>
            <a
                href="/dokresmi"
                class="nav_link py-1 {{ Request::is('dokresmi') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/dokumenResmiAMI.png"
                        alt="Logo-Docs"
                        width="25"
                /></i> --}}
                <i class="bi bi-journal-check h4"></i>
                <span class="nav_name"> Dokumen Resmi AMI </span>
            </a>
            <a
                href="{{ route('daftaruser') }}"
                class="nav_link py-1 {{ Request::routeIs('daftaruser') ? 'active' : '' || Request::routeIs('tambahuser') ? 'active' : '' || Request::routeIs('tampiluser') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/tindakanKoreksi.png"
                        alt="Logo-Role"
                        width="25"
                /></i> --}}
                <i class="bi bi-person-gear h4"></i>
                <span class="nav_name"> Daftar User </span>
            </a>
        </div>
    </div>
</nav>

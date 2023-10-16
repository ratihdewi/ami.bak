<nav class="nav mt-5">
    <div class="sidebarauditor">
        <a href="/auditor-landingpage-home" class="nav_logo my-4">
            {{-- <img src="/asset/Logo-Up.png" alt="Logo-UPer" width="50" />
            <span class="nav_logo-name"> SRIKANDI </span> --}}
            <img src="/asset/SRIKANDI.png" alt="logo_aplikasi">
        </a>
        <div class="nav_list mt-3">
            <a
                href="/auditor-landingpage-home"
                class="nav_link py-1 {{ Request::routeIs('home.auditor') ? 'active' : '' }}"
            >
                <i class="bi bi-house h4"></i>
                <span class="nav_name"> Home </span>
            </a>
            <a
                href="/auditor-daftarauditor-periode"
                class="nav_link py-1 {{ Request::routeIs('auditor-daftarauditor') ? 'active' : '' || Request::routeIs('auditor-daftarauditor-periode') ? 'active' : '' }}"
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
                href="/auditor-daftarauditee-periode"
                class="nav_link py-1 {{ Request::routeIs('auditor-daftarauditee') ? 'active' : '' || Request::routeIs('auditor-daftarauditee-periode') ? 'active' : '' }}"
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
                href="/auditor-jadwalaudit"
                class="nav_link py-1 {{ Request::routeIs('auditor-jadwalaudit') ? 'active' : '' }}"
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
                href="/auditor-daftartilik-periode"
                class="nav_link py-1 {{ Request::routeIs('auditor-daftartilik') ? 'active' : '' || Request::routeIs('auditor-daftarTilik-areadaftartilik') ? 'active' : '' || Request::routeIs('daftartilik-tampilpertanyaandaftartilik') ? 'active' : '' || Request::routeIs('auditor-daftartilik-periode') ? 'active' : '' || Request::routeIs('auditor-daftartilik-tampilpertanyaandaftartilik') ? 'active' : '' || Request::routeIs('auditor-daftartilik-pratinjaudaftartilik') ? 'active' : '' || Request::routeIs('auditor-dokumensahih') ? 'active' : '' || Request::routeIs('auditor-fotokegiatan') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/daftarTilik.png"
                        alt="Logo-DaftarTilik"
                        width="25"
                /></i> --}}
                <i class="bi bi-card-checklist h4"></i>
                <span class="nav_name"> DaftarTilik </span>
            </a>
            <a
                href="/auditor-beritaacara"
                class="nav_link py-1 {{ Request::routeIs('auditor-beritaacara') ? 'active' : '' || Request::routeIs('auditor-auditeeBA') ? 'active' : '' || Request::routeIs('BA-AMI') ? 'active' : '' || Request::routeIs('auditor-BA-AMI') ? 'active' : '' || Request::routeIs('auditor-BA-daftarhadir') ? 'active' : '' || Request::routeIs('auditor-BA-peluangpeningkatan') ? 'active' : '' || Request::routeIs('auditor-BA-editpeluangpeningkatan') ? 'active' : '' || Request::routeIs('auditor-BA-dokumenpendukung') ? 'active' : '' || Request::routeIs('auditor-BAAMI-pratinjauBA') ? 'active' : '' || Request::routeIs('auditor-fotokegiatanBA') ? 'active' : '' }}"
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
                href="#"
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
            <a
                href="#"
                class="nav_link py-1 {{ Request::routeIs('tindakankoreksi') ? 'active' : '' || Request::routeIs('tindakankoreksi-temuan') ? 'active' : '' || Request::routeIs('tindakankoreksi-formtemuan') ? 'active' : '' }}"
            >
                {{-- <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/laporan.png"
                        alt="Logo-Laporan"
                        width="25"
                /></i> --}}
                <i class="bi bi-journals h4"></i>
                <span class="nav_name"> Laporan </span>
            </a>
            <a
                href="#"
                class="nav_link py-1 {{ Request::routeIs('tindakankoreksi') ? 'active' : '' || Request::routeIs('tindakankoreksi-temuan') ? 'active' : '' || Request::routeIs('tindakankoreksi-formtemuan') ? 'active' : '' }}"
            >
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
                href="/dokumenresmiAMI-auditor-folderall"
                class="nav_link py-1 {{ Request::routeIs('dokumenresmiAMI.auditor.folderall') ? 'active' : '' || Request::routeIs('dokumenresmiAMI.auditor.folderall.detail') ? 'active' : '' }}"
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
        </div>
    </div>
</nav>

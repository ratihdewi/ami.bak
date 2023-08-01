<nav class="nav">
    <div>
        <a href="#" class="nav_logo">
            <img src="/asset/Logo-Up.png" alt="Logo-UPer" width="28" />
            <span class="nav_logo-name"> AMI </span>
        </a>
        <div class="nav_list">
            <a
                href="/auditee-daftarauditor-periode"
                class="nav_link {{ Request::routeIs('auditee-daftarauditor') ? 'active' : '' || Request::routeIs('auditee-daftarauditor-periode') ? 'active' : '' }}"
            >
                <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/auditor.png"
                        alt="Logo-Auditor"
                        width="25"
                /></i>
                <span class="nav_name"> Daftar Auditor </span>
            </a>
            <a
                href="/auditee-daftarauditee-periode"
                class="nav_link {{ Request::routeIs('auditee-daftarauditee') ? 'active' : '' || Request::routeIs('auditee-daftarauditee-periode') ? 'active' : '' }}"
            >
                <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/auditee.png"
                        alt="Logo-Auditee"
                        width="25"
                /></i>
                <span class="nav_name">Daftar Auditee</span>
            </a>
            <a
                href="/auditee-daftartilik-periode"
                class="nav_link {{ Request::routeIs('auditee-daftartilik') ? 'active' : '' || Request::routeIs('auditee-daftarTilik-areadaftartilik') ? 'active' : '' || Request::routeIs('auditee-daftartilik-periode') ? 'active' : '' || Request::routeIs('daftartilik-pratinjaudaftartilik') ? 'active' : '' || Request::routeIs('auditee-daftartilik-tampilpertanyaandaftartilik') ? 'active' : '' || Request::routeIs('auditee-daftartilik-pratinjaudaftartilik') ? 'active' : '' || Request::routeIs('auditee-dokumensahih') ? 'active' : '' }}"
            >
                <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/daftarTilik.png"
                        alt="Logo-DaftarTilik"
                        width="25"
                /></i>
                <span class="nav_name"> DaftarTilik </span>
            </a>
            <a
                href="/auditee-jadwalaudit"
                class="nav_link {{ Request::routeIs('auditee-jadwalaudit') ? 'active' : '' || Request::routeIs('tambahjadwal') ? 'active' : '' || Request::routeIs('tambahjadwalaudit') ? 'active' : '' }}"
            >
                <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/jadwalAudit.png"
                        alt="Logo-JadwalAudit"
                        width="25"
                /></i>
                <span class="nav_name"> Jadwal Audit </span>
            </a>
            <a
                href="/auditee-beritaacara"
                class="nav_link {{ Request::routeIs('auditee-beritaacara') ? 'active' : '' || Request::routeIs('daftartilik-tampilpertanyaandaftartilik') ? 'active' : '' || Request::routeIs('auditee-auditeeBA') ? 'active' : '' || Request::routeIs('auditee-BA-AMI') ? 'active' : '' || Request::routeIs('auditee-BA-dokumenpendukung') ? 'active' : '' || Request::routeIs('auditee-BAAMI-pratinjauBA') ? 'active' : '' || Request::routeIs('auditee-BA-daftarhadir') ? 'active' : '' }}"
            >
                <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/beritaAcara.png"
                        alt="Logo-BA"
                        width="25"
                /></i>
                <span class="nav_name"> Berita Acara </span>
            </a>
            <a
                href=""
                class="nav_link {{ Request::routeIs('tindakankoreksi') ? 'active' : '' || Request::routeIs('tindakankoreksi-temuan') ? 'active' : '' || Request::routeIs('tindakankoreksi-formtemuan') ? 'active' : '' }}"
            >
                <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/tindakanKoreksi.png"
                        alt="Logo-TK"
                        width="25"
                /></i>
                <span class="nav_name"> Tindakan Koreksi </span>
            </a>
            <a
                href="#"
                class="nav_link {{ Request::routeIs('tindakankoreksi') ? 'active' : '' || Request::routeIs('tindakankoreksi-temuan') ? 'active' : '' || Request::routeIs('tindakankoreksi-formtemuan') ? 'active' : '' }}"
            >
                <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/laporan.png"
                        alt="Logo-Laporan"
                        width="25"
                /></i>
                <span class="nav_name"> Laporan </span>
            </a>
            <a
                href="#"
                class="nav_link {{ Request::routeIs('tindakankoreksi') ? 'active' : '' || Request::routeIs('tindakankoreksi-temuan') ? 'active' : '' || Request::routeIs('tindakankoreksi-formtemuan') ? 'active' : '' }}"
            >
                <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/RTM.png"
                        alt="Logo-RTM"
                        width="25"
                /></i>
                <span class="nav_name"> RTM </span>
            </a>
            <a
                href=""
                class="nav_link {{ Request::is('dokresmi') ? 'active' : '' }}"
            >
                <i class="bx nav_icon"
                    ><img
                        src="/asset/sideBar/dokumenResmiAMI.png"
                        alt="Logo-Docs"
                        width="25"
                /></i>
                <span class="nav_name"> Dokumen Resmi AMI </span>
            </a>
        </div>
    </div>
</nav>

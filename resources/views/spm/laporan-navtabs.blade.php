<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <div class="row">
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal') ? 'active' : '' }}" id="nav-cover-tab" data-bs-toggle="tab" data-bs-target="#nav-cover" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><a href="/laporan-spm-laporan-audit-mutu-internal">Cover</a></button>
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal.daftarisi') ? 'active' : '' || Request::routeIs('laporan.spm.laporan.audit.mutu.internal.editdaftarisi') ? 'active' : '' }}" id="nav-daftarisi-tab" data-bs-toggle="tab" data-bs-target="#nav-daftarisi" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><a href="/laporan-spm-laporan-audit-mutu-internal-daftarisi">Daftar Isi</a></button>
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal.katapengantar') ? 'active' : '' || Request::routeIs('laporan.spm.laporan.audit.mutu.internal.editkatapengantar') ? 'active' : '' }}" id="nav-katapengantar-tab" data-bs-toggle="tab" data-bs-target="#nav-katapengantar" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="/laporan-spm-laporan-audit-mutu-internal-katapengantar">Kata Pengantar</a></button>
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal.pendahuluan') ? 'active' : '' || Request::routeIs('laporan.spm.laporan.audit.mutu.internal.editpendahuluan') ? 'active' : '' }}" id="nav-pendahuluan-tab" data-bs-toggle="tab" data-bs-target="#nav-pendahuluan" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="/laporan-spm-laporan-audit-mutu-internal-pendahuluan">Pendahuluan</a></button>
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal.tujuanaudit') ? 'active' : '' || Request::routeIs('laporan.spm.laporan.audit.mutu.internal.tujuanaudit') ? 'active' : '' }}" id="nav-tujuanaudit-tab" data-bs-toggle="tab" data-bs-target="#nav-tujuanaudit" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="/laporan-spm-laporan-audit-mutu-internal-tujuanaudit">Tujuan Audit</a></button>
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal.lingkupaudit') ? 'active' : '' || Request::routeIs('laporan.spm.laporan.audit.mutu.internal.lingkupaudit') ? 'active' : '' }}" id="nav-lingkupaudit-tab" data-bs-toggle="tab" data-bs-target="#nav-lingkupaudit" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="/laporan-spm-laporan-audit-mutu-internal-lingkupaudit">Lingkup Audit</a></button>
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal.jadwalaudit') ? 'active' : '' }}" id="nav-jadwalaudit-tab" data-bs-toggle="tab" data-bs-target="#nav-jadwalaudit" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="/laporan-spm-laporan-audit-mutu-internal-jadwalaudit">Jadwal Audit</a></button>
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal.temuanpositif') ? 'active' : '' || Request::routeIs('laporan.spm.laporan.audit.mutu.internal.temuanpositif') ? 'active' : '' }}" id="nav-temuanpositif-tab" data-bs-toggle="tab" data-bs-target="#nav-temuanpositif" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="/laporan-spm-laporan-audit-mutu-internal-temuanpositif">Temuan Positif</a></button>
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal.rta') ? 'active' : '' || Request::routeIs('laporan.spm.laporan.audit.mutu.internal.rta') ? 'active' : '' }}" id="nav-rta-tab" data-bs-toggle="tab" data-bs-target="#nav-rta" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="/laporan-spm-laporan-audit-mutu-internal-rta">RTA</a></button>
            <button class="col nav-link tab-laporanami {{ Request::routeIs('laporan.spm.laporan.audit.mutu.internal.peluangpeningkatan') ? 'active' : '' }}" id="nav-peluangpeningkatan-tab" data-bs-toggle="tab" data-bs-target="#nav-peluangpeningkatan" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="/laporan-spm-laporan-audit-mutu-internal-peluangpeningkatan">Peluang Peningkatan</a></button>
            <button class="col nav-link tab-laporanami" id="nav-rekapitulasi-tab" data-bs-toggle="tab" data-bs-target="#nav-rekapitulasi" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="">Rekapitulasi</a></button>
            <button class="col nav-link tab-laporanami" id="nav-kesimpulanaudit-tab" data-bs-toggle="tab" data-bs-target="#nav-kesimpulanaudit" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="">Kesimpulan Audit</a></button>
            <button class="col nav-link tab-laporanami" id="nav-lampiran-tab" data-bs-toggle="tab" data-bs-target="#nav-lampiran" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><a href="">Lampiran</a></button>
        </div>
    </div>
</nav>
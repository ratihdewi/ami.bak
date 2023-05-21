<!DOCTYPE html>
<html lang="en">
  <head>
    @include('inc.head')
    <title class="title">
      @yield('title')
    </title>
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
                  <a href="/daftarAuditor" class="nav_link active">
                      <i class="bx nav_icon"
                          ><img
                              src="asset/sideBar/auditor.png"
                              alt="Logo-Auditor"
                              width="25"
                      /></i>
                      <span class="nav_name"> Daftar Auditor </span>
                  </a>
                  <a href="/daftarAuditee" class="nav_link">
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
                  <a href="user/daftarUser" class="nav_link">
                      <i class="bx nav_icon"
                          ><img
                              src="asset/sideBar/tindakanKoreksi.png"
                              alt="Logo-Role"
                              width="25"
                      /></i>
                      <span class="nav_name"> Daftar User </span>
                  </a>
              </div>
          </div>
          <a href="#" class="nav_link">
              <i class="bx bx-log-out nav_icon"></i>
              <span class="nav_name"> SignOut </span>
          </a>
      </nav>
    </div>
    <!--Container Main start-->
    <div id="main-container" class="container height-100 border rounded">
        @yield('container')
    </div>
    <!--Container Main end-->
    
</body>
</html>
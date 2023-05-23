<!DOCTYPE html>
<html lang="en">
    <head>
        @include('inc.head')
        <title>AMI - Tambah Auditee</title>
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
                        <a href="#" class="nav_link active">
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
      <div id="main-container" class="container height-100 border rounded">
          <div class="container mt-5">
              <div class="row justify-content-center">
                  <div class="col-8">
                      <div class="card">
                          <div class="card-body p-4">
                              <form action="/insertUser" method="POST">
                                  @csrf
                                  <div class="row mb-4">
                                      <div class="col">
                                          <label for="nip" class="form-label">NIP</label>
                                          <input type="number" name="nip" class="form-control" id="nip" placeholder="nip" aria-label="nip">
                                      </div>
                                      <div class="col">
                                          <label for="nama" class="form-label">Nama</label>
                                          <input type="text" name="name" class="form-control" id="nama" placeholder="Nama Auditor" aria-label="Nama">
                                      </div>
                                  </div>
                                  <div class="row mb-4">
                                      <div class="col">
                                          <label for="email" class="form-label">Email</label>
                                          <input type="email" name="email" class="form-control" id="email" placeholder="Email" aria-label="Email">
                                      </div>
                                      <div class="col">
                                          <label for="selectRole" class="form-label"
                                            >Role</label
                                          >
                                          <select
                                              id="selectRole"
                                              class="form-select"
                                              name="role"
                                              required
                                          >
                                              <option selected>
                                                  Pilih Role
                                              </option>
                                              <option value="Satuan Penjaminan Mutu">
                                                  Satuan Penjaminan Mutu
                                              </option>
                                              <option value="Auditor">
                                                  Auditor
                                              </option>
                                              <option value="Auditee">Auditee</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="row mb-4">
                                      <div class="col">
                                          <label for="username" class="form-label">Username</label>
                                          <input type="text" name="username" class="form-control" id="username" placeholder="Username" aria-label="Username">
                                      </div>
                                      <div class="col">
                                          <label for="pwd" class="form-label">Password</label>
                                          <input type="password" name="password" class="form-control" id="pwd" placeholder="Password" aria-label="Password">
                                      </div>
                                  </div>
                                  <div class="row mb-4">
                                      <div class="col">
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
                                                  Pilih unit kerja
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
                                      <div class="col">
                                          <div class="col">
                                            <label for="jabatan" class="form-label">Jabatan</label>
                                            <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Jabatan" aria-label="Jabatan">
                                        </div>    
                                      </div>
                                  </div>
                                  <button type="submit" class="btn btn-primary float-end">Submit</button>
                              </form>
                          </div>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
      {{-- Script form add Auditee --}}     
    </body>
</html>

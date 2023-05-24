@extends('layout.main') 

@section('title') AMI - Tambah Auditee @endsection

@section('container')
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
                                          <input type="string" name="nip" class="form-control" id="nip" placeholder="nip" aria-label="nip">
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
@endsection
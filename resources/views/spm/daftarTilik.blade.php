@extends('layout.main') 
@section('title') AMI - Daftar Tilik @endsection

@section('container')
    <div class="row">
      <div class="container-fluid d-flex justify-content-between mt-4">
        <form class="col-6 d-flex float-start my-auto ms-4" role="search">
          <input class="form-control me-2 h-50" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success h-50" type="submit">Search</button>
        </form>
        <a
            href="DaftarTilik-adddaftartilik"
            class="text-white me-4"
            style="font-weight: 600; text-decoration: none"
        ><button
          type="button"
          class="btn btn-primary btn-sm float-end my-3 px-3"
        >
          Tambah
        </button></a
        >
      </div>
      <div class="topSection d-flex justify-content-around mx-2 mt-4">
          {{-- <form class="col-6 d-flex float-start my-auto" role="search">
            <input class="form-control me-2 h-50" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success h-50" type="submit">Search</button>
          </form>
          <a
              href="addUser"
              class="text-white"
              style="font-weight: 600; text-decoration: none"
              ><button
                  type="button"
                  class="btn btn-primary btn-sm float-end my-3 px-3"
              >
                  Tambah
              </button></a
          > --}}
          @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
              {{ $message }}
          </div>
          @endif
        </div>
        <table class="table table-hover">
            <thead>
                <tr class="">
                    <th class="col-1 text-center">No</th>
                    <th class="col-2 text-center">Auditee</th>
                    <th class="col-1 text-center">Area</th>
                    <th class="col-1 text-center">Butir Standar</th>
                    <th class="col-1 text-center">Nomor Butir</th>
                    <th class="col-2 text-center">Batas Pengisian Respon Auditee</th>
                    <th class="col-2 text-center">Pertanyaan</th>
                    <th class="col-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp 
                <tr class="">
                    <td class="col-1 text-center">{{ $no++ }}</td>
                    <td class="col-2 text-center">Auditee01</td>
                    <td class="col-1 text-center">Pendidikan</td>
                    <td class="col-1 text-center">01 Kompetensi Lulusan/Hasil</td>
                    <td class="col-1 text-center">01</td>
                    <td class="col-2 text-center">12 Juli 2023</td>
                    <td class="col-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                    <td class="text-center">
                        <a href="#" class="mx-2"
                            ><i class="bi bi-pencil-square"></i
                        ></a>
                        <a href="#" class="mx-2"
                            ><i class="bi bi-trash"></i
                        ></a>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-1 text-center">{{ $no++ }}</td>
                    <td class="col-2 text-center">Auditee01</td>
                    <td class="col-1 text-center">Penelitian</td>
                    <td class="col-1 text-center">03 Proses</td>
                    <td class="col-1 text-center">15</td>
                    <td class="col-2 text-center">12 Juli 2023</td>
                    <td class="col-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque, explicabo.</td>
                    <td class="text-center">
                        <a href="#" class="mx-2"
                            ><i class="bi bi-pencil-square"></i
                        ></a>
                        <a href="#" class="mx-2"
                            ><i class="bi bi-trash"></i
                        ></a>
                    </td>
                </tr>
                @foreach ($data as $item)
                <tr>
                    <th scope="row" class="text-center">{{ $no++ }}</th>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">{{ $item->username }}</td>
                    <td class="text-center">{{ $item->role }}</td>
                    <td>{{ $item->unit_kerja }}</td>
                    <td class="text-center">
                        <a href="tampilUser/{{ $item->id }}" class="mx-2"
                            ><i class="bi bi-pencil-square"></i
                        ></a>
                        <a href="deleteUser/{{ $item->id }}" class="mx-2"
                            ><i class="bi bi-trash"></i
                        ></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
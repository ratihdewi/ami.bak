@extends('layout.main') @section('title') AMI - Daftar Tilik @endsection
@section('container')
<div class="container">
    <div class="container-fluid d-flex justify-content-between mt-4">
        <div class="input-group w-50 h-25 my-2 ms-4">
            {{-- <select class="form-select" id="inputGroupSelect02">
                <option selected disabled>Saring berdasarkan area</option>
                <option value="Pendidikan">Pendidikan</option>
                <option value="Penelitian">Penelitian</option>
                <option value="PkM">PkM</option>
                <option value="Tambahan">Tambahan</option>
            </select>
            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button> --}}
        </div>
        <a
            href="DaftarTilik-adddaftartilik"
            class="text-white"
            style="font-weight: 600; text-decoration: none"
            ><button
                type="button"
                class="btn btn-primary btn-sm float-end my-2 px-3"
            >
                Tambah
            </button></a
        >
    </div>
    <div class="topSection d-flex justify-content-around mx-2 mt-4">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
    </div>
    <div class="tableDaftarTilik mx-3">
        <table class="table table-hover mb-3" id="tableDaftarTilik" style="font-size: 13px">
            <thead>
                <tr class="row mt-3">
                    <th class="col-1 px-0 text-center">No</th>
                    <th class="col-2 px-0 text-center">Auditee</th>
                    <th class="col-1 px-0 text-center">Area</th>
                    <th class="col-1 px-0 text-center">Butir Standar</th>
                    <th class="col-1 px-0 text-center">Nomor Butir</th>
                    <th class="col-2 px-0 text-center">
                        Batas Pengisian Respon Auditee
                    </th>
                    <th class="col-3 px-0 text-center">Pertanyaan</th>
                    <th class="col-1 px-0 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <tr class="row">
                    <td class="col-1 px-0 text-center">{{ $no++ }}</td>
                    <td class="col-2 px-0 text-center">Auditee01</td>
                    <td class="col-1 px-0 text-center">Pendidikan</td>
                    <td class="col-1 px-0 text-center">01 Kompetensi Lulusan/Hasil</td>
                    <td class="col-1 px-0 text-center">01</td>
                    <td class="col-2 px-0 text-center">12 Juli 2023</td>
                    <td class="col-3 px-0">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </td>
                    <td class="col-1 px-0 text-center">
                        <a href="#" class="mx-2"
                            ><i class="bi bi-pencil-square"></i
                        ></a>
                        <a href="#" class="mx-2"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <tr class="row">
                    <td class="col-1 px-0 text-center">{{ $no++ }}</td>
                    <td class="col-2 px-0 text-center">Auditee01</td>
                    <td class="col-1 px-0 text-center">Penelitian</td>
                    <td class="col-1 px-0 text-center">03 Proses</td>
                    <td class="col-1 px-0 text-center">15</td>
                    <td class="col-2 px-0 text-center">12 Juli 2023</td>
                    <td class="col-3 px-0">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Eaque, explicabo.
                    </td>
                    <td class="col-1 px-0 text-center">
                        <a href="#" class="mx-2"
                            ><i class="bi bi-pencil-square"></i
                        ></a>
                        <a href="#" class="mx-2"><i class="bi bi-trash"></i></a>
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
</div>
@endsection

@push('script')
    <!-- jQuery library file -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  
      <!-- Datatable plugin JS library file -->
     <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableDaftarTilik').DataTable({ });
        });
    </script>
@endpush
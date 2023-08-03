@extends('layout.main') @section('title') AMI - Daftar User @endsection

@section('linking')
    <a href="/usercontrol" class="mx-1">
        Daftar User
    </a>/
@endsection

@section('container')

<div class="container my-4">
    <div class="row mx-1">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
    </div>
    <a
        href="addUser"
        class="text-white"
        style="font-weight: 600; text-decoration: none"
        ><button
            type="button"
            class="btn btn-primary btn-sm float-end mb-3 mt-2 px-3"
        >
            Tambah
        </button></a
    >
    <table class="table table-hover my-2" id="tableUser">
        <thead>
            <tr class="">
                <th class="col-1 text-center">No</th>
                <th class="col-2 text-center">Nama</th>
                <th class="col-2 text-center">Username</th>
                <th class="col-2 text-center">Role</th>
                <th class="col-3 text-center">Unit Kerja</th>
                <th class="col-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp @foreach ($data as $item)
            <tr>
                <th scope="row" class="text-center">{{ $no++ }}</th>
                <td>{{ $item->name }}</td>
                <td class="text-center">{{ $item->username }}</td>
                <td class="text-center">{{ $item->role }}</td>
                <td>{{ $item->unit_kerja }}</td>
                <td class="text-center">
                    <a href="tampilUser/{{ $item->id }}" class="mx-2"
                        ><button class="bg-primary border-0 rounded-1 me-2"><i class="bi bi-pencil-square text-white"></i></button></a>
                    <a href="deleteUser/{{ $item->id }}"
                        ><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white"></i></button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('script')
    <!-- jQuery library file -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  
      <!-- Datatable plugin JS library file -->
     <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableUser').DataTable({ });
        });
    </script>
@endpush
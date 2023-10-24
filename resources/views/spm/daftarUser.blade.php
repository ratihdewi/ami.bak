@extends('layout.main') @section('title') AMI - Daftar User @endsection

@section('linking')
    <a href="/usercontrol" class="mx-1">
        Daftar User
    </a>/
@endsection

@section('container')

<div class="container my-4" style="min-height: 100vh">
    <div class="row mx-1">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @elseif ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
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
    <a href="/user-sinkronisasi-sdm">
        <button type="button" class="btn btn-sinkron-data btn-sm float-end mb-3 mt-2 fw-semibold mx-2 text-white" onclick="return confirm('Apakah Anda yakin sinkronisasi data semua user?')" style="background-color: #00d215">
            <i class="bi bi-arrow-repeat text-white h6"></i> Sinkron Data
        </button>
    </a>
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
                <td>{{ $item->username }}</td>
                <td class="text-center">{{ $item->role->name }}</td>
                <td>
                    {{ $item->unitkerja->name }} <br> 
                    @foreach ($unitkerja->where('id', $item->unitkerja_id2) as $unitkerja2)
                    {{ $unitkerja2->name }}
                    @endforeach
                    @foreach ($unitkerja->where('id', $item->unitkerja_id3) as $unitkerja3)
                    {{ $unitkerja3->name }}
                    @endforeach
                </td>
                <td class="text-center">
                    <a href="tampilUser/{{ $item->id }}"><button class="bg-primary border-0 rounded-1"><i class="bi bi-pencil-square text-white" title="Edit"></i></button></a>
                    <a href="/user-sinkronisasi-sdm-user/{{ $item->nip }}" onclick="return confirm('Apakah Anda yakin sinkronisasi data user {{ $item->name }} ?')"><button class="bg-sinkron-data border-0 rounded-1" style="background-color: #00d215"><i class="bi bi-arrow-repeat text-white" title="Sinkron Data"></i></button></a>
                    <a href="deleteUser/{{ $item->id }}" onclick="return confirm('Apakah Anda yakin akan menghapus user {{ $item->name }} ?')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white" title="Hapus"></i></button></a>
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
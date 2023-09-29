
@extends('layout.main') 

@section('title') AMI - Daftar Auditor @endsection

@section('linking')
    <a href="/daftarAuditor-periode" class="mx-1">
        Periode Auditor
    </a>/
    @foreach ($periodes as $periode)
    <a href="/daftarAuditor/{{ $periode->tahunperiode2 }}" class="mx-1">
    @endforeach
    @foreach ($periodes->unique('tahunperiode1', 'keterangan') as $periode)
    {{ $periode->tahunperiode1 }}/{{ $periode->tahunperiode2 }}
    @endforeach
    </a>/
@endsection

@section('container')


<div class="container vh-100"  style="font-size: 15px">
    <div class="row my-4">
        <div class="col float-end">
            @foreach ($periodes as $periode)
            <a href="/addAuditor/{{ $periode->tahunperiode2 }}" class="text-white" style="font-weight: 600; text-decoration: none">
            @endforeach
                <button type="button" class="btn btn-primary btn-sm float-end my-3 px-3">
                    Tambah
                </button>
            </a> 
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @elseif ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endif
        <table class="table table-hover mt-5 mb-3" id="tableAuditor">
            <thead>
                <tr class="">
                    <th class="col-1 text-center">  No  </th>
                    <th class="col-2 text-center">  Nama  </th>
                    <th class="col-1 text-center">  NIP  </th>
                    <th class="col-2 text-center">  Program Studi/Fungsi  </th>
                    <th class="col-2 text-center">  Fakultas/Direktorat  </th>
                    <th class="col-2 text-center">  Nomor Telepon  </th>
                    <th class="col-2 text-center">  Aksi  </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;    
                @endphp
                @foreach ($dataAuditor as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td>{{ $item->nama }}</td>
                        <td class="text-center">{{ $item->nip }}</td>
                        <td>{{ $item->program_studi }}</td>
                        <td>{{ $item->fakultas }}</td>
                        <td class="text-center">{{ $item->noTelepon }}</td>
                        <td class="text-center">
                            <a href="/tampilAuditor/{{ $item->id }}"><button class="bg-primary border-0 rounded-1 me-1"><i class="bi bi-pencil-square text-white" title="Edit"></i></button></a>
                            <a href="/deleteAuditor/{{ $item->id }}/{{ $item->tahunperiode }}" onclick="return confirm('Apakah Anda yakin akan menghapus {{ $item->nama }} sebagai Auditor?')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white" title="Hapus"></i></button></a>
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
            $('#tableAuditor').DataTable({ });
        });
    </script>
@endpush
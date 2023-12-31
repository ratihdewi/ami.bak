
@extends('auditor.main_') 

@section('title') AMI - Daftar Auditor @endsection

@section('linking')
    <a href="/auditor-daftarauditor-periode" class="mx-1">
        Periode Auditor
    </a>/
@endsection

@section('container')
<div class="container vh-100 my-4"  style="font-size: 15px">
    <div class="row">
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
                <tr>
                    <th class="col-2 text-center">  No  </th>
                    <th class="col-8 text-center">  Tahun  </th>
                    <th class="col-2 text-center">  Aksi  </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;    
                @endphp
                @foreach ($dataAuditor as $item)
                    <tr>
                        <th scope="row" class=" col-2 text-center">{{ $no++ }}</th>
                        <th class="col-8">Periode {{ $item->tahunperiode1 }}/{{ $item->tahunperiode2 }}</th>
                        <th class="col-2 text-center"><a href="/auditor-daftarauditor/{{ $item->tahunperiode2 }}" style="text-decoration-line: none; color: black"><button class="bg-warning border-0 rounded-1"><i class="bi bi-eye-fill" title="Buka"></i></button></a></th>
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
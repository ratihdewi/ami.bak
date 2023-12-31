
@extends('auditee.main_') 

@section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/auditee-daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/
@endsection

@section('container')
<div class="container-fluid my-5"  style="font-size: 15px;min-height: 100vh">
    <div class="row">
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
                @foreach ($data_->unique('tahunperiode1') as $item)
                    <tr>
                        <th scope="row" class=" col-2 text-center">{{ $no++ }}</th>
                        <th class="col-8">Periode {{ $item->tahunperiode1 }}/{{ $item->tahunperiode2}}</th>
                        <th class="col-2 text-center"><a href="/auditee-daftartilik/{{ $item->tahunperiode2 }}" style="text-decoration-line: none; color: black"><button class="bg-warning border-0 rounded-1"><i class="bi bi-eye-fill" title="Buka"></i></button></a></th>
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
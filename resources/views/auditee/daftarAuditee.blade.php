@extends('auditee.main_') 

@section('title') AMI - Daftar Auditee @endsection

@section('linking')
    <a href="/auditee-daftarauditee-periode" class="mx-1">
        Periode Auditee
    </a>/

    @foreach ($data->unique('tahunperiode') as $item)
    <a href="/auditee-daftarauditee/{{ $item->tahunperiode }}" class="mx-1">
    @endforeach
    @foreach ($data->unique('tahunperiode') as $item)
    {{ $item->tahunperiode }}
    @endforeach
    </a>/
@endsection

@section('container')
    <div class="container justify-content-center mb-4 mt-5" style="font-size: 15px">
        <div class="row">
            <table class="table table-hover mt-5 mb-3" id="tableAuditee">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Ketua Auditee</th>
                        <th class="col-3 text-center">Jabatan Ketua Auditee</th>
                        <th class="col-2 text-center">Ketua Auditor</th>
                        <th class="col-2 text-center">Anggota Auditor</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;    
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <th scope="row" class="text-center">{{ $no++ }}</th>
                            <td>{{ $item->ketua_auditee }}</td>
                            <td class="text-center">{{ $item->jabatan_ketua_auditee }}</td>
                            <td>{{ $item->ketua_auditor }}</td>
                            <td>{{ $item->anggota_auditor }}</td>
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
            $('#tableAuditee').DataTable({ });
        });
    </script>
@endpush
@extends('auditee.main_') 

@section('title') AMI - Daftar Auditor @endsection

@section('linking')
    <a href="/auditee-daftarauditor-periode" class="mx-1">
        Periode Auditor
    </a>/

    @foreach ($dataAuditor->unique('tahunperiode') as $item)
    <a href="/auditee-daftarauditor/{{ $item->tahunperiode }}" class="mx-1">
    @endforeach
    @foreach ($dataAuditor->unique('tahunperiode') as $item)
    {{ $item->tahunperiode }}
    @endforeach
    </a>/
@endsection

@section('container')

<div class="container mt-4 mb-3" style="font-size: 15px">
    <div class="row">
        <table class="table table-hover mt-5 mb-3" id="tableAuditor">
            <thead>
                <tr class="">
                    <th class="col-1 text-center">No</th>
                    <th class="col-2 text-center">Nama</th>
                    <th class="col-1 text-center">NIP</th>
                    <th class="col-2 text-center">Program Studi</th>
                    <th class="col-2 text-center">Fakultas</th>
                    <th class="col-2 text-center">Nomor Telepon</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp 
                @foreach ($dataAuditor as $item)
                <tr>
                    <td scope="row" class="text-center">{{ $no++ }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->nip }}</td>
                    <td>{{ $item->program_studi }}</td>
                    <td>{{ $item->fakultas }}</td>
                    <td class="text-center">{{ $item->noTelepon }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection @push('script')
<!-- jQuery library file -->
<script
    type="text/javascript"
    src="https://code.jquery.com/jquery-3.5.1.js"
></script>

<!-- Datatable plugin JS library file -->
<script
    type="text/javascript"
    src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"
></script>
<script>
    $(document).ready(function () {
        $("#tableAuditor").DataTable({});
    });
</script>
@endpush

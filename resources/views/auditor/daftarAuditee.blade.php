@extends('auditor.auditorlayouts.auditor_main') @section('title') AMI - Daftar
Auditee @endsection @section('container')

<div class="row">
    <table class="table table-hover">
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
            @php $no = 1; @endphp @foreach ($data as $item)
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

@endsection

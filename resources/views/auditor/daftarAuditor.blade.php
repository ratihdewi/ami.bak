@extends('auditor.auditorlayouts.auditor_main') @section('title') AMI - Daftar
Auditor @endsection @section('container')

<div class="container">
    <div class="row">
        <table class="table table-hover">
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
                @php $no = 1; @endphp @foreach ($dataAuditor as $item)
                <tr>
                    <th scope="row" class="text-center">{{ $no++ }}</th>
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

@endsection

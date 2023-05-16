
@extends('layout.main') @section('title') AMI - Daftar Auditor @endsection
@section('container')

<a
    href="addAuditor"
    class="text-white"
    style="font-weight: 600; text-decoration: none"
    ><button type="button" class="btn btn-primary btn-sm float-end my-4 px-3">
        Tambah
    </button></a
>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIP</th>
            <th scope="col">Program Studi</th>
            <th scope="col">Fakultas</th>
            <th scope="col">Nomor Telepon</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataAuditor as $auditor)
            <tr>
                <th scope="row">{{ $auditor["no"] }}</th>
                <td>{{ $auditor["nama"] }}</td>
                <td>{{ $auditor["nip"] }}</td>
                <td>{{ $auditor["prodi"] }}</td>
                <td>{{ $auditor["fakultas"] }}</td>
                <td>{{ $auditor["nomor_telepon"] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection


@extends('layout.main') 

@section('title') AMI - Daftar Auditor @endsection

@section('container')


<div class="container">
    <div class="row">
        <a
            href="addAuditor"
            class="text-white"
            style="font-weight: 600; text-decoration: none"
            ><button type="button" class="btn btn-primary btn-sm float-end my-3 px-3">
                Tambah
            </button></a
        >
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <table class="table table-hover">
            <thead>
                <tr class="">
                    <th class="col-1 text-center">  No  </th>
                    <th class="col-2 text-center">  Nama  </th>
                    <th class="col-1 text-center">  NIP  </th>
                    <th class="col-2 text-center">  Program Studi  </th>
                    <th class="col-2 text-center">  Fakultas  </th>
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
                            <a href="tampilAuditor\{{ $item->id }}" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                            <a href="deleteAuditor\{{ $item->id }}" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

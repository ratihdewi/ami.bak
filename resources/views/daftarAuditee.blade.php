@extends('layout.main') 

@section('title') AMI - Daftar Auditee @endsection

@section('container')
    <div class="row justify-content-center">
        <div class="row">
                            <a
                                href="addAuditee"
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
                                        <th class="col-1 text-center">No</th>
                                        <th class="col-2 text-center">Ketua Auditee</th>
                                        <th class="col-3 text-center">Jabatan Ketua Auditee</th>
                                        <th class="col-2 text-center">Ketua Auditor</th>
                                        <th class="col-2 text-center">Anggota Auditor</th>
                                        <th class="col-2 text-center">Aksi</th>
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
                                            <td class="text-center">
                                                <a href="tampilAuditee/{{ $item->id }}" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                                                <a href="deleteAuditee/{{ $item->id }}" class="mx-2"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
            {{-- <div class="col w-100">
                <div class="card mb-5" style="margin-top: 50px; height: 100vh">
                    <div class="card-body p-4">
                        
                    </div>
                </div>
            </div>  --}}
        </div>
    </div>
@endsection
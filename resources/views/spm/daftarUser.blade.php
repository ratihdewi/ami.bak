
@extends('layout.main') 

@section('title') AMI - Daftar User @endsection

@section('container')

                        <div class="row">
                            <a
                                href="addUser"
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
                                        <th class="col-2 text-center">Nama</th>
                                        <th class="col-3 text-center">Username</th>
                                        <th class="col-2 text-center">Role</th>
                                        <th class="col-2 text-center">Unit Kerja</th>
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
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->username }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>{{ $item->unit_kerja }}</td>
                                            <td class="text-center">
                                                <a href="tampilUser/{{ $item->id }}" class="btn btn-warning">Edit</a>
                                                <a href="deleteUser/{{ $item->id }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>

@endsection
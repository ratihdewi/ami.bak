@extends('layout.main-jadwal') @section('title') AMI - Jadwal Audit @endsection
@section('container')

<div class="container">
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr class="">
                    <th class="col-1 text-center">No</th>
                    <th class="col-2 text-center">Auditee</th>
                    <th class="col-1 text-center">Auditor</th>
                    <th class="col-2 text-center">Tempat</th>
                    <th class="col-2 text-center">Hari/Tanggal</th>
                    <th class="col-2 text-center">Waktu</th>
                    <th class="col-2 text-center">Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp @foreach ($data as $item)
                <tr>
                    <th scope="row" class="text-center">{{ $no++ }}</th>
                    <td>{{ $item->auditee }}</td>
                    <td>{{ $item->auditor }}</td>
                    <td>{{ $item->tempat }}</td>
                    <td>{{ $item->hari_tgl }}</td>
                    <td>{{ $item->waktu }}</td>
                    <td>{{ $item->kegiatan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

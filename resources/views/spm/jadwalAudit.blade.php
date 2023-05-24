@extends('layout.main-jadwal') @section('title') AMI - Jadwal Audit @endsection
@section('container')

<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
        </li>
    </ul>
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
{{-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example">

    <!-- Example Code -->
    
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>
    
    <!-- End Example Code -->
  </body>
</html> --}}
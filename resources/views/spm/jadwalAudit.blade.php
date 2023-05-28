@extends('layout.main') 

@section('title') AMI - Jadwal Audit @endsection

@section('container')

<div class="container mt-4" style="font-size: 13px">
  {{-- Search Jadwal --}}
  <div class="search my-5 p-5 mx-5 text-white rounded">
    <form action="" method="get">
      @csrf
      <div class="input-group">
        <select class="form-select mx-2 border border-secondary rounded" id="inputGroupSelect04" aria-label="Example select with button addon">
          <option selected disabled>Filter Auditee</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        <select class="form-select mx-2 border border-secondary rounded" id="inputGroupSelect04" aria-label="Example select with button addon">
          <option selected disabled>Filter Tahun</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        <button class="btn btn-primary mx-2 border rounded" type="button">Cari</button>
      </div>
    </form>
  </div>
  {{-- Search Jadwal End --}}

  {{-- JadwalAudit --}}

  <div class="jadwalAudit mb-5">
    <ul class="nav nav-tabs flex-row justify-content-start" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Jadwal Audit</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Ketersediaan Jadwal Auditor dan Auditee</button>
      </li>
      <a href="jadwalaudit-tambahjadwal" class="ms-auto">
        <button type="button" class="btn btn-primary btn-sm my-2">Tambah Jadwal</button>
      </a>
      
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active w-100" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Auditee</th>
                        <th class="col-2 text-center">Auditor</th>
                        <th class="col-1 text-center">Tempat</th>
                        <th class="col-2 text-center">Hari/Tanggal</th>
                        <th class="col-1 text-center">Waktu</th>
                        <th class="col-2 text-center">Kegiatan</th>
                        <th class="col-1 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp @foreach ($data as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td class="text-center">{{ $item->auditee }}</td>
                        <td class="text-center">{{ $item->auditor }}</td>
                        <td class="text-center">{{ $item->tempat }}</td>
                        <td class="text-center">{{ $item->hari_tgl->translatedFormat('l, d M Y') }}</td>
                        <td class="text-center">{{ $item->waktu }}</td>
                        <td class="text-center">{{ $item->kegiatan }}</td>
                        <td class="text-center">
                          <a href="#" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="#" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <div class="tab-pane fade w-100" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Auditee</th>
                        <th class="col-2 text-center">Auditor</th>
                        <th class="col-1 text-center">Tempat</th>
                        <th class="col-2 text-center">Hari/Tanggal</th>
                        <th class="col-1 text-center">Waktu</th>
                        <th class="col-2 text-center">Kegiatan</th>
                        <th class="col-1 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp @foreach ($data as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td class="text-center">{{ $item->auditee }}</td>
                        <td class="text-center">{{ $item->auditor }}</td>
                        <td class="text-center">{{ $item->tempat }}</td>
                        <td class="text-center">{{ $item->hari_tgl->translatedFormat('l, d M Y') }}</td>
                        <td class="text-center">{{ $item->waktu }}</td>
                        <td class="text-center">{{ $item->kegiatan }}</td>
                        <td class="text-center">
                          <a href="#" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="#" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
  
  {{-- Jadwal keseluruhan --}}
  <div class="jadwalKeseluruhan" style="margin-top: 100px">
    <ul class="nav nav-tabs flex-row justify-content-start jadwalAudit mt-5" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Jadwal Audit Mutu Internal</button>
      </li>
      <a href="jadwalauditAMI-tambahjadwal" class="ms-auto">
        <button type="button" class="btn btn-primary btn-sm my-2">Tambah Jadwal</button>
      </a>
      
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active w-100" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <table class="table table-hover mt-2">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-3 text-center">Kegiatan</th>
                        <th class="col-3 text-center">Waktu</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no_ = 1; @endphp
                    <tr>
                        <th scope="row" class="text-center" value='{{ $no++ }}' >{{ $no_++ }}</th>
                        <td class="">Persiapan</td>
                        <td class="text-center">3 Oktober 2023</td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="deleteJadwalKeseluruhan" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center" value='2'>2</th>
                        <td class="">Pelatihan Auditor</td>
                        <td class="text-center">11 Oktober 2023</td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="deleteJadwalKeseluruhan" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    {{-- <tr>
                        <th scope="row" class="text-center"></th>
                        <td class="" id="kegiatan"></td>
                        <td class="text-center" id="waktu"></td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="btn btn-warning">Edit</a>
                          <a href="deleteJadwalKeseluruhan" class="btn btn-danger">Delete</a>
                        </td>
                    </tr> --}}
                    {{-- @foreach ($data as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td class="text-center">{{ $item->auditee }}</td>
                        <td class="text-center">{{ $item->auditor }}</td>
                        <td class="text-center">{{ $item->tempat }}</td>
                        <td class="text-center">{{ $item->hari_tgl->translatedFormat('l, d M Y') }}</td>
                        <td class="text-center">{{ $item->waktu }}</td>
                        <td class="text-center">{{ $item->kegiatan }}</td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
      </div>
      <div class="tab-panel fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
          <table class="table table-hover mt-2">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Kegiatan</th>
                        <th class="col-2 text-center">Waktu</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    <tr>
                        <th scope="row" class="text-center" value='{{ $no++ }}' >{{ $no++ }}</th>
                        <td class="">Persiapan</td>
                        <td class="text-center">3 Oktober 2023</td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="deleteJadwalKeseluruhan" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center" value='{{ $no++ }}'>{{ $no++ }}</th>
                        <td class="">Pelatihan Auditor</td>
                        <td class="text-center">11 Oktober 2023</td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="btn btn-warning">Edit</a>
                          <a href="deleteJadwalKeseluruhan" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center"></th>
                        <td class="" id="kegiatan"></td>
                        <td class="text-center" id="waktu"></td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="btn btn-warning">Edit</a>
                          <a href="deleteJadwalKeseluruhan" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    {{-- @foreach ($data as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td class="text-center">{{ $item->auditee }}</td>
                        <td class="text-center">{{ $item->auditor }}</td>
                        <td class="text-center">{{ $item->tempat }}</td>
                        <td class="text-center">{{ $item->hari_tgl->translatedFormat('l, d M Y') }}</td>
                        <td class="text-center">{{ $item->waktu }}</td>
                        <td class="text-center">{{ $item->kegiatan }}</td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
    
</div>

@endsection

@push('script')

<script>
  $(document).ready(function(){
    
  })
</script>
    
@endpush
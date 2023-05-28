@extends('layout.main')

@section('title')
    AMI - Dokumen Resmi
@endsection

@section('container')
  <div class="card w-75 mx-auto mt-5">
    <div class="body-card text-center py-4 dokresmi">
      <h4 class="fw-bold">Dokumen Resmi Audit Muti Internal (AMI)</h4>
      <h5>Surat Keputusan (SK) dan Pedoman Audit Mutu Internal (AMI)</h5>
      <form class="mx-auto" action="" method="get">
        @csrf
        <div class="row d-flex justify-content-center mx-auto w-75 mt-4">
        <div class="col-5">
          <select class="form-select my-3 py-2" id="floatingSelectGrid" name="hari_tgl">
              <option selected>Saring Tahun</option>
              <option value="2023" selected={{ isset($_GET['hari_tgl']) && $_GET['hari_tgl'] == '2023'}}>2023</option>
              <option value="2022" selected={{ isset($_GET['hari_tgl']) && $_GET['hari_tgl'] == '2022'}}>2022</option>
              <option value="2021" selected={{ isset($_GET['hari_tgl']) && $_GET['hari_tgl'] == '2021'}}>2021</option>
            </select>
        </div>
        <div class="col-3">
          <button class="btn btn-primary my-3 py-2 px-4" type="submit">Cari</button>
        </div>
      </form>
      
      </div>
    </div>
  </div>
  <div class="jadwalKeseluruhan" style="margin-top: 50px">
    <ul class="nav nav-tabs flex-row justify-content-start jadwalAudit mt-5" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">SK dan Pedoman</button>
      </li>
      <a href="jadwalaudit-tambahjadwal" class="ms-auto">
        <button type="button" class="btn btn-primary btn-sm my-2">Tambah File</button>
      </a>
      
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active w-100" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <table class="table table-hover mt-2">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Nama File</th>
                        <th class="col-2 text-center">Jenis</th>
                        <th class="col-2 text-center">Diedit</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td class="">SK AMI 2023</td>
                        <td class="text-center">SK</td>
                        <td class="text-center">28/03/2023 12:34</td>
                        <td class="text-center">
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
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        Kalender Ketersediaan Jadwal
      </div>
    </div>
  </div>    
@endsection
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
  <div class="jadwalKeseluruhan mx-3" style="margin-top: 50px">
    <ul class="nav nav-tabs flex-row justify-content-between jadwalAudit mt-5" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">SK dan Pedoman</button>
      </li>
      <button type="button" class="btn btn-primary btn-sm my-2" data-bs-toggle="modal" data-bs-target="#formBatasAkses">Tambah File</button>
      
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
                        <td class=""><a href="/auditor-dokresmi">SK AMI 2023</a></td>
                        <td class="text-center">SK</td>
                        <td class="text-center">28/03/2023 12:34</td>
                        <td class="text-center">
                          <a href="#" class="mx-2"><i class="bi bi-trash"></i></a>
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
        <div class="modal" id="formBatasAkses">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Batas Akses Pengisian Tanda Tangan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form>
                  <div class="mb-3">
                    <label for="namaPengisi" class="col-form-label">Auditor/Auditee</label>
                    <input type="text" class="form-control" id="namaPengisi" placeholder="Nama Auditor atau Auditee">
                  </div>
                  <div class="mb-3">
                    <label for="tglMulaiPengisian" class="col-form-label">Tanggal mulai persetujuan</label>
                    <input type="date" class="form-control" id="tglMulaiPengisian" placeholder="Masukkan tanggal mulai persetujuan tindakan koreksi">
                  </div>
                  <div class="mb-3">
                    <label for="tglBerakhirPengisian" class="col-form-label">Tanggal berakhir persetujuan</label>
                    <input type="date" class="form-control" id="tglBerakhirPengisian" placeholder="Masukkan tanggal berakhir persetujuan tindakan koreksi">
                  </div>
                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Simpan</button>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- <div class="preview" id="previewDokResmi">
      <embed src="/dokumen/example.pdf" type="application/pdf" width="300" height="200">
      <object data="/dokumen/example.pdf" type="application/pdf" width="300" height="200">
        
      </object>
      <iframe src="/dokumen/example.pdf"
        width="250"
        height="200">
    </div>     --}}
@endsection

@push('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.3.200/build/pdf.min.js"></script>
@endpush
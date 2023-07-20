@extends('layout.main') @section('title') AMI - Temuan Berita Acara @endsection
@section('container')
  <div class="container">
      <div class="d-flex my-4 justify-content-between">
        <div class="btn-left">
          <a href="/auditeeBA"><button class="btn btn-primary btn-sm me-2" type="button">Kembali</button></a>
          {{-- <a href="/ubahdataBA"><button class="btn btn-primary btn-sm" type="button">Ubah data</button></a> --}}
        </div>
        <div class="btn-right">
          <button class="btn btn-primary btn-sm" type="button">Cetak</button>
        </div>
      </div>
      <div class="topSection d-flex justify-content-around mx-2 mt-4">
          @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
              {{ $message }}
          </div>
          @elseif ($message = Session::get('error'))
          <div class="alert alert-danger" role="alert">
              {{ $message }}
          </div>
          @endif
      </div>
      <div class="dataDokumenAMI mb-4">
        <div class="dataDokBA mt-3">
          <ul class="nav nav-tabs flex-row justify-content-between" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Data Dokumen BA</button>
            </li>
            <li>
              @foreach ($auditee_ as $ba)
              <a href="/BA-ubahdataDokumenBAAMI/{{ $ba->id }}">
              @endforeach
                <button class="btn btn-primary btn-sm" type="button">Ubah data</button>
              </a>
            </li>
            
          </ul>
          
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3">
          
          <div class="row">
            <div class="col-3 label border py-2 fw-semibold text-start">Judul Dokumen</div>
            <div class="col-9 border py-2 text-start">
              @foreach ($ba_ami as $ba)
                {{ $ba->judulDokumen }}
              @endforeach
            </div>
          </div>
          <div class="row">
            <div class="col label border py-2 fw-semibold text-start">Kode Dokumen</div>
            <div class="col border py-2 text-start">
              @foreach ($ba_ami as $ba)
                {{ $ba->kodeDokumen }}
              @endforeach
            </div>
            <div class="col label border py-2 fw-semibold text-start">Revisi Ke-</div>
            <div class="col border py-2 text-start">
              @foreach ($ba_ami as $ba)
                {{ $ba->revisiKe }}
              @endforeach
            </div>
          </div>
          <div class="row">
            <div class="col label border py-2 fw-semibold text-start">Tanggal Revisi</div>
            <div class="col border py-2 text-start">
              @foreach ($ba_ami as $ba)
              {{ $ba->tgl_revisi }}
              @endforeach
            </div>
            <div class="col label border py-2 fw-semibold text-start">Tanggal Berlaku</div>
            <div class="col border py-2 text-start">
              @foreach ($ba_ami as $ba)
              {{ $ba->tgl_berlaku }}
              @endforeach
            </div>
          </div>
        </div>
        
      </div>
      
      <div class="BA_AMI mb-4">
        <div class="dataDokBA mt-5">
          <ul class="nav nav-tabs flex-row justify-content-between" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Berita Acara AMI</button>
            </li>
          </ul>
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3">
              <div class="row">
                <div class="col-3 label border py-2 fw-semibold text-start">Unit Kerja</div>
                @foreach ($jadwalAudit_->unique('auditee_id') as $jadwalAudit)
                <div class="col-9 border py-2 text-start">{{ $jadwalAudit->auditee->unit_kerja }}</div>
                @endforeach
              </div>
            <div class="row">
              <div class="col label border py-2 fw-semibold text-start">Tahun Ajaran</div>
              <div class="col border py-2 text-start">
                @foreach ($jadwalAudit_->unique('auditee_id') as $jadwalAudit)
                  {{ $jadwalAudit->th_ajaran1 }}/{{ $jadwalAudit->th_ajaran2 }}
                @endforeach
              </div>
              <div class="col label border py-2 fw-semibold text-start">Waktu</div>
              <div class="col border py-2 text-start">
                @foreach ($jadwalAudit_ as $jadwalAudit)
                {{ $jadwalAudit->waktu->isoFormat('hh:mm') }} WIB,
                @endforeach 
              </div>
            </div>
            <div class="row">
              <div class="col label border py-2 fw-semibold text-start">Hari/Tanggal</div>
              <div class="col border py-2 text-start">
                @foreach ($jadwalAudit_ as $jadwalAudit)
                {{ $jadwalAudit->hari_tgl->translatedFormat('l, d M Y') }}; 
                @endforeach
              </div>
              <div class="col label border py-2 fw-semibold text-start">Media</div>
              <div class="col border py-2 text-start">
                @foreach ($jadwalAudit_ as $jadwalAudit)
                {{ $jadwalAudit->tempat }},   
                @endforeach
              </div>
              </div>
            </div>
        </div>
      </div>
        
      <div class="daftarHadir mb-4">
        <div class="dataDokBA mt-5 mx-3 mx-3">
          <ul class="nav nav-tabs flex-row justify-content-between" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Berita Acara AMI - Daftar Hadir</button>
            </li>
            <li>
              @foreach ($auditee_ as $auditee)
              <a href="/BA-daftarhadir/{{ $auditee->id }}"><button class="btn btn-primary btn-sm" type="button">
              @endforeach
              Ubah data</button>
              </a>
            </li>
          </ul>
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Auditor/Auditee</th>
                        <th class="col-3 text-center">Nama</th>
                        <th class="col-2 text-center"><i>eSign</i></th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($daftarhadir_ as $daftarhadir)
                    <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="col-2 text-center">{{ $daftarhadir->posisi }}</td>
                      <td class="col-3 text-center">{{ $daftarhadir->namapeserta }}</td>
                      <td class="col-2 text-center">
                        @if ($daftarhadir->eSign == 'Hadir')
                          <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('https://www.google.com/', 'QRCODE', 2, 2)}}" alt="barcode" />
                        @else
                          <a href="/BA-esignpeserta/{{ $daftarhadir->id }}"><i class="bi bi-pen" type="button"></i></a>
                        @endif
                      </td>
                      <td class="col-2 text-center">
                        <a href="/BA-deletedaftarhadir/{{ $daftarhadir->id }}" class="mx-2" onclick="return confirm('Apakah Anda yakin akan menghapus data peserta {{ $daftarhadir->namapeserta }} ?')"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <div class="temuanAudit mb-4">
        <div class="dataDokBA mt-5 mx-3">
          <ul class="nav nav-tabs flex-row justify-content-between" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Temuan Audit</button>
            </li>
          </ul>
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">KTS/OB<br>(Inisial Auditor)</th>
                        <th class="col-3 text-center">Referensi<br>(Butir Mutu)</th>
                        <th class="col-2 text-center">Temuan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pertanyaan_ as $temuanAudit)
                    <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="col-2 text-center">{{ $temuanAudit->Kategori }}<br>{{ $temuanAudit->inisialAuditor }}</td>
                      <td class="col-3 text-center">{{ $temuanAudit->referensi }}<br>{{ $temuanAudit->nomorButir }}</td>
                      <td class="col-2 text-start">{{ $temuanAudit->narasiPLOR }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <div class="peluangPeningkatan mb-4">
        <div class="dataDokBA mt-5 mx-3">
          <ul class="nav nav-tabs flex-row justify-content-between" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Peluang Peningkatan</button>
            </li>
            <li>
              @foreach ($auditee_ as $auditee)
              <a href="/BA-peluangpeningkatan/{{ $auditee->id }}">
              @endforeach
              <button class="btn btn-primary btn-sm" type="button">Ubah data</button>
              </a>
            </li>
          </ul>
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Aspek/Bidang</th>
                        <th class="col-3 text-center">Kelebihan</th>
                        <th class="col-2 text-center">Peluang untuk Peningkatan</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pelpeningkatan_ as $peningkatan)
                    <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="col-2 text-start">{{ $peningkatan->aspek }}</td>
                      <td class="col-3 text-start">{{ $peningkatan->kelebihan }}</td>
                      <td class="col-2 text-start">{{ $peningkatan->peningkatan }}</td>
                      <td class="col-2 text-center">
                        <a href="/BA-editpeluangpeningkatan/{{ $peningkatan->id }}" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                        <a href="/BA-deletepeluangpeningkatan/{{ $peningkatan->id }}" class="mx-2"><i class="bi bi-trash" onclick="return confirm('Apakah Anda yakin akan menghapus data peluang peningkatan ini?')"></i></a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <div class="dokumenPendukung mb-4">
        <div class="dataDokBA mt-5 mx-3">
          <ul class="nav nav-tabs flex-row justify-content-between" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Dokumen Pendukung</button>
            </li>
            <li>
              @foreach ($auditee_ as $auditee)
              <a href="/BA-dokumenpendukung/{{ $auditee->id }}">
              @endforeach
              <button class="btn btn-primary btn-sm" type="button">Ubah data</button>
              </a>
            </li>
          </ul>
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3 mx-3">
          <div class="row mt-4">
            <div class="col-1 logoDokumen bg-warning bg-opacity-10 border border-info rounded-start py-3"><i class="bi bi-file-earmark-text-fill h2"></i></div>
            <div class="col-3 infoDokumen bg-warning bg-opacity-10 border border-info rounded-end text-start py-3">
              @if ($dokumenpendukung_ == null)
                  <h3 class="fs-6 mb-0">
                    Tidak ada Dokumen Pendukung
                  </h3>
                <p class="fs-6 mb-0"></p>
              @else
              @foreach ($dokumenpendukung_ as $dokpendukung)
                <h3 class="fs-6 mb-0">
                  @foreach ($auditee_ as $auditee)
                  <a href="/BA-lihatdokumenpendukung/{{ $auditee->id }}">
                  @endforeach
                  {{ $dokpendukung->namaDokumen }}</a></h3>
                <p class="fs-6 mb-3">{{ $dokpendukung->kodeDokumen }}</p>
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="persetujuan mb-4">
        <div class="dataDokBA mt-5 mx-3">
          <ul class="nav nav-tabs flex-row justify-content-between" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Persetujuan</button>
            </li>
          </ul>
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Jabatan</th>
                        <th class="col-3 text-center">Nama</th>
                        <th class="col-2 text-center"><i>eSign</i></th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($auditee_ as $auditee)
                    <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="col-2 text-center">Ketua Auditor</td>
                      <td class="col-3 text-start">{{ $auditee->ketua_auditor }}</td>
                      <td id="signed" class="col-2 text-center">
                        @foreach ($ba_ami as $ba)
                            
                            @if ($ba->eSignAuditor == "Disetujui")
                              <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('https://www.google.com/', 'QRCODE', 3, 3)}}" alt="barcode" />
                            @else
                              @foreach ($ba_ami as $ba)
                              <a href="/BAAMI-approvalKetuaAuditor/{{ $ba->id }}">
                              @endforeach
                                <button class="border-0" type="button" onclick="return confirm('Apakah Anda yakin akan menyetujui seluruh data yang akan digunakan pada Dokumen BA AMI ini?')" 
                                @if (Auth::user()->name != $auditee->ketua_auditor)
                                  {{ "disabled" }}
                                @endif>
                                <i class="bi bi-pen"></i>
                                </button>
                              </a>
                            @endif
                        @endforeach
                      </td>
                    </tr>
                    <tr>
                        <td scope="row" class="text-center">{{ $no++ }}</td>
                        <td class="col-2 text-center">Ketua Auditee</td>
                        <td class="col-3 text-start">{{ $auditee->ketua_auditee }}</td>
                        <td id="signed" class="col-2 text-center">
                          @foreach ($ba_ami as $ba)
                            @if ($ba->eSignAuditee == "Disetujui")
                              <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('https://www.google.com/', 'QRCODE', 3, 3)}}" alt="barcode" />
                            @else
                              @foreach ($ba_ami as $ba)
                              <a href="/BAAMI-approvalKetuaAuditee/{{ $ba->id }}">
                              @endforeach
                              <button class="border-0" type="button" onclick="return confirm('Apakah Anda yakin akan menyetujui seluruh data yang akan digunakan pada Dokumen BA AMI ini?')" 
                              @if (Auth::user()->name != $auditee->ketua_auditee)
                                {{ "disabled" }}
                              @endif>
                              <i class="bi bi-pen"></i>
                              </button>
                              </a>
                            @endif
                          @endforeach
                        </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>         
  </div>
@endsection

@push('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.3.200/build/pdf.min.js"></script>
    {{-- <script>
      var button = document.getElementById('eSign');
      var contentDiv = document.getElementById('signed');

      // Event listener untuk saat button diklik
      button.addEventListener('click', function() {
          // Ganti isi dari elemen div dengan ID content
          contentDiv.innerHTML = '<img src="data:image/png;base64,{{DNS2D::getBarcodePNG("https://www.google.com/", 'QRCODE', 3, 3)}}" alt="barcode" />';
      });
    </script> --}}
@endpush
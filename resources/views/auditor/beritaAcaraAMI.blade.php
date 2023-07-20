@extends('auditor.main_') @section('title') AMI - Temuan Berita Acara @endsection
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
                        @if ($daftarhadir->posisi == Auth::user()->role && $daftarhadir->namapeserta == Auth::user()->name)
                        <a href="/BA-esignpeserta/{{ $daftarhadir->id }}">
                        @endif
                          @if ($daftarhadir->eSign == 'Hadir')
                          <i class="bi bi-check2-square"></i>
                          @else
                          <i class="bi bi-pen" type="button"></i>
                          @endif
                        </a>
                      </td>
                      <td class="col-2 text-center">
                        <a href="/BA-daftarhadir/{{ $auditee->id }}/#{{ $daftarhadir->id }}" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                        <a href="/BA-deletedaftarhadir/{{ $daftarhadir->id }}" class="mx-2"><i class="bi bi-trash"></i></a>
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
                    @foreach ($daftartilik_ as $daftartilik)
                    <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="col-2 text-center">{{ $daftartilik->Kategori }}<br>{{ $daftartilik->inisialAuditor }}</td>
                      <td class="col-3 text-center">{{ $daftartilik->referensi }}<br>{{ $daftartilik->nomorButir }}</td>
                      <td class="col-2 text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, necessitatibus eveniet! Explicabo doloremque facere autem tenetur dolorem minus quos totam.</td>
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
            <li><a href="/ubahdataBA"><button class="btn btn-primary btn-sm" type="button">Ubah data</button></a></li>
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
                    <tr>
                        <td scope="row" class="text-center">{{ $no++ }}</td>
                        <td class="col-2 text-start">Standar Pendidikan A.01.17 dan A.01.18 tentang tugas mahasiswa dalam bentuk project based learning (PBL). </td>
                        <td class="col-3 text-start">Program studi telah melakukannya melalui mata kuliah capstone design.</td>
                        <td class="col-2 text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, necessitatibus eveniet! Explicabo doloremque facere autem tenetur dolorem minus quos totam.</td>
                        <td class="col-2 text-center">
                          <a href="#" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="#" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" class="text-center">{{ $no++ }}</td>
                        <td class="col-2 text-start">LKPS Tabel 2.a Elemen C.3.4.a) dan C.3.4.b) – Metoda rekrutmen dan keketatan seleksi</td>
                        <td class="col-3 text-start">Metode seleksi mahasiswa baru menerapkan uji kognitif dan uji aptitude telah mencapai skor 4 serta rasio antara pendaftar calon mahasiswa dengan mahasiswa baru yang diterima lebih dari 5 yang juga mencapai skor 4.</td>
                        <td class="col-2 text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias eum quidem et omnis. Repellendus, vero.</td>
                        <td class="col-2 text-center">
                          <a href="#" class="mx-2"><i class="bi bi-pencil-square"></i></a>
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
                        <td class="text-center">
                          <a href="#" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="#" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach --}}
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
            <li><a href="/ubahdataBA"><button class="btn btn-primary btn-sm" type="button">Ubah data</button></a></li>
          </ul>
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3 mx-3">
          <div class="row mt-4">
            <div class="col-1 logoDokumen bg-warning bg-opacity-10 border border-info rounded-start py-3"><i class="bi bi-file-earmark-text-fill h2"></i></div>
            <div class="col-3 infoDokumen bg-warning bg-opacity-10 border border-info rounded-end text-start py-3">
              <h3 class="fs-6 mb-0">Judul dokumen pendukung</h3>
              <p class="fs-6 mb-0">Kode dokumen</p>
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
            {{-- <li><a href="/ubahdataBA"><button class="btn btn-primary btn-sm" type="button">Ubah data</button></a></li> --}}
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
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    <tr>
                        <td scope="row" class="text-center">{{ $no++ }}</td>
                        <td class="col-2 text-center">Ketua Auditor</td>
                        <td class="col-3 text-start"></td>
                        <td class="col-2 text-center"><i class="bi bi-pen" type="button"></i></td>
                        <td class="col-2 text-center">
                          <a href="#" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" class="text-center">{{ $no++ }}</td>
                        <td class="col-2 text-center">Ketua Auditee</td>
                        <td class="col-3 text-start"></td>
                        <td class="col-2 text-center"><i class="bi bi-pen" type="button"></i></td>
                        <td class="col-2 text-center">
                          <a href="#" class="mx-2"><i class="bi bi-pencil-square"></i></a>
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
                        <td class="text-center">
                          <a href="#" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="#" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
      </div>         
  </div>
@endsection
@extends('auditor.main_') @section('title') AMI - Temuan Berita Acara @endsection

@section('linking')
    <a href="/auditor-beritaacara" class="mx-1">
        Berita Acara
    </a>/

    @foreach ($auditee_ as $auditee)
    <a href="/auditor-auditeeBA/{{ $auditee->id }}/{{ $auditee->tahunperiode }}" class="mx-1">
    @endforeach
    {{ $auditee->unit_kerja }}
    </a>/

    <a href="/auditor-BA-AMI/{{ $auditee->id }}/{{ $auditee->tahunperiode }}" class="mx-1">
    BA - AMI
    </a>/
    
@endsection

@section('container')
  <div class="container">
      <div class="d-flex my-4 justify-content-between">
        @foreach ($auditee_ as $auditee)
          <a href="/auditor-auditeeBA/{{ $auditee->id }}/{{ $auditee->tahunperiode }}"><button class="btn btn-primary btn-sm me-2" type="button">Kembali</button></a>
          @endforeach
        <div class="btn-right">
          @foreach ($auditee_ as $auditee)
          <a href="/auditor-BAAMI-pratinjauBA/{{ $auditee->id }}/{{ $auditee->tahunperiode }}">
          @endforeach
            <button class="btn btn-primary btn-sm" type="button">Pratinjau</button>
          </a>
          @foreach ($auditee_ as $auditee)
          <a href="/BAAMI-downloadBA/{{ $auditee->id }}/{{ $auditee->tahunperiode }}">
          @endforeach
            <button class="btn btn-primary btn-sm" type="button">Cetak</button>
          </a>
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
              <a href="/auditor-BA-ubahdataDokumenBAAMI/{{ $ba->id }}/{{$auditee->tahunperiode}}">
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
              @foreach ($ba_ami->get() as $ba)
                {{ $ba->judulDokumen }}
              @endforeach
            </div>
          </div>
          <div class="row">
            <div class="col label border py-2 fw-semibold text-start">Kode Dokumen</div>
            <div class="col border py-2 text-start">
              @foreach ($ba_ami->get() as $ba)
                {{ $ba->kodeDokumen }}
              @endforeach
            </div>
            <div class="col label border py-2 fw-semibold text-start">Revisi Ke-</div>
            <div class="col border py-2 text-start">
              @foreach ($ba_ami->get() as $ba)
                {{ $ba->revisiKe }}
              @endforeach
            </div>
          </div>
          <div class="row">
            <div class="col label border py-2 fw-semibold text-start">Tanggal Revisi</div>
            <div class="col border py-2 text-start">
              @if ($ba->tgl_revisi != null)
                  {{ $ba->tgl_revisi->isoFormat('D MMMM YYYY') }}
              @else
                  {{ $ba->tgl_revisi }}
              @endif
            </div>
            <div class="col label border py-2 fw-semibold text-start">Tanggal Berlaku</div>
            <div class="col border py-2 text-start">
              @if ($ba->tgl_berlaku != null)
                  {{ $ba->tgl_berlaku->isoFormat('D MMMM YYYY') }}
              @else
                  {{ $ba->tgl_berlaku }}
              @endif
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
                <div class="col-9 border py-2 text-start">
                  @foreach ($jadwalAudit_->unique('auditee_id') as $jadwalAudit)
                  {{ $jadwalAudit->auditee->unit_kerja }}
                  @endforeach
                </div>
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
                <?php $i=1; ?>
                @foreach ($jadwalAudit_ as $jadwal)
                    @if (count($jadwalAudit_) == 1)
                        {{ $jadwal->waktu->isoFormat('HH:mm') }} WIB
                    @elseif (count($jadwalAudit_) > 1 && count($jadwalAudit_) != 1)
                        @if ($i < count($jadwalAudit_) && $i != count($jadwalAudit_))
                            {{ $jadwal->waktu->isoFormat('HH:mm') }} WIB;
                        @elseif ($i == count($jadwalAudit_))
                        {{ $jadwal->waktu->isoFormat('HH:mm') }} WIB
                        @endif
                    @endif
                    <?php $i++; ?>
                @endforeach 
              </div>
            </div>
            <div class="row">
              <div class="col label border py-2 fw-semibold text-start">Hari/Tanggal</div>
              <div class="col border py-2 text-start">
                <?php $i=1; ?>
                @foreach ($jadwalAudit_ as $jadwal)
                    @if (count($jadwalAudit_) == 1)
                        {{ $jadwal->hari_tgl->translatedFormat('l, d M Y') }}
                    @elseif (count($jadwalAudit_) > 1 && count($jadwalAudit_) != 1)
                        @if ($i < count($jadwalAudit_) && $i != count($jadwalAudit_))
                            {{ $jadwal->hari_tgl->translatedFormat('l, d M Y') }};
                        @elseif ($i == count($jadwalAudit_))
                            {{ $jadwal->hari_tgl->translatedFormat('l, d M Y') }}
                        @endif
                    @endif
                    <?php $i++; ?>
                @endforeach
              </div>
              <div class="col label border py-2 fw-semibold text-start">Tempat</div>
              <div class="col border py-2 text-start">
                <?php $i=1; ?>
                @foreach ($jadwalAudit_->unique('tempat') as $jadwal)
                    @if (count($jadwalAudit_->unique('tempat')) == 1)
                        {{ $jadwal->tempat }}
                    @elseif (count($jadwalAudit_->unique('tempat')) > 1 && count($jadwalAudit_->unique('tempat')) != 1)
                        @if ($i < count($jadwalAudit_->unique('tempat')) && $i != count($jadwalAudit_->unique('tempat')))
                            {{ $jadwal->tempat }},
                        @elseif ($i == count($jadwalAudit_->unique('tempat')))
                            {{ $jadwal->tempat }}
                        @endif
                    @endif
                    <?php $i++; ?>
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
              <a href="/auditor-BA-daftarhadir/{{ $auditee->id }}"><button class="btn btn-primary btn-sm" type="button">
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
                  @php $no = 1; $i = 0; @endphp
                  @foreach ($daftarhadir_ as $daftarhadir)
                  <tr>
                    <td scope="row" class="text-center">{{ $no++ }}</td>
                    <td class="col-2 text-center">{{ $daftarhadir->posisi }}</td>
                    <td class="col-3 text-center">{{ $daftarhadir->namapeserta }}</td>
                    <td class="col-2 text-center">
                      @if ($daftarhadir->eSign == 'Hadir')
                        {{ $eSign[$i] }}
                      @endif
                    </td>
                    <td class="col-2 text-center">
                      <a href="/BA-deletedaftarhadir/{{ $daftarhadir->id }}" class="mx-2" onclick="return confirm('Apakah Anda yakin akan menghapus data peserta {{ $daftarhadir->namapeserta }} ?')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white"></i></button></a>
                    </td>
                  </tr>
                  <?php $i++; ?>
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
                      <td class="col-3 text-start">{{ $temuanAudit->referensi }}<br>{{ $temuanAudit->nomorButir }}</td>
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
              <a href="/auditor-BA-peluangpeningkatan/{{ $auditee->id }}/{{ $auditee->tahunperiode }}">
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
                        <th class="col-4 text-center">Peluang untuk Peningkatan</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pelpeningkatan_ as $peningkatan)
                    <tr>
                      <td scope="row" class="col-1 text-center">{{ $no++ }}</td>
                      <td class="col-1 text-start">{{ $peningkatan->aspek }}</td>
                      <td class="col-3 text-start">{!! $peningkatan->kelebihan !!}</td>
                      <td class="col-4 text-start">{!! $peningkatan->peningkatan !!}</td>
                      <td class="col-2 text-center">
                        <a href="/auditor-BA-editpeluangpeningkatan/{{ $peningkatan->id }}" class="mx-2"><button class="bg-primary border-0 rounded-1"><i class="bi bi-pencil-square text-white"></i></button></a>
                        <a href="/BA-deletepeluangpeningkatan/{{ $peningkatan->id }}" class="mx-2"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white" onclick="return confirm('Apakah Anda yakin akan menghapus data peluang peningkatan ini?')"></i></button></a>
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
              <a href="/auditor-BA-dokumenpendukung/{{ $auditee->id }}">
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
                      <th class="col-2 text-center">Nama Dokumen</th>
                      <th class="col-3 text-center">Kode Dokumen</th>
                      <th class="col-2 text-center">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @php $no = 1; @endphp
                  @foreach ($dokumenpendukung_ as $dokpendukung)
                  <tr>
                    <td scope="row" class="text-center">{{ $no++ }}</td>
                    <td class="col-2">{{ $dokpendukung->namaDokumen }}</td>
                    <td class="col-3">{{ $dokpendukung->kodeDokumen }}</td>
                    <td class="col-2 text-center"><a href="/BA-lihatdokumenpendukung/{{ $dokpendukung->id }}" target="_blank"><button class="bg-warning border-0 rounded-1"><i class="bi bi-eye-fill"></i></button></a></td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
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
                    <tr>
                      @foreach ($auditee_ as $auditee)
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="col-2 text-center">Ketua Auditor</td>
                      <td class="col-3 text-start">{{ $auditee->ketua_auditor }}</td>
                      <td id="signed" class="col-2 text-center">
                        @if ($ba_ami->doesntExist())
                          <button class="border-0 bi bi-pen" type="button" onclick="return confirm('Apakah Anda yakin akan mengajukan persetujuan atau menyetujui Audit Lapangan ini?')"
                          @if ((Auth::user()->name != $auditee->ketua_auditor))
                              {{ "disabled" }}
                          @endif
                          style="background: none"></button>
                        @else
                            @foreach ($ba_ami->get() as $ba)
                            @if ($ba->eSignAuditor == "Disetujui")
                            {{ $qrCodeAuditor }}
                            @else
                              @foreach ($ba_ami->get() as $ba)
                              <a href="/BAAMI-approvalKetuaAuditor/{{ $ba->id }}" disabled>
                              @endforeach
                                <button class="border-0 bi bi-pen" type="button" onclick="return confirm('Apakah Anda yakin akan mengajukan persetujuan atau menyetujui Audit Lapangan ini?')"
                                @if ((Auth::user()->name != $auditee->ketua_auditor))
                                    {{ "disabled" }}
                                @endif
                                style="background: none"></button>
                              </a>
                            @endif
                            @endforeach
                        
                        @endif
                      </td>
                      @endforeach
                    </tr>
                    <tr>
                        <td scope="row" class="text-center">{{ $no++ }}</td>
                        <td class="col-2 text-center">Ketua Auditee</td>
                        <td class="col-3 text-start">{{ $auditee->ketua_auditee }}</td>
                        <td id="signed" class="col-2 text-center">
                          @if ($ba_ami->doesntExist())
                            <button class="bi bi-pen border-0" type="button" onclick="return confirm('Apakah Anda yakin akan menyetujui seluruh data yang akan digunakan pada Dokumen BA AMI ini?')" 
                            @if (Auth::user()->name != $auditee->ketua_auditee)
                              {{ "disabled" }}
                            @endif style="background: none"></button>
                          @else
                            @foreach ($ba_ami->get() as $ba)
                            @if ($ba->eSignAuditee == "Disetujui")
                            {{ $qrCodeAuditee }}
                            @else
                              @foreach ($ba_ami->get() as $ba)
                              <a href="/BAAMI-approvalKetuaAuditee/{{ $ba->id }}">
                              @endforeach
                              <button class="bi bi-pen border-0" type="button" onclick="return confirm('Apakah Anda yakin akan menyetujui seluruh data yang akan digunakan pada Dokumen BA AMI ini?')" 
                              @if (Auth::user()->name != $auditee->ketua_auditee)
                                {{ "disabled" }}
                              @endif style="background: none"></button>
                              </a>
                            @endif
                            @endforeach
                          @endif
                        </td>
                      </tr>
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
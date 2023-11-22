@extends('layout.main') @section('title') AMI - Temuan Berita Acara @endsection

@section('linking')
    <a href="/beritaacara" class="mx-1">
        Berita Acara
    </a>/

    <a href="/auditeeBA/{{ $auditee->id }}/{{ $auditee->tahunperiode }}" class="mx-1">
    {{ $auditee->unit_kerja }}
    </a>/

    <a href="/BA-AMI/{{ $auditee->id }}/{{ $auditee->tahunperiode }}" class="mx-1">
    BA - AMI
    </a>/
    
@endsection

@section('container')
  <div class="container">
      <div class="d-flex my-4 justify-content-between">
        <div class="btn-left">
          @foreach ($auditee_ as $auditee)
          <a href="/auditeeBA/{{ $auditee->id }}/{{ $auditee->tahunperiode }}"><button class="btn btn-secondary btn-sm me-2 fw-semibold" type="button">Kembali</button></a>
          @endforeach
        </div>
        <div class="btn-right">
          @foreach ($auditee_ as $auditee)
          <a href="/BAAMI-pratinjauBA/{{ $auditee->id }}/{{ $auditee->tahunperiode }}">
          @endforeach
            <button class="btn btn-warning btn-sm fw-semibold" type="button">Pratinjau</button>
          </a>
          @foreach ($auditee_ as $auditee)
          <a href="/BAAMI-downloadBA/{{ $auditee->id }}/{{ $auditee->tahunperiode }}">
          @endforeach
            <button class="btn btn-success btn-sm fw-semibold" type="button">Cetak</button>
          </a>
        </div>
      </div>
      @if ($message = Session::get('warning'))
      <div class="alert alert-warning" role="alert">
          {{ $message }}
      </div>
      @endif
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
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" disabled>Data Dokumen BA</button>
            </li>
            <li>
              @foreach ($auditee_ as $ba)
              <a href="/BA-ubahdataDokumenBAAMI/{{ $ba->id }}/{{$auditee->tahunperiode}}">
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
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" disabled>Berita Acara AMI</button>
            </li>
            <li>
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" 
              @foreach ($ba_ami->get() as $item)
                  @if ($item->tgl_terbitBA == null && $item->waktu_terbitBA && $item->tempat_terbitBA)
                    data-bs-target="#addTanggalBAAMI"
                  @else
                    data-bs-target="#editTanggalBAAMI"
                  @endif
              @endforeach
              >
                Ubah Data
              </button>
            </li>
          </ul>
        </div>

        <!-- Modal Add Tanggal BA AMI -->
        <div class="modal" id="addTanggalBAAMI" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTanggalBAAMILabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              @foreach ($ba_ami->get() as $baAMI)
              <form action="/beritaacara-BA-AMI-Berita-Acara-AMI/{{ $baAMI->id }}" method="POST">
              @endforeach
                @csrf
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Berita Acara AMI</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3">
                    <label for="inputTglTerbitBA" class="col-sm-4 col-form-label">Hari/Tanggal <span class="fw-bold text-danger">*</span></label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="inputTglTerbitBA" placeholder="DD/MM/YYYY" name="tgl_terbitBA">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputWaktuTerbitBA" class="col-sm-4 col-form-label">Waktu <span class="fw-bold text-danger">*</span></label>
                    <div class="col-sm-8">
                      <input type="time" class="form-control" id="inputWaktuTerbitBA" name="waktu_terbitBA">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputTmptTerbitBA" class="col-sm-4 col-form-label">Tempat <span class="fw-bold text-danger">*</span></label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="inputTmptTerbitBA" placeholder="Tempat terbit BA" name="tempatTerbitBA">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal Edit Tanggal BA AMI -->
        <div class="modal" id="editTanggalBAAMI" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTanggalBAAMILabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              @foreach ($ba_ami->get() as $baAMI)
              <form action="/beritaacara-BA-AMI-Berita-Acara-AMI/{{ $baAMI->id }}" method="POST">
              @endforeach
                @csrf
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Berita Acara AMI</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3">
                    <label for="inputTglTerbitBA" class="col-sm-4 col-form-label">Hari/Tanggal <span class="fw-bold text-danger">*</span></label>
                    <div class="col-sm-8">
                      @foreach ($ba_ami->get() as $item)
                        <input type="text" class="form-control" id="inputTglTerbitBA" placeholder="DD/MM/YYYY" name="tgl_terbitBA"
                          @if ($item->tgl_terbitBA != null)
                            value="{{ $item->tgl_terbitBA->translatedFormat('d-m-Y') }}"
                          @endif 
                        >
                      @endforeach
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputWaktuTerbitBA" class="col-sm-4 col-form-label">Waktu <span class="fw-bold text-danger">*</span></label>
                    <div class="col-sm-8">
                      @foreach ($ba_ami->get() as $item)
                          <input type="time" class="form-control" id="inputWaktuTerbitBA" name="waktu_terbitBA" 
                            @if ($item->waktu_terbitBA != null)
                              value="{{ $item->waktu_terbitBA->isoFormat('HH:mm') }}"
                            @endif
                          >
                      @endforeach
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputTmptTerbitBA" class="col-sm-4 col-form-label">Tempat <span class="fw-bold text-danger">*</span></label>
                    <div class="col-sm-8">
                      @foreach ($ba_ami->get() as $item)
                        <input type="text" class="form-control" id="inputTmptTerbitBA" placeholder="Tempat terbit BA" name="tempatTerbitBA" value="{{ $item->tempat_terbitBA }}">
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="container text-center dataDokumenBA my-3 px-3">
              <div class="row">
                <div class="col-3 label border py-2 fw-semibold text-start">Unit Kerja</div>
                <div class="col-9 border py-2 text-start">
                  {{-- @foreach ($jadwalAudit_->unique('auditee_id') as $jadwalAudit)
                    {{ $jadwalAudit->auditee->unit_kerja }}
                  @endforeach --}}
                  {{ $auditee->unit_kerja }}
                </div>
              </div>
            <div class="row">
              <div class="col label border py-2 fw-semibold text-start">Tahun Ajaran</div>
              <div class="col border py-2 text-start">
                {{-- @foreach ($jadwalAudit_->unique('auditee_id') as $jadwalAudit)
                  {{ $jadwalAudit->th_ajaran1 }}/{{ $jadwalAudit->th_ajaran2 }}
                @endforeach --}}
                {{ $auditee->tahunperiode0 }}/{{ $auditee->tahunperiode }}
              </div>
              <div class="col label border py-2 fw-semibold text-start">Waktu</div>
              <div class="col border py-2 text-start">
                {{-- <?php $i=1; ?>
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
                @endforeach  --}}
                @foreach ($ba_ami->get() as $item)
                  @if ($item->waktu_terbitBA != null)
                    {{ $item->waktu_terbitBA->isoFormat('HH:mm') }} WIB
                  @endif
                @endforeach
              </div>
            </div>
            <div class="row">
              <div class="col label border py-2 fw-semibold text-start">Hari/Tanggal</div>
              <div class="col border py-2 text-start">
                {{-- <?php $i=1; ?>
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
                @endforeach --}}
                @foreach ($ba_ami->get() as $item)
                  @if ($item->tgl_terbitBA != null)
                    {{ $item->tgl_terbitBA->translatedFormat('l, d M Y') }}
                  @endif
                @endforeach
              </div>
              <div class="col label border py-2 fw-semibold text-start">Tempat</div>
              <div class="col border py-2 text-start">
                {{-- <?php $i=1; ?>
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
                @endforeach --}}
                @foreach ($ba_ami->get() as $item)
                    {{ $item->tempat_terbitBA }}
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
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" disabled>Berita Acara AMI - Daftar Hadir</button>
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
                  @php $no = 1; $i = 0; @endphp
                  @foreach ($daftarhadir_ as $daftarhadir)
                  <tr>
                    <td scope="row" class="text-center">{{ $no++ }}</td>
                    <td class="col-2 text-center">
                      @if ($daftarhadir->beritaacara->auditee->ketua_auditee == $daftarhadir->namapeserta)
                        {{ "Ketua Auditee" }}
                      @elseif ($daftarhadir->beritaacara->auditee->ketua_auditor == $daftarhadir->namapeserta)
                        {{ "Ketua Auditor" }}
                      @else
                        {{ $daftarhadir->posisi }}
                      @endif
                    </td>
                    <td class="col-3 text-center">{{ $daftarhadir->namapeserta }}</td>
                    <td class="col-2 text-center">
                      @if ($daftarhadir->eSign == 'Hadir')
                        {{ $eSign[$i] }}
                      @endif
                    </td>
                    <td class="col-2 text-center">
                      <a href="/BA-deletedaftarhadir/{{ $daftarhadir->id }}" class="mx-2" onclick="return confirm('Apakah Anda yakin akan menghapus data peserta {{ $daftarhadir->namapeserta }} ?')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white" title="Hapus"></i></button></a>
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
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" disabled>Temuan Audit</button>
            </li>
          </ul>
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-1 text-center">KTS/OB<br>(Inisial Auditor)</th>
                        <th class="col-2 text-center">Referensi<br>(Butir Mutu)</th>
                        <th class="col-4 text-center">Temuan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pertanyaan_ as $temuanAudit)
                    <tr>
                      <td scope="row" class="col-1 text-center">{{ $no++ }}</td>
                      <td class="col-1 text-center">{{ $temuanAudit->Kategori }}<br>{{ $temuanAudit->inisialAuditor }}</td>
                      <td class="col-2 text-start">{{ $temuanAudit->referensi }}<br>{{ $temuanAudit->nomorButir }}</td>
                      <td class="col-4 text-start">{{ $temuanAudit->narasiPLOR }}</td>
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
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" disabled>Peluang Peningkatan</button>
            </li>
            <li>
              @foreach ($auditee_ as $auditee)
              <a href="/BA-peluangpeningkatan/{{ $auditee->id }}/{{ $auditee->tahunperiode }}">
              @endforeach
              <button class="btn btn-primary btn-sm" type="button"
              >Ubah data</button>
              </a>
            </li>
          </ul>
        </div>
        <div class="container text-center dataDokumenBA my-3 px-3">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-1 text-center">Aspek/Bidang</th>
                        <th class="col-3 text-center">Kelebihan</th>
                        <th class="col-4 text-center">Peluang untuk Peningkatan</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pelpeningkatan_ as $peningkatan)
                    <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="col-1 text-start">{{ $peningkatan->aspek }}</td>
                      <td class="col-3 text-start">{!! $peningkatan->kelebihan !!}</td>
                      <td class="col-4 text-start">{!! $peningkatan->peningkatan !!}</td>
                      <td class="col-2 text-center">
                        <a href="/BA-editpeluangpeningkatan/{{ $peningkatan->id }}/{{ $peningkatan->beritaacara->tahunperiode }}"><button class="bg-primary border-0 rounded-1"><i class="bi bi-pencil-square text-white" title="Edit"></i></button></a>
                        <a href="/BA-deletepeluangpeningkatan/{{ $peningkatan->id }}"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white" onclick="return confirm('Apakah Anda yakin akan menghapus data peluang peningkatan ini?')" title="Hapus"></i></button></a>
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
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" disabled>Dokumen Pendukung</button>
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
                    <td class="col-2 text-center"><a href="/BA-lihatdokumenpendukung/{{ $dokpendukung->id }}" target="_blank"><button class="bg-warning border-0 rounded-1"><i class="bi bi-eye-fill" title="Buka"></i></button></a></td>
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
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" disabled>Persetujuan</button>
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
                          <button class="border-0 bi bi-pen text-success" type="button" onclick="return confirm('Apakah Anda yakin akan mengajukan persetujuan atau menyetujui Audit Lapangan ini?')"
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
                                <button class="border-0 bi bi-pen text-success" type="button" onclick="return confirm('Apakah Anda yakin akan mengajukan persetujuan atau menyetujui Audit Lapangan ini?')"
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
                        <td class="col-2 text-center">
                          @if ($ba_ami->doesntExist())
                            <select id="selectJabatan" class="rounded-1">
                              <option value="1" selected>Ketua Auditee</option>
                              <option value="0">Wakil Ketua Auditee</option>
                            </select>
                          @else
                            @foreach ($ba_ami->get() as $ba)
                              @if ($ba->eSignAuditee == "Disetujui")
                                @foreach ($id_persetujuanBA as $persetujuanBA)
                                    @if ($persetujuanBA->posisi == "Ketua Auditee")
                                      <select id="selectJabatan" class="rounded-1">
                                        <option value="1" selected>Ketua Auditee</option>
                                        <option value="0" disabled>Wakil Ketua Auditee</option>
                                      </select>
                                    @elseif ($persetujuanBA->posisi == "Wakil Ketua Auditee")
                                      <select id="selectJabatan" class="rounded-1">
                                        <option value="1" disabled>Ketua Auditee</option>
                                        <option value="0" selected>Wakil Ketua Auditee</option>
                                      </select>
                                    @endif                                    
                                @endforeach
                              @else
                                <select id="selectJabatan" class="rounded-1">
                                  <option value="1" selected>Ketua Auditee</option>
                                  <option value="0">Wakil Ketua Auditee</option>
                                </select>
                              @endif
                            @endforeach
                          @endif
                        </td>
                        <td class="col-3 text-start" id="pemilikJabatan">
                          @if ($ba_ami->doesntExist())
                            {{ $auditee->ketua_auditee }}
                          @else
                            @foreach ($ba_ami->get() as $ba)
                              @if ($ba->eSignAuditee == "Disetujui")
                                @foreach ($id_persetujuanBA as $persetujuanBA)
                                  @if ($persetujuanBA->posisi == "Ketua Auditee")
                                    {{ $persetujuanBA->nama }}
                                  @elseif ($persetujuanBA->posisi == "Wakil Ketua Auditee")
                                    {{ $persetujuanBA->nama }}
                                  @endif
                                @endforeach
                              @else
                                {{ $auditee->ketua_auditee }}
                              @endif
                            @endforeach
                          @endif
                        </td>
                        <td id="signed" class="col-2 text-center">
                          @if ($ba_ami->doesntExist())
                            <button id="doesnExist" class="bi bi-pen text-success border-0" type="button" style="background: none"></button>
                          @else
                            @foreach ($ba_ami->get() as $ba)
                            @if ($ba->eSignAuditee == "Disetujui")
                            {{ $qrCodeAuditee }}
                            @else
                            <a id="approvalAuditeeLink">
                            <button id="existsBA" class="bi bi-pen text-success border-0" type="button"
                            @foreach ($ba_ami->get() as $ba)
                              data-baid="{{ $ba->id }}"
                            @endforeach
                            style="background: none"></button>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/id.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
      const myModal = document.getElementById('addTanggalBAAMI')
      const myInput = document.getElementById('myInput')

      myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
      })
      $(document).ready(function(){
        var userName = "{{ Auth::user()->name }}";
        var auditee_id = "{{ $auditee->id }}";

        flatpickr("#inputTglTerbitBA", {
            dateFormat: "d-m-Y", // Sesuaikan dengan format yang Anda inginkan
            locale: "id",
            enableTime: false, // Jangan aktifkan waktu
            time_24hr: true, // Gunakan format 24 jam
            timeZone: "Asia/Jakarta",
        });

        $('#selectJabatan').change(function() {
          var selectJabatan = $(this).val();

          if (selectJabatan == 0) {
            $.ajax({
                url: "{{url('/beritaacara-persetujuan-BA')}}/"+ auditee_id,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    $('#pemilikJabatan').text(data.wakil_ketua_auditee);
                },
                error: function() {
                console.error('Terjadi kesalahan saat memuat data users.');
                }
            });
          } else if (selectJabatan == 1) {
            $.ajax({
                url: "{{url('/beritaacara-persetujuan-BA')}}/"+ auditee_id,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    $('#pemilikJabatan').text(data.ketua_auditee);
                },
                error: function() {
                  console.error('Terjadi kesalahan saat memuat data users.');
                }
            });
          }
        });

        $('#doesnExist').on('click', function() {
          var selectJabatan = $('#selectJabatan').val();
          var pemilikJabatan = $('#pemilikJabatan').text();

          if (pemilikJabatan != userName) {
            confirm('Persetujuan BA hanya dapat dilakukan oleh Ketua atau Wakil Ketua Auditee.');
          } else {
            confirm('Mohon lengkapi dahulu data dokumen berita acara.');
          }
        })

        $('#existsBA').on('click', function() {
          var selectJabatan = $('#selectJabatan').val();
          var pemilikJabatan = $('#pemilikJabatan').text();
          var ba_id = $(this).data('baid');
          var link = $('#approvalAuditeeLink');

          if (pemilikJabatan != userName) {
            confirm('Persetujuan BA hanya dapat dilakukan oleh Ketua atau Wakil Ketua Auditee.');
            link.removeAttr('href');
          } else {
            var confirm_alert = confirm('Apakah Anda yakin akan menyetujui seluruh data yang akan digunakan pada Dokumen BA AMI ini?');
            if (confirm_alert) {
              console.log("confirmed");
              var url = '/BAAMI-approvalKetuaAuditee/' + ba_id;
              link.attr('href', url);
            }
          }
        })
      })
    </script>
@endpush
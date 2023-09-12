@extends('auditor.main_') 
@section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/auditor-daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    @foreach ($_daftartiliks as $item)
    <a href="/auditor-daftartilik/{{ $item->auditee->tahunperiode }}" class="mx-1">
    @endforeach
    @foreach ($_daftartiliks as $item)
    {{ $item->auditee->tahunperiode0 }}/{{ $item->auditee->tahunperiode }}
    </a>/
    @endforeach
    
    @foreach ($_daftartiliks as $item)
    <a href="/auditor-daftarTilik-areadaftartilik/{{ $item->auditee_id }}/{{ $item->area }}" class="mx-1">
    @endforeach
    @foreach ($_daftartiliks as $item)
    {{ $item->area }}
    </a>/
    @endforeach

    <a href="/auditor-daftartilik-tampilpertanyaandaftartilik/{{ $datas->id }}" class="mx-1">
    Pertanyaan
    </a>/  

@endsection

@section('container')

      <div class="row mt-4 mx-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
      </div>
      {{-- Form setiap auditee --}}
      @foreach ($_daftartiliks as $_daftartilik)
      @foreach ($_daftartilik->auditee()->get() as $auditee)
      
          <div id="infoDT" class="card mt-4 mb-4 mx-4 px-3">
              <div class="row g-3 my-4 mx-3">
                  <div class="col">
                      <label for="auditee_id" class="visually-hidden">Auditee</label>
                      <select
                          id="auditee_id"
                          class="form-select"
                          name="auditee_id"
                          disabled
                      >
                        <option selected disabled>{{ $auditee->unit_kerja }}</option>
                      </select>
                  </div>
                  <div class="col">
                      <label for="auditor_id" class="visually-hidden">Auditor</label>
                      <select id="auditor_id" class="form-select" name="auditor_id" disabled>
                          <option selected disabled>{{ $_daftartilik->auditor->nama }}</option>
                      </select>
                  </div>
              </div>
              <div class="row g-3 mb-4 mx-3">
                  <div class="col">
                      <input
                          type="text"
                          id="tgl-pelaksanaan"
                          class="form-control"
                          placeholder="Masukkan Hari/Tanggal Pelaksanaan"
                          onfocus="(this.type='date')"
                          onblur="(this.type='text')"
                          aria-label="Masukkan Hari/Tanggal Pelaksanaan"
                          value="{{ $_daftartilik->tgl_pelaksanaan->translatedFormat('l, d M Y') }}"
                          disabled
                      />
                  </div>
                  <div class="col">
                      <input
                          type="text"
                          id="tempat"
                          class="form-control"
                          placeholder="Masukkan tempat pelaksanaan"
                          aria-label="Masukkan tempat pelaksanaan"
                          name="tempat"
                          value="{{ $_daftartilik->tempat }}"
                          disabled
                      />
                  </div>
              </div>
              <div class="row g-3 mb-4 mx-4">
                  <label for="area" class="visually-hidden">Area Audit</label>
                  <select id="area" class="form-select" name="area" disabled>
                      <option selected disabled>{{ $_daftartilik->area }}</option>
                  </select>
              </div>
              <div class="row g-3 mb-5 mx-4">
                  <label for="bataspengisianRespon" class="visually-hidden"
                      >Batas Pengisian Respon</label
                  >
                  <input
                      id="bataspengisianRespon"
                      type="text"
                      class="form-control"
                      placeholder="Berika Batas Pengisian Respon Auditee"
                      onfocus="(this.type='date')"
                      onblur="(this.type='text')"
                      aria-label="Berikan Batas Pengisian Respon Auditee"
                      value="{{ $_daftartilik->bataspengisianRespon->translatedFormat('l, d M Y') }}"
                      disabled
                  />
              </div>
          </div>
      
      @endforeach
      @endforeach
    
      {{-- Form (berbagai) pertanyaan dari setiap auiditee --}}
      <form id="myForm" action="/daftartilik-updatedatapertanyaandaftartilik/{{ $datas->id }}" method="POST">
        @csrf
        <div id="temuanDT" class="card mt-4 mb-4 mx-4 px-3">
          @foreach ($_daftartiliks as $_daftartilik)
          <div class="row g-3 my-4 mx-3" hidden>
            <div class="col">
                <input
                    type="number"
                    id="daftartilik_id"
                    class="form-control"
                    placeholder="Masukkan tempat pelaksanaan"
                    aria-label="Masukkan tempat pelaksanaan"
                    name="daftartilik_id"
                    value="{{ $_daftartilik->id }}"
                    hidden
                />
            </div>
            <div class="col">
                <input
                    type="number"
                    id="auditee_id"
                    class="form-control"
                    placeholder="Masukkan tempat pelaksanaan"
                    aria-label="Masukkan tempat pelaksanaan"
                    name="auditee_id"
                    value="{{ $_daftartilik->auditee->id }}"
                    hidden
                />
            </div>
            <div class="col">
                <input
                    type="number"
                    id="auditor_id"
                    class="form-control"
                    placeholder="Masukkan tempat pelaksanaan"
                    aria-label="Masukkan tempat pelaksanaan"
                    name="auditor_id"
                    value="{{ $_daftartilik->auditor->id }}"
                    hidden
                />
            </div>
          </div>
          @endforeach
          <div class="row g-3 my-4 mx-3">
            <div class="col">
              <label for="butirStandar" class="visually-hidden">Butir Standar</label>
              <input id="butirStandar" type="text" class="form-control" placeholder="Masukkan Butir Standar. Contoh: [01 Kompetensi Lulusan]" aria-label="Butir Standar" name="butirStandar" value="{{ $datas->butirStandar }}" readonly>
            </div>
            <div class="col">
              <label for="nomorButir" class="visually-hidden">Nomor Butir</label>
              <input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir. Contoh: [A.01.01]" aria-label="Masukkan Nomor Butir" name="nomorButir" value="{{ $datas->nomorButir }}" readonly>
            </div>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Ajukan pertanyaan" id="pertanyaan" style="height: 100px" name="pertanyaan" value="{{ $datas->pertanyaan }}" readonly>{{ $datas->pertanyaan }}</textarea>
            <label for="pertanyaan">Ajukan pertanyaan</label>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu" name="indikatormutu" readonly>{{ $datas->indikatormutu }}</textarea>
            <label for="indikatorMutu">Masukkan indikator mutu</label>
          </div>        
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar" name="targetStandar" readonly>{{ $datas->targetStandar }}</textarea>
            <label for="targetStandar">Masukkan target standar</label>
          </div>
          <div class="inputGrupText row justify-content-between g-3 mb-4 mx-4">
            <div class="col-7 border rounded me-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputButirStandar">
                  <label for="inputButirStandar" class="form-label">Butir Standar</label>
                  <input type="text" class="form-control" id="inputButirStandar" value="{{ $datas->butirStandar }}" readonly>
                </div>
                <div class="col inputReferensi">
                  <label for="inputReferensi" class="form-label">Referensi</label>
                  <input type="text" class="form-control" placeholder="Masukkan referensi" id="inputReferensi" name="referensi" value="{{ $datas->referensi }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-4 border rounded ms-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputKeterangan">
                  <label for="inputKeterangan" class="form-label">Keterangan</label>
                  <input type="text" class="form-control" placeholder="Masukkan keterangan" id="inputKeterangan" name="keterangan" value="{{ $datas->keterangan }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <label for="#" class="mb-4 mx-4 fw-semibold">Respon Auditee</label>
          <div class="row g-3 mb-4 mx-4 border rounded">
            <div class="col my-4">
              <div class="row mx-2 mb-4 px-1">
                <label for="inputDokSahih" class="form-label">Dokumen Bukti Sahih</label>
                <a href="/auditor-editdokumensahih/{{ $datas->id }}">
                  <button id="inputDokSahih" type="button" class="btn btn-outline-secondary w-100"><b>Dokumen Bukti Sahih</b></button>
                </a>
              </div>
              <div class="form-floating mb-3 mx-4">
                <textarea class="form-control" placeholder="Tuliskan respon Auditee" id="responAuditee" style="height: 100px" name="responAuditee" readonly>{{ $datas->responAuditee }}</textarea>
                <label for="responAuditee">Tuliskan respon Auditee</label>
              </div>
            </div>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Tuliskan respon Auditor" id="responAuditor" style="height: 100px" name="responAuditor" 
              @if (($datas->approvalAuditor == 'Disetujui Auditor' && $datas->approvalAuditee == 'Disetujui Auditee') || ($currentDate > $datas->daftartilik->bataspengisianRespon))
                  {{ "readonly" }}
              @endif
            >{{ $datas->responAuditor }}</textarea>
            <label for="responAuditor">Tuliskan respon Auditor <b>**)</b></label>
          </div>
          <div class="row g-3 mb-4 mx-3">
            <div class="col">
              <label for="kategoriTemuan" class="form-label">Kategori Temuan<b>*)</b></label>
              <div id="kategoriTemuan" class="border rounded ps-4 py-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Kategori" id="kategoriKTS" value="KTS" onclick="display()" value="{{ $datas->Kategori }}"
                  
                    @if ($datas->Kategori == "KTS"){{ "checked" }}@endif
                    @if ((Auth::user()->name != $datas->auditee->ketua_auditor && Auth::user()->name != $datas->auditee->anggota_auditor && Auth::user()->name != $datas->auditee->anggota_auditor2) || ($currentDate > $datas->daftartilik->bataspengisianRespon))
                    {{ "disabled" }}
                    @elseif ($datas->approvalAuditor == 'Disetujui Auditor' && $datas->approvalAuditee == 'Disetujui Auditee')
                    @if ($datas->Kategori == "KTS"){{ "checked" }}@else {{ "disabled" }}@endif
                    @endif
                  
                  >
                  <label class="form-check-label" for="kategoriKTS">KTS</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Kategori" id="kategoriOB" value="OB" onclick="display()" value="{{ $datas->Kategori }}"
                  
                    @if ($datas->Kategori == "OB"){{ "checked" }}@endif
                    @if ((Auth::user()->name != $datas->auditee->ketua_auditor && Auth::user()->name != $datas->auditee->anggota_auditor && Auth::user()->name != $datas->auditee->anggota_auditor2) || ($currentDate > $datas->daftartilik->bataspengisianRespon))
                    {{ "disabled" }}
                    @elseif ($datas->approvalAuditor == 'Disetujui Auditor' && $datas->approvalAuditee == 'Disetujui Auditee')
                    @if ($datas->Kategori == "OB"){{ "checked" }}@else {{ "disabled" }}@endif
                    @endif
                  >
                  <label class="form-check-label" for="kategoriOB">OB</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Kategori" id="kategoriSesuai" value="Sesuai" onclick="display()" value="{{ $datas->Kategori }}"
                  
                    @if ($datas->Kategori == "Sesuai"){{ "checked" }}@endif
                    @if ((Auth::user()->name != $datas->auditee->ketua_auditor && Auth::user()->name != $datas->auditee->anggota_auditor && Auth::user()->name != $datas->auditee->anggota_auditor2) || ($currentDate > $datas->daftartilik->bataspengisianRespon))
                    {{ "disabled" }}
                    @elseif ($datas->approvalAuditor == 'Disetujui Auditor' && $datas->approvalAuditee == 'Disetujui Auditee')
                    @if ($datas->Kategori == "Sesuai"){{ "checked" }}@else {{ "disabled" }}@endif
                    @endif
                  >
                  <label class="form-check-label" for="kategoriSesuai">Sesuai</label>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label>
              <a href="/auditor-editfotokegiatan/{{ $datas->auditee_id }}/{{ $datas->auditee->tahunperiode }}/{{ $datas->id}}">
                <button id="fotoKegiatan" type="button" class="btn btn-outline-secondary w-100"><b>Foto Kegiatan</b></button>
              </a>
              {{-- <input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan" name="fotoKegiatan" value="{{ $datas->fotoKegiatan }}"> --}}
            </div>
            {{-- <div class="col">
              <label for="listFotoKegiatan" class="form-label">Daftar foto kegiatan yang sudah diunggah</label>
              <select id="listFotoKegiatan" class="form-select" name="foto_kegiatans[]">
                  <option selected>Daftar foto kegiatan yang sudah diunggah</option>
                  @foreach ($fotoKegiatan as $foto)
                  <option>{{ $foto->namaFile }}</option>
                  @endforeach
              </select>
            </div> --}}
          </div>
          <div id="narasiPLOR" class="form-floating mb-4 mx-4"></div>
          <div class="row g-3 mb-4 mx-4">
            <div class="col border rounded px-4 py-4 me-2">
              <label for="inisialAuditor" class="form-label">Inisial Auditor</label>
              <input id="inisialAuditor" type="text" class="form-control" placeholder="Butir Standar" aria-label="Masukkan Inisial Auditor" name="inisialAuditor" value="{{ $datas->inisialAuditor }}"
              @if ((Auth::user()->name != $datas->auditee->ketua_auditor && Auth::user()->name != $datas->auditee->anggota_auditor && Auth::user()->name != $datas->auditee->anggota_auditor2) || ($datas->approvalAuditor == 'Disetujui Auditor' && $datas->approvalAuditee == 'Disetujui Auditee') || ($currentDate > $datas->daftartilik->bataspengisianRespon)){{ "readonly" }}@endif
              >
            </div>
            <div class="col border rounded px-4 py-4 ms-2">
              <label for="skorAuditor" class="form-label">Skor Auditor</label>
              <input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor" name="skorAuditor" value="{{ $datas->skorAuditor }}"
              @if ((Auth::user()->name != $datas->auditee->ketua_auditor && Auth::user()->name != $datas->auditee->anggota_auditor && Auth::user()->name != $datas->auditee->anggota_auditor2) || ($datas->approvalAuditor == 'Disetujui Auditor' && $datas->approvalAuditee == 'Disetujui Auditee') || ($currentDate > $datas->daftartilik->bataspengisianRespon)){{ "readonly" }}@endif
              >
            </div>
          </div>
        </div>
        <div class="keteranganTambahan mx-4 mb-2">
          <p class="mb-0"><b>*</b> Jika Auditee tidak dapat menyetujui status temuan, maka Auditee harus menunjukkan dokumen bukti sahih melalui media Line dan mengunggah dokumen bukti sahih yang baru</p>
          <p class="mb-0"><b>**</b> Pernyataan Auditor dianggap valid hingga 7 hari terhitung setelah audit dilaksanakan</p>
        </div>
        <div id="persetujuanAuditorAuditee" class="d-grid gap-2 d-md-flex justify-content-md-end me-4 mb-4">
          @foreach ($_daftartiliks as $item)
          <a href="/auditor-daftarTilik-areadaftartilik/{{ $item->auditee_id }}/{{ $item->area }}"><button class="btn btn-outline-secondary me-md-1" type="button">Kembali</button></a>
          @endforeach
          <a href="/approvalAuditor-daftartilik/{{ $datas->id }}">
            <button class="btn btn-success me-md-2" type="button" onclick="return confirm('Apakah Anda yakin akan mengajukan persetujuan atau menyetujui Audit Lapangan ini?')"
                @if ((Auth::user()->name != $datas->auditee->ketua_auditor) || ($datas->approvalAuditor == 'Disetujui Auditor' && $datas->approvalAuditee == 'Disetujui Auditee') || ($datas->approvalAuditor == 'Menunggu persetujuan Auditee' && $datas->approvalAuditee == 'Belum disetujui Auditee'))
                    {{ "disabled" }}
                @endif
            >
              @if ($datas->approvalAuditor == 'Belum disetujui Auditor')
                  {{ "Ajukan persetujuan AL" }}
              @elseif ($datas->approvalAuditor == 'Menunggu persetujuan Auditee' && $datas->approvalAuditee == 'Belum disetujui Auditee')
                  {{ "Menunggu persetujuan Auditee" }}
              @elseif ($datas->approvalAuditor == 'Menunggu persetujuan Auditee' && $datas->approvalAuditee == 'Disetujui Auditee')
                  {{ "Setujui AL" }}
              @else
                  {{ $datas->approvalAuditor }}
              @endif
            </button>
          </a>
          <button class="btn btn-success me-md-2" type="button" disabled>{{ $datas->approvalAuditee }}</button>
          <button class="btn btn-success" type="submit" style="background: #00D215; border: 1px solid #008F0E;">Simpan</button>
        </div>
      </form>
    {{-- </form> --}}
    
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
  var plor = '<textarea class="form-control" placeholder="Tuliskan narasi PLOR (Problem, Location, Objective, Reference)" id="responAuditor" style="height: 100px" name="narasiPLOR" value="{{ $datas->narasiPLOR }}" @if ((Auth::user()->name != $datas->auditee->ketua_auditor && Auth::user()->name != $datas->auditee->anggota_auditor && Auth::user()->name != $datas->auditee->anggota_auditor2) || ($datas->approvalAuditor == "Disetujui Auditor" && $datas->approvalAuditee == "Disetujui Auditee") || ($currentDate > $datas->daftartilik->bataspengisianRespon)){{ "readonly" }}@endif>{{ $datas->narasiPLOR }}</textarea><label for="responAuditor">Tuliskan narasi PLOR (Problem, Location, Objective, Reference)<b>**)</b></label>';

  if(document.getElementById('kategoriKTS').checked) {
      document.getElementById("narasiPLOR").innerHTML
          = plor;
  }
  else if(document.getElementById('kategoriOB').checked) {
      document.getElementById("narasiPLOR").innerHTML
          = plor; 
  } else {
      document.getElementById("narasiPLOR").innerHTML
            = ''; 
  }
  function display() {
      var plor = '<textarea class="form-control" placeholder="Tuliskan narasi PLOR (Problem, Location, Objective, Reference)" id="responAuditor" style="height: 100px" name="narasiPLOR" value="{{ $datas->narasiPLOR }}" @if ((Auth::user()->name != $datas->auditee->ketua_auditor && Auth::user()->name != $datas->auditee->anggota_auditor && Auth::user()->name != $datas->auditee->anggota_auditor2) || ($datas->approvalAuditor == "Disetujui Auditor" && $datas->approvalAuditee == "Disetujui Auditee")){{ "readonly" }}@endif>{{ $datas->narasiPLOR }}</textarea><label for="responAuditor">Tuliskan narasi PLOR (Problem, Location, Objective, Reference)<b>**)</b></label>';

      if(document.getElementById('kategoriKTS').checked) {
          document.getElementById("narasiPLOR").innerHTML
              = plor;
      }
      else if(document.getElementById('kategoriOB').checked) {
          document.getElementById("narasiPLOR").innerHTML
              = plor; 
      } else {
          document.getElementById("narasiPLOR").innerHTML
                = ''; 
      }
  }

  document.getElementById('myForm').addEventListener('input', function() {
      // Fungsi ini akan dipanggil setiap kali ada perubahan pada form
      saveFormData();
  });

  function saveFormData() {
      let pertanyaan_id = '{{ $datas->id }}';
      console.log(pertanyaan_id);
      // Menggunakan AJAX untuk mengirim data ke server
      var formData = new FormData(document.getElementById('myForm'));
      $.ajax({
          url: '/daftartilik-updatedatapertanyaandaftartilik/' + pertanyaan_id, // Ganti dengan URL endpoint server Anda
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
              // Berikan umpan balik ke pengguna jika sukses
              console.log('Data berhasil disimpan');
          },
          error: function(error) {
              // Tangani kesalahan jika terjadi
              console.error('Terjadi kesalahan saat menyimpan data');
          }
      });
  }

  $(document).ready(function(){
    var max_fields = 50;
    var wrapper = $("#temuanDT");
    var add_btn = $(".moreItems_add");
    var i = 1;
    $(add_btn).click(function(e){
      e.preventDefault();
      if (i < max_fields) {
        i++;

        //$(wrapper).append('<div id="temuanDT" class="card mt-5 mb-4 mx-4 px-3"><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan pertanyaan di sini" id="pertanyaan" style="height: 100px"></textarea><label for="pertanyaan">Masukkan pertanyaan disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu"></textarea><label for="indikatorMutu">Masukkan indikator mutu disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar"></textarea><label for="targetStandar">Masukkan target standar</label></div><div class="inputGrupText row justify-content-between g-3 mb-4 mx-4"><div class="col-7 border rounded me-5"><div class="row g-3 my-4 mx-3"><div class="col inputButirStandar"><label for="inputButirStandar" class="form-label">Butir Standar</label><input type="text" class="form-control" id="inputButirStandar"></div><div class="col inputReferensi"><label for="inputReferensi" class="form-label">Referensi</label><input type="text" class="form-control" id="inputReferensi"></div></div></div><div class="col-4 border rounded ms-5"><div class="row g-3 my-4 mx-3"><div class="col inputKeterangan"><label for="inputKeterangan" class="form-label">Keterangan</label><input type="text" class="form-control" id="inputKeterangan"></div></div></div></div><label for="#" class="mb-4 mx-4">Respon Auditee</label><div class="row g-3 mb-4 mx-4 border rounded"><div class="col my-4"><label for="inputDokSahih" class="form-label mx-4">Dokumen Bukti Sahih</label><div class="input-group mx-4 mb-4"><input type="file" class="form-control" id="inputDokSahih" aria-describedby="inputGroupFileAddon04" aria-label="Upload"><button class="btn btn-outline-secondary me-5" type="button" id="inputGroupFileAddon04">Unggah</button></div><div class="form-floating mb-3 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px"></textarea><label for="responAuditee">Tuliskan respon Auditee disini</label></div></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px"></textarea><label for="responAuditor">Tuliskan respon Auditor disini<b>**)</b></label></div><div class="row g-3 mb-4 mx-3"><div class="col"><label for="kategoriTemuan" class="form-label">Kategori Temuan<b>*)</b></label><div id="kategoriTemuan" class="border rounded ps-4 py-2"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriKTS" value="KTS" onclick="display()"><label class="form-check-label" for="kategoriKTS">KTS</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriOB" value="OB" onclick="display()"><label class="form-check-label" for="kategoriOB">OB</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriSesuai" value="Sesuai" onclick="display()"><label class="form-check-label" for="kategoriSesuai">Sesuai</label></div></div></div><div class="col"><label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label><input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan"></div></div><div id="narasiPLOR" class="form-floating mb-4 mx-4"></div><div class="row g-3 mb-4 mx-4"><div class="col border rounded px-4 py-4 me-2"><label for="inisialAuditor" class="form-label">Inisial Auditor</label><input id="inisialAuditor" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col border rounded px-4 py-4 ms-2"><label for="skorAuditor" class="form-label">Skor Auditor</label><input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor"></div></div></div>')
        $(wrapper).append('<form action="/daftartilik-insertpertanyaan" method="POST" enctype="multipart/form-data"><div id="temuanDTMore" class="card mt-5 mb-4 mx-4 px-3"><div class="row g-3 my-4 mx-3"><div class="col"><label for="butirStandar" class="visually-hidden">Butir Standar</label><input id="butirStandar" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar" name="butirStandar"></div><div class="col"><label for="nomorButir" class="visually-hidden">Nomor Butir</label><input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir" aria-label="Masukkan Nomor Butir" name="nomorButir"></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan pertanyaan di sini" id="pertanyaan" style="height: 100px" name="pertanyaan"></textarea><label for="pertanyaan">Masukkan pertanyaan disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu" name="*indikatormutu"></textarea><label for="indikatorMutu">Masukkan indikator mutu disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar" name="targetStandar"></textarea><label for="targetStandar">Masukkan target standar</label></div><div class="inputGrupText row justify-content-between g-3 mb-4 mx-4"><div class="col-7 border rounded me-5"><div class="row g-3 my-4 mx-3"><div class="col inputButirStandar"><label for="inputButirStandar" class="form-label">Butir Standar</label><input type="text" class="form-control" id="inputButirStandar" name="butirStandar"></div><div class="col inputReferensi"><label for="inputReferensi" class="form-label">Referensi</label><input type="text" class="form-control" id="inputReferensi" name="referensi"></div></div></div><div class="col-4 border rounded ms-5"><div class="row g-3 my-4 mx-3"><div class="col inputKeterangan"><label for="inputKeterangan" class="form-label">Keterangan</label><input type="text" class="form-control" id="inputKeterangan" name="keterangan"></div></div></div></div><label for="#" class="mb-4 mx-4">Respon Auditee</label><div class="row g-3 mb-4 mx-4 border rounded"><div class="col my-4"><label for="inputDokSahih" class="form-label mx-4">Dokumen Bukti Sahih</label><div class="input-group mx-4 mb-4"><input type="file" class="form-control" id="inputDokSahih" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="dok_sahihs[]"></div><div class="form-floating mb-3 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px" name="responAuditee"></textarea><label for="responAuditee">Tuliskan respon Auditee disini</label></div></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px" name="responAuditor"></textarea><label for="responAuditor">Tuliskan respon Auditor disini<b>**)</b></label></div><div class="row g-3 mb-4 mx-3"><div class="col"><label for="kategoriTemuan" class="form-label">Kategori Temuan<b>*)</b></label><div id="kategoriTemuan" class="border rounded ps-4 py-2"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="Kategori" id="kategoriKTS" value="KTS" onclick="display()"><label class="form-check-label" for="kategoriKTS">KTS</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="Kategori" id="kategoriOB" value="OB" onclick="display()"><label class="form-check-label" for="kategoriOB">OB</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="Kategori" id="kategoriSesuai" value="Sesuai" onclick="display()"><label class="form-check-label" for="kategoriSesuai">Sesuai</label></div></div></div><div class="col"><label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label><input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan" name="foto_kegiatans[]"></div></div><div id="narasiPLOR" class="form-floating mb-4 mx-4"></div><div class="row g-3 mb-4 mx-4"><div class="col border rounded px-4 py-4 me-2"><label for="inisialAuditor" class="form-label">Inisial Auditor</label><input id="inisialAuditor" type="text" class="form-control" placeholder="Inisial Auditor" aria-label="Inisial Auditor"></div><div class="col border rounded px-4 py-4 ms-2"><label for="skorAuditor" class="form-label">Skor Auditor</label><input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor" name="skorAuditor"></div></div></div></form>')
      }
    });
  });
</script>
    
@endpush
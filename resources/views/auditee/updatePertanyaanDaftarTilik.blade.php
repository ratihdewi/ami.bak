@extends('auditee.main_')

@section('title') AMI - Daftar Tilik - Pertanyaan @endsection

@section('linking')
    <a href="/auditee-daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    @foreach ($_daftartiliks as $item)
    <a href="/auditee-daftartilik/{{ $item->auditee->tahunperiode }}" class="mx-1">
    @endforeach
    @foreach ($_daftartiliks as $item)
    {{ $item->auditee->tahunperiode0 }}/{{ $item->auditee->tahunperiode }}
    </a>/
    @endforeach
    
    @foreach ($_daftartiliks as $item)
    <a href="/auditee-daftarTilik-areadaftartilik/{{ $item->auditee_id }}/{{ $item->area }}" class="mx-1">
    @endforeach
    @foreach ($_daftartiliks as $item)
    {{ $item->area }}
    </a>/
    @endforeach

    @foreach ($_daftartiliks as $item)
    <a href="/auditee-daftartilik-adddaftartilik/{{ $item->auditee_id }}/{{ $item->area }}" class="mx-1">
    @endforeach
    Pertanyaan
    </a>/ 
@endsection

@section('container')
      {{-- Form setiap auditee --}}
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
      @foreach ($_daftartiliks as $_daftartilik)
      @foreach ($_daftartilik->auditee()->get() as $auditee)
          <div id="infoDT" class="card mt-4 mb-4 mx-4 px-3">
              <div class="row g-3 my-4 mx-3">
                  <div class="col">
                      <label for="auditee_id" class="fw-semibold mb-1 ps-1">Auditee</label>
                      <select id="auditee_id" class="form-select" name="auditee_id" disabled>
                        <option selected disabled>{{ $auditee->unit_kerja }}</option>
                      </select>
                  </div>
                  <div class="col">
                      <label for="auditor_id" class="fw-semibold mb-1 ps-1">Auditor</label>
                      <select id="auditor_id" class="form-select" name="auditor_id" disabled>
                        <option selected disabled>{{ $_daftartilik->auditor->nama }}</option>
                      </select>
                  </div>
              </div>
              <div class="row g-3 mb-4 mx-3">
                  <div class="col">
                      <label for="tgl-pelaksanaan" class="fw-semibold mb-1 ps-1">Tanggal Pelaksanaan</label>
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
                      <label for="tempat" class="fw-semibold mb-1 ps-1">Tempat</label>
                      <input
                          type="text"
                          id="tempat"
                          class="form-control"
                          placeholder="Masukkan tempat pelaksanaan"
                          aria-label="Masukkan tempat pelaksanaan"
                          value="{{ $_daftartilik->tempat }}"
                          disabled
                      />
                  </div>
              </div>
              <div class="row g-3 mb-4 mx-4">
                  <label for="area" class="fw-semibold mb-1 ps-1">Area Audit</label>
                  <select id="area" class="form-select mt-0" name="area" disabled>
                      <option selected disabled>{{ $_daftartilik->area }}</option>
                      <option>Pendidikan</option>
                      <option>Penelitian</option>
                      <option>PkM</option>
                      <option>Tambahan</option>
                  </select>
              </div>
              <div class="row g-3 mb-5 mx-4">
                  <label for="bataspengisianRespon" class="fw-semibold mb-1 ps-1"
                      >Batas Pengisian Respon</label
                  >
                  <input
                      id="bataspengisianRespon"
                      type="text"
                      class="form-control mt-0"
                      placeholder="Berika Batas Pengisian Respon Auditee"
                      onfocus="(this.type='date')"
                      onblur="(this.type='text')"
                      aria-label="Berikan Batas Pengisian Respon Auditee"
                      value="{{ $_daftartilik->bataspengisianRespon->translatedFormat('l, d M Y') }}"
                      disabled
                  />
              </div>
          </div>
      {{-- </form> --}}
      @endforeach
      @endforeach
    
      {{-- Form (berbagai) pertanyaan dari setiap auiditee --}}
      <form id="myForm" action="/daftartilik-updatedatapertanyaandaftartilik/{{ $datas->id }}" method="POST" enctype="multipart/form-data">
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
            <div class="col" disabled>
              <label for="butirStandar" class="fw-semibold">Butir Standar</label>
              <input id="butirStandar" type="text" class="form-control" placeholder="Masukkan Butir Standar. Contoh: [01 Kompetensi Lulusan]" aria-label="Butir Standar" name="butirStandar" value="{{ $datas->butirStandar }}" disabled>
            </div>
            <div class="col">
              <label for="nomorButir" class="fw-semibold">Nomor Butir</label>
              <input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir. Contoh: [A.01.01]" aria-label="Masukkan Nomor Butir" name="nomorButir" value="{{ $datas->nomorButir }}" disabled>
            </div>
          </div>
          <div class="form-floating mx-4">
            <p class="fw-semibold mb-0">Pertanyaan</p>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Ajukan pertanyaan" id="auditeepertanyaan" style="height: 100px" name="pertanyaan" value="{{ $datas->pertanyaan }}">{{ $datas->pertanyaan }}</textarea>
          </div>
          <div class="form-floating mx-4">
            <p class="fw-semibold mb-0">Indikator Mutu</p>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan indikator mutu" id="auditeeindikatorMutu" name="indikatormutu" disabled>{{ $datas->indikatormutu }}</textarea>
          </div>
          <div class="form-floating mx-4">
            <p class="fw-semibold mb-0">Target Standar</p>
          </div>        
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan target standar" id="auditeetargetStandar" name="targetStandar" disabled>{{ $datas->targetStandar }}</textarea>
          </div>
          <div class="inputGrupText row justify-content-between g-3 mb-4 mx-4" id="inputGrupOpsional">
            <div class="col-7 border rounded me-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputButirStandar">
                  <label for="inputButirStandar" class="form-label fw-semibold">Butir Standar</label>
                  <input type="text" class="form-control" id="inputButirStandar" value="{{ $datas->butirStandar }}" disabled>
                </div>
                <div class="col inputReferensi">
                  <label for="inputReferensi" class="form-label fw-semibold">Referensi</label>
                  <input type="text" class="form-control" id="inputReferensi" name="referensi" value="{{ $datas->referensi }}" disabled>
                </div>
              </div>
            </div>
            <div class="col-4 border rounded ms-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputKeterangan">
                  <label for="inputKeterangan" class="form-label fw-semibold">Keterangan</label>
                  <input type="text" class="form-control" id="inputKeterangan" name="keterangan" value="{{ $datas->keterangan }}" disabled>
                </div>
              </div>
            </div>
          </div>
          <label for="responAuditeeGroup" class="mb-4 mx-4 fw-semibold">Respon Auditee <span class="text-danger fw-semibold">*</span></label>
          <div id="responAuditeeGroup" class="row g-3 mb-4 mx-4 border rounded">
            <div class="col my-4">
              <div class="row mx-2 mb-4 px-1">
                <label for="inputDokSahih" class="form-label fw-semibold">Dokumen Bukti Sahih <span class="text-danger fw-semibold">*</span></label>
                <a href="/auditee-editdokumensahih/{{ $datas->id }}">
                  <button id="inputDokSahih" type="button" class="btn btn-outline-secondary w-100"><b>Dokumen Bukti Sahih</b></button>
                </a>
              </div>
              <div class="form-floating mx-4">
                <p class="fw-semibold mb-0">Respon Auditee <span class="text-danger fw-bold">*</span></p>
              </div>
              <div class="form-floating mb-3 mx-4">
                <textarea class="form-control" placeholder="Tuliskan respon Auditee" id="responAuditee" style="height: 100px" name="responAuditee"
                @if (($datas->responAuditee != NULL &&  Auth::user()->role == "Auditor") || $datas->approvalAuditor == 'Disetujui Auditor' || $datas->approvalAuditee == 'Disetujui Auditee')
                    {{ "readonly" }}
                @elseif ($datas->responAuditee == NULL &&  Auth::user()->role != "SPM")
                    {{ "required" }}
                @endif
                >{{ $datas->responAuditee }}</textarea>
                <label for="responAuditee">Tuliskan respon Auditee</label>
              </div>
            </div>
          </div>
          <label for="#" class="mb-2 mx-4 fw-semibold">Respon Auditor</label>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px" name="responAuditor" disabled>{{ $datas->responAuditor }}</textarea>
            <label for="responAuditor">Tuliskan respon Auditor<b> **)</b></label>
          </div>
          <div class="row g-3 mb-4 mx-3">
            <div class="col">
              <label for="kategoriTemuan" class="form-label fw-semibold">Kategori Temuan<b> *)</b></label>
              <div id="kategoriTemuan" class="border rounded ps-4 py-2" style="background-color: #e9ecef">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Kategori" id="kategoriKTS" onclick="display()" value="{{ $datas->Kategori }}" 
                  
                    @if ($datas->Kategori == "KTS")
                      {{ "checked" }}
                    @else
                      {{ "disabled" }}
                    @endif
                  >
                  <label class="form-check-label" for="kategoriKTS">KTS</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Kategori" id="kategoriOB" onclick="display()" value="{{ $datas->Kategori }}"
                  
                    @if ($datas->Kategori == "OB")
                      {{ "checked" }}
                    @else
                      {{ "disabled" }}
                    @endif
                  >
                  <label class="form-check-label" for="kategoriOB">OB</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Kategori" id="kategoriSesuai" onclick="display()" value="{{ $datas->Kategori }}"
                  
                    @if ($datas->Kategori == "Sesuai")
                      {{ "checked" }}
                    @else
                      {{ "disabled" }}
                    @endif
                  >
                  <label class="form-check-label" for="kategoriSesuai">Sesuai</label>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="fotoKegiatan" class="form-label fw-semibold">Dokumentasi Foto Kegiatan</label>
              <a href="/auditee-editfotokegiatan/{{ $datas->auditee_id }}/{{ $datas->auditee->tahunperiode }}/{{ $datas->id }}">
                <button id="fotoKegiatan" type="button" class="btn btn-outline-secondary w-100"><b>Foto Kegiatan</b></button>
              </a>
            </div>
          </div>
          <div id="narasiPLOR" class="form-floating mb-4 mx-4"></div>
          <div class="row g-3 mb-4 mx-4">
            <div class="col border rounded px-4 py-4 me-2">
              <label for="inisialAuditor" class="form-label fw-semibold">Inisial Auditor</label>
              <input id="inisialAuditor" type="text" class="form-control" placeholder="Inisial Auditor" aria-label="Masukkan Inisial Auditor" name="inisialAuditor" value="{{ $datas->inisialAuditor }}" disabled>
            </div>
            <div class="col border rounded px-4 py-4 ms-2">
              <label for="skorAuditor" class="form-label fw-semibold">Skor Auditor</label>
              <input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor. Contoh: [4.00]" aria-label="Masukkan Skor Auditor" name="skorAuditor" value="{{ $datas->skorAuditor }}" disabled>
            </div>
          </div>
        </div>
        <div class="keteranganTambahan mx-4 mb-2">
          <p class="mb-0"><b>*)</b> Jika Auditee tidak dapat menyetujui status temuan, maka Auditee harus menunjukkan dokumen bukti sahih melalui media lain dan mengunggah dokumen bukti sahih yang baru</p>
          <p class="mb-0"><b>**)</b> Pernyataan Auditor dianggap valid hingga 7 hari terhitung setelah audit dilaksanakan</p>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end me-4 mb-4 mt-3">
          @foreach ($_daftartiliks as $item)
          <a href="/auditee-daftarTilik-areadaftartilik/{{ $item->auditee->id }}/{{ $item->area }}"><button class="btn btn-outline-secondary me-md-1" type="button">Kembali</button></a>
          @endforeach
          <button class="btn btn-secondary me-md-2" type="button" disabled>
          @if ($datas->approvalAuditor == 'Belum disetujui Auditor')
                {{ "Menunggu pengajuan persetujuan Auditor" }}
          @else
              {{ $datas->approvalAuditor }}
          @endif
          </button>
          <a href="/approvalAuditee-daftartilik/{{ $datas->id }}">
            <button type="button" class="btn btn-success me-md-2" onclick="return confirm('Apakah Anda yakin akan menyetujui Audit Lapangan ini?')"
            @foreach ($auditee_ as $auditee)
              @if (Auth::user()->name != $auditee->ketua_auditee || $datas->approvalAuditor == 'Disetujui Auditor' || $datas->approvalAuditor == 'Belum disetujui Auditor'|| $datas->approvalAuditee == 'Disetujui Auditee')
                {{ "disabled" }}
            @endif
            @endforeach
            >
            @if ($datas->approvalAuditor == 'Menunggu persetujuan Auditee' && $datas->approvalAuditee == 'Belum disetujui Auditee')
                {{ "Setujui AL" }}
            @elseif ($datas->approvalAuditee == 'Disetujui Auditee')
                {{ "Disetujui Auditee" }}
            @else
                {{ "Setujui AL" }}
            @endif
            </button>
          </a>
          <button class="btn btn-success" type="submit" style="background: #00D215; border: 1px solid #008F0E;">Simpan</button>
        </div>
      </form>
    {{-- </form> --}}
    
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.tiny.cloud/1/giukfcgxmwoga5mpve1dcvfwuwqcbliwn88cqrd4ffjc17h1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>

  tinymce.init({
    selector: 'textarea#auditeepertanyaan',
    toolbar: false,
    menubar: false,
    height: 150,
    readonly: true,
    // content_css: '/css/tinyAuditee.css',
  });

  tinymce.init({
    selector: 'textarea#auditeeindikatorMutu',
    toolbar: false,
    menubar: false,
    height: 100,
    readonly: true,
    // content_style: '/css/tinyAuditee.css',
  });

  tinymce.init({
    selector: 'textarea#auditeetargetStandar',
    toolbar: false,
    menubar: false,
    height: 100,
    readonly: true,
  });

  var plor = '<textarea class="form-control" placeholder="Tuliskan narasi PLOR (Problem, Location, Objective, Reference)" id="responAuditor" style="height: 100px" name="narasiPLOR" value="{{ $datas->narasiPLOR }}" disabled>{{ $datas->narasiPLOR }}</textarea><label for="responAuditor">Tuliskan narasi PLOR (Problem, Location, Objective, Reference)<b>**)</b></label>';

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
      var plor = '<textarea class="form-control" placeholder="Tuliskan narasi PLOR (Problem, Location, Objective, Reference)" id="responAuditor" style="height: 100px" name="narasiPLOR" value="{{ $datas->narasiPLOR }}" readonly>{{ $datas->narasiPLOR }}</textarea><label for="responAuditor">Tuliskan narasi PLOR (Problem, Location, Objective, Reference)<b>**)</b></label>';

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

    var tglpelaksanaan = "{{ $tglpelaksanaan }}";
    var currentDate = "{{ $currentDate }}";
    
    if (currentDate > tglpelaksanaan) {
      let pertanyaan_id = '{{ $datas->id }}';
      console.log(pertanyaan_id);

      $.ajax({
          url: '/auditlapangan-autoapprove/' + pertanyaan_id,
          method: 'GET',
          success: function(data) {
              console.log('url berhasil');
          },
          error: function(error) {
              console.error('Terjadi kesalahan saat menyimpan data');
          }
      });
    }

    $(add_btn).click(function(e){
      e.preventDefault();
      if (i < max_fields) {
        i++;

        $(wrapper).append('<div id="temuanDT" class="card mt-5 mb-4 mx-4 px-3"><div class="row g-3 my-4 mx-3"><div class="col"><label for="butirStandar" class="visually-hidden">Butir Standar</label><input id="butirStandar" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col"><label for="nomorButir" class="visually-hidden">Nomor Butir</label><input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir" aria-label="Masukkan Nomor Butir"></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan pertanyaan di sini" id="pertanyaan" style="height: 100px"></textarea><label for="pertanyaan">Masukkan pertanyaan disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu"></textarea><label for="indikatorMutu">Masukkan indikator mutu disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar"></textarea><label for="targetStandar">Masukkan target standar</label></div><div class="inputGrupText row justify-content-between g-3 mb-4 mx-4"><div class="col-7 border rounded me-5"><div class="row g-3 my-4 mx-3"><div class="col inputButirStandar"><label for="inputButirStandar" class="form-label">Butir Standar</label><input type="text" class="form-control" id="inputButirStandar"></div><div class="col inputReferensi"><label for="inputReferensi" class="form-label">Referensi</label><input type="text" class="form-control" id="inputReferensi"></div></div></div><div class="col-4 border rounded ms-5"><div class="row g-3 my-4 mx-3"><div class="col inputKeterangan"><label for="inputKeterangan" class="form-label">Keterangan</label><input type="text" class="form-control" id="inputKeterangan"></div></div></div></div><label for="#" class="mb-4 mx-4">Respon Auditee</label><div class="row g-3 mb-4 mx-4 border rounded"><div class="col my-4"><label for="inputDokSahih" class="form-label mx-4">Dokumen Bukti Sahih</label><div class="input-group mx-4 mb-4"><input type="file" class="form-control" id="inputDokSahih" aria-describedby="inputGroupFileAddon04" aria-label="Upload"><button class="btn btn-outline-secondary me-5" type="button" id="inputGroupFileAddon04">Unggah</button></div><div class="form-floating mb-3 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px"></textarea><label for="responAuditee">Tuliskan respon Auditee disini</label></div></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px"></textarea><label for="responAuditor">Tuliskan respon Auditor disini</label></div><div class="row g-3 mb-4 mx-3"><div class="col"><label for="kategoriTemuan" class="form-label">Kategori Temuan</label><div id="kategoriTemuan" class="border rounded ps-4 py-2"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriKTS" value="KTS" onclick="display()"><label class="form-check-label" for="kategoriKTS">KTS</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriOB" value="OB" onclick="display()"><label class="form-check-label" for="kategoriOB">OB</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriSesuai" value="Sesuai" onclick="display()"><label class="form-check-label" for="kategoriSesuai">Sesuai</label></div></div></div><div class="col"><label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label><input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan"></div></div><div id="narasiPLOR" class="form-floating mb-4 mx-4"></div><div class="row g-3 mb-4 mx-4"><div class="col border rounded px-4 py-4 me-2"><label for="inisialAuditor" class="form-label">Inisial Auditor</label><input id="inisialAuditor" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col border rounded px-4 py-4 ms-2"><label for="skorAuditor" class="form-label">Skor Auditor</label><input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor"></div></div></div>')
      }
    });

    // var textarea = $('#pertanyaan');
    // textarea.prop('readonly', !textarea.prop('readonly'));

  });
</script>
    
@endpush
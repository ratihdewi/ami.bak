@extends('layout.main') 
@section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    @foreach ($data as $item)
    <a href="/daftartilik/{{ $item->auditee->tahunperiode }}" class="mx-1">
    @endforeach
    @foreach ($data as $item)
    {{ $item->auditee->tahunperiode }}/{{ $item->auditee->tahunperiode }}
    </a>/
    @endforeach
    
    @foreach ($data as $item)
    <a href="/daftarTilik-areadaftartilik/{{ $item->auditee_id }}/{{ $item->area }}" class="mx-1">
    @endforeach
    @foreach ($data as $item)
    {{ $item->area }}
    </a>/
    @endforeach

    @foreach ($data as $item)
    <a href="/daftartilik-adddaftartilik/{{ $item->auditee_id }}/{{ $item->area }}" class="mx-1">
    @endforeach
    Tambah Pertanyaan
    </a>/  

@endsection

@section('container')
      <h5 class="mx-4 mt-3">Tambah Pertanyaan Daftar Tilik</h5>
      @foreach ($data as $item)
      @foreach ($item->auditee()->get() as $dt)
          <div id="infoDT" class="card mt-3 mb-4 mx-4 px-3">
              <div class="row g-3 my-4 mx-3">
                  <div class="col">
                      <label for="auditee_id" class="visually-hidden">Auditee</label>
                      <select
                          id="auditee_id"
                          class="form-select"
                          name="auditee_id"
                          disabled
                      >
                          <option selected disabled>{{ $dt->unit_kerja }}</option>
                          @foreach ($listAuditee as $liAuditee)
                          <option value="{{ $liAuditee->id }}" name="auditee_id">
                              {{ $liAuditee->unit_kerja }}
                          </option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col">
                      <label for="auditor_id" class="visually-hidden">Auditor</label>
                      <select id="auditor_id" class="form-select" name="auditor_id" disabled>
                          <option selected disabled>{{ $item->auditor->nama }}</option>
                          @foreach ($listAuditor as $liAuditor)
                          <option>{{ $liAuditor->nama }}</option>
                          @endforeach
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
                          value="{{ $item->tgl_pelaksanaan->translatedFormat('l, d M Y') }}"
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
                          value="{{ $item->tempat }}"
                          disabled
                      />
                  </div>
              </div>
              <div class="row g-3 mb-4 mx-4">
                  <label for="area" class="visually-hidden">Area Audit</label>
                  <select id="area" class="form-select" name="area" disabled>
                      <option selected disabled>{{ $item->area }}</option>
                      <option>Pendidikan</option>
                      <option>Penelitian</option>
                      <option>PkM</option>
                      <option>Tambahan</option>
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
                      value="{{ $item->bataspengisianRespon->translatedFormat('l, d M Y') }}"
                      disabled
                  />
              </div>
          </div>
      {{-- </form> --}}
      @endforeach
      @endforeach
      {{-- {{ $data }} --}}
      {{-- Form (berbagai) pertanyaan dari setiap auiditee --}}
      @foreach ($data as $item)
      <form id="myForm" action="/daftartilik-insertpertanyaan" method="POST" enctype="multipart/form-data">
      @endforeach
        @csrf
        <div id="temuanDT" class="card mt-4 mb-1 mx-4 px-3">
          @foreach ($data as $item)
          <div class="row g-3 my-4 mx-3" hidden>
            <div class="col">
                <input
                    type="number"
                    id="daftartilik_id"
                    class="form-control"
                    placeholder="Masukkan tempat pelaksanaan"
                    aria-label="Masukkan tempat pelaksanaan"
                    name="daftartilik_id"
                    value="{{ $item->id }}"
                    hidden
                />
            </div>
            <div class="col">
                <input
                    type="number"
                    id="auditee_id_"
                    class="form-control"
                    placeholder="Masukkan tempat pelaksanaan"
                    aria-label="Masukkan tempat pelaksanaan"
                    name="auditee_id"
                    value="{{ $item->auditee->id }}"
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
                    value="{{ $item->auditor->id }}"
                    hidden
                />
            </div>
          </div>
          @endforeach
          <div class="row g-3 my-4 mx-3">
            <div class="col">
              <label for="butirStandar" class="fw-semibold">Butir Standar <span class="text-danger fw-bold">*</span></label>
              <input id="butirStandar" type="text" class="form-control" placeholder="Masukkan Butir Standar. Contoh: [01 Kompetensi Lulusan]" aria-label="Butir Standar" name="butirStandar" value="{{ old('butirStandar') }}">
            </div>
            <div class="col">
              <label for="nomorButir" class="fw-semibold">Nomor Butir <span class="text-danger fw-bold">*</span></label>
              <input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir. Contoh: [A.01.01]" aria-label="Masukkan Nomor Butir" name="nomorButir" value="{{ old('nomorButir') }}">
            </div>
          </div>
          <div class="form-floating mx-4">
            <p class="fw-semibold mb-0">Pertanyaan <span class="text-danger fw-bold">*</span></p>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Ajukan Pertanyaan" id="pertanyaan" style="height: 100px" name="pertanyaan" value="{{ old('pertanyaan') }}"></textarea>
            <label for="pertanyaan">Pertanyaan</label>
          </div>
          <div class="form-floating mx-4">
            <p class="fw-semibold mb-0">Indikator Mutu <span class="text-danger fw-bold">*</span></p>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu" name="indikatormutu" value="{{ old('indikatormutu') }}"></textarea>
            <label for="indikatorMutu">Masukkan indikator mutu</label>
          </div>
          <div class="form-floating mx-4">
            <p class="fw-semibold mb-0">Target Standar <span class="text-danger fw-bold">*</span></p>
          </div>        
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar" name="targetStandar" value="{{ old('targetStandar') }}"></textarea>
            <label for="targetStandar">Masukkan target standar</label>
          </div>
          <div class="inputGrupText row justify-content-between g-3 mb-4 mx-4">
            <div class="col-7 border rounded me-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputButirStandar">
                  <label for="inputButirStandar" class="form-label fw-semibold">Butir Standar <span class="text-danger fw-bold">*</span></label>
                  <input type="text" class="form-control" id="inputButirStandar" value="{{ old('butirStandar') }}">
                </div>
                <div class="col inputReferensi">
                  <label for="inputReferensi" class="form-label fw-semibold">Referensi</label>
                  <input type="text" class="form-control" id="inputReferensi" name="referensi" value="{{ old('referensi') }}">
                </div>
              </div>
            </div>
            <div class="col-4 border rounded ms-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputKeterangan">
                  <label for="inputKeterangan" class="form-label fw-semibold">Keterangan</label>
                  <input type="text" class="form-control" id="inputKeterangan" name="keterangan" value="{{ old('keterangan') }}">
                </div>
              </div>
            </div>
          </div>
          <label for="#" class="mb-4 mx-4 fw-semibold">Respon Auditee</label>
          <div class="row g-3 mb-4 mx-4 border rounded">
            <div class="col my-4">
              <div class="row mt-2 mx-4">
                @if (session('warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('warning') }}
                    </div>
                @endif
              </div>
              <div class="row mx-2 mb-4 px-1">
                <label for="inputDokSahih" class="form-label">Dokumen Bukti Sahih</label>
                <a href="/dokumensahih">
                  <button id="inputDokSahih" type="button" class="btn btn-outline-secondary w-100"><b>Dokumen Bukti Sahih</b></button>
                </a>
              </div>
              <div class="form-floating mb-3 mx-4">
                <textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px" name="responAuditee"></textarea>
                <label for="responAuditee">Tuliskan respon Auditee</label>
              </div>
            </div>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px" name="responAuditor"></textarea>
            <label for="responAuditor">Tuliskan respon Auditor <b>**)</b></label>
          </div>
          <div class="row g-3 mb-4 mx-3">
            <div class="col">
              <label for="kategoriTemuan" class="form-label">Kategori Temuan <b>*)</b></label>
              <div id="kategoriTemuan" class="border rounded ps-4 py-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Kategori" id="kategoriKTS" value="KTS" onclick="display()">
                  <label class="form-check-label" for="kategoriKTS">KTS</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Kategori" id="kategoriOB" value="OB" onclick="display()">
                  <label class="form-check-label" for="kategoriOB">OB</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Kategori" id="kategoriSesuai" value="Sesuai" onclick="display()">
                  <label class="form-check-label" for="kategoriSesuai">Sesuai</label>
                </div>
              </div>
            </div>
            {{-- {{ $pertanyaan_id }} --}}
            <div class="col">
              <label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label>
              <button id="fotoKegiatan" type="button" class="btn btn-outline-secondary w-100"><b>Foto Kegiatan</b></button>
            </div>
          </div>
          <div id="narasiPLOR" class="form-floating mb-4 mx-4"></div>
          <div class="row g-3 mb-4 mx-4">
            <div class="col border rounded px-4 py-4 me-2">
              <label for="inisialAuditor" class="form-label">Inisial Auditor</label>
              <input id="inisialAuditor" type="text" class="form-control" placeholder="Butir Standar" aria-label="Masukkan Inisial Auditor" name="inisialAuditor">
            </div>
            <div class="col border rounded px-4 py-4 ms-2">
              <label for="skorAuditor" class="form-label">Skor Auditor</label>
              <input id="skorAuditor" type="number" min="0.00" max="4.00" step="0.01" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor" name="skorAuditor">
            </div>
          </div>
        </div>
        <div class="keteranganTambahan mx-4 mb-2">
          <p class="mb-0"><b>*</b> Jika Auditee tidak dapat menyetujui status temuan, maka Auditee harus menunjukkan dokumen bukti sahih melalui media Line dan mengunggah dokumen bukti sahih yang baru</p>
          <p class="mb-0"><b>**</b> Pernyataan Auditor dianggap valid hingga 7 hari terhitung setelah audit dilaksanakan</p>
        </div>
        {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end me-4 mb-4">
          <button class="moreItems_add btn btn-primary float-end" type="button">Tambah Pertanyaan</button>
        </div> --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-end me-4 mb-4">
          @foreach ($data as $item)
            <a href="/daftarTilik-areadaftartilik/{{ $item->auditee_id }}/{{ $item->area }}"><button class="btn btn-outline-secondary me-md-2" type="button">Kembali</button></a>
          @endforeach
          <button class="btn btn-success me-md-2" type="button">Persetujuan Auditor</button>
          <button class="btn btn-success me-md-2" type="button">Persetujuan Auditee</button>
          <button class="btn btn-success" type="submit" style="background: #00D215; border: 1px solid #008F0E;">Simpan</button>
        </div>
      </form>
    {{-- </form> --}}
    
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
        function display() {
            var plor = '<textarea class="form-control" placeholder="Tuliskan narasi PLOR (Problem, Location, Objective, Reference)" id="responAuditor" style="height: 100px" name="narasiPLOR"></textarea><label for="responAuditor">Tuliskan narasi PLOR (Problem, Location, Objective, Reference) <b>**)</b></label>';

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

        var isInputPending = false; // Menyimpan status input yang tertunda
        var questionId = null; // Menyimpan ID pertanyaan yang sudah ada
        var idPertanyaan = null;

        var inputElements = document.querySelectorAll('input, textarea, select');

        // Tambahkan event listener ke setiap elemen input untuk mengatur isInputPending menjadi true saat ada perubahan
        inputElements.forEach(function(input) {
            input.addEventListener('input', function() {
                isInputPending = true;
            });
        });

        window.addEventListener('beforeunload', function(event) {
          if (isInputPending) {
            
            var confirmationMessage = 'Anda memiliki perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman? Data yang belum disimpan akan hilang.';
            var userConfirmed = window.confirm(confirmationMessage);
            
            // Jika pengguna memilih "Batal," cegah perubahan halaman
            if (!userConfirmed) {
                event.preventDefault();
                event.returnValue = '';
            }
            
            // Jika pengguna memilih "OK," panggil fungsi saveFormData
            if (userConfirmed) {
                saveFormData();
            }
        }
        });

        function saveFormData() {
          // Menggunakan AJAX untuk mengirim data ke server
          var formData = new FormData(document.getElementById('myForm'));
          idPertanyaan = null;

          // Jika ada ID pertanyaan yang sudah ada, kirimkan ID tersebut bersama data form
          if (questionId !== null) {
              formData.append('question_id', questionId);
          }

          // Mengembalikan promise
          return new Promise(function(resolve, reject) {
              $.ajax({
                  url: '/daftartilik-autosavepertanyaan', // Ganti dengan URL endpoint server Anda
                  method: 'POST',
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function(response) {
                      // Jika server mengembalikan ID pertanyaan, simpan ID tersebut
                      if (response.hasOwnProperty('question_id')) {
                          questionId = response.question_id;
                      }
                      // Berikan umpan balik ke pengguna jika sukses
                      console.log('Data berhasil disimpan');
                      console.log(response);
                      idPertanyaan = response.data.id;
                      console.log("ID Pertanyaan = " + idPertanyaan);
                      
                      // Setelah penyimpanan berhasil, atur isInputPending menjadi false
                      isInputPending = false;
                      resolve(response); // Mengembalikan response
                  },
                  error: function(error) {
                      // Tangani kesalahan jika terjadi
                      console.error('Terjadi kesalahan saat menyimpan data');
                      // Setelah terjadi kesalahan, atur isInputPending menjadi false untuk mencegah autosave terus-menerus
                      isInputPending = false;
                      reject(error); // Mengembalikan error
                  }
              });
          });
        }

  $(document).ready(function(){
    var max_fields = 50;
    var wrapper = $("#temuanDT");
    var add_btn = $(".moreItems_add");
    var i = 1;
    var auditee_id = $('#auditee_id_').val();
    var butirStandar;
    var nomorButir;
    var pertanyaan;
    var indikatorMutu;
    var targetStandar;
    var inputButirStandar;
    var referensi;
    var keterangan;
    var responAuditee;
    var responAuditor;
    var kategori;
    var narasiPLOR;
    var inisialAuditor;
    var skorAuditor;

    console.log(auditee_id);
    // console.log(butirStandar);

    $('#butirStandar').change(function() {
      var bs = $(this).val();
      $('#inputButirStandar').val(bs);
    });

    $(add_btn).click(function(e){
      e.preventDefault();
      if (i < max_fields) {
        i++;
        
        $(wrapper).append('<div id="temuanDT" class="card mt-5 mb-4 mx-4 px-3"><div class="row g-3 my-4 mx-3"><div class="col"><label for="butirStandar" class="visually-hidden">Butir Standar</label><input id="butirStandar" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col"><label for="nomorButir" class="visually-hidden">Nomor Butir</label><input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir" aria-label="Masukkan Nomor Butir"></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan pertanyaan di sini" id="pertanyaan" style="height: 100px"></textarea><label for="pertanyaan">Masukkan pertanyaan disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu"></textarea><label for="indikatorMutu">Masukkan indikator mutu disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar"></textarea><label for="targetStandar">Masukkan target standar</label></div><div class="inputGrupText row justify-content-between g-3 mb-4 mx-4"><div class="col-7 border rounded me-5"><div class="row g-3 my-4 mx-3"><div class="col inputButirStandar"><label for="inputButirStandar" class="form-label">Butir Standar</label><input type="text" class="form-control" id="inputButirStandar"></div><div class="col inputReferensi"><label for="inputReferensi" class="form-label">Referensi</label><input type="text" class="form-control" id="inputReferensi"></div></div></div><div class="col-4 border rounded ms-5"><div class="row g-3 my-4 mx-3"><div class="col inputKeterangan"><label for="inputKeterangan" class="form-label">Keterangan</label><input type="text" class="form-control" id="inputKeterangan"></div></div></div></div><label for="#" class="mb-4 mx-4">Respon Auditee</label><div class="row g-3 mb-4 mx-4 border rounded"><div class="col my-4"><label for="inputDokSahih" class="form-label mx-4">Dokumen Bukti Sahih</label><div class="input-group mx-4 mb-4"><input type="file" class="form-control" id="inputDokSahih" aria-describedby="inputGroupFileAddon04" aria-label="Upload"><button class="btn btn-outline-secondary me-5" type="button" id="inputGroupFileAddon04">Unggah</button></div><div class="form-floating mb-3 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px"></textarea><label for="responAuditee">Tuliskan respon Auditee disini</label></div></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px"></textarea><label for="responAuditor">Tuliskan respon Auditor disini</label></div><div class="row g-3 mb-4 mx-3"><div class="col"><label for="kategoriTemuan" class="form-label">Kategori Temuan</label><div id="kategoriTemuan" class="border rounded ps-4 py-2"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriKTS" value="KTS" onclick="display()"><label class="form-check-label" for="kategoriKTS">KTS</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriOB" value="OB" onclick="display()"><label class="form-check-label" for="kategoriOB">OB</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriSesuai" value="Sesuai" onclick="display()"><label class="form-check-label" for="kategoriSesuai">Sesuai</label></div></div></div><div class="col"><label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label><input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan"></div></div><div id="narasiPLOR" class="form-floating mb-4 mx-4"></div><div class="row g-3 mb-4 mx-4"><div class="col border rounded px-4 py-4 me-2"><label for="inisialAuditor" class="form-label">Inisial Auditor</label><input id="inisialAuditor" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col border rounded px-4 py-4 ms-2"><label for="skorAuditor" class="form-label">Skor Auditor</label><input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor"></div></div></div>')
      }
    });

    $('#fotoKegiatan').click(function() {
      butirStandar = $('#butirStandar').val();
      nomorButir = $('#nomorButir').val();
      pertanyaan = $('#pertanyaan').val();
      indikatorMutu = $('#indikatorMutu').val();
      targetStandar = $('#targetStandar').val();
      referensi = $('#inputReferensi').val();
      keterangan = $('#inputKeterangan').val();
      responAuditee = $('#responAuditee').val();
      responAuditor = $('#responAuditor').val();
      kategori = $('#kategoriTemuan').val();
      narasiPLOR = $('#narasiPLOR').val();
      inisialAuditor = $('#inisialAuditor').val();
      skorAuditor = $('#skorAuditor').val();
      tahunperiode = "{{ $pertanyaan_id->auditee->tahunperiode }}";
      console.log(tahunperiode);
      console.log(butirStandar);

      
      if (butirStandar == '' && nomorButir == '' && pertanyaan == '' && indikatorMutu == '' && targetStandar == '' && referensi == '' && keterangan == '' && responAuditee == '' && responAuditor == '' && kategori == '' && narasiPLOR == '' && inisialAuditor == '' && skorAuditor == '') {
        console.log("Gagal");
        $.ajax({
          url: '/fotokegiatan/' + auditee_id,
          method: 'GET',
          success: function(data){
            console.log("sukses url");
            console.log("ID Pertanyaan di foto kegiatan = " + idPertanyaan);
            window.location.href = '/fotokegiatan/' + auditee_id;
          }
        });
      } else if (butirStandar != '' || nomorButir != '' || pertanyaan != '' || indikatorMutu != '' || targetStandar != '' || referensi != '' || keterangan != '' || responAuditee != '' || responAuditor != '' || kategori != '' || narasiPLOR != '' || inisialAuditor != '' || skorAuditor != '') {
        saveFormData().then(function(response) {
            // Di sini Anda bisa menggunakan nilai response.data.id
            var idPertanyaan = response.data.id;
            console.log("Nilai ID Pertanyaan di foto = " + idPertanyaan);
            // Lakukan operasi lain dengan nilai tersebut
            
            $.ajax({
              url: '/spm-editfotokegiatan/' + auditee_id + '/' + tahunperiode + '/' + idPertanyaan,
              method: 'GET',
              success: function(data){
                console.log("sukses url");
                console.log("ID Pertanyaan di foto kegiatan = " + idPertanyaan);
                window.location.href = '/spm-editfotokegiatan/' + auditee_id + '/' + tahunperiode + '/' + idPertanyaan;
              }
            });
        }).catch(function(error) {
            // Tangani kesalahan jika terjadi
            console.error('Terjadi kesalahan: ' + error);
        });
        console.log("Terisi");
      }
    });
  });
</script>
    
@endpush
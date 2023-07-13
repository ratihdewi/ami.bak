@extends('layout.main') 
@section('title') AMI - Daftar Tilik @endsection

@section('container')
      {{-- Form setiap auditee --}}
      @foreach ($data as $item)
      @foreach ($item->auditee()->get() as $dt)
      {{-- @foreach ($item->auditor()->get() as $da)
        {{ $da }}
      @endforeach --}}
      {{-- <form action="/insertareaDT" method="POST">
          @csrf --}}
          <div id="infoDT" class="card mt-5 mb-4 mx-4 px-3">
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
                          name="tgl_pelaksanaan"
                          value="{{ $item->tgl_pelaksanaan->translatedFormat('d-m-y') }}"
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
                      name="bataspengisianRespon"
                      value="{{ $item->bataspengisianRespon->translatedFormat('d-m-y') }}"
                      disabled
                  />
              </div>
          </div>
      {{-- </form> --}}
      @endforeach
      @endforeach
    
      {{-- Form (berbagai) pertanyaan dari setiap auiditee --}}
      @foreach ($data as $item)
      <form action="/daftartilik-insertpertanyaan" method="POST" enctype="multipart/form-data">
      @endforeach
        @csrf
        <div id="temuanDT" class="card mt-4 mb-4 mx-4 px-3">
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
                    id="auditee_id"
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
              <label for="butirStandar" class="visually-hidden">Butir Standar</label>
              <input id="butirStandar" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar" name="butirStandar" value="{{ old('butirStandar') }}">
            </div>
            <div class="col">
              <label for="nomorButir" class="visually-hidden">Nomor Butir</label>
              <input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir" aria-label="Masukkan Nomor Butir" name="nomorButir" value="{{ old('nomorButir') }}">
            </div>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan pertanyaan di sini" id="pertanyaan" style="height: 100px" name="pertanyaan" value="{{ old('pertanyaan') }}"></textarea>
            <label for="pertanyaan">Masukkan pertanyaan disini</label>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu" name="indikatormutu" value="{{ old('indikatormutu') }}"></textarea>
            <label for="indikatorMutu">Masukkan indikator mutu disini</label>
          </div>        
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar" name="targetStandar" value="{{ old('targetStandar') }}"></textarea>
            <label for="targetStandar">Masukkan target standar</label>
          </div>
          <div class="inputGrupText row justify-content-between g-3 mb-4 mx-4">
            <div class="col-7 border rounded me-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputButirStandar">
                  <label for="inputButirStandar" class="form-label">Butir Standar</label>
                  <input type="text" class="form-control" id="inputButirStandar" value="{{ old('butirStandar') }}">
                </div>
                <div class="col inputReferensi">
                  <label for="inputReferensi" class="form-label">Referensi</label>
                  <input type="text" class="form-control" id="inputReferensi" name="referensi" value="{{ old('referensi') }}">
                </div>
              </div>
            </div>
            <div class="col-4 border rounded ms-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputKeterangan">
                  <label for="inputKeterangan" class="form-label">Keterangan</label>
                  <input type="text" class="form-control" id="inputKeterangan" name="keterangan" value="{{ old('keterangan') }}">
                </div>
              </div>
            </div>
          </div>
          <label for="#" class="mb-4 mx-4">Respon Auditee</label>
          <div class="row g-3 mb-4 mx-4 border rounded">
            <div class="col my-4">
              <div class="col mx-4 mb-4">
                <label for="inputDokSahih" class="form-label">Dokumen Bukti Sahih</label>
                <input id="inputDokSahih" type="file" class="form-control py-2" placeholder="Masukkan Dokumen Sahih" aria-label="Masukkan Dokumen Sahih" name="dok_sahihs[]">
              </div>
              <div class="form-floating mb-3 mx-4">
                <textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px" name="responAuditee"></textarea>
                <label for="responAuditee">Tuliskan respon Auditee disini</label>
              </div>
            </div>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px" name="responAuditor"></textarea>
            <label for="responAuditor">Tuliskan respon Auditor disini</label>
          </div>
          <div class="row g-3 mb-4 mx-3">
            <div class="col">
              <label for="kategoriTemuan" class="form-label">Kategori Temuan</label>
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
            <div class="col">
              <label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label>
              <input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan" name="foto_kegiatans[]">
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
              <input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor" name="skorAuditor">
            </div>
          </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end me-4 mb-4">
          <button class="moreItems_add btn btn-primary float-end" type="button">Tambah Pertanyaan</button>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end me-4 mb-4">
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
            var plor = '<textarea class="form-control" placeholder="Tuliskan narasi PLOR (Problem, Location, Objective, Reference)" id="responAuditor" style="height: 100px" name="narasiPLOR"></textarea><label for="responAuditor">Tuliskan narasi PLOR (Problem, Location, Objective, Reference)</label>';

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

  $(document).ready(function(){
    var max_fields = 50;
    var wrapper = $("#temuanDT");
    var add_btn = $(".moreItems_add");
    var i = 1;
    $(add_btn).click(function(e){
      e.preventDefault();
      if (i < max_fields) {
        i++;
        
        $(wrapper).append('<div id="temuanDT" class="card mt-5 mb-4 mx-4 px-3"><div class="row g-3 my-4 mx-3"><div class="col"><label for="butirStandar" class="visually-hidden">Butir Standar</label><input id="butirStandar" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col"><label for="nomorButir" class="visually-hidden">Nomor Butir</label><input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir" aria-label="Masukkan Nomor Butir"></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan pertanyaan di sini" id="pertanyaan" style="height: 100px"></textarea><label for="pertanyaan">Masukkan pertanyaan disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu"></textarea><label for="indikatorMutu">Masukkan indikator mutu disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar"></textarea><label for="targetStandar">Masukkan target standar</label></div><div class="inputGrupText row justify-content-between g-3 mb-4 mx-4"><div class="col-7 border rounded me-5"><div class="row g-3 my-4 mx-3"><div class="col inputButirStandar"><label for="inputButirStandar" class="form-label">Butir Standar</label><input type="text" class="form-control" id="inputButirStandar"></div><div class="col inputReferensi"><label for="inputReferensi" class="form-label">Referensi</label><input type="text" class="form-control" id="inputReferensi"></div></div></div><div class="col-4 border rounded ms-5"><div class="row g-3 my-4 mx-3"><div class="col inputKeterangan"><label for="inputKeterangan" class="form-label">Keterangan</label><input type="text" class="form-control" id="inputKeterangan"></div></div></div></div><label for="#" class="mb-4 mx-4">Respon Auditee</label><div class="row g-3 mb-4 mx-4 border rounded"><div class="col my-4"><label for="inputDokSahih" class="form-label mx-4">Dokumen Bukti Sahih</label><div class="input-group mx-4 mb-4"><input type="file" class="form-control" id="inputDokSahih" aria-describedby="inputGroupFileAddon04" aria-label="Upload"><button class="btn btn-outline-secondary me-5" type="button" id="inputGroupFileAddon04">Unggah</button></div><div class="form-floating mb-3 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px"></textarea><label for="responAuditee">Tuliskan respon Auditee disini</label></div></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px"></textarea><label for="responAuditor">Tuliskan respon Auditor disini</label></div><div class="row g-3 mb-4 mx-3"><div class="col"><label for="kategoriTemuan" class="form-label">Kategori Temuan</label><div id="kategoriTemuan" class="border rounded ps-4 py-2"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriKTS" value="KTS" onclick="display()"><label class="form-check-label" for="kategoriKTS">KTS</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriOB" value="OB" onclick="display()"><label class="form-check-label" for="kategoriOB">OB</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriSesuai" value="Sesuai" onclick="display()"><label class="form-check-label" for="kategoriSesuai">Sesuai</label></div></div></div><div class="col"><label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label><input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan"></div></div><div id="narasiPLOR" class="form-floating mb-4 mx-4"></div><div class="row g-3 mb-4 mx-4"><div class="col border rounded px-4 py-4 me-2"><label for="inisialAuditor" class="form-label">Inisial Auditor</label><input id="inisialAuditor" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col border rounded px-4 py-4 ms-2"><label for="skorAuditor" class="form-label">Skor Auditor</label><input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor"></div></div></div>')
      }
    });
  });
</script>
    
@endpush
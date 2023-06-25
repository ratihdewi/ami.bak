@extends('layout.main') 
@section('title') AMI - Daftar Tilik @endsection

@section('container')
    {{-- Form setiap auditee --}}
    <form action="#" method="POST">
      <div id="infoDT" class="card mt-5 mb-5 mx-4 px-3">
        <div class="row g-3 my-4 mx-3">
          <div class="col">
            <label for="inputAuditee" class="visually-hidden">Auditee</label>
            @include('inc.listAuditee')
          </div>
          <div class="col">
            <label for="inputAuditor" class="visually-hidden">Auditor</label>
            <select id="inputAuditor" class="form-select">
              <option selected disabled>Pilih Auditor</option>
              @foreach ($listAuditor as $item)
                  <option>{{ $item->nama }}</option>
              @endforeach
              {{-- <option>Auditor 01</option>
              <option>Auditor 02</option>
              <option>Auditor 03</option> --}}
            </select>
          </div>
        </div>
        <div class="row g-3 mb-4 mx-3">
          <div class="col">
            <input type="date" class="form-control" placeholder="Masukkan Hari/Tanggal Pelaksanaan" aria-label="Masukkan Hari/Tanggal Pelaksanaan">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Masukkan tempat pelaksanaan" aria-label="Masukkan tempat pelaksanaan">
          </div>
        </div>
        <div class="row g-3 mb-4 mx-4">
          <label for="areaAudit" class="visually-hidden">Area Audit</label>
            <select id="areaAudit" class="form-select">
              <option selected disabled>Pilih area yang akan diaudit</option>
              <option>Pendidikan</option>
              <option>Penelitian</option>
              <option>PkM</option>
              <option>Tambahan</option>
            </select>
        </div>
        <div class="row g-3 mb-5 mx-4">
          <label for="batasWaktuAudit" class="visually-hidden">Area Audit</label>
          <input id="batasWaktuAudit" type="text" class="form-control" placeholder="Berika Batas Pengisian Respon Auditee" onfocus="(this.type='date')" onblur="(this.type='text')" aria-label="Berika Batas Pengisian Respon Auditee">
        </div>
      </div>
      {{-- Form (berbagai) pertanyaan dari setiap auiditee --}}
      <form action="#" method="POST">
        <div id="temuanDT" class="card mt-4 mb-4 mx-4 px-3">
          <div class="row g-3 my-4 mx-3">
            <div class="col">
              <label for="butirStandar" class="visually-hidden">Butir Standar</label>
              <input id="butirStandar" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar">
            </div>
            <div class="col">
              <label for="nomorButir" class="visually-hidden">Nomor Butir</label>
              <input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir" aria-label="Masukkan Nomor Butir">
            </div>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan pertanyaan di sini" id="pertanyaan" style="height: 100px"></textarea>
            <label for="pertanyaan">Masukkan pertanyaan disini</label>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu"></textarea>
            <label for="indikatorMutu">Masukkan indikator mutu disini</label>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar"></textarea>
            <label for="targetStandar">Masukkan target standar</label>
          </div>
          <div class="inputGrupText row justify-content-between g-3 mb-4 mx-4">
            <div class="col-7 border rounded me-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputButirStandar">
                  <label for="inputButirStandar" class="form-label">Butir Standar</label>
                  <input type="text" class="form-control" id="inputButirStandar">
                </div>
                <div class="col inputReferensi">
                  <label for="inputReferensi" class="form-label">Referensi</label>
                  <input type="text" class="form-control" id="inputReferensi">
                </div>
              </div>
            </div>
            <div class="col-4 border rounded ms-5">
              <div class="row g-3 my-4 mx-3">
                <div class="col inputKeterangan">
                  <label for="inputKeterangan" class="form-label">Keterangan</label>
                  <input type="text" class="form-control" id="inputKeterangan">
                </div>
              </div>
            </div>
          </div>
          <label for="#" class="mb-4 mx-4">Respon Auditee</label>
          <div class="row g-3 mb-4 mx-4 border rounded">
            <div class="col my-4">
              <label for="inputDokSahih" class="form-label mx-4">Dokumen Bukti Sahih</label>
              <div class="input-group mx-4 mb-4">
                <input type="file" class="form-control" id="inputDokSahih" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button class="btn btn-outline-secondary me-5" type="button" id="inputGroupFileAddon04">Unggah</button>
              </div>
              <div class="form-floating mb-3 mx-4">
                <textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px"></textarea>
                <label for="responAuditee">Tuliskan respon Auditee disini</label>
              </div>
            </div>
          </div>
          <div class="form-floating mb-4 mx-4">
            <textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px"></textarea>
            <label for="responAuditor">Tuliskan respon Auditor disini</label>
          </div>
          <div class="row g-3 mb-4 mx-3">
            <div class="col">
              <label for="kategoriTemuan" class="form-label">Kategori Temuan</label>
              <div id="kategoriTemuan" class="border rounded ps-4 py-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriKTS" value="KTS" onclick="display()">
                  <label class="form-check-label" for="kategoriKTS">KTS</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriOB" value="OB" onclick="display()">
                  <label class="form-check-label" for="kategoriOB">OB</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriSesuai" value="Sesuai" onclick="display()">
                  <label class="form-check-label" for="kategoriSesuai">Sesuai</label>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label>
              <input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan">
            </div>
          </div>
          <div id="narasiPLOR" class="form-floating mb-4 mx-4"></div>
          <div class="row g-3 mb-4 mx-4">
            <div class="col border rounded px-4 py-4 me-2">
              <label for="inisialAuditor" class="form-label">Inisial Auditor</label>
              <input id="inisialAuditor" type="text" class="form-control" placeholder="Butir Standar" aria-label="Masukkan Inisial Auditor">
            </div>
            <div class="col border rounded px-4 py-4 ms-2">
              <label for="skorAuditor" class="form-label">Skor Auditor</label>
              <input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor">
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
    </form>
    
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
        function display() {
            var plor = '<textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px"></textarea><label for="responAuditor">Tuliskan narasi PLOR (Problem, Location, Objective, Reference)</label>';

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
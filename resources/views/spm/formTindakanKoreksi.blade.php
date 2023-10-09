@extends('layout.main') 

@section('title') AMI - Tindakan Koreksi @endsection

@section('linking')
    <a href="/tindakankoreksi" class="mx-1">
        Tindakan Koreksi
    </a>/

    <a href="/tindakankoreksi-temuan/{{ $pertanyaans->auditee_id }}/{{ $pertanyaans->auditee->tahunperiode}}" class="mx-1">
        Temuan
    </a>/

    <a href="/tindakankoreksi-formtemuan/{{ $pertanyaans->id }}/{{ $noPTK }}" class="mx-1">
      Form
    </a>/
    
@endsection

@section('container')
    <div class="container px-5">
      <form action="/tindakankoreksi-store/{{ $noPTK }}" class="form-tindakankoreksiTemuan mx-4 my-5" method="POST">
        @csrf
        <div class="headerInfo mb-5">
          <div class="row">
            <div class="col-2 border border-secondary border-opacity-75 fw-bolder py-2">PTK No.</div>
            <div class="col-4 border border-secondary border-opacity-75 py-2">{{ $noPTK }}</div>
            <div class="col-2 border border-secondary border-opacity-75 fw-bolder py-2">Kategori Temuan</div>
            <div class="col-4 border border-secondary border-opacity-75 py-2">
              <div class="form-check form-check-inline mx-3">
                <input class="form-check-input" type="checkbox" id="KTS" 
                  @if ($pertanyaans->Kategori == "KTS")
                      {{ "checked" }}
                  @endif
                disabled>
                <label class="form-check-label" for="KTS">KTS</label>
              </div>
              <div class="form-check form-check-inline mx-3">
                <input class="form-check-input" type="checkbox" id="OB" 
                @if ($pertanyaans->Kategori == "OB")
                    {{ "checked" }}
                @endif
                disabled>
                <label class="form-check-label" for="OB">OB</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-2 border border-secondary border-opacity-75 fw-bolder py-2">Unit Kerja</div>
            <div class="col-10 border border-secondary border-opacity-75 py-2">{{ $pertanyaans->auditee->unit_kerja }}</div>
          </div>
          <div class="row">
            <div class="col-2 border border-secondary border-opacity-75 fw-bolder py-2">Ketua Unit Kerja</div>
            <div class="col-10 border border-secondary border-opacity-75 py-2">{{ $pertanyaans->auditee->ketua_auditee }}</div>
          </div>
        </div>
        <div class="auditorSection mb-5">
          <div class="row">
            <div class="col-3 border border-secondary border-opacity-75 fw-bolder py-2">Referensi (Butir Mutu)</div>
            <div class="col-9 border border-secondary border-opacity-75 py-2">{{ $pertanyaans->nomorButir }}</div>
          </div>
          <div class="row">
            <div class="col-12 border border-secondary border-opacity-75 fw-bolder py-2">Deskripsi/Uraian Temuan</div>
          </div>
          <div class="row">
            <div class="col-12 border border-secondary border-opacity-75 py-2">{{ $pertanyaans->narasiPLOR }}</div>
          </div>
          <div class="row justify-content-between border border-secondary border-opacity-75">
            <div class="col-6 fw-bolder py-2">
              Akar Penyebab
            </div>
            <div class="col-2 py-2 me-0 text-end">
              <button type="button" id="deadlineTTDAuditor" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#formBatasAksesAuditor">Deadline</button>
            </div>
          </div>
          <div class="row" hidden>
            <div class="col-12 border border-secondary border-opacity-75 py-2">
              <textarea class="form-control border border-0" id="noPTK" name="noPTK" placeholder="Nomor PTK" rows="3" value="{{ $noPTK }}">{{ $noPTK }}</textarea>
            </div>
          </div>
          <div class="row" hidden>
            <div class="col-12 border border-secondary border-opacity-75 py-2">
              <textarea class="form-control border border-0" id="pertanyaan_id" name="pertanyaan_id" placeholder="ID Pertanyaan" rows="3" value="{{ $pertanyaans->id }}">{{ $pertanyaans->id }}</textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-12 border border-secondary border-opacity-75 py-2">
              <textarea class="form-control border border-0" id="akarPenyebab" name="akarPenyebab" placeholder="Tuliskan akar penyebab (diisi oleh Auditor)" rows="3">{{ $pertanyaans->akarPenyebab }}</textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-4 border border-secondary border-opacity-75 fw-bolder py-2 text-center">Nama Auditor</div>
            <div class="col-4 border border-secondary border-opacity-75 fw-bolder py-2 text-center">Tanda Tangan</div>
            <div class="col-4 border border-secondary border-opacity-75 fw-bolder py-2 text-center">Tanggal</div>
          </div>
          <div class="row">
            <div class="col-4 border border-secondary border-opacity-75 py-2">
              <input class="form-control border border-0" type="text">
            </div>
            <div class="col-4 border border-secondary border-opacity-75 py-2">
              <div class="d-grid col-2 mx-auto py-3">
                <button class="btn btn-success approvalAuditor" type="button">Approve</button>
              </div>
            </div>
            <div class="col-4 border border-secondary border-opacity-75 py-2">
              <div class="d-grid col-5 mx-auto py-3">
                <input class="form-control" type="date">
              </div>
            </div>
          </div>
        </div>
        <div class="auditeeSection mb-5">
          <div class="row justify-content-between border border-secondary border-opacity-75">
            <div class="col-6 fw-bolder py-2">
              Rencana Tindakan Perbaikan dan Jadwal Penyelesaian
            </div>
            <div class="col-2 py-2 me-0 text-end">
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#formBatasAkses">Batasi akses</button>
            </div>
          </div>
          <div class="row">
            <div class="col-12 border border-secondary border-opacity-75 py-2">
              <textarea class="form-control border border-0" id="akarPenyebab" placeholder="Tuliskan rencana tindakan (diisi oleh Auditor)" rows="3"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-4 border border-secondary border-opacity-75 fw-bolder py-2 text-center">Nama Auditee</div>
            <div class="col-4 border border-secondary border-opacity-75 fw-bolder py-2 text-center">Tanda Tangan</div>
            <div class="col-4 border border-secondary border-opacity-75 fw-bolder py-2 text-center">Tanggal</div>
          </div>
          <div class="row">
            <div class="col-4 border border-secondary border-opacity-75 py-2">
              <input class="form-control border border-0" type="text">
            </div>
            <div class="col-4 border border-secondary border-opacity-75 py-2">
              <div class="d-grid col-2 mx-auto py-3">
                <button class="btn btn-success approvalAuditee" type="button">Approve</button>
              </div>
            </div>
            <div class="col-4 border border-secondary border-opacity-75 py-2">
              <div class="d-grid col-5 mx-auto py-3">
                <input class="form-control" type="date">
              </div>
            </div>
          </div>
        </div>
        <div class="auditorSection2 mb-5"></div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-primary me-md-2" id="btn-tinjau" type="button" onclick="tinjauEfektivitas()">Tinjau Efektivitas</button>
          <button class="btn btn-success simpanTK" type="submit">Simpan</button>
        </div>
      </form>
      <div class="modal" id="formBatasAksesAuditor">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="/update-batasan-akses-auditor/{{ $noPTK }}">
              @csrf
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Batas Akses Pengisian Tanda Tangan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="mb-3">
                  <label for="namaPengisi" class="col-form-label">Auditor</label><br>
                  <select name="penandatangan" id="namaPengisi" class="p-2 rounded">
                    <option selected disabled>Pilih Auditor</option>
                    <option value="{{ $pertanyaans->auditee->ketua_auditor }}" selected>{{ $pertanyaans->auditee->ketua_auditor }}</option>
                    <option value="{{ $pertanyaans->auditee->anggota_auditor }}">{{ $pertanyaans->auditee->anggota_auditor }}</option>
                    @if ($pertanyaans->auditee->anggota_auditor2 != null)
                      <option value="{{ $pertanyaans->auditee->anggota_auditor2 }}">{{ $pertanyaans->auditee->anggota_auditor2 }}</option>
                    @endif
                  </select>
                  {{-- <input type="text" class="form-control" id="namaPengisi" name="auditor" placeholder="Nama Auditor atau Auditee"> --}}
                </div>
                <div class="mb-3">
                  <label for="tglMulaiPengisian" class="col-form-label">Tanggal mulai persetujuan</label>
                  <input type="text" class="form-control" id="tglMulaiPengisian" name="tgl_mulaipenandatangan" placeholder="Masukkan tanggal mulai persetujuan tindakan koreksi" value="{{ $pertanyaans->daftartilik->tgl_pelaksanaan->translatedFormat('Y-m-d') }}">
                </div>
                <div class="mb-3">
                  <label for="tglBerakhirPengisian" class="col-form-label">Tanggal berakhir persetujuan</label>
                  <input type="text" class="form-control" id="tglBerakhirPengisian" name="batas_penandatanganan" placeholder="Masukkan tanggal berakhir persetujuan tindakan koreksi" value="{{ $pertanyaans->daftartilik->tgl_pelaksanaan->addDays(14)->translatedFormat('Y-m-d') }}">
                </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
      $("#btn-tinjau").click(function(){
        $(".auditorSection2").html('<div class="row justify-content-between border border-secondary border-opacity-75"><div class="col-6 fw-bolder py-2">Tinjau Efektivitas Tindakan Koreksi</div><div class="col-4 py-2 me-0 text-end"><input type="number" step="0.1" min="0.0" max="1.0" placeholder="% selesai" class="btn btn-sm w-25 border border-secondary me-2"><select name="statustinjauan" id="statustinjauan" class="btn btn-sm border border-secondary me-2 fw-semibold"><option selected disabled>Pilih status</option><option value="Selesai">Selesai</option><option value="Tidak Selesai">Tidak Selesai</option></select><a href="#"><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#formBatasAkses">Batasi akses</button></a></div></div><div class="row"><div class="col-12 border border-secondary border-opacity-75 py-2"><textarea class="form-control border border-0" id="inputTinjauan" placeholder="Tuliskan hasil tinjauan rencana tindakan koreksi (diisi oleh Auditor)" rows="3"></textarea></div></div><div class="row"><div class="col-4 border border-secondary border-opacity-75 fw-bolder py-2 text-center">Nama Auditor</div><div class="col-4 border border-secondary border-opacity-75 fw-bolder py-2 text-center">Tanda Tangan</div><div class="col-4 border border-secondary border-opacity-75 fw-bolder py-2 text-center">Tanggal</div></div><div class="row"><div class="col-4 border border-secondary border-opacity-75 py-2"><input class="form-control border border-0" type="text" id="namaPeninjau"></div><div class="col-4 border border-secondary border-opacity-75 py-2"><div class="d-grid col-2 mx-auto py-3"><button class="btn btn-success approvalAuditor2" type="button">Approve</button></div></div><div class="col-4 border border-secondary border-opacity-75 py-2"><div class="d-grid col-5 mx-auto py-3"><input class="form-control" type="date"></div></div></div>').toggle();
      });

      // $('#formBatasAksesAuditor').on('shown.bs.modal', function () {
      //   // $('#namaPengisi').select2();
      //   console.log($('#namaPengisi').length);
      // });

      $(document).ready(function() {
        $('#namaPengisi').select2({
          dropdownParent: $('#formBatasAksesAuditor')
        });

        flatpickr("#tglMulaiPengisian", {
            locale: "id",
            dateFormat: "d-m-Y",
            enableTime: false,
            time_24hr: true,
            timeZone: "Asia/Jakarta",
            // }
        });

        flatpickr("#tglBerakhirPengisian", {
            locale: "id",
            dateFormat: "d-m-Y",
            enableTime: false,
            time_24hr: true,
            timeZone: "Asia/Jakarta",
            // }
        });
      });
    </script>
    {{-- <script>
      $(document).ready(function() {
        $('#namaPengisi').select2();
      });
    </script> --}}
    
@endpush
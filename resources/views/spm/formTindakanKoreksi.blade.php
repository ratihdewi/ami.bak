@extends('layout.main') 

@section('title') AMI - Temuan Berita Acara @endsection

@section('container')
    <div class="container px-5">
      <form action="" class="form-tindakankoreksiTemuan mx-4 my-5">
        <div class="headerInfo mb-5">
          <div class="row">
            <div class="col-2 border border-secondary border-opacity-75 fw-bolder py-2">PTK No.</div>
            <div class="col-4 border border-secondary border-opacity-75 py-2"></div>
            <div class="col-2 border border-secondary border-opacity-75 fw-bolder py-2">Kategori Temuan</div>
            <div class="col-4 border border-secondary border-opacity-75 py-2">
              <div class="form-check form-check-inline mx-3">
                <input class="form-check-input" type="checkbox" id="KTS" value="KTS" disabled>
                <label class="form-check-label" for="KTS">KTS</label>
              </div>
              <div class="form-check form-check-inline mx-3">
                <input class="form-check-input" type="checkbox" id="OB" value="OB" checked disabled>
                <label class="form-check-label" for="OB">OB</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-2 border border-secondary border-opacity-75 fw-bolder py-2">Unit Kerja</div>
            <div class="col-10 border border-secondary border-opacity-75 py-2"></div>
          </div>
          <div class="row">
            <div class="col-2 border border-secondary border-opacity-75 fw-bolder py-2">Ketua Unit Kerja</div>
            <div class="col-10 border border-secondary border-opacity-75 py-2"></div>
          </div>
        </div>
        <div class="auditorSection mb-5">
          <div class="row">
            <div class="col-3 border border-secondary border-opacity-75 fw-bolder py-2">Referensi (Butir Mutu)</div>
            <div class="col-9 border border-secondary border-opacity-75 py-2"></div>
          </div>
          <div class="row">
            <div class="col-12 border border-secondary border-opacity-75 fw-bolder py-2">Deskripsi/Uraian Temuan</div>
          </div>
          <div class="row">
            <div class="col-12 border border-secondary border-opacity-75 py-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi nulla fuga harum excepturi ipsam cumque rerum id velit suscipit culpa illo, minima quas amet asperiores laboriosam et perspiciatis temporibus doloribus?</div>
          </div>
          <div class="row">
            <div class="col-12 border border-secondary border-opacity-75 fw-bolder py-2">
              Akar Penyebab
            </div>
          </div>
          <div class="row">
            <div class="col-12 border border-secondary border-opacity-75 py-2">
              <textarea class="form-control border border-0" id="akarPenyebab" placeholder="Tuliskan akar penyebab (diisi oleh Auditor)" rows="3"></textarea>
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
          <div class="row">
            <div class="col-12 border border-secondary border-opacity-75 fw-bolder py-2">
              Rencana Tindakan Perbaikan dan Jadwal Penyelesaian
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
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-primary me-md-2" type="button">Tinjau Efektivitas</button>
          <button class="btn btn-success simpanTK" type="submit">Simpan</button>
        </div>
      </form>
    </div>
@endsection
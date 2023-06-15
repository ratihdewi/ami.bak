@extends('layout.main') @section('title') AMI - Temuan Berita Acara @endsection
@section('container')
  <div class="container mb-4">
      <div class="d-flex my-4 justify-content-start">
        <a href="/BA-AMI"><button class="btn btn-primary btn-sm me-2" type="button">Kembali</button></a>
      </div>
      <div class="topSection d-flex justify-content-around mx-2 mt-4">
          @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
              {{ $message }}
          </div>
          @endif
      </div>

      {{-- Start Form BA AMI --}}
      <form action="">
        {{-- Data DOkumen AMI --}}
        <div class="row sectionName mx-0 mb-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Data Dokumen AMI</div>  
        </div>
        <div class="row inputDataBA my-4 mx-5">
          <div class="col-12 mb-4">
            <label for="inputJudul" class="form-label fw-semibold">Judul Dokumen</label>
            <input type="text" class="form-control" id="inputJudul" placeholder="Masukkan judul dokumen yang akan dibuat">
          </div>
          <div class="col-6 mb-4">
            <label for="inputKode" class="form-label fw-semibold">Kode Dokumen</label>
            <input type="text" class="form-control" id="inputKode" placeholder="Masukkan kode dokumen yang akan dibuat">
          </div>
          <div class="col-6 mb-4">
            <label for="inputInfoRevisi" class="form-label fw-semibold">Revisi Ke-</label>
            <input type="text" class="form-control" id="inputInfoRevisi" placeholder="Masukkan revisi ke berapa">
          </div>
          <div class="col-6 mb-4">
            <label for="inputTglRevisi" class="form-label fw-semibold">Tanggal Revisi</label>
            <input type="date" class="form-control" id="inputTglRevisi" placeholder="Masukkan tanggal revisi dokumen">
          </div>
          <div class="col-6 mb-4">
            <label for="inputTglBerlaku" class="form-label fw-semibold">Tanggal Berlaku</label>
            <input type="date" class="form-control" id="inputTglBerlaku" placeholder="Masukkan tanggal berlaku dokumen">
          </div>
        </div>
        
        {{-- Berita Acara AMI --}}
        <div class="row sectionName mx-0 mb-5 mt-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Berita Acara AMI</div>  
        </div>
        <div class="row inputBA my-4 mx-5">
          <div class="col-12 mb-4">
            <label for="inputUnitKerja" class="form-label fw-semibold">Unit Kerja</label>
            <input type="text" class="form-control" id="inputUnitKerja" placeholder="Masukkan unit kerja yang akan dibuat">
          </div>
          <div class="col-6 mb-4">
            <label for="inputHariTgl" class="form-label fw-semibold">Hari/Tanggal Pelaksanaan</label>
            <input type="date" class="form-control" id="inputHariTgl" placeholder="Masukkan Hari/Tanggal Pelaksanaan yang akan dibuat">
          </div>
          <div class="col-6 mb-4">
            <label for="inputWaktu" class="form-label fw-semibold">Waktu</label>
            <input type="time" class="form-control" id="inputWaktu" placeholder="Masukkan waktu pelaksanaan">
          </div>
          <div class="col-6 mb-4">
            <label for="inputThnAjaran" class="form-label fw-semibold">Tahun Ajaran</label>
            <input type="text" class="form-control" id="inputThnAjaran" placeholder="Masukkan Tahun Ajaran dokumen">
          </div>
          <div class="col-6 mb-4">
            <label for="inputMedia" class="form-label fw-semibold">Media</label>
            <input type="text" class="form-control" id="inputMedia" placeholder="Masukkan Media dokumen">
          </div>
        </div>
        
        {{-- Berita Acara AMI - Daftar Hadir --}}
        <div class="row sectionName mx-0 mb-5 mt-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Berita Acara AMI - Daftar Hadir</div>  
        </div>
        <div class="row inputAbsen my-4 mx-5">
          <div class="col-4 mb-4">
            <label for="inputPosisi" class="form-label fw-semibold">Auditor/Auditee:</label>
            <select id="inputPosisi" class="form-select">
              <option selected disabled>Pilih Auditor/Auditee</option>
              <option value="Auditor">Auditor</option>
              <option value="Auditee">Auditee</option>
            </select>
          </div>
          <div class="col-7 mb-4">
            <label for="inputAbsenNama" class="form-label fw-semibold">Nama</label>
            <input type="text" class="form-control" id="inputAbsenNama" placeholder="Masukkan nama peserta BA">
          </div>
          <div class="col-1 mb-4">
            <button class="moreItems_add btn btn-primary float-end" type="button"><i class="bi bi-plus h5" style="color: #ffff"></i></button>
          </div>
        </div> 

        {{-- Temuan Audit --}}
        <div class="row sectionName mx-0 m-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Temuan Audit</div>  
        </div>
        <div class="row card temuanAuditBA2 my-4 mx-5 px-5">
          <table class="table table-hover mt-3">
            <thead>
                <tr class="row mx-2 borderless">
                    <th class="col-1 text-center">No</th>
                    <th class="col-5 text-center">Deskripsi/Uraian Temuan</th>
                    <th class="col-2 text-center">Kategori Temuan</th>
                    <th class="col-3 text-center">Nomor Butir Mutu</th>
                    <th class="col-1 text-center">Aksi</th>
                </tr>
                <tr class="row mx-2">
                    <th class="col-1 text-center"></th>
                    <th class="col-5 text-center"></th>
                    <th class="col-1 text-center">OB</th>
                    <th class="col-1 text-center">KTS</th>
                    <th class="col-3 text-center"></th>
                    <th class="col-1 text-center"></th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <tr class="row mx-2 listTemuanBA">
                    <td class="col-1 text-center">{{ $no++ }}</td>
                    <td class="col-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, repellendus?</td>
                    <td class="col-1 text-center"><i class="bi bi-check-lg"></i></td>
                    <td class="col-1 text-center"></td>
                    <td class="col-3 text-center">XX Nomor Butir 02</td>
                    <td class="col-1 text-center mt-1">
                      <a href="#" class="mx-2"
                            ><i class="bi bi-pencil-square h5"></i
                        ></a>
                    </td>
                </tr>
                {{-- @foreach ($data as $item)
                <tr>
                    <th scope="row" class="text-center">{{ $no++ }}</th>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">{{ $item->username }}</td>
                    <td class="text-center">{{ $item->role }}</td>
                    <td>{{ $item->unit_kerja }}</td>
                    <td class="text-center">
                        <a href="tampilUser/{{ $item->id }}" class="mx-2"
                            ><i class="bi bi-pencil-square"></i
                        ></a>
                        <a href="deleteUser/{{ $item->id }}" class="mx-2"
                            ><i class="bi bi-trash"></i
                        ></a>
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
        </div>
        
        {{-- Peluang Peningkatan --}}
        <div class="row sectionName mx-0 m-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Peluang Peningkatan</div>  
        </div>
        <div class="row inputPeluangPeningkatan my-4 mx-5">
          <div class="col-12 mb-4">
            <label for="inputBidang" class="form-label fw-semibold">Aspek/Bidang</label>
            <input type="text" class="form-control" id="inputBidang" placeholder="Masukkan aspek/bidang atau nomor butir mutu">
          </div>
          <div class="col-12 form-floating mb-4">
            <textarea class="form-control" placeholder="Tuliskan hal yang menjadi kelebihan" id="inputKelebihan" style="height: 100px"></textarea>
            <label for="inputKelebihan" class="ms-3">Kelebihan</label>
          </div>
          <div class="col-12 form-floating mb-4">
            <textarea class="form-control" placeholder="Tuliskan hal yang menjadi peluang untuk peningkatan" id="inputPeluang" style="height: 100px"></textarea>
            <label for="inputPeluang" class="ms-3">Peluang untuk Peningkatan</label>
          </div>
        </div>

        {{-- Dokumen Pendukung --}}
        <div class="row sectionName mx-0 m-5">
          <div class="col border rounded-top text-center py-2 fw-semibold">Dokumen Pendukung</div>  
        </div>
        <div class="row inputDokPendukung my-4 mx-5">
          <div class="col-5 mb-4">
            <label for="inputKodeDokumen" class="form-label fw-semibold">Kode Dokumen</label>
            <input type="text" class="form-control" id="inputKodeDokumen" placeholder="Masukkan Kode Dokumen Pendukung">
          </div>
          <div class="col-7 mb-4">
            <label for="inputNamaDokumen" class="form-label fw-semibold">Nama Dokumen</label>
            <input type="text" class="form-control" id="inputNamaDokumen" placeholder="Masukkan Nama Dokumen Pendukung">
          </div>
        </div>

        {{-- Simpan Perubahan --}}
        <div class="simpanBA d-grid gap-2">
          <button class="btn btn-success" type="submit">Simpan Perubahan</button>
        </div>
      </form>
  </div>
@endsection

@push('script')
  <script>
    $(document).ready(function(){
      var max_fields = 50;
      var wrapper = $(".inputAbsen");
      var add_btn = $(".moreItems_add");
      var i = 1;
      $(add_btn).click(function(e){
        e.preventDefault();
        if (i < max_fields) {
          i++;

          $(wrapper).append('<div class="row inputAbsen my-4"><div class="col-4 mb-4 me-2"><label for="inputPosisi" class="form-label">Auditor/Auditee:</label><select id="inputPosisi" class="form-select"><option selected disabled>Pilih Auditor/Auditee</option><option value="Auditor">Auditor</option><option value="Auditee">Auditee</option></select></div><div class="col-7 mb-4"><label for="inputAbsenNama" class="form-label fw-semibold">Nama</label><input type="text" class="form-control" id="inputAbsenNama" placeholder="Masukkan nama peserta BA"></div></div>')
        }
      });
    });
  </script>
@endpush
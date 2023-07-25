@if (count(Auth::user()->auditee()->get('user_id')) != 0)
@extends('auditee.main_')
@elseif (count(Auth::user()->auditor()->get('user_id')) != 0)
@extends('auditor.main_')
@else
@extends('layout.main')
@endif

@section('title')
    AMI - Detail Auditor
@endsection

@section('container')
    <div class="container" id="detailAuditor">
      <div class="card w-75 mx-auto my-5">
        <div class="card-body my-5">
          <div class="row justify-content-center">
            <div class="col-3 label border py-2 fw-semibold text-start">Nama</div>
            <div class="col-6 border py-2 text-start">{{ Auth::user()->name }}</div>
          </div>
          <div class="row justify-content-center">
            <div class="col-3 label border py-2 fw-semibold text-start">NIP</div>
            <div class="col-6 border py-2 text-start">{{ Auth::user()->nip }}</div>
          </div>
          <div class="row justify-content-center">
            <div class="col-3 label border py-2 fw-semibold text-start">Program Studi</div>
            <div class="col-6 border py-2 text-start">{{ Auth::user()->unit_kerja }}</div>
          </div>
          <div class="row justify-content-center">
            <div class="col-3 label border py-2 fw-semibold text-start">Fakultas</div>
            <div class="col-6 border py-2 text-start"></div>
          </div>
          <div class="row justify-content-center">
            <div class="col-3 label border py-2 fw-semibold text-start">Nomor Telepon</div>
            <div class="col-6 border py-2 text-start"></div>
          </div>
          <div class="row justify-content-center">
            <div class="col-3 label border py-2 fw-semibold text-start">Surat Keputusan</div>
            <div class="col-6 border py-2 text-start"><a href="/dokresmi">Lihat</a></div>
          </div>
          <div class="row justify-content-center">
            <div class="col-3 label border py-2 fw-semibold text-start"><i>eSign</i></div>
            <div class="col-6 border py-2 text-start"></div>
          </div>
        </div>
      </div>
    </div>
@endsection
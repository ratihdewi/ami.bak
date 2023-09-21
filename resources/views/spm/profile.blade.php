@extends('layout.main')

@section('title')
    AMI - Detail Auditor
@endsection

@section('linking')
    <a href="" class="mx-1">
        Profil Pengguna
    </a>/
@endsection

@section('container')
    <div class="container py-3" id="detailAuditor">
      <div class="profile-user my-5">
        <div class="title-profil text-center mb-4">
          <h3><b>Profil Pengguna</b></h3>
        </div>
        <div class="row justify-content-center">
          <div class="col-3 label border py-2 fw-semibold text-start">Nama</div>
          <div class="col-6 border py-2 text-start">{{ Auth::user()->name }}</div>
        </div>
        <div class="row justify-content-center">
          <div class="col-3 label border py-2 fw-semibold text-start">NIP</div>
          <div class="col-6 border py-2 text-start">{{ Auth::user()->nip }}</div>
        </div>
        <div class="row justify-content-center">
          <div class="col-3 label border py-2 fw-semibold text-start">Unit Kerja</div>
          <div class="col-6 border py-2 text-start">
            {{ $unitkerja1->name }} <br>
            @if (Auth::user()->unitkerja_id2 != null && Auth::user()->unitkerja_id3 != null)
                {{ $unitkerja2->name }} <br>
                {{ $unitkerja3->name }} <br>
            @elseif (Auth::user()->unitkerja_id2 != null && Auth::user()->unitkerja_id3 == null)
                {{ $unitkerja2->name }} <br>
            @elseif (Auth::user()->unitkerja_id2 == null && Auth::user()->unitkerja_id3 != null)
                {{ $unitkerja3->name }} <br>
            @endif
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-3 label border py-2 fw-semibold text-start">Fungsi</div>
          <div class="col-6 border py-2 text-start">
            {{ $unitkerja1->fakultas }} <br>
            @if (Auth::user()->unitkerja_id2 != null && Auth::user()->unitkerja_id3 != null)
                {{ $unitkerja2->fakultas }} <br>
                {{ $unitkerja3->fakultas }} <br>
            @elseif (Auth::user()->unitkerja_id2 != null && Auth::user()->unitkerja_id3 == null)
                {{ $unitkerja2->fakultas }} <br>
            @elseif (Auth::user()->unitkerja_id2 == null && Auth::user()->unitkerja_id3 != null)
                {{ $unitkerja3->fakultas }} <br>
            @endif
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-3 label border py-2 fw-semibold text-start">Nomor Telepon</div>
          <div class="col-6 border py-2 text-start">{{ Auth::user()->noTelepon }}</div>
        </div>
        <div class="row justify-content-center">
          <div class="col-3 label border py-2 fw-semibold text-start">Email</div>
          <div class="col-6 border py-2 text-start">{{ Auth::user()->email }}</div>
        </div>
        <div class="row justify-content-center">
          <div class="col-3 label border py-2 fw-semibold text-start">Status</div>
          <div class="col-6 border py-2 text-start">{{ Auth::user()->status }}</div>
        </div>
        <div class="row justify-content-center">
          <div class="col-3 label py-2 fw-semibold px-0">
            <button type="button" class="btn btn-secondary btn-sm" onclick="goBack()">Kembali</button>
          </div>
          <div class="col-6 py-2 text-start"></div>
        </div>
      </div>
    </div>
@endsection

@push('script')
  <script>
    function goBack() {
        window.history.back();
    }
  </script>
@endpush
@extends('auditor.main_')

@section('title')
    AMI - Detail Auditor
@endsection

@section('linking')
    <a href="" class="mx-1">
        Profil
    </a>/
@endsection

@section('container')
    <div class="container py-3" id="detailAuditor">
      <div class="profile-user my-5">
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
      </div>
    </div>
@endsection
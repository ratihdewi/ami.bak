@extends('auditee.main_')

@section('title') AMI - Home @endsection

@section('linking')
    <a class="mx-1" style="color: black; text-decoration: none">
        Home
    </a>

@endsection

@section('container')
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="home-landingpage d-flex justify-content-center pt-5" style="min-height: 100vh">
        <div class="card border border-0 w-75 d-flex justify-content-center pt-5">
            <img src="/asset/ami.png" class="card-img-top img-fluid mx-auto w-75" alt="ami">
            <div class="card-body py-2 text-center">
                <h3 class="card-title">Selamat Datang di <b>SRIKANDI</b>!</h3>
                <h4 class="card-text">(Sistem Informasi Akreditasi, Rekognisi, dan Audit Mutu Akademik)</h4>
                <div class="button-group pt-5">
                    @foreach ($links->where('keterangan', '0') as $link)
                    <a href="{{ $link->link }}" target="_blank" class="btn btn-outline-info pedomanApp fw-semibold mx-3 my-2">
                    @endforeach
                        Pedoman SRIKANDI
                    </a>
                    @foreach ($links->where('keterangan', '1') as $link)
                    <a href="{{ $link->link }}" target="_blank" class="btn btn-outline-primary fw-semibold mx-3 my-2">
                    @endforeach
                        Pedoman AMI
                    </a>
                    @foreach ($links->where('keterangan', '2') as $link)
                    <a href="{{ $link->link }}" target="_blank" class="btn btn-outline-danger fw-semibold mx-3 my-2">
                    @endforeach
                        Standar UPER
                    </a>
                    @foreach ($links->where('keterangan', '3') as $link)
                    <a href="https://upertamina.sharepoint.com/sites/spm_up/SitePages/AMI-2022.aspx" target="_blank" class="btn btn-outline-dark fw-semibold mx-3 my-2">
                    @endforeach
                        Laporan Terdahulu
                    </a>
                </div>
                
            </div>
        </div>
    </div>
@endsection
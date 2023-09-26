@extends('auditee.main_')

@section('title') AMI - Selamat Datang! @endsection

@section('linking')
    <a class="mx-1" style="color: black; text-decoration: none">
        Home
    </a>

@endsection

@section('container')
    <div class="home-landingpage d-flex justify-content-center pt-5" style="min-height: 100vh">
        <div class="card border border-0 w-75 d-flex justify-content-center pt-5">
            <img src="/asset/ami.png" class="card-img-top img-fluid mx-auto w-75" alt="ami">
            <div class="card-body py-2 text-center">
                <h3 class="card-title">Selamat Datang di <b>SRIKANDI</b>!</h3>
                <h4 class="card-text">(Sistem Informasi Akreditasi, Rekognisi, dan Audit)</h4>
                <div class="button-group d-flex justify-content-around pt-5">
                    <a href="#" target="_blank" class="btn btn-outline-info fw-semibold">Pedoman SRIKANDI</a>
                    @foreach ($links->where('keterangan', '1') as $link)
                    <a href="{{ $link->link }}" target="_blank" class="btn btn-outline-primary fw-semibold">
                    @endforeach
                        Pedoman AMI
                    </a>
                    @foreach ($links->where('keterangan', '2') as $link)
                    <a href="{{ $link->link }}" target="_blank" class="btn btn-outline-danger fw-semibold">
                    @endforeach
                        Standar UPer
                    </a>
                    @foreach ($links->where('keterangan', '3') as $link)
                    <a href="https://upertamina.sharepoint.com/sites/spm_up/SitePages/AMI-2022.aspx" target="_blank" class="btn btn-outline-dark fw-semibold">
                    @endforeach
                        Laporan Terdahulu
                    </a>
                </div>
                
            </div>
        </div>
    </div>
@endsection
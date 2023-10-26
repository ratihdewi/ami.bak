@extends('layout.main')

@section('title') AMI - Laporan @endsection

@section('linking')
    <a class="mx-1" style="color: black; text-decoration: none">
        Laporan
    </a>
@endsection

@section('container')
    <div class="container-fluid laporanAMI" style="min-height: 100vh">
        @include('spm.laporanAMI.laporan-navtabs')
        <div class="previewcover text-center mt-5">
            <embed src="https://lldikti6.kemdikbud.go.id/wp-content/uploads/2022/06/1-MATERI-PENGERTIAN-AMI.pdf" type="application/pdf" width="90%" height="600px">
        </div>
        <div class="button-edit px-5 mx-4 my-3">
            <a href="#" hidden><button type="button" class="btn btn-primary btn-sm float-end px-4">Edit</button></a>
        </div>
    </div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
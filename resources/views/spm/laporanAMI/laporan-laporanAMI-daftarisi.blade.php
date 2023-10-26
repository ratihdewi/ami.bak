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
        {{-- <div class="input-cover my-5 d-flex justify-content-center">
            <input class="form-control btn-sm w-25 align-center" type="file" id="formCover" accept=".jpg, .jpeg, .png" required hidden>

            <div class="labelspan-newfile border rounded">
                <label class="label-formcover btn btn-outline-primary mt-0 p-2" for="formCover">Upload Cover</label>
                <span id="file-chosen" class="p-2">No file chosen</span>
            </div>
        </div> --}}
        <div class="previewcover text-center mt-5">
            <embed src="https://lldikti6.kemdikbud.go.id/wp-content/uploads/2022/06/1-MATERI-PENGERTIAN-AMI.pdf" type="application/pdf" width="90%" height="600px">
        </div>
        <div class="button-edit px-5 mx-4 my-3">
            <a href="/laporan-spm-laporan-audit-mutu-internal-editdaftarisi"><button type="button" class="btn btn-primary btn-sm float-end px-4">Edit</button></a>
        </div>
    </div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
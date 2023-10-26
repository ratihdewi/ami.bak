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
        <div class="card-daftarisi my-5 mx-5">
            <h4 class="mb-2">Kata Pengantar</h4>
            <form action="" method="POST">
                <div class="inputKataPengantar">
                    <textarea class="w-100" placeholder="Tuliskan kata pengantar" id="kataPengantar"></textarea>
                </div>
                <div class="moreButton my-3 float-end">
                    <a href="/laporan-spm-laporan-audit-mutu-internal-katapengantar"><button type="button" class="btn btn-secondary">Batal</button></a>
                    <button type="button" class="btn btn-success">Tanda Tangan Ketua SPM</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/giukfcgxmwoga5mpve1dcvfwuwqcbliwn88cqrd4ffjc17h1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#kataPengantar',
            // toolbar: false,
            // menubar: false,
            // height: 150,
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endpush
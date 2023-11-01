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
            <h4 class="mb-2">Lampiran</h4>
            <form action="" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="kodedokumen" class="form-label fw-semibold">Kode Dokumen</label>
                            <select id="kodedokumen" class="form-select" aria-label="Default select example">
                                <option selected>Pilih kode dokumen</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="namadokumen" class="form-label fw-semibold">Nama Dokumen</label>
                            <select id="namadokumen" class="form-select" aria-label="Default select example">
                                <option selected>Pilih nama dokumen</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="moreButton my-3 float-end">
                    <a href="/laporan-spm-laporan-audit-mutu-internal-lampiran"><button type="button" class="btn btn-secondary">Batal</button></a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/giukfcgxmwoga5mpve1dcvfwuwqcbliwn88cqrd4ffjc17h1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#lingkupaudit',
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

        $('#kodedokumen').select2();
        $('#namadokumen').select2();
    </script>
@endpush
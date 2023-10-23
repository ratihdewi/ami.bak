@extends('layout.main')

@section('title') AMI - Laporan @endsection

@section('linking')
    <a class="mx-1" style="color: black; text-decoration: none">
        Laporan
    </a>
@endsection

@section('container')
    <div class="container-fluid laporanAMI" style="min-height: 100vh">
        @include('spm.laporan-navtabs')
        <div class="card-daftarisi my-5 mx-5">
            <h4>Daftar Isi</h4>
            <form action="" method="POST">
                {{-- <div class="card">
                    <div class="card-body px-5">
                        <div class="pt-4 mb-3">
                            <label for="nomorbab" class="form-label">Nomor Bab</label>
                            <input id="nomorbab" class="form-control" type="text" placeholder="Nomor Bab. Cth: I, II, III, ..." aria-label="Nomor Bab. Cth: I, II, III, ...">
                        </div>
                        <div class="mb-3">
                            <label for="namabab" class="form-label">Nama Bab/Sub Bab</label>
                            <input id="namabab" class="form-control" type="text" placeholder="Nama Bab/ Sub Bab" aria-label="Nama Bab/ Sub Bab">
                        </div>
                        <div class="mb-3">
                            <label for="nomorhalaman" class="form-label">Nomor Halaman</label>
                            <input id="nomorhalaman" class="form-control" type="number" min="1" step="1" placeholder="Nomor Halaman. Cth: 1, 2, 3, ..." aria-label="Nomor Halaman. Cth: 1, 2, 3, ...">
                        </div>
                        <div class="addMoreDaftarIsi">
                            <button type="button" id="addMoreItems" class="btn btn-sm btn-primary float-end">Tambah</button>
                        </div>
                    </div>
                </div> --}}
                <textarea name="datftarisi" id="daftarisi">
                    <h1>DAFTAR ISI</h1>
                    <h1>KATA PENGANTAR</h1>
                </textarea>
                <div class="saveDaftarIsi float-end my-3">
                    <a href="/laporan-spm-laporan-audit-mutu-internal-daftarisi"><button type="button" class="btn btn-secondary">Batal</button></a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
        selector: 'textarea#daftarisi',
        toolbar: 'toc',
        menubar: false,
        height: 600,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount',
            'toc',
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | toc |' +
        'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>
@endpush
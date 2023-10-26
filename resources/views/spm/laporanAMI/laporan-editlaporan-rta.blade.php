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
        <div class="card-rta my-5 mx-5">
            <h4 class="mb-2">Ringkasan Temuan Audit</h4>
            <div class="card text-center mb-4">
                <div class="card-header fw-semibold">
                    Temuan Audit
                </div>
                <div class="card-body">
                    <table class="table table-hover my-3" id="temuanAudit">
                        <thead>
                            <tr class="">
                                <th class="col-1 text-center">No</th>
                                <th class="col-1 text-center">KTS/OB<br>(Inisial Auditor)</th>
                                <th class="col-2 text-center">Referensi<br>(Butir Mutu)</th>
                                <th class="col-4 text-center">Temuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($pertanyaan_ as $temuanAudit)
                            <tr>
                              <td scope="row" class="col-1 text-center">{{ $no++ }}</td>
                              <td class="col-1 text-center">{{ $temuanAudit->Kategori }}<br>({{ $temuanAudit->inisialAuditor }})</td>
                              <td class="col-2 text-start">{{ $temuanAudit->referensi }}<br>({{ $temuanAudit->nomorButir }})</td>
                              <td class="col-4 text-start">{{ $temuanAudit->narasiPLOR }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card text-center mb-4">
                <div class="card-header fw-semibold">
                    Keterangan (Opsional)
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="inputPendahuluan">
                            <textarea class="w-100" placeholder="Tuliskan pendahuluan" id="lingkupaudit"></textarea>
                        </div>
                        <div class="moreButton my-3 float-end">
                            <a href="/laporan-spm-laporan-audit-mutu-internal-pendahuluan"><button type="button" class="btn btn-secondary">Batal</button></a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/giukfcgxmwoga5mpve1dcvfwuwqcbliwn88cqrd4ffjc17h1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#temuanAudit').DataTable({ });
        });
    </script>
    <script>
        tinymce.init({
            selector: 'textarea#lingkupaudit',
            height: 300,
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
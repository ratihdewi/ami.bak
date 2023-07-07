@extends('auditor.main_') @section('title') AMI - Temuan Berita Acara @endsection
@section('container')
<div class="container" style="font-size: 15px">
    <div class="container-fluid d-flex mt-4">
        <div class="input-group w-50 h-25 my-3 ms-4">
            <input
                class="form-control"
                id="myInput"
                type="text"
                style="font-size: 15px"
                placeholder="Cari berdasarkan Auditee"
            />
        </div>
        <a href="/BA-AMI"
            ><button
                type="button"
                class="btn btn-outline-warning ms-4 my-3 text-black fw-bold"
                style="font-size: 15px"
            >
                <i class="bi bi-file-earmark-text me-2"></i>BA AMI
            </button></a
        >
    </div>
    <div class="topSection d-flex justify-content-around mx-2 mt-4">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
    </div>
    <div class="temuanBA mx-4">
        <table class="table table-hover listAuditee display mb-4" id="tableTemuanBA" style="width: 100%">
            <thead>
                <tr class="text-center">
                    <th class="align-middle" rowspan="2">No</th>
                    <th class="align-middle" rowspan="2">Deskripsi/Uraian Temuan</th>
                    <th class="border border-0" colspan="2">Kategori Temuan</th>
                    <th class="align-middle" rowspan="2">Nomor Butir Mutu</th>
                    <th class="border border-0" colspan="2">eSign</th>
                    <th class="align-middle" rowspan="2">Dokumentasi</th>
                    <th class="align-middle" rowspan="2">Aksi</th>
                </tr>
                <tr class="text-center">
                    <th>OB</th>
                    <th>KTS</th>
                    <th>Auditee</th>
                    <th>Auditor</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($pertanyaan_ as $beritaacara)
        
                <tr class="listTemuanBA">
                    <td class="text-center">{{ $no++ }}</td>
                    <td>
                        {{ $beritaacara->narasiPLOR }}
                    </td>
                    <td class="text-center">
                        @if ($beritaacara->Kategori == "OB")
                            <i class="bi bi-check-lg"></i>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($beritaacara->Kategori == "KTS")
                            <i class="bi bi-check-lg"></i>
                        @endif
                    </td>
                    <td class="col-2 text-center">{{ $beritaacara->butirStandar }} <br> {{ $beritaacara->nomorButir }}</td>
                    <td  class="text-center">
                        @if ($beritaacara->approvalAuditee == 'Disetujui')
                            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('https://www.google.com/', 'QRCODE', 3, 3)}}" alt="barcode" />
                        @else
                            <a
                                href="/daftartilik-tampilpertanyaandaftartilik/{{ $beritaacara->id }}/#persetujuanAuditorAuditee"
                                class="btn btn-outline-success"
                                ><i class="bi bi-pen"></i
                            ></a>
                        @endif
                    </td>
                    <td  class="text-center">
                        @if ($beritaacara->approvalAuditor == 'Disetujui')
                            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('https://www.google.com/', 'QRCODE')}}" alt="barcode" />
                        @else
                            <a
                                href="/daftartilik-tampilpertanyaandaftartilik/{{ $beritaacara->id }}/#persetujuanAuditorAuditee"
                                class="btn btn-outline-success"
                                ><i class="bi bi-pen"></i
                            ></a>
                        @endif
                    </td>
                    <td  class="text-center">
                        <a href="/DaftarTilik-adddaftartilik"
                            ><i class="bi bi-folder-fill h3"></i
                        ></a>
                    </td>
                    <td class="text-center align-middle">
                        <a href="#" class="mx-2"
                            ><i class="bi bi-pencil-square h5"></i
                        ></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('script')

    {{-- jQuery library file --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    {{-- Datatable plugin JS library file --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        // $(document).ready(function () {
        //     $("#myInput").on("keyup", function () {
        //         var value = $(this).val().toLowerCase();
        //         $(".listTemuanBA").filter(function () {
        //             // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        //             $(this).toggle(
        //                 $(this).text().toLowerCase().indexOf(value) > -1
        //             );
        //         });
        //     });
        // });

        $(document).ready(function() {
            $('#tableTemuanBA').DataTable({ });
        });
    </script>

@endpush

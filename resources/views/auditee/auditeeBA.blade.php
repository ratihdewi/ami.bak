@extends('auditee.main_') @section('title') AMI - Temuan Berita Acara @endsection

@section('linking')
    <a href="/auditee-beritaacara" class="mx-1">
        Berita Acara
    </a>/

    @foreach ($daftartilik_->unique('auditee_id') as $daftartilik)
    <a href="/auditee-auditeeBA/{{ $daftartilik->auditee_id }}/{{ $daftartilik->auditee->tahunperiode }}" class="mx-1">
    @endforeach
    @foreach ($daftartilik_->unique('auditee_id') as $daftartilik)
    {{ $daftartilik->auditee->unit_kerja }}
    @endforeach
    </a>/
    
@endsection

@section('container')
<div class="container-fluid" style="font-size: 15px; min-height: 100vh">
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
        @foreach ($pertanyaanall as $beritaacara)
        <a href="/auditee-BA-AMI/{{ $beritaacara->auditee_id }}/{{ $beritaacara->auditee->tahunperiode }}">
        @endforeach
        {{-- @foreach ($daftartilik_->unique('auditee_id') as $daftartilik)
        <a href="/auditee-BA-AMI/{{ $daftartilik->auditee_id }}/{{ $daftartilik->auditee->tahunperiode }}">
        @endforeach --}}
            <button
                type="button"
                @if (count($pertanyaanall) == 0)
                    onclick="alertBAAMI()"
                @endif
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
        <div id="liveAlertPlaceholder"></div>
        <table class="table table-hover listAuditee display mb-4" id="tableTemuanBA" style="width: 100%">
            <thead>
                <tr class="text-center">
                    <th class="align-middle" rowspan="2">No</th>
                    <th class="align-middle" rowspan="2">Deskripsi/Uraian Temuan</th>
                    <th class="border border-0" colspan="2">Kategori Temuan</th>
                    <th class="align-middle" rowspan="2">Nomor Butir Mutu</th>
                    <th class="border border-0" colspan="3">eSign Penyetuju Audit Lapangan</th>
                    <th class="align-middle" rowspan="2">Dokumentasi</th>
                </tr>
                <tr class="text-center">
                    <th>OB</th>
                    <th>KTS</th>
                    <th>Auditee</th>
                    <th></th>
                    <th>Auditor</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; $i = 0; @endphp
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
                        @if ($beritaacara->approvalAuditee == 'Disetujui Auditee')
                            {{ $qrCodeAuditee[$i] }}
                        @else
                            <a
                                href="/auditee-daftartilik-tampilpertanyaandaftartilik/{{ $beritaacara->id }}/#persetujuanAuditorAuditee"
                                class="btn btn-outline-success"
                                ><i class="bi bi-pen"></i
                            ></a>
                        @endif
                    </td>
                    <td></td>
                    <td  class="text-center">
                        @if ($beritaacara->approvalAuditor == 'Disetujui Auditor')
                        {{ $qrCodeAuditor[$i] }}
                        @else
                            <a
                                href="/auditee-daftartilik-tampilpertanyaandaftartilik/{{ $beritaacara->id }}/#persetujuanAuditorAuditee"
                                class="btn btn-outline-success disabled"
                                ><i class="bi bi-pen"></i
                            ></a>
                        @endif
                    </td>
                    <td  class="text-center">
                        <a href="/auditee-fotokegiatanBA/{{ $beritaacara->auditee_id }}/{{ $beritaacara->auditee->tahunperiode }}"
                            ><i class="bi bi-folder-fill text-warning h3" title="Foto Kegiatan"></i
                        ></a>
                    </td>
                </tr>
                <?php $i++; ?>
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

        const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

        const alert = (message, type) => {
            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
            ].join('')

            alertPlaceholder.append(wrapper)
        }

        function alertBAAMI() {
            alert('Tidak terdapat data Audit Lapangan (AL) yang disetujui!', 'warning');
        }
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(".listTemuanBA").filter(function () {
                    // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    $(this).toggle(
                        $(this).text().toLowerCase().indexOf(value) > -1
                    );
                });
            });
        });

        $(document).ready(function() {

            $('#tableTemuanBA').DataTable({ });
        });
    </script>

@endpush

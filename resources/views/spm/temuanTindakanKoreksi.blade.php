@extends('layout.main') 

@section('title') AMI - Temuan Tindakan Koreksi @endsection

@section('linking')
    <a href="/tindakankoreksi" class="mx-1">
        Tindakan Koreksi
    </a>/

    @foreach ($auditee_->unique('unit_kerja', 'tahunperiode') as $auditee)
    @foreach ($auditee->beritaacara()->get() as $item)
    <a href="/tindakankoreksi-temuan/{{ $item->auditee_id }}/{{ $item->tahunperiode}}" class="mx-1">
    @endforeach
    @endforeach
        Temuan
    </a>/
@endsection

@section('container')
    <div class="container vh-100" style="font-size: 15px;">
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
        </div>
        <div class="topSection d-flex justify-content-around mx-2 mt-4">
            @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
            @endif
        </div>
        <div class="temuanBA mx-4 mb-3">
            <table class="table table-hover listAuditee display mb-4" id="tableTemuanBA" style="width: 100%">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle" rowspan="2">No</th>
                        <th class="align-middle" rowspan="2">Deskripsi/Uraian Temuan</th>
                        <th class="border border-0" colspan="2">Kategori Temuan</th>
                        <th class="align-middle" rowspan="2">Nomor Butir Mutu</th>
                        <th class="border border-0" colspan="3">eSign</th>
                        <th class="col-1 align-middle" rowspan="2">Aksi</th>
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
                    @php $no = 0; $i = 0; @endphp
                    @foreach ($pertanyaan_ as $beritaacara)
                    <tr class="listTemuanBA">
                        <?php $no += 1; ?>
                        <td class="text-center">{{ $no }}</td>
                        <td>
                            <a href="/tindakankoreksi-formtemuan" style="text-decoration: none; color:black">{{ $beritaacara->narasiPLOR }}</a>
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
                                    href="/daftartilik-tampilpertanyaandaftartilik/{{ $beritaacara->id }}/#persetujuanAuditorAuditee"
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
                                    href="/daftartilik-tampilpertanyaandaftartilik/{{ $beritaacara->id }}/#persetujuanAuditorAuditee"
                                    class="btn btn-outline-success"
                                    ><i class="bi bi-pen"></i
                                ></a>
                            @endif
                        </td>
                        <td  class="col-1 text-center">
                            <a href="/tindakankoreksi-formtemuan/{{ $beritaacara->id }}/{{ $no }}" class="text-decoration-none text-black" ><button class="border-0 rounded bg-warning"><i class="bi bi-eye-fill"></i></button></a>
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

<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableTemuanBA').DataTable({ });
        });
    </script>

<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".listTemuanBA").filter(function() {
        // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
    
@endpush

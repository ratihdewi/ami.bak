@extends('auditee.main_') @section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/auditee-daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    @foreach ($periodes as $auditee)
    <a href="/auditee-daftartilik/{{ $auditee->tahunperiode2 }}" class="mx-1">
    @endforeach    
    @foreach ($periodes as $auditee)
    {{ $auditee->tahunperiode1 }}/{{ $auditee->tahunperiode2 }}
    @endforeach  
    </a>/

@endsection

@section('container')
<div class="container-fluid pb-3 mt-5" style="min-height: 100vh">
    <div class="row mx-3">
        <table
            class="table table-hover mb-3"
            id="tableareaDT"
            style="font-size: 13px;border-bottom: none"
        >
            <thead>
                <tr class="">
                    <th class="col-1 px-0 text-center">No</th>
                    <th class="col-3 px-0 text-center">Auditee</th>
                    <th class="col-2 px-0 text-center">Area</th>
                    <th class="col-2 px-0 text-center">
                        Batas Pengisian Respon Auditee
                    </th>
                    <th class="col-3 px-0 text-center">Auditor</th>
                    <th class="col-1 px-0 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($data_ as $item)
                    @foreach ($item->daftartilik()->get() as $dt)
                    <tr class="">
                        <td class="col-1 px-0 text-center">{{ $no++ }}</td>
                        <td class="col-3 px-0">{{ $item->unit_kerja }}</td>
                        <td class="col-2 px-0 text-center">{{ $dt->area }}</td>
                        <td class="col-2 px-0">{{ $dt->bataspengisianRespon->translatedFormat('l, d M Y') }}</td>
                        @foreach ($dt->auditor()->get() as $dt_)
                            <td class="col-3 px-0">{{ $dt_->nama }}</td>
                        @endforeach
                        <td class="col-1 px-0 text-center"><a href="/auditee-daftarTilik-areadaftartilik/{{ $dt->auditee_id }}/{{ $dt->area }}"><button class="bg-warning border-0 rounded-1" title="Buka"><i class="bi bi-folder2-open text-white"></i></button></a></td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 

@push('script')
<!-- jQuery library file -->
<script
    type="text/javascript"
    src="https://code.jquery.com/jquery-3.5.1.js"
></script>

<!-- Datatable plugin JS library file -->
<script
    type="text/javascript"
    src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"
></script>
<script>
    $(document).ready(function () {
        $("#tableareaDT").DataTable({});
    });
</script>
@endpush

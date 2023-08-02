@extends('auditee.main_') @section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/auditee-daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    @foreach ($data_->unique('tahunperiode') as $auditee)
    <a href="/daftartilik/{{ $auditee->tahunperiode }}" class="mx-1">
    @endforeach    
    @foreach ($data_->unique('tahunperiode') as $auditee)
    {{ $auditee->tahunperiode }}
    @endforeach  
    </a>/

@endsection

@section('container')
<div class="container pb-3 mt-5">
    <div class="tableAreaDaftarTilik mx-3">
        <table
            class="table table-hover mb-3"
            id="tableAreaDaftarTilik"
            style="font-size: 13px;border-bottom: none"
        >
            <thead>
                <tr class="row header_areadaftartilik mt-3">
                    <th class="col-1 px-0 text-center">No</th>
                    <th class="col-3 px-0 text-center">Auditee</th>
                    <th class="col-2 px-0 text-center">Area</th>
                    <th class="col-2 px-3 text-center">
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
                    <tr class="row">
                        <td class="col-1 px-0 text-center">{{ $no++ }}</td>
                        <td class="col-3 px-0 text-center">{{ $item->unit_kerja }}</td>
                        <td class="col-2 px-0 text-center">{{ $dt->area }}</td>
                        <td class="col-2 px-0 text-center">{{ $dt->bataspengisianRespon->translatedFormat('l, d M Y') }}</td>
                        @foreach ($dt->auditor()->get() as $dt_)
                            <td class="col-3 px-0 text-center">{{ $dt_->nama }}</td>
                        @endforeach
                        <td class="col-1 px-0 text-center"><a href="/auditee-daftarTilik-areadaftartilik/{{ $dt->auditee_id }}/{{ $dt->area }}"><button class="bg-warning border-0 rounded-1"><i class="bi bi-eye-fill"></i></button></a></td>
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
        $("#tableAreaDaftarTilik").DataTable({});
    });
</script>
@endpush

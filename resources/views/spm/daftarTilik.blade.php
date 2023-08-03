@extends('layout.main') @section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    @foreach ($data_->unique('tahunperiode') as $auditee)
    <a href="/daftartilik/{{ $auditee->tahunperiode }}" class="mx-1">
    @endforeach    
    @foreach ($data_->unique('tahunperiode') as $auditee)
    {{ $auditee->tahunperiode0 }}/{{ $auditee->tahunperiode }}
    @endforeach  
    </a>/

@endsection

@section('container')
<div class="container pb-3">
    <div class="container-fluid float-end my-3">
        @foreach ($data_ as $auditee)
        <a
            href="/daftarTilik-addareadaftartilik/{{ $auditee->tahunperiode }}"
            class="text-white"
            style="font-weight: 600; text-decoration: none"
        >
        @endforeach
            <button
                type="button"
                class="btn btn-primary btn-sm float-end my-2 px-3"
            >
                Tambah
            </button></a
        >
    </div>
    <div class="topSection d-flex mx-2 mt-4">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @elseif ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endif
    </div>

    <div class="tableAreaDaftarTilik mx-3">
        <table
            class="table table-hover my-3 mx-0"
            id="tableAreaDaftarTilik"
            style="font-size: 13px;border-bottom: none"
        >
            <thead>
                <tr class="row header_areadaftartilik d-flex justify-content-center mt-4">
                    <th class="col px-2 text-center">No</th>
                    <th class="col px-2 text-center">Auditee</th>
                    <th class="col px-2 text-center">Area</th>
                    <th class="col px-2 text-center">
                        Batas Pengisian Respon Auditee
                    </th>
                    <th class="col px-2 text-center">Auditor</th>
                    <th class="col px-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($data_ as $item)
                    @foreach ($item->daftartilik()->get() as $dt)
                    <tr class="row header_areadaftartilik d-flex justify-content-center">
                        <td class="col px-0 text-center">{{ $no++ }}</td>
                        <td class="col px-1">{{ $item->unit_kerja }}</td>
                        <td class="col px-2">{{ $dt->area }}</td>
                        <td class="col px-3">{{ $dt->bataspengisianRespon->translatedFormat('l, d M Y') }}</td>
                        @foreach ($dt->auditor()->get() as $dt_)
                            <td class="col px-2">{{ $dt_->nama }}</td>
                        @endforeach
                        <td class="col px-0 text-center">
                            <a href="/daftarTilik-areadaftartilik/{{ $dt->auditee_id }}/{{ $dt->area }}" class="mx-2"
                                ><button class="bg-warning border-0 rounded-1"><i class="bi bi-eye-fill"></i></button></a>
                            <a href="/daftartilik-tampildaftartilik/{{ $item->tahunperiode }}/{{ $dt->id }}" class="mx-2"
                                ><button class="bg-primary border-0 rounded-1"><i class="bi bi-pencil-square text-white"></i></button></a>
                            <a href="/daftartilik-deletedataareadaftartilik/{{ $dt->id }}" class="mx-2"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white"></i></button></a>
                        </td>
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

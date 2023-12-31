@extends('layout.main') @section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    @foreach ($periodes as $auditee)
    <a href="/daftartilik/{{ $auditee->tahunperiode2 }}" class="mx-1">
    @endforeach    
    @foreach ($periodes as $auditee)
    {{ $auditee->tahunperiode1 }}/{{ $auditee->tahunperiode2 }}
    @endforeach  
    </a>/

@endsection

@section('container')
<div class="container pb-3" style="min-height: 100vh">
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
                @if (count($data_) == 0)
                    onclick="alertaddDT()"
                @endif
                class="btn btn-primary btn-sm float-end my-2 px-3"
            >
                Tambah
            </button></a
        >
    </div>
    <div class="row topSection d-flex mx-2 mt-4">
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
    <div id="liveAlertPlaceholder"></div>
    <div class="tableAreaDaftarTilik mx-3">
        <table
            class="table table-hover my-3 mx-0"
            id="tableAreaDaftarTilik"
            style="font-size: 13px;border-bottom: none"
        >
            <thead>
                <tr class="">
                    <th class="col-1 px-2 text-center">No</th>
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
                    <tr class="">
                        <td class="col-1 px-0 text-center">{{ $no++ }}</td>
                        <td class="col px-1">{{ $item->unit_kerja }}</td>
                        <td class="col px-2">{{ $dt->area }}</td>
                        <td class="col px-3">{{ $dt->bataspengisianRespon->translatedFormat('l, d M Y') }}</td>
                        @foreach ($dt->auditor()->get() as $dt_)
                            <td class="col px-2">{{ $dt_->nama }}</td>
                        @endforeach
                        <td class="col px-0 text-center">
                            <a href="/daftarTilik-areadaftartilik/{{ $dt->auditee_id }}/{{ $dt->area }}"
                                ><button class="bg-warning border-0 rounded-1" title="Buka"><i class="bi bi-folder2-open text-white"></i></button></a>
                            <a href="/daftartilik-tampildaftartilik/{{ $item->tahunperiode }}/{{ $dt->id }}"
                                ><button class="bg-primary border-0 rounded-1" title="Edit"><i class="bi bi-pencil-square text-white"></i></button></a>
                            <a href="/daftartilik-deletedataareadaftartilik/{{ $dt->id }}"><button class="bg-danger border-0 rounded-1" title="Hapus" onclick="return confirm('Apakah Anda yakin akan menghapus area {{ $dt->area }} Auditee {{ $dt->auditee->unit_kerja }}?')"><i class="bi bi-trash text-white"></i></button></a>
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

    function alertaddDT() {
        alert('Tidak terdapat Auditee pada tahun periode ini!', 'warning');
    }
    $(document).ready(function () {
        $("#tableAreaDaftarTilik").DataTable({});
    });
</script>
@endpush

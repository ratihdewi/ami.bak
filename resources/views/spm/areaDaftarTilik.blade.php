@extends('layout.main') @section('title') AMI - Daftar Tilik @endsection
@section('container')
<div class="container">
    <div class="container-fluid float-end my-4">
        {{-- @foreach ($data_ as $item)  --}}
                <a
                    href="/daftartilik-adddaftartilik/{{ $data->auditee_id }}/{{ $data->area }}"
                    class="text-white"
                    style="font-weight: 600; text-decoration: none"
                    ><button
                        type="button"
                        class="btn btn-primary btn-sm float-end my-2 px-3"
                    >
                        Tambah
                    </button></a
                >
                <a
                    href="/daftartilik-pratinjaudaftartilik/{{ $data->auditee_id }}/{{ $data->area }}"
                    class="text-white"
                    style="font-weight: 600; text-decoration: none;"
                    ><button
                        type="button"
                        class="btn btn-sm float-end my-2 px-3 me-2 text-white"
                        style="background-color: #0061BB"
                    >
                        Pratinjau
                    </button></a
                >
        {{-- @endforeach --}}
    </div>
    <div class="topSection d-flex justify-content-around mx-2 mt-4">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
    </div>

    {{-- test muncul gambar --}}
    {{-- @foreach ($data_ as $file)
        <img src="{{ asset($file->fotoKegiatan) }}" width= '50' height='50' class="img img-responsive" />
    @endforeach --}}
    
    <div class="tableDaftarTilik mx-3">
        <table class="table table-hover mb-3" id="tableDaftarTilik" style="font-size: 13px;border-bottom: none">
            <thead>
                <tr class="row header_pertanyaandaftartilik">
                    <th class="col-1 px-3 text-center">No</th>
                    <th class="col-2 px-3 text-center">Auditee</th>
                    <th class="col-2 px-3 text-center">Area</th>
                    <th class="col-2 px-3 text-center">Butir Standar</th>
                    <th class="col-1 px-3 text-center">Nomor Butir</th>
                    <th class="col-3 px-3 text-center">Pertanyaan</th>
                    <th class="col-1 px-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($data_ as $d_pertanyaan)
                {{-- @foreach ($data as $item) --}}
                    <tr class="row">
                        <td class="col-1 px-0 text-center">{{ $no++ }}</td>
                        {{-- @foreach ($item->auditee()->get() as $dt) --}}
                            <td class="col-2 px-0 text-center">{{ $data->auditee->unit_kerja }}</td>
                            <td class="col-2 px-0 text-center">{{ $data->area }}</td>
                            
                                <td class="col-2 px-0 text-center">{{ $d_pertanyaan->butirStandar }}</td>
                                <td class="col-1 px-0 text-center">{{ $d_pertanyaan->nomorButir }}</td>
                                <td class="col-3 px-0">
                                    {{ $d_pertanyaan->pertanyaan }}
                                </td>
                                <td class="col-1 px-0 text-center">
                                    <a href="/daftartilik-tampilpertanyaandaftartilik/{{ $d_pertanyaan->id }}" class="mx-2"
                                        ><i class="bi bi-pencil-square"></i
                                    ></a>
                                    <a href="/daftartilik-deletedatapertanyaandaftartilik/{{ $d_pertanyaan->id }}" class="mx-2"><i class="bi bi-trash"></i></a>
                                </td>
                            
                        {{-- @endforeach --}}
                    </tr>
                {{-- @endforeach --}}
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('script')
    <!-- jQuery library file -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  
      <!-- Datatable plugin JS library file -->
     <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableDaftarTilik').DataTable({ });
        });
    </script>
@endpush
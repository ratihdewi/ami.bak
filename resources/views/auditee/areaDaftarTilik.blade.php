@extends('auditee.main_') @section('title') AMI - Daftar Tilik @endsection
@section('container')
<div class="container">
    <div class="container-fluid float-end my-4">
        {{-- @foreach ($data_ as $item)  --}}
                <a
                    href="/auditee-daftartilik-pratinjaudaftartilik/{{ $data->auditee_id }}/{{ $data->area }}"
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
                    <tr class="row">
                        <td class="col-1 px-0 text-center">{{ $no++ }}</td>
                        <td class="col-2 px-0 text-center">{{ $data->auditee->unit_kerja }}</td>
                        <td class="col-2 px-0 text-center">{{ $data->area }}</td>
                        
                        <td class="col-2 px-0 text-center">{{ $d_pertanyaan->butirStandar }}</td>
                        <td class="col-1 px-0 text-center">{{ $d_pertanyaan->nomorButir }}</td>
                        <td class="col-3 px-0">
                            {{ $d_pertanyaan->pertanyaan }}
                        </td>
                        <td class="col-1 px-0 text-center">
                            <a href="/auditee-daftartilik-tampilpertanyaandaftartilik/{{ $d_pertanyaan->id }}" class="mx-2"
                                ><i class="bi bi-pencil-square"></i
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
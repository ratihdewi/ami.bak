@extends('auditee.main_') @section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/auditee-daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    <a href="/auditee-daftartilik/{{ $data->auditee->tahunperiode }}" class="mx-1">
    {{ $data->auditee->tahunperiode0 }}/{{ $data->auditee->tahunperiode }}
    </a>/

    <a href="/auditee-daftarTilik-areadaftartilik/{{ $data->auditee_id }}/{{ $data->area }}" class="mx-1">
        {{ $data->area}}
    </a>/

@endsection

@section('container')
<div class="container-fluid" style="min-height: 100vh">
    <div class="topSection mx-2 mt-4">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
    </div>
    <div class="container-fluid  d-flex justify-content-between mb-4 mt-2">
        {{-- @foreach ($data_ as $item)  --}}
        <div class="ketOtherAction d-flex justify-content-between border rounded-1 p-3">
            <div class="leftSide me-3">
                <button class="btn btn-outline-success btn-sm my-1" style="font-size: 8px; pointer-events: none">
                    <i class="bi bi-circle-fill text-success" style="font-size: 8px"></i>
                    <i class="bi bi-circle text-success" style="font-size: 8px"></i>
                    <i class="bi bi-circle text-success" style="font-size: 8px"></i>
                </button>
                <span style="font-size: 15px">Respon Auditee telah diisi.</span><br>
                <button class="btn btn-outline-success btn-sm my-1" style="font-size: 8px; pointer-events: none">
                    <i class="bi bi-circle-fill text-success" style="font-size: 8px"></i>
                    <i class="bi bi-circle-fill text-success" style="font-size: 8px"></i>
                    <i class="bi bi-circle text-success" style="font-size: 8px"></i>
                </button>
                <span style="font-size: 15px">Respon Auditee dan Auditor telah diisi.</span>
            </div>
            <div class="rightSide">
                <button class="btn btn-outline-success btn-sm my-1" style="font-size: 8px; pointer-events: none">
                    <i class="bi bi-circle-fill text-success" style="font-size: 8px"></i>
                    <i class="bi bi-circle-fill text-success" style="font-size: 8px"></i>
                    <i class="bi bi-circle-fill text-warning" style="font-size: 8px"></i>
                </button>
                <span style="font-size: 15px">Persetujuan perlu dilakukan finalisasi (Auditor/Auditee).</span> <br>
                <button class="btn btn-outline-success btn-sm my-1" style="font-size: 8px; pointer-events: none">
                    <i class="bi bi-circle-fill text-success" style="font-size: 8px"></i>
                    <i class="bi bi-circle-fill text-success" style="font-size: 8px"></i>
                    <i class="bi bi-circle-fill text-success" style="font-size: 8px"></i>
                </button>
                <span style="font-size: 15px">Daftar Tilik lengkap dan telah disetujui.</span> <br>
            </div>
        </div>
        <div class="btnTambahPratinjau">
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
        </div>
        {{-- @endforeach --}}
    </div>
    
    <div class="tableDaftarTilik mx-3 mb-4">
        <table class="table table-hover mb-3" id="tableDaftarTilik" style="font-size: 13px;border-bottom: none">
            <thead>
                <tr class="">
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
                    <tr class="">
                        <td class="col-1 px-0 text-center">{{ $no++ }}</td>
                        <td class="col-2 px-0">{{ $data->auditee->unit_kerja }}</td>
                        <td class="col-2 px-0 text-center">{{ $data->area }}</td>
                        <td class="col-2 px-0">{{ $d_pertanyaan->butirStandar }}</td>
                        <td class="col-1 px-0 text-center">{{ $d_pertanyaan->nomorButir }}</td>
                        <td class="col-3 px-0">
                            {!! $d_pertanyaan->pertanyaan !!}
                        </td>
                        <td class="col-1 px-0 text-center">
                            <a href="/auditee-daftartilik-tampilpertanyaandaftartilik/{{ $d_pertanyaan->id }}" class="mx-2">
                            {{-- <a href="/auditee-daftartilik-tampilpertanyaandaftartilik/{{ $d_pertanyaan->id }}/#inputGrupOpsional" class="mx-2"> --}}
                                <button class="border-0 rounded-1 bg-primary" title="Edit"><i class="bi bi-pencil-square text-white"></i></i></button>
                            </a>
                            <button class="btn btn-outline-success btn-sm my-1" style="font-size: 12px; pointer-events: none; padding-top: 1px; padding-bottom: 1.5px"
                                @if ($d_pertanyaan->responAuditee == null || count($d_pertanyaan->doksahih()->get()) == 0)
                                    hidden
                                @endif
                            >
                                <i class="bi bi-circle-fill text-success" style="font-size: 10px"></i>
                                @if ($d_pertanyaan->responAuditor == null || $d_pertanyaan->Kategori == null || $d_pertanyaan->inisialAuditor == null)
                                    <i class="bi bi-circle text-success" style="font-size: 10px"></i>
                                @else
                                    <i class="bi bi-circle-fill text-success" style="font-size: 10px"></i>
                                @endif
                                @if ($d_pertanyaan->approvalAuditor == "Belum disetujui Auditor" && $d_pertanyaan->approvalAuditee == "Belum disetujui Auditee")
                                    <i class="bi bi-circle text-success" style="font-size: 10px"></i>
                                @elseif(($d_pertanyaan->approvalAuditor == "Menunggu persetujuan Auditee" && $d_pertanyaan->approvalAuditee == "Belum disetujui Auditee") || ($d_pertanyaan->approvalAuditor == "Menunggu persetujuan Auditee" && $d_pertanyaan->approvalAuditee == "Disetujui Auditee"))
                                    <i class="bi bi-circle-fill text-warning" style="font-size: 10px"></i>
                                @else
                                    <i class="bi bi-circle-fill text-success" style="font-size: 10px"></i>
                                @endif
                            </button>
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
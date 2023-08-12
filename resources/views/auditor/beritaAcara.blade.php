@extends('auditor.main_') @section('title') AMI - Berita Acara @endsection

@section('linking')
    <a href="/auditor-beritaacara" class="mx-1">
        Berita Acara
    </a>/
@endsection

@section('container')
<div class="container vh-100" style="font-size: 15px">
    <div class="container-fluid d-flex justify-content-between mt-4">
        <div class="input-group w-50 h-25 my-3 ms-4">
            <input class="form-control" id="myInput" type="text" style="font-size: 15px" placeholder="Cari berdasarkan Auditee">
        </div>
    </div>
    <div class="topSection d-flex justify-content-around mx-2 mt-4">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
    </div>

    <div class="tableBA mx-3">
        <table class="table table-hover listAuditee">
            <thead class="mt-5">
                <tr class="row ListAuditeeHeader">
                    <th class="col text-center">No</th>
                    <th class="col-6 text-center">Auditee</th>
                    <th class="col text-center">Tahun Pelaksanaan</th>
                    <th class="col text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($auditees->unique('unit_kerja', 'tahunperiode') as $auditee)
                {{-- @foreach ($auditee->daftartilik()->get() as $item) --}}
                <tr class="row ListAuditee">
                    <td class="col text-center">{{ $no++ }}</td>
                    <td class="col-6">{{ $auditee->unit_kerja }}</td>
                    <td class="col text-center">{{ $auditee->tahunperiode0 }}/{{ $auditee->tahunperiode }}</td>
                    <td class="col text-center">
                        <a href="/auditor-auditeeBA/{{ $auditee->id }}/{{ $auditee->tahunperiode}}" class="text-decoration-none text-black" ><button class="border-0 rounded bg-warning"><i class="bi bi-eye-fill"></i></button></a>
                    </td>
                </tr>
                {{-- @endforeach --}}
                @endforeach   
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('script')

<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".ListAuditee").filter(function() {
        // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<!-- jQuery library file -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- Datatable plugin JS library file -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#beritaacara').DataTable({ });
    });
</script>
    
@endpush

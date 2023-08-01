@extends('auditor.main_') @section('title') AMI - Berita Acara @endsection
@section('container')
<div class="container" style="font-size: 15px">
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
            <thead>
                <tr class="row ListAuditeeHeader">
                    <th class="col-1 text-center">No</th>
                    <th class="col text-center">Auditee</th>
                    <th class="col-2 text-center">Tahun Pelaksanaan</th>
                    <th class="col-1 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                {{-- {{ $auditor_ }} --}}
                @foreach ($auditor_ as $auditor)
                @foreach ($auditor->daftartilik()->get() as $item)
                    <tr class="row ListAuditee">
                        <td class="col-2 text-center">{{ $no++ }}</td>
                        <td class="col auditee">{{ $item->auditee->unit_kerja }}</td>
                        <td class="col-2 text-center">{{ $item->tahunperiode }}</td>
                        <td class="col-1 pe-3 text-center">
                            <a href="/auditor-auditeeBA/{{ $item->auditee->id }}/{{ $item->auditee->tahunperiode}}" class="text-decoration-none text-black" ><button class="border-0 rounded bg-primary"><i class="bi bi-eye-fill text-white"></i></button></a>
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

@extends('layout.main')

@section('title') AMI - Tindakan Koreksi @endsection

@section('linking')
    <a href="/tindakankoreksi" class="mx-1">
        Tindakan Koreksi
    </a>/
@endsection

@section('container')
<div class="container vh-100" style="font-size: 15px">
    <div class="topSection d-flex justify-content-around mx-2 mt-4">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
    </div>

    <div class="tableBA mx-3 mt-3 mb-4">
        <table class="table table-hover my-5 listAuditee" id="beritaacara">
            <thead class="mt-5">
                <tr class="row ListAuditeeHeader">
                    <th class="col-1 px-2 text-center">No</th>
                    <th class="col px-3 text-center">Auditee</th>
                    <th class="col-2 px-2  text-center">Periode</th>
                    <th class="col-1 px-2  text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($auditee_->unique('unit_kerja', 'tahunperiode') as $auditee)
                @foreach ($auditee->beritaacara()->get() as $item)
                <tr class="row ListAuditee">
                    <td class="col-1 text-center">{{ $no++ }}</td>
                    <td class="col auditee">{{ $item->auditee->unit_kerja }}</td>
                    <td class="col-2 px-0 text-center">{{ $item->auditee->tahunperiode0 }}/{{ $item->auditee->tahunperiode }}</td>
                    <td class="col-1 pe-3 text-center">
                        {{-- <a href="/auditeeBA/{{ $item->auditee_id }}/{{ $item->tahunperiode}}" class="text-decoration-none text-black" ><button class="border-0 rounded bg-warning"><i class="bi bi-eye-fill"></i></button></a> --}}
                        <a href="/tindakankoreksi-temuan/{{ $item->auditee_id }}/{{ $item->tahunperiode}}" class="text-decoration-none text-black" ><button class="border-0 rounded bg-warning"><i class="bi bi-eye-fill"></i></button></a>
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
    
@endpush

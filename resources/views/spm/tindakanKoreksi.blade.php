@extends('layout.main') @section('title') AMI - Tindakan Koreksi @endsection
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
                    <th class="col-7 text-center">Auditee</th>
                    <th class="col-4 text-center">Tahun Pelaksanaan</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <tr class="row ListAuditee">
                    <td class="col-1 text-center">{{ $no++ }}</td>
                    <td class="col-7 auditee"><a href="/tindakankoreksi-temuan" class="text-decoration-none text-black">Fakultas Sains dan Ilmu Komputer</a></td>
                    <td class="col-4 text-center">2023</td>
                </tr>
                <tr class="row ListAuditee">
                    <td class="col-1 text-center">{{ $no++ }}</td>
                    <td class="col-7 auditee"><a href="/tindakankoreksi-temuan" class="text-decoration-none text-black">Program Studi Ilmu Komputer</a></td>
                    <td class="col-4 text-center">2022</td>
                </tr>
                {{-- @foreach ($data as $item)
                <tr>
                    <th scope="row" class="text-center">{{ $no++ }}</th>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">{{ $item->username }}</td>
                    <td class="text-center">{{ $item->role }}</td>
                    <td>{{ $item->unit_kerja }}</td>
                    <td class="text-center">
                        <a href="tampilUser/{{ $item->id }}" class="mx-2"
                            ><i class="bi bi-pencil-square"></i
                        ></a>
                        <a href="deleteUser/{{ $item->id }}" class="mx-2"
                            ><i class="bi bi-trash"></i
                        ></a>
                    </td>
                </tr>
                @endforeach --}}
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
    
@endpush

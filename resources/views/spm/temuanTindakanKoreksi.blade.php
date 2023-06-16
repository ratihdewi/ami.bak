@extends('layout.main') @section('title') AMI - Temuan Berita Acara @endsection
@section('container')
<div class="container temuanTK">
    <div class="container-fluid d-flex mt-4">
        <div class="input-group w-50 h-25 my-3 ms-4">
            <input class="form-control" id="myInput" type="text" placeholder="Cari berdasarkan Auditee">
        </div>
    </div>
    <div class="topSection d-flex justify-content-around mx-2 mt-4">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif
    </div>
    <table class="table table-hover listAuditee">
        <thead>
            <tr class="row mx-2 borderless">
                <th class="col-1 text-center">No</th>
                <th class="col-3 text-center">Deskripsi/Uraian Temuan</th>
                <th class="col-2 text-center">Kategori Temuan</th>
                <th class="col-2 text-center">Nomor Butir Mutu</th>
                <th class="col-2 text-center">eSign</th>
                <th class="col-2 text-center">Dokumentasi</th>
            </tr>
            <tr class="row mx-2">
                <th class="col-1 text-center"></th>
                <th class="col-3 text-center"></th>
                <th class="col-1 text-center">OB</th>
                <th class="col-1 text-center">KTS</th>
                <th class="col-2 text-center"></th>
                <th class="col-1 text-center">Auditee</th>
                <th class="col-1 text-center">Auditor</th>
                <th class="col-2 text-center"></th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            <tr class="row mx-2 listTemuanBA">
                <td class="col-1 text-center">{{ $no++ }}</td>
                <td class="col-3"><a href="/tindakankoreksi-formtemuan" class="text-decoration-none text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, repellendus?</a></td>
                <td class="col-1 text-center"><i class="bi bi-check-lg"></i></td>
                <td class="col-1 text-center"></td>
                <td class="col-2 text-center">XX Nomor Butir Mutu <br> 01</td>
                <td class="col-1 text-center"><a href="/tindakankoreksi-formtemuan" class="btn btn-outline-success"><i class="bi bi-pen"></i></a></td>
                <td class="col-1 text-center"><a href="/tindakankoreksi-formtemuan" class="btn btn-outline-success"><i class="bi bi-pen"></i></a></td>
                <td class="col-2 text-center py-2"><a href="/DaftarTilik-adddaftartilik"><i class="bi bi-folder-fill h4"></i></a></td>
                {{-- <td class="col-1 text-center mt-1">
                  <a href="#" class="mx-2"
                        ><i class="bi bi-pencil-square h5"></i
                    ></a>
                </td> --}}
            </tr>
            <tr class="row mx-2 listTemuanBA">
                <td class="col-1 text-center">{{ $no++ }}</td>
                <td class="col-3"><a href="/tindakankoreksi-formtemuan" class="text-decoration-none text-black">Lorem ipsum dolor sit amet.</a></td>
                <td class="col-1 text-center"></td>
                <td class="col-1 text-center"><i class="bi bi-check-lg"></i></td>
                <td class="col-2 text-center">XX Nomor Butir Mutu <br> 02</td>
                <td class="col-1 text-center"><a href="/tindakankoreksi-formtemuan" class="btn btn-outline-success"><i class="bi bi-pen"></i></a></td>
                <td class="col-1 text-center"><a href="/tindakankoreksi-formtemuan" class="btn btn-outline-success"><i class="bi bi-pen"></i></a></td>
                <td class="col-2 text-center py-2"><a href="/DaftarTilik-adddaftartilik"><i class="bi bi-folder-fill h4"></i></a></td>
                {{-- <td class="col-1 text-center mt-1">
                  <a href="#" class="mx-2"
                        ><i class="bi bi-pencil-square h5"></i
                    ></a>
                </td> --}}
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
@endsection

@push('script')

<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".listTemuanBA").filter(function() {
        // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
    
@endpush

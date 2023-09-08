
@extends('layout.main') 

@section('title') AMI - Daftar Auditor @endsection

@section('linking')
    <a href="/daftarAuditor-periode" class="mx-1">
        Periode Auditor
    </a>/
@endsection

@section('container')
<div class="container vh-100 my-4"  style="font-size: 15px">
    <div class="row">
        @if ($message = Session::get('succes'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @elseif ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endif
        
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-sm my-3 px-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-target="#staticBackdrop">Tambah Periode</button>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Periode AMI</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                <div class=" row mb-3">
                    <div class="col">
                        <label for="recipient-name" class="col-form-label">Tahun periode awal</label>
                        <input type="number" class="form-control" id="thPeriodeAwal">
                    </div>
                    <div class="col">
                        <label for="recipient-name" class="col-form-label">Tahun periode akhir</label>
                        <input type="number" class="form-control" id="thPeriodeAkhir">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="recipient-name" class="col-form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tglMulai">
                    </div>
                    <div class="col">
                        <label for="recipient-name" class="col-form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tglAkhir">
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-end">
            <a href="/addAuditor" class="text-white" style="font-weight: 600; text-decoration: none">
                <button type="button" class="btn btn-primary btn-sm float-end my-3 px-3">
                    Tambah
                </button>
            </a>
        </div> --}}
    </div>
        
    <div class="row">
        <table class="table table-hover mt-5 mb-3" id="tableAuditor">
            <thead>
                <tr>
                    <th class="col-2 text-center">  No  </th>
                    <th class="col-8 text-center">  Tahun Periode  </th>
                    <th class="col-2 text-center">  Aksi  </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;    
                @endphp
                @foreach ($dataAuditor->unique('tahunperiode') as $item)
                    <tr>
                        <th scope="row" class=" col-2 text-center">{{ $no++ }}</th>
                        <th class="col-8">Periode {{ $item->tahunperiode0 }}/{{ $item->tahunperiode }}</th>
                        <th class="col-2 text-center"><a href="/daftarAuditor/{{ $item->tahunperiode }}" style="text-decoration-line: none; color: black"><button class="border-0 rounded bg-warning"><i class="bi bi-eye-fill"></i></button></a></th>
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
            $('#tableAuditor').DataTable({ });
        });
    </script>
@endpush
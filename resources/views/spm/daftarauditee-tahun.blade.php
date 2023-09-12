
@extends('layout.main') 

@section('title') AMI - Daftar Auditee @endsection

@section('linking')
    <a href="/daftarAuditee-periode" class="mx-1">
        Periode Auditee
    </a>/
@endsection

@section('container')
<div class="container vh-100 my-4"  style="font-size: 15px">
    <div class="row">
        {{-- <div class="d-flex justify-content-end">
            <a href="/addAuditee" class="text-white" style="font-weight: 600; text-decoration: none">
                <button type="button" class="btn btn-primary btn-sm float-end my-3 px-3">
                    Tambah
                </button>
            </a>
        </div> --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @elseif ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-sm my-3 px-3" data-bs-toggle="modal" data-bs-target="#addPeriodeModal">Tambah Periode</button>
        </div>

        <div class="modal fade" id="addPeriodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <form id="periodeForm" action="/daftarAuditee-periode-addperiode" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Periode AMI</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class=" row mb-3">
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Tahun periode awal</label>
                                <input type="number" min="2016" max="{{ $currentYear - 1 }}" class="form-control" id="thPeriodeAwal" name="tahunperiode1" required>
                            </div>
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Tahun periode akhir</label>
                                <input type="number" min="2017" max="{{ $currentYear }}" class="form-control" id="thPeriodeAkhir" name="tahunperiode2" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Tanggal Mulai</label>
                                <div class="col">
                                    <div class="input-group date" id="tglmulai">
                                        <input type="text" class="form-control" id="tglMulai" name="tgl_mulai" placeholder="{{ $currentDate }}" required>
                                        <span class="input-group-append">
                                        <span class="input-group-text bg-light d-block">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                        </span>
                                    </div>
                                </div>
                                {{-- <input type="date" class="form-control" id="tglMulai" name="tgl_mulai" required> --}}
                            </div>
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Tanggal Akhir</label>
                                <div class="col">
                                    <div class="input-group date" id="tglakhir">
                                        <input type="text" class="form-control" id="tglAkhir" name="tgl_berakhir" placeholder="{{ $currentDate }}" required>
                                        <span class="input-group-append">
                                        <span class="input-group-text bg-light d-block">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                        </span>
                                    </div>
                                </div>
                                {{-- <input type="date" class="form-control" id="tglAkhir" name="tgl_berakhir" required> --}}
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="savePeriode">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <table class="table table-hover mt-5 mb-3" id="tableAuditor">
            <thead>
                <tr>
                    <th class="col-2 text-center">  No  </th>
                    <th class="col-8 text-center">  Tahun  </th>
                    <th class="col-2 text-center">  Aksi  </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;    
                @endphp
                @foreach ($dataAuditee as $item)
                    <tr>
                        <th scope="row" class=" col-2 text-center">{{ $no++ }}</th>
                        <th class="col-8">Periode {{ $item->tahunperiode1 }}/{{ $item->tahunperiode2 }}</th>
                        <th class="col-2 text-center">
                            <a href="/daftarAuditee/{{ $item->tahunperiode2 }}" style="text-decoration-line: none; color: black"><button class="border-0 rounded bg-warning"><i class="bi bi-eye-fill"></i></button></i></a>
                            <a href="/daftarauditor-deleteperiode/{{ $item->id }}" onclick="return confirm('Apakah Anda yakin akan menghapus periode ini?')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white"></i></button></a>
                        </th>
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
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.id.min.js" integrity="sha512-5dCXH+uVhgMJkIOoV1tEejq2voWTEqqh2Q2+Caz6//+6i9dLpfyDmAzKcdbogrXjPLanlDO5pTsBDKzmaJcWFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
      <!-- Datatable plugin JS library file -->
     <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableAuditor').DataTable({ });
        });
        $('#tglmulai').datepicker({
            format: 'dd-mm-yyyy',
        });
        $('#tglakhir').datepicker({
            format: 'dd-mm-yyyy',
        });
    </script>
@endpush
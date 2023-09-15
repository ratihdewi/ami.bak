
@extends('layout.main') 

@section('title') AMI - Daftar Auditor @endsection

@section('linking')
    <a href="/daftarAuditor-periode" class="mx-1">
        Periode Auditor
    </a>/
@endsection

@section('container')
<div class="container my-4"  style="font-size: 15px; min-height: 100vh">
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
            <button type="button" class="btn btn-primary btn-sm my-3 px-3" data-bs-toggle="modal" data-bs-target="#addPeriodeModal">Tambah Periode</button>
        </div>

        <div class="modal fade" id="addPeriodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <form id="periodeForm" action="/daftarAuditor-periode-addperiode" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Periode AMI</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="liveAlertPlaceholder"></div>
                        <div class=" row mb-3">
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Tahun periode awal <span class="text-danger fw-bold">*</span></label>
                                <input type="number" min="2016" class="form-control" id="thPeriodeAwal" name="tahunperiode1" required>
                            </div>
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Tahun periode akhir <span class="text-danger fw-bold">*</span></label>
                                <input type="number" min="2017" class="form-control" id="thPeriodeAkhir" name="tahunperiode2" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Tanggal Mulai <span class="text-danger fw-bold">*</span></label>
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
                            </div>
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Tanggal Akhir <span class="text-danger fw-bold">*</span></label>
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
        {{-- <div class="d-flex justify-content-end">
            <a href="/addAuditor" class="text-white" style="font-weight: 600; text-decoration: none">
                <button type="button" class="btn btn-primary btn-sm float-end my-3 px-3">
                    Tambah
                </button>
            </a>
        </div> --}}
    </div>

    <div class="modal fade" id="editPeriodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <form id="editPeriodeForm" action="/daftarAuditee-periode-editperiode" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Periode AMI</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="liveAlertPlaceholder"></div>
                <div class="modal-body">
                    <div class=" row mb-3">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Tahun periode awal <span class="text-danger fw-bold">*</span></label>
                            <input type="number" min="2016" class="form-control" id="editthPeriodeAwal" name="tahunperiode1" required>
                        </div>
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Tahun periode akhir <span class="text-danger fw-bold">*</span></label>
                            <input type="number" min="2017" class="form-control" id="editthPeriodeAkhir" name="tahunperiode2" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Tanggal Mulai <span class="text-danger fw-bold">*</span></label>
                            <div class="col">
                                <div class="input-group date" id="edittglmulai">
                                    <input type="text" class="form-control" id="edittglMulai" name="tgl_mulai" placeholder="{{ $currentDate }}" required>
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
                            <label for="recipient-name" class="col-form-label">Tanggal Akhir <span class="text-danger fw-bold">*</span></label>
                            <div class="col">
                                <div class="input-group date" id="edittglakhir">
                                    <input type="text" class="form-control" id="edittglAkhir" name="tgl_berakhir" placeholder="{{ $currentDate }}" required>
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

    <div class="row mb-5">
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
                @foreach ($dataAuditor as $item)
                    <tr>
                        <th scope="row" class=" col-2 text-center">{{ $no++ }}</th>
                        <th class="col-8">Periode {{ $item->tahunperiode1 }}/{{ $item->tahunperiode2 }}</th>
                        <th class="col-2 text-center">
                            <button class="border-0 rounded bg-primary" data-bs-toggle="modal" data-bs-target="#editPeriodeModal" onclick="editmodal({{ $item->id }})"><i class="bi bi-pencil-square text-white"></i></button>
                            <a href="/daftarAuditor/{{ $item->tahunperiode2 }}" style="text-decoration-line: none; color: black"><button class="border-0 rounded bg-warning me-1"><i class="bi bi-eye-fill"></i></button></a>
                            {{-- <a href=""><button class="bg-primary border-0 rounded-1 me-0"><i class="bi bi-pencil-square text-white"></i></button></a> --}}
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
  
      <!-- Datatable plugin JS library file -->
     <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.id.min.js" integrity="sha512-5dCXH+uVhgMJkIOoV1tEejq2voWTEqqh2Q2+Caz6//+6i9dLpfyDmAzKcdbogrXjPLanlDO5pTsBDKzmaJcWFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableAuditor').DataTable();

            $('#thPeriodeAwal').change(function () {
                let tahunAwal = parseInt($('#thPeriodeAwal').val());
                $('#thPeriodeAkhir').val(tahunAwal + 1);
            });

            $('#thPeriodeAkhir').change(function () {
                let tahun = $(this).val();
                $('#thPeriodeAwal').val(tahun - 1);
            });

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function(){
                $('#datepicker').datepicker();
                $('#tglmulai').datepicker({
                    format: 'dd-mm-yyyy',
                });
                $('#tglakhir').datepicker({
                    format: 'dd-mm-yyyy',
                });
            });

            const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

            const alert = (message, type) => {
                const wrapper = document.createElement('div')
                wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
                ].join('')

                alertPlaceholder.append(wrapper)
            }

            function falseinput() {
                alert('Tanggal pelaksanaan tidak sesuai dengan tahun periode!', 'danger');
            }

            $('#periodeForm').on('submit', function(e) {
                var periodeawal = $('#thPeriodeAwal').val();
                var periodeakhir = $('#thPeriodeAkhir').val();

                var tanggalmulai = $('#tglMulai').val();
                var tanggalselesai = $('#tglAkhir').val();

                tanggalmulai = new Date(tanggalmulai).getFullYear();
                tanggalselesai = new Date(tanggalselesai).getFullYear();

                if ((tanggalmulai != periodeawal || tanggalmulai != periodeakhir) && (tanggalselesai != periodeawal || tanggalselesai != periodeakhir)) {
                    falseinput();
                    e.preventDefault();
                }
            });

            // $('#savePeriode').on('click', function() {

            //     var tahunperiode1 = $('#thPeriodeAwal').val();
            //     var tahunperiode2 = $('#thPeriodeAkhir').val();
            //     var tgl_mulai = $('#tglMulai').val();
            //     var tgl_berakhir = $('#tglAkhir').val();

            //     console.log(tahunperiode1);
            //     console.log(tgl_mulai);

            //     $.ajax({
            //         url:"/daftarAuditor-periode-addperiode",
            //         method:"POST",
            //         data:{
            //             tahunperiode1: tahunperiode1,
            //             tahunperiode2: tahunperiode2,
            //             tgl_mulai: tgl_mulai,
            //             tgl_berakhir: tgl_berakhir,
            //         },
            //         success:function(data)
            //         {
            //             alert("Event Created Successfully");
            //             location.reload();
            //         }
            //     })
            //     $('#addPeriodeModal').modal('hide');
            // })

            // $('#createSession').click(function() {
            //     $('#sessionModal').modal('toggle');
            // });

            // function refreshModal() {
            //     $('#thPeriodeAwal').val('');
            //     $('#thPeriodeAkhir').val('');
            //     $('#tglMulai').val('');
            //     $('#tglAkhir').val('');
            // }

            // // Ketika modal ditutup, panggil fungsi refreshModal
            // $('#addPeriodeModal').on('hidden.bs.modal', function (e) {
            //     refreshModal();
            // });
        });

        function editmodal(id) {
            
            $.ajax({
                url: "{{url('/editperiodeauditor-searchdatamodal')}}/"+ id,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    console.log(data);
                    $('#editthPeriodeAwal').val(data.tahunperiode1);
                    $('#editthPeriodeAkhir').val(data.tahunperiode2);
                    var tglMulai = data.tgl_mulai;
                    var tglAkhir = data.tgl_berakhir;

                    tglMulai = moment(tglMulai);
                    tglMulai = tglMulai.format('DD-MM-YYYY');
                    tglAkhir = moment(tglAkhir);
                    tglAkhir = tglAkhir.format('DD-MM-YYYY');
                    
                    $('#edittglMulai').val(tglMulai);
                    $('#edittglAkhir').val(tglAkhir);

                    var modified = '/daftarAuditor-periode-editperiode/'+data.id;
                    $('#editPeriodeForm').attr('action', modified);
                    
                },
                error: function() {
                    console.error('Terjadi kesalahan saat memuat data users.');
                }
            });

            $('#edittglmulai').datepicker({
                format: 'dd-mm-yyyy',
            });
            $('#edittglakhir').datepicker({
                format: 'dd-mm-yyyy',
            });
            
        }
    </script>
@endpush
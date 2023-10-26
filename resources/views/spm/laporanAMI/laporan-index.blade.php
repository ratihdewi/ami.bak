@extends('layout.main')

@section('title') AMI - Laporan @endsection

@section('linking')
    <a class="mx-1" style="color: black; text-decoration: none">
        Laporan
    </a>
@endsection

@section('container')
    <div class="container-fluid laporan my-5" style="min-height: 100vh">
        <div class="accordion" id="accordionExample">
            <?php $i = 0; ?>
            @foreach ($tahunPeriode as $tahun)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $i }}">
                        <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" aria-controls="collapse{{ $i }}">
                            Tahun Periode {{ $tahun->tahunperiode1 }}/{{ $tahun->tahunperiode2 }}
                        </button>
                    </h2>
                    <div id="collapse{{ $i }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                            <div class="thperiode-auditees">
                                @if (count($auditees->where('tahunperiode0', $tahun->tahunperiode1)) == 0)
                                    <div class="thperiode-auditee py-2 px-4 text-center" id="thperiode-auditee">
                                        Tidak ada Auditee pada tahun periode ini
                                    </div> 
                                @else
                                    @foreach ($auditees->where('tahunperiode0', $tahun->tahunperiode1) as $item)
                                        <div class="thperiode-auditee border py-2 px-4 d-flex justify-content-between" id="thperiode-auditee">
                                            {{ $item->unit_kerja }} <br>
                                            <a href="/laporan-spm-index-list">
                                                <button class="btn btn-warning px-1 py-0"><i class="bi bi-file-earmark-fill text-white h6"></i></button>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            @endforeach
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#beritaacara').DataTable({ });
        });
    </script>
@endpush
@extends('layout.main')

@section('title') AMI - Laporan @endsection

@section('linking')
    <a class="mx-1">
        Laporan
    </a>/
    <a class="mx-1" style="color: black; text-decoration: none">
        Auditee
    </a>
@endsection

@section('container')
    <div class="container-fluid laporan my-5" style="min-height: 100vh">
        <div class="container text-center">
            <div class="row">
                <div class="col my-3">
                    <div class="card mx-auto" style="max-width: 18rem;">
                        <img src="https://media-public.canva.com/MADoO88x7jI/1/screen.svg" class="card-img-top pt-3" alt="Profil Tridharma" height="150">
                        <div class="card-body">
                            <h5 class="card-title">Profil Tridharma</h5>
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <a href="#" class="btn btn-outline-primary my-4">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="card mx-auto" style="max-width: 18rem;">
                        <img src="https://media-public.canva.com/4UUsA/MAFNS24UUsA/1/tl.png" class="card-img-top pt-3 px-5" alt="Laporan AMI" height="150">
                        <div class="card-body">
                            <h5 class="card-title">Laporan AMI</h5>
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <a href="/laporan-spm-laporan-audit-mutu-internal" class="btn btn-outline-primary my-4">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="card mx-auto" style="max-width: 18rem;">
                        <img src="https://media-public.canva.com/MADouDcdeuQ/1/thumbnail_large.png" class="card-img-top pt-4 px-5" alt="Laporan Tindak Lanjut AMI" height="150">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Tindak Lanjut AMI</h5>
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <a href="#" class="btn btn-outline-primary my-4">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="card mx-auto" style="max-width: 18rem;">
                        <img src="https://media-public.canva.com/OodO4/MAEmCVOodO4/1/s.svg" class="card-img-top pt-3" alt="Dokumen Lainnya" height="150">
                        <div class="card-body">
                            <h5 class="card-title">Dokumen Lainnya</h5>
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <a href="#" class="btn btn-outline-primary my-4">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" hidden>
                <div class="col my-3">
                    <div class="card mx-auto" style="max-width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="card mx-auto" style="max-width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
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
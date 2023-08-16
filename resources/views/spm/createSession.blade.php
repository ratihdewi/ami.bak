@extends('layout.main')

@section('title') AMI - Jadwal Audit @endsection

@section('linking')
  <a href="/jadwalaudit" class="mx-1">
    Jadwal Audit
  </a>/
@endsection

@section('container')
    <div class="container vh-100 my-4 px-5">
        <form action="">
            <div class="card">
                <div class="card-body px-4 py-2">
                    <div class="row">
                        <div class="col">
                            <label for="inputSesi"></label>
                            <input id="inputSesi" type="text" class="form-control" placeholder="contoh: Sesi 1">
                        </div>
                        <div class="col">
                            <label for="waktuAwal"></label>
                            <input id="waktuAwal" type="date" class="form-control" placeholder="Contoh: Sesi 1">
                        </div>
                        <div class="col">
                            <label for="waktuAkhir"></label>
                            <input id="waktuAkhir" type="date" class="form-control" placeholder="Contoh: Sesi 1">
                        </div>
                        <div class="col-1 my-3 py-2">
                            <button id="moreItems_add" class="moreItems_add btn btn-primary float-end" type="button"><i class="bi bi-plus h5" style="color: #ffff"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                <button class="btn btn-secondary btn-sm me-md-2" type="button">Kembali</button>
                <button class="btn btn-success btn-sm" type="button">Simpan</button>
            </div>
        </form>
    </div>    
@endsection
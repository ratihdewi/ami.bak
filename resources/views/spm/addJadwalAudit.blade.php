@extends('layout.main') @section('title') AMI - Jadwal Audit @endsection

@section('linking')
  <a href="/jadwalaudit" class="mx-1">
    Jadwal Audit
  </a>/

  <a href="/jadwalaudit-tambah" class="mx-1">
    Tambah Jadwal
  </a>/
@endsection

@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <h5 class="text-center mb-3">Tambah Jadwal Audit</h5>
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form action="/insertjadwal" method="POST">
                        @csrf
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditee" class="col-sm-3 col-form-label"
                                >Auditee</label
                            >
                            <div class="col-sm-9">
                                <select id="auditee_id" class="form-select" name="addmore[0][auditee_id]" required>
                                    <option selected disabled>Pilih Auditee yang akan dijadwalkan</option>
                                    @foreach ($auditee_ as $auditee)
                                        <option value="{{ $auditee->id }}">{{ $auditee->unit_kerja }} <b class="fw-bold">({{ $auditee->tahunperiode0 }}/{{ $auditee->tahunperiode }})</b></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditor_id" class="col-sm-3 col-form-label"
                                >Auditor</label
                            >
                            <div class="col-sm-9">
                                <select id="auditor_id" class="form-select" name="addmore[0][auditor_id]" required>
                                    <option selected disabled>Pilih Auditor yang akan dijadwalkan</option>
                                    @foreach ($auditor_ as $auditor)
                                        <option value="{{ $auditor->id }}">{{ $auditor->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditor" class="col-sm-3 col-form-label"
                                >Tahun Ajaran</label
                            >
                            <div class="col-sm-4">
                                <input
                                    type="number"
                                    class="form-control"
                                    min="2016"
                                    max="2500"
                                    id="th_ajaran1"
                                    name="addmore[0][th_ajaran1]"
                                    placeholder="Tahun ajaran mulai"
                                />
                            </div>
                            <div class="col-sm-1">
                                <h3>/</h3>
                            </div>
                            <div class="col-sm-4">
                                <input
                                    type="number"
                                    class="form-control"
                                    min="2016"
                                    max="2500"
                                    id="th_ajaran2"
                                    name="addmore[0][th_ajaran2]"
                                    placeholder="Tahun ajaran selesai"
                                />
                            </div>
                        </div>
                        <div id="detailjadwal">
                            <div class="card mb-4" id="firstJadwal">
                                <div class="body-card px-5 pt-5 pb-4">
                                    <div class="row mb-4">
                                        <label
                                            for="hari_tgl"
                                            class="col-sm-3 col-form-label"
                                            >Hari/Tanggal</label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="hari_tgl"
                                                name="addmore[0][hari_tgl]"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label
                                            for="tempat"
                                            class="col-sm-3 col-form-label"
                                            >Tempat</label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="tempat"
                                                placeholder="Tempat Pelaksanaan"
                                                name="addmore[0][tempat]"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label
                                            for="waktu"
                                            class="col-sm-3 col-form-label"
                                            >Waktu</label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="time"
                                                class="form-control"
                                                id="waktu"
                                                placeholder="Tempat Pelaksanaan"
                                                name="addmore[0][waktu]"
                                            />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label
                                            for="kegiatan"
                                            class="col-sm-3 col-form-label"
                                            >Kegiatan</label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="kegiatan"
                                                placeholder="Kegiatan"
                                                name="addmore[0][kegiatan]"
                                            />
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        class="moreItems_add btn btn-primary btn-sm float-end"
                                    >
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success float-end">
                            Simpan
                        </button>
                        <a href="/jadwalaudit"><button class="btn btn-secondary float-end me-md-2" type="button">Kembali</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            var max_fields = 50;
            var wrapper = $("#detailjadwal");
            var add_btn = $(".moreItems_add");
            var i = 1;

            
            $(add_btn).click(function(e){
                var auditee_id = $('#auditee_id').val();
                // var auditor_id = $('#auditor_id').val();
                var thAjaran1 = $('#th_ajaran1').val();
                var thAjaran2 = $('#th_ajaran2').val();
                console.log(auditee_id);
                e.preventDefault();
                if (i < max_fields) {
                    i++;

                    // $(wrapper).append('<div class="card mb-4" id="otherJadwal"><div class="body-card px-5 pt-5 pb-4"><div class="row mb-4"><label for="hari_tgl"class="col-sm-3 col-form-label">Hari/Tanggal</label><div class="col-sm-9"><input type="date"class="form-control"id="hari_tgl"name="hari_tgl"required/></div></div><div class="row mb-4"><label for="tempat" class="col-sm-3 col-form-label">Tempat</label><div class="col-sm-9"><input type="text"class="form-control"id="tempat"placeholder="Tempat Pelaksanaan"name="tempat"required /></div></div><div class="row mb-4"><label for="waktu"class="col-sm-3 col-form-label">Waktu</label><div class="col-sm-9"><input type="time"class="form-control"id="waktu"placeholder="Tempat Pelaksanaan"name="waktu"/></div></div><div class="row mb-4"><label for="kegiatan"class="col-sm-3 col-form-label">Kegiatan</label><div class="col-sm-9"><input type="text"class="form-control"id="kegiatan"placeholder="Kegiatan"name="kegiatan"/></div></div><buttontype="button"class="moreItems_add btn btn-primary btn-sm float-end">Tambah</buttontype=></div></div>')
                    $(wrapper).append('<div class="card mb-4 add-new" id="otherJadwal"><div class="body-card px-5 pt-5 pb-4"><div class="row mb-3 px-5 py-3" hidden><label for="auditee_id'+i+'" class="col-sm-3 col-form-label">Auditee</label><div class="col-sm-9"><input type="text" class="form-control" id="auditee_id'+i+'" name="addmore['+i+'][auditee_id]" placeholder="Auditee"/></div></div><div class="row mb-3 py-3"><label for="auditor_id'+i+'" class="col-sm-3 col-form-label">Auditor</label><div class="col-sm-9 px-3"><select id="auditor_id'+i+'" class="form-select" name="addmore['+i+'][auditor_id]" required><option selected disabled>Pilih Auditor yang akan dijadwalkan</option>@foreach ($auditor_ as $auditor)<option value="{{ $auditor->id }}">{{ $auditor->nama }}</option>@endforeach </select></div></div><div class="row mb-3 px-5 py-3" hidden><label for="th_ajaran" class="col-sm-3 col-form-label">Tahun Ajaran</label><div class="col-sm-4"><input type="number" class="form-control" min="2016" max="2500" id="th_ajaran1'+i+'" name="addmore['+i+'][th_ajaran1]" placeholder="Tahun ajaran mulai"/></div><div class="col-sm-1"><h3>/</h3></div><div class="col-sm-4"><input type="number" class="form-control" min="2016" max="2500" id="th_ajaran2'+i+'" name="addmore['+i+'][th_ajaran2]" placeholder="Tahun ajaran selesai"/></div></div><div class="row mb-4"><label for="hari_tgl'+i+'"class="col-sm-3 col-form-label">Hari/Tanggal</label><div class="col-sm-9"><input type="date"class="form-control" id="hari_tgl'+i+'" name="addmore['+i+'][hari_tgl]" required/></div></div><div class="row mb-4"><label for="tempat'+i+'" class="col-sm-3 col-form-label">Tempat</label><div class="col-sm-9"><input type="text"class="form-control" id="tempat'+i+'" placeholder="Tempat Pelaksanaan" name="addmore['+i+'][tempat]" required /></div></div><div class="row mb-4"><label for="waktu'+i+'"class="col-sm-3 col-form-label">Waktu</label><div class="col-sm-9"><input type="time"class="form-control" id="waktu'+i+'" placeholder="Tempat Pelaksanaan" name="addmore['+i+'][waktu]"/></div></div><div class="row mb-4"><label for="kegiatan'+i+'"class="col-sm-3 col-form-label">Kegiatan</label><div class="col-sm-9"><input type="text"class="form-control" id="kegiatan'+i+'" placeholder="Kegiatan" name="addmore['+i+'][kegiatan]"/></div></div><button type="button" id="remove-tr" class="remove_tr btn btn-danger btn-sm float-end">Urungkan</button></div></div>')
                
                    $('#auditee_id'+i).val(auditee_id);
                    // $('#auditor_id'+i).val(auditor_id);
                    $('#th_ajaran1'+i).val(thAjaran1);
                    $('#th_ajaran2'+i).val(thAjaran2);

                }
            });

            $(document).on('click', '#remove-tr', function(){  
                $(this).parents('.add-new').remove();
            });
        });
    </script>
@endpush

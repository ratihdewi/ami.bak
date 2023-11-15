@extends('layout.main') @section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    <a href="/daftartilik/{{ $data->auditee->tahunperiode }}" class="mx-1">
        {{ $data->auditee->tahunperiode0 }}/{{ $data->auditee->tahunperiode }}
    </a>/

    <a href="/daftartilik-tampildaftartilik/{{ $data->auditee->tahunperiode }}/{{ $data->id }}" class="mx-1">
    Edit Area
    </a>/  

@endsection

@section('container')
{{-- Form update setiap auditee --}}
<div class="container vh-100 pt-3">
    <h5 class="text-center">Ubah Area Daftar Tilik</h5>
    <form id="myForm" action="/daftartilik-updatedataareadaftartilik/{{ $data->id }}" method="POST">
        @csrf
        <div id="infoDT" class="card mt-3 mb-4 mx-4 px-3">
            <div class="row g-3 my-4 mx-3">
                <div id="liveAlertPlaceholder"></div>
                <div class="col">
                    <label class="fw-semibold" for="auditee_id">Auditee <span class="text-danger fw-semibold">*</span></label>
                    <select
                        id="auditee_id"
                        class="form-select"
                        name="auditee_id"
                        disabled
                        required
                    >
                        <option value="{{ $data->auditee_id }}" selected>{{ $data->auditee->unit_kerja }}</option>
                    </select>
                </div>
                <div class="col">
                    <label class="fw-semibold" for="auditor">Auditor <span class="text-danger fw-semibold">*</span></label>
                    <select id="auditor" class="form-select" name="auditor_id">
                        <option selected>{{ $data->auditor->nama }}</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-4 mx-3">
                <div class="col">
                    <label class="fw-semibold" for="tgl-pelaksanaan">Tanggal Pelaksanaan <span class="text-danger fw-semibold">*</span></label>
                    <input
                        type="text"
                        id="tgl-pelaksanaan"
                        class="form-control"
                        placeholder="Masukkan Hari/Tanggal Pelaksanaan"
                        aria-label="Masukkan Hari/Tanggal Pelaksanaan"
                        name="tgl_pelaksanaan"
                        value="{{ date('d-m-Y', strtotime($data->tgl_pelaksanaan)) }}"
                    />
                </div>
                <div class="col">
                    <label class="fw-semibold" for="tempat">Tempat <span class="text-danger fw-semibold">*</span></label>
                    <input
                        type="text"
                        id="tempat"
                        class="form-control"
                        placeholder="Masukkan tempat pelaksanaan"
                        aria-label="Masukkan tempat pelaksanaan"
                        name="tempat"
                        value="{{ $data->tempat }}"
                    />
                </div>
            </div>
            <div class="row g-3 mb-4 mx-3">
                <div class="col">
                    <label class="fw-semibold" for="area">Area Audit <span class="text-danger fw-semibold">*</span></label>
                    <select id="area" class="form-select" name="area">
                        <option value="{{ $data->area }}" selected>{{ $data->area }}</option>
                        <option value="Pendidikan">Pendidikan</option>
                        <option value="Penelitian">Penelitian</option>
                        <option value="PkM">PkM</option>
                        <option value="Tambahan">Tambahan</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-5 mx-3">
                <div class="col">
                    <label class="fw-semibold" for="bataspengisianRespon">Batas Pengisian Respon <span class="text-danger fw-semibold">*</span></label>
                    <input
                        id="bataspengisianRespon"
                        type="text"
                        class="form-control"
                        placeholder="Berikan Batas Pengisian Respon Auditee"
                        aria-label="Berika Batas Pengisian Respon Auditee"
                        name="bataspengisianRespon"
                        value="{{ date('d-m-Y', strtotime($data->bataspengisianRespon)) }}"
                    />
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-end mx-4 mb-4">
            <a href="/daftartilik/{{ $data->auditee->tahunperiode }}">
                <button type="button" class="btn btn-secondary me-3 float-start">Kembali</button>
            </a>
            <button
                class="btn btn-success"
                type="submit"
                style="background: #00d215; border: 1px solid #008f0e"
            >
                Simpan
            </button>
        </div>
    </form>
</div>


@endsection 

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/id.js"></script>
<script>
    function display() {
        var plor =
            '<textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px"></textarea><label for="responAuditor">Tuliskan narasi PLOR (Problem, Location, Objective, Reference)</label>';

        if (document.getElementById("kategoriKTS").checked) {
            document.getElementById("narasiPLOR").innerHTML = plor;
        } else if (document.getElementById("kategoriOB").checked) {
            document.getElementById("narasiPLOR").innerHTML = plor;
        } else {
            document.getElementById("narasiPLOR").innerHTML = "";
        }
    }

    $(document).ready(function () {
        var max_fields = 50;
        var wrapper = $("#temuanDT");
        var add_btn = $(".moreItems_add");
        var i = 1;

        flatpickr("#tgl-pelaksanaan", {
            dateFormat: "d-m-Y",
            locale: "id",
            enableTime: false,
            timeZone: "Asia/Jakarta",
        });

        flatpickr("#bataspengisianRespon", {
            dateFormat: "d-m-Y",
            locale: "id",
            enableTime: false,
            timeZone: "Asia/Jakarta",
        });

        $(add_btn).click(function (e) {
            e.preventDefault();
            if (i < max_fields) {
                i++;

                $(wrapper).append(
                    '<div id="temuanDT" class="card mt-5 mb-4 mx-4 px-3"><div class="row g-3 my-4 mx-3"><div class="col"><label for="butirStandar">Butir Standar</label><input id="butirStandar" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col"><label for="nomorButir">Nomor Butir</label><input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir" aria-label="Masukkan Nomor Butir"></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan pertanyaan di sini" id="pertanyaan" style="height: 100px"></textarea><label for="pertanyaan">Masukkan pertanyaan disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu"></textarea><label for="indikatorMutu">Masukkan indikator mutu disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar"></textarea><label for="targetStandar">Masukkan target standar</label></div><div class="inputGrupText row justify-content-between g-3 mb-4 mx-4"><div class="col-7 border rounded me-5"><div class="row g-3 my-4 mx-3"><div class="col inputButirStandar"><label for="inputButirStandar" class="form-label">Butir Standar</label><input type="text" class="form-control" id="inputButirStandar"></div><div class="col inputReferensi"><label for="inputReferensi" class="form-label">Referensi</label><input type="text" class="form-control" id="inputReferensi"></div></div></div><div class="col-4 border rounded ms-5"><div class="row g-3 my-4 mx-3"><div class="col inputKeterangan"><label for="inputKeterangan" class="form-label">Keterangan</label><input type="text" class="form-control" id="inputKeterangan"></div></div></div></div><label for="#" class="mb-4 mx-4">Respon Auditee</label><div class="row g-3 mb-4 mx-4 border rounded"><div class="col my-4"><label for="inputDokSahih" class="form-label mx-4">Dokumen Bukti Sahih</label><div class="input-group mx-4 mb-4"><input type="file" class="form-control" id="inputDokSahih" aria-describedby="inputGroupFileAddon04" aria-label="Upload"><button class="btn btn-outline-secondary me-5" type="button" id="inputGroupFileAddon04">Unggah</button></div><div class="form-floating mb-3 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px"></textarea><label for="responAuditee">Tuliskan respon Auditee disini</label></div></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px"></textarea><label for="responAuditor">Tuliskan respon Auditor disini</label></div><div class="row g-3 mb-4 mx-3"><div class="col"><label for="kategoriTemuan" class="form-label">Kategori Temuan</label><div id="kategoriTemuan" class="border rounded ps-4 py-2"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriKTS" value="KTS" onclick="display()"><label class="form-check-label" for="kategoriKTS">KTS</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriOB" value="OB" onclick="display()"><label class="form-check-label" for="kategoriOB">OB</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriSesuai" value="Sesuai" onclick="display()"><label class="form-check-label" for="kategoriSesuai">Sesuai</label></div></div></div><div class="col"><label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label><input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan"></div></div><div id="narasiPLOR" class="form-floating mb-4 mx-4"></div><div class="row g-3 mb-4 mx-4"><div class="col border rounded px-4 py-4 me-2"><label for="inisialAuditor" class="form-label">Inisial Auditor</label><input id="inisialAuditor" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col border rounded px-4 py-4 ms-2"><label for="skorAuditor" class="form-label">Skor Auditor</label><input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor"></div></div></div>'
                );
            }
        });

        $('#auditee_id').select2();
        $('#area').select2();
        $('#auditor').select2();
        // $('#sasaran').select2();

        var auditee_id = $('#auditee_id').val();
        console.log(auditee_id);
        var url = "{{url('/daftartilik-searchAuditeeAuditor')}}/"+auditee_id;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: { q: '' },
            success: function(data) {
                if (Array.isArray(data)) {
                    console.log(auditee_id);
                    var mappedData = data.map(function(item) {
                        return {
                            id: item.ketua_auditor,
                            text: item.ketua_auditor,
                        };
                    });

                    data.forEach(function(item) {
                        mappedData.push({
                            id: item.anggota_auditor,
                            text: item.anggota_auditor,
                        });
                    });

                    data.forEach(function(item) {
                        mappedData.push({
                            id: item.anggota_auditor2,
                            text: item.anggota_auditor2,
                        });
                    });

                    $('#auditor').select2({
                        data: mappedData,
                    });
                } else {
                    console.error('Data yang diterima dari server bukan array yang valid.');
                }
            },
            error: function() {
                console.error('Terjadi kesalahan saat memuat data users.');
            }
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
            alert('Tanggal pelaksanaan atau batas pengisian respon tidak sesuai dengan tahun periode!', 'danger');
        }

        $('#myForm').on('submit', function(e) {
            var batasRespon = $('#bataspengisianRespon').val();
            var tglPelaksanaan = $('#tgl-pelaksanaan').val();
            var data = {!! json_encode($data->auditee) !!}

            console.log(batasRespon);
            console.log(tglPelaksanaan);

            var batasResponArray = batasRespon.split('-');
            var tglPelaksanaanArray = tglPelaksanaan.split('-');

            // Membuat format yang sesuai dengan objek Date dalam JavaScript
            var batasResponJS = batasResponArray[1] + '/' + batasResponArray[0] + '/' + batasResponArray[2];
            var tglPelaksanaanJS = tglPelaksanaanArray[1] + '/' + tglPelaksanaanArray[0] + '/' + tglPelaksanaanArray[2];

            console.log(batasResponJS);
            console.log(tglPelaksanaanJS);

            // Membuat objek Date dan mendapatkan tahun
            var thRespon = new Date(batasResponJS).getFullYear();
            var thPelaksanaan = new Date(tglPelaksanaanJS).getFullYear();
            
            console.log(thRespon);
            console.log(thPelaksanaan);

            if ((thRespon != data.tahunperiode0 && thRespon != data.tahunperiode) || (thPelaksanaan != data.tahunperiode0 && thPelaksanaan != data.tahunperiode)) {
                falseinput();
                e.preventDefault();
            }
        })
    });
</script>

@endpush

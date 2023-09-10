@extends('layout.main') @section('title') AMI - Daftar Tilik @endsection

@section('linking')
    <a href="/daftartilik-periode" class="mx-1">
        Periode Daftar Tilik
    </a>/

    <a href="/daftartilik/{{ $data->auditee->tahunperiode }}" class="mx-1">
        {{ $data->auditee->tahunperiode0 }}/{{ $data->auditee->tahunperiode }}
    </a>/

    <a href="/daftartilik-tampildaftartilik/{{ $data->auditee_id }}/{{ $data->area }}" class="mx-1">
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
                <div class="col">
                    <label class="fw-semibold" for="auditee_id">Auditee</label>
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
                    <label class="fw-semibold" for="auditor">Auditor</label>
                    <select id="auditor" class="form-select" name="auditor_id">
                        <option selected>{{ $data->auditor->nama }}</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-4 mx-3">
                <div class="col">
                    <label class="fw-semibold" for="tgl-pelaksanaan">Tanggal Pelaksanaan</label>
                    <input
                        type="text"
                        id="tgl-pelaksanaan"
                        class="form-control"
                        placeholder="Masukkan Hari/Tanggal Pelaksanaan"
                        onfocus="(this.type='date')"
                        onblur="(this.type='text')"
                        aria-label="Masukkan Hari/Tanggal Pelaksanaan"
                        name="tgl_pelaksanaan"
                        value="{{ $data->tgl_pelaksanaan->translatedFormat('Y-m-d') }}"
                    />
                </div>
                <div class="col">
                    <label class="fw-semibold" for="tempat">Tempat</label>
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
                    <label class="fw-semibold" for="area">Area Audit</label>
                    <select id="area" class="form-select" name="area">
                        <option selected disabled>{{ $data->area }}</option>
                        <option>Pendidikan</option>
                        <option>Penelitian</option>
                        <option>PkM</option>
                        <option>Tambahan</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-5 mx-3">
                <div class="col">
                    <label class="fw-semibold" for="bataspengisianRespon">Batas Pengisian Respon</label>
                    <input
                        id="bataspengisianRespon"
                        type="text"
                        class="form-control"
                        placeholder="Berikan Batas Pengisian Respon Auditee"
                        onfocus="(this.type='date')"
                        onblur="(this.type='text')"
                        aria-label="Berika Batas Pengisian Respon Auditee"
                        name="bataspengisianRespon"
                        value="{{ $data->bataspengisianRespon->translatedFormat('Y-m-d') }}"
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

        $(add_btn).click(function (e) {
            e.preventDefault();
            if (i < max_fields) {
                i++;

                $(wrapper).append(
                    '<div id="temuanDT" class="card mt-5 mb-4 mx-4 px-3"><div class="row g-3 my-4 mx-3"><div class="col"><label for="butirStandar">Butir Standar</label><input id="butirStandar" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col"><label for="nomorButir">Nomor Butir</label><input id="nomorButir" type="text" class="form-control" placeholder="Masukkan Nomor Butir" aria-label="Masukkan Nomor Butir"></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan pertanyaan di sini" id="pertanyaan" style="height: 100px"></textarea><label for="pertanyaan">Masukkan pertanyaan disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan indikator mutu" id="indikatorMutu"></textarea><label for="indikatorMutu">Masukkan indikator mutu disini</label></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Masukkan target standar" id="targetStandar"></textarea><label for="targetStandar">Masukkan target standar</label></div><div class="inputGrupText row justify-content-between g-3 mb-4 mx-4"><div class="col-7 border rounded me-5"><div class="row g-3 my-4 mx-3"><div class="col inputButirStandar"><label for="inputButirStandar" class="form-label">Butir Standar</label><input type="text" class="form-control" id="inputButirStandar"></div><div class="col inputReferensi"><label for="inputReferensi" class="form-label">Referensi</label><input type="text" class="form-control" id="inputReferensi"></div></div></div><div class="col-4 border rounded ms-5"><div class="row g-3 my-4 mx-3"><div class="col inputKeterangan"><label for="inputKeterangan" class="form-label">Keterangan</label><input type="text" class="form-control" id="inputKeterangan"></div></div></div></div><label for="#" class="mb-4 mx-4">Respon Auditee</label><div class="row g-3 mb-4 mx-4 border rounded"><div class="col my-4"><label for="inputDokSahih" class="form-label mx-4">Dokumen Bukti Sahih</label><div class="input-group mx-4 mb-4"><input type="file" class="form-control" id="inputDokSahih" aria-describedby="inputGroupFileAddon04" aria-label="Upload"><button class="btn btn-outline-secondary me-5" type="button" id="inputGroupFileAddon04">Unggah</button></div><div class="form-floating mb-3 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditee disini" id="responAuditee" style="height: 100px"></textarea><label for="responAuditee">Tuliskan respon Auditee disini</label></div></div></div><div class="form-floating mb-4 mx-4"><textarea class="form-control" placeholder="Tuliskan respon Auditor disini" id="responAuditor" style="height: 100px"></textarea><label for="responAuditor">Tuliskan respon Auditor disini</label></div><div class="row g-3 mb-4 mx-3"><div class="col"><label for="kategoriTemuan" class="form-label">Kategori Temuan</label><div id="kategoriTemuan" class="border rounded ps-4 py-2"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriKTS" value="KTS" onclick="display()"><label class="form-check-label" for="kategoriKTS">KTS</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriOB" value="OB" onclick="display()"><label class="form-check-label" for="kategoriOB">OB</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="kategoriTemuan" id="kategoriSesuai" value="Sesuai" onclick="display()"><label class="form-check-label" for="kategoriSesuai">Sesuai</label></div></div></div><div class="col"><label for="fotoKegiatan" class="form-label">Dokumentasi Foto Kegiatan</label><input id="fotoKegiatan" type="file" class="form-control py-2" placeholder="Masukkan Dokumentasi Foto Kegiatan" aria-label="Masukkan Dokumentasi Foto Kegiatan"></div></div><div id="narasiPLOR" class="form-floating mb-4 mx-4"></div><div class="row g-3 mb-4 mx-4"><div class="col border rounded px-4 py-4 me-2"><label for="inisialAuditor" class="form-label">Inisial Auditor</label><input id="inisialAuditor" type="text" class="form-control" placeholder="Butir Standar" aria-label="Butir Standar"></div><div class="col border rounded px-4 py-4 ms-2"><label for="skorAuditor" class="form-label">Skor Auditor</label><input id="skorAuditor" type="number" class="form-control" placeholder="Masukkan Skor Auditor" aria-label="Masukkan Skor Auditor"></div></div></div>'
                );
            }
        });

        var defaultView_ = $('#tgl-pelaksanaan');
        var copyDate_ = defaultView_.attr("type", "date");
        var copyText_ = defaultView_.attr("type", "text");
        var valueAwal_ = $('#tgl-pelaksanaan').val()
        var valueSementara_ = valueAwal_;
        var valueSementara2 = valueAwal_;

        var formattedDateDefault_ = moment(valueSementara_, "YYYY-MM-DD").format("dddd, DD MMM YYYY");
        copyText_.val(formattedDateDefault_);

        $("#tgl-pelaksanaan").on("focus", function () {
            
            $(this).attr("type", "date");
            copyDate_.val(formattedDateDefault_);
        });

        $("#tgl-pelaksanaan").on("blur", function () {
            
            if (!isValidDate($(this).val())) {

                var value_ = valueSementara2_;
                
                var formattedDateBlur_ = moment(value_, "YYYY-MM-DD").format("dddd, DD MMM YYYY");
                copyText_.val(formattedDateBlur_);
            } else {
                valueAwal_ = $(this).val();
                var formattedDate_ = moment(valueAwal_, "YYYY-MM-DD").format("dddd, DD MMM YYYY");
                copyText_.val(formattedDate_);
            }
        });

        function isValidDate(value_) {
            var date = new Date(value_);
            return !isNaN(date.getTime());
        }

        var defaultView = $('#bataspengisianRespon');
        var copyDate = defaultView.attr("type", "date");
        var copyText = defaultView.attr("type", "text");
        var valueAwal = $('#bataspengisianRespon').val()
        var valueSementara = valueAwal;
        var valueSementara2 = valueAwal;

        var formattedDateDefault = moment(valueSementara, "YYYY-MM-DD").format("dddd, DD MMM YYYY");
        copyText.val(formattedDateDefault);

        $("#bataspengisianRespon").on("focus", function () {
            
            $(this).attr("type", "date");
            copyDate.val(formattedDateDefault);
        });

        $("#bataspengisianRespon").on("blur", function () {
            
            if (!isValidDate($(this).val())) {

                var value = valueSementara2;
                
                var formattedDateBlur = moment(value, "YYYY-MM-DD").format("dddd, DD MMM YYYY");
                copyText.val(formattedDateBlur);
            } else {
                valueAwal = $(this).val();
                var formattedDate = moment(valueAwal, "YYYY-MM-DD").format("dddd, DD MMM YYYY");
                copyText.val(formattedDate);
            }
        });

        function isValidDate(value) {
            var date = new Date(value);
            return !isNaN(date.getTime());
        }

        $('#myForm').on('submit', function(e) {
            $('#bataspengisianRespon').val(valueAwal);
            $('#tgl-pelaksanaan').val(valueAwal_);
            // var con2 = $('#tgl_berakhir').val();
            // e.preventDefault();
        })

        // flatpickr("#tgl-pelaksanaan", {
        //     locale: "{{ $locale }}",
        //     dateFormat: "dddd, D MMM Y",
        //     altFormat: "DD-MM-YYYY",
        //     enableTime: false,
        //     time_24hr: true,
        //     timeZone: "Asia/Jakarta",
        //     parseDate: (datestr, format, locale) => {
        //         return moment(datestr, format, true).toDate();
        //     },
        //     formatDate: (date, format) => {
        //         // locale can also be used
        //         return moment(date).format(format);
        //     }
        // });

        // flatpickr("#bataspengisianRespon", {
        //     locale: "{{ $locale }}",
        //     dateFormat: "dddd, D MMM Y",
        //     altFormat: "DD-MM-YYYY",
        //     enableTime: false,
        //     time_24hr: true,
        //     timeZone: "Asia/Jakarta",
        //     parseDate: (datestr, format, locale) => {
        //         return moment(datestr, format, true).toDate();
        //     },
        //     formatDate: (date, format) => {
        //         // locale can also be used
        //         return moment(date).format(format);
        //     }
        // });

        $('#auditee_id').select2();
        $('#area').select2();
        $('#auditor').select2();

        var auditee_id = $('#auditee_id').val();
        console.log(auditee_id);
        var url = "{{url('/daftartilik-searchAuditeeAuditor')}}/"+auditee_id;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: { q: '' },
            success: function(data) {
                // $('#auditor').empty();
                // $('#auditor').append('<option value="" selected disabled>Pilih Auditor</option>');
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
    });
</script>

@endpush

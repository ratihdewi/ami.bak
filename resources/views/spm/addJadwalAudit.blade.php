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
            <h5 class="text-center mb-3">Jadwal Audit Hari-1</h5>
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form action="/insertjadwal" method="POST">
                        @csrf
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditor" class="col-sm-3 col-form-label"
                                >Tahun Ajaran <span class="fw-bold text-danger">*</span></label
                            >
                            <div class="col-sm-4">
                                <input
                                    type="number"
                                    class="form-control"
                                    min="{{ $auditee_->min('tahunperiode0') }}"
                                    max="{{ $auditee_->max('tahunperiode0') }}"
                                    id="th_ajaran1"
                                    name="addmore[0][th_ajaran1]"
                                    placeholder="Tahun ajaran mulai"
                                    required
                                />
                            </div>
                            <div class="col-sm-1">
                                <h3>/</h3>
                            </div>
                            <div class="col-sm-4">
                                <input
                                    type="number"
                                    class="form-control"
                                    min="{{ $auditee_->min('tahunperiode') }}"
                                    max="{{ $auditee_->max('tahunperiode') }}"
                                    id="th_ajaran2"
                                    name="addmore[0][th_ajaran2]"
                                    placeholder="Tahun ajaran selesai"
                                    required
                                />
                            </div>
                        </div>
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditee_id" class="col-sm-3 col-form-label"
                                >Auditee <span class="fw-bold text-danger">*</span></label
                            >
                            <div class="col-sm-9">
                                <select id="auditee_id" class="form-select" name="addmore[0][auditee_id]" required>
                                    <option selected disabled>Pilih Auditee yang akan dijadwalkan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditor_id" class="col-sm-3 col-form-label"
                                >Auditor <span class="fw-bold text-danger">*</span></label
                            >
                            <div class="col-sm-9">
                                <select id="auditor_id" class="form-select" name="addmore[0][auditor_id]" required>
                                    <option selected disabled>Pilih Auditor yang akan dijadwalkan</option>
                                </select>
                            </div>
                        </div>
                        <div id="detailjadwal">
                            <div class="card mb-4" id="firstJadwal">
                                <div class="body-card px-5 pt-5 pb-4">
                                    <div class="row mb-4">
                                        <label
                                            for="hari_tgl"
                                            class="col-sm-3 col-form-label"
                                            >Hari/Tanggal <span class="fw-bold text-danger">*</span></label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Hari, Tgl Bln Tahun"
                                                id="hari_tgl"
                                                name="addmore[0][hari_tgl]"
                                                required
                                            />
                                            <p id="validationMessage" style="color: red; font-size: 12px;"></p>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label
                                            for="tempat"
                                            class="col-sm-3 col-form-label"
                                            >Tempat <span class="fw-bold text-danger">*</span></label
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
                                            >Waktu <span class="fw-bold text-danger">*</span></label
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
                                            >Kegiatan <span class="fw-bold text-danger">*</span></label
                                        >
                                        <div class="col-sm-9">
                                            {{-- <input
                                                type="text"
                                                class="form-control"
                                                id="kegiatan"
                                                placeholder="Kegiatan"
                                                name="addmore[0][kegiatan]"
                                            /> --}}
                                            <div class="dropdown" id="kegiatan">
                                                <button
                                                  type="button"
                                                  class="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between text-secondary border border-secondary"
                                                  data-bs-toggle="dropdown"
                                                  aria-expanded="false"
                                                  data-bs-auto-close="outside"
                                                >
                                                  Pilih Kegiatan
                                                </button>
                                                <ul class="dropdown-menu w-100">
                                                  <li><a class="dropdown-item" data-value="Asesmen kecukupan" id="asesmenkecukupan">Asesmen kecukupan</a></li>
                                                  <li><a class="dropdown-item" data-value="Asesmen lapangan" id="asesmenlapangan">Asesmen lapangan</a></li>
                                                  <li><a class="dropdown-item" data-value="Penandatanganan berita acara" id="penandatangananba">Penandatanganan berita acara</a></li>
                                                  <li><hr class="dropdown-divider"></li>
                                                  <li class="px-2"><input type="text" class="w-100 vh-50" id="kegiatanitem" placeholder="Lainnya" name="addmore[0][kegiatan]"></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        id="moreItems_add"
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/id.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        
        $(document).ready(function(){
            var max_fields = 50;
            var wrapper = $("#detailjadwal");
            var add_btn = $(".moreItems_add");
            var i = 1;

            flatpickr("#waktu", {
                enableTime: true,
                noCalendar: true,
                locale: "id",
                dateFormat: "H:i",
                minTime: "00:00",
                maxTime: "23:59",
            });

            flatpickr("#hari_tgl", {
                dateFormat: "d-m-Y",
                locale: "id",
                enableTime: false,
                time_24hr: true,
                timeZone: "Asia/Jakarta",
            });

            const dropdown = document.getElementById('kegiatan');
            const lainnyaInput = document.getElementById('kegiatanitem');
            const inputKegiatan = document.getElementById('kegiataninput');
            const dropdownItems = dropdown.querySelectorAll('.dropdown-item[data-value]');

            dropdownItems.forEach(item => {
                item.addEventListener('click', () => {
                    const selectedValue = item.getAttribute('data-value');
                    dropdown.querySelector('.btn').textContent = selectedValue;
                    console.log("selectedValue" + selectedValue);

                    $('#kegiatanitem').val(selectedValue);
                });
            });
            
            $(add_btn).click(function(e){
                e.preventDefault();
                if (i < max_fields) {
                    i++;
                    console.log("jadwal"+i);
                    $(wrapper).append('<div class="card mb-4 add-new" id="otherJadwal"><h5 class="text-center mt-5">Jadwal Audit Hari-'+i+'</h5><div class="body-card px-5 pt-4 pb-4"><div class="row mb-3 px-5 py-3" hidden><label for="auditee_id'+i+'" class="col-sm-3 col-form-label">Auditee</label><div class="col-sm-9"><input type="text" class="form-control" id="auditee_id'+i+'" name="addmore['+i+'][auditee_id]" placeholder="Auditee"/></div></div><div class="row mb-3 py-3"><label for="auditor_id'+i+'" class="col-sm-3 col-form-label">Auditor <span class="fw-bold text-danger">*</span></label><div class="col-sm-9 px-3"><select id="auditor_id'+i+'" class="form-select" name="addmore['+i+'][auditor_id]" required><option selected disabled>Pilih Auditor yang akan dijadwalkan</option>@foreach ($auditor_ as $auditor)<option value="{{ $auditor->id }}">{{ $auditor->nama }}</option>@endforeach</select></div></div><div class="row mb-3 px-5 py-3" hidden><label for="th_ajaran" class="col-sm-3 col-form-label">Tahun Ajaran <span class="fw-bold text-danger">*</span></label><div class="col-sm-4"><input type="number" class="form-control" min="2016" max="2500" id="th_ajaran1'+i+'" name="addmore['+i+'][th_ajaran1]" placeholder="Tahun ajaran mulai"/></div><div class="col-sm-1"><h3>/</h3></div><div class="col-sm-4"><input type="number" class="form-control" min="2016" max="2500" id="th_ajaran2'+i+'" name="addmore['+i+'][th_ajaran2]" placeholder="Tahun ajaran selesai"/></div></div><div class="row mb-4"><label for="hari_tgl'+i+'"class="col-sm-3 col-form-label">Hari/Tanggal <span class="fw-bold text-danger">*</span></label><div class="col-sm-9"><input type="text"class="form-control" id="hari_tgl'+i+'" name="addmore['+i+'][hari_tgl]" placeholder="Hari, Tgl Bln Tahun" required/></div></div><div class="row mb-4"><label for="tempat'+i+'" class="col-sm-3 col-form-label">Tempat <span class="fw-bold text-danger">*</span></label><div class="col-sm-9"><input type="text"class="form-control" id="tempat'+i+'" placeholder="Tempat Pelaksanaan" name="addmore['+i+'][tempat]" required /></div></div><div class="row mb-4"><label for="waktu'+i+'"class="col-sm-3 col-form-label">Waktu <span class="fw-bold text-danger">*</span></label><div class="col-sm-9"><input type="time"class="form-control" id="waktu'+i+'" placeholder="Tempat Pelaksanaan" name="addmore['+i+'][waktu]"/></div></div><div class="row mb-4"><label for="kegiatan'+i+'"class="col-sm-3 col-form-label">Kegiatan <span class="fw-bold text-danger">*</span></label><div class="col-sm-9"><div class="dropdown" id="kegiatan'+i+'"><button type="button" class="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between text-secondary border border-secondary" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">Pilih Kegiatan</button><ul class="dropdown-menu w-100"><li><a class="dropdown-item" data-value="Asesmen kecukupan" id="asesmenkecukupan'+i+'">Asesmen kecukupan</a></li><li><a class="dropdown-item" data-value="Asesmen lapangan" id="asesmenlapangan'+i+'">Asesmen lapangan</a></li><li><a class="dropdown-item" data-value="Penandatanganan berita acara" id="penandatangananba'+i+'">Penandatanganan berita acara</a></li><li><hr class="dropdown-divider"></li><li class="px-2"><input type="text" class="w-100 vh-50" id="kegiatanitem'+i+'" placeholder="Lainnya" name="addmore[0][kegiatan]"></li></ul></div></div></div><button type="button" id="remove-tr" class="remove_tr btn btn-danger btn-sm float-end">Urungkan</button></div></div>')
                
                }
            });

            $(document).on('click', '#remove-tr', function(){  
                $(this).parents('.add-new').remove();
                i--;
            });

            $(document).on('click', '#moreItems_add', function() {

                gettanggal(i);
                getwaktu(i);
                getkegiatan(i);

                var auditee_id = $('#auditee_id').val();
                var thAjaran1 = $('#th_ajaran1').val();
                var thAjaran2 = $('#th_ajaran2').val();

                $('#auditee_id'+i).val(auditee_id);
                $('#th_ajaran1'+i).val(thAjaran1);
                $('#th_ajaran2'+i).val(thAjaran2);

                if (auditee_id != null || auditee_id != '') {
                    console.log("kondisi sesuai");
                    console.log(auditee_id);
                    $.ajax({
                        url: "{{url('tambahjadwal-getauditor')}}/"+ auditee_id,
                        type: 'GET',
                        dataType: 'json',
                        data: { q: '' },
                        success: function(data) {
                            console.log(data);
                            $('#auditor_id'+i).empty();
                            $('#auditor_id'+i).append('<option value="" selected disabled>Pilih Auditor yang akan dijadwalkan test</option>');
                            if (Array.isArray(data)) {
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

                                $('#auditor_id'+i).select2({
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
                }
            });

            function gettanggal(i)
            {
                flatpickr("#hari_tgl"+i, {
                    dateFormat: "d-m-Y",
                    locale: "id",
                    enableTime: false,
                    time_24hr: true,
                    timeZone: "Asia/Jakarta",
                });
            }

            function getwaktu(i)
            {
                flatpickr("#waktu"+i, {
                    enableTime: true,
                    noCalendar: true,
                    locale: "id",
                    dateFormat: "H:i",
                    minTime: "00:00",
                    maxTime: "23:59",
                });
            }

            function getkegiatan(i)
            {
                const dropdown = document.getElementById('kegiatan'+i);
                const lainnyaInput = document.getElementById('kegiatanitem'+i);
                const inputKegiatan = document.getElementById('kegiataninput'+i);
                const dropdownItems = dropdown.querySelectorAll('.dropdown-item[data-value]');

                dropdownItems.forEach(item => {
                    item.addEventListener('click', () => {
                        const selectedValue = item.getAttribute('data-value');
                        dropdown.querySelector('.btn').textContent = selectedValue;
                        console.log("selectedValue" + selectedValue);

                        $('#kegiatanitem'+i).val(selectedValue);
                    });
                });
            }

            $('#auditee_id').select2();
            $('#auditor_id').select2()

            $('#th_ajaran1').change(function() {
                thperiodeawal = $(this).val();
                thperiodeawal = parseInt(thperiodeawal);
                $('#th_ajaran2').val(thperiodeawal+1);

                fillUnitKerja(thperiodeawal);
            });

            $('#th_ajaran2').change(function() {
                thperiodeakhir = $(this).val();
                thperiodeakhir = parseInt(thperiodeakhir);
                $('#th_ajaran1').val(thperiodeakhir-1);

                fillUnitKerja(thperiodeawal);
            });

            $('#auditee_id').change(function(){
                var auditee_id = $('#auditee_id').val();

                if (auditee_id != null || auditee_id != '') {
                    $.ajax({
                        url: "{{url('tambahjadwal-getauditor')}}/"+ auditee_id,
                        type: 'GET',
                        dataType: 'json',
                        data: { q: '' },
                        success: function(data) {
                            console.log(data);
                            $('#auditor_id').empty();
                            $('#auditor_id').append('<option value="" selected disabled>Pilih Auditor yang akan dijadwalkan</option>');
                            if (Array.isArray(data)) {
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

                                $('#auditor_id').select2({
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
                }

            });

            // $('form').submit(function(e) {
            //     var haritgl = $('#hari_tgl').val();
            //     var thperiodeawal = $('#th_ajaran1').val();
            //     var thperiodeakhir = $('#th_ajaran2').val();
            //     haritgl = new Date(haritgl).getFullYear();

            //     console.log(thperiodeawal);
            //     console.log(thperiodeakhir);
            //     console.log(haritgl);

            //     if (haritgl != thperiodeawal && haritgl != thperiodeakhir) {
            //         console.log("Tanggal tidak sesuai dengan tahun ajaran");
            //         $('#validationMessage').text("Gagal - Tanggal tidak sesuai");
            //         e.preventDefault();
            //     } else {
            //         console.log("Berhasil - Tanggal sesuai");
            //     }
            // });
            
        });

        function fillUnitKerja(tahun)
        {
            var thakhir = tahun + 1;

            console.log(tahun);
            console.log(thakhir);

            $.ajax({
                url: "{{url('jadwalaudit-searchauditee')}}/" + tahun + "/" + thakhir,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    console.log(data);
                    $('#auditee_id').empty();
                    $('#auditee_id').append('<option value="" selected disabled>Pilih Auditee yang akan dijadwalkan</option>');
                    if (Array.isArray(data)) {
                        var mappedData = data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.unit_kerja,
                            };
                        });

                        $('#auditee_id').select2({
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
        }
    </script>
@endpush

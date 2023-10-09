@extends('layout.main') @section('title') AMI - Jadwal Audit @endsection

@section('linking')
  <a href="/jadwalaudit" class="mx-1">
    Jadwal Audit
  </a>/

  <a href="/jadwalaudit-tampiljadwalaudit/{{ $data->id }}" class="mx-1">
    Edit Jadwal
  </a>/
@endsection

@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <h5 class="text-center mb-3">Ubah Jadwal Audit</h5>
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form action="/jadwalaudit-updatejadwalaudit/{{ $data->id }}" method="POST">
                        @csrf
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditor" class="col-sm-3 col-form-label"
                                >Tahun Ajaran</label
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
                                    value="{{ $data->th_ajaran1 }}"
                                    readonly
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
                                    value="{{ $data->th_ajaran2 }}"
                                    readonly
                                    required
                                />
                            </div>
                        </div>
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditee_id" class="col-sm-3 col-form-label"
                                >Auditee</label
                            >
                            <div class="col-sm-9">
                                <input class="form-control" id="auditee_id" type="text" name="addmore[0][auditee_id]" value="{{ $data->auditee->unit_kerja }}" required readonly>
                            </div>
                        </div>
                        <div class="row mb-3 px-5 py-3">
                            <label for="auditor_id" class="col-sm-3 col-form-label"
                                >Auditor</label
                            >
                            <div class="col-sm-9">
                                <select id="auditor_id" class="form-select" name="addmore[0][auditor_id]" value="{{$data->auditor_id}}" required>
                                    <option selected>{{ $data->auditor->nama }}</option>
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
                                            >Hari/Tanggal</label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Hari, Tgl Bln Tahun"
                                                id="hari_tgl"
                                                name="addmore[0][hari_tgl]"
                                                value="{{ $data->hari_tgl->translatedFormat('d-m-Y') }}"
                                                required
                                            />
                                            <p id="validationMessage" style="color: red; font-size: 12px;"></p>
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
                                                value="{{ $data->tempat }}"
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
                                                value="{{ $data->waktu->isoFormat('HH:mm') }}"
                                                required
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
                                                value="{{ $data->kegiatan }}"
                                                required
                                            />
                                        </div>
                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/id.js"></script>
    <script>
        $(document).ready(function(){
            var hari_tgl = "{{ $data->hari_tgl }}";
            console.log(hari_tgl);
            console.log($('#hari_tgl').val());

            flatpickr("#hari_tgl", {
                dateFormat: "d-m-Y", // Sesuaikan dengan format yang Anda inginkan
                locale: "id",
                enableTime: false, // Jangan aktifkan waktu
                // time_24hr: true, // Gunakan format 24 jam
                timeZone: "Asia/Jakarta",
            });

            var max_fields = 50;
            var wrapper = $("#detailjadwal");
            var add_btn = $(".moreItems_add");
            var i = 1;
            var auditee_id = "{{ $data->auditee_id }}";
            var auditor_id = "{{ $auditor_->nama }}";
            console.log(auditee_id);
            console.log(auditor_id);

            fillAuditor(auditee_id, auditor_id);
        });

        function fillAuditor(auditee_id, auditor)
        {
            $.ajax({
                url: "{{url('tambahjadwal-getauditor')}}/"+ auditee_id,
                type: 'GET',
                dataType: 'json',
                data: { q: '' },
                success: function(data) {
                    console.log(data);
                    // $('#auditor_id').empty();
                    // $('#auditor_id').append('<option value="" selected disabled>Pilih Auditor yang akan dijadwalkan</option>');
                    if (Array.isArray(data)) {
                        console.log(data);
                        var mappedData = data.map(function(item) {
                            if (item.ketua_auditor != auditor) {
                                return {
                                    id: item.ketua_auditor,
                                    text: item.ketua_auditor,
                                };
                            } else {
                                console.log("sama");
                            }
                        });

                        data.forEach(function(item) {
                            if (item.anggota_auditor != auditor) {
                                mappedData.push({
                                    id: item.anggota_auditor,
                                    text: item.anggota_auditor,
                                });
                            }
                        });

                        data.forEach(function(item) {
                            if (item.anggota_auditor2 != auditor) {
                                mappedData.push({
                                    id: item.anggota_auditor2,
                                    text: item.anggota_auditor2,
                                });
                            }
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
    </script>
@endpush

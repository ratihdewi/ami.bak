@extends('layout.main') @section('title') AMI - Jadwal Audit Mutu Internal @endsection

@section('linking')
  <a href="/jadwalaudit" class="mx-1">
    Jadwal Audit
  </a>/

  <a href="/editjadwalami-keseluruhan/{{ $jadwalami->id }}" class="mx-1">
    Edit Jadwal
  </a>/
@endsection

@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <h5 class="text-center mb-3">Ubah Jadwal AMI</h5>
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form id="myForm" action="/updatejadwalami-keseluruhan/{{ $jadwalami->id }}" method="POST">
                        @csrf
                        <div class="card mb-4">
                            <div class="body-card px-5 pt-5 pb-4">
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
                                            name="kegiatan"
                                            value="{{ $jadwalami->kegiatan }}"
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label
                                        for="tgl_mulai"
                                        class="col-sm-3 col-form-label"
                                        >Tanggal Mulai</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            onfocus="(this.type='date')"
                                            onblur="(this.type='text')"
                                            id="tgl_mulai"
                                            name="tgl_mulai"
                                            value="{{ $jadwalami->tgl_mulai->translatedFormat('Y-m-d') }}"
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label
                                        for="tgl_berakhir"
                                        class="col-sm-3 col-form-label"
                                        >Tanggal Berakhir</label
                                    >
                                    <div class="col-sm-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            onfocus="(this.type='date')"
                                            onblur="(this.type='text')"
                                            id="tgl_berakhir"
                                            name="tgl_berakhir"
                                            value="{{ $jadwalami->tgl_berakhir->translatedFormat('Y-m-d') }}"
                                            required
                                        />
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/id.js"></script>
    
    <script>
        $(document).ready(function(){
            var max_fields = 50;
            var wrapper = $("#detailjadwal");
            var add_btn = $("#moreItems_add");
            var i = 1;

            var defaultView_ = $('#tgl_mulai');
            var copyDate_ = defaultView_.attr("type", "date");
            var copyText_ = defaultView_.attr("type", "text");
            var valueAwal_ = $('#tgl_mulai').val()
            var valueSementara_ = valueAwal_;
            var valueSementara2_ = valueAwal_;

            var formattedDateDefault_ = moment(valueSementara_, "YYYY-MM-DD").format("dddd, DD MMM YYYY");
            copyText_.val(formattedDateDefault_);

            $("#tgl_mulai").on("focus", function () {
                
                $(this).attr("type", "date");
                copyDate_.val(formattedDateDefault_);
            });

            $("#tgl_mulai").on("blur", function () {
                
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

            var defaultView = $('#tgl_berakhir');
            var copyDate = defaultView.attr("type", "date");
            var copyText = defaultView.attr("type", "text");
            var valueAwal = $('#tgl_berakhir').val()
            var valueSementara = valueAwal;
            var valueSementara2 = valueAwal;


            var formattedDateDefault = moment(valueSementara, "YYYY-MM-DD").format("dddd, DD MMM YYYY");
            copyText.val(formattedDateDefault);

            $("#tgl_berakhir").on("focus", function () {
                
                $(this).attr("type", "date");
                copyDate.val(formattedDateDefault);
            });

            $("#tgl_berakhir").on("blur", function () {
                
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
                $('#tgl_berakhir').val(valueAwal);
                $('#tgl_mulai').val(valueAwal_);
                var con2 = $('#tgl_berakhir').val();
            })

            // flatpickr("#tgl_mulai", {
            //     locale: "{{ $locale }}",
            //     dateFormat: "dddd, D MMM Y",
            //     altFormat: "DD-MM-YYYY",
            //     enableTime: true,
            //     time_24hr: true,
            //     timeZone: "Asia/Jakarta",
            //     parseDate: (datestr, format) => {
            //         console.log(datestr);
            //         console.log(format);
            //         return moment(datestr, format, true).toDate();
            //     },
            //     formatDate: (date, format, locale) => {
            //         // locale can also be used
            //         // console.log(format);
            //         // console.log(date);
            //         return moment(date).format(format);
            //     },
            // });

            // $('#tgl_mulai').change(function() {
            //     flatpickr("#tgl_mulai", {
            //         locale: "{{ $locale }}",
            //         dateFormat: "dddd, D MMM Y",
            //         altFormat: "DD-MM-YYYY",
            //         enableTime: true,
            //         time_24hr: true,
            //         timeZone: "Asia/Jakarta",
            //         parseDate: (datestr, format) => {
            //             console.log(datestr);
            //             console.log(format);
            //             return moment(datestr, format, true).toDate();
            //         },
            //         formatDate: (date, format, locale) => {
            //             // locale can also be used
            //             // console.log(format);
            //             // console.log(date);
            //             return moment(date).format(format);
            //         },
            //     });
            // });

            // flatpickr("#tgl_berakhir", {
            //     dateFormat: "dddd, D MMM Y",
            //     altFormat: "DD-MM-YYYY",
            //     locale: "id",
            //     enableTime: true,
            //     time_24hr: true,
            //     timeZone: "Asia/Jakarta",
            //     parseDate: (datestr, format) => {
            //         // console.log(format);
            //         return moment(datestr, format, true).toDate();
            //     },
            //     formatDate: (date, format, locale) => {
            //         // locale can also be used
            //         // console.log(date);
            //         // console.log(locale);
            //         // console.log(format);
            //         return moment(date).format(format);
            //     }
            // });
        });
    </script>
@endpush

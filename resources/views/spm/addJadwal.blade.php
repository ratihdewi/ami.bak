@extends('layout.main') @section('title') AMI - Jadwal Audit Mutu Internal @endsection

@section('linking')
  <a href="/jadwalaudit" class="mx-1">
    Jadwal Audit
  </a>/

  <a href="/jadwalauditAMI - tambahjadwal" class="mx-1">
    Tambah Jadwal
  </a>/
@endsection

@section('container')
<div class="container vh-100 mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <h5 class="text-center mb-3">Tambah Jadwal AMI</h5>
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form action="/storejadwalami" method="POST">
                        @csrf
                        <div id="detailjadwal">
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
                                                name="addmore[0][kegiatan]" placeholder="[Kegitan - Sub Kegiatan]"
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
                                                id="tgl_mulai"
                                                name="addmore[0][tgl_mulai]"
                                                placeholder="Hari, Tanggal Bln Tahun"
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
                                                id="tgl_berakhir"
                                                name="addmore[0][tgl_berakhir]"
                                                placeholder="Hari, Tanggal Bln Tahun"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <button type="button" id="moreItems_add" class="btn btn-primary btn-sm float-end">Tambah</button>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/id.js"></script>
    <script>
        $(document).ready(function(){
            var max_fields = 50;
            var wrapper = $("#detailjadwal");
            var add_btn = $("#moreItems_add");
            var i = 1;

            // flatpickr("#tgl_mulai", {
            //     dateFormat: "l, d M Y", // Format tampilan
            //     altFormat: "Y-m-d", // Format yang akan digunakan saat mengirimkan data
            //     altInput: true, // Aktifkan input alternatif untuk menampilkan tanggal dalam altFormat
            //     locale: {
            //         firstDayOfWeek: 0, // Minggu dimulai dari hari pertama
            //         weekdays: {
            //             shorthand: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
            //             longhand: [
            //                 "Minggu",
            //                 "Senin",
            //                 "Selasa",
            //                 "Rabu",
            //                 "Kamis",
            //                 "Jumat",
            //                 "Sabtu",
            //             ],
            //         },
            //         months: {
            //             shorthand: [
            //                 "Jan",
            //                 "Feb",
            //                 "Mar",
            //                 "Apr",
            //                 "Mei",
            //                 "Jun",
            //                 "Jul",
            //                 "Agu",
            //                 "Sep",
            //                 "Okt",
            //                 "Nov",
            //                 "Des",
            //             ],
            //             longhand: [
            //                 "Januari",
            //                 "Februari",
            //                 "Maret",
            //                 "April",
            //                 "Mei",
            //                 "Juni",
            //                 "Juli",
            //                 "Agustus",
            //                 "September",
            //                 "Oktober",
            //                 "November",
            //                 "Desember",
            //             ],
            //         },
            //     },
            //     enableTime: false,
            //     time_24hr: true,
            //     timeZone: "Asia/Jakarta",
            //     onChange: function(selectedDates, dateStr, instance) {
            //         // Konversi tanggal ke format altFormat saat ada perubahan
            //         instance.altInput.value = instance.formatDate(
            //             selectedDates[0],
            //             "l, d M Y"
            //         );
            //     },
            // });

            flatpickr("#tgl_mulai", {
                locale: "{{ $locale }}",
                dateFormat: "dddd, D MMM Y",
                altFormat: "DD-MM-YYYY",
                enableTime: false,
                time_24hr: true,
                timeZone: "Asia/Jakarta",
                parseDate: (datestr, format, locale) => {
                    return moment(datestr, format, true).toDate();
                },
                formatDate: (date, format) => {
                    // locale can also be used
                    return moment(date).format(format);
                }
            });

            flatpickr("#tgl_berakhir", {
                dateFormat: "dddd, D MMM Y",
                altFormat: "DD-MM-YYYY",
                locale: "id",
                enableTime: false,
                time_24hr: true,
                timeZone: "Asia/Jakarta",
                parseDate: (datestr, format) => {
                    return moment(datestr, format, true).toDate();
                },
                formatDate: (date, format, locale) => {
                    // locale can also be used
                    return moment(date).format(format);
                }
            });

            
            $(add_btn).click(function(e){
                
                e.preventDefault();
                if (i < max_fields) {
                    i++;

                    $(wrapper).append('<div class="card mb-4 add-new"><div class="body-card px-5 pt-5 pb-4"><div class="row mb-4"><label for="kegiatan'+i+'" class="col-sm-3 col-form-label">Kegiatan</label><div class="col-sm-9"><input type="text" class="form-control" id="kegiatan'+i+'" name="addmore['+i+'][kegiatan]" placeholder="Masukkan kegiatan" required/></div></div><div class="row mb-4"><label for="tgl_mulai'+i+'"class="col-sm-3 col-form-label">Tanggal Mulai</label><div class="col-sm-9"><input type="date" class="form-control" id="tgl_mulai'+i+'" name="addmore['+i+'][tgl_mulai]" required/></div></div><div class="row mb-4"><label  for="tgl_berakhir'+i+'" class="col-sm-3 col-form-label">Tanggal Berakhir</label><div class="col-sm-9"><input type="date" class="form-control" id="tgl_berakhir'+i+'" name="addmore['+i+'][tgl_berakhir]" required /></div></div><button type="button" id="remove-tr" class="remove_tr btn btn-danger btn-sm float-end">Urungkan</button></div></div>')

                }
            });

            $(document).on('click', '#remove-tr', function(){  
                $(this).parents('.add-new').remove();
            });
        });
    </script>
@endpush

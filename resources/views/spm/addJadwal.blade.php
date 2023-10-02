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
<div class="container mt-5" style="min-height: 100vh">
    <div class="row justify-content-center">
        <div class="col-8 card-jadwalami">
            <h5 class="text-center mb-3">Tambah Jadwal AMI</h5>
            <div class="card mb-5">
                <div class="card-body p-4">
                    <form id="formJadwal" action="/storejadwalami" method="POST">
                        @csrf
                        <div id="detailjadwal">
                            <div class="card mb-4">
                                <div class="body-card bc-jadwalami px-5 pt-5 pb-4">
                                    <div id="liveAlertPlaceholder"></div>
                                    <div class="row mb-4">
                                        <label for="auditor" class="col-sm-3 col-form-label"
                                            >Tahun Ajaran <span class="fw-bold text-danger">*</span></label
                                        >
                                        <div class="col-sm-4">
                                            <input
                                                type="number"
                                                class="form-control"
                                                id="th_ajaran1"
                                                name="addmore[0][th_ajaran1]"
                                                min="2016"
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
                                                id="th_ajaran2"
                                                name="addmore[0][th_ajaran2]"
                                                min="2017"
                                                placeholder="Tahun ajaran selesai"
                                                required
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
                                            >Tanggal Mulai <span class="fw-bold text-danger">*</span></label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="tgl_mulai"
                                                name="addmore[0][tgl_mulai]"
                                                placeholder="{{ $currentDate }}"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label
                                            for="tgl_berakhir"
                                            class="col-sm-3 col-form-label"
                                            >Tanggal Berakhir <span class="fw-bold text-danger">*</span></label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="tgl_berakhir"
                                                name="addmore[0][tgl_berakhir]"
                                                placeholder="{{ $currentDate }}"
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

            $('#th_ajaran1').change(function() {
                thperiodeawal = $(this).val();
                thperiodeawal = parseInt(thperiodeawal);
                $('#th_ajaran2').val(thperiodeawal+1);

                // fillUnitKerja(thperiodeawal);
            });

            $('#th_ajaran2').change(function() {
                thperiodeakhir = $(this).val();
                thperiodeakhir = parseInt(thperiodeakhir);
                $('#th_ajaran1').val(thperiodeakhir-1);

                // fillUnitKerja(thperiodeawal);
            });

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
                locale: "id",
                dateFormat: "d-m-Y",
                altFormat: "DD-MM-YYYY",
                enableTime: false,
                time_24hr: true,
                timeZone: "Asia/Jakarta",
            });

            flatpickr("#tgl_berakhir", {
                dateFormat: "d-m-Y",
                altFormat: "DD-MM-YYYY",
                locale: "id",
                enableTime: false,
                time_24hr: true,
                timeZone: "Asia/Jakarta",
            });

            const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

            const alert = (message, type) => {
                const wrapper_ = document.createElement('div')
                wrapper_.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
                ].join('')

                alertPlaceholder.append(wrapper_)
            }
            
            $(add_btn).click(function(e){
                
                e.preventDefault();
                var thAjaran1 = $('#th_ajaran1').val();
                var thAjaran2 = $('#th_ajaran2').val();

                console.log(thAjaran1);
                if (thAjaran1 != '' || thAjaran2 != '') {
                    if (i < max_fields) {
                        i++;
                        $(wrapper).append('<div class="card mb-4 add-new"><div class="body-card px-5 pt-5 pb-4"><div class="row mb-4" hidden><label for="auditor" class="col-sm-3 col-form-label">Tahun Ajaran <span class="fw-bold text-danger">*</span></label><div class="col-sm-4"><input type="number" class="form-control" id="th_ajaran1'+i+'" name="addmore['+i+'][th_ajaran1]" min="2016" placeholder="Tahun ajaran mulai" required/></div><div class="col-sm-1"><h3>/</h3></div><div class="col-sm-4"><input type="number" class="form-control" id="th_ajaran2'+i+'" name="addmore['+i+'][th_ajaran2]" min="2017" placeholder="Tahun ajaran selesai"- required/></div></div><div class="row mb-4"><label for="kegiatan'+i+'" class="col-sm-3 col-form-label">Kegiatan <span class="fw-bold text-danger">*</span></label><div class="col-sm-9"><input type="text" class="form-control" id="kegiatan'+i+'" name="addmore['+i+'][kegiatan]" placeholder="Masukkan kegiatan" required/></div></div><div class="row mb-4"><label for="tgl_mulai'+i+'"class="col-sm-3 col-form-label">Tanggal Mulai <span class="fw-bold text-danger">*</span></label><div class="col-sm-9"><input type="text" class="form-control" id="tgl_mulai'+i+'" name="addmore['+i+'][tgl_mulai]" placeholder="{{ $currentDate }}" required/></div></div><div class="row mb-4"><label  for="tgl_berakhir'+i+'" class="col-sm-3 col-form-label">Tanggal Berakhir <span class="fw-bold text-danger">*</span></label><div class="col-sm-9"><input type="text" class="form-control" id="tgl_berakhir'+i+'" name="addmore['+i+'][tgl_berakhir]" placeholder="{{ $currentDate }}" required /></div></div><button type="button" id="remove-tr" class="remove_tr btn btn-danger btn-sm float-end">Urungkan</button></div></div>')

                    }
                } else {
                    alert('Harap mengisi tahun ajaran terlebih dahulu.', 'warning');
                }
                
            });

            $(document).on('click', '#moreItems_add', function() {
                gettanggal(i);

                var thAjaran1 = $('#th_ajaran1').val();
                var thAjaran2 = $('#th_ajaran2').val();

                $('#th_ajaran1'+i).val(thAjaran1);
                $('#th_ajaran2'+i).val(thAjaran2);
            });

            $(document).on('click', '#remove-tr', function(){  
                $(this).parents('.add-new').remove();
            });
        });

        function gettanggal(i)
        {
            flatpickr("#tgl_mulai"+i, {
                locale: "id",
                dateFormat: "d-m-Y",
                altFormat: "DD-MM-YYYY",
                enableTime: false,
                time_24hr: true,
                timeZone: "Asia/Jakarta",
            });

            flatpickr("#tgl_berakhir"+i, {
                dateFormat: "d-m-Y",
                altFormat: "DD-MM-YYYY",
                locale: "id",
                enableTime: false,
                time_24hr: true,
                timeZone: "Asia/Jakarta",
            });
        }
    </script>
@endpush

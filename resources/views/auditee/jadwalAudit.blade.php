@extends('auditee.main_') 

@section('title') AMI - Jadwal Audit @endsection

@section('linking')
  <a href="/auditee-jadwalaudit" class="mx-1">
    Jadwal Audit
  </a>/
@endsection

@section('container')

<div class="container-fluid mt-4" style="font-size: 13px; min-height: 100vh">
  {{-- Search Jadwal --}}
  <div class="search my-5 p-5 mx-5 text-white rounded">
    <form action="auditee_searchjadwal" method="get">
      @csrf
      <div class="input-group d-flex justify-content-around">
        <select class="form-select mx-3 border border-secondary rounded" id="inputauditee" aria-label="Example select with button addon" name="select_auditee">
          <option selected disabled>Filter Auditee</option>
          @foreach ($unitkerjas as $unitkerja)
          <option value="{{ $unitkerja->name }}">{{ $unitkerja->name }}</option>
          @endforeach
        </select>
        <select class="form-select mx-3 border border-secondary rounded" id="inputtahun" aria-label="Example select with button addon" name="select_tahun">
          <option selected disabled>Filter Tahun Periode</option>
          <option value="{{ date('Y') }}">{{ date('Y')-1 }}/{{ date('Y') }}</option>
          @foreach ($auditee_->unique('tahunperiode0', 'tahunperiode') as $auditee)
          <option value="{{ $auditee->tahunperiode0 }}">{{ $auditee->tahunperiode0 }}/{{ $auditee->tahunperiode }}</option>
          @endforeach
        </select>
        <button class="btn btn-primary mx-2 border rounded" type="submit">Cari</button>
      </div>
    </form>
  </div>
  {{-- Search Jadwal End --}}

  {{-- JadwalAudit --}}
  <div class="jadwalAudit mb-5">
    <ul class="nav nav-tabs flex-row justify-content-start" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Jadwal Auditor dan Auditee</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="false" tabindex="-1">Jadwal Audit</button>
      </li>
    </ul>
    @if ($message = Session::get('success'))
      <div class="alert alert-success" role="alert">
        {{ $message }}
      </div>
    @endif
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade w-100" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row my-4">
            <table class="table table-hover my-4" id="jadwalaudit">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Auditee</th>
                        <th class="col-2 text-center">Auditor</th>
                        <th class="col-1 text-center">Tahun Ajaran</th>
                        <th class="col-2 text-center">Tempat</th>
                        <th class="col-1 text-center">Hari/Tanggal</th>
                        <th class="col-1 text-center">Waktu</th>
                        <th class="col-2 text-center">Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($auditee_ as $auditee)
                    @foreach ($auditee->jadwalaudit()->get() as $item)
                      <tr>
                        <td scope="row" class="text-center">{{ $no++ }}</td>
                        <td>
                          {{ $auditee->unit_kerja }}
                        </td>
                          <td>{{ $item->auditor->nama }}</td>
                          <td class="text-center">{{ $item->th_ajaran1 }}/{{ $item->th_ajaran2 }}</td>
                          <td>{{ $item->tempat }}</td>
                          <td>{{ $item->hari_tgl->translatedFormat('l, d M Y') }}</td>
                          <td class="text-center">{{ $item->waktu->isoFormat('HH:mm') }} WIB </td>
                          <td>{{ $item->kegiatan }}</td>
                      </tr>
                      @endforeach
                      @endforeach
                </tbody>
            </table>
        </div>
      </div>

      {{-- Ketersediaan Jadwal --}}

      {{-- Modal select jadwal --}}
      {{-- Modal select ketersediaan jadwal --}}
      <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
          <div class="modal-content event" id="modal-content">
            <div class="modal-header" style="background: rgba(177, 227, 229, 0.37);">
              <h5 class="modal-title" id="exampleModalLabel">Ketersediaan Jadwal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="dateInfo"></p>
              <div class="row">
                <div class="col">
                  <label for="inisialnama">Inisial Nama:</label>
                  <input type="text" class="form-control" id="inisialnama" placeholder="contoh: AN" name="title">
                </div>
                <div class="col mx-auto">
                  <label for="session">Sesi:</label><br>
                  <select id="session" class="w-100" name="session">
                    <option value="Pilih Sesi" disabled selected>Pilih Sesi</option>
                    @foreach ($sessions as $session)
                      <option value="{{ $session->sesiKe }} ({{ $session->waktuMulai->isoFormat('HH:mm') }} - {{ $session->waktuSelesai->isoFormat('HH:mm') }} WIB)">{{ $session->sesiKe }} ({{ $session->waktuMulai->isoFormat('HH:mm') }} - {{ $session->waktuSelesai->isoFormat('HH:mm') }} WIB)</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="background: rgba(177, 227, 229, 0.37);">
              <button type="button" id="cancelBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="saveBtn" class="btn btn-success">Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade show active w-100" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container mt-3">
            <div id="calendar"></div>
            <div class="ketColor d-flex mt-3">
              <div class="form-check me-3 px-0">
                <span><i class="bi bi-square-fill" style="color: #187498"></i></span>
                <label class="form-check-label px-1" for="flexCheckIndeterminateDisabled">
                  Auditee
                </label>
              </div>
              <div class="form-check me-3 px-0">
                <span><i class="bi bi-square-fill" style="color: #367E18"></i></span>
                <label class="form-check-label px-1" for="flexCheckDisabled">
                  Auditor
                </label>
              </div>
              <div class="form-check me-3 px-0">
                <span><i class="bi bi-square-fill" style="color: #CC3636"></i></span>
                <label class="form-check-label px-1" for="flexCheckCheckedDisabled">
                  SPM
                </label>
              </div>
            </div>
            <div class="row px-0 py-3 d-flex">
              @foreach ($sessions as $session)
                <div class="col-4"><p class="my-2"><span><i class="bi bi-circle-fill me-2" style="font-size: 12px; color: #bfe9df"></i></span> {{ $session->sesiKe }} ({{ $session->waktuMulai->isoFormat('HH:mm') }} - {{ $session->waktuSelesai->isoFormat('HH:mm') }} WIB)</p></div>
              @endforeach
            </div>
        </div>
      </div>
    </div>
  </div>
  
  {{-- Jadwal keseluruhan --}}
  <div class="jadwalKeseluruhan mb-5" style="margin-top: 100px">
    <ul class="nav nav-tabs flex-row justify-content-start jadwalAudit mt-5" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Linimasa</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-panel fade show active w-100" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row mt-4">
          <table class="table table-hover my-3" id="tablejadwalkeseluruhan">
            <thead>
                <tr class="">
                    <th class="col-1 text-center">No</th>
                    <th class="col-7 text-center">Kegiatan</th>
                    {{-- <th class="col-3 text-center">Sub Kegiatan</th> --}}
                    <th class="col-4 text-center">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @php $no_ = 1; @endphp
                @foreach ($jadwalami as $jdami)
                <tr>
                  <td scope="row" class="col-1 text-center">{{ $no_++ }}</td>
                  <td class="col-7">{{ $jdami->kegiatan }}</td>
                  {{-- <td class="text-center">{{ $jdami->subkegiatan }}</td> --}}
                  <td class="col-4 text-center">
                    @if ($jdami->tgl_mulai == $jdami->tgl_berakhir)
                      {{ $jdami->tgl_mulai->translatedFormat('l, d M Y') }}
                    @else
                      {{ $jdami->tgl_mulai->translatedFormat('l, d M Y') }} - {{ $jdami->tgl_berakhir->translatedFormat('l, d M Y') }}
                    @endif
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
    
</div>

@endsection

@push('script')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({

        displayEventTime : false,
        editable:true,
        header:{
            left:'prev,next',
            center:'title',
            right:'month'
        },
        events:'/auditee_ketersediaan-jadwal',
        eventRender: function(event, element) {
            if (event.peran == 'auditor') {
              $(element).find('.fc-content').css('background-color', '#367E18');
            } else if (event.peran == 'spm') {
              $(element).find('.fc-content').css('background-color', '#CC3636');
            } else if (event.peran == 'auditee') {
              $(element).find('.fc-content').css('background-color', '#187498');
            }
            
            $(element).find('.fc-title').append(' - ' + event.session);
        },
        selectable: function(start, end, jsEvent, view) {
            if (view.calendar.getEventSources()[0].events.some(event => event.peran === 'auditee')) {
                return true;
            } else {
                return false; // Nonaktifkan selectable
            }
        },
        // selectable:true,
        selectHelper: true,
        select: function(start, end, allDay) {
            var peran = "{{ Auth::user()->peran }}";
            
            if (peran == 'auditee') {
                var date = $.fullCalendar.formatDate(start, 'D MMMM Y');
                $('#bookingModal').modal('toggle');
                $('#dateInfo').html(date);
                
                var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                $('#saveBtn').off('click').on('click', function() {
                    var title = $('#inisialnama').val();
                    var session = $('#session').val();

                    console.log(start);
                    console.log(end);
                    console.log(title);
                    console.log(session);

                    $.ajax({
                        url: "/ketersediaan-jadwal/action",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            session: session,
                            type: 'add'
                        },
                        success: function(data) {
                            console.log(data);
                            calendar.fullCalendar('refetchEvents');
                            alert("Jadwal berhasil ditambahkan!");
                            $("#inputKetersediaan").load(location.href + " #inputKetersediaan");
                        }
                    });
                    $("#form").load(location.href + " #form");

                    $('#bookingModal').on('hidden.bs.modal', function(e) {
                        $('#inisialnama').val('');
                        $('#session').val('Pilih Sesi');
                    });

                    $('#bookingModal').modal('hide');
                });

                $('#cancelBtn').click(function() {
                    $('#bookingModal').modal('hide');
                });
            } else {
                // Jika pengguna tidak memiliki peran 'admin', Anda dapat menampilkan pesan atau melakukan tindakan lain.
                alert("Anda tidak memiliki izin untuk melakukan pemilihan tanggal.");
            }
        },
        // select:function(start, end, allDay)
        // {
        //     var date = $.fullCalendar.formatDate(start, 'D MMMM Y');
        //     $('#bookingModal').modal('toggle');
        //     $('#dateInfo').html(date);
            
        //     var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
        //     var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

        //       $('#saveBtn').off('click').on('click',function() {
        //         var title = $('#inisialnama').val();
        //         var session = $('#session').val();

        //         console.log(start);
        //         console.log(end);
        //         console.log(title);
        //         console.log(session);

        //         $.ajax({
        //             url:"/ketersediaan-jadwal/action",
        //             type:"POST",
        //             data:{
        //                 title: title,
        //                 start: start,
        //                 end: end,
        //                 session: session,
        //                 type: 'add'
        //             },
        //             success:function(data)
        //             {
        //                 console.log(data);
        //                 calendar.fullCalendar('refetchEvents');
        //                 alert("Event Created Successfully");
        //                 $("#inputKetersediaan").load(location.href + " #inputKetersediaan");
        //             }
        //         })
        //         $("#form").load(location.href + " #form");

        //         $('#bookingModal').on('hidden.bs.modal', function (e) {
        //           $('#inisialnama').val('');
        //           $('#session').val('Pilih Sesi');
        //         });

        //         $('#bookingModal').modal('hide');

        //       });

        //       $('#cancelBtn').click(function() {
        //         $('#bookingModal').modal('hide');
        //       })
        // },
        editable:true,
        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var session = event.session;
            var id = event.id;
            $.ajax({
                url:"/ketersediaan-jadwal/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    session: session,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta, revertFunc)
        {
            var username = "{{ Auth::user()->name }}";
            var peran = "{{ Auth::user()->peran }}";

            if (username == event.penginput && peran == event.peran) {
              var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
              var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
              var title = event.title;
              var session = event.session;
              var id = event.id;

              $.ajax({
                  url:"/ketersediaan-jadwal/action",
                  type:"POST",
                  data:{
                      title: title,
                      start: start,
                      end: end,
                      session: session,
                      id: id,
                      type: 'update'
                  },
                  success:function(response)
                  {
                      calendar.fullCalendar('refetchEvents');
                      alert("Jadwal berhasil diubah!");
                  }
              })
            } else {
              alert("Anda tidak memiliki izin untuk melakukan perubahan jadwal.");
              revertFunc(); 
            }
            
        },

        eventClick:function(event)
        {
            var username = "{{ Auth::user()->name }}";
            var peran = "{{ Auth::user()->peran }}";

            if (username == event.penginput && peran == event.peran) {
              if(confirm("Are you sure you want to remove it?"))
              {
                  var id = event.id;
                  $.ajax({
                      url:"/ketersediaan-jadwal/action",
                      type:"POST",
                      data:{
                          id:id,
                          type:"delete"
                      },
                      success:function(response)
                      {
                          calendar.fullCalendar('refetchEvents');
                          alert("Jadwal berhasil di hapus!");
                      }
                  })
              }
            } else {
              alert("Anda tidak memiliki izin untuk melakukan penghapusan jadwal."); 
            }

        }
    });

  });
</script>
<script>
  var sesi = {!! json_encode($sessions) !!};

  // Fungsi untuk membuka modal
  function openBookingModal() {
    $('#bookingModal').modal('show');
  }

  // Fungsi untuk merefresh modal
  function refreshModal() {
      $('#inisialnama').val('');
      $('#session').empty();
      $('#session').append('<option value="Pilih Sesi" disabled selected>Pilih Sesi</option>');
      for (let i = 0; i < sesi.length; i++) {
        $('#session').append('<option value="'+sesi[i].sesiKe+' ('+moment(sesi[i].waktuMulai).format('HH:mm')+' - '+moment(sesi[i].waktuSelesai).format('HH:mm')+' WIB)"> '+sesi[i].sesiKe+' ('+moment(sesi[i].waktuMulai).format('HH:mm')+' - '+moment(sesi[i].waktuSelesai).format('HH:mm')+' WIB)</option>');
      }
  }

  // Ketika modal ditutup, panggil fungsi refreshModal
  $('#bookingModal').on('hidden.bs.modal', function (e) {
    refreshModal();
  });
</script>
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
      $('#jadwalaudit').DataTable();
      $('#tablejadwalkeseluruhan').DataTable();
      $('#inputauditee').select2();
      $('#inputtahun').select2();
      $('#session').select2();
  });
</script>
    
@endpush
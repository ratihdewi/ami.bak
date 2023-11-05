@extends('layout.main') 

@section('title') AMI - Jadwal Audit @endsection

@section('linking')
  <a href="/jadwalaudit" class="mx-1">
    Jadwal Audit
  </a>/
@endsection

@section('container')

<div class="container mt-4" style="font-size: 13px">
  {{-- Search Jadwal --}}
    <div class="search my-5 p-5 mx-5 text-white rounded searchjadwalaudit">
      <form id="search-form" action="/jadwalaudit" method="GET">
        @csrf
        <div class="input-group">
          <select class="form-select mx-3 border border-secondary rounded" id="inputauditee" aria-label="Example select with button addon" name="select_auditee" value="{{ request('select_auditee') }}">
            <option selected disabled>Filter Auditee</option>
            @foreach ($unitkerjas as $unitkerja)
            <option value="{{ $unitkerja->name }}">{{ $unitkerja->name }}</option>
            @endforeach
          </select>
          <select class="form-select mx-3 border border-secondary rounded" id="inputtahun" aria-label="Example select with button addon" name="select_tahun"value="{{ request('select_tahun') }}">
            <option selected disabled>Filter Tahun Periode</option>
            <option value="">Semua periode</option>
            {{-- <option value="{{ date('Y') }}">{{ date('Y')-1 }}/{{ date('Y') }}</option> --}}
            @foreach ($searches->unique('tahunperiode0', 'tahunperiode') as $search)
            <option value="{{ $search->tahunperiode0 }}">{{ $search->tahunperiode0 }}/{{ $search->tahunperiode }}</option>
            @endforeach
          </select>
          <button class="btn btn-primary mx-2 border rounded" type="submit">Cari</button>
        </div>
      </form>
    </div>
  {{-- Search Jadwal End --}}
  @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
      {{ $message }}
    </div>
  @elseif ($message = Session::get('error'))
  <div class="alert alert-danger" role="alert">
    {{ $message }}
  </div>
  @endif

  <div class="jadwal">
    <div id="search-result"></div>
    {{-- JadwalAudit --}}
    <div class="jadwalAudit mb-5" id="jadwaltop">
      <ul class="nav nav-tabs flex-row justify-content-start" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Jadwal Auditor dan Auditee</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="home-tab" data-bs-toggle="tab" href="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Jadwal Audit</button>
        </li>
        <a href="jadwalaudit-tambahjadwal" class="ms-auto">
          <button type="button" id="tambahJadwalAudit" class="btn btn-primary btn-sm my-2">Tambah Jadwal</button>
        </a>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade w-100 my-3" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="row">
              <table class="table table-hover" id="tablejadwalaudit">
                  <thead>
                      <tr class="">
                          <th class="col-1 text-center">No</th>
                          <th class="col-2 text-center">Auditee</th>
                          <th class="col-1 text-center">Auditor</th>
                          <th class="col-1 text-center">Tahun Periode</th>
                          <th class="col-1 text-center">Tempat</th>
                          <th class="col-2 text-center">Hari/Tanggal</th>
                          <th class="col-1 text-center">Waktu</th>
                          <th class="col-1 text-center">Kegiatan</th>
                          <th class="col-1 text-center">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @php $no = 1; @endphp
                      @foreach ($auditee_ as $auditee)
                      @foreach ($auditee->jadwalaudit()->orderBy('hari_tgl', 'ASC')->get() as $item)
                        <tr>
                          <th scope="row" class="col-1 text-center">{{ $no++ }}</th>
                          <td class="col-2">
                            {{ $auditee->unit_kerja }}
                          </td>
                            <td class="col-1">{{ $item->auditor->nama }}</td>
                            <td class="col-1 text-center">{{ $item->th_ajaran1 }}/{{ $item->th_ajaran2 }}</td>
                            <td class="col-1">{{ $item->tempat }}</td>
                            <td class="col-1">{{ $item->hari_tgl->translatedFormat('l, d M Y') }}</td>
                            <td class="col-1 text-center">{{ $item->waktu->isoFormat('HH:mm') }} WIB</td>
                            <td class="col-1">{{ $item->kegiatan }}</td>
                            <td class="col-1 text-center">
                              <a href="/jadwalaudit-tampiljadwalaudit/{{ $item->id }}"><button class="bg-primary border-0 rounded-1"><i class="bi bi-pencil-square text-white h7" title="Edit"></i></button></a>
                              <a href="/jadwalaudit-deletejadwalaudit/{{ $item->id }}" onclick="return confirm('Apakah Anda yakin akan menghapus jadwal pada tanggal {{ $item->hari_tgl->translatedFormat('l, d M Y') }} pukul {{ $item->waktu->isoFormat('HH:mm') }} WIB')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white h7" title="Hapus"></i></button></a>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                  </tbody>
              </table>
          </div>
        </div>

        {{-- Ketersediaan Jadwal --}}
        {{-- Modal Select Calender --}}
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

        {{-- Modal Session --}}
        <div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-content">
              <div class="modal-header" style="background: rgba(177, 227, 229, 0.37);">
                <h5 class="modal-title" id="exampleModalLabel">Ketersediaan Jadwal - Sesi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              
              <div class="modal-body">
                <p id="dateInfo"></p>
                <form action="/store-create-session" method="POST">
                  @csrf
                  <div class="inputsession">
                    <div class="bodysession">
                      <div class="row">
                        <div class="col">
                          <label for="namasesi">Sesi Ke-</label>
                          <input type="text" class="form-control" id="namasesi" placeholder="contoh: Sesi 1" name="addmore[0][sesiKe]">
                        </div>
                        <div class="col">
                          <label for="waktuMulai">Waktu Mulai</label>
                          <input type="time" class="form-control" id="waktuMulai" placeholder="Waktu Mulai (WIB)" name="addmore[0][waktuMulai]">
                        </div>
                        <div class="col">
                          <label for="waktuSelesai">Waktu Selesai</label>
                          <input type="time" class="form-control" id="waktuSelesai" placeholder="Waktu Selesai (WIB)" name="addmore[0][waktuSelesai]">
                        </div>
                        <div class="col-1 my-3 py-2">
                          <button id="moreItems_add" class="moreItems_add btn btn-primary float-end" type="button"><i class="bi bi-plus h5" style="color: #ffff"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="buttonform d-flex justify-content-end">
                      <button type="button" class="btn btn-secondary me-md-2" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                  </div>
                </form>
                <div class="listSession my-4">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Sesi</th>
                        <th class="text-center">Waktu Mulai</th>
                        <th class="text-center">Waktu Selesai</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $no = 1;
                      @endphp
                      @foreach ($sessions as $session)
                        <tr>
                          <td class="text-center">{{ $no++ }}</td>
                          <td class="text-start">{{ $session->sesiKe }}</td>
                          <td class="text-center">{{ $session->waktuMulai->isoFormat('HH:mm') }} WIB</td>
                          <td class="text-center">{{ $session->waktuSelesai->isoFormat('HH:mm') }} WIB</td>
                          <td class="text-center">
                            <a href="/delete-session/{{ $session->id }}"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white"></i></button></a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              
              <div class="modal-footer" style="background: rgba(177, 227, 229, 0.37);">
                
              </div>
            </div>
            
          </div>
        </div>

        <div class="tab-pane fade show active w-100 ketersediaan" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="container mt-3">
            <div class="row d-flex justify-content-start mb-3">
              <div class="col-2">
                <button type="button" id="createSession" class="btn btn-primary btn-sm">Buat Sesi</button>
                {{-- <a href="/create-session"><button type="button" class="btn btn-primary btn-sm">Buat Sesi</button></a> --}}
              </div>
            </div>
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
            {{-- <div class="ketSesi mt-3 border rounded"> --}}
                {{-- <h5 class="text-center rounded-top py-3 mb-0" style="background: #d8f3d6">Pilihan Sesi</h5> --}}
                <div class="row px-0 py-3 d-flex">
                  @foreach ($sessions as $session)
                    <div class="col-4"><p class="my-2"><span><i class="bi bi-circle-fill me-2" style="font-size: 12px; color: #bfe9df"></i></span> {{ $session->sesiKe }} ({{ $session->waktuMulai->isoFormat('HH:mm') }} - {{ $session->waktuSelesai->isoFormat('HH:mm') }} WIB)</p></div>
                  @endforeach
                </div>
            {{-- </div> --}}
          </div>
        </div>
      </div>
    </div>
    
    {{-- Jadwal keseluruhan --}}
    <div class="jadwalKeseluruhan" style="margin-top: 100px">
      @if ($message = Session::get('addsuccess'))
        <div class="alert alert-success" role="alert">
          {{ $message }}
        </div>
      @elseif ($message = Session::get('adderror'))
        <div class="alert alert-danger" role="alert">
          {{ $message }}
        </div>
      @endif
      <ul class="nav nav-tabs flex-row justify-content-start jadwalAudit mt-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Linimasa</button>
        </li>
        <a href="jadwalauditAMI-tambahjadwal" class="ms-auto">
          <button type="button" class="btn btn-primary btn-sm my-2">Tambah Jadwal</button>
        </a>
      </ul>
      
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active w-100 my-3" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="row">
              <table class="table table-hover" id="tablejadwalkeseluruhanami">
                  <thead>
                      <tr class="mt-3">
                          <th class="col-1 text-center">No</th>
                          <th class="col-5 text-center">Kegiatan</th>
                          <th class="col-1 text-center">Tahun Periode</th>
                          <th class="col-3 text-center">Waktu</th>
                          <th class="col-2 text-center">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @php $no_ = 1; @endphp
                      @foreach ($jadwalami as $jdami)
                      <tr>
                        <th scope="row" class="text-center">{{ $no_++ }}</th>
                        <td>{{ $jdami->kegiatan }}</td>
                        <td class="col-1">{{ $jdami->th_ajaran1 }}/{{ $jdami->th_ajaran2 }}</td>
                        <td class="col-3 text-center">
                          @if ($jdami->tgl_mulai == $jdami->tgl_berakhir)
                            {{ $jdami->tgl_mulai->translatedFormat('l, d M Y') }}
                          @else
                            {{ $jdami->tgl_mulai->translatedFormat('l, d M Y') }} - {{ $jdami->tgl_berakhir->translatedFormat('l, d M Y') }}
                          @endif
                        </td>
                        <td class="text-center">
                          <a href="/editjadwalami-keseluruhan/{{ $jdami->id }}"><button class="bg-primary border-0 rounded-1"><i class="bi bi-pencil-square text-white" title="Edit"></i></button></a>
                          <a href="/deletejadwalami-keseluruhan/{{ $jdami->id }}" onclick="return confirm('Apakah Anda yakin akan menghapus jadwal AMI kegiatan {{ $jdami->kegiatan }}')"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white" title="Hapus"></i></button></a>
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
  
    
</div>

@endsection

@push('script')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Datatable plugin JS library file -->
<script
    type="text/javascript"
    src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"
></script>
<script>
    $(document).ready(function () {
        $("#tablejadwalaudit").DataTable({});
        $("#tablejadwalkeseluruhanami").DataTable({});
        $('#inputauditee').select2();
        $('#inputtahun').select2();
        $('#session').select2();
    });
</script>
<script>

  $(document).ready(function () {

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#tambahJadwalAudit').attr('hidden', true);

    $('#profile-tab').on('click', function() {
      $('#tambahJadwalAudit').attr('hidden', true);
    });

    $('#home-tab').on('click', function() {
      $('#tambahJadwalAudit').removeAttr('hidden');
    });

    var sortedEvents;
    var calendar = $('#calendar').fullCalendar({

        displayEventTime : false, 
        editable:true,
        header:{
            left:'prev,next',
            center:'title',
            right:'month'
        },
        eventOrder: 'session',
        events: '/ketersediaan-jadwal',
        eventRender: function(event, element) {
          console.log(event);
          if (event.peran == 'auditor') {
            $(element).find('.fc-content').css('background-color', '#367E18');
          } else if (event.peran == 'spm') {
            $(element).find('.fc-content').css('background-color', '#CC3636');
          } else if (event.peran == 'auditee') {
            $(element).find('.fc-content').css('background-color', '#187498');
          }

          $(element).find('.fc-title').append(' - ' + event.session);
        },
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
            console.log(event);
            var date = $.fullCalendar.formatDate(start, 'D MMMM Y');
            $('#bookingModal').modal('toggle');
            $('#dateInfo').html(date);
            
            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

              $('#saveBtn').off('click').on('click', function() {
                var title = $('#inisialnama').val();
                var session = $('#session').val();

                $.ajax({
                    url:"/ketersediaan-jadwal/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        session: session,
                        type: 'add'
                    },
                    success:function(data)
                    {
                        console.log(data);
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Created Successfully");
                        $("#inputKetersediaan").load(location.href + " #inputKetersediaan");
                    }
                })
                $("#form").load(location.href + " #form");

                $('#bookingModal').on('hidden.bs.modal', function (e) {
                  $('#inisialnama').val('');
                  $('#session').val('Pilih Sesi');
                });

                $('#bookingModal').modal('hide');
                
              });

              $('#cancelBtn').click(function() {
                $('#bookingModal').modal('hide');
              });
        },
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
                        alert("Event Deleted Successfully");
                    }
                })
            }
        }
    });


    $('#createSession').click(function() {
      $('#sessionModal').modal('toggle');
    });
    
    var max_fields = 50;
    var wrapper = $(".bodysession");
    var add_btn = $(".moreItems_add");
    var i = 1;
    $(('#moreItems_add')).click(function(e){
      e.preventDefault();
      if (i < max_fields) {
        i++;

        $(wrapper).append('<div class="row add-new"><div class="col"><label for="namasesi'+i+'">Sesi Ke-1</label><input type="text" class="form-control" id="namasesi'+i+'" placeholder="contoh: Sesi 1" name="addmore['+i+'][sesiKe]"></div><div class="col"><label for="waktuMulai'+i+'">Waktu Mulai</label><input type="time" class="form-control" id="waktuMulai'+i+'" placeholder="Waktu Mulai (WIB)" name="addmore['+i+'][waktuMulai]"></div><div class="col"><label for="waktuSelesai'+i+'">Waktu Selesai</label><input type="time" class="form-control" id="waktuSelesai'+i+'" placeholder="Waktu Selesai (WIB)" name="addmore['+i+'][waktuSelesai]"></div><div class="col-1 my-3 py-2"><button id="remove-tr" class="remove_tr btn btn-danger float-end" type="button"><i class="bi bi-x h5" style="color: #ffff"></i></button></div></div>')
      }
    });
  });

  $(document).on('click', '#remove-tr', function(){  
    $(this).parents('.add-new').remove();
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
    
@endpush
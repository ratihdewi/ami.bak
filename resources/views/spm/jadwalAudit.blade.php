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
    <div class="search my-5 p-5 mx-5 text-white rounded">
      <form action="searchjadwal" method="get">
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
  @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
      {{ $message }}
    </div>
  @elseif ($message = Session::get('error'))
  <div class="alert alert-danger" role="alert">
    {{ $message }}
  </div>
  @endif
  {{-- JadwalAudit --}}
  <div class="jadwalAudit mb-5" id="jadwaltop">
    <ul class="nav nav-tabs flex-row justify-content-start" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Jadwal Audit</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Ketersediaan Jadwal Auditor dan Auditee</button>
      </li>
      <a href="jadwalaudit-tambahjadwal" class="ms-auto">
        <button type="button" class="btn btn-primary btn-sm my-2">Tambah Jadwal</button>
      </a>
      
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active w-100 my-3" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <table class="table table-hover" id="tablejadwalaudit">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Auditee</th>
                        <th class="col-1 text-center">Auditor</th>
                        <th class="col-1 text-center">Tahun Ajaran</th>
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
                    @foreach ($auditee->jadwalaudit()->get() as $item)
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
                            <a href="/jadwalaudit-tampiljadwalaudit/{{ $item->id }}" class="mx-2"><button class="bg-primary border-0 rounded-1"><i class="bi bi-pencil-square text-white h7"></i></button></a>
                            <a href="/jadwalaudit-deletejadwalaudit/{{ $item->id }}"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white h7"></i></button></a>
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
                      <option value="{{ $session->sesiKe }}">{{ $session->sesiKe }} ({{ $session->waktuMulai->isoFormat('HH:mm') }} - {{ $session->waktuSelesai->isoFormat('HH:mm') }} WIB)</option>
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
                        <label for="namasesi">Sesi Ke-1</label>
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
                        <td class="text-center">{{ $session->waktuMulai }} WIB</td>
                        <td class="text-center">{{ $session->waktuSelesai }} WIB</td>
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

      <div class="tab-pane fade w-100" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container mt-3">
          <div class="row d-flex justify-content-start mb-3">
            <div class="col-2">
              <button type="button" id="createSession" class="btn btn-primary btn-sm">Buat Sesi</button>
              {{-- <a href="/create-session"><button type="button" class="btn btn-primary btn-sm">Buat Sesi</button></a> --}}
            </div>
          </div>
          <div id="calendar"></div>
          {{-- <div id="inputKetersediaan" class="inputKetersediaan mt-3 p-3 border rounded">
            <h5 class="fw-bold">Ketersediaan Jadwal</h5>
            <p id="dateInfo"></p>
            <form id="form">
              <input id="inputinisial" type="text" placeholder="Silahkan masukkan sesi menrut ketersediaan dan kesediaan Anda" class="w-100 border rounded">
              <div class="row" id="inputketersediaanjadwal">
                <div class="col">
                  <label for="inisialnama">Inisial Nama:</label>
                  <input type="text" class="form-control" id="inisialnama" placeholder="contoh: AN" name="title">
                </div>
                <div class="col mx-auto">
                  <label for="session" class="fw-bold" class="form-label">Sesi:</label><br>
                  <select id="session" class="form-select">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </div>

              <button type="button" id="saveBtn" class="btn btn-success btn-sm float-end mt-3 mx-1">Simpan</button>
              <button type="button" id="cancelBtn" class="btn btn-secondary btn-sm float-end mt-3 mx-1">Batal</button>
            </form>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
  
  {{-- Jadwal keseluruhan --}}
  <div class="jadwalKeseluruhan" style="margin-top: 100px">
    <ul class="nav nav-tabs flex-row justify-content-start jadwalAudit mt-5" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Jadwal Audit Mutu Internal</button>
      </li>
      <a href="jadwalauditAMI-tambahjadwal" class="ms-auto">
        <button type="button" class="btn btn-primary btn-sm my-2">Tambah Jadwal</button>
      </a>
    </ul>
    @if ($message = Session::get('addsuccess'))
      <div class="alert alert-success" role="alert">
        {{ $message }}
      </div>
    @elseif ($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
      {{ $message }}
    </div>
    @endif
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active w-100 my-3" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <table class="table table-hover" id="tablejadwalkeseluruhanami">
                <thead>
                    <tr class="mt-3">
                        <th class="col-1 text-center">No</th>
                        <th class="col-6 text-center">Kegiatan</th>
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
                      <td class="col-3 text-center">
                        @if ($jdami->tgl_mulai == $jdami->tgl_berakhir)
                          {{ $jdami->tgl_mulai->translatedFormat('l, d M Y') }}
                        @else
                          {{ $jdami->tgl_mulai->translatedFormat('l, d M Y') }} - {{ $jdami->tgl_berakhir->translatedFormat('l, d M Y') }}
                        @endif
                      </td>
                      <td class="text-center">
                        <a href="/editjadwalami-keseluruhan/{{ $jdami->id }}" class="me-2"><button class="bg-primary border-0 rounded-1"><i class="bi bi-pencil-square text-white"></i></button></a>
                        <a href="/deletejadwalami-keseluruhan/{{ $jdami->id }}"><button class="bg-danger border-0 rounded-1"><i class="bi bi-trash text-white"></i></button></a>
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
        events:'/ketersediaan-jadwal',
        eventRender: function(event, element) {
            // Menambahkan atribut tambahan ke tampilan acara
            $(element).find('.fc-title').append(' - ' + event.session);
        },
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
            var date = $.fullCalendar.formatDate(start, 'D MMMM Y');
            $('#bookingModal').modal('toggle');
            $('#dateInfo').html(date);
            
            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

              $('#saveBtn').click(function() {
                var title = $('#inisialnama').val();
                var session = $('#session').val();

                console.log(start);
                console.log(end);
                console.log(title);
                console.log(session);

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
              });

              $('#cancelBtn').click(function() {
                location.reload();
              })
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
        eventDrop: function(event)
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

    // $('#calendar').fullCalendar({
    //     displayEventTime : false
    // });

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
    
@endpush
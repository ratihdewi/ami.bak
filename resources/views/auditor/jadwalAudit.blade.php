@extends('auditor.main_') 

@section('title') AMI - Jadwal Audit @endsection

@section('linking')
  <a href="/auditor-jadwalaudit" class="mx-1">
    Jadwal Audit
  </a>/
@endsection

@section('container')

<div class="container vh-100 mt-4" style="font-size: 13px">
  {{-- Search Jadwal --}}
  <div class="search my-5 p-5 mx-5 text-white rounded">
    <form action="auditor_searchjadwal" method="get">
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
          <option value="{{ date('Y') }}">{{ date('Y') }}</option>
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
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Jadwal Audit</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Ketersediaan Jadwal Auditor dan Auditee</button>
      </li>
      
    </ul>
    @if ($message = Session::get('success'))
      <div class="alert alert-success" role="alert">
        {{ $message }}
      </div>
    @endif
    <div class="tab-content my-3" id="myTabContent">
      <div class="tab-pane fade show active w-100" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <table class="table table-hover mb-3 mt-3" id="jadwalaudit">
              <thead>
                  <tr>
                      <th class="col-1 text-center">No</th>
                      <th class="col-2 text-center">Auditee</th>
                      <th class="col-1 text-center">Auditor</th>
                      <th class="col-1 text-center">Tahun Ajaran</th>
                      <th class="col-2 text-center">Tempat</th>
                      <th class="col-2 text-center">Hari/Tanggal</th>
                      <th class="col-1 text-center">Waktu</th>
                      <th class="col-1 text-center">Kegiatan</th>
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
                        <td>{{ $item->waktu->isoFormat('HH:mm') }} WIB </td>
                        <td>{{ $item->kegiatan }}</td>
                    </tr>
                    @endforeach
                    @endforeach
              </tbody>
            </table>
        </div>
      </div>

      {{-- Ketersediaan Jadwal --}}
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

      <div class="tab-pane fade w-100" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container mt-3">
            <div id="calendar"></div>
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
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active w-100 my-4" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
          <table class="table table-hover my-3" id="tablejadwalkeseluruhan">
            <thead>
                <tr class="">
                    <th class="col-1 text-center">No</th>
                    <th class="col-3 text-center">Kegiatan</th>
                    <th class="col-3 text-center">Sub Kegiatan</th>
                    <th class="col-3 text-center">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @php $no_ = 1; @endphp
                @foreach ($jadwalami as $jdami)
                <tr>
                  <th scope="row" class="text-center">{{ $no_++ }}</th>
                  <td class="">{{ $jdami->kegiatan }}</td>
                  <td class="">{{ $jdami->subkegiatan }}</td>
                  <td class="col-3">{{ $jdami->tgl_mulai->translatedFormat('l, d M Y') }} - {{ $jdami->tgl_berakhir->translatedFormat('l, d M Y') }}</td>
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
        events:'/auditor_ketersediaan-jadwal',
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

  });
</script>

{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
      $('#jadwalaudit').DataTable();
      $('#tablejadwalkeseluruhan').DataTable()
      $('#inputauditee').select2();
      $('#inputtahun').select2();
      $('#session').select2();
  });
</script>
    
@endpush
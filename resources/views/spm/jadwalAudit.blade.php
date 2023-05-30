@extends('layout.main') 

@section('title') AMI - Jadwal Audit @endsection

@section('container')

<div class="container mt-4" style="font-size: 13px">
  {{-- Search Jadwal --}}
  <div class="search my-5 p-5 mx-5 text-white rounded">
    <form action="" method="get">
      @csrf
      <div class="input-group">
        <select class="form-select mx-2 border border-secondary rounded" id="inputGroupSelect04" aria-label="Example select with button addon">
          <option selected disabled>Filter Auditee</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        <select class="form-select mx-2 border border-secondary rounded" id="inputGroupSelect04" aria-label="Example select with button addon">
          <option selected disabled>Filter Tahun</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        <button class="btn btn-primary mx-2 border rounded" type="button">Cari</button>
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
      <a href="jadwalaudit-tambahjadwal" class="ms-auto">
        <button type="button" class="btn btn-primary btn-sm my-2">Tambah Jadwal</button>
      </a>
      
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active w-100" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Auditee</th>
                        <th class="col-2 text-center">Auditor</th>
                        <th class="col-1 text-center">Tempat</th>
                        <th class="col-2 text-center">Hari/Tanggal</th>
                        <th class="col-1 text-center">Waktu</th>
                        <th class="col-2 text-center">Kegiatan</th>
                        <th class="col-1 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp @foreach ($data as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td class="text-center">{{ $item->auditee }}</td>
                        <td class="text-center">{{ $item->auditor }}</td>
                        <td class="text-center">{{ $item->tempat }}</td>
                        <td class="text-center">{{ $item->hari_tgl->translatedFormat('l, d M Y') }}</td>
                        <td class="text-center">{{ $item->waktu }}</td>
                        <td class="text-center">{{ $item->kegiatan }}</td>
                        <td class="text-center">
                          <a href="#" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="#" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>

      {{-- Ketersediaan Jadwal --}}
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
      <a href="jadwalauditAMI-tambahjadwal" class="ms-auto">
        <button type="button" class="btn btn-primary btn-sm my-2">Tambah Jadwal</button>
      </a>
      
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active w-100" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <table class="table table-hover mt-2">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-3 text-center">Kegiatan</th>
                        <th class="col-3 text-center">Waktu</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no_ = 1; @endphp
                    <tr>
                        <th scope="row" class="text-center" value='{{ $no++ }}' >{{ $no_++ }}</th>
                        <td class="">Persiapan</td>
                        <td class="text-center">3 Oktober 2023</td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="deleteJadwalKeseluruhan" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center" value='2'>2</th>
                        <td class="">Pelatihan Auditor</td>
                        <td class="text-center">11 Oktober 2023</td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="deleteJadwalKeseluruhan" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    {{-- <tr>
                        <th scope="row" class="text-center"></th>
                        <td class="" id="kegiatan"></td>
                        <td class="text-center" id="waktu"></td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="btn btn-warning">Edit</a>
                          <a href="deleteJadwalKeseluruhan" class="btn btn-danger">Delete</a>
                        </td>
                    </tr> --}}
                    {{-- @foreach ($data as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td class="text-center">{{ $item->auditee }}</td>
                        <td class="text-center">{{ $item->auditor }}</td>
                        <td class="text-center">{{ $item->tempat }}</td>
                        <td class="text-center">{{ $item->hari_tgl->translatedFormat('l, d M Y') }}</td>
                        <td class="text-center">{{ $item->waktu }}</td>
                        <td class="text-center">{{ $item->kegiatan }}</td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
      </div>
      <div class="tab-panel fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
          <table class="table table-hover mt-2">
                <thead>
                    <tr class="">
                        <th class="col-1 text-center">No</th>
                        <th class="col-2 text-center">Kegiatan</th>
                        <th class="col-2 text-center">Waktu</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    <tr>
                        <th scope="row" class="text-center" value='{{ $no++ }}' >{{ $no++ }}</th>
                        <td class="">Persiapan</td>
                        <td class="text-center">3 Oktober 2023</td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="mx-2"><i class="bi bi-pencil-square"></i></a>
                          <a href="deleteJadwalKeseluruhan" class="mx-2"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center" value='{{ $no++ }}'>{{ $no++ }}</th>
                        <td class="">Pelatihan Auditor</td>
                        <td class="text-center">11 Oktober 2023</td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="btn btn-warning">Edit</a>
                          <a href="deleteJadwalKeseluruhan" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center"></th>
                        <td class="" id="kegiatan"></td>
                        <td class="text-center" id="waktu"></td>
                        <td class="text-center">
                          <a href="updateJadwalKeseluruhan" class="btn btn-warning">Edit</a>
                          <a href="deleteJadwalKeseluruhan" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    {{-- @foreach ($data as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td class="text-center">{{ $item->auditee }}</td>
                        <td class="text-center">{{ $item->auditor }}</td>
                        <td class="text-center">{{ $item->tempat }}</td>
                        <td class="text-center">{{ $item->hari_tgl->translatedFormat('l, d M Y') }}</td>
                        <td class="text-center">{{ $item->waktu }}</td>
                        <td class="text-center">{{ $item->kegiatan }}</td>
                    </tr>
                    @endforeach --}}
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
{{-- <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script> --}}
<script>
  $(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:'/ketersediaan-jadwal',
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
            var title = prompt('Initial Name:');

            if(title)
            {
                var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                $.ajax({
                    url:"/ketersediaan-jadwal/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    success:function(data)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Created Successfully");
                    }
                })
            }
        },
        editable:true,
        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/ketersediaan-jadwal/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
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
        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/ketersediaan-jadwal/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
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
    
@endpush
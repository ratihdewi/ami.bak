@extends('layout.main') 

@section('title') AMI - Jadwal Audit @endsection

@section('linking')
  <a href="/jadwalaudit" class="mx-1">
    Jadwal Audit
  </a>/
@endsection

@section('container')

<div class="container vh-100 mt-4" style="font-size: 13px">
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
      <div class="tab-pane fade w-100" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container mt-3">
            <div id="calendar"></div>
            {{-- <div id="inputKetersediaan" class="inputKetersediaan mt-3 p-3 border rounded">
              <h5 class="fw-bold">Ketersediaan Jadwal</h5>
              <p id="dateInfo">15 Juni</p>
              <form action="">
                <input type="text" placeholder="Silahkan masukkan sesi menrut ketersediaan dan kesediaan Anda" class="w-100 border rounded">

                <button type="button" class="btn btn-success btn-sm float-end mt-3 mx-1">Simpan</button>
                <button type="button" class="btn btn-danger btn-sm float-end mt-3 mx-1">Batal</button>
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
                        <th class="col-3 text-center">Kegiatan</th>
                        <th class="col-3 text-center">Sub Kegiatan</th>
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
                      <td>{{ $jdami->subkegiatan }}</td>
                      <td class="col-3">{{ $jdami->tgl_mulai->translatedFormat('l, d M Y') }} - {{ $jdami->tgl_berakhir->translatedFormat('l, d M Y') }}</td>
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
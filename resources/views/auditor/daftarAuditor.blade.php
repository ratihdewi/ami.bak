
@extends('auditor.main_') 

@section('title') AMI - Daftar Auditor @endsection

@section('linking')
    <a href="/auditor-daftarauditor-periode" class="mx-1">
        Periode Auditor
    </a>/
    @foreach ($periodes as $auditor)
    <a href="/auditor-daftarauditor/{{ $auditor->tahunperiode2 }}" class="mx-1">
    @endforeach
    @foreach ($periodes as $auditor)
    {{ $auditor->tahunperiode1 }}/{{ $auditor->tahunperiode2 }}
    @endforeach
    </a>/
@endsection

@section('container')


<div class="container vh-100 mt-5 mb-4"  style="font-size: 15px">
    <div class="row">
        <table class="table table-hover mt-5 mb-3" id="tableAuditor">
            <thead>
                <tr class="">
                    <th class="col-1 text-center">  No  </th>
                    <th class="col-2 text-center">  Nama  </th>
                    <th class="col-1 text-center">  NIP  </th>
                    <th class="col-2 text-center">  Program Studi/Fungsi  </th>
                    <th class="col-2 text-center">  Fakultas/Fakultas/Rektorat  </th>
                    <th class="col-2 text-center">  Nomor Telepon  </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;    
                @endphp
                @foreach ($dataAuditor as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $no++ }}</th>
                        <td>{{ $item->nama }}</td>
                        <td class="text-center">{{ $item->nip }}</td>
                        <td>
                            {{ $item->program_studi }}
                            @if (($item->user->unitkerja_id2 != null || $item->user->unitkerja_id2 != '') && ($item->user->unitkerja_id3 == null || $item->user->unitkerja_id3 == ''))
                                @foreach ($unitkerja->where('id', $item->user->unitkerja_id2) as $unitkerja2)
                                    ;<br>{{ $unitkerja2->name }}
                                @endforeach
                            @elseif (($item->user->unitkerja_id2 != null || $item->user->unitkerja_id2 != '') && ($item->user->unitkerja_id3 != null || $item->user->unitkerja_id3 != ''))
                                @foreach ($unitkerja->where('id', $item->user->unitkerja_id2) as $unitkerja2)
                                    ;<br>{{ $unitkerja2->name }}
                                @endforeach

                                @foreach ($unitkerja->where('id', $item->user->unitkerja_id3) as $unitkerja3)
                                    ;<br>{{ $unitkerja3->name }}
                                @endforeach
                            @endif
                        </td>
                        <td>
                            {{ $item->fakultas }}
                            @if (($item->user->unitkerja_id2 != null || $item->user->unitkerja_id2 != '') && ($item->user->unitkerja_id3 == null || $item->user->unitkerja_id3 == ''))
                                @foreach ($unitkerja->where('id', $item->user->unitkerja_id2) as $unitkerja2)
                                    ;<br>{{ $unitkerja2->fakultas }}
                                @endforeach
                            @elseif (($item->user->unitkerja_id2 != null || $item->user->unitkerja_id2 != '') && ($item->user->unitkerja_id3 != null || $item->user->unitkerja_id3 != ''))
                                @foreach ($unitkerja->where('id', $item->user->unitkerja_id2) as $unitkerja2)
                                    ;<br>{{ $unitkerja2->fakultas }}
                                @endforeach

                                @foreach ($unitkerja->where('id', $item->user->unitkerja_id3) as $unitkerja3)
                                    ;<br>{{ $unitkerja3->fakultas }}
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">{{ $item->noTelepon }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('script')
    <!-- jQuery library file -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  
      <!-- Datatable plugin JS library file -->
     <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableAuditor').DataTable({ });
        });
    </script>
@endpush
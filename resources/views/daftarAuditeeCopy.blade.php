@extends('layout.main') @section('title') AMI - Daftar Auditee @endsection
@section('container')
<?php echo "Daftar Auditee Copy"; ?>
<a
    href="addAuditor"
    class="text-white"
    style="font-weight: 600; text-decoration: none"
    ><button type="button" class="btn btn-primary btn-sm float-end my-4 px-3">
        Tambah
    </button></a
>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIP</th>
            <th scope="col">Program Studi</th>
            <th scope="col">Fakultas</th>
            <th scope="col">Nomor Telepon</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Alfiana Permata Sari, M.Sc</td>
            <td>119123</td>
            <td>Teknik Perminyakan</td>
            <td>Teknologi Eksplorasi dan Produksi</td>
            <td>082312345678</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Nona Merry Merpati Mitan, Ph.D</td>
            <td>119124</td>
            <td>Hubungan Internasional</td>
            <td>Komunikasi dan Diplomasi</td>
            <td>082356781234</td>
        </tr>
    </tbody>
</table>
@endsection

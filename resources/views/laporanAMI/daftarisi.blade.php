<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" type="text/css" href="{{ public_path('bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ public_path('bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ public_path('css/export.css') }}">
    <title>Laporan AMI - Daftar Isi</title>
</head>
<body>
    <div class="container-daftarisi mx-4 my-5">
        <div id="daftarisi" class="daftarisi my-3 mx-4 py-2">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="d-flex justify-content-center py-4 text-center">
                            <img src="{{ public_path('asset/Logo-Up.png') }}" alt="logo-uper" width="120">
                        </td>
                        <td colspan="4" class="infouper px-4 py-2">
                            <h4 class="my-3"><b>UNIVERSITAS PERTAMINA</b></h4>
                            <p class="my-3">
                                Jalan Teuku Nyak Arief, Simprug, <br>
                                Kebayoran Lama, Jakarta Selatan, 12220 <br>
                                Telp. (021) 50857540
                            </p>
                        </td>
                    </tr>
                    <tr class="secondrow fw-bold">
                        <td rowspan="2" class="text-center align-middle col-2">FORMULIR</td>
                        <td class="col-md-2">KODE</td>
                        <td class="col-md-"></td>
                        <td class="col-md-2">TGL. BERLAKU</td>
                        <td class="col-md-"></td>
                    </tr>
                    <tr class="fw-bold">
                        <td>REVISI KE-</td>
                        <td></td>
                        <td>TGL. REVISI</td>
                        <td></td>
                    </tr>
                    <tr class="fw-bold">
                        <td colspan="5" class="text-center opacity-50">(Judul Dokumen)</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="daftarisi-body" class="daftarisi-body">
            <h2>DAFTAR ISI</h2>
        </div>
    </div>
</body>
</html>
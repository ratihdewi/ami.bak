<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ public_path('bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ public_path('css/laporanAMI.css') }}">
    <title>Laporan AMI - Tujuan Audit</title>
</head>
<body>
    <div class="container-tujuanaudit mx-4 my-5">
        @include('laporanAMI.header-laporan')
        <div id="tujuanaudit-body" class="tujuanaudit-body mx-0">
            <h2>II. <span class="ms-5">TUJUAN AUDIT</span></h2>
        </div>
    </div>
</body>
</html>
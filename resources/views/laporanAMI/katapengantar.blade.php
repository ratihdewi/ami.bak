<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ public_path('bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ public_path('css/laporanAMI.css') }}">
    <title>Laporan AMI - Kata Pengantar</title>
</head>
<body>
    <div class="container-katapengantar mx-4 my-5">
        @include('laporanAMI.header-laporan')
        <div id="katapengantar-body" class="katapengantar-body">
            <h2 class="text-center">KATA PENGANTAR</h2>
        </div>
    </div>
</body>
</html>
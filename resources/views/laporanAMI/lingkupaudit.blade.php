<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ public_path('bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ public_path('css/laporanAMI.css') }}">
    <title>Laporan AMI - Lingkup Audit</title>
</head>
<body>
    <div class="container-lingkupaudit mx-4 my-5">
        @include('laporanAMI.header-laporan')
        <div id="lingkupaudit-body" class="lingkupaudit-body mx-0">
            <h2>III. <span class="ms-5">LINGKUP AUDIT</span></h2>
        </div>
    </div>
</body>
</html>
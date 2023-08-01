<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berita Acara AMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body class=" bg-secondary">
    <div class="container text-white">
        <h2 class="text-center my-5"><b><u>AMI - Universitas Pertamina</u></b></h2>
        <h4 class="my-3">QR - Detail Persetujuan</h4>
        <table class="table table-borderless border-top mb-5">
            <tbody>
                <tr>
                    <td class="text-white text-start">Perihal</td>
                    <td class="text-white text-end">Audit Lapangan - {{ $auditee->unit_kerja }} ({{ $auditee->tahunperiode }})</td>
                </tr>
                <tr>
                    <td class="text-white text-start">Disetujui oleh:</td>
                    <td class="text-white text-end">{{ $auditee->ketua_auditor }} ({{ $user->jabatan }})</td>
                </tr>
                <tr>
                    <td class="text-white text-start">Disetujui pada:</td>
                    <td class="text-white text-end">{{ $auditee->updated_at }}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <a href="{{ route('login') }}"><button type="button" class="btn btn-primary">Lihat Rincian</button></a>
        </div>
        
    </div>
    <footer class="text-center mt-5">AMI - Universitas Pertamina</footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
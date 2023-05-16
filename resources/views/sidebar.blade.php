<!DOCTYPE html>
<html lang="en">
@include('inc.head')

<body>
  <body id="body-pd">
    @include('inc.navbar')
    <!--Container Main start-->
    <div id="main-container" class="container height-100 border rounded">
      <button>
        Tambah Auditor
      </button>
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
    </div>
    <!--Container Main end-->
</body>
</html>
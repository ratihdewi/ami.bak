
<!DOCTYPE html>
<html lang="en">
  <head>
    @include('inc.head')
    <title>AMI - Daftar Auditee</title>
  </head>
<body>
  <body id="body-pd">
    
    @include('inc.nav_auditee')
    <!--Container Main start-->
    <div id="main-container" class="container height-100 border rounded">
      <a
      href="addAuditee"
      class="text-white"
      style="font-weight: 600; text-decoration: none"
      ><button type="button" class="btn btn-primary btn-sm float-end my-4 px-3">
          Tambah
      </button>
      </a>
      <table class="table table-hover">
        <thead>
            <tr class="d-flex">
                <th class="col-1 text-center">  No  </th>
                <th class="col-3 text-center">  Ketua Auditee  </th>
                <th class="col-3 text-center">  Jabatan Ketua Auditee  </th>
                <th class="col-2 text-center">  Ketua Auditor  </th>
                <th class="col-3 text-center">  Anggota Auditor  </th>
            </tr>
        </thead>
        <tbody>
            <tr class="d-flex">
                <td class="col-1 text-center">1</td>
                <td class="col-3">Raka Sudira Wanara, M.T</td>
                <td class="col-3">Ketua Program Studi Teknik Perminyakan</td>
                <td class="col-2">Rinaldi M Rachman, M.S</td>
                <td class="col-3">Evi Siti Sofiyah, Ph.D</td>
            </tr>
            <tr class="d-flex">
              <th class="col-1 text-center"></th>
              <td class="col-3"></td>
              <td class="col-3"></td>
              <td class="col-2"></td>
              <td class="col-3">Fatimah DInan Q., M.T</td>
            </tr>
            
        </tbody>
    </table>
    </div>
    <!--Container Main end-->
</body>
</html>
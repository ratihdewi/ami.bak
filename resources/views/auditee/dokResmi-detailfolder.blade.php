@extends('auditee.main_')

@section('title')
    AMI - Dokumen Resmi
@endsection

@section('linking')
    <a href="/dokumenresmiAMI-auditee-folderall" class="mx-1">
        Dokumen Resmi AMI
    </a>/
    {{-- <a href="/dokumenresmiAMI-spm-folderall" class="mx-1"> --}}
        {{ $folders->folderName }}
    {{-- </a> --}}
@endsection

@section('container')
<div class="container pt-5" style="min-height: 100vh">
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="buton-addFile" id="button-addFile" hidden>
      <button type="button" class="btn btn-primary btn-sm float-end mb-3" data-bs-toggle="modal" data-bs-target="#newFile">Tambah File</button>
      {{-- <input class="form-control btn btn-primary btn-sm mb-3" type="file" id="formFileMultiple" multiple> --}}
    </div>
    <div class="table-file mb-5" id="table-file">
      <table class="table table-hover my-3" id="table-files">
        <thead>
          <tr>
            <th class="col-1 text-center">No</th>
            <th class="text-center">Nama File</th>
            <th class="col-3 text-center">Terakhir diedit</th>
            <th class="col-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @foreach ($files as $files)
            <tr>
              <td class="text-center fw-semibold">{{ $no++ }}</td>
              <td class="fw-semibold">{{ $files->fileName }}</td>
              <td class="text-center">{{ $files->updated_at->translatedFormat('d M Y H:m:s') }}</td>
              <td class="text-center">
                <button type="button" id="editmodalfolder" class="btn btn-primary btn-sm p-0"data-bs-toggle="modal" data-bs-target="#editFile" onclick="editmodal({{ $files->id }})" title="Rename" disabled><i class="bi bi-pencil-square text-white mx-1 my-2 h5"></i></button>
                <a href="/dokumenresmiAMI-readfile/{{ $files->id }}" target="_blank"><button class="btn btn-warning btn-sm p-0" title="Edit"><i class="bi bi-file-earmark-fill text-white mx-1 my-2 h5"></i></button></a>
                <a href="/dokumenresmiAMI-spm-folderdetail-delete/{{ $files->id }}" onclick="return confirm('Apakah Anda yakin akan menghapus folder {{ $files->fileName }} ?')" hidden><button class="btn btn-danger btn-sm p-0" title="Hapus"><i class="bi bi-trash-fill text-white mx-1 my-2 h5"></i></button></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="newFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="/dokumenresmiAMI-addnewfile" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header border border-bottom-0">
            <h1 class="modal-title fs-5" id="newFileLabel">File Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <input class="form-control mb-3" type="text" placeholder="folder_id" aria-label="folder_id" name="folderdokresmi_id" value="{{ $folders->id }}" hidden>
            <input class="form-control mb-3" type="text" placeholder="Nama file" aria-label="Nama file example" name="fileName">

            <input class="form-control btn-sm" type="file" id="formFileMultipleDokResmi" name="file" accept=".csv, .xlsx, .xls, .pdf, .docx" required multiple hidden>

            <div class="labelspan-newfile py-2 rounded px-2 border">
                <!-- our custom upload button -->
                <label class="label-uploaddokresmi bg-secondary mt-0" for="formFileMultipleDokResmi">Upload File</label>

                <!-- name of file chosen -->
                <span id="file-chosen">No file chosen</span>
            </div>
          </div>
          <div class="modal-footer border border-top-0">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Buat</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal" id="editFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="renameEditFile" action="/dokumenresmiAMI-spm-folderdetail-update" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header border border-bottom-0">
            <h1 class="modal-title fs-5" id="editFileLabel">Rename</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <input class="form-control mb-3" type="text" placeholder="folder_id" aria-label="folder_id" name="folderdokresmi_id" value="{{ $folders->id }}" hidden>
            <input id="fileName" class="form-control" type="text" placeholder="Nama file" aria-label="Nama file example" name="fileName">

            {{-- <input class="form-control btn-sm" type="file" id="formEditFileMultipleDokResmi" name="file" accept=".csv, .xlsx, .xls, .pdf, .docx" required multiple hidden>

            <div class="labelspan-newfile py-2 rounded px-2 border">
                <label class="label-uploaddokresmi bg-secondary mt-0" for="formEditFileMultipleDokResmi">Upload File</label>
                <span id="editfile-chosen">No file chosen</span>
            </div> --}}
          </div>
          <div class="modal-footer border border-top-0">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ok</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#table-files').DataTable();

      $('#button-addFolder').on('click', function() {
        console.clear();
      });

      const actualBtn = document.getElementById('formFileMultipleDokResmi');
      
      const fileChosen = document.getElementById('file-chosen');
      
      actualBtn.addEventListener('change', function(){
        fileChosen.textContent = this.files[0].name
      });
      
    });

    function editmodal(id) {
      console.clear();      
      $.ajax({
          url: "{{url('/dokumenresmiAMI-spm-folderdetail-edit')}}/"+ id,
          type: 'GET',
          dataType: 'json',
          data: { q: '' },
          success: function(data) {
              console.log(data);
              $('#fileName').val(data.fileName);

              var modified = '/dokumenresmiAMI-spm-folderdetail-update/'+data.id;
              $('#renameEditFile').attr('action', modified);
              
          },
          error: function() {
              console.error('Terjadi kesalahan saat memuat data users.');
          }
      });
    }
  </script>
@endpush
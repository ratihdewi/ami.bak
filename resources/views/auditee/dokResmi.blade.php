@extends('auditee.main_')

@section('title')
    AMI - Dokumen Resmi
@endsection

@section('linking')
    {{-- <a href="/daftarAuditor-periode" class="mx-1"> --}}
        Dokumen Resmi AMI
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
    <div class="buton-addFolder" id="button-addFolder" hidden>
      <button type="button" class="btn btn-primary btn-sm float-end mb-3" data-bs-toggle="modal" data-bs-target="#newFolder">Tambah Folder</button>
    </div>
    <div class="table-folder mb-5" id="table-folder">
      <table class="table table-hover my-3" id="table-folders">
        <thead>
          <tr>
            <th class="col-1 text-center">No</th>
            <th class="text-center">Nama</th>
            <th class="col-3 text-center">Terakhir diedit</th>
            <th class="col-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @foreach ($dokFolder as $folder)
            <tr>
              <td class="text-center fw-semibold">{{ $no++ }}</td>
              <td class="fw-semibold">{{ $folder->folderName }}</td>
              <td class="text-center">{{ $folder->updated_at->translatedFormat('d M Y H:m:s') }}</td>
              <td class="text-center">
                <button type="button" id="editmodalfolder" class="btn btn-primary btn-sm p-0"data-bs-toggle="modal" data-bs-target="#editFolder" onclick="editmodal({{ $folder->id }})" title="Rename" disabled><i class="bi bi-pencil-square text-white mx-1 my-2 h5"></i></button>
                <a href="/dokumenresmiAMI-auditee-folderall-detail/{{ $folder->id }}"><button class="btn btn-warning btn-sm p-0" title="Buka"><i class="bi bi-folder-fill text-white mx-1 my-2 h5"></i></button></a>
                <a href="/dokumenresmiAMI-spm-folderall-delete/{{ $folder->id }}" onclick="return confirm('Apakah Anda yakin akan menghapus folder {{ $folder->folderName }} ?')" hidden><button class="btn btn-danger btn-sm p-0" title="Hapus" disabled><i class="bi bi-trash-fill text-white mx-1 my-2 h5"></i></button></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="newFolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newFolderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="/dokumenresmiAMI-addnewfolder" method="POST">
          @csrf
          <div class="modal-header border border-bottom-0">
            <h1 class="modal-title fs-5" id="newFolderLabel">Folder Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input class="form-control" type="text" id="addNewFolder" placeholder="Folder baru" name="folderName" aria-label="default input example">
          </div>
          <div class="modal-footer border border-top-0">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Buat</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal" id="editFolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newFolderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="renameFolderForm" action="/dokumenresmiAMI-updatefolder" method="POST">
          @csrf
          <div class="modal-header border border-bottom-0">
            <h1 class="modal-title fs-5" id="newFolderLabel">Rename</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input class="form-control" type="text" id="renameFolder" placeholder="Folder baru" name="folderName" aria-label="default input example">
          </div>
          <div class="modal-footer border border-top-0">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Buat</button>
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
      $('#table-folders').DataTable();

      $('#button-addFolder').on('click', function() {
        console.clear();
      });
      
    });

    function editmodal(id) {
      console.clear();      
      $.ajax({
          url: "{{url('/dokumenresmiAMI-spm-folderall-edit')}}/"+ id,
          type: 'GET',
          dataType: 'json',
          data: { q: '' },
          success: function(data) {
              console.log(data);
              $('#renameFolder').val(data.folderName);

              var modified = '/dokumenresmiAMI-updatefolder/'+data.id;
              $('#renameFolderForm').attr('action', modified);
              
          },
          error: function() {
              console.error('Terjadi kesalahan saat memuat data users.');
          }
      });
    }
  </script>
@endpush
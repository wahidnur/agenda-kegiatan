@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar User</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                        Tambah Data
                      </button>
                    <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Kegiatan</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Berkas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah-->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" id="tutup1" aria-label="Close"></button>
        </div>
        <form id="submit-data">
        @csrf
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control bg-white" name="tanggal">
                        <span class="text-danger error-text pesan1 tanggal_error mb-2">&nbsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Kegiatan</label>
                        <textarea class="form-control bg-white" name="kegiatan" rows="3" cols="50"></textarea>
                        <span class="text-danger error-text pesan1 kegiatan_error mb-2">&nbsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">Jam</label>
                        <input type="time" class="form-control bg-white" name="jam">
                        <span class="text-danger error-text pesan1 jam_error mb-2">&nbsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Lokasi</label>
                        <textarea class="form-control bg-white" name="lokasi" rows="3" cols="50"></textarea>
                        <span class="text-danger error-text pesan1 lokasi_error mb-2">&nbsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10">
                        <label for="">Berkas(csv, doc, docx, ppt, pptx, xlx, xls, pdf, rar, zip)*</label>
                        <input type="file" class="form-control bg-white" name="berkas">
                        <span class="text-danger error-text pesan1 berkas_error mb-2">&nbsp;</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <span id="pesan" class="text-success" style="position:absolute;left: 25px;"></span>
            <button type="button" class="btn btn-secondary" id="tutup2" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="save-tambah">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit-->
  <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
          <button type="button" class="btn-close" id="tutup3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateData">
        @csrf
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <label for="">Tanggal</label>
                        <input type="hidden" id="idJadwal">
                        <input type="date" class="form-control bg-white dua" name="tanggals" id="tanggal">
                        <span class="text-danger error-text pesan2 tanggals_err mb-2">&nbsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Kegiatan</label>
                        <textarea class="form-control bg-white" name="kegiatans"  rows="2" cols="50" id="kegiatan"></textarea>
                        <span class="text-danger error-text pesan2 kegiatans_err mb-2">&nbsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">Jam</label>
                        <input type="time" class="form-control bg-white dua" name="jams" id="jam">
                        <span class="text-danger error-text pesan2 jams_err mb-2">&nbsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Lokasi</label>
                        <textarea class="form-control bg-white" name="lokasis" rows="2" cols="50" id="lokasi"></textarea>
                        <span class="text-danger error-text pesan2 lokasis_err mb-2">&nbsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10">
                        <label for="">Berkas(csv, doc, docx, ppt, pptx, xlx, xls, pdf, rar, zip)*</label>
                        <input type="file" class="form-control bg-white dua" name="berkass" id="berkas">
                        <span class="text-danger error-text pesan2 berkass_err mb-2">&nbsp;</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="tutup4" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function () {
   var  table = $('#tbl_list').DataTable({
        processing: true,
        serverSide: true,
        filter:true,
        ajax: '{{ url()->current() }}',
        columns: [
            { data: 'tanggal', name: 'tanggal' },
            { data: 'jam', name: 'jam' },
            { data: 'kegiatan', name: 'kegiatan' },
            { data: 'lokasi', name: 'lokasi' },
            { data: 'berkas', name: 'berkas' },
            { data: 'aksi' }
        ]
    });

    $('#submit-data').on('submit', function(e){
        $('.pesan1').html('&nbsp;');
        $.ajax({
            url: '{{ route("simpan") }}',
            type: 'POST',
            enctype: 'multipart/form-data', // untuk input tipe file
            data: new FormData( this ),// untuk input tipe file
            processData: false, // untuk input tipe file
            contentType: false, // untuk input tipe file
            success: function(data){
                if(data.errors){
                    $.each(data.errors, function(key, value){
                        $('span.'+key+'_error').text(value[0]); // untuk validator dengan ajax
                    });
                }else{
                    confirm(data.success);
                    table.ajax.reload();
                    $('#submit-data')[0].reset();
                }
            }
        });
        e.preventDefault();
    });

    $('#updateData').on('submit', function(e){
        $('.pesan2').html('&nbsp;');
        $.ajax({
            url: 'home/update/'+$('#idJadwal').val(),
            type: 'POST',
            method: 'POST',
            data: new FormData( this ),
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function(data){
                if(data.errors){
                    $.each(data.errors, function(keys, values){
                        $('span.'+keys+'_err').text(values[0]); // untuk validator dengan ajax
                    });
                }else{
                    confirm(data.success);
                    table.ajax.reload();
                }
            }
        });
        e.preventDefault();
    });

    $('#tutup1').on('click', function(){
        $('.pesan1').html('&nbsp;');
    });
    $('#tutup2').on('click', function(){
        $('.pesan1').html('&nbsp;');
    });
    $('#tutup3').on('click', function(){
        $('.pesan2').html('&nbsp;');
        $('.dua').val('');
        $('#kegiatan').text('');
        $('#lokasi').text('');
    });
    $('#tutup4').on('click', function(){
        $('.pesan2').html('&nbsp;');
        $('.dua').val('');
        $('#kegiatan').text('');
        $('#lokasi').text('');
    });
 });
function editData(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'home/edit/'+id,
        type: 'GET',
        data: {
            id: id,
            _token: $("input[name='_token']").val()
        },
        success: function(res){
            $('#idJadwal').val(res[1].id);
            $('#tanggal').val(res[1].tanggal);
            $('#kegiatan').val(res[1].kegiatan);
            $('#jam').val(res[1].jam);
            $('#lokasi').val(res[1].lokasi);
        }
    });
}

function hapusData(id){
    if(confirm("Ingin dihapus?")){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: 'home/delete/'+id,
            type: 'DELETE',
            data: {
                _token: $("input[name='_token']").val()
            },
            success: function(response){
                $('#sid'+id).remove();
            }
        });
    }
}
</script>
@endpush
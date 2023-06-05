@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Input Agenda') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" style="padding:7px 9px;" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                      <form action="{{ route('simpan') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col-3">
                            <label for="">Jam</label>
                            <input type="time" class="form-control" name="jam" required>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col">
                            <label for="">Kegiatan</label>
                            <textarea type="time" class="form-control" name="kegiatan" id="editor"></textarea>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-sm-8"></div>
                          <div class="col-sm-2">
                            <a href="{{ route('home') }}" class="btn btn-light border border-secondary">Kembali</a>
                          </div>
                          <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    CKEDITOR.replace('editor');
</script>
@endsection

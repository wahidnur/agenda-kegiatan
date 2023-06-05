@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Button trigger modal -->
                    <a href="{{ route('tambah') }}" class="btn btn-primary">
                        Tambah
                    </a>
                    <table class="table table-stripped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                            @foreach($datas as $data)
                            <tr>
                                <td scope="row">{{ $index++ }}</td>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ $data->jam }}</td>
                                <td>{!! $data->kegiatan !!}</td>
                                <td>
                                    <button class="btn btn-info">Edit</button>
                                    <button class="btn btn-danger">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

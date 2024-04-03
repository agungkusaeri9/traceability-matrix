@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Edit Repository</h4>
                    <form action="{{ route('repository.update', $item->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class='form-group mb-3'>
                            <label for='nama_dokumen' class='mb-2'>Nama Dokumen</label>
                            <input type='text' name='nama_dokumen'
                                class='form-control @error('nama_dokumen') is-invalid @enderror'
                                value='{{ $item->nama_dokumen ?? old('nama_dokumen') }}'>
                            @error('nama_dokumen')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='deskripsi' class='mb-2'>Deskripsi</label>
                            <textarea name='deskripsi' id='deskripsi' cols='30' rows='3'
                                class='form-control @error('deskripsi') is-invalid @enderror'>{{ $item->nama_dokumen ?? old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='file' class='mb-2'>File</label>
                            <input type='file' name='file' id='file'
                                class='form-control @error('file') is-invalid @enderror' value='{{ old('file') }}'>
                            @error('file')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('repository.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Update Repository</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

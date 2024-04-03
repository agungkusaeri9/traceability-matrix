@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Edit Fitur</h4>
                    <form action="{{ route('skenario.update', $item->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class='form-group mb-3'>
                            <label for='nama_project' class='mb-2'>Project</label>
                            <input type='text' name='nama_project' id='nama_project'
                                class='form-control @error('nama_project') is-invalid @enderror'
                                value='{{ $item->fitur->project->nama ?? old('nama_project') }}' readonly>
                            @error('nama_project')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='nama_fitur' class='mb-2'>Fitur</label>
                            <input type='text' name='nama_fitur' id='nama_fitur'
                                class='form-control @error('nama_fitur') is-invalid @enderror'
                                value='{{ $item->fitur->nama ?? old('nama_fitur') }}' readonly>
                            @error('nama_fitur')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='nama' class='mb-2'>Nama</label>
                            <input type='text' name='nama' class='form-control @error('nama') is-invalid @enderror'
                                value='{{ $item->nama ?? old('nama') }}'>
                            @error('nama')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('skenario.index', [
                                'fitur_uuid' => $item->fitur->uuid,
                            ]) }}"
                                class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Update Fitur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

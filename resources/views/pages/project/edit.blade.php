@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Edit Project</h4>
                    <form action="{{ route('project.update', $item->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
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
                        <div class='form-group mb-3'>
                            <label for='assign_date' class='mb-2'>Assign Date</label>
                            <input type='date' name='assign_date' id='assign_date'
                                class='form-control @error('assign_date') is-invalid @enderror'
                                value='{{ $item->assign_date->translatedFormat('Y-m-d') ?? old('assign_date') }}'>
                            @error('assign_date')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='deskripsi' class='mb-2'>Deskripsi</label>
                            <textarea name='deskripsi' id='deskripsi' cols='30' rows='3'
                                class='form-control @error('deskripsi') is-invalid @enderror'>{{ $item->deskripsi ?? old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group'>
                            <label for='status'>Status</label>
                            <select name='status' id='status'
                                class='form-control @error('status') is-invalid @enderror'>
                                <option value='' selected disabled>Pilih Status</option>
                                <option @selected($item->status == 0) value="0">ON PROGRESS</option>
                                <option @selected($item->status == 1) value="1">DONE</option>
                            </select>
                            @error('status')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('project.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Update Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

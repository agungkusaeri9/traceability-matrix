@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Fitur</h4>
                    <form
                        action="{{ route('fitur.store', [
                            'project_uuid' => $project_uuid,
                        ]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class='form-group'>
                            <label for='project_id'>Project</label>
                            <select name='project_id' id='project_id'
                                class='form-control @error('project_id') is-invalid @enderror'>
                                <option value='' selected disabled>Pilih Project</option>
                                @foreach ($data_project as $project)
                                    <option @selected($project->uuid == $project_uuid) @selected($project->id == old('project_id'))
                                        value='{{ $project->id }}'>{{ $project->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='nama' class='mb-2'>Nama</label>
                            <input type='text' name='nama' class='form-control @error('nama') is-invalid @enderror'
                                value='{{ old('nama') }}'>
                            @error('nama')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('fitur.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Tambah Fitur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

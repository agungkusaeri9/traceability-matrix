@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Bug Report</h4>
                    <form action="{{ route('bug-report.update', $item->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class='form-group mb-3'>
                            <label for='project' class='mb-2'>Project</label>
                            <input type='text' name='' id='project'
                                class='form-control @error('project') is-invalid @enderror'
                                value='{{ $item->project->nama ?? old('project') }}' readonly>
                            @error('project')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='fitur' class='mb-2'>Fitur</label>
                            <input type='text' name='' id='fitur'
                                class='form-control @error('fitur') is-invalid @enderror'
                                value='{{ $item->fitur->nama ?? old('fitur') }}' readonly>
                            @error('fitur')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='temuan' class='mb-2'>Temuan</label>
                            <input type='text' name='temuan' id='temuan'
                                class='form-control @error('temuan') is-invalid @enderror'
                                value='{{ $item->temuan ?? old('temuan') }}'>
                            @error('temuan')
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
                        <div class='form-group mb-3'>
                            <label for='link' class='mb-2'>Link</label>
                            <input type='text' name='link' id='link'
                                class='form-control @error('link') is-invalid @enderror'
                                value='{{ $item->link ?? old('link') }}'>
                            @error('link')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('bug-report.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Update Bug Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

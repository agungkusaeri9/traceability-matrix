@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Bug Report</h4>
                    <form action="{{ route('bug-report.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class='form-group'>
                            <label for='project_id'>Project</label>
                            <select name='project_id' id='project_id'
                                class='form-control @error('project_id') is-invalid @enderror'>
                                <option value='' selected disabled>Pilih Project</option>
                                @foreach ($data_project as $project)
                                    <option @selected($project->id == old('project_id')) value='{{ $project->id }}'>{{ $project->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group'>
                            <label for='fitur_id'>Fitur</label>
                            <select name='fitur_id' id='fitur_id'
                                class='form-control @error('fitur_id') is-invalid @enderror'>
                                <option value='' selected disabled>Pilih Fitur</option>
                            </select>
                            @error('fitur_id')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='temuan' class='mb-2'>Temuan</label>
                            <input type='text' name='temuan' id='temuan'
                                class='form-control @error('temuan') is-invalid @enderror' value='{{ old('temuan') }}'>
                            @error('temuan')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='deskripsi' class='mb-2'>Deskripsi</label>
                            <textarea name='deskripsi' id='deskripsi' cols='30' rows='3'
                                class='form-control @error('deskripsi') is-invalid @enderror'>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='link' class='mb-2'>Link</label>
                            <input type='text' name='link' id='link'
                                class='form-control @error('link') is-invalid @enderror' value='{{ old('link') }}'>
                            @error('link')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('bug-report.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Tambah Bug Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#project_id').on('change', function() {
                let project_id = $(this).val();
                console.log(project_id);
                $.ajax({
                    url: '{{ route('fitur.getByProjectId') }}',
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        project_id
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.length > 0) {
                            $('#fitur_id').empty();
                            $('#fitur_id').append(
                                `<option selected>Pilih Fitur</option>`
                            );
                            data.forEach(fitur => {
                                $('#fitur_id').append(
                                    `<option value="${fitur.id}">${fitur.nama}</option>`
                                );
                            });
                        }
                    }
                })
            })
        })
    </script>
@endpush

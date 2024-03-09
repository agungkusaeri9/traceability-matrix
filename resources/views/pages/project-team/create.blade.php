@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Tambah Tim</h4>
                    <form action="{{ route('project-team.store', $project->uuid) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class='form-group'>
                            <label for='user_id'>User</label>
                            <select name='user_id' id='user_id'
                                class='form-control select2 @error('user_id') is-invalid @enderror'>
                                <option value='' selected disabled>Pilih User</option>
                                @foreach ($data_user as $user)
                                    <option @selected($user->id == old('user_id')) value='{{ $user->id }}'>
                                        {{ $user->name . ' | ' . $user->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('project-team.index', $project->uuid) }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Tambah Tim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2();
        })
    </script>
@endpush --}}

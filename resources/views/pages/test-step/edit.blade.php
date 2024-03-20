@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Edit Test Step</h4>
                    <form action="{{ route('test-step.update', $item->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class='form-group mb-3'>
                            <label for='test_step' class='mb-2'>Nama Test Step</label>
                            <input type='text' name='test_step'
                                class='form-control @error('test_step') is-invalid @enderror'
                                value='{{ $item->test_step ?? old('test_step') }}'>
                            @error('test_step')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('test-step.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Update Test Step</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

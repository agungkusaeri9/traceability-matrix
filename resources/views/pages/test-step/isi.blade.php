@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Isi Test Step</h4>
                    <form action="{{ route('test-step.proses-isi', $item->uuid) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class='form-group mb-3'>
                            <label for='test_step' class='mb-2'>Nama Test Step</label>
                            <input type='text' name=''
                                class='form-control @error('test_step') is-invalid @enderror'
                                value='{{ $item->test_step ?? old('test_step') }}' readonly>
                            @error('test_step')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='test_data' class='mb-2'>Test Data</label>
                            <input type='text' name='test_data'
                                class='form-control @error('test_data') is-invalid @enderror'
                                value='{{ $item->test_data ?? old('test_data') }}'>
                            @error('test_data')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='expected_behavior' class='mb-2'>Expected Behavior</label>
                            <input type='text' name='expected_behavior'
                                class='form-control @error('expected_behavior') is-invalid @enderror'
                                value='{{ $item->expected_behavior ?? old('expected_behavior') }}'>
                            @error('expected_behavior')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='test_result' class='mb-2'>Test Result</label>
                            <input type='text' name='test_result'
                                class='form-control @error('test_result') is-invalid @enderror'
                                value='{{ $item->test_result ?? old('test_result') }}'>
                            @error('test_result')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='date' class='mb-2'>Date</label>
                            <input type='date' name='date' class='form-control @error('date') is-invalid @enderror'
                                value='{{ $item->date ?? old('date') }}'>
                            @error('date')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group'>
                            <label for='status'>Status</label>
                            <select name='status' id='status'
                                class='form-control @error('status') is-invalid @enderror'>
                                <option @selected($item->status == 0) value='0' selected>Pilih Status</option>
                                <option @selected($item->status == 1) value="1">Success</option>
                                <option @selected($item->status == 2) value="2">Failed</option>
                            </select>
                            @error('status')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ route('test-step.index', [
                                'test_case_uuid' => $item->test_case_uuid,
                            ]) }}"
                                class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

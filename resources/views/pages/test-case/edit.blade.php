@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Edit Test Case</h4>
                    <form action="{{ route('test-case.update', $item->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class='form-group mb-3'>
                            <label for='nama_project' class='mb-2'>Project</label>
                            <input type='text' name='nama_project' id='nama_project'
                                class='form-control @error('nama_project') is-invalid @enderror'
                                value='{{ $item->skenario->fitur->project->nama ?? old('nama_project') }}' readonly>
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
                                value='{{ $item->skenario->fitur->nama ?? old('nama_fitur') }}' readonly>
                            @error('nama_fitur')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='nama_skenario' class='mb-2'>Skenario</label>
                            <input type='text' name='nama_skenario' id='nama_skenario'
                                class='form-control @error('nama_skenario') is-invalid @enderror'
                                value='{{ $item->skenario->nama ?? old('nama_skenario') }}' readonly>
                            @error('nama_skenario')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='nama' class='mb-2'>Nama Test Case</label>
                            <input type='text' name='nama' class='form-control @error('nama') is-invalid @enderror'
                                value='{{ $item->nama ?? old('nama') }}'>
                            @error('nama')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group'>
                            <label for='tipe'>Tipe</label>
                            <select name='tipe' id='tipe' class='form-control @error('tipe') is-invalid @enderror'>
                                <option value='0'>Pilih Tipe</option>
                                <option @selected($item->tipe === 'Happy Case') value="Happy Case">Happy</option>
                                <option @selected($item->tipe === 'UnHappy Case') value="UnHappy Case">UnHappy Case</option>
                            </select>
                            @error('status')
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
                            <a href="{{ route('test-case.index', [
                                'skenario_uuid' => $item->skenario->uuid,
                            ]) }}"
                                class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Update Test Case</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Filter</h4>
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-10">
                                <div class='form-group'>
                                    <select name='project_uuid' id='project_uuid'
                                        class='form-control @error('project_uuid') is-invalid @enderror'>
                                        <option value='' selected>Pilih Project</option>
                                        @foreach ($data_project as $project)
                                            <option @selected($project->uuid == request('project_uuid')) value='{{ $project->uuid }}'>
                                                {{ $project->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_uuid')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <button class="btn btn-secondary btn-sm btn-block">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Fitur</h4>
                    @if (request('project_uuid'))
                        @can('Fitur Create')
                            <a href="{{ route('fitur.create', [
                                'project_uuid' => $project->uuid ?? null,
                            ]) }}"
                                class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                                Fitur</a>
                        @endcan
                    @endif
                    <div class="table-responsive">
                        <table class="table nowrap dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Fitur</th>
                                    <th>Skenario</th>
                                    <th>Test Case</th>
                                    <th>Success</th>
                                    <th>Failed</th>
                                    <th>Not Tested</th>
                                    @canany(['Fitur Edit', 'Fitur Delete'])
                                        <th>Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->skenario->count() }}</td>
                                        <td>{{ $item->skenario->count('test_case') }}</td>
                                        <td>0%</td>
                                        <td>0%</td>
                                        <td>0%</td>
                                        @canany(['Fitur Edit', 'Fitur Delete'])
                                            <td>
                                                @can('Skenario Fitir Index')
                                                    <a href="{{ route('skenario.index', [
                                                        'fitur_uuid' => $item->uuid,
                                                    ]) }}"
                                                        class="btn btn-sm py-2 btn-warning" title="Skenario"><i
                                                            class="typcn typcn-flow-switch menu-icon"></i></a>
                                                @endcan
                                                @can('Fitur Edit')
                                                    <a href="{{ route('fitur.edit', $item->uuid) }}"
                                                        class="btn btn-sm py-2 btn-info"><i
                                                            class="typcn typcn-edit menu-icon"></i></a>
                                                @endcan
                                                @can('Fitur Delete')
                                                    <form action="javascript:void(0)" method="post" class="d-inline"
                                                        id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btnDelete btn-sm py-2 btn-danger"
                                                            data-action="{{ route('fitur.destroy', $item->uuid) }}"><i
                                                                class="typcn typcn-delete-outline menu-icon"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-Datatable />

@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class=" mb-3"> <a
                            href="{{ route('fitur.index', [
                                'project_uuid' => $fitur->project->uuid,
                            ]) }}"
                            class="text-decoration-none text-dark">
                            <i class="typcn typcn-arrow-left menu-icon"></i> Kembali
                        </a>
                    </h4>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th>Project</th>
                            <th> : </th>
                            <td>
                                {{ $fitur->project->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>Fitur</th>
                            <th> : </th>
                            <td>
                                {{ $fitur->nama }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Skenario</h4>
                    @can('Skenario Create')
                        <a href="{{ route('skenario.create', [
                            'fitur_uuid' => $fitur->uuid,
                        ]) }}"
                            class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                            Skenario</a>
                    @endcan
                    <div class="table-responsive">
                        <table class="table dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Skenario</th>
                                    @canany(['Skenario Edit', 'Skenario Delete'])
                                        <th>Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        @canany(['Skenario Edit', 'Skenario Delete'])
                                            <td>
                                                @can('Test Case Index')
                                                    <a href="{{ route('test-case.index', [
                                                        'skenario_uuid' => $item->uuid,
                                                    ]) }}"
                                                        class="btn btn-sm py-2 btn-warning" title="Test Case"><i
                                                            class="typcn typcn-input-checked-outline menu-icon"></i></a>
                                                @endcan
                                                @can('Skenario Edit')
                                                    <a href="{{ route('skenario.edit', $item->uuid) }}"
                                                        class="btn btn-sm py-2 btn-info"><i
                                                            class="typcn typcn-edit menu-icon"></i></a>
                                                @endcan
                                                @can('Skenario Delete')
                                                    <form action="javascript:void(0)" method="post" class="d-inline"
                                                        id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btnDelete btn-sm py-2 btn-danger"
                                                            data-action="{{ route('skenario.destroy', $item->uuid) }}"><i
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

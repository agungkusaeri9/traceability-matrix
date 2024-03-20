@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class=" mb-3"> <a
                            href="{{ route('skenario.index', [
                                'fitur_uuid' => $skenario->fitur->uuid,
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
                                {{ $skenario->fitur->project->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>Fitur</th>
                            <th> : </th>
                            <td>
                                {{ $skenario->fitur->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>Skenario</th>
                            <th> : </th>
                            <td>
                                {{ $skenario->nama }}
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
                    <h4 class="card-title mb-3">Test Case</h4>
                    @can('Test Case Create')
                        <a href="{{ route('test-case.create', [
                            'skenario_uuid' => $skenario->uuid,
                        ]) }}"
                            class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                            Test Case</a>
                    @endcan
                    <div class="table-responsive">
                        <table class="table dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Test Case</th>
                                    <th>Tipe</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Status Test Step</th>
                                    @canany(['Test Case Edit', 'Test Case Delete'])
                                        <th>Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->tipe }}</td>
                                        <td>{{ $item->link }}</td>
                                        <td>{!! $item->status() !!}</td>
                                        <td>{!! $item->status_test_step() !!}</td>
                                        @canany(['Test Case Edit', 'Test Case Delete'])
                                            <td>
                                                @can('Test Case Isi')
                                                    <a href="{{ route('test-case.isi', $item->uuid) }}"
                                                        class="btn btn-sm py-2 btn-primary"><i
                                                            class="typcn typcn-pencil menu-icon"></i></a>
                                                @endcan
                                                @can('Test Step Index')
                                                    <a href="{{ route('test-step.index', [
                                                        'test_case_uuid' => $item->uuid,
                                                    ]) }}"
                                                        class="btn btn-sm py-2 btn-warning"><i
                                                            class="typcn typcn-arrow-forward-outline menu-icon"></i></a>
                                                @endcan
                                                @can('Test Case Edit')
                                                    <a href="{{ route('test-case.edit', $item->uuid) }}"
                                                        class="btn btn-sm py-2 btn-info"><i
                                                            class="typcn typcn-edit menu-icon"></i></a>
                                                @endcan
                                                @can('Test Case Delete')
                                                    <form action="javascript:void(0)" method="post" class="d-inline"
                                                        id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btnDelete btn-sm py-2 btn-danger"
                                                            data-action="{{ route('test-case.destroy', $item->uuid) }}"><i
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

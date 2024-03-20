@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class=" mb-3"> <a
                            href="{{ route('test-case.index', [
                                'test_case_uuid' => $test_case->uuid,
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
                                {{ $test_case->skenario->fitur->project->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>Fitur</th>
                            <th> : </th>
                            <td>
                                {{ $test_case->skenario->fitur->nama }}
                            </td>
                        </tr>
                        <tr>
                            <th>Skenario</th>
                            <th> : </th>
                            <td>
                                {{ $test_case->skenario->nama }}
                            </td>
                        <tr>
                            <th>Test Case</th>
                            <th> : </th>
                            <td>
                                {{ $test_case->nama }}
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
                    <h4 class="card-title mb-3">Test Step</h4>
                    @can('Test Step Create')
                        <a href="{{ route('test-step.create', [
                            'test_case_uuid' => $test_case->uuid,
                        ]) }}"
                            class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                            Test Step</a>
                    @endcan
                    <div class="table-responsive">
                        <table class="table nowrap dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Test Step</th>
                                    <th>Test Data</th>
                                    <th>Expected Behavior</th>
                                    <th>Test Result</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    @canany(['Test Step Edit', 'Test Step Delete'])
                                        <th>Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->test_step }}</td>
                                        <td>{{ $item->test_data }}</td>
                                        <td>{{ $item->expected_behavior }}</td>
                                        <td>{{ $item->test_result }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{!! $item->status() !!}</td>
                                        @canany(['Test Step Edit', 'Test Step Delete'])
                                            <td>
                                                @can('Test Step Isi')
                                                    <a href="{{ route('test-step.isi', $item->uuid) }}"
                                                        class="btn btn-sm py-2 btn-primary"><i
                                                            class="typcn typcn-pencil menu-icon"></i></a>
                                                @endcan
                                                @can('Test Step Edit')
                                                    <a href="{{ route('test-step.edit', $item->uuid) }}"
                                                        class="btn btn-sm py-2 btn-info"><i
                                                            class="typcn typcn-edit menu-icon"></i></a>
                                                @endcan
                                                @can('Test Step Delete')
                                                    <form action="javascript:void(0)" method="post" class="d-inline"
                                                        id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btnDelete btn-sm py-2 btn-danger"
                                                            data-action="{{ route('test-step.destroy', $item->uuid) }}"><i
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

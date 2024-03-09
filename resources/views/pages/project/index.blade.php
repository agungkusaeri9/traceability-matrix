@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Project</h4>
                    @can('Project Create')
                        <a href="{{ route('project.create') }}" class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                            Project</a>
                    @endcan
                    <div class="table-responsive">
                        <table class="table dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Assign Date</th>
                                    <th>Deksirpsi</th>
                                    <th>Status</th>
                                    <th>Presentase</th>
                                    @canany(['Project Edit', 'Project Delete'])
                                        <th>Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->assign_date->translatedFormat('d F Y') }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>{{ $item->status() }}</td>
                                        <td>{{ $item->presentase() }}</td>
                                        @canany(['Project Edit', 'Project Delete'])
                                            <td>
                                                @can('Project Edit')
                                                    <a href="{{ route('project.edit', $item->uuid) }}"
                                                        class="btn btn-sm py-2 btn-info"> <i
                                                            class="typcn typcn-edit menu-icon"></i></a>
                                                @endcan
                                                @can('Project Delete')
                                                    <form action="javascript:void(0)" method="post" class="d-inline"
                                                        id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btnDelete btn-sm py-2 btn-danger"
                                                            data-action="{{ route('project.destroy', $item->uuid) }}">
                                                            <i class="typcn typcn-delete menu-icon"></i></button>
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

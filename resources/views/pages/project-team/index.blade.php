@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Detail Project</h4>
                    <ul class="list-inline">
                        <li class="list-inline-item mb-3 d-flex justify-content-between">
                            <span>Nama Project</span>
                            <span class="font-weight-bold">{{ $project->nama }}</span>
                        </li>
                        <li class="list-inline-item mb-3 d-flex justify-content-between">
                            <span>Assign Date</span>
                            <span class="font-weight-bold">{{ $project->assign_date->translatedFormat('d F Y') }}</span>
                        </li>
                        <li class="list-inline-item mb-3 d-flex justify-content-between">
                            <span>Presentase</span>
                            <span class="font-weight-bold">{{ $project->presentase() }}</span>
                        </li>
                        <li class="list-inline-item mb-3 d-flex justify-content-between">
                            <span>Status</span>
                            <span class="font-weight-bold">{{ $project->status() }}</span>
                        </li>
                        <li class="list-inline-item mb-3 d-flex justify-content-between">
                            <span>Aksi</span>
                            <span class="font-weight-bold">
                                <a href="{{ route('project.index') }}" class="btn btn-sm py-2 btn-warning"> <i
                                        class="typcn typcn-arrow-left menu-icon"></i></a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Tim</h4>
                    @can('Project Team Create')
                        <a href="{{ route('project-team.create', $project->uuid) }}"
                            class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                            Tim</a>
                    @endcan
                    <div class="table-responsive">
                        <table class="table dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Assign Date</th>
                                    @canany(['Project Team Delete'])
                                        <th>Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        @canany(['Project Team Delete'])
                                            <td>
                                                @can('Project Team Delete')
                                                    <form action="javascript:void(0)" method="post" class="d-inline"
                                                        id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btnDelete btn-sm py-2 btn-danger"
                                                            data-action="{{ route('project-team.destroy', $item->uuid) }}">
                                                            <i class="typcn typcn-delete-outline menu-icon"></i></button>
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

@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Repository</h4>
                    @can('Repository Create')
                        <a href="{{ route('repository.create') }}" class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                            Repository</a>
                    @endcan
                    <div class="table-responsive">
                        <table class="table dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Dokumen</th>
                                    <th>Jenis</th>
                                    <th>Deskripsi</th>
                                    <th>Ukuran</th>
                                    <th>File</th>
                                    @canany(['Repository Edit', 'Repository Delete'])
                                        <th>Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_dokumen }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>{{ $item->getUkuran() }}</td>
                                        <td>
                                            <a href="{{ $item->getFile() }}" target="_blank"
                                                class="btn btn-sm btn-secondary">Lihat</a>
                                        </td>
                                        @canany(['Repository Edit', 'Repository Delete'])
                                            <td>
                                                @can('Repository Edit')
                                                    <a href="{{ route('repository.edit', $item->uuid) }}"
                                                        class="btn btn-sm py-2 btn-info"><i
                                                            class="typcn typcn-edit menu-icon"></i></a>
                                                @endcan
                                                @can('Repository Delete')
                                                    <form action="javascript:void(0)" method="post" class="d-inline"
                                                        id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btnDelete btn-sm py-2 btn-danger"
                                                            data-action="{{ route('repository.destroy', $item->uuid) }}"><i
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

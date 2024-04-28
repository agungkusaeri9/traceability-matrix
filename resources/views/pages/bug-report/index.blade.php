@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Bug Report</h4>
                    @can('Bug Report Create')
                        <a href="{{ route('bug-report.create') }}" class="btn my-2 mb-3 btn-sm py-2 btn-primary">Tambah
                            Bug Report</a>
                    @endcan
                    <div class="table-responsive">
                        <table class="table dtTable nowrap table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Project</th>
                                    <th>Fitur</th>
                                    <th>Temuan</th>
                                    <th>Deskripsi</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    @canany(['Bug Report Edit', 'Bug Report Delete'])
                                        <th>Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y H:i:s') }}</td>
                                        <td>{{ $item->project->nama }}</td>
                                        <td>{{ $item->fitur->nama }}</td>
                                        <td>{{ $item->temuan }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>{{ $item->link }}</td>
                                        <td>{{ $item->status() }}</td>
                                        @canany(['Bug Report Edit', 'Bug Report Delete'])
                                            <td>
                                                @can('Bug Report Verifikasi')
                                                    @if ($item->status == 0)
                                                        <a href="{{ route('bug-report.verifikasi', [
                                                            'uuid' => $item->uuid,
                                                            'status' => 1,
                                                        ]) }}"
                                                            class="btn btn-sm py-2 btn-warning">SET ON DOING</a>
                                                        <a href="{{ route('bug-report.verifikasi', [
                                                            'uuid' => $item->uuid,
                                                            'status' => 2,
                                                        ]) }}"
                                                            class="btn btn-sm py-2 btn-success">SET DONE</a>
                                                    @elseif($item->status == 1)
                                                        <a href="{{ route('bug-report.verifikasi', [
                                                            'uuid' => $item->uuid,
                                                            'status' => 0,
                                                        ]) }}"
                                                            class="btn btn-sm py-2 btn-primary">SET ON HOLD</a>
                                                        <a href="{{ route('bug-report.verifikasi', [
                                                            'uuid' => $item->uuid,
                                                            'status' => 2,
                                                        ]) }}"
                                                            class="btn btn-sm py-2 btn-success">SET DONE</a>
                                                    @else
                                                        <a href="{{ route('bug-report.verifikasi', [
                                                            'uuid' => $item->uuid,
                                                            'status' => 0,
                                                        ]) }}"
                                                            class="btn btn-sm py-2 btn-primary">SET ON HOLD</a>
                                                        <a href="{{ route('bug-report.verifikasi', [
                                                            'uuid' => $item->uuid,
                                                            'status' => 1,
                                                        ]) }}"
                                                            class="btn btn-sm py-2 btn-success">SET ON DOING</a>
                                                    @endif
                                                @endcan
                                                @can('Bug Report Edit')
                                                    <a href="{{ route('bug-report.edit', $item->uuid) }}"
                                                        class="btn btn-sm py-2 btn-info"><i
                                                            class="typcn typcn-edit menu-icon"></i></a>
                                                @endcan
                                                @can('Bug Report Delete')
                                                    <form action="javascript:void(0)" method="post" class="d-inline"
                                                        id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btnDelete btn-sm py-2 btn-danger"
                                                            data-action="{{ route('bug-report.destroy', $item->uuid) }}"><i
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

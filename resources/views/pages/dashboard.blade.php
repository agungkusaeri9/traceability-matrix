@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">{{ auth()->user()->name }}</h3>
        </div>
    </div>
    <div class="row  mt-3">
        <div class="col-md-3 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="display-1 text-center">
                        {{ $count['user'] }}
                    </div>
                    <h1 class="card-title mt-4 text-center">User</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="display-1 text-center">
                        {{ $count['project'] }}
                    </div>
                    <h1 class="card-title mt-4 text-center">Project</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="display-1 text-center">
                        {{ $count['bug'] }}
                    </div>
                    <h1 class="card-title mt-4 text-center">Bug Report</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="display-1 text-center">
                        {{ $count['repository'] }}
                    </div>
                    <h1 class="card-title mt-4 text-center">Repository</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
